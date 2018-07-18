<div class="wrapper-header ">
    <div class=" container">
		<div class="col-sm-6 col-xs-6">
		  <div class="page-title">
                      <h3> Profile <small>Edit</small> </h3>
		  </div>
		</div>
		<div class="col-sm-6 col-xs-6 ">
		  <ul class="breadcrumb pull-right">
			<li><a href="{{ URL::to('') }}">Home</a></li>
                        <li><a href="{{ URL::to('account') }}">Account </a></li>
                        <li class="active">Edit Profile </li>
		  </ul>		
		</div>
		  
    </div>
</div>	
<div class="container" >
    <!-- BEGIN FORM
    <form action="#" class='form-horizontal form-row-seperated'>
        <div id="container-start" style='border:1px solid #5d5d5d; margin-left:40px; margin-right: 40px; box-shadow: 6px 6px 5px #888888;'>
            <div style='color:#fff; background-color: #404040; padding:10px; padding-left:30px; margin-bottom:20px;'>
                <span style='font-size:23px;'>Create a New Project</span>
            </div>
            <div class="form-body">
                <div class="form-group">
                    <label class="col-md-3 control-label">Category</label>
                    <div class='col-md-5'>
                        <select id="categoryselect" class="bs-select form-control" data-show-subtext="true">
                            <option data-icon="fa-lightbulb-o fa-lg option-color">Creative Project</option>
                                <option data-icon="fa-envelope fa-lg option-color">Donation</option>
                                <option data-icon="fa-birthday-cake fa-lg option-color">Birthday</option>
                                <option data-icon="fa-suitcase fa-lg option-color">Farewell Gift</option>
                                <option data-icon="fa-heart fa-lg option-color">Wedding Gift</option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-3 control-label">Project Name</label>
                    <div class='col-md-5'>
                        <input type="text" class="form-control" placeholder="Enter project name">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-3 control-label">Recipient</label>
                    <div class='col-md-5'>
                        <input type="text" class="form-control" placeholder="Enter recepient name">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-3 control-label">Amount</label>
                    <div class='col-md-5'>
                        <input class="form-control" id="mask_currency" type="text"/>
                        <span class="help-block">123456 => Rp ___.123.456 </span>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-3 control-label">End Date</label>
                    <div class='col-md-5'>
                        <input class="form-control form-control-inline input-medium date-picker" size="16" type="text" value=""/>
                        <span class="help-block">
                        Select date </span>
                    </div>
                </div>
                <div class="form-group">
                        <div class="col-md-offset-3 col-md-9">
                            <button type="submit" id="start-next" class="btn btn-primary">Next Step</button>
                        </div>
                </div>
            </div>
        </div>
    </form>
    END FORM -->
    <div class="col-md-12">
        {{ Form::open(array('url'=>'edit-profile/updateprofile','files'=>true, 'id'=>'formProfile' )) }}
        <!--<form id="formCreateProject" method="POST" action="#" class='form-horizontal form-row-seperated'>-->
        <div style='border:1px solid #5d5d5d; box-shadow: 6px 6px 5px #888888; height:auto;'>
            <div style='color:#fff; background-color: #404040; padding:10px; padding-left:30px;'>
                <span style='font-size:23px;'>Profile</span>
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
                    <label class="col-xs-12 col-md-3 control-label">First Name <span class="required color-red">*</span></label>
                    <div class='col-xs-12 col-md-8'>
                        <input type="text" name="firstName" id='firstName' class="form-control" placeholder="Enter first name" value="{{ $profile->first_name }}">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-3 control-label">Last Name </label>
                    <div class='col-md-8'>
                        <input type="text" name="lastName" id='lastName' class="form-control" placeholder="Enter last name" value="{{ $profile->last_name }}">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-3 control-label">Logo </label>
                    <div class='col-md-8'>
                        <div class="fileinput fileinput-exists" data-provides="fileinput">
                            <div class="fileinput-new thumbnail" style="width: 150px; height: 150px;"><img src="uploads/users/default.png" /></div>
                            <div id="containerThumbnail" class="fileinput-preview fileinput-exists thumbnail" data-trigger="fileinput" style="width: 150px; height: 150px;">
                                <img src="uploads/users/{{ $profile->avatar }}" alt="{{ $profile->avatar }}">
                                </div>
                                <div>
                                        <span class="btn default btn-file">
                                        <!--<span class="fileinput-new">
                                        Select image </span>-->
                                        <button type="button" class="btn btn-primary fileinput-new">Select Image</button>
                                        <!--<span class="fileinput-exists">
                                        Change </span>-->
                                        <button type="button" class="btn btn-default fileinput-exists">Change </button>
                                        <input type="file" id='avatar' name="avatar">
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
                    <label class="col-md-3 control-label">Website URL </label>
                    <div class='col-md-8'>
                        <input type="text" name="website" id='website' class="form-control" placeholder="http://" value="{{ $profile->website }}">
                    </div>
                </div>

                <div class="form-group">
                        <div class="col-md-offset-3 col-md-8">
                            <button type="submit" id="start-next" class="btn btn-primary">Save</button> <a href="account" class="btn btn-default" >Cancel</a>
                        </div>
                </div>
            </div>
            <br/>
            <br/>
        </div>
        <!--</form>-->
        {{ Form::close() }}
    </div>
</div>
<br/>
<br/>
<!--
<div class="container" style="margin-bottom:100px;">
	<div class="row">
	
	
	</div>
</div>		-->

{{ HTML::script('sximo/js/plugins/bootstrap-fileinput/bootstrap-fileinput.js')}}
{{ HTML::style('sximo/js/plugins/bootstrap-fileinput/bootstrap-fileinput.css')}}

{{ HTML::script('sximo/js/plugins/jquery-validation/js/jquery.validate.min.js')}}
{{ HTML::script('sximo/js/plugins/bootbox/bootbox.min.js')}}
<script type='text/javascript'>
    
    $(window).load(function(){
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
        var handleValidationForm = function() {
            // for more info visit the official plugin documentation: 
            // http://docs.jquery.com/Plugins/Validation

            var form1 = $('#formProfile');
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
                    firstName: {
                        //.minlength: 6,
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
    });
    
    
</script>