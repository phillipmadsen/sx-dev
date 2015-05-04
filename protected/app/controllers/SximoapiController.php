<?php
class SximoapiController extends BaseController {

	public function __construct() 
	{
		parent::__construct();

					
	}	

	public function index()
	{		
		$class 			= ucwords(Input::get('module'));
	  	$config	 		= $class::makeInfo( $class );	
	  	$tables 		= $config['config']['grid'];

	  	$page 			= (!is_null(Input::get('page')) or Input::get('page') != 0 ) ? Input::get('page') : 1 ;		
		$param			= array('page'=> $page , 'sort'=>'', 'order'=>'asc','limit'=>''  );
		if(!is_null(Input::get('limit')) or Input::get('limit') != 0 ) $param['limit'] = Input::get('limit');
		if(!is_null(Input::get('order'))) $param['order'] = Input::get('order');
		if(!is_null(Input::get('sort'))) $param['sort'] = Input::get('sort');	
		
					
			
		$results 		= 	$class::getRows( $param ); 

		$json = array();
		foreach($results['rows'] as $row)
		{
			$rows = array();
			foreach($tables as $table)
			{				
				$conn = (isset($table['conn']) ? $table['conn'] : array() );
				$rows[$table['field']] = SiteHelpers::gridDisplay($row->$table['field'],$table['field'],$conn)	;						
				
			}
			$json[] = $rows;

		}


		$jsonData = array(
			'total'		=> $results['total'],
			'rows'		=> $json ,
			'control'	=> $param ,
			'key'		=> $config['key']

		);

		if(!is_null(Input::get('option')) && Input::get('option') =='true')
		{
			$label = array();	
			foreach($tables as $table)
			{
				$label[] = $table['label'];
			}	
			
			$field = array();	
			foreach($tables as $table)
			{
				$field[] = $table['field'];
			}
			$jsonData['option'] = array(
					'label'	=> $label ,
					'field'	=> $field
				);			

		}


		return Response::json($jsonData,200);


	}

	public function show( $id )
	{	
		$class 			= ucwords(Input::get('module'));
	  	$config	 		= 	$class::makeInfo( $class );	
	  	$tables 		=	$config['config']['grid'];			
		$jsonData 			= 	$class::getRow( $id );
		return Response::json($jsonData,200);

	}


	public function store(  )
	{
		$class 			= ucwords(Input::get('module'));
		$this->info		= 	$class::makeInfo( $class );	
		$data 			= $this->validatePost($this->info['key']);
		unset($data['entry_by']);
		$id 			= $class::insertRow($data , '' );		

		return Response::json(array('data'=> 'success'),200);
	}

	public function update( $id  )
	{

		$class 			= ucwords(Input::get('module'));
		$this->info		= 	$class::makeInfo( $class );	
		$data 			= $this->validatePost($this->info['key']);
		unset($data['entry_by']);
		$id 			= $class::insertRow($data , $id );		

		return Response::json(array('data'=> 'success'),200);
	}

	public function destroy( $id )
	{
		$class     = ucwords(Input::get('module'));
		$results   =	$class::find($id);
		if(is_null($results))
		{
				return Response::json("not found",404);
		}
		 
		$success	=	$results->delete();
		 
		if(!$success)
		{
			return Response::json("error deleting",500);
		}
		 
		return Response::json("success",200);

	}		
}