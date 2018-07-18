
  <div class="page-content row">
    <!-- Page header -->
    <div class="page-header">
      <div class="page-title">
        <h3> {{ $pageTitle }} <small>{{ $pageNote }}</small></h3>
      </div>
      <ul class="breadcrumb">
        <li><a href="{{ URL::to('dashboard') }}">{{ Lang::get('core.home') }}</a></li>
		<li><a href="{{ URL::to('reward?md='.$filtermd) }}">{{ $pageTitle }}</a></li>
        <li class="active">{{ Lang::get('core.addedit') }} </li>
      </ul>
	  	  
    </div>
 
 	<div class="page-content-wrapper">
	<div class="panel-default panel">
		<div class="panel-body">
		@if(Session::has('message'))	  
			   {{ Session::get('message') }}
		@endif	
		<ul class="parsley-error-list">
			@foreach($errors->all() as $error)
				<li>{{ $error }}</li>
			@endforeach
		</ul>
		 {{ Form::open(array('url'=>'reward/save/'.SiteHelpers::encryptID($row['reward_id']).'?md='.$filtermd.$trackUri, 'class'=>'form-horizontal','files' => true , 'parsley-validate'=>'','novalidate'=>' ')) }}
				<div class="col-md-12">
						<fieldset><legend> Reward</legend>
									
								  <div class="form-group hidethis " style="display:none;">
									<label for="Reward Id" class=" control-label col-md-4 text-left"> Reward Id </label>
									<div class="col-md-6">
									  {{ Form::text('reward_id', $row['reward_id'],array('class'=>'form-control', 'placeholder'=>'',   )) }} 
									 </div> 
									 <div class="col-md-2">
									 	
									 </div>
								  </div> 					
								  <div class="form-group  " >
									<label for="Project Id" class=" control-label col-md-4 text-left"> Project Id </label>
									<div class="col-md-6">
									  <select name='project_id' rows='5' id='project_id' code='{$project_id}' 
							class='select2 '    ></select> 
									 </div> 
									 <div class="col-md-2">
									 	
									 </div>
								  </div> 					
								  <div class="form-group  " >
									<label for="Reward Title" class=" control-label col-md-4 text-left"> Reward Title </label>
									<div class="col-md-6">
									  {{ Form::text('reward_title', $row['reward_title'],array('class'=>'form-control', 'placeholder'=>'',   )) }} 
									 </div> 
									 <div class="col-md-2">
									 	
									 </div>
								  </div> 					
								  <div class="form-group  " >
									<label for="Reward Description" class=" control-label col-md-4 text-left"> Reward Description </label>
									<div class="col-md-6">
									  <textarea name='reward_description' rows='2' id='reward_description' class='form-control '  
				           >{{ $row['reward_description'] }}</textarea> 
									 </div> 
									 <div class="col-md-2">
									 	
									 </div>
								  </div> 					
								  <div class="form-group  " >
									<label for="Reward Minimum" class=" control-label col-md-4 text-left"> Reward Minimum </label>
									<div class="col-md-6">
									  {{ Form::text('reward_minimum', $row['reward_minimum'],array('class'=>'form-control', 'placeholder'=>'',   )) }} 
									 </div> 
									 <div class="col-md-2">
									 	
									 </div>
								  </div> 					
								  <div class="form-group  " >
									<label for="Reward Available" class=" control-label col-md-4 text-left"> Reward Available </label>
									<div class="col-md-6">
									  {{ Form::text('reward_available', $row['reward_available'],array('class'=>'form-control', 'placeholder'=>'',   )) }} 
									 </div> 
									 <div class="col-md-2">
									 	
									 </div>
								  </div> 					
								  <div class="form-group  " >
									<label for="Reward Image" class=" control-label col-md-4 text-left"> Reward Image </label>
									<div class="col-md-6">
									  <input  type='file' name='reward_image' id='reward_image' @if($row['reward_image'] =='') class='required' @endif style='width:150px !important;'  />
					{{ SiteHelpers::showUploadedFile($row['reward_image'],'/uploads/reward/') }}
				 
									 </div> 
									 <div class="col-md-2">
									 	
									 </div>
								  </div> </fieldset>
			</div>
			
			
			<div style="clear:both"></div>	
				
			  <div class="form-group">
				<label class="col-sm-4 text-right">&nbsp;</label>
				<div class="col-sm-8">	
				<input type="submit" name="apply" class="btn btn-info" value="{{ Lang::get('core.sb_apply') }} " />
				<input type="submit" name="submit" class="btn btn-primary" value="{{ Lang::get('core.sb_save') }}  " />
				<button type="button" onclick="location.href='{{ URL::to('reward?md='.$masterdetail["filtermd"].$trackUri) }}' " id="submit" class="btn btn-success ">  {{ Lang::get('core.sb_cancel') }} </button>
				</div>	  
		
			  </div> 
		 
		 {{ Form::close() }}
		</div>
	</div>	
</div>	
</div>			 
   <script type="text/javascript">
	$(document).ready(function() { 
		
		$("#project_id").jCombo("{{ URL::to('reward/comboselect?filter=project:project_id:title') }}",
		{  selected_value : '{{ $row["project_id"] }}' });
		 
	});
	</script>		 