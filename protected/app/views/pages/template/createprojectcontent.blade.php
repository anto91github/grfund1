<div class="wrapper-header ">
    <div class=" container">
        <div class="col-sm-6 col-xs-6">
          <div class="page-title">
            <h3> Content Project </h3>
          </div>
        </div>
        <div class="col-sm-6 col-xs-6 ">
          <ul class="breadcrumb pull-right">
            <li><a href="{{ URL::to('') }}">Home</a></li>
            <li class="active">Content Project </li>
          </ul>     
        </div>
          
    </div>
</div>  
<div class="container" >
    <!-- BEGIN STEPS -->
<div class="col-md-12">
    <div class="row front-steps-wrapper front-steps-count-3">
      <div class="col-md-4 col-sm-4 front-step-col">
        <div class="front-step front-step1">
          <h2>Start Your Project</h2>
          <p>Make your own campaign</p>
        </div>
      </div>
      <div class="col-md-4 col-sm-4 front-step-col">
        <div class="front-step front-step2-active">
          <h2>Create Your Story and Content</h2>
          <p>Explain your campaign and offer reward levels.</p>
        </div>
      </div>
      <div class="col-md-4 col-sm-4 front-step-col">
        <div class="front-step front-step3" style="background-color:#7C858E">
          <h2>Fund Your Project</h2>
          <p>Your Project is ready</p>
        </div>
      </div>
    </div>
</div>
<!-- END STEPS --> 

    <div class="col-md-8" id="containerInput">
        <ul class="nav nav-pills" style="padding-bottom:1px;">
            <li {{ Input::get('t') != 2 ? "class='active'" : ""}} style="width:200px;font-size:18px;text-align:center; background-color:#dadac8;">
                <a href="#tabContent" data-toggle="tab">Content </a>
            </li>
            <li {{ Input::get('t') == 2 ? "class='active'" : "" }} style="width:200px;font-size:18px;text-align:center; background-color:#dadac8;">
                <a href="#tabReward" data-toggle="tab">Reward </a>
            </li>
        </ul>
        <div class="tab-content col-md-12" style="padding-left:0px; padding-right:0px;">
            <div class="tab-pane fade {{ Input::get('t') != 2  ? 'active' : '' }} in" id="tabContent">
                {{ Form::open(array('url'=>'create-project-content/contentproject', 'files'=>true, 'id'=>'formContentProject' )) }}
                    <div id="container-start" style='border:1px solid #5d5d5d; box-shadow: 6px 6px 5px #888888; height:auto;'>
            <div style='color:#fff; background-color: #404040; padding:10px; padding-left:30px;'>
                <span style='font-size:23px;'>Create Project</span>
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
                    <div class="col-xs-12 col-md-12"><h5>Content Project</h5></div>
                    <div class='col-xs-12 col-md-12'>
                        <textarea id="editor1" name="editor1" class="form-control " rows="4" placeholder="Content Project."></textarea>
                    </div>
                </div>
                <div class="form-group">
                        <div class="col-md-12" align="right">
                            <button type="submit" id="start-next" class="btn btn-primary">Submit</button>
                        </div>
                </div>
            </div>
            <br/>
            <br/>
        </div>
                {{ Form::close() }}
            </div>
            <div class="tab-pane {{Input::get('t') == 2 ? 'active' : ''}} fade in" id="tabReward" style='border:1px solid #5d5d5d; box-shadow: 6px 6px 5px #888888; height:auto; padding:0px;'>
                <div style='color:#fff; background-color: #404040; padding:10px; padding-left:30px;'>
                     <span style='font-size:23px;'>Reward Project</span>
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
                                    <div class="fileinput-new thumbnail" style="width: 120px; height: 120px;">{{ HTML::image('images/default_project.jpg') }}</div>
                                    <div class="fileinput-preview fileinput-exists thumbnail" data-trigger="fileinput" style="width: 120px; height: 120px;">
                                        <!--<img src="../uploads/reward/{{ $reward->reward_image }}" alt="{{ $reward->reward_image }}">-->
                                        {{ HTML::image('uploads/reward/'.$reward->reward_image, $reward->reward_image,array('id'=>'updImg'.$reward->reward_id)) }}
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
                {{ Form::open(array('url'=>'create-project-content/addreward', 'files'=>true, 'id'=>'formReward' )) }}
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
                            <input type='hidden' id="projectId" name="projectId" value="{{$project_id}}">
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
                                <div class="fileinput-new thumbnail" style="width: 120px; height: 120px;">{{ HTML::image('images/default_project.jpg') }}</div>
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
                            <button type="submit" id="add-reward" class="btn btn-success" data-id='0'>Add New Reward</button>
                        </div>
                    </div>
                </div>
                {{ Form::close() }}
                <br/>
             </div>
                
            </div>
         </div>
   
    <div class="col-md-4" id='containerPreview'>
        <div style='border:1px solid #E8E8E8;  min-height:400px; overflow:hidden; box-shadow:5px 5px 5px #888888;' id="previewproject">
            <div align='center'>
                 @foreach($value_p as $value)
                <img src="uploads/banner/{{ $value->banner_img }}" id="previewProjectPhoto" alt='default project' height= '250' width='350'/>
            </div>
            <div style="padding-left:10px; padding-right:10px;">
                <div style="padding-top:10px;" >
                   
                    <a href="#"><h4 id='previewProjectName'>{{$value->title}}</h4></a>
                </div>
                <div style="padding-bottom:10px;" id="previewContent" >{{$value->small_content}}</div>
                <div style="height: 130px;">
                    <div class="donutHolder" id="itemholderEx">
                        <div class="donut" id="itemdonutEx"></div>
                        <span class="donutData" id="itemdonutDataEx"></span>   
                    </div>
                </div>
                <div style="text-align: center;"><h4>Rp 0<br/><small>of Rp <span id="previewProjectAmount">0</span></small></h4></div>
                <div style="text-align: center;"><h4>0<small> pledger</small></h4></div>
                <div style="text-align: center;"><h4><span id="previewDatediff">0</span><small> days left</small></h4></div>
                <div style="text-align: center;"><h4><small>ends on <span id="previewProjectEndDate">-</span></small></h4></div>
            </div>
        </div>
        @endforeach       
    </div>
 
</div>
<br/>
<br/>
<!--
<div class="container" style="margin-bottom:100px;">
    <div class="row">
    
    
    </div>
</div>      -->


{{ HTML::script('js/jquery.flot.min.js') }}
{{ HTML::script('js/jquery.flot.pie.min.js') }}

{{ HTML::script('sximo/js/plugins/bootstrap-fileinput/bootstrap-fileinput.js')}}
{{ HTML::style('sximo/js/plugins/bootstrap-fileinput/bootstrap-fileinput.css')}}

{{ HTML::script('sximo/js/plugins/ckeditor/ckeditor.js')}}
{{ HTML::script('sximo/js/plugins/jquery-validation/js/jquery.validate.min.js')}}
{{ HTML::script('sximo/js/plugins/bootbox/bootbox.min.js')}}

{{ HTML::script('js/plugins/js-modal-master/jh-modal-2.js') }}
{{ HTML::style('js/plugins/js-modal-master/jh-modal-2.css') }}



<script type='text/javascript'>
    
    $(window).load(function(){

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

            var id = '{{SiteHelpers::encryptID(Session::get('projectID'))}}';
            var win = window.open('preview_content?c='+id+'&is='+issue+'&w='+who+'&n='+need+'&im='+impact+'&t='+time_line+'&a='+ack+'&fb='+fb+'&tw='+tw+'&go='+go+'&ins='+ins+'&you='+you+'&link='+link+'&img1='+img1+'&img2='+img2+'&img3='+img3+'&url='+url, '_blank');
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
            
            
            $('#formContentProject').submit();
         });

        var resizeContainer = function(){
            if(window.screen.availWidth > 768){
                $("#containerPreview").css("height", $("#containerInput").css("height"));
            }else{
                $("#containerPreview").css("padding-top", "0px");
            }
        };         
        
        var amount = "{{$amount}}";
        var endDate = "{{$due_date}}";

        var setPreview = function(){
            amount = amount.replace("Rp ","");
            amount = amount.replace(/\./g,"");
            amount = amount.replace(/\_/g,"");
            $("#previewProjectAmount").html(formatNumber(amount, ".", ",")); 
            redrawDonutGraph(0,amount);
            
            var arr = endDate.split("-");
            var previewDate = arr[2] + "-" + arr[0] + "-" + arr[1];
            
            var dateNow = getCurrentDate();
            
            var diff = datediff(dateNow, endDate, "days");
            
            $("#previewProjectEndDate").html(endDate);
            $("#previewDatediff").html(diff);
        };
        
        
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
        //redrawDonutGraph(0,1);
        
        CKEDITOR.replace( 'editor1', {
            // Define the toolbar groups as it is a more accessible solution.
            filebrowserBrowseUrl: '/grfund/browse',
            filebrowserUploadUrl: '/grfund/upload',
            toolbarGroups: [
            {"name":"basicstyles","groups":["basicstyles"]},
            {"name":"colors","groups":["colors"] },
            {"name":"links","groups":["links"]},
            {"name":"paragraph","groups":["list","blocks"]},
            {"name":"document","groups":["mode"]},
            {"name":"insert","groups":["insert"]},
            {"name":"styles","groups":["styles"]},
            {"name":"about","groups":["about"]}
            ],
            // Remove the redundant buttons from toolbar groups defined above.
            //removeButtons: 'Underline,Strike,Subscript,Superscript,Anchor,Styles,Specialchar'
            removeButtons: 'Save,NewPage',
            height: '400'
        } );
        
        var handleValidationForm = function() {
            // for more info visit the official plugin documentation: 
            // http://docs.jquery.com/Plugins/Validation

            var form1 = $('#formContentProject');
            var form2= $('#formReward');
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
                    issue: {
                       required: true 
                    },
                    who:{
                       required: true 
                    },
                    need:{
                       required: true 
                    },
                    impact:{
                       required: true 
                    },
                    time_line:{
                       required: true 
                    },
                    ack:{
                       required: true 
                    }                    
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
        form2.validate({
             errorElement: 'span', //default input error message container
             errorClass: 'help-block help-block-error', // default input error message class
             focusInvalid: false, // do not focus the last invalid input
             ignore: "",  // validate all fields including form hidden input

             rules: {
                    rewardMinimum0: {
                       required: true,
                       min: 1
                    }
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
        handleValidationForm();

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

        $(".remove-reward").click(function(){
            //console.log($(this).data('id'));
            var rewardId = $(this).data('id');
            $.ajax({
                    type: "POST",
                    url: "protected/app/webservice/removeReward.php",
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
                url: 'protected/app/webservice/editReward.php',
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

        setPreview();
    });
   
</script>