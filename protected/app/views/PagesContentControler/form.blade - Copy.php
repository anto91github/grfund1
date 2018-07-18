
  <div class="page-content row">
    <!-- Page header -->
    <div class="page-header">
      <div class="page-title">
        <h3> {{ $pageTitle }} <small>{{ $pageNote }}</small></h3>
      </div>
      <ul class="breadcrumb">
        <li><a href="{{ URL::to('dashboard') }}">{{ Lang::get('core.home') }}</a></li>
		<li><a href="{{ URL::to('PagesContentControler?md='.$filtermd) }}">{{ $pageTitle }}</a></li>
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
		 {{ Form::open(array('url'=>'PagesContentControler/save/'.SiteHelpers::encryptID($row['id']).'?md='.$filtermd.$trackUri, 'class'=>'form-horizontal','files' => true , 'parsley-validate'=>'','novalidate'=>' ')) }}
				<div class="col-md-12">
						<fieldset><legend> Pages Content</legend>
									
								  <div class="form-group hidethis " style="display:none;">
									<label for="Id" class=" control-label col-md-4 text-left"> Id </label>
									<div class="col-md-6">
									  {{ Form::text('id', $row['id'],array('class'=>'form-control', 'placeholder'=>'',   )) }} 
									 </div> 
									 <div class="col-md-2">
									 	
									 </div>
								  </div> 					
								  <div class="form-group  " >
									<label for="Code" class="control-label col-md-1 text-left"> Code </label>
									<div class="col-md-6">
									  {{ Form::text('code', $row['code'],array('class'=>'form-control', 'placeholder'=>'',   )) }} 
									 </div> 
									 <div class="col-md-2">
									 	
									 </div>
								  </div> 					
								  <div class="form-group  " >
									<label for="Content" class=" control-label col-md-1 text-left"> Content </label>
									<div class="col-md-11">
									 <textarea name='content' id='content' class='form-control ' style="width: 100%;" 
						 >{{ $row['content'] }}</textarea>
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
				<button type="button" onclick="location.href='{{ URL::to('PagesContentControler?md='.$masterdetail["filtermd"].$trackUri) }}' " id="submit" class="btn btn-success ">  {{ Lang::get('core.sb_cancel') }} </button>
				</div>	  
		
			  </div> 
		 
		 {{ Form::close() }}
		</div>
	</div>	
</div>	
</div>	
    {{ HTML::script('sximo/js/plugins/ckeditor/ckeditor.js')}}
    {{ HTML::script('sximo/js/plugins/jquery-tags-input/jquery.tagsinput.min.js')}}
{{ HTML::style('sximo/js/plugins/jquery-tags-input/jquery.tagsinput.css')}}		 
   <script type="text/javascript">
	$(document).ready(function() { 
		 
		
		//$("#category").jCombo("{{ URL::to('project/comboselect?filter=ms_projectcategory:id:name') }}",
		//{  selected_value : '{{-- $row["category"] --}}' });
		
		
                
                CKEDITOR.replace( 'content', {
                    // Define the toolbar groups as it is a more accessible solution.
                    filebrowserBrowseUrl: '/grfund/browse',
                    filebrowserUploadUrl: '/grfund/upload',
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
                var handleTagsInput = function () {
                    if (!jQuery().tagsInput) {
                        return;
                    }
                    $('#project_tags').tagsInput({
                        width: 'auto',
                        'onAddTag': function () {
                            //alert(1);
                        },
                    });
                };
                handleTagsInput();
	});
	</script>	
	