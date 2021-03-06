<div class="wrapper-header ">
    <div class=" container">
		<div class="col-sm-6 col-xs-6">
		  <div class="page-title">
			<h3> Manage Project</h3>
		  </div>
		</div>
		<div class="col-sm-6 col-xs-6 ">
		  <ul class="breadcrumb pull-right">
			<li><a href="{{ URL::to('') }}">Home</a></li>
                        <li><a href="{{ URL::to('account') }}">Account</a></li>
			<li class="active">Manage Project </li>
		  </ul>		
		</div>
		  
    </div>
</div>	
<div class="container" >
    <div class="col-md-8" id="containerInput">
        <ul class="nav nav-pills">
            <li {{ $tab == 1 ? "class='active'" : "" }} >
                    <a href="#tabGeneral" data-toggle="tab">
                    General </a>
            </li>
            <li {{ $tab == 2 ? "class='active'" : "" }}>
                    <a href="#tabContent" data-toggle="tab">
                    Content </a>
            </li>
            <li {{ $tab == 3 ? "class='active'" : "" }}>
                    <a href="#tabReward" data-toggle="tab">
                    Reward </a>
            </li>
        </ul>
        <div class="tab-content" style="padding-left:0px; padding-right:0px;">
            <div class="tab-pane fade {{ $tab == 1  ? "active" : "" }} in" id="tabGeneral">
                {{ Form::open(array('url'=>'manage-project/updateproject','files'=>true, 'id'=>'formGeneral' )) }}
                <!--<form id="formCreateProject" method="POST" action="#" class='form-horizontal form-row-seperated'>-->
                <div id="container-general" style='border:1px solid #5d5d5d; box-shadow: 6px 6px 5px #888888; height:auto;'>
                    <div style='color:#fff; background-color: #404040; padding:10px; padding-left:30px;'>
                        <span style='font-size:18px;'>General Information</span>
                    </div>
                    <div class="alert alert-danger display-hide">
                            <button class="close" data-close="alert"></button>
                            You have some form errors. Please check below.
                    </div>
                    <div class="alert alert-success display-hide">
                            <button class="close" data-close="alert"></button>
                            Your form validation is successful!
                    </div>
                    <div class="form-horizontal" style="margin-top:20px; padding:0px 5px 0px 5px;">
                        <div class="form-group">
                            <label class="col-xs-12 col-md-3 control-label">Category</label>
                            <div class='col-xs-12 col-md-8'>
                            <select name="categoryselect" id="categoryselect" class="bs-select form-control" data-show-subtext="true">
                                 @foreach($category as $cat)
                                    <option value="{{$cat->id}}" {{ $project->category == $cat->id? 'selected="selected"' : '' }} >{{$cat->name}}</option>
                                 @endforeach
                                <!--<option value="art" {{ $project->subcategory == 'art'? 'selected="selected"' : '' }} data-icon="fa-lightbulb-o fa-lg option-color">Art & Creative</option>
                                <option value="business" {{ $project->subcategory == 'business'? 'selected="selected"' : '' }} data-icon="fa-envelope fa-lg option-color">Business / Startup</option>
                                <option value="charity" {{ $project->subcategory == 'charity'? 'selected="selected"' : '' }} data-icon="fa-envelope fa-lg option-color">Charity</option>
                                <option value="community" {{ $project->subcategory == 'community'? 'selected="selected"' : '' }} data-icon="fa-envelope fa-lg option-color">Community</option>
                                <option value="education" {{ $project->subcategory == 'education'? 'selected="selected"' : '' }} data-icon="fa-envelope fa-lg option-color">Education</option>
                                <option value="emergency" {{ $project->subcategory == 'emergency'? 'selected="selected"' : '' }} data-icon="fa-envelope fa-lg option-color">Emergency</option>
                                <option value="environment" {{ $project->subcategory == 'environment'? 'selected="selected"' : '' }} data-icon="fa-envelope fa-lg option-color">Environment</option>
                                <option value="event" {{ $project->subcategory == 'event'? 'selected="selected"' : '' }} data-icon="fa-envelope fa-lg option-color">Event</option>
                                <option value="family" {{ $project->subcategory == 'family'? 'selected="selected"' : '' }} data-icon="fa-envelope fa-lg option-color">Family</option>
                                <option value="health" {{ $project->subcategory == 'health'? 'selected="selected"' : '' }} data-icon="fa-envelope fa-lg option-color">Health</option>
                                <option value="sport" {{ $project->subcategory == 'sport'? 'selected="selected"' : '' }} data-icon="fa-envelope fa-lg option-color">Sport</option>
                                <option value="technology" {{ $project->subcategory == 'technology'? 'selected="selected"' : '' }} data-icon="fa-envelope fa-lg option-color">Technology</option>-->
                            
                            </select>
                                <input type='hidden' id="projectId" name="projectId" value="{{ $project->project_id }}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Project Name <span class="required color-red">*</span></label>
                            <div class='col-md-8'>
                                <input type="text" name="projectName" id='projectName' class="form-control" placeholder="Enter project name" value="{{ $project->title }}">
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label class="col-md-3 control-label">Amount <span class="required color-red">*</span></label>
                            <div class='col-md-8'>
                                <input class="form-control" name="mask_currency" id="mask_currency" type="text" value="{{ $project->amount }}"/>
                                <span class="help-block">123456 => Rp ___.123.456 </span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">End Date <span class="required color-red">*</span></label>
                            <div class='col-md-8'>
                                <input name="projectEndDate" id="projectEndDate" class="form-control form-control-inline input-medium date-picker" size="16" type="text" value="{{ $project->enddate }}"/>
                                <span class="help-block">
                                Select date </span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Tags </label>
                            <div class='col-md-8'>
                                <input id="projectTags" name="projectTags" type="text" class="form-control tags" value="{{ str_replace("|",",",$project->project_tags) }}"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Project Photo <span class="required color-red">*</span></label>
                            <div class='col-md-8'>
                                <div class="fileinput fileinput-exists" data-provides="fileinput">
                                    <div class="fileinput-new thumbnail" style="width: 200px; height: 150px;"><img src="../images/default_project.jpg" /></div>
                                    <div id="containerThumbnail" class="fileinput-preview fileinput-exists thumbnail" data-trigger="fileinput" style="width: 200px; height: 150px;">
                                        <img src="../uploads/banner/{{ $project->banner_img }}" alt="{{ $project->banner_img }}">
                                        </div>
                                        <div>
                                                <span class="btn default btn-file">
                                                <!--<span class="fileinput-new">
                                                Select image </span>-->
                                                <button type="button" class="btn btn-primary fileinput-new">Select Image</button>
                                                <!--<span class="fileinput-exists">
                                                Change </span>-->
                                                <button type="button" class="btn btn-default fileinput-exists">Change </button>
                                                <input type="file" id='projectPhoto' name="projectPhoto">
                                                </span>
                                                <!--
                                                <a href="#" class="btn red fileinput-exists" data-dismiss="fileinput">
                                                Remove </a>-->
                                                <button type="button" class="btn btn-danger fileinput-exists" data-dismiss="fileinput">Remove </button>
                                        </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Small Content <span class="required color-red">*</span></label>
                            <div class='col-md-8'>
                                <textarea id="editor1" name="editor1" class="form-control" maxlength="100" rows="2" placeholder="This textarea has a limit of 100 chars.">{{ $project->small_content }}</textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Widget</label>
                            <div class='col-md-8'>
                                <input class="form-control" name="widget_id" id="widget_id" type="text" value="<iframe src='http://localhost/grfund/widgetShow/{{$project->project_alias}}' frameborder='0' height='465' width='265' scrolling='no'>" readonly/>
                            </div>
                        </div>
                        <div class="form-group">
                                <div class="col-md-offset-3 col-md-8">
                                    <button type="button" id="save-banner" class="btn btn-primary">Save</button> <a href="account" class="btn btn-default" >Cancel</a>
                                </div>
                        </div>
                    </div>
                    <br/>
                    <br/>
                </div>
                <!--</form>-->
                {{ Form::close() }}
            </div>
            <div class='tab-pane {{ $tab == 2 ? "active" : "" }} fade in' id="tabContent">
                {{ Form::open(array('url'=>'manage-project/updatecontent', 'files'=>true, 'id'=>'formContent' )) }}
                <!--<form id="formCreateProject" method="POST" action="#" class='form-horizontal form-row-seperated'>-->
                <div id="container-content" style='border:1px solid #5d5d5d; box-shadow: 6px 6px 5px #888888; height:auto;'>
                    <div style='color:#fff; background-color: #404040; padding:10px; padding-left:30px;'>
                        <span style='font-size:18px;'>Content</span>
                    </div>
                    <div class="alert alert-danger display-hide">
                            <button class="close" data-close="alert"></button>
                            You have some form errors. Please check below.
                    </div>
                    <div class="alert alert-success display-hide">
                            <button class="close" data-close="alert"></button>
                            Your form validation is successful!
                    </div>
                    <div class="form-horizontal" style="margin-top:20px; padding:0px 10px 0px 10px;">
                        <div class="form-group">
                            <div class='col-xs-12 col-md-12'>
                                <!--<textarea id="editorContent" name="editorContent" class="form-control " rows="8" placeholder="Content Project.">{{ $project->content }}</textarea>-->
                                <input type='hidden' id="projectId" name="projectId" value="{{ $project->project_id }}">
                                
                                <div class="form-horizontal" style="margin-top:20px; padding:0px 10px 0px 10px;">
                        <div class="form-group">
                            <div class="col-xs-12 col-md-12"><h5 style="font-family: 'Helvetica'; font-weight:700;">Issue statement:</h5> <p>Highlight the key issue to grab the public's interest and attention</p>
                                                            
                            </div>
                            <div class='col-xs-12 col-md-12'>
                                <textarea class="form-control" rows="4" name="issue" id="issue" placeholder="Issue statement">{{ $project->issue }}</textarea>
                                <hr>
                            </div>

                            <div class="col-xs-12 col-md-12"><h5 style="font-family: 'Helvetica'; font-weight:700;">Who we are:</h5> <p>Introduce your Organization / Small Business and your background.</p>
                                                            
                            </div>
                            <div class='col-xs-12 col-md-12'>
                                <textarea class="form-control" rows="4" name="who" id="who" placeholder="Who we are">{{ $project->who_we_are }}</textarea>
                                <hr>
                            </div>
                            

                            <div class="col-xs-12 col-md-12"><h5 style="font-family: 'Helvetica'; font-weight:700;">What We Need:</h5> <p>Explain how much funding you need and where it's going. Be transparent and specific-people need to trust you to want to fund you</p>
                                                            
                            </div>
                            <div class='col-xs-12 col-md-12'>
                                <textarea class="form-control" rows="4" name="need" id="need" placeholder="What We Need">{{ $project->what_need }}</textarea>
                                <hr>
                            </div>

                            <div class="col-xs-12 col-md-12"><h5 style="font-family: 'Helvetica'; font-weight:700;">The Impact: </h5><p>Explain more about your campaign and let people know how the difference their contribution will make</p>
                                                            
                            </div>
                            <div class='col-xs-12 col-md-12'>
                                <textarea class="form-control" rows="4" name="impact" id="impact" placeholder="The Impact">{{ $project->impact }}</textarea>
                                <hr>
                            </div>

                            

                            <div class="col-xs-12 col-md-12"><h5 style="font-family: 'Helvetica'; font-weight:700;">Time Line: </h5><p>Provide a plan on how the money will be spent if successful</p>
                                                            
                            </div>
                            <div class='col-xs-12 col-md-12'>
                                <textarea class="form-control" rows="4" name="time_line" id="time_line" placeholder="Time Line">{{ $project->time_line }}</textarea>
                                <hr>
                            </div>

                            <div class="col-xs-12 col-md-12"><h5 style="font-family: 'Helvetica'; font-weight:700;">Acknowledgements / rewards :</h5> <p>Tell people about your unique acknowledgements / rewards they will receive for their donations.</p>
                                                            
                            </div>
                            <div class='col-xs-12 col-md-12'>
                                <textarea class="form-control" rows="4" name="ack" id="ack" placeholder="Acknowledgements / rewards ">{{ $project->ack_reward }}</textarea>
                                <hr>
                            </div>

                            <div class="col-xs-12 col-md-12"><h5 style="font-family: 'Helvetica'; font-weight:700;">Additional Links :</h5> 
                                <p>Increase your project’s integrity by providing links to social media pages or sites related to your campaign</p>
                                                           
                            </div>
                            <div class='col-xs-12 col-md-12'>
                                <div class="row">
                                    <div class="col-md-1">Facebook:</div>
                                    <div class="col-md-3" style="padding-bottom:5px"><input type="text" id= "facebook" name="facebook" value="{{ $project->facebook }}"></div>
                                    
                                    <div class="col-md-2">Facebook ID:</div>
                                    <div class="col-md-6" style="padding-bottom:5px"><input type="text" name="facebook_id" value="{{ $project->facebook_id }}"><a href="" style="color:blue;">&nbsp;(How to get your Facebook ID)</a></div>
                                </div>
                                <div class="row">
                                    <div class="col-md-1">Twitter:</div>
                                    <div class="col-md-3" style="padding-bottom:5px"><input type="text" id="twitter" name="twitter" value="{{ $project->twitter }}"></div>
                                    <div class="col-md-2">Twitter ID:</div>
                                    <div class="col-md-6" style="padding-bottom:5px"><input type="text" name="twitter_id" value="{{ $project->twitter_id }}"><a href="" style="color:blue;">&nbsp;(How to get your Twitter ID)</a></div>
                                </div>
                                <div class="row">
                                    <div class="col-md-1">Google+:</div>
                                    <div class="col-md-3" style="padding-bottom:5px"><input type="text" id= "google" name="google" value="{{ $project->google }}"></div>
                                    <div class="col-md-2">Google ID:</div>
                                    <div class="col-md-6" style="padding-bottom:5px"><input type="text" name="google_id" value="{{ $project->google_id }}"><a href="" style="color:blue;">&nbsp;(How to get your Google ID)</a></div>
                                </div>
                                <div class="row">
                                    <div class="col-md-1">Instagram:</div>
                                    <div class="col-md-3" style="padding-bottom:5px"><input type="text" id= "instagram" name="instagram" value="{{ $project->instagram }}"></div>
                                    <div class="col-md-2">Instagram ID:</div>
                                    <div class="col-md-6" style="padding-bottom:5px"><input type="text" name="instagram_id" value="{{ $project->instagram_id }}"><a href="" style="color:blue;">&nbsp;(How to get your Instagram ID)</a></div>
                                </div>
                                <div class="row">
                                    <div class="col-md-1">Youtube:</div>
                                    <div class="col-md-3" style="padding-bottom:5px"><input type="text" id="youtube" name="youtube" value="{{ $project->youtube }}"></div>
                                    <div class="col-md-2">Youtube ID:</div>
                                    <div class="col-md-6" style="padding-bottom:5px"><input type="text" name="youtube_id" value="{{ $project->youtube_id }}"><a href="" style="color:blue;">&nbsp;(How to get your Youtube ID)</a></div>
                                </div>
                               
                                <div class="row">
                                    <div class="col-md-1">LinkedIn:</div>
                                    <div class="col-md-3" style="padding-bottom:5px"><input type="text" id="linkedin" name="linkedin" value="{{ $project->linkedin }}"></div>
                                    <div class="col-md-2">LinkedIn ID:</div>
                                    <div class="col-md-6" style="padding-bottom:5px"><input type="text" name="linkedin_id" value="{{ $project->linkedin_id }}"><a href="" style="color:blue;">&nbsp;(How to get your Linkedin ID)</a></div>
                                </div>
                            <hr>
                            </div>

                            <div class="col-xs-12 col-md-12"><h5 style="font-family: 'Helvetica'; font-weight:700;">Content Image</h5></div>
                            <div class='col-xs-12 col-md-12'>
                                    <div class="col-md-4">
                                        <div class="fileinput fileinput-exists" data-provides="fileinput">
                                            <div class="fileinput-new thumbnail" style="width: 200px; height: 150px;">{{ HTML::image('uploads/project/default_project.jpg') }}</div>
                                            <div id="containerThumbnail1" class="fileinput-preview fileinput-exists thumbnail tb1" data-trigger="fileinput" style="width: 200px; height: 150px;">
                                                 <img src="../uploads/project/{{ $project->img_content1 }}" alt="{{ $project->img_content1 }}">
                                            </div>
                                            
                                                <div>
                                                    <span class="btn default btn-file">
                                                    <!--<span class="fileinput-new">
                                                    Select image </span>-->
                                                    <button type="button" class="btn btn-primary fileinput-new">{{ Lang::get('core.cp_photo_select'); }}</button>
                                                    <!--<span class="fileinput-exists">
                                                    Change </span>-->
                                                    <button type="button" class="btn btn-default fileinput-exists">{{ Lang::get('core.cp_photo_change'); }} </button>
                                                    <input type="file" id='photo1' name="photo1">
                                                    </span>
                                                    <!--
                                                    <a href="#" class="btn red fileinput-exists" data-dismiss="fileinput">
                                                    Remove </a>-->
                                                    <button type="button" class="btn btn-danger fileinput-exists" data-dismiss="fileinput">{{ Lang::get('core.cp_photo_remove'); }} </button>
                                                </div>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="fileinput fileinput-exists" data-provides="fileinput">
                                            <div class="fileinput-new thumbnail" style="width: 200px; height: 150px;"><img src="../images/default_project.jpg" /></div>
                                            <div id="containerThumbnail2" class="fileinput-preview fileinput-exists thumbnail tb2" data-trigger="fileinput" style="width: 200px; height: 150px;">
                                                <img src="../uploads/project/{{ $project->img_content2 }}" alt="{{ $project->img_content2 }}">
                                            </div>
                                                <div>
                                                    <span class="btn default btn-file">
                                                    <!--<span class="fileinput-new">
                                                    Select image </span>-->
                                                    <button type="button" class="btn btn-primary fileinput-new">{{ Lang::get('core.cp_photo_select'); }}</button>
                                                    <!--<span class="fileinput-exists">
                                                    Change </span>-->
                                                    <button type="button" class="btn btn-default fileinput-exists">{{ Lang::get('core.cp_photo_change'); }} </button>
                                                    <input type="file" id='photo2' name="photo2">
                                                    </span>
                                                    <!--
                                                    <a href="#" class="btn red fileinput-exists" data-dismiss="fileinput">
                                                    Remove </a>-->
                                                    <button type="button" class="btn btn-danger fileinput-exists" data-dismiss="fileinput">{{ Lang::get('core.cp_photo_remove'); }} </button>
                                                </div>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="fileinput fileinput-exists" data-provides="fileinput">
                                            <div class="fileinput-new thumbnail" style="width: 200px; height: 150px;"><img src="../images/default_project.jpg" /></div>
                                            <div id="containerThumbnail3" class="fileinput-preview fileinput-exists thumbnail tb3" data-trigger="fileinput" style="width: 200px; height: 150px;">
                                                 <img src="../uploads/project/{{ $project->img_content3 }}" alt="{{ $project->img_content3 }}">
                                            </div>
                                                <div>
                                                    <span class="btn default btn-file">
                                                    <!--<span class="fileinput-new">
                                                    Select image </span>-->
                                                    <button type="button" class="btn btn-primary fileinput-new">{{ Lang::get('core.cp_photo_select'); }}</button>
                                                    <!--<span class="fileinput-exists">
                                                    Change </span>-->
                                                    <button type="button" class="btn btn-default fileinput-exists">{{ Lang::get('core.cp_photo_change'); }} </button>
                                                    <input type="file" id='photo3' name="photo3">
                                                    </span>
                                                    <!--
                                                    <a href="#" class="btn red fileinput-exists" data-dismiss="fileinput">
                                                    Remove </a>-->
                                                    <button type="button" class="btn btn-danger fileinput-exists" data-dismiss="fileinput">{{ Lang::get('core.cp_photo_remove'); }} </button>
                                                </div>
                                        </div>

                                    </div>

                            </div>

                                <div class="col-xs-12 col-md-12"><h5 style="font-family: 'Helvetica'; font-weight:700;"><hr>Video URL:</h5><p>Share your Video URL</p>                                                      
                                </div>
                                <div class='col-xs-12 col-md-12'>
                                    <div class="row">    
                                        <div class="col-md-2">URL:</div>
                                        <div class="col-md-10"><input type="text" name="url" id="url" style="width:250px;" value="{{$project->url}}"></div>
                                    </div>
                                    <hr>
                                </div>
                        </div>
                        <div class="form-group">
                                <div class="col-md-12" align="right">
                                    <button type="button" id="previewContent" class="btn btn-primary">Preview</button>
                                    <!--<button type="submit" id="start-next" class="btn btn-primary">Submit</button>-->
                                    <button type="button" id="start-next" class="btn btn-primary">Save Content</button>
                                </div>
                        </div>
                    </div>
                            </div>
                        </div>
                        <!--<div class="form-group">
                                <div class="col-md-12" >
                                    <button type="submit" class="btn btn-primary">Save Content</button>
                                </div>
                        </div>-->
                    </div>
                    <br/>
                    <br/>
                </div>
                <!--</form>-->
                {{ Form::close() }}
            </div>
            <div class='tab-pane {{ $tab == 3 ? "active" : "" }} fade in' id="tabReward">
                <!--<form id="formCreateProject" method="POST" action="#" class='form-horizontal form-row-seperated'>-->
                <div id="container-reward" style='border:1px solid #5d5d5d; box-shadow: 6px 6px 5px #888888; height:auto;'>
                    <div style='color:#fff; background-color: #404040; padding:10px; padding-left:30px;'>
                        <span style='font-size:18px;'>Reward</span>
                    </div>
                    @foreach($rewards as $reward)
                    {{ Form::open(array('url'=>'manage-project/updatereward', 'files'=>true, 'id'=>'formReward'.$reward->reward_id, 'class'=>'formReward','data-id'=>$reward->reward_id )) }}
                    <div class="form-horizontal" id="reward{{ $reward->reward_id }}" style="margin-top:20px; padding:0px 10px 0px 10px;">
                        <div class="form-group">
                            <label class="col-md-3 control-label">Reward Title</label>
                            <div class='col-md-8'>
                                <input type='text' class='form-control' value="{{ $reward->reward_title }}" id='rewardTitle{{ $reward->reward_id }}' name='rewardTitle{{ $reward->reward_id }}' />
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Reward Description</label>
                            <div class='col-md-8'>
                                <textarea id="rewardDescription{{ $reward->reward_id }}" name="rewardDescription{{ $reward->reward_id }}" class="form-control" maxlength="500" rows="2" placeholder="This textarea has a limit of 500 chars.">{{ $reward->reward_description }}</textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Reward Minimum</label>
                            <div class='col-md-8'>
                                <input type='text' class='form-control' value="{{ $reward->reward_minimum }}" id='rewardMinimum{{ $reward->reward_id }}' name='rewardMinimum{{ $reward->reward_id }}' />
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Reward Available</label>
                            <div class='col-md-8'>
                                <input type='text' class='form-control' value="{{ $reward->reward_available }}" id='rewardAvailable{{ $reward->reward_id }}' name='rewardAvailable{{ $reward->reward_id }}' />
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Reward Photo</label>
                            <div class='col-md-8'>
                                <div class="fileinput fileinput-exists" data-provides="fileinput">
                                    <div class="fileinput-new thumbnail" style="width: 120px; height: 120px;"><img src="../images/default_project.jpg" /></div>
                                    <div class="fileinput-preview fileinput-exists thumbnail" data-trigger="fileinput" style="width: 120px; height: 120px;">
                                        <img id="updImg{{ $reward->reward_id }}" src="../uploads/reward/{{ $reward->reward_image }}" alt="{{ $reward->reward_image }}">
                                        </div>
                                        <div>
                                                <span class="btn default btn-file">
                                                <!--<span class="fileinput-new">
                                                Select image </span>-->
                                                <button type="button" class="btn btn-primary fileinput-new">Select Image</button>
                                                <!--<span class="fileinput-exists">
                                                Change </span>-->
                                                <button type="button" class="btn btn-default fileinput-exists">Change </button>
                                                <input type="file" id='rewardImage{{ $reward->reward_id }}' name="rewardImage{{ $reward->reward_id }}">
                                                </span>
                                                <!--
                                                <a href="#" class="btn red fileinput-exists" data-dismiss="fileinput">
                                                Remove </a>-->
                                                <button type="button" class="btn btn-danger fileinput-exists" data-dismiss="fileinput">Remove </button>
                                        </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-offset-3 col-md-8">
                                <button type="submit" class="btn btn-primary" data-id='{{ $reward->reward_id }}'>Edit Reward</button> <button type="button" class="btn btn-default remove-reward" data-id='{{ $reward->reward_id }}'>Remove</button>
                            </div>
                        </div>
                    </div>
                    {{ Form::close() }}
                    <hr width='90%'>
                    @endforeach
                    {{ Form::open(array('url'=>'manage-project/addreward', 'files'=>true, 'id'=>'formReward' )) }}
                    <div class="form-horizontal" style="margin-top:20px; padding:0px 10px 0px 10px;">
                        <div class="alert alert-danger display-hide">
                                <button class="close" data-close="alert"></button>
                                You have some form errors. Please check below.
                        </div>
                        <div class="alert alert-success display-hide">
                                <button class="close" data-close="alert"></button>
                                Your form validation is successful!
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Reward Title</label>
                            <div class='col-md-8'>
                                <input type='text' class='form-control' value="" id='rewardTitle0' name='rewardTitle0' />
                                <input type='hidden' id="projectId" name="projectId" value="{{ $project->project_id }}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Reward Description</label>
                            <div class='col-md-8'>
                                <textarea id="rewardDescription0" name="rewardDescription0" class="form-control" maxlength="500" rows="2" placeholder="This textarea has a limit of 500 chars."></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Reward Minimum</label>
                            <div class='col-md-8'>
                                <input type='text' class='form-control' value="" id='rewardMinimum0' name='rewardMinimum0' />
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Reward Available</label>
                            <div class='col-md-8'>
                                <input type='text' class='form-control' value="" id='rewardAvailable0' name='rewardAvailable0' />
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Reward Photo</label>
                            <div class='col-md-8'>
                                <div class="fileinput fileinput-new" data-provides="fileinput">
                                    <div class="fileinput-new thumbnail" style="width: 120px; height: 120px;"><img src="../images/default_project.jpg" /></div>
                                    <div class="fileinput-preview fileinput-exists thumbnail" data-trigger="fileinput" style="width: 120px; height: 120px;">
                                        <img src="" alt="">
                                        </div>
                                        <div>
                                                <span class="btn default btn-file">
                                                <!--<span class="fileinput-new">
                                                Select image </span>-->
                                                <button type="button" class="btn btn-primary fileinput-new">Select Image</button>
                                                <!--<span class="fileinput-exists">
                                                Change </span>-->
                                                <button type="button" class="btn btn-default fileinput-exists">Change </button>
                                                <input type="file" id='rewardImage' name="rewardImage">
                                                </span>
                                                <!--
                                                <a href="#" class="btn red fileinput-exists" data-dismiss="fileinput">
                                                Remove </a>-->
                                                <button type="button" class="btn btn-danger fileinput-exists" data-dismiss="fileinput">Remove </button>
                                        </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-offset-3 col-md-8">
                                <button type="button" id="add-reward" class="btn btn-success" data-id='0'>Add New Reward</button>
                            </div>
                        </div>
                    </div>
                    {{ Form::close() }}
                    <br/>
                </div>
                <!--</form>-->
                
            </div>
        </div>
    </div>
    <div class="col-md-4" id='containerPreview'>
        <div style='border:1px solid #E8E8E8;  min-height:400px; overflow:hidden; box-shadow:5px 5px 5px #888888;' id="previewproject">
            <div align='center'>
                <img src="../uploads/banner/{{ $project->banner_img }}" id="previewProjectPhoto" alt='{{ $project->banner_img }}' width='100%' height="250px">
            </div>
            <div style="padding-left:10px; padding-right:10px;">
                <div style="padding-top:10px;" >
                    <a href="#"><h4 id='previewProjectName'>{{ $project->title }}</a></h4>
                </div>
                <div style="padding-bottom:10px;" id="previewSmallContent" >{{ $project->small_content }}</div>
                <div style="height: 130px;">
                    <div class="donutHolder" id="itemholderEx">
                        <div class="donut" id="itemdonutEx"></div>
                        <span class="donutData" id="itemdonutDataEx"></span>   
                    </div>
                </div>
                <div style="text-align: center;"><h4>Rp <span id="previewProjectFund">{{ number_format($project->hitung_f,0,",",".") }}</span><br/><small>of Rp <span id="previewProjectAmount">0</span></small></h4></div>
                <div style="text-align: center;"><h4>{{ $project->backer }}<small> pledger</small></h4></div>
                <!--<div style="text-align: center;"><h4><span id="previewDatediff">0</span><small> days left</small></h4></div>
                <div style="text-align: center;"><h4><small>ends on <span id="previewProjectEndDate">-</span></small></h4></div>-->
                @if( $project->days_to_go->format("%r%a") <= 0)
                    @if( $project->status == 2)                                                    
                         <div style="text-align: center;"><h4 style="font-size: 16px; color:#fff; background-color: #1db262;">Successful !</h4></div>
                    @elseif ($project->status == 3)  
                         <div style="text-align: center;"><h4 style="font-size: 16px; color:#fff; background-color: #e54a1a;">Unsuccessful !</h4></div>
                    @else
                         <div style="text-align: center;"><h4 style="font-size: 16px;">0<small> days left</small></h4></div>
                    @endif                                                  
                    @else
                        <div style="text-align: center;"><h4 style="font-size: 16px;">{{ $project->days_to_go->format("%r%a") }}<small> {{ Lang::get('core.home_days_left') }}</small></h4></div>
                    @endif
            </div>
        </div>
    </div>    
</div>
<br/>
<br/>
<!--
<div class="container" style="margin-bottom:100px;">
	<div class="row">
	
	
	</div>
</div>		-->
{{ HTML::script('sximo/js/plugins/bootstrap-select/bootstrap-select.min.js')}}
{{ HTML::style('sximo/js/plugins/bootstrap-select/bootstrap-select.min.css')}}
{{ HTML::script('sximo/js/plugins/jquery-inputmask/jquery.inputmask.bundle.min.js')}}
{{ HTML::script('sximo/js/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js')}}
{{ HTML::style('sximo/js/plugins/bootstrap-datepicker/css/datepicker3.css')}}

{{ HTML::script('js/jquery.flot.min.js') }}
{{ HTML::script('js/jquery.flot.pie.min.js') }}

{{ HTML::script('sximo/js/plugins/bootstrap-fileinput/bootstrap-fileinput.js')}}
{{ HTML::style('sximo/js/plugins/bootstrap-fileinput/bootstrap-fileinput.css')}}

{{ HTML::script('sximo/js/plugins/ckeditor/ckeditor.js')}}
{{ HTML::script('sximo/js/plugins/jquery-validation/js/jquery.validate.min.js')}}
{{ HTML::script('sximo/js/plugins/bootbox/bootbox.min.js')}}
{{ HTML::script('sximo/js/plugins/jquery-tags-input/jquery.tagsinput.min.js')}}
{{ HTML::style('sximo/js/plugins/jquery-tags-input/jquery.tagsinput.css')}}
<script type='text/javascript'>
    
    $(window).load(function(){         
        localStorage.setItem('photo1_prev', './uploads/project/{{$project->img_content1 == '' ? 'default_project.jpg' : $project->img_content1}}'); 
        localStorage.setItem('photo2_prev', './uploads/project/{{$project->img_content2 == '' ? 'default_project.jpg' : $project->img_content2}}'); 
        localStorage.setItem('photo3_prev', './uploads/project/{{$project->img_content3 == '' ? 'default_project.jpg' : $project->img_content3}}'); 

        $(window).scroll(function(){
            var windowTop = $(window).scrollTop();
            if(windowTop > 236){
                resizeContainer();
                var top = (windowTop - 236) + 30;
                var containerHeight = $("#containerPreview").height();
                
                if(top + $("#previewproject").height() < containerHeight ) {
                    $("#previewproject")
                        .stop()
                        .animate({"marginTop": top + "px"}, "slow" );
                }
            }else{
                var top = 0;
                var containerHeight = $("#containerPreview").height();
                if(top + $("#previewproject").height() < containerHeight ) {
                    $("#previewproject")
                        .stop()
                        .animate({"marginTop": top + "px"}, "slow" );
                }
            }
        });

        $("#previewContent" ).click(function() {

            if($("#photo1").val()!="")
            {
                if($("#photo1")[0].files[0].size >= 2048000)
                {
                    alert("The Image File Size Should not Exceed 2 MB");
                    return false;
                }           
            }

            if($("#photo2").val()!="")
            {
                if($("#photo2")[0].files[0].size >= 2048000)
                {
                    alert("The Image File Size Should not Exceed 2 MB");
                    return false;
                }           
            }

            if($("#photo3").val()!="")
            {
                if($("#photo3")[0].files[0].size >= 2048000)
                {
                    alert("The Image File Size Should not Exceed 2 MB");
                    return false;
                }           
            }

            var issue = $("#issue" ).val();
            var who = $("#who" ).val();
            var need = $("#need" ).val();
            var impact = $("#impact" ).val();
            var time_line = $("#time_line" ).val();
            var ack = $("#ack" ).val();

            var fb = $("#facebook" ).val();
            var tw = $("#twitter" ).val();
            var go = $("#google" ).val();
            var ins = $("#instagram" ).val();
            var you = $("#youtube" ).val();
            var link = $("#linkedin" ).val();

            var img1 = $("#photo1" ).val();
            var img2 = $("#photo2" ).val();
            var img3 = $("#photo3" ).val();

            var url = $("#url" ).val();

            //var id = '{{SiteHelpers::encryptID(Session::get('projectID'))}}';
            var id = '{{SiteHelpers::encryptID($project->project_id)}}';
            var win = window.open('../preview_content?c='+id+'&is='+issue+'&w='+who+'&n='+need+'&im='+impact+'&t='+time_line+'&a='+ack+'&fb='+fb+'&tw='+tw+'&go='+go+'&ins='+ins+'&you='+you+'&link='+link+'&img1='+img1+'&img2='+img2+'&img3='+img3+'&url='+url, '_blank');
            //var win = window.open('preview_cont');
            if(win){
                win.focus();
            }else{                
                alert('Please allow popups for this site');
            }
        });

        $('#add-reward').click(function(event){
            if($("#rewardImage").val()!="")
            {
                if($("#rewardImage")[0].files[0].size >= 2048000)
                {
                    alert("The Image File Size Should not Exceed 2 MB");
                    return false;
                }           
            }

            $('#formReward').submit();
        });

        $('#save-banner').click(function(event){
            if($("#projectPhoto").val()==""){
                alert("Please Insert Project Image");
                return false;
            }
            if($("#projectPhoto")[0].files[0].size >= 2048000)
            {
                alert("The Image File Size Should not Exceed 2 MB");
                return false;
            }

            $('#formGeneral').submit();
        });

        $('#start-next').click(function(event){            
              
            if($("#photo1").val()!="")
            {
                if($("#photo1")[0].files[0].size >= 2048000)
                {
                    alert("The Image File Size Should not Exceed 2 MB");
                    return false;
                }           
            }

            if($("#photo2").val()!="")
            {
                if($("#photo2")[0].files[0].size >= 2048000)
                {
                    alert("The Image File Size Should not Exceed 2 MB");
                    return false;
                }           
            }

            if($("#photo3").val()!="")
            {
                if($("#photo3")[0].files[0].size >= 2048000)
                {
                    alert("The Image File Size Should not Exceed 2 MB");
                    return false;
                }           
            }            
            
            $('#formContent').submit();
         });

        var resizeContainer = function(){
            if(window.screen.availWidth > 768){
                $("#containerPreview").css("height", $("#containerInput").css("height"));
            }else{
                $("#containerPreview").css("padding-top", "20px");
            }
        };        
        var handleBootstrapSelect = function() {
            $('.bs-select').selectpicker({
                iconBase: 'fa'
                //tickIcon: 'fa-check',
            });
        };
        handleBootstrapSelect();
        $.extend($.inputmask.defaults, {
                'autounmask': true
            });
        $("#mask_currency").inputmask('Rp 999.999.999.999', {
                numericInput: true
            }); //123456  =>  € ___.__1.234,56

        if (jQuery().datepicker) {
                $('.date-picker').datepicker({
                    rtl: false,
                    autoclose: true
                });
                //$('body').removeClass("modal-open"); // fix bug when inline picker is used in modal
            }

        var changeColorSelect = function() {
            $(".option-color").css("color","#FF6600");
        };
        $("#categoryselect").change(function(){
            changeColorSelect();
        });
        changeColorSelect();
        
        var redrawDonutGraph = function(donated, goal) {
            var tmpdata = [
                { label:"Donated", data: donated, color: donated >= goal ? "#1db262" : "#43B3CF" },
                { label:"Goal", data: goal-donated, color:"#D3D3D3" }
            ];
            $.plot($("#itemdonutEx"), tmpdata,
            {
                series: {
                    pie: {
                        innerRadius: 0.8,
                        show: true,
                        label: { show: false }
                    }
                },
                legend: { show: false }
            });
            $("#itemdonutDataEx").text(Math.round(tmpdata[0].data/(tmpdata[1].data+tmpdata[0].data)*100)+"%");
            $("#itemdonutDataEx").css('color',donated >= goal ? "#1db262" : "#43B3CF")            
        };
        redrawDonutGraph({{ $project->hitung_f }},{{$project->amount}});

        //----UPDATE PREVIEW-------
        $("#projectName").on('change keyup paste', function() {
            $("#previewProjectName").html("<a href='#'>"+$(this).val()+"</a>");
        });
        var defaultImage = "../images/default_project.jpg";
        $('#containerThumbnail').bind('DOMNodeInserted DOMNodeRemoved', function(event) {
            if (event.type == 'DOMNodeInserted') {
                var imgContent = $('div.fileinput-preview.thumbnail').find("img:first").attr("src");
                $("#previewProjectPhoto").attr("src", imgContent);
            } else {
                $("#previewProjectPhoto").attr("src", defaultImage);
            }
        });
        var defaultImage = "images/default_project.jpg";
        $('#containerThumbnail1').bind('DOMNodeInserted DOMNodeRemoved', function(event) {
            if (event.type == 'DOMNodeInserted') {
                console.log('masuk sini photo1');
                var imgContent = $('div.fileinput-preview.thumbnail.tb1').find("img:first").attr("src");
                localStorage.setItem('photo1_prev', imgContent);                
            } else {
                localStorage.setItem('photo1_prev', defaultImage);
            }
        });

        $('#containerThumbnail2').bind('DOMNodeInserted DOMNodeRemoved', function(event) {
            if (event.type == 'DOMNodeInserted') {
                console.log('masuk sini photo2');
                var imgContent2 = $('div.fileinput-preview.thumbnail.tb2').find("img:first").attr("src");
                localStorage.setItem('photo2_prev', imgContent2);                
            } else {
                localStorage.setItem('photo2_prev', defaultImage);
            }
        });

        $('#containerThumbnail3').bind('DOMNodeInserted DOMNodeRemoved', function(event) {
            if (event.type == 'DOMNodeInserted') {
                console.log('masuk sini photo3');
                var imgContent3 = $('div.fileinput-preview.thumbnail.tb3').find("img:first").attr("src");
                localStorage.setItem('photo3_prev', imgContent3);                
            } else {
                localStorage.setItem('photo3_prev', defaultImage);
            }
        });

        $("#mask_currency").on("change",function(){
            var amount = $(this).val();
            amount = amount.replace("Rp ","");
            amount = amount.replace(/\./g,"");
            amount = amount.replace(/\_/g,"");
            $("#previewProjectAmount").html(formatNumber(amount, ".", ",")); 
            redrawDonutGraph({{ $project->hitung_f }},amount);
        });
        $("#projectEndDate").change(function(){
            var endDate = $(this).val();
            var arr = endDate.split("/");
            var previewDate = arr[2] + "-" + arr[0] + "-" + arr[1];
            
            var dateNow = getCurrentDate();
            
            var diff = datediff(dateNow, endDate, "days");
            
            $("#previewProjectEndDate").html(previewDate);
            $("#previewDatediff").html(diff);
        });
        $("#editor1").on("change keyup", function(){
            var content = $(this).val();
            content= content.replace(/\n/g,'<br/>');
            $("#previewSmallContent").html(content);
        });
        //---------------------------
        
        function updateReview(){
            //$("#previewProjectName").html("<a href='#'>"+$("#projectName").val()+"</a>");
            var endDate = $("#projectEndDate").val();
            var arr = endDate.split("/");
            var previewDate = arr[2] + "-" + arr[0] + "-" + arr[1];
            
            var dateNow = getCurrentDate();
            
            var diff = datediff(dateNow, endDate, "days");
            
            $("#previewProjectEndDate").html(previewDate);
            $("#previewDatediff").html(diff);
            
            var amount = $("#mask_currency").val();
            amount = amount.replace("Rp ","");
            amount = amount.replace(/\./g,"");
            amount = amount.replace(/\_/g,"");
            $("#previewProjectAmount").html(formatNumber(amount, ".", ",")); 
            $("#previewProjectFund").html(formatNumber({{ $project->hitung_f }}, ".", ",")); 
            redrawDonutGraph({{ $project->hitung_f }},amount);
        }
        updateReview();
        
      
        
        var handleValidationForm = function() {
            // for more info visit the official plugin documentation: 
            // http://docs.jquery.com/Plugins/Validation

            var form1 = $('#formGeneral');
            var error1 = $('.alert-danger', form1);
            var success1 = $('.alert-success', form1);

            form1.validate({
                errorElement: 'span', //default input error message container
                errorClass: 'help-block help-block-error', // default input error message class
                focusInvalid: false, // do not focus the last invalid input
                ignore: "",  // validate all fields including form hidden input
                /*messages: {
                    select_multi: {
                        maxlength: jQuery.validator.format("Max {0} items allowed for selection"),
                        minlength: jQuery.validator.format("At least {0} items must be selected")
                    }
                },*/
                rules: {
                    projectName: {
                        //.minlength: 6,
                        required: true
                    },
                   
                    mask_currency: {
                        required: true,
                        //url: true
                        //number: true
                    },
                    projectEndDate: {
                        required: true
                        //number: true
                    }
                    /*
                    digits: {
                        required: true,
                        digits: true
                    },
                    creditcard: {
                        required: true,
                        creditcard: true
                    },
                    occupation: {
                        minlength: 5,
                    },
                    select: {
                        required: true
                    },
                    select_multi: {
                        required: true,
                        minlength: 1,
                        maxlength: 3
                    }*/
                },

                invalidHandler: function (event, validator) { //display error alert on form submit              
                    event.preventDefault();
                    success1.hide();
                    error1.show();
                    //Metronic.scrollTo(error1, -200);
                },

                highlight: function (element) { // hightlight error inputs
                    $(element)
                        .closest('.form-group').addClass('has-error'); // set error class to the control group
                },

                unhighlight: function (element) { // revert the change done by hightlight
                    $(element)
                        .closest('.form-group').removeClass('has-error'); // set error class to the control group
                },

                success: function (label) {
                    label
                        .closest('.form-group').removeClass('has-error'); // set success class to the control group
                },

                submitHandler: function (form) {
                    form.submit();
                    //$('form').get(0).setAttribute('action', 'baz');
                    //success1.show();
                    //error1.hide();
                    /*
                    form = $(form);
                    var data = form.serialize();
                   
                    bootbox.confirm({
                        message: "Create New Project?",
                        callback: function(result) {
                            if (result === true) {
        */
                                /*$.post("protected/app/webservice/testing.php", function(data){
                                    console.log(data);
                                });*/
                                /*
                                $.ajax({
                                    type: "POST",
                                    url: "http://localhost/grfund/protected/app/webservice/testing.php",
                                    data: data,
                                    dataType: "json",
                                    beforeSend:function(){                            
                                        success1.hide();                    
                                        error1.hide();
                                    },
                                    error: function(jqXHR, textStatus, errorThrown){
                                        alert(errorThrown);
                                        success1.hide();                    
                                        error1.show();                            
                                    },
                                    success: function(data){
                                        if (data.reply === 1) {
                                            bootbox.alert("Success");
                                            success1.show();
                                            error1.hide();
                                            $('#successMsg').text("Success");
                                            window.location.replace(location.protocol + "//" + location.host + config.contextPath + "/templates/backend/userlist.jsp");
                                            
                                        } else {
                                            bootbox.alert("Error : " + ' ' + data.replyMessage);
                                            success1.hide();                    
                                            error1.show();
                                            $('#errorMsg').text("Error : "+ ' ' + data.replyMessage);                               
                                        }
                                    }
                                }); */                                /*
                            }
                        },
                        buttons: {
                            cancel: {
                                label: "Cancel"
                            },
                            confirm: {
                                label: "Confirm"
                            }
                        }
                    });*/
                }
            });
        };
        handleValidationForm();

        var handleTagsInput = function () {
            if (!jQuery().tagsInput) {
                return;
            }
            $('#projectTags').tagsInput({
                width: 'auto',
                'onAddTag': function () {
                    //alert(1);
                },
            });
        };
        handleTagsInput();
        
        var handleValidationFormContent = function() {
            // for more info visit the official plugin documentation: 
            // http://docs.jquery.com/Plugins/Validation

            var form1 = $('#formContent');
            var error1 = $('.alert-danger', form1);
            var success1 = $('.alert-success', form1);

            form1.validate({
                errorElement: 'span', //default input error message container
                errorClass: 'help-block help-block-error', // default input error message class
                focusInvalid: false, // do not focus the last invalid input
                ignore: "",  // validate all fields including form hidden input
                /*messages: {
                    select_multi: {
                        maxlength: jQuery.validator.format("Max {0} items allowed for selection"),
                        minlength: jQuery.validator.format("At least {0} items must be selected")
                    }
                },*/
                rules: {
                    editorContent: {
                        //.minlength: 6,
                        required: true
                    },
                },

                invalidHandler: function (event, validator) { //display error alert on form submit              
                    event.preventDefault();
                    success1.hide();
                    error1.show();
                    //Metronic.scrollTo(error1, -200);
                },

                highlight: function (element) { // hightlight error inputs
                    $(element)
                        .closest('.form-group').addClass('has-error'); // set error class to the control group
                },

                unhighlight: function (element) { // revert the change done by hightlight
                    $(element)
                        .closest('.form-group').removeClass('has-error'); // set error class to the control group
                },

                success: function (label) {
                    label
                        .closest('.form-group').removeClass('has-error'); // set success class to the control group
                },

                submitHandler: function (form) {
                    form.submit();
                }
            });
        };
        
        var handleValidationFormReward = function() {
            // for more info visit the official plugin documentation: 
            // http://docs.jquery.com/Plugins/Validation

            var form1 = $('#formReward');
            var error1 = $('.alert-danger', form1);
            var success1 = $('.alert-success', form1);

            form1.validate({
                errorElement: 'span', //default input error message container
                errorClass: 'help-block help-block-error', // default input error message class
                focusInvalid: false, // do not focus the last invalid input
                ignore: "",  // validate all fields including form hidden input
                /*messages: {
                    select_multi: {
                        maxlength: jQuery.validator.format("Max {0} items allowed for selection"),
                        minlength: jQuery.validator.format("At least {0} items must be selected")
                    }
                },*/
                rules: {
                    rewardTitle0: {
                        //.minlength: 6,
                        required: true
                    },
                    rewardDescription0: {
                        //.minlength: 6,
                        required: true
                    },
                    rewardMinimum0: {
                        //.minlength: 6,
                        required: true
                    },
                    rewardAvailable0: {
                        //.minlength: 6,
                        required: true,
                        number:true
                    },
                    @foreach($rewards as $reward)
                    rewardAvailable{{ $reward->reward_id }}: {
                        number:true
                    },
                    @endforeach
                },

                invalidHandler: function (event, validator) { //display error alert on form submit              
                    event.preventDefault();
                    success1.hide();
                    error1.show();
                    //Metronic.scrollTo(error1, -200);
                },

                highlight: function (element) { // hightlight error inputs
                    $(element)
                        .closest('.form-group').addClass('has-error'); // set error class to the control group
                },

                unhighlight: function (element) { // revert the change done by hightlight
                    $(element)
                        .closest('.form-group').removeClass('has-error'); // set error class to the control group
                },

                success: function (label) {
                    label
                        .closest('.form-group').removeClass('has-error'); // set success class to the control group
                },

                submitHandler: function (form) {
                    form.submit();
                }
            });
        };
        handleValidationFormReward();
        
        @foreach($rewards as $reward)
        $("#rewardMinimum{{ $reward->reward_id }}").inputmask('Rp 999.999.999.999', {
                numericInput: true
        }); //123456  =>  € ___.__1.234,56
        @endforeach
        $("#rewardMinimum0").inputmask('Rp 999.999.999.999', {
            numericInput: true
        }); //123456  =>  € ___.__1.234,56
        
        $(".remove-reward").click(function(){
            //console.log($(this).data('id'));
            var rewardId = $(this).data('id');
            $.ajax({
                    type: "POST",
                    url: "../protected/app/webservice/removeReward.php",
                    data: {id:rewardId},
                    dataType: "json",
                    beforeSend:function(){                            
                        //success1.hide();                    
                        //error1.hide();
                    },
                    error: function(jqXHR, textStatus, errorThrown){
                        alert(errorThrown);
                        //success1.hide();                    
                        //error1.show();                            
                    },
                    success: function(data){
                        if (data === true) {
                            bootbox.alert("Remove Reward Success");
                            $("#reward"+rewardId).hide();
                        } else {
                            bootbox.alert("Remove Failed.<br/>"+data);
                        }
                    }
                }); 
        });
        
        /*
        $(".edit-reward").click(function(){
            //console.log($(this).data('id'));
            var rewardId = $(this).data('id');
            var data = {"id":rewardId,"title":$("#rewardTitle"+rewardId).val(),"description":$("#rewardDescription"+rewardId).val(),"minimum":$("#rewardMinimum"+rewardId).val(),"available":$("#rewardAvailable"+rewardId).val(),"rewardImage":$("#rewardImage"+rewardId).val()};
            $.ajax({
                    type: "POST",
                    url: "../protected/app/webservice/editReward.php",
                    data: data,
                    dataType: "json",
                    beforeSend:function(){                            
                        //success1.hide();                    
                        //error1.hide();
                    },
                    error: function(jqXHR, textStatus, errorThrown){
                        alert(errorThrown);
                        //success1.hide();                    
                        //error1.show();                            
                    },
                    success: function(data){
                        if (data === true) {
                            bootbox.alert("Edit Reward Success");
                            //$("#reward"+rewardId).hide();
                        } else {
                            bootbox.alert("Edit Reward Failed. Err : "+data);
                        }
                    }
                }); 
        });*/
        
        
        
        $('.formReward').on('submit', function(event){
            event.stopPropagation(); // Stop stuff happening
            event.preventDefault(); // Totally stop stuff happening

            // START A LOADING SPINNER HERE
            
            // Create a formdata object and add the files
            // Create a jQuery object from the form
            var form = $(event.target);
            var id = form.data('id');
                        
            var dataForm = new FormData();
            // You should sterilise the file names
            //var file = $("#rewardImage"+$id).files[0];

            dataForm.append("changeImage", 'true');
            if($("#rewardImage"+id)[0].files[0] != undefined){
                dataForm.append("rewardImage", $("#rewardImage"+id)[0].files[0]);
                //console.log('masuk');
            }else{
                if($("#updImg"+id).is('img'))
                    dataForm.append("changeImage", 'false');    
                    
                dataForm.append("rewardImage", '');
                //console.log('tidak');
            }
            //return;
            
            dataForm.append("id", id);
            dataForm.append("title", $("#rewardTitle"+id).val());
            dataForm.append("description", $("#rewardDescription"+id).val());
            dataForm.append("minimum", $("#rewardMinimum"+id).val());
            dataForm.append("available", $("#rewardAvailable"+id).val());

            //console.log(tes);
            
            $.ajax({
                url: '../protected/app/webservice/editReward.php',
                type: 'POST',
                data: dataForm,
                cache: false,
                dataType: 'json',
                processData: false, // Don't process the files
                contentType: false, // Set content type to false as jQuery will tell the server its a query string request
                success: function(data)
                {
                    if (data === true) {
                        bootbox.alert("Edit Reward Success");
                        //$("#reward"+rewardId).hide();
                    } else {
                        bootbox.alert("Edit Reward Failed. Err : "+data);
                    }
                },
                error: function(jqXHR, textStatus, errorThrown)
                {
                    // Handle errors here
                    //console.log('ERRORS: ' + textStatus);
                    // STOP LOADING SPINNER
                    alert(errorThrown);
                }
            });
        });
    });
    
    
</script>