
  <div class="page-content row">
    <!-- Page header -->
    <div class="page-header">
      <div class="page-title">
        <h3> {{ $pageTitle }} <small>{{ $pageNote }}</small></h3>
      </div>
      <ul class="breadcrumb">
        <li><a href="{{ URL::to('dashboard') }}">{{ Lang::get('core.home') }}</a></li>
		<li><a href="{{ URL::to('backer?md='.$filtermd) }}">{{ $pageTitle }}</a></li>
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
		 {{ Form::open(array('url'=>'backer/save/'.SiteHelpers::encryptID($row['backer_id']).'?md='.$filtermd.$trackUri, 'class'=>'form-horizontal','files' => true , 'parsley-validate'=>'','novalidate'=>' ')) }}
				<div class="col-md-12">
						<fieldset><legend> Backer</legend>
									
								  <div class="form-group hidethis " style="display:none;">
									<label for="Backer Id" class=" control-label col-md-4 text-left"> Backer Id </label>
									<div class="col-md-6">
									  {{ Form::text('backer_id', $row['backer_id'],array('class'=>'form-control', 'placeholder'=>'',   )) }} 
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
									<label for="Project Id Alt" class=" control-label col-md-4 text-left"> Project Id Alt </label>
									<div class="col-md-6">
									  <select name='project_id_alt' rows='5' id='project_id_alt' code='{$project_id_alt}' 
							class='select2 '    ></select> 
									 </div> 
									 <div class="col-md-2">
									 	
									 </div>
								  </div> 					
								  <div class="form-group  " >
									<label for="Reward Id" class=" control-label col-md-4 text-left"> Reward Id </label>
									<div class="col-md-6">
									  <select name='reward_id' rows='5' id='reward_id' code='{$reward_id}' 
							class='select2 '    ></select> 
									 </div> 
									 <div class="col-md-2">
									 	
									 </div>
								  </div> 					
								  <div class="form-group  " >
									<label for="Backer Amount" class=" control-label col-md-4 text-left"> Backer Amount </label>
									<div class="col-md-6">
									  {{ Form::text('backer_amount', $row['backer_amount'],array('class'=>'form-control', 'placeholder'=>'',   )) }} 
									 </div> 
									 <div class="col-md-2">
									 	
									 </div>
								  </div> 					
								  <div class="form-group  " >
									<label for="User Id" class=" control-label col-md-4 text-left"> User Id </label>
									<div class="col-md-6">
									  <select name='user_id' rows='5' id='user_id' code='{$user_id}' 
							class='select2 '    ></select> 
									 </div> 
									 <div class="col-md-2">
									 	
									 </div>
								  </div> 					
								  <div class="form-group  " >
									<label for="Name" class=" control-label col-md-4 text-left"> Name </label>
									<div class="col-md-6">
									  {{ Form::text('name', $row['name'],array('class'=>'form-control', 'placeholder'=>'',   )) }} 
									 </div> 
									 <div class="col-md-2">
									 	
									 </div>
								  </div> 					
								  <div class="form-group  " >
									<label for="Backer Date" class=" control-label col-md-4 text-left"> Backer Date </label>
									<div class="col-md-6">
									  
				{{ Form::text('backer_date', $row['backer_date'],array('class'=>'form-control datetime', 'style'=>'width:150px !important;')) }} 
									 </div> 
									 <div class="col-md-2">
									 	
									 </div>
								  </div> 					
								  <div class="form-group  " >
									<label for="Email" class=" control-label col-md-4 text-left"> Email </label>
									<div class="col-md-6">
									  {{ Form::text('email', $row['email'],array('class'=>'form-control', 'placeholder'=>'',   )) }} 
									 </div> 
									 <div class="col-md-2">
									 	
									 </div>
								  </div> 					
								  <div class="form-group  " >
									<label for="Comment" class=" control-label col-md-4 text-left"> Comment </label>
									<div class="col-md-6">
									  {{ Form::text('comment', $row['comment'],array('class'=>'form-control', 'placeholder'=>'',   )) }} 
									 </div> 
									 <div class="col-md-2">
									 	
									 </div>
								  </div> 					
								  <div class="form-group  " >
									<label for="Status" class=" control-label col-md-4 text-left"> Status </label>
									<div class="col-md-6">
									  <select name='status' rows='5' id='status' code='{$status}' 
							class='select2 '    ></select> 
									 </div> 
									 <div class="col-md-2">
									 	
									 </div>
								  </div> 					
								  <div class="form-group  " >
									<label for="Note" class=" control-label col-md-4 text-left"> Note </label>
									<div class="col-md-6">
									  <textarea name='note' rows='2' id='note' class='form-control '  
				           >{{ $row['note'] }}</textarea> 
									 </div> 
									 <div class="col-md-2">
									 	
									 </div>
								  </div> 					
								  <div class="form-group  " >
									<label for="Phone" class=" control-label col-md-4 text-left"> Phone </label>
									<div class="col-md-6">
									  {{ Form::text('phone', $row['phone'],array('class'=>'form-control', 'placeholder'=>'',   )) }} 
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
				<button type="button" onclick="location.href='{{ URL::to('backer?md='.$masterdetail["filtermd"].$trackUri) }}' " id="submit" class="btn btn-success ">  {{ Lang::get('core.sb_cancel') }} </button>
				</div>	  
		
			  </div> 
		 
		 {{ Form::close() }}
		</div>
	</div>	
</div>	
</div>			 
   <script type="text/javascript">
	$(document).ready(function() { 
		
		$("#project_id").jCombo("{{ URL::to('backer/comboselect?filter=project:project_id:title') }}",
		{  selected_value : '{{ $row["project_id"] }}' });
		
		$("#project_id_alt").jCombo("{{ URL::to('backer/comboselect?filter=project:project_id:title') }}",
		{  selected_value : '{{ $row["project_id_alt"] }}' });
		
		$("#reward_id").jCombo("{{ URL::to('backer/comboselect?filter=reward:reward_id:reward_title') }}",
		{  selected_value : '{{ $row["reward_id"] }}' });
		
		$("#user_id").jCombo("{{ URL::to('backer/comboselect?filter=tb_users:id:email') }}",
		{  selected_value : '{{ $row["user_id"] }}' });
		
		$("#status").jCombo("{{ URL::to('backer/comboselect?filter=ms_status_backer:status_id:caption') }}",
		{  selected_value : '{{ $row["status"] }}' });
		 
	});
	</script>		 