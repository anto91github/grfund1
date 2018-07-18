<div class="wrapper-header ">
    <div class=" container">
		<div class="col-sm-6 col-xs-6">
		  <div class="page-title">
			<h3>{{ Lang::get('core.cp_create'); }}</h3>
		  </div>
		</div>
		<div class="col-sm-6 col-xs-6 ">
		  <ul class="breadcrumb pull-right">
			<li><a href="{{ URL::to('') }}">{{ Lang::get('core.home'); }}</a></li>
			<li class="active">{{ Lang::get('core.cp_create'); }}</li>
		  </ul>		
		</div>
		  
    </div>
</div>	
<div class="container" >
 <!-- BEGIN STEPS -->
 <div class="col-md-12">
          <div class="row">
            <div class=""></div>
            <div class="col-md-6" style="text-align:left; font-size:16px; color:#696969; margin-bottom:20px; margin-top:20px; ">
              <table border="1">
                <tr>
                  <td>&nbsp;</td>
                  <td><span style="font-size:30px; color:green; float:left;" class="fa fa-check-square-o"></span></td>
                  <td style="padding-left:5px;">{{ Lang::get('core.home_check1') }}</td>
                  <td>&nbsp;</td>
                </tr>
              </table>
            </div>
            <div class="col-md-6" style="text-align:right; font-size:16px; color:#696969; margin-bottom:20px; margin-top:20px; ">{{ Lang::get('core.home_target1') }} &nbsp;&nbsp;<span style="font-size:30px; color:red; float:right;" class="fa fa-bullseye"></span></div>
          </div>
          <div class="row">
            <div class="col-md-6" style="text-align:left; font-size:16px; color:#696969; margin-bottom:20px;">
              <table border="0">
                <tr>
                  <td><span style="font-size:30px; color:green; float:left;" class="fa fa-check-square-o"></span></td>
                  <td style="padding-left:5px;">{{ Lang::get('core.home_check2') }}</td>
                </tr>
              </table>
            </div>
            <div class="col-md-6" style="text-align:right; font-size:16px; color:#696969; margin-bottom:20px; ">{{ Lang::get('core.home_target2') }} &nbsp;&nbsp;<span style="font-size:30px; color:red; float:right;" class="fa fa-bullseye"></span></div>
          </div>
          <div class="row">
            <div class="col-md-6" style="text-align:left; font-size:16px; color:#696969; margin-bottom:20px;">
              <table border="0">
                <tr>
                  <td><span style="font-size:30px; color:green; float:left;" class="fa fa-check-square-o"></span></td>
                  <td style="padding-left:5px;">{{ Lang::get('core.home_check3') }}</td>
                </tr>
              </table>
            </div>
            <div class="col-md-6" style="text-align:right; font-size:16px; color:#696969; margin-bottom:20px; ">{{ Lang::get('core.home_target3') }} &nbsp;&nbsp;<span style="font-size:30px; color:red; float:right;" class="fa fa-bullseye"></span></div>
          </div>
        </div>

<div class="col-md-12">
    <div class="row front-steps-wrapper front-steps-count-3">
      <div class="col-md-4 col-sm-4 front-step-col">
        <div class="front-step front-step1-active">
          <h2>{{ Lang::get('core.cp_step_1') }}</h2>
          <p>{{ Lang::get('core.cp_step_1_d') }}</p>
        </div>
      </div>
      <div class="col-md-4 col-sm-4 front-step-col">
        <div class="front-step front-step2">
          <h2>{{ Lang::get('core.cp_step_2') }}</h2>
          <p>{{ Lang::get('core.cp_step_2_d') }}</p>
        </div>
      </div>
      <div class="col-md-4 col-sm-4 front-step-col">
        <div class="front-step front-step3">
          <h2>{{ Lang::get('core.cp_step_3') }}</h2>
          <p>{{ Lang::get('core.cp_step_3_d') }}</p>
        </div>
      </div>
    </div>
</div>
<!-- END STEPS -->    
    <div class="col-md-8" id="containerInput">

      
        {{ Form::open(array('url'=>'create-project/newproject','files'=>true, 'id'=>'formCreateProject' )) }}
        <!--<form id="formCreateProject" method="POST" action="#" class='form-horizontal form-row-seperated'>-->
        <div id="container-start" style='border:1px solid #5d5d5d; box-shadow: 6px 6px 5px #888888; height:auto;'>
            <div style='color:#fff; background-color: #404040; padding:10px; padding-left:30px;'>
                <span style='font-size:23px;'>{{ Lang::get('core.cp_create_new'); }}</span>
            </div>
            <div class="alert alert-danger display-hide">
                    <button class="close" data-close="alert"></button>
                    {{ Lang::get('core.cp_msg1'); }}
            </div>
            <div class="alert alert-success display-hide">
                    <button class="close" data-close="alert"></button>
                    Your form validation is successful!
            </div>
            <div class="form-horizontal" style="margin-top:20px; padding:0px 5px 0px 5px;">
                <div class="form-group">
                    <label class="col-xs-12 col-md-3 control-label" style="font-weight: normal;" >{{ Lang::get('core.cp_category'); }}</label>
                    <div class='col-xs-12 col-md-8'>
                    <select name="categoryselect" id="categoryselect" class="select form-control" data-show-subtext="true" >
                        @foreach($category as $cat)
                        <option value="{{$cat->id}}">{{$cat->name}}</option>
                        @endforeach
                        <!--<option value="business">Business/Startup</option>
                        <option value="charity">Charity</option>
                        <option value="community">Community</option>
                        <option value="education">Education</option>
                        <option value="emergency">Emergency</option>
                        <option value="environment">Environment & Conservation</option>
                        <option value="event">Event</option>
                        <option value="family">Family</option>
                        <option value="health">Health & Disabilities</option>
                        <option value="sport">Sport</option>
                        <option value="technology">Technology</option>-->

                        <!--
                            <option value="art" data-icon="fa-lightbulb-o fa-lg option-color">Art</option>
                            <option value="crafts" data-icon="fa-envelope fa-lg option-color">Crafts</option>
                            <option value="dance" data-icon="fa-envelope fa-lg option-color">Dance</option>
                            <option value="design" data-icon="fa-envelope fa-lg option-color">Design</option>
                            <option value="film-video" data-icon="fa-envelope fa-lg option-color">Film & Video</option>
                            <option value="fashion" data-icon="fa-envelope fa-lg option-color">Fashion</option>
                            <option value="food" data-icon="fa-envelope fa-lg option-color">Food</option>
                            <option value="games" data-icon="fa-envelope fa-lg option-color">Games</option>
                            <option value="journalism" data-icon="fa-envelope fa-lg option-color">Journalism</option>
                            <option value="music" data-icon="fa-envelope fa-lg option-color">Music</option>
                            <option value="photography" data-icon="fa-envelope fa-lg option-color">Photography</option>
                            <option value="publishing" data-icon="fa-envelope fa-lg option-color">Publishing</option>
                            <option value="technology" data-icon="fa-envelope fa-lg option-color">Technology</option>
                            <option value="theater" data-icon="fa-envelope fa-lg option-color">Theater</option>
                            <option value="charity" data-icon="fa-envelope fa-lg option-color">Charity</option>
                            <option value="solidarity" data-icon="fa-envelope fa-lg option-color">Solidarity</option>
                            <option value="birthday-gift" data-icon="fa-birthday-cake fa-lg option-color">Birthday Gift</option>
                            <option value="farewell-gift" data-icon="fa-suitcase fa-lg option-color">Farewell Gift</option>
                            <option value="wedding-gift" data-icon="fa-heart fa-lg option-color">Wedding Gift</option>
                        -->
                    </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-3 control-label" style="font-weight: normal;">{{ Lang::get('core.cp_name'); }} <span class="required color-red">*</span></label>
                    <div class='col-md-8'>
                        <input type="text" name="projectName" id='projectName' class="form-control" placeholder="{{Lang::get('core.cp_name_d');}}">
                    </div>
                </div>
                
                <div class="form-group">
                    <label class="col-md-3 control-label" style="font-weight: normal;">{{ Lang::get('core.cp_amount'); }} <span class="required color-red">*</span></label>
                    <div class='col-md-8'>
                        <input class="form-control" name="mask_currency" id="mask_currency" type="text"/>
                        <span class="help-block">Minimum Rp. 10.000.000 <span style="float:right">123456 => Rp ___.123.456</span> </span>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-3 control-label" style="font-weight: normal;">{{ Lang::get('core.cp_end_date'); }} <span class="required color-red">*</span></label>
                    <div class='col-md-8'>
                        <input name="projectEndDate" id="projectEndDate" class="form-control form-control-inline input-medium date-picker" size="16" type="text" value=""/>
                        <span class="help-block">
                        {{ Lang::get('core.cp_select_date'); }} </span>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-3 control-label" style="font-weight: normal;">{{ Lang::get('core.cp_tags'); }} </label>
                    <div class='col-md-8'>
                        <input id="projectTags" name="projectTags" type="text" class="form-control tags" value=""/>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-3 control-label" style="font-weight: normal;">{{ Lang::get('core.cp_photo'); }} <span class="required color-red">*</span></label>
                    <div class='col-md-8'>
                        <div class="fileinput fileinput-new" data-provides="fileinput">
                            <div id="containerThumbnail" class="fileinput-preview thumbnail" data-trigger="fileinput" style="width: 200px; height: 150px;">
                                </div>
                                <div>
                                        <span class="btn default btn-file">
                                        <!--<span class="fileinput-new">
                                        Select image </span>-->
                                        <button type="button" class="btn btn-primary fileinput-new">{{ Lang::get('core.cp_photo_select'); }}</button>
                                        <!--<span class="fileinput-exists">
                                        Change </span>-->
                                        <button type="button" class="btn btn-default fileinput-exists">{{ Lang::get('core.cp_photo_change'); }} </button>
                                        <input type="file" id='projectPhoto' name="projectPhoto">
                                        </span>                                         
                                        <!--
                                        <a href="#" class="btn red fileinput-exists" data-dismiss="fileinput">
                                        Remove </a>-->
                                        <button type="button" class="btn btn-danger fileinput-exists" data-dismiss="fileinput">{{ Lang::get('core.cp_photo_remove'); }} </button>
                                        <span class="help-block">Best Resolution: 700*400 pixels</span>
                                </div>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-3 control-label" style="font-weight: normal;">{{ Lang::get('core.cp_small_content'); }} <span class="required color-red">*</span></label>
                    <div class='col-md-8'>
                        <textarea id="editor1" name="editor1" class="form-control" maxlength="100" rows="2" placeholder="{{ Lang::get('core.cp_small_content_d'); }}"></textarea>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-3 control-label" style="font-weight: normal;">Ownership<span class="required color-red">*</span></label>
                    <div class='col-md-8'>                        
                        <input type="radio" name="ownership" value="individu">&nbsp;Individual<br/>
                            <div class="fileinput fileinput-new" data-provides="fileinput">
                            <div id="containerThumbnail" class="fileinput-preview thumbnail" data-trigger="fileinput" style="width: 200px; height: 50px;">
                                </div>
                                <div>
                                        <span class="btn default btn-file">
                                        <!--<span class="fileinput-new">
                                        Select image </span>-->
                                        <button type="button" id='Btn_indiNPWP' class="btn btn-primary fileinput-new">Insert NPWP</button>
                                        <!--<span class="fileinput-exists">
                                        Change </span>-->
                                        <button type="button" class="btn btn-default fileinput-exists">{{ Lang::get('core.cp_photo_change'); }} </button>
                                        <input type="file" id='indiNPWP' name="indiNPWP">
                                        </span>                                         
                                        <!--
                                        <a href="#" class="btn red fileinput-exists" data-dismiss="fileinput">
                                        Remove </a>-->
                                        <button type="button" class="btn btn-danger fileinput-exists" data-dismiss="fileinput">{{ Lang::get('core.cp_photo_remove'); }} </button>                                        
                                </div>
                                
                        </div>

                        <div class="fileinput fileinput-new" data-provides="fileinput">
                            <div id="containerThumbnail" class="fileinput-preview thumbnail" data-trigger="fileinput" style="width: 200px; height: 50px;">
                                </div>
                                <div>
                                        <span class="btn default btn-file">
                                        <!--<span class="fileinput-new">
                                        Select image </span>-->
                                        <button type="button" id='Btn_indiKTP' class="btn btn-primary fileinput-new">Insert KTP</button>
                                        <!--<span class="fileinput-exists">
                                        Change </span>-->
                                        <button type="button" class="btn btn-default fileinput-exists">{{ Lang::get('core.cp_photo_change'); }} </button>
                                        <input type="file" id='indiKTP' name="indiKTP">
                                        </span>                                         
                                        <!--
                                        <a href="#" class="btn red fileinput-exists" data-dismiss="fileinput">
                                        Remove </a>-->
                                        <button type="button" class="btn btn-danger fileinput-exists" data-dismiss="fileinput">{{ Lang::get('core.cp_photo_remove'); }} </button>                                        
                                </div>
                                
                        </div>
                        <br/>
                        <input type="radio" name="ownership" value="company">&nbsp;Company / Foundation <br/>
                        <div class="fileinput fileinput-new" data-provides="fileinput">
                            <div id="containerThumbnail" class="fileinput-preview thumbnail" data-trigger="fileinput" style="width: 200px; height: 50px;">
                                </div>
                                <div>
                                        <span class="btn default btn-file">
                                        <!--<span class="fileinput-new">
                                        Select image </span>-->
                                        <button type="button" id='Btn_comNPWP' class="btn btn-primary fileinput-new">Insert NPWP</button>
                                        <!--<span class="fileinput-exists">
                                        Change </span>-->
                                        <button type="button" class="btn btn-default fileinput-exists">{{ Lang::get('core.cp_photo_change'); }} </button>
                                        <input type="file" id='comNPWP' name="comNPWP">
                                        </span>                                         
                                        <!--
                                        <a href="#" class="btn red fileinput-exists" data-dismiss="fileinput">
                                        Remove </a>-->
                                        <button type="button" class="btn btn-danger fileinput-exists" data-dismiss="fileinput">{{ Lang::get('core.cp_photo_remove'); }} </button>                                        
                                </div>                                
                        </div>
                        <div class="fileinput fileinput-new" data-provides="fileinput">
                            <div id="containerThumbnail" class="fileinput-preview thumbnail" data-trigger="fileinput" style="width: 200px; height: 50px;">
                                </div>
                                <div>
                                        <span class="btn default btn-file">
                                        <!--<span class="fileinput-new">
                                        Select image </span>-->
                                        <button type="button"  id='Btn_comSIUP' class="btn btn-primary fileinput-new">Insert SIUP</button>
                                        <!--<span class="fileinput-exists">
                                        Change </span>-->
                                        <button type="button" class="btn btn-default fileinput-exists">{{ Lang::get('core.cp_photo_change'); }} </button>
                                        <input type="file" id='comSIUP' name="comSIUP">
                                        </span>                                         
                                        <!--
                                        <a href="#" class="btn red fileinput-exists" data-dismiss="fileinput">
                                        Remove </a>-->
                                        <button type="button" class="btn btn-danger fileinput-exists" data-dismiss="fileinput">{{ Lang::get('core.cp_photo_remove'); }} </button>                                        
                                </div>
                                
                        </div>

                        <div class="fileinput fileinput-new" data-provides="fileinput">
                            <div id="containerThumbnail" class="fileinput-preview thumbnail" data-trigger="fileinput" style="width: 200px; height: 50px;">
                                </div>
                                <div>
                                        <span class="btn default btn-file">
                                        <!--<span class="fileinput-new">
                                        Select image </span>-->
                                        <button type="button" id='Btn_comDomi'class="btn btn-primary fileinput-new">Insert Domicile Letter</button>
                                        <!--<span class="fileinput-exists">
                                        Change </span>-->
                                        <button type="button" class="btn btn-default fileinput-exists">{{ Lang::get('core.cp_photo_change'); }} </button>
                                        <input type="file" id='comDomi' name="comDomi">
                                        </span>                                         
                                        <!--
                                        <a href="#" class="btn red fileinput-exists" data-dismiss="fileinput">
                                        Remove </a>-->
                                        <button type="button" class="btn btn-danger fileinput-exists" data-dismiss="fileinput">{{ Lang::get('core.cp_photo_remove'); }} </button>                                        
                                </div>
                                
                        </div>
                    </div>
                </div>
                <div class="form-group">
                        <div class="col-md-offset-3 col-md-8">
                            <button type="button" id="startnext" class="btn btn-primary">{{ Lang::get('core.cp_next'); }}</button>
                        </div>
                </div>
            </div>
            <br/>
            <br/>
        </div>
        <!--</form>-->
        {{ Form::close() }}
    </div>
    <div class="col-md-4" id='containerPreview'>
        <div style='border:1px solid #E8E8E8;  min-height:400px; overflow:hidden; box-shadow:5px 5px 5px #888888;' id="previewproject">
            <div align='center'>
                <img src="images/default_project.jpg" id="previewProjectPhoto" alt='default project' width='100%' height="250px">
            </div>
            <div style="padding-left:10px; padding-right:10px;">
                <div style="padding-top:10px;" >
                    <a href="#"><h4 id='previewProjectName'>{{ Lang::get('core.cp_title'); }}</a></h4>
                </div>
                <div style="padding-bottom:10px;" id="previewContent" >{{ Lang::get('core.cp_title_c'); }}</div>
                <div style="height: 130px;">
                    <div class="donutHolder" id="itemholderEx">
                        <div class="donut" id="itemdonutEx"></div>
                        <span class="donutData" id="itemdonutDataEx"></span>   
                    </div>
                </div>
                <div style="text-align: center;"><h4>Rp 0<br/><small>of Rp <span id="previewProjectAmount">0</span></small></h4></div>
                <div style="text-align: center;"><h4>0<small> {{ Lang::get('core.home_pledger'); }}</small></h4></div>
                <div style="text-align: center;"><h4><span id="previewDatediff">0</span><small> {{ Lang::get('core.home_days_left'); }}</small></h4></div>
                <div style="text-align: center;"><h4><small>{{ Lang::get('core.cp_ends_on'); }} <span id="previewProjectEndDate">-</span></small></h4></div>
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
{{-- HTML::script('sximo/js/plugins/bootstrap.datetimepicker/js/bootstrap-datetimepicker.min.js')--}}
{{-- HTML::style('sximo/js/plugins/bootstrap.datetimepicker/css/bootstrap-datetimepicker.min.css')--}}

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
        $("#indiNPWP").attr("disabled", "disabled");
        $('#Btn_indiNPWP').css('background-color', 'grey');
        $("#indiKTP").attr("disabled", "disabled");
        $('#Btn_indiKTP').css('background-color', 'grey');

        $("#comNPWP").attr("disabled", "disabled");
        $('#Btn_comNPWP').css('background-color', 'grey');
        $("#comSIUP").attr("disabled", "disabled");
        $('#Btn_comSIUP').css('background-color', 'grey');
        $("#comDomi").attr("disabled", "disabled");
        $('#Btn_comDomi').css('background-color', 'grey');


        $("input:radio[name=ownership]").click(function() {
        var value = $(this).val();
        
        if(value == 'individu')
        {            
            $("#indiNPWP").removeAttr('disabled');
            $('#Btn_indiNPWP').css('background-color', '#428BCA');
            $("#indiKTP").removeAttr('disabled');
            $('#Btn_indiKTP').css('background-color', '#428BCA');

            $("#comNPWP").attr("disabled", "disabled");
            $('#Btn_comNPWP').css('background-color', 'grey');
            $("#comSIUP").attr("disabled", "disabled");
            $('#Btn_comSIUP').css('background-color', 'grey');
            $("#comDomi").attr("disabled", "disabled");
            $('#Btn_comDomi').css('background-color', 'grey');
        }
        else
        {
            $("#indiNPWP").attr("disabled", "disabled");
            $('#Btn_indiNPWP').css('background-color', 'grey');
            $("#indiKTP").attr("disabled", "disabled");
            $('#Btn_indiKTP').css('background-color', 'grey');

            $("#comNPWP").removeAttr('disabled');
            $('#Btn_comNPWP').css('background-color', '#428BCA');
            $("#comSIUP").removeAttr('disabled');
            $('#Btn_comSIUP').css('background-color', '#428BCA');
            $("#comDomi").removeAttr('disabled');
            $('#Btn_comDomi').css('background-color', '#428BCA');
        }
        
    });

            

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
                { label:"Donated", data: donated, color:"#43B3CF" },
                { label:"Goal", data: goal, color:"#D3D3D3" }
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
            $("#itemdonutDataEx").text(Math.round(tmpdata[0].data/tmpdata[1].data*100)+"%");
        };
        redrawDonutGraph(0,1);

        //-----check file size-----
       /*$.validator.addMethod('filesize', function(value, element, param) {
            // param = size (en bytes) 
            // element = element to validate (<input>)
            // value = value of the element (file name)
             return this.optional(element) || (element.files[0].size <= param)
        });*/
        //--------------------------

        //----UPDATE PREVIEW-------
        $("#projectName").on('change keyup paste', function() {
            $("#previewProjectName").html("<a href='#'>"+$(this).val()+"</a>");
        });
        var defaultImage = "images/default_project.jpg";
        $('#containerThumbnail').bind('DOMNodeInserted DOMNodeRemoved', function(event) {
            if (event.type == 'DOMNodeInserted') {
                var imgContent = $('div.fileinput-preview.thumbnail').find("img:first").attr("src");
                $("#previewProjectPhoto").attr("src", imgContent);
            } else {
                $("#previewProjectPhoto").attr("src", defaultImage);
            }
        });
        $("#mask_currency").on("change",function(){
            var amount = $(this).val();
            amount = amount.replace("Rp ","");
            amount = amount.replace(/\./g,"");
            amount = amount.replace(/\_/g,"");
            $("#previewProjectAmount").html(formatNumber(amount, ".", ",")); 
            redrawDonutGraph(0,amount);
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
            $("#previewContent").html(content);
        });
        //-----------------------
        /*
        CKEDITOR.replace( 'editor1', {
            // Define the toolbar groups as it is a more accessible solution.
            toolbarGroups: [
            {"name":"basicstyles","groups":["basicstyles"]},
            {"name":"links","groups":["links"]},
            {"name":"paragraph","groups":["list","blocks"]},
            {"name":"document","groups":["mode"]},
            {"name":"insert","groups":["insert"]},
            {"name":"styles","groups":["styles"]},
            {"name":"about","groups":["about"]}
            ],
            // Remove the redundant buttons from toolbar groups defined above.
            //removeButtons: 'Underline,Strike,Subscript,Superscript,Anchor,Styles,Specialchar'
            removeButtons: 'Save,NewPage'
        } ); */
        //var handleValidationForm = function() {
        $('#startnext').click(function(event){
            // for more info visit the official plugin documentation: 
            // http://docs.jquery.com/Plugins/Validation

            var amount = $('#mask_currency').val();
            amount = amount.replace("Rp ","");
            amount = amount.replace(/\./g,"");
            amount = amount.replace(/\_/g,"");

            if (amount < 10000000)
            {
                alert("Minimum Amount Rp 10.000.000");
                return false;
            }  
            
            /*console.log($("#projectPhoto").val()=="");
            return(false);*/

            if($("#projectPhoto").val()==""){
                alert("Please Insert Project Image");
                return false;
            }            
            if($("#projectPhoto")[0].files[0].size >= 2048000)
            {
                alert("The Image File Size Should not Exceed 2 MB");
                return false;
            }             

            if($("input:radio[name=ownership]:checked").val()=="individu")
            {
                if($("#indiNPWP").val()=="")
                {
                    alert("Please insert NPWP Document for Individual");
                    return false;
                }
                if($("#indiKTP").val()=="")
                {
                    alert("Please insert KTP Document for Individual");
                    return false;
                }                                   
           }


             if($("input:radio[name=ownership]:checked").val()=="company")
             {
                    if($("#comNPWP").val()=="")
                    {
                        alert("Please insert NPWP Document for Company");
                        return false;
                    }
                    if($("#comSIUP").val()=="")
                    {
                        alert("Please insert SIUP Document for Company");
                        return false;
                    } 
                    if($("#comDomi").val()=="")
                    {
                        alert("Please insert Domicile Letter for Company");
                        return false;
                    }                    
            }
            $('#formCreateProject').submit();

        });

        var handleValidationForm = function(){

            var form1 = $('#formCreateProject');
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
                    recipientName: {
                        required: true
                        //email: true
                    },
                    mask_currency: {
                        required: true
                        //url: true
                        //number: true
                    },
                    projectEndDate: {
                        required: true
                        //number: true
                    },
                    projectPhoto: {
                        required: true                        
                    },
                    editor1: {
                        required: true
                    },
                    ownership: {
                        required: true
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
                //messages: { inputimage: "File must be JPG, GIF or PNG, less than 1MB" },

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
    });
    
    
</script>