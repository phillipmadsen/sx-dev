<div class="page-content row">
    <!-- Page header -->
    <div class="page-header">
      <div class="page-title">
        <h3> {{ $pageTitle }} <small>{{ $pageNote }}</small></h3>
      </div>
      <ul class="breadcrumb">
        <li><a href="{{ URL::to('dashboard') }}">{{ Lang::get('core.home') }}</a></li>
		<li><a href="{{ URL::to('restapi?md='.$masterdetail["filtermd"]) }}">{{ $pageTitle }}</a></li>
        <li class="active"> {{ Lang::get('core.detail') }} </li>
      </ul>
	 </div>  
	 
	 
 	<div class="page-content-wrapper">   
	   <div class="toolbar-line">
	   		<a href="{{ URL::to('restapi?md='.$masterdetail["filtermd"].$trackUri) }}" class="tips btn btn-xs btn-default" title="{{ Lang::get('core.btn_back') }}"><i class="fa fa-arrow-circle-left"></i>&nbsp;{{ Lang::get('core.btn_back') }}</a>
			@if($access['is_add'] ==1)
	   		<a href="{{ URL::to('restapi/add/'.$id.'?md='.$masterdetail["filtermd"].$trackUri) }}" class="tips btn btn-xs btn-primary" title="{{ Lang::get('core.btn_edit') }}"><i class="fa fa-edit"></i>&nbsp;{{ Lang::get('core.btn_edit') }}</a>
			@endif  		   	  
		</div>
<div class="sbox animated fadeInRight">
	<div class="sbox-title"> <h4> <i class="fa fa-table"></i> <?php echo $pageTitle ;?> <small>{{ $pageNote }}</small></h4></div>
	<div class="sbox-content"> 	


	
	<table class="table table-striped table-bordered" >
		<tbody>	
	
					<tr>
						<td width='30%' class='label-view text-right'>Id</td>
						<td>{{ SiteHelpers::gridDisplayView($row->id,'id','1:tb_users:id:') }} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Apiuser</td>
						<td>{{ SiteHelpers::gridDisplayView($row->apiuser,'apiuser','1:tb_users:id:email') }} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Apikey</td>
						<td>{{ $row->apikey }} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Allowed Modules Access</td>
						<td>{{ $row->modules }} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Created</td>
						<td>{{ $row->created }} </td>
						
					</tr>
				
		</tbody>	
	</table>    
	
	</div>
</div>	

	</div>
</div>
	  