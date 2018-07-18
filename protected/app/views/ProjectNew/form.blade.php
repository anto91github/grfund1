
  <div class="page-content row">
    <!-- Page header -->
    <div class="page-header">
      <div class="page-title">
        <h3> {{ $pageTitle }} <small>{{ $pageNote }}</small></h3>
      </div>
      <ul class="breadcrumb">
        <li><a href="{{ URL::to('dashboard') }}">{{ Lang::get('core.home') }}</a></li>
		<li><a href="{{ URL::to('ProjectNew?md='.$filtermd) }}">{{ $pageTitle }}</a></li>
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
		 {{ Form::open(array('url'=>'ProjectNew/save/'.SiteHelpers::encryptID($row['project_id']).'?md='.$filtermd.$trackUri, 'class'=>'form-horizontal','files' => true , 'parsley-validate'=>'','novalidate'=>' ')) }}
				<div class="col-md-12">
						<fieldset><legend> ProjectNew</legend>
									
								  <div class="form-group  " >
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
									<label for="Author" class=" control-label col-md-4 text-left"> Author </label>
									<div class="col-md-6">
									  {{ Form::text('author', $row['author'],array('class'=>'form-control', 'placeholder'=>'',   )) }} 
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
									  {{ Form::text('start_date', $row['start_date'],array('class'=>'form-control', 'placeholder'=>'',   )) }} 
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
									<label for="Content" class=" control-label col-md-4 text-left"> Content </label>
									<div class="col-md-6">
									  {{ Form::text('content', $row['content'],array('class'=>'form-control', 'placeholder'=>'',   )) }} 
									 </div> 
									 <div class="col-md-2">
									 	
									 </div>
								  </div> 					
								  <div class="form-group  " >
									<label for="Content En" class=" control-label col-md-4 text-left"> Content En </label>
									<div class="col-md-6">
									  {{ Form::text('content_en', $row['content_en'],array('class'=>'form-control', 'placeholder'=>'',   )) }} 
									 </div> 
									 <div class="col-md-2">
									 	
									 </div>
								  </div> 					
								  <div class="form-group  " >
									<label for="Due Date" class=" control-label col-md-4 text-left"> Due Date </label>
									<div class="col-md-6">
									  {{ Form::text('due_date', $row['due_date'],array('class'=>'form-control', 'placeholder'=>'',   )) }} 
									 </div> 
									 <div class="col-md-2">
									 	
									 </div>
								  </div> 					
								  <div class="form-group  " >
									<label for="Banner Img" class=" control-label col-md-4 text-left"> Banner Img </label>
									<div class="col-md-6">
									  {{ Form::text('banner_img', $row['banner_img'],array('class'=>'form-control', 'placeholder'=>'',   )) }} 
									 </div> 
									 <div class="col-md-2">
									 	
									 </div>
								  </div> 					
								  <div class="form-group  " >
									<label for="Amount" class=" control-label col-md-4 text-left"> Amount </label>
									<div class="col-md-6">
									  {{ Form::text('amount', $row['amount'],array('class'=>'form-control', 'placeholder'=>'',   )) }} 
									 </div> 
									 <div class="col-md-2">
									 	
									 </div>
								  </div> 					
								  <div class="form-group  " >
									<label for="Fund Amount" class=" control-label col-md-4 text-left"> Fund Amount </label>
									<div class="col-md-6">
									  {{ Form::text('fund_amount', $row['fund_amount'],array('class'=>'form-control', 'placeholder'=>'',   )) }} 
									 </div> 
									 <div class="col-md-2">
									 	
									 </div>
								  </div> 					
								  <div class="form-group  " >
									<label for="Status" class=" control-label col-md-4 text-left"> Status </label>
									<div class="col-md-6">
									  {{ Form::text('status', $row['status'],array('class'=>'form-control', 'placeholder'=>'',   )) }} 
									 </div> 
									 <div class="col-md-2">
									 	
									 </div>
								  </div> 					
								  <div class="form-group  " >
									<label for="Created Date" class=" control-label col-md-4 text-left"> Created Date </label>
									<div class="col-md-6">
									  
				{{ Form::text('created_date', $row['created_date'],array('class'=>'form-control datetime', 'style'=>'width:150px !important;')) }} 
									 </div> 
									 <div class="col-md-2">
									 	
									 </div>
								  </div> 					
								  <div class="form-group  " >
									<label for="Modified By" class=" control-label col-md-4 text-left"> Modified By </label>
									<div class="col-md-6">
									  {{ Form::text('modified_by', $row['modified_by'],array('class'=>'form-control', 'placeholder'=>'',   )) }} 
									 </div> 
									 <div class="col-md-2">
									 	
									 </div>
								  </div> 					
								  <div class="form-group  " >
									<label for="Modified Date" class=" control-label col-md-4 text-left"> Modified Date </label>
									<div class="col-md-6">
									  
				{{ Form::text('modified_date', $row['modified_date'],array('class'=>'form-control datetime', 'style'=>'width:150px !important;')) }} 
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
									<label for="Project Alias" class=" control-label col-md-4 text-left"> Project Alias </label>
									<div class="col-md-6">
									  {{ Form::text('project_alias', $row['project_alias'],array('class'=>'form-control', 'placeholder'=>'',   )) }} 
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
									  {{ Form::text('issue', $row['issue'],array('class'=>'form-control', 'placeholder'=>'',   )) }} 
									 </div> 
									 <div class="col-md-2">
									 	
									 </div>
								  </div> 					
								  <div class="form-group  " >
									<label for="Who We Are" class=" control-label col-md-4 text-left"> Who We Are </label>
									<div class="col-md-6">
									  {{ Form::text('who_we_are', $row['who_we_are'],array('class'=>'form-control', 'placeholder'=>'',   )) }} 
									 </div> 
									 <div class="col-md-2">
									 	
									 </div>
								  </div> 					
								  <div class="form-group  " >
									<label for="What Need" class=" control-label col-md-4 text-left"> What Need </label>
									<div class="col-md-6">
									  {{ Form::text('what_need', $row['what_need'],array('class'=>'form-control', 'placeholder'=>'',   )) }} 
									 </div> 
									 <div class="col-md-2">
									 	
									 </div>
								  </div> 					
								  <div class="form-group  " >
									<label for="Impact" class=" control-label col-md-4 text-left"> Impact </label>
									<div class="col-md-6">
									  {{ Form::text('impact', $row['impact'],array('class'=>'form-control', 'placeholder'=>'',   )) }} 
									 </div> 
									 <div class="col-md-2">
									 	
									 </div>
								  </div> 					
								  <div class="form-group  " >
									<label for="Time Line" class=" control-label col-md-4 text-left"> Time Line </label>
									<div class="col-md-6">
									  {{ Form::text('time_line', $row['time_line'],array('class'=>'form-control', 'placeholder'=>'',   )) }} 
									 </div> 
									 <div class="col-md-2">
									 	
									 </div>
								  </div> 					
								  <div class="form-group  " >
									<label for="Ack Reward" class=" control-label col-md-4 text-left"> Ack Reward </label>
									<div class="col-md-6">
									  {{ Form::text('ack_reward', $row['ack_reward'],array('class'=>'form-control', 'placeholder'=>'',   )) }} 
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
									  {{ Form::text('img_content1', $row['img_content1'],array('class'=>'form-control', 'placeholder'=>'',   )) }} 
									 </div> 
									 <div class="col-md-2">
									 	
									 </div>
								  </div> 					
								  <div class="form-group  " >
									<label for="Img Content2" class=" control-label col-md-4 text-left"> Img Content2 </label>
									<div class="col-md-6">
									  {{ Form::text('img_content2', $row['img_content2'],array('class'=>'form-control', 'placeholder'=>'',   )) }} 
									 </div> 
									 <div class="col-md-2">
									 	
									 </div>
								  </div> 					
								  <div class="form-group  " >
									<label for="Img Content3" class=" control-label col-md-4 text-left"> Img Content3 </label>
									<div class="col-md-6">
									  {{ Form::text('img_content3', $row['img_content3'],array('class'=>'form-control', 'placeholder'=>'',   )) }} 
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
									  {{ Form::text('staff_pick', $row['staff_pick'],array('class'=>'form-control', 'placeholder'=>'',   )) }} 
									 </div> 
									 <div class="col-md-2">
									 	
									 </div>
								  </div> 					
								  <div class="form-group  " >
									<label for="Widget Id" class=" control-label col-md-4 text-left"> Widget Id </label>
									<div class="col-md-6">
									  {{ Form::text('widget_id', $row['widget_id'],array('class'=>'form-control', 'placeholder'=>'',   )) }} 
									 </div> 
									 <div class="col-md-2">
									 	
									 </div>
								  </div> 					
								  <div class="form-group  " >
									<label for="NPWP" class=" control-label col-md-4 text-left"> NPWP </label>
									<div class="col-md-6">
									  {{ Form::text('NPWP', $row['NPWP'],array('class'=>'form-control', 'placeholder'=>'',   )) }} 
									 </div> 
									 <div class="col-md-2">
									 	
									 </div>
								  </div> 					
								  <div class="form-group  " >
									<label for="KTP" class=" control-label col-md-4 text-left"> KTP </label>
									<div class="col-md-6">
									  {{ Form::text('KTP', $row['KTP'],array('class'=>'form-control', 'placeholder'=>'',   )) }} 
									 </div> 
									 <div class="col-md-2">
									 	
									 </div>
								  </div> 					
								  <div class="form-group  " >
									<label for="SIUP" class=" control-label col-md-4 text-left"> SIUP </label>
									<div class="col-md-6">
									  {{ Form::text('SIUP', $row['SIUP'],array('class'=>'form-control', 'placeholder'=>'',   )) }} 
									 </div> 
									 <div class="col-md-2">
									 	
									 </div>
								  </div> 					
								  <div class="form-group  " >
									<label for="Domicile" class=" control-label col-md-4 text-left"> Domicile </label>
									<div class="col-md-6">
									  {{ Form::text('Domicile', $row['Domicile'],array('class'=>'form-control', 'placeholder'=>'',   )) }} 
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
				<button type="button" onclick="location.href='{{ URL::to('ProjectNew?md='.$masterdetail["filtermd"].$trackUri) }}' " id="submit" class="btn btn-success ">  {{ Lang::get('core.sb_cancel') }} </button>
				</div>	  
		
			  </div> 
		 
		 {{ Form::close() }}
		</div>
	</div>	
</div>	
</div>			 
   <script type="text/javascript">
	$(document).ready(function() { 
		 
	});
	</script>		 