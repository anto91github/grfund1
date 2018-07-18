
<div class="sbox">
	<div class="sbox-title">
			
				<h3 >{{ CNF_APPNAME }}</h3>
				
	</div>
	<div class="sbox-content">
 {{ Form::open(array('url'=>'user/signin', 'class'=>'form-vertical', 'id'=>'login_form')) }}
	    	@if(Session::has('message'))
				{{ Session::get('message') }}
			@endif
		<ul class="parsley-error-list">
			@foreach($errors->all() as $error)
				<li>{{ $error }}</li>
			@endforeach
		</ul>		
		
			
	<div class="form-group has-feedback">
		<label>{{ Lang::get('core.email'); }}	</label>
		{{ Form::text('email', null, array('class'=>'form-control', 'placeholder'=>'Email Address')) }}
		<i class="icon-users form-control-feedback"></i>
	</div>
	
	<div class="form-group has-feedback">
		<label>{{ Lang::get('core.password'); }}	</label>
		{{ Form::password('password', array('class'=>'form-control', 'placeholder'=>'Password')) }}
		<i class="icon-lock form-control-feedback"></i>
	</div>
	@if(CNF_RECAPTCHA =='true') 
	<div class="form-group has-feedback">
		<label class="text-left"> Are u human ? </label>		
		{{ Form::captcha(array('theme' => 'white')); }}
		<div class="clr"></div>
	</div>	
 	@endif	
	<div class="form-group  has-feedback text-center" style=" margin-bottom:20px;" >
		 	 
			<button type="submit" class="btn btn-primary btn-sm btn-block" >{{ Lang::get('core.signin'); }}</button>
		       

		
	 	<div class="clr"></div>
		
	</div>	
	<p class="text-center"><a  id="or"  href="javascript://ajax"><small>{{ Lang::get('core.forgotpassword'); }}?</small></a></p>
	<!--<p class="text-center"><a  id="or"  href="{{ URL::to('forgot-password')}}"><small>{{ Lang::get('core.forgotpassword'); }}?</small></a></p>-->
	<p class="text-muted text-center">{{ Lang::get('core.donot_acc'); }}</p>
				@if(CNF_REGIST =='true') 
		  		<a class="btn btn-default btn-white btn-white btn-block"  href="{{ URL::to('user/register')}}"> {{ Lang::get('core.create_acc'); }} </a>
			@endif	
		<div class="form-group has-feedback text-center">
		@if($fb_enabled =='true' || $google_enabled =='true' || $twit_enabled =='true') 
		<br />
		<p class="text-muted text-center"><b> {{ Lang::get('core.loginsocial') }} </b>	  </p>
		@endif
		<div style="padding:15px 0 0 60px;">
			@if($fb_enabled =='true') 
			<!--<a href="{{ URL::to('user/facebook')}}" class="btn btn-primary"><i class="fa fa-facebook"></i> Facebook </a>-->
			<a href="{{ URL::to('fbauth')}}" class="btn btn-block btn-social btn-facebook" style="width:200px;"><i class="fa fa-facebook"></i>Sign in with Facebook </a>
			@endif
			@if($google_enabled =='true') 
			<!--<a href="{{ URL::to('user/google')}}" class="btn btn-danger"><i class="fa fa-google-plus"></i> Google </a>-->
			<a href="{{ URL::to('gauth')}}" class="btn btn-block btn-social btn-google" style="width:200px;"><i class="fa fa-google-plus"></i>Sign in with Google </a>
			@endif
			@if($twit_enabled =='true') 
			<!--<a href="{{ URL::to('user/twitter')}}" class="btn btn-info"><i class="fa fa-twitter"></i> Twitter </a>-->
			<!--<a href="{{ URL::to('twitterAuth')}}" class="btn btn-info"><i class="fa fa-twitter"></i> Twitter </a>-->
			@endif
		</div>
	  <p style="padding:10px 0" class="text-center">
	  <a href="{{ URL::to('')}}"> {{ Lang::get('core.back_site') }} </a>  
   		</p>			
	</div>		  
	  
	
 {{ Form::close() }}	  
 
{{-- Form::open(array('url' => 'forgot-password/forgotpassword', 'class'=>'form-vertical box ','id'=>'fr' , 'style'=>'margin-top:20px; display:none; '))--}}
{{ Form::open(array('url' => 'user/request', 'class'=>'form-vertical box ','id'=>'fr' , 'style'=>'margin-top:20px; display:none; ')) }}
 	
       <div class="form-group has-feedback">
	   <div class="">
			<label>Password Reminder <br/>{{ Lang::get('core.enteremailforgot') }}:</label>
		   {{ Form::text('credit_email', null, array('class'=>'form-control', 'placeholder'=> Lang::get('core.email'))) }}
			<i class="icon-envelope form-control-feedback"></i>
		</div> 	
		</div>
		<div class="form-group has-feedback">        
          <a  id="login_back"  href="javascript://ajax"><small>Back to Login</small></a>
          <button type="submit" class="btn btn-default pull-right"> {{ Lang::get('core.sb_submit') }} </button>

      </div>
	  
	  <div class="clr"></div>
  
	  
 {{ Form::close() }}		 


  <div class="clr"></div>
  </div>
</div>

<script type="text/javascript">
	$(document).ready(function(){

		$('#or').click(function(){
			$('#fr').toggle();			
			$("#login_form").css("display","none");
		});

		$('#login_back').click(function(){
			$('#login_form').toggle();			
			$("#fr").css("display","none");
		});	


	});

   var _gaq = _gaq || [];
      _gaq.push(['_setAccount', 'UA-42119746-1']);
      _gaq.push(['_trackPageview']);

      (function() {
        var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
        ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
        var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
      })();

</script>