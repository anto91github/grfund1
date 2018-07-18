<div class="wrapper-header ">
    <div class=" container">
		<div class="col-sm-6 col-xs-6">
		  <div class="page-title">
			<h3> {{ Lang::get('core.faq_title') }} <small>{{ Lang::get('core.faq_title_d') }}.</small></h3>
		  </div>
		</div>
		<div class="col-sm-6 col-xs-6 ">
		  <ul class="breadcrumb pull-right">
			<li><a href="{{ URL::to('') }}">{{ Lang::get('core.home') }}</a></li>
			<li class="active">{{ Lang::get('core.faq_title') }} </li>
		  </ul>		
		</div>
		  
    </div>
</div>	
<div class="container">

<div class="row">
		{{html_entity_decode($contentText)}}             
	</div>
	
</div>	