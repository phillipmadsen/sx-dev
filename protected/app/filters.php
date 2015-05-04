<?php

/*
|--------------------------------------------------------------------------
| Application & Route Filters
|--------------------------------------------------------------------------
|
| Below you will find the "before" and "after" events for the application
| which may be used to do any work before or after a request into your
| application. Here you may also register your custom route filters.
|
*/

App::before(function($request)
{
	//SiteHelpers::globalXssClean();
});


App::after(function($request, $response)
{
	//
});

/*
|--------------------------------------------------------------------------
| Authentication Filters
|--------------------------------------------------------------------------
|
| The following filters are used to verify that the user of the current
| session is logged into this application. The "basic" filter easily
| integrates HTTP Basic authentication for quick, simple checking.
|
*/

Route::filter('auth', function()
{
	if (Auth::guest()) return Redirect::guest('user/login');
});

Route::filter('authSU', function()
{
	if (Auth::guest()) return Redirect::guest('user/login');
	if (Session::get('gid') !='1') return Redirect::to('dashboard');
});


Route::filter('auth.basic', function()
{
	return Auth::basic();
});

/*
|--------------------------------------------------------------------------
| Guest Filter
|--------------------------------------------------------------------------
|
| The "guest" filter is the counterpart of the authentication filters as
| it simply checks that the current user is not logged in. A redirect
| response will be issued if they are, which you may freely change.
|
*/

Route::filter('guest', function()
{
	if (Auth::check()) return Redirect::to('/');
});

/*
|--------------------------------------------------------------------------
| CSRF Protection Filter
|--------------------------------------------------------------------------
|
| The CSRF filter is responsible for protecting your application against
| cross-site request forgery attacks. If this special token in a user
| session does not match the one given in this request, we'll bail.
|
*/

Route::filter('csrf', function()
{
    if (Session::token() !== Input::get('_token'))
    {
        throw new IlluminateSessionTokenMismatchException;
    }
});


Route::filter('authorization', function()
{

	if(is_null(Input::get('module'))) 
		return Response::json(array('status'=>'error','message'=>' Please Define Module Name to accessed '),400);		
			
	if(!isset($_SERVER['PHP_AUTH_USER']) && !isset($_SERVER['PHP_AUTH_PW']))
	{
        return Response::json([
            'error' => true,
            'message' => 'Not authenticated',
            'code' => 401], 401
        );		
	} else {
		
		$user = $_SERVER['PHP_AUTH_USER'];
		$key = $_SERVER['PHP_AUTH_PW'];
		
		$auth = DB::table('tb_restapi')
				->join('tb_users', 'tb_users.id', '=', 'tb_restapi.apiuser')
				->where('apikey',"$key")->where("email","$user")->get();

		
		if(count($auth) <=0 )
		{
			return Response::json([
				'error' => true,
				'message' => 'Invalid authenticated params !',
				'code' => 401], 401
			);	
		}  else {
		
			$row = $auth[0];
			$modules = explode(',',str_replace(" ","",$row->modules));
			if(!in_array(Input::get('module'), $modules))
			{				
				return Response::json([
					'error' => true,
					'message' => 'You Dont Have Authorization Access!',
					'code' => 401], 401
				);				
			} 		
		
		}
	}	

});