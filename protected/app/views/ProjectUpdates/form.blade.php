
  <div class="page-content row">
    <!-- Page header -->
    <div class="page-header">
      <div class="page-title">
        <h3> {{ $pageTitle }} <small>{{ $pageNote }}</small></h3>
      </div>
      <ul class="breadcrumb">
        <li><a href="{{ URL::to('dashboard') }}">{{ Lang::get('core.home') }}</a></li>
		<li><a href="{{ URL::to('ProjectUpdates?md='.$filtermd) }}">{{ $pageTitle }}</a></li>
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
		 {{ Form::open(array('url'=>'ProjectUpdates/save/'.SiteHelpers::encryptID($row['post_id']).'?md='.$filtermd.$trackUri, 'class'=>'form-horizontal','files' => true , 'parsley-validate'=>'','novalidate'=>' ')) }}
				<div class="col-md-12">
						<fieldset><legend> Project Updates</legend>
									
								  <div class="form-group hidethis " style="display:none;">
									<label for="Post Id" class=" control-label col-md-4 text-left"> Post Id </label>
									<div class="col-md-6">
									  {{ Form::text('post_id', $row['post_id'],array('class'=>'form-control', 'placeholder'=>'',   )) }} 
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
									<label for="Post Date" class=" control-label col-md-4 text-left"> Post Date </label>
									<div class="col-md-6">
									  
				{{ Form::text('post_date', $row['post_date'],array('class'=>'form-control date', 'style'=>'width:150px !important;')) }} 
									 </div> 
									 <div class="col-md-2">
									 	
									 </div>
								  </div> 					
								  <div class="form-group  " >
									<label for="Post Header" class=" control-label col-md-4 text-left"> Post Header </label>
									<div class="col-md-6">
									  {{ Form::text('post_header', $row['post_header'],array('class'=>'form-control', 'placeholder'=>'',   )) }} 
									 </div> 
									 <div class="col-md-2">
									 	
									 </div>
								  </div> 					
								  <div class="form-group  " >
									<label for="Post Content" class=" control-label col-md-4 text-left"> Post Content </label>
									<!--<div class="col-md-6">
									  <textarea name='post_content' rows='2' id='editor' class='form-control markItUp '  
						 >{{ $row['post_content'] }}</textarea> 
									 </div>-->
									 <div class="col-md-6">
									  <textarea name='content' rows='2' id='editor' class='form-control '>{{ $row['post_content'] }}</textarea> 
									 </div> 
									 <div class="col-md-2">
									 	
									 </div>
								  </div> 					
								  <div class="form-group  " >
									<label for="Post Header En" class=" control-label col-md-4 text-left"> Post Header En </label>
									<div class="col-md-6">
									  {{ Form::text('post_header_en', $row['post_header_en'],array('class'=>'form-control', 'placeholder'=>'',   )) }} 
									 </div> 
									 <div class="col-md-2">
									 	
									 </div>
								  </div> 					
								  <div class="form-group  " >
									<label for="Post Content En" class=" control-label col-md-4 text-left"> Post Content En </label>
									<!--<div class="col-md-6">
									  {{ Form::text('post_content_en', $row['post_content_en'],array('class'=>'form-control', 'placeholder'=>'',   )) }} 
									 </div>-->
									 <div class="col-md-6">
									  <textarea name='content_en' rows='2' id='editor1' class='form-control '>{{ $row['post_content_en'] }}</textarea> 
									 </div> 
									 <div class="col-md-2">
									 	
									 </div>
								  </div> 					
								  <div class="form-group  " >
									<label for="Small Content" class=" control-label col-md-4 text-left"> Small Content </label>
									<div class="col-md-6">
									  {{ Form::text('small_content', $row['small_content'],array('class'=>'form-control', 'placeholder'=>'',   )) }} 
									 </div> 
									 <div class="col-md-2">
									 	
									 </div>
								  </div> 					
								  <div class="form-group  " >
									<label for="Small Content En" class=" control-label col-md-4 text-left"> Small Content En </label>
									<div class="col-md-6">
									  {{ Form::text('small_content_en', $row['small_content_en'],array('class'=>'form-control', 'placeholder'=>'',   )) }} 
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
				<button type="button" onclick="location.href='{{ URL::to('ProjectUpdates?md='.$masterdetail["filtermd"].$trackUri) }}' " id="submit" class="btn btn-success ">  {{ Lang::get('core.sb_cancel') }} </button>
				</div>	  
		
			  </div> 
		 
		 {{ Form::close() }}
		</div>
	</div>	
</div>	
</div>		
{{ HTML::script('sximo/js/plugins/ckeditor/ckeditor.js')}}	 
   <script type="text/javascript">
	$(document).ready(function() { 
		
		$("#project_id").jCombo("{{ URL::to('ProjectUpdates/comboselect?filter=project:project_id:title') }}",
		{  selected_value : '{{ $row["project_id"] }}' });

		CKEDITOR.replace( 'content', {
                    // Define the toolbar groups as it is a more accessible solution.
                    filebrowserBrowseUrl: '/browse',
                    filebrowserUploadUrl: '/upload',
                    toolbarGroups: [
                    {"name":"basicstyles","groups":["basicstyles"]},
                    {"name":"colors","groups":["colors"] },
                    {"name":"links","groups":["links"]},
                    {"name":"paragraph","groups":["list","blocks", "indent", "align"]},
                    {"name":"document","groups":["mode"]},
                    {"name":"insert","groups":["insert"]},
                    {"name":"styles","groups":["styles"]},
                    {"name":"about","groups":["about"]}
                    ],
                    // Remove the redundant buttons from toolbar groups defined above.
                    //removeButtons: 'Underline,Strike,Subscript,Superscript,Anchor,Styles,Specialchar'
                    removeButtons: 'Save,NewPage',
                    height:400
                } );

		CKEDITOR.replace( 'content_en', {
				    // Define the toolbar groups as it is a more accessible solution.
				    filebrowserBrowseUrl: '/browse',
				    filebrowserUploadUrl: '/upload',
				    toolbarGroups: [
				    {"name":"basicstyles","groups":["basicstyles"]},
				    {"name":"colors","groups":["colors"] },
				    {"name":"links","groups":["links"]},
				    {"name":"paragraph","groups":["list","blocks", "indent", "align"]},
				    {"name":"document","groups":["mode"]},
				    {"name":"insert","groups":["insert"]},
				    {"name":"styles","groups":["styles"]},
				    {"name":"about","groups":["about"]}
				    ],
				    // Remove the redundant buttons from toolbar groups defined above.
				    //removeButtons: 'Underline,Strike,Subscript,Superscript,Anchor,Styles,Specialchar'
				    removeButtons: 'Save,NewPage',
				    height:400
				} );
		 
	});
	</script>		 