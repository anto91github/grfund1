
  <div class="page-content row">
    <!-- Page header -->
    <div class="page-header">
      <div class="page-title">
        <h3> {{ $pageTitle }} <small>{{ $pageNote }}</small></h3>
      </div>
      <ul class="breadcrumb">
        <li><a href="{{ URL::to('dashboard') }}">{{ Lang::get('core.home') }}</a></li>
		<li><a href="{{ URL::to('project?md='.$filtermd) }}">{{ $pageTitle }}</a></li>
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
		 {{ Form::open(array('url'=>'project/save/'.SiteHelpers::encryptID($row['project_id']).'?md='.$filtermd.$trackUri, 'class'=>'form-horizontal','files' => true , 'parsley-validate'=>'','novalidate'=>' ')) }}
				<div class="col-md-12">
						<fieldset><legend> project</legend>
									
								  <div class="form-group hidethis " style="display:none;">
									<label for="Project Id" class=" control-label col-md-4 text-left"> Project Id </label>
									<div class="col-md-6">
									  {{ Form::text('project_id', $row['project_id'],array('class'=>'form-control', 'placeholder'=>'',   )) }} 
									 </div> 
									 <div class="col-md-2">
									 	
									 </div>
								  </div> 					
								  <div class="form-group  " >
									<label for="Title" class=" control-label col-md-4 text-left"> Title </label>
									<div class="col-md-6">
									  {{ Form::text('title', $row['title'],array('class'=>'form-control', 'placeholder'=>'',   )) }} 
									 </div> 
									 <div class="col-md-2">
									 	
									 </div>
								  </div>
								  <div class="form-group  " >
									<label for="Title" class=" control-label col-md-4 text-left"> Title En </label>
									<div class="col-md-6">
									  {{ Form::text('title_en', $row['title_en'],array('class'=>'form-control', 'placeholder'=>'',   )) }} 
									 </div> 
									 <div class="col-md-2">
									 	
									 </div>
								  </div>  					
								  <div class="form-group  " >
									<label for="Author" class=" control-label col-md-4 text-left"> Author </label>
									<div class="col-md-6">
									  <select name='author' rows='5' id='author' code='{$author}' 
							class='select2 '    ></select> 
									 </div> 
									 <div class="col-md-2">
									 	
									 </div>
								  </div> 					
								  <div class="form-group  " >
									<label for="Category" class=" control-label col-md-4 text-left"> Category * </label>
									<div class="col-md-6">										
										  @if($id == '')	
											<select name='category' id='category' code='{$category}'>
												<option value="0">--- Please Select ---</option>
												@foreach ($select_category as $sc)
													<option value="{{$sc->id}}">{{$sc->name}}</option>
												@endforeach
											</select>
										@else
											<select name='category' id='category' code='{$category}'>
												<option value="0">--- Please Select ---</option>
												@foreach ($select_category as $sc)
												<option value="{{$sc->id}}" 
													<?php
													if($select_edit->category == $sc->id)
														echo "selected";																												
													?>>
												{{$sc->name}}</option>
												@endforeach
											</select>

										@endif 
									 </div> 
									 <div class="col-md-2">									 	
									 </div>
								  </div> 					
								  <div class="form-group  " >
									<label for="Start Date" class=" control-label col-md-4 text-left"> Start Date </label>
									<div class="col-md-6">
									  
				{{ Form::text('start_date', $row['start_date'],array('class'=>'form-control date', 'style'=>'width:150px !important;')) }} 
									 </div> 
									 <div class="col-md-2">
									 	
									 </div>
								  </div> 	
									
									<div class="form-group  " >
									<label for="Labelid" class=" control-label col-md-4 text-left"> Label id * </label>
									<div class="col-md-6">										
										  @if($id == '')	
											<select name='labelid' id='labelid' code='{$labelid}'>
												<option value="0">--- Please Select ---</option>
												@foreach ($select_id as $sc)
													<option value="{{$sc->label_id}}">{{$sc->name}}</option>
												@endforeach
											</select>
										@else
											<select name='labelid' id='labelid' code='{$labelid}'>
												<option value="0">--- Please Select ---</option>
												@foreach ($select_edit_id as $sc)
												<option value="{{$sc->label_id}}" 
													<?php
													if($edit_id->label_id == $sc->label_id)
														echo "selected";																												
													?>>
												{{$sc->name}}</option>
												@endforeach
											</select>

										@endif 
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
									<label for="Small Content" class=" control-label col-md-4 text-left"> Small Content En </label>
									<div class="col-md-6">
									  {{ Form::text('small_content_en', $row['small_content_en'],array('class'=>'form-control', 'placeholder'=>'',   )) }} 
									 </div> 
									 <div class="col-md-2">
									 	
									 </div>
								  </div> 					
								  <!--<div class="form-group  " >
									<label for="Content" class=" control-label col-md-4 text-left"> Content </label>
									<div class="col-md-6">
									  <textarea name='content' rows='2' id='editor' class='form-control markItUp '  
						 >{{ $row['content'] }}</textarea> 
									 </div> 
									 <div class="col-md-2">
									 	
									 </div>
								  </div>--> 
								  <div class="form-group  " >
									<label for="Content" class=" control-label col-md-1 text-left"> Content </label>
									<div class="col-md-10">
									  <textarea name='content' rows='2' id='editor' class='form-control '>{{ $row['content'] }}</textarea> 
									 </div> 
									 <div class="col-md-1">
									 	
									 </div>
								  </div>
								  <div class="form-group  " >
									<label for="Content En" class=" control-label col-md-1 text-left"> Content En </label>
									<div class="col-md-10">
									  <textarea name='content2' rows='2' id='editor1' class='form-control '>{{ $row['content_en'] }}</textarea> 
									 </div> 
									 <div class="col-md-1">
									 	
									 </div>
								  </div>					
								  <div class="form-group  " >
									<label for="Due Date" class=" control-label col-md-4 text-left"> Due Date </label>
									<div class="col-md-6">
									  
				{{ Form::text('due_date', $row['due_date'],array('class'=>'form-control date', 'style'=>'width:150px !important;')) }} 
									 </div> 
									 <div class="col-md-2">
									 	
									 </div>
								  </div> 					
								  <div class="form-group  " >
									<label for="Banner Img" class=" control-label col-md-4 text-left"> Banner Img </label>
									<div class="col-md-6">
									  <input  type='file' name='banner_img' id='banner_img' @if($row['banner_img'] =='') class='required' @endif style='width:150px !important;'  />
					{{ SiteHelpers::showUploadedFile($row['banner_img'],'/uploads/banner/') }}
				 
									 </div> 
									 <div class="col-md-2">
									 	
									 </div>
								  </div> 					
								  <div class="form-group  " >
									<label for="Amount" class=" control-label col-md-4 text-left"> Amount <span class="asterix"> * </span></label>
									<div class="col-md-6">
									  {{ Form::text('amount', $row['amount'],array('class'=>'form-control', 'placeholder'=>'', 'required'=>'true', 'parsley-type'=>'number'   )) }} 
									 </div> 
									 <div class="col-md-2">
									 	
									 </div>
								  </div> 					
								  <div class="form-group  " >
									<label for="Fund Amount" class=" control-label col-md-4 text-left"> Fund Amount <span class="asterix"> * </span></label>
									<div class="col-md-6">
									  {{ Form::text('fund_amount', $row['fund_amount'],array('class'=>'form-control', 'placeholder'=>'', 'required'=>'true', 'parsley-type'=>'number'   )) }} 
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
									<label for="Subcategory" class=" control-label col-md-4 text-left"> Subcategory </label>
									<div class="col-md-6">
									  {{ Form::text('subcategory', $row['subcategory'],array('class'=>'form-control', 'placeholder'=>'',   )) }} 
									 </div> 
									 <div class="col-md-2">
									 	
									 </div>
								  </div> 					
								  <div class="form-group  " >
									<label for="Project Tags" class=" control-label col-md-4 text-left"> Project Tags </label>
									<div class="col-md-6">
									  {{ Form::text('project_tags', $row['project_tags'],array('class'=>'form-control', 'placeholder'=>'',   )) }} 
									 </div> 
									 <div class="col-md-2">
									 	
									 </div>
								  </div> 					
								  <div class="form-group  " >
									<label for="Recipient" class=" control-label col-md-4 text-left"> Recipient </label>
									<div class="col-md-6">
									  {{ Form::text('recipient', $row['recipient'],array('class'=>'form-control', 'placeholder'=>'',   )) }} 
									 </div> 
									 <div class="col-md-2">
									 	
									 </div>
								  </div> 					
								  <div class="form-group  " >
									<label for="Issue" class=" control-label col-md-4 text-left"> Issue </label>
									<div class="col-md-6">
									  <textarea name='issue' rows='2' id='issue' class='form-control '  
				           >{{ $row['issue'] }}</textarea> 
									 </div> 
									 <div class="col-md-2">
									 	
									 </div>
								  </div> 					
								  <div class="form-group  " >
									<label for="Who We Are" class=" control-label col-md-4 text-left"> Who We Are </label>
									<div class="col-md-6">
									  <textarea name='who_we_are' rows='2' id='who_we_are' class='form-control '  
				           >{{ $row['who_we_are'] }}</textarea> 
									 </div> 
									 <div class="col-md-2">
									 	
									 </div>
								  </div> 					
								  <div class="form-group  " >
									<label for="What Need" class=" control-label col-md-4 text-left"> What Need </label>
									<div class="col-md-6">
									  <textarea name='what_need' rows='2' id='what_need' class='form-control '  
				           >{{ $row['what_need'] }}</textarea> 
									 </div> 
									 <div class="col-md-2">
									 	
									 </div>
								  </div> 					
								  <div class="form-group  " >
									<label for="Impact" class=" control-label col-md-4 text-left"> Impact </label>
									<div class="col-md-6">
									  <textarea name='impact' rows='2' id='impact' class='form-control '  
				           >{{ $row['impact'] }}</textarea> 
									 </div> 
									 <div class="col-md-2">
									 	
									 </div>
								  </div> 					
								  <div class="form-group  " >
									<label for="Time Line" class=" control-label col-md-4 text-left"> Time Line </label>
									<div class="col-md-6">
									  <textarea name='time_line' rows='2' id='time_line' class='form-control '  
				           >{{ $row['time_line'] }}</textarea> 
									 </div> 
									 <div class="col-md-2">
									 	
									 </div>
								  </div> 					
								  <div class="form-group  " >
									<label for="Ack Reward" class=" control-label col-md-4 text-left"> Ack Reward </label>
									<div class="col-md-6">
									  <textarea name='ack_reward' rows='2' id='ack_reward' class='form-control '  
				           >{{ $row['ack_reward'] }}</textarea> 
									 </div> 
									 <div class="col-md-2">
									 	
									 </div>
								  </div> 					
								  <div class="form-group  " >
									<label for="Facebook" class=" control-label col-md-4 text-left"> Facebook </label>
									<div class="col-md-6">
									  {{ Form::text('facebook', $row['facebook'],array('class'=>'form-control', 'placeholder'=>'',   )) }} 
									 </div> 
									 <div class="col-md-2">
									 	
									 </div>
								  </div> 					
								  <div class="form-group  " >
									<label for="Facebook Id" class=" control-label col-md-4 text-left"> Facebook Id </label>
									<div class="col-md-6">
									  {{ Form::text('facebook_id', $row['facebook_id'],array('class'=>'form-control', 'placeholder'=>'',   )) }} 
									 </div> 
									 <div class="col-md-2">
									 	
									 </div>
								  </div> 					
								  <div class="form-group  " >
									<label for="Twitter" class=" control-label col-md-4 text-left"> Twitter </label>
									<div class="col-md-6">
									  {{ Form::text('twitter', $row['twitter'],array('class'=>'form-control', 'placeholder'=>'',   )) }} 
									 </div> 
									 <div class="col-md-2">
									 	
									 </div>
								  </div> 					
								  <div class="form-group  " >
									<label for="Twitter Id" class=" control-label col-md-4 text-left"> Twitter Id </label>
									<div class="col-md-6">
									  {{ Form::text('twitter_id', $row['twitter_id'],array('class'=>'form-control', 'placeholder'=>'',   )) }} 
									 </div> 
									 <div class="col-md-2">
									 	
									 </div>
								  </div> 					
								  <div class="form-group  " >
									<label for="Google" class=" control-label col-md-4 text-left"> Google </label>
									<div class="col-md-6">
									  {{ Form::text('google', $row['google'],array('class'=>'form-control', 'placeholder'=>'',   )) }} 
									 </div> 
									 <div class="col-md-2">
									 	
									 </div>
								  </div> 					
								  <div class="form-group  " >
									<label for="Google Id" class=" control-label col-md-4 text-left"> Google Id </label>
									<div class="col-md-6">
									  {{ Form::text('google_id', $row['google_id'],array('class'=>'form-control', 'placeholder'=>'',   )) }} 
									 </div> 
									 <div class="col-md-2">
									 	
									 </div>
								  </div> 					
								  <div class="form-group  " >
									<label for="Instagram" class=" control-label col-md-4 text-left"> Instagram </label>
									<div class="col-md-6">
									  {{ Form::text('instagram', $row['instagram'],array('class'=>'form-control', 'placeholder'=>'',   )) }} 
									 </div> 
									 <div class="col-md-2">
									 	
									 </div>
								  </div> 					
								  <div class="form-group  " >
									<label for="Instagram Id" class=" control-label col-md-4 text-left"> Instagram Id </label>
									<div class="col-md-6">
									  {{ Form::text('instagram_id', $row['instagram_id'],array('class'=>'form-control', 'placeholder'=>'',   )) }} 
									 </div> 
									 <div class="col-md-2">
									 	
									 </div>
								  </div> 					
								  <div class="form-group  " >
									<label for="Youtube" class=" control-label col-md-4 text-left"> Youtube </label>
									<div class="col-md-6">
									  {{ Form::text('youtube', $row['youtube'],array('class'=>'form-control', 'placeholder'=>'',   )) }} 
									 </div> 
									 <div class="col-md-2">
									 	
									 </div>
								  </div> 					
								  <div class="form-group  " >
									<label for="Youtube Id" class=" control-label col-md-4 text-left"> Youtube Id </label>
									<div class="col-md-6">
									  {{ Form::text('youtube_id', $row['youtube_id'],array('class'=>'form-control', 'placeholder'=>'',   )) }} 
									 </div> 
									 <div class="col-md-2">
									 	
									 </div>
								  </div> 					
								  <div class="form-group  " >
									<label for="Linkedin" class=" control-label col-md-4 text-left"> Linkedin </label>
									<div class="col-md-6">
									  {{ Form::text('linkedin', $row['linkedin'],array('class'=>'form-control', 'placeholder'=>'',   )) }} 
									 </div> 
									 <div class="col-md-2">
									 	
									 </div>
								  </div> 					
								  <div class="form-group  " >
									<label for="Linkedin Id" class=" control-label col-md-4 text-left"> Linkedin Id </label>
									<div class="col-md-6">
									  {{ Form::text('linkedin_id', $row['linkedin_id'],array('class'=>'form-control', 'placeholder'=>'',   )) }} 
									 </div> 
									 <div class="col-md-2">
									 	
									 </div>
								  </div> 					
								  <div class="form-group  " >
									<label for="Img Content1" class=" control-label col-md-4 text-left"> Img Content1 </label>
									<div class="col-md-6">
									  <input  type='file' name='img_content1' id='img_content1' @if($row['img_content1'] =='') class='required' @endif style='width:150px !important;'  />
					{{ SiteHelpers::showUploadedFile($row['img_content1'],'/uploads/project/') }}
				 
									 </div> 
									 <div class="col-md-2">
									 	
									 </div>
								  </div> 					
								  <div class="form-group  " >
									<label for="Img Content2" class=" control-label col-md-4 text-left"> Img Content2 </label>
									<div class="col-md-6">
									  <input  type='file' name='img_content2' id='img_content2' @if($row['img_content2'] =='') class='required' @endif style='width:150px !important;'  />
					{{ SiteHelpers::showUploadedFile($row['img_content2'],'/uploads/project/') }}
				 
									 </div> 
									 <div class="col-md-2">
									 	
									 </div>
								  </div> 					
								  <div class="form-group  " >
									<label for="Img Content3" class=" control-label col-md-4 text-left"> Img Content3 </label>
									<div class="col-md-6">
									  <input  type='file' name='img_content3' id='img_content3' @if($row['img_content3'] =='') class='required' @endif style='width:150px !important;'  />
					{{ SiteHelpers::showUploadedFile($row['img_content3'],'/uploads/project/') }}
				 
									 </div> 
									 <div class="col-md-2">
									 	
									 </div>
								  </div> 					
								  <div class="form-group  " >
									<label for="Url" class=" control-label col-md-4 text-left"> Url </label>
									<div class="col-md-6">
									  {{ Form::text('url', $row['url'],array('class'=>'form-control', 'placeholder'=>'',   )) }} 
									 </div> 
									 <div class="col-md-2">
									 	
									 </div>
								  </div> 					
								  <div class="form-group  " >
									<label for="Staff Pick" class=" control-label col-md-4 text-left"> Staff Pick </label>
									<div class="col-md-6">
									  <?php $staff_pick = explode(",",$row['staff_pick']); ?>
					 <label class='checked checkbox-inline'>   
					<input type='checkbox' name='staff_pick[]' value ='1'   class='' 
					@if(in_array('1',$staff_pick))checked @endif 
					 /> Staff Pick </label>  
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
				<button type="button" onclick="location.href='{{ URL::to('project?md='.$masterdetail["filtermd"].$trackUri) }}' " id="submit" class="btn btn-success ">  {{ Lang::get('core.sb_cancel') }} </button>
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
		
		$("#author").jCombo("{{ URL::to('project/comboselect?filter=tb_users:id:email') }}",
		{  selected_value : '{{ $row["author"] }}' });
		
		$("#status").jCombo("{{ URL::to('project/comboselect?filter=ms_status:status_id:status') }}",
		{  selected_value : '{{ $row["status"] }}' });

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
		CKEDITOR.replace( 'content2', {
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