<div class="wrapper-header ">
    <div class=" container">
		<div class="col-sm-6 col-xs-6">
		  <div class="page-title">
			<h3> {{ Lang::get('core.about_title') }}</h3>
		  </div>
		</div>
		<div class="col-sm-6 col-xs-6 ">
		  <ul class="breadcrumb pull-right">
			<li><a href="{{ URL::to('') }}">{{ Lang::get('core.home') }}</a></li>
			<li class="active">{{ Lang::get('core.about_title2') }} </li>
		  </ul>		
		</div>
		  
    </div>
</div>	
	




<div class="container">
    <div class="row">
        <div class="span12">
		{{html_entity_decode($contentText)}}
        </div>
    </div>
</div>


		

<div class="container" style="margin-bottom:40px;">
	<div class="row">
	
	
	</div>
</div>					