<div class="wrapper-header ">
    <div class=" container">
		<div class="col-sm-6 col-xs-6">
		  <div class="page-title">
			<h3> Change Password <small></small></h3>
		  </div>
		</div>
		<div class="col-sm-6 col-xs-6 ">
		  <ul class="breadcrumb pull-right">
			<li><a href="{{ URL::to('') }}">Home</a></li>
                        <li><a href="{{ URL::to('account') }}">Account</a></li>
			<li class="active">Change Password </li>
		  </ul>		
		</div>
		  
    </div>
</div>	

<div class="container">
        <div class="row" style="padding:10px 40px 10px 40px;" >
            <div class="col-md-10" style="padding-left:50px;">
                {{ Form::open(array('url'=>'change-password/changepassword', 'id'=>'formChangePassword' )) }}
                <div class="form-horizontal" style="margin-top:20px; padding:0px 10px 0px 10px;">
                    @if($message != null || $message != "")
                    <div class="form-group">
                            <label class="col-md-3 control-label col-md-offset-3 color-red">Change Password Failed. {{ $message }}</label>
                    </div>
                    @endif
                    <div class="form-group">
                            <label class="col-md-3 control-label">Current Password </label>
                            <div class='col-md-8'>
                                <!--<input type='text' class="form-control" id="currentPass" name="currentPass">-->
                                {{ Form::password('currentPass', array('class'=>'form-control', 'placeholder'=>'Password')) }}
                            </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">New Password </label>
                        <div class='col-md-8'>
                            <input type='password' class="form-control" id="newPass" name="newPass">
                        </div>
                    </div>
                    <div class="form-group">
                            <label class="col-md-3 control-label">Confirm Password </label>
                            <div class='col-md-8'>
                                <input type='password' class="form-control" id="confirmPass" name="confirmPass">
                            </div>
                    </div>
                    <div class="form-group">
                            <div class="col-md-offset-3 col-md-12" >
                                <button type='submit' class="btn btn-primary">Submit</button> <a href="account" class="btn btn-default">Cancel</a>
                            </div>
                    </div>
                </div>
                {{ FORM::close() }}
            </div>
        </div>
</div>


		

<div class="container" style="height:160px;">
	<div class="row">
	
	</div>
</div>	
{{ HTML::script('sximo/js/plugins/jquery-validation/js/jquery.validate.min.js')}}
{{ HTML::script('sximo/js/plugins/bootbox/bootbox.min.js')}}
<script type='text/javascript'>
    $(window).load(function(){
        var handleValidationFormContent = function() {
            // for more info visit the official plugin documentation: 
            // http://docs.jquery.com/Plugins/Validation

            var form1 = $('#formChangePassword');
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
                    currentPass: {
                        //.minlength: 6,
                        required: true
                    },
                    newPass: {
                        //.minlength: 6,
                        required: true
                    },
                    confirmPass: {
                        //.minlength: 6,
                        equalTo: "#newPass"
                    },
                },

                invalidHandler: function (event, validator) { //display error alert on form submit              
                    event.preventDefault();
                    //success1.hide();
                    //error1.show();
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
        handleValidationFormContent();
    });
</script>