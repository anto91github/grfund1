<div class="wrapper-header ">
    <div class=" container">
        <div class="col-sm-6 col-xs-6">
          <div class="page-title">
            <h3> Edit Update</h3>
          </div>
        </div>
        <div class="col-sm-6 col-xs-6 ">
            
        </div>
          
    </div>
</div>  
<div class="container" >
    <div class="col-md-8" id="containerInput">        
        <div class="tab-content" style="padding-left:0px; padding-right:0px;">
            <div class="tab-pane fade in" id="tabGeneral">
                {{ Form::open(array('url'=>'manage-project/updateproject','files'=>true, 'id'=>'formGeneral' )) }}
                <!--<form id="formCreateProject" method="POST" action="#" class='form-horizontal form-row-seperated'>-->
                <div id="container-general" style='border:1px solid #5d5d5d; box-shadow: 6px 6px 5px #888888; height:auto;'>
                    123
                
                </div>
                <!--</form>-->
                {{ Form::close() }}
            </div>
            
            

                    <div style="text-align:center;padding-bottom:10px;font-size:20px">Edit Update</div>
                    {{ Form::open(array('url'=>'manage-project/editpost', 'files'=>true, 'id'=>'formPost' )) }}
                        <input type='hidden' id="postId" name="postId" value="{{ $project->post_id }}">
                        <input type='hidden' id="projectId" name="projectId" value="{{ $project->project_id}}">
                        <label class="col-md-3 control-label">Title (Bahasa) :</label>
                            <div class='col-md-9' style="padding-bottom:10px">
                                <input type='text' class='form-control' value="{{$project->post_header}}" id='postHeader' name='postHeader' />
                            </div>
                        <label class="col-md-3 control-label">Title (English) :</label>
                            <div class='col-md-9' style="padding-bottom:10px">
                                <input type='text' class='form-control' value="{{$project->post_header_en}}" id='postHeader_en' name='postHeader_en' />
                            </div>
                        <label class="col-md-3 control-label">Short Description (Bahasa) :</label>
                            <div class='col-md-9' style="padding-bottom:10px">
                                <input type='text' class='form-control' value="{{$project->small_post}}" id='small_content' name='small_content' />
                            </div>
                        <label class="col-md-3 control-label">Short Description (English) :</label>
                            <div class='col-md-9' style="padding-bottom:10px">
                                <input type='text' class='form-control' value="{{$project->small_post_en}}" id='small_content_en' name='small_content_en' />
                            </div>
                        <label class="col-md-3 control-label">Content (Bahasa) :</label>    
                            <div class='col-md-9' style="padding-bottom:10px">
                                <textarea rows='2' id='content_post' name='content_post' class='form-control '>{{$project->post_content}}</textarea> 
                            </div>
                        <label class="col-md-3 control-label">Content (English):</label>    
                            <div class='col-md-9' style="padding-bottom:10px">
                                <textarea rows='2' id='content_post_en' name='content_post_en' class='form-control '>{{$project->post_content_en}}</textarea> 
                            </div>
                        <div class="form-group"  style="text-align:center">
                            <div class="col-md-offset-3 col-md-8">
                                <button type="submit" id="add-post" class="btn btn-success" data-id='0'>Edit Update</button>
                            </div>
                        </div>
                    {{ Form::close() }}
            </div>
    </div>
    <div class="col-md-4" id='containerPreview'>
        <div style='border:1px solid #E8E8E8;  min-height:400px; overflow:hidden; box-shadow:5px 5px 5px #888888;' id="previewproject">
            <div align='center'>
                <img src="./uploads/banner/{{ $project->banner_img }}" id="previewProjectPhoto" alt='{{ $project->banner_img }}' width='100%' height="250px">
            </div>
            <div style="padding-left:10px; padding-right:10px;">
                <div style="padding-top:10px;" >
                    <a href="../show-project/{{$project->project_alias}}"><h4 id='previewProjectName'>{{ $project->title }}</a></h4>
                </div>
                <div style="padding-bottom:10px;" id="previewSmallContent" >{{ $project->small_content }}</div>
                <div style="height: 130px;">
                    <div class="donutHolder" id="itemholderEx">
                        <div class="donut" id="itemdonutEx"></div>
                        <span class="donutData" id="itemdonutDataEx"></span>   
                    </div>
                </div>
                <div style="text-align: center;"><h4>Rp <span id="previewProjectFund">{{ number_format($project->hitung_f,0,",",".") }}</span><br/><small>of Rp <span id="previewProjectAmount">{{ number_format($project->amount,0,",",".") }}</span></small></h4></div>
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
</div>

<br/>
<br/>
<!--
<div class="container" style="margin-bottom:100px;">
    <div class="row">
    
    
    </div>
</div>      -->
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

{{ HTML::script('js/plugins/js-modal-master/jh-modal-3.js') }}
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

        /*$('#start-next').click(function(event){            
              
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
         });*/

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
        /*$("#projectEndDate").change(function(){
            var endDate = $(this).val();
            var arr = endDate.split("/");
            var previewDate = arr[2] + "-" + arr[0] + "-" + arr[1];
            
            var dateNow = getCurrentDate();
            
            var diff = datediff(dateNow, endDate, "days");
            
            $("#previewProjectEndDate").html(previewDate);
            $("#previewDatediff").html(diff);
        });*/
        $("#editor1").on("change keyup", function(){
            var content = $(this).val();
            content= content.replace(/\n/g,'<br/>');
            $("#previewSmallContent").html(content);
        });
        //---------------------------
        
        /*function updateReview(){
            //$("#previewProjectName").html("<a href='#'>"+$("#projectName").val()+"</a>");
            //var endDate = $("#projectEndDate").val();
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
        }*/
        //updateReview();
        
      CKEDITOR.replace( 'content_post', {
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
                    height:200
                } );
        CKEDITOR.replace( 'content_post_en', {
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
                    height:200
                } ); 
        
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

        $(".remove-updates").click(function(){
            //console.log($(this).data('id'));
            var postId = $(this).data('id');            
            $.ajax({
                    type: "POST",
                    url: "../protected/app/webservice/removeUpdate.php",
                    data: {id:postId},
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
                            bootbox.alert("Remove Updates Success");
                            $("#update"+postId).hide();
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