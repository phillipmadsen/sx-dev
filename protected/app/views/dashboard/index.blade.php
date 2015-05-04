{{ HTML::script('sximo/js/plugins/chartjs/Chart.min.js') }}
<div class="page-content row">
	<div class="page-header">
	  <div class="page-title">
		<h3><i class="fa fa-desktop"></i> Dashboard <small> Summary info site </small></h3>
	  </div>

		  <ul class="breadcrumb">
			<li><a href="{{ URL::to('dashboard') }}">{{ Lang::get('core.home') }}</a></li>
			<li class="active">Dashboard</li>
		  </ul>
		  
	</div>
	<div class="page-content-wrapper">  
	
	
	@if(Session::get('gid') ==1)

<section >

		<div class="row m-l-none m-r-none m-t  white-bg shortcut " >
			<div class="col-sm-6 col-md-3 b-r  p-sm ">
				<span class="pull-left m-r-sm text-navy"><i class="fa fa-plus-circle"></i></span> 
				<a href="{{ URL::to('module') }}" class="clear">
					<span class="h3 block m-t-xs"><strong>  {{ Lang::get('core.dash_i_module') }}  </strong>
					</span> <small class="text-muted text-uc">  {{ Lang::get('core.dash_module') }}</small>
				</a>
			</div>
			<div class="col-sm-6 col-md-3 b-r  p-sm">
				<span class="pull-left m-r-sm text-info">	<i class="fa fa-cogs"></i></span>
				<a href="{{ URL::to('config') }}" class="clear">
					<span class="h3 block m-t-xs"><strong> {{ Lang::get('core.dash_i_setting') }}</strong>
					</span> <small class="text-muted text-uc">   {{ Lang::get('core.dash_setting') }} </small> 
				</a>
			</div>
			<div class="col-sm-6 col-md-3 b-r  p-sm">
				<span class="pull-left m-r-sm text-warning">	<i class="fa fa-sitemap"></i></span>
				<a href="{{ URL::to('menu') }}" class="clear">
				<span class="h3 block m-t-xs"><strong>  {{ Lang::get('core.dash_i_sitemenu') }} </strong></span>
				<small class="text-muted text-uc">  {{ Lang::get('core.dash_sitemenu') }}  </small> </a>
			</div>
			<div class="col-sm-6 col-md-3 b-r  p-sm">
				<span class="pull-left m-r-sm ">	<i class="fa fa-users"></i></span>
				<a href="{{ URL::to('users') }}" class="clear">
				<span class="h3 block m-t-xs"><strong> {{ Lang::get('core.dash_i_usergroup') }}</strong>
				</span> <small class="text-muted text-uc">  {{ Lang::get('core.dash_usergroup') }} </small> </a>
			</div>
		</div> </section>	

	
	<div class="row m-t">
		<div class="col-md-12">
			<div class="sbox">
				<div class="sbox-title"> <h3> Sample Chart <small> ( Plugins js using Chart Js ) </small> </h3> </div>
				<div class="sbox-content">
					<div class="row">
						<div class="col-md-11">
							<canvas id="canvas" width="350" height="200" ></canvas>
						</div>
						
					</div>
				
						
				</div>
			</div>
		</div>
		
		
	
	</div>
	@endif
</div>	
	
</div>

<script>
		var randomScalingFactor = function(){ return Math.round(Math.random()*100)};
		var lineChartData = {
			labels : ["January","February","March","April","May","June","July"],
			datasets : [
				{
					label: "My First dataset",
					fillColor : "rgba(220,220,220,0.2)",
					strokeColor : "rgba(220,220,220,1)",
					pointColor : "rgba(220,220,220,1)",
					pointStrokeColor : "#fff",
					pointHighlightFill : "#fff",
					pointHighlightStroke : "rgba(220,220,220,1)",
					data : [randomScalingFactor(),randomScalingFactor(),randomScalingFactor(),randomScalingFactor(),randomScalingFactor(),randomScalingFactor(),randomScalingFactor()]
				},
				{
					label: "My Second dataset",
					fillColor : "rgba(151,187,205,0.2)",
					strokeColor : "rgba(151,187,205,1)",
					pointColor : "rgba(151,187,205,1)",
					pointStrokeColor : "#fff",
					pointHighlightFill : "#fff",
					pointHighlightStroke : "rgba(151,187,205,1)",
					data : [randomScalingFactor(),randomScalingFactor(),randomScalingFactor(),randomScalingFactor(),randomScalingFactor(),randomScalingFactor(),randomScalingFactor()]
				}
			]

		}

	window.onload = function(){
		var ctx = document.getElementById("canvas").getContext("2d");
		window.myLine = new Chart(ctx).Line(lineChartData, {
			responsive: true
		});
	}
	
</script>	

