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
			<li class="active">Reward Project </li>
		  </ul>		
		</div>
		  
    </div>
</div>	
<div class="container" >
    <div class="col-md-8" id="containerInput">
        {{ Form::open(array('url'=>'create-project-reward/rewardproject', 'id'=>'formContentProject' )) }}
        <!--<form id="formCreateProject" method="POST" action="#" class='form-horizontal form-row-seperated'>-->
        <div id="container-start" style='border:1px solid #5d5d5d; box-shadow: 6px 6px 5px #888888; height:auto;'>
            <div style='color:#fff; background-color: #404040; padding:10px; padding-left:30px;'>
                <span style='font-size:23px;'>Reward</span>
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
        <!--</form>-->
        {{ Form::close() }}
    </div>
    {{--*/ $value = Session::get('createproject'); /*--}}
    <div class="col-md-4">
        <div style='border:1px solid #E8E8E8;  min-height:400px; overflow:hidden; box-shadow:5px 5px 5px #888888;' id="previewproject">
            <div align='center'>
                <img src="{{ $value['projectImage'] }}" id="previewProjectPhoto" alt='default project' width='100%'>
            </div>
            <div style="padding-left:10px; padding-right:10px;">
                <div style="padding-top:10px;" >
                    <a href="#"><h4 id='previewProjectName'>{{ $value['projectName'] }}</a></h4>
                </div>
                <div style="padding-bottom:10px;" id="previewContent" >{{ $value['projectSmallContent'] }}</div>
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
    </div>
</div>
<br/>
<br/>
<!--
<div class="container" style="margin-bottom:100px;">
	<div class="row">
	
	
	</div>
</div>		-->
{{-- HTML::script('sximo/js/plugins/bootstrap-select/bootstrap-select.min.js')--}}
{{-- HTML::style('sximo/js/plugins/bootstrap-select/bootstrap-select.min.css')--}}
{{-- HTML::script('sximo/js/plugins/jquery-inputmask/jquery.inputmask.bundle.min.js')--}}
{{-- HTML::script('sximo/js/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js')--}}
{{-- HTML::style('sximo/js/plugins/bootstrap-datepicker/css/datepicker3.css')--}}
{{-- HTML::script('sximo/js/plugins/bootstrap.datetimepicker/js/bootstrap-datetimepicker.min.js')--}}
{{-- HTML::style('sximo/js/plugins/bootstrap.datetimepicker/css/bootstrap-datetimepicker.min.css')--}}

{{ HTML::script('js/jquery.flot.min.js') }}
{{ HTML::script('js/jquery.flot.pie.min.js') }}

{{ HTML::script('sximo/js/plugins/bootstrap-fileinput/bootstrap-fileinput.js')}}
{{ HTML::style('sximo/js/plugins/bootstrap-fileinput/bootstrap-fileinput.css')}}

{{ HTML::script('sximo/js/plugins/ckeditor/ckeditor.js')}}
{{ HTML::script('sximo/js/plugins/jquery-validation/js/jquery.validate.min.js')}}
{{ HTML::script('sximo/js/plugins/bootbox/bootbox.min.js')}}
{{-- HTML::script('sximo/js/plugins/jquery-tags-input/jquery.tagsinput.min.js')--}}
{{-- HTML::style('sximo/js/plugins/jquery-tags-input/jquery.tagsinput.css')--}}
<script type='text/javascript'>
    
    $(window).load(function(){        
        
        var amount = "{{ $value['projectAmount'] }}";
        var endDate = "{{ $value['projectEndDate'] }}";
        var setPreview = function(){
            amount = amount.replace("Rp ","");
            amount = amount.replace(/\./g,"");
            amount = amount.replace(/\_/g,"");
            $("#previewProjectAmount").html(formatNumber(amount, ".", ",")); 
            redrawDonutGraph(0,amount);
            
            var arr = endDate.split("/");
            var previewDate = arr[2] + "-" + arr[0] + "-" + arr[1];
            
            var dateNow = getCurrentDate();
            
            var diff = datediff(dateNow, endDate, "days");
            
            $("#previewProjectEndDate").html(previewDate);
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
            removeButtons: 'Save,NewPage'
        } ); 
        
        var handleValidationForm = function() {
            // for more info visit the official plugin documentation: 
            // http://docs.jquery.com/Plugins/Validation

            var form1 = $('#formContentProject');
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
                    editor1: {
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
        setPreview();
    });
    
    
</script>