<!DOCTYPE html>
<?php require 'protected/app/controllers/Footer.php';?>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title> <?php echo isset($page['pageTitle']) ? $page['pageTitle'].' | '.$page['pageNote'] : CNF_APPNAME ;?></title>
<meta name="keywords" content="{{ CNF_METAKEY }}">
<meta name="description" content="{{ CNF_METADESC }}"/>
<meta property="fb:app_id" content="835062946569282" />
<!--<meta property="fb:admins" content="1197584005"/>-->
<!--<meta property="og:type" content="website" /> -->
<meta property="og:image" content="http://gotongroyong.fund/uploads/banner/"/>

<link rel="shortcut icon" href="{{ URL::to('')}}/icon.png" type="image/x-icon" size="16x16">	
<link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=PT+Sans+Narrow' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Pathway+Gothic+One' rel='stylesheet' type='text/css'>
		{{ HTML::style('sximo/themes/mango/css/bootstrap.min.css')}}
		
		{{ HTML::style('sximo/fonts/awesome/css/font-awesome.min.css')}}
		{{ HTML::style('sximo/css/icons.min.css')}}
		{{ HTML::style('sximo/themes/mango/js/fancybox/source/jquery.fancybox.css') }}		
		{{ HTML::style('sximo/themes/mango/js/fancybox/source/helpers/jquery.fancybox-thumbs.css?v=1.0.7') }}	
		{{ HTML::style('sximo/themes/mango/js/owl-carousel/owl.carousel.css')}}	
		{{ HTML::style('sximo/themes/mango/js/owl-carousel/owl.theme.css')}}	
		{{ HTML::style('sximo/themes/mango/css/mango.css')}}
                {{ HTML::style('css/custom.css') }}
                

		
		{{ HTML::script('sximo/themes/mango/js/jquery.min.js') }}		
		{{ HTML::script('sximo/themes/mango/js/bootstrap.min.js') }}	
		{{ HTML::script('sximo/themes/mango/js/fancybox/source/jquery.fancybox.js') }}	
		{{ HTML::script('sximo/themes/mango/js/fancybox/source/helpers/jquery.fancybox-thumbs.js?v=1.0.7s') }}	
		{{ HTML::script('sximo/themes/mango/js/fancybox/source/jquery.fancybox.js') }}	
		{{ HTML::script('sximo/themes/mango/js/owl-carousel/owl.carousel.js') }}	
		{{ HTML::script('sximo/js/plugins/prettify.js') }}	
		{{ HTML::script('sximo/js/plugins/parsley.js') }}
		{{ HTML::script('sximo/themes/mango/js/unslider.js') }}	
		{{ HTML::script('sximo/themes/mango/js/cslider/js/modernizr.custom.28468.js') }}
		{{ HTML::script('sximo/themes/mango/js/cslider/js/jquery.cslider.js') }}		
		{{ HTML::script('sximo/themes/mango/js/jquery.mixitup.min.js') }}	
                {{ HTML::script('js/custom.js') }}	
		<!--[if lt IE 9]>
			<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
			<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
		<![endif]-->		

  	</head>

<body >
<div class="pre-header">
        <div class="container">
            <div class="row">
                <!-- BEGIN TOP BAR LEFT PART -->
                <div class="col-md-6 col-sm-6 left">
                    <ul class="list-unstyled list-inline">
                        <li><i class="fa fa-phone"></i><span>+6221 - 2506616</span></li>
                        <li><i class="fa fa-envelope-o"></i><span>{{ CNF_EMAIL }}</span></li>
                    </ul>				
                </div>
                <!-- END TOP BAR LEFT PART -->
                <!-- BEGIN TOP BAR MENU -->
                <div class="col-md-6 col-sm-6 right">
                    <ul class="list-unstyled list-inline pull-right">
                        <span style="color:#1ab394">{{ Lang::get('core.language') }}</span>
                         @if(!Auth::check())
                            @if(CNF_MULTILANG ==1)
                            <li class="user dropdown"><a href="javascript:void(0)" class="dropdown-toggle" data-toggle="dropdown">{{ HTML::image('images/'.Lang::get('core.lang_flag')) }}<!--<i class="icon-flag2"></i>--><i class="caret"></i></a>
                                 <ul class="dropdown-menu dropdown-menu-right icons-right">                                    
                                    @foreach(SiteHelpers::langOption() as $lang)
                                        <li><a href="{{ URL::to('home/lang/'.$lang['folder'])}}">
                                            <?php if ($lang['name']=='English'){ ?>
                                               {{ HTML::image('images/britishFlagIcon.png', 'eng', array('style' => 'float:right;')) }}                                       
                                            <?php } else { ?>                                          
                                               {{ HTML::image('images/Indonesia-Flag-icon.png', 'ind', array('style' => 'float:right;')) }}  
                                            <?php } ?> 
                                            <!--<i class="icon-flag2"></i>--> {{  $lang['name'] }}</a></li>
                                    @endforeach 
                                </ul>
                            </li>   
                            @endif 
						 	<li><a href="{{ URL::to('user/login') }}"><i class="fa fa-sign-in"></i> {{ Lang::get('core.header_login') }}</a></li>
                        	<li><a href="{{ URL::to('user/register') }}"><i class="fa fa-user"></i> {{ Lang::get('core.header_regis') }}</a></li>
                            
                        @else
                                <!--<li><a href="{{-- URL::to('user/profile') --}}"><i class="fa fa-user "></i>Account</a></li>-->
                                 @if(CNF_MULTILANG ==1)
                                <li  class="user dropdown"><a href="javascript:void(0)" class="dropdown-toggle" data-toggle="dropdown">{{ HTML::image('images/'.Lang::get('core.lang_flag')) }}<!--<i class="icon-flag2"></i>--><i class="caret"></i></a>
                                     <ul class="dropdown-menu dropdown-menu-right icons-right">
                                        @foreach(SiteHelpers::langOption() as $lang)
                                            <li><a href="{{ URL::to('home/lang/'.$lang['folder'])}}">
                                                <?php if ($lang['name']=='English'){ ?>                                      
                                                    {{ HTML::image('images/britishFlagIcon.png', 'eng', array('style' => 'float:right;')) }}
                                                <?php } else { ?>                                         
                                                    {{ HTML::image('images/Indonesia-Flag-icon.png', 'ind', array('style' => 'float:right;')) }}  
                                                <?php } ?>                                              
                                                <!--<i class="icon-flag2"></i>--> {{  $lang['name'] }}</a></li>
                                        @endforeach 
                                    </ul>
                                </li>   
                                @endif  
                                <li><a href="{{ URL::to('account') }}"><i class="fa fa-user "></i>{{ Lang::get('core.header_account') }}</a></li>
                                @if(Auth::user()->group_id==1 || Auth::user()->group_id==2)
                                <li><a href="{{ URL::to('dashboard') }}"><i class="fa fa-desktop"></i>{{ Lang::get('core.header_dashboard') }}</a></li>	
                                @endif
                                <li><a href="{{ URL::to('user/logout') }}"><i class="fa  fa-sign-out"></i> {{ Lang::get('core.header_logout') }}</a></li>
                               				 
                        @endif	
                    </ul>
                </div>
                <!-- END TOP BAR MENU -->
            </div>
        </div>        
    </div>
	
	<div class="navbar navbar-default ">
                    <div class="container">
                        <div class="navbar-header">
                                <button data-target=".navbar-collapse" data-toggle="collapse" class="navbar-toggle" type="button">
                                        <span class="icon-bar"></span>
                                        <span class="icon-bar"></span>
                                        <span class="icon-bar"></span>
                                </button>
                            <a href="{{ URL::to('') }}" class="site-logo"><img src="{{ asset('sximo/themes/mango/img/logo.png')}}" alt="{{ CNF_APPNAME }}" style="height:65px;" /></a>
                        </div>
                        <div class="navbar-collapse collapse">
                                @include('layouts/mango/topbar')
                        </div><!--/nav-collapse -->

                    </div><!-- /container -->
            </div>
		
		<?php if(isset($page['breadcrumb']) &&  $page['breadcrumb'] =='active' ) { ?>			
				@include('layouts/mango/breadcrumb')
		<?php } ?>
		<div style="min-height:400px;">
		{{ $content }}
		</div>
		
		<div class="clr"></div>
	

<div class="sitemap" style="background-color: #576a76;">
	<div class=" container" >
            <!--
		<div class="col-sm-4 col-md-2 sitemap-container" >
                    <h2><small class="color-orange">Donation</small></h2>
			<ul>
				<li><a href="#" class="sitemap-all">ALL</a></li>
				<li><a href="#" class="sitemap">Personal</a></li>
				<li><a href="#" class="sitemap">Corporate</a></li>
				<li><a href="#" class="sitemap">Organization</a></li>
			</ul>
		</div>
            -->
            <div class="col-md-4 sitemap-container">
                <div style="margin-bottom:10px;"><a href='about-us' style="color:#e54a1a;">
                        <h2 style="font-size:20px;">{{ Lang::get('core.footer_about_us') }}</h2></a>
                    <div style="color:#fff;">{{ Lang::get('core.footer_about_us_d') }}</div>                   
                </div>
                
            </div>
        <div class="col-md-3 sitemap-container">
            &nbsp;
        </div>    
		<div class="col-md-5 sitemap-container">
                <div class="col-md-12 pre-footer-subscribe-box pre-footer-subscribe-box-vertical" style="padding-left:0px; padding-right:0px;">
                    <h2>{{ Lang::get('core.footer_newsletter') }}</h2>
                    <p style="color:#fff;">{{ Lang::get('core.footer_newsletter_d') }}</p>
                   <!-- Begin MailChimp Signup Form -->
                    <link href="//cdn-images.mailchimp.com/embedcode/slim-081711.css" rel="stylesheet" type="text/css">
                    <style type="text/css">
                         #mc_embed_signup{background:#576a76; clear:left; font:14px Helvetica,Arial,sans-serif; }
                        /* Add your own MailChimp form style overrides in your site stylesheet or in this style block.
                           We recommend moving this block and the preceding CSS link to the HEAD of your HTML file. */
                    </style>
                    <div id="mc_embed_signup" style="padding-right:350px;">
                        <form action="//gotongroyongfund.us11.list-manage.com/subscribe/post?u=6fef5cc8cc59e56d613f6330b&amp;id=35ed792f65" method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" class="validate" target="_blank" novalidate>
                        <div id="mc_embed_signup_scroll">    
                        <input type="email" value="" name="EMAIL" class="email" id="mce-EMAIL" style="width:330px;" placeholder="yourmail@mail.com" required>
    <!-- real people should not fill this in and expect good things - do not remove this or risk form bot signups-->
                        <div style="position: absolute; left: -5000px;"><input type="text" name="b_6fef5cc8cc59e56d613f6330b_35ed792f65" tabindex="-1" value=""></div>
                        <div class="clear"><input type="submit" value="Subscribe" name="subscribe" id="mc-embedded-subscribe" class="btn btn-primary" style="background-color:#428bca;color:#fff;"></div>
                         </div>
                        </form>
                    </div>
<!--End mc_embed_signup-->
                    <div class="col-md-12" style="padding-left:0px;padding-right:0px;margin-top:10px;">
                        <h2 class="color-orange" style="font-size:20px; margin-right:10px;">Connect with us</h2>
                         <a href="https://www.facebook.com/gotongroyongfund" class="sitemap">{{ HTML::image("img/icons/fb-icon.png", "fb", array( 'width' => 24 )) }} Facebook</a>&nbsp;
                         <a href="http://twitter.com/GRFund" class="sitemap">{{ HTML::image("img/icons/tweeter-icon.png", "twitter", array( 'width' => 24 )) }} Twitter</a>&nbsp;
                         <a href="https://plus.google.com/108338590412015686244" class="sitemap">{{ HTML::image("img/icons/Google-plus-icon.png", "vimeo", array( 'width' => 24 )) }} Google+</a>
                         <a href="https://www.youtube.com/channel/UCtjiTvU4D8cSSZYnQBGZlhA" class="sitemap">{{ HTML::image("img/icons/youtube-icon2.png", "youtube", array( 'width' => 24 )) }} Youtube</a>&nbsp;
                         <a href="https://www.linkedin.com/company/gotong-royong-fund" class="sitemap">{{ HTML::image("img/icons/lk-icon.png", "lk", array( 'width' => 24 )) }} Linkedin</a>&nbsp;
                    </div>
                </div>
                        
		</div>
            <!--
		<div class="col-sm-4 col-md-2 sitemap-container" >
			<h2><small class="color-orange">Business Loan</small></h2>
                        <ul>
                            <li><a href="{{ URL::to('business-loan') }}" class="sitemap-all">ALL</a></li>
                            <li><a href="#" class="sitemap">A Rated</a></li>
                            <li><a href="#" class="sitemap">B Rated</a></li>
                            <li><a href="#" class="sitemap">C Rated</a></li>
                            <li><a href="#" class="sitemap">Factoring</a></li>
                            <li><a href="#" class="sitemap">Purchase</a></li>
                            <li><a href="#" class="sitemap">Warehouse Receipt</a></li>
                        </ul>

		</div>-->
            <!--
		<div class="col-sm-8 col-md-2 sitemap-container" >
                    <h2><small class="color-orange">Charity</small></h2>
                    <div class="col-sm-12 col-md-12" style="padding-left:0px;">
                        <ul>
                            <li><a href="projects?title=stop-child-abuse" class="sitemap">Stop Child Abuse</a></li>
                        </ul>
                    </div>
                    <h2><small class="color-orange">Solidarity</small></h2>
                    <h2><small class="color-orange">Gift</small></h2>
                    <div class="col-sm-12 col-md-12" style="padding-left:0px;">
                        <ul>
                            <li><a href="projects?subcategory=birthday-gift" class="sitemap">Birthday</a></li>
                            <li><a href="projects?subcategory=farewell-gift" class="sitemap">Farewell</a></li>
                            <li><a href="projects?subcategory=wedding-gift" class="sitemap">Wedding</a></li>
                        </ul>
                    </div>
                                       
		</div>
                <div class="col-sm-4 col-md-2 sitemap-container" >
                    <h2><small class="color-orange">Help</small></h2>
                    <div class="col-sm-12 col-md-12" style="padding-left:0px;">
                        <ul>
                            <li><a href="faq" class="sitemap">FAQ</a></li>
                            <li><a href="create-project" class="sitemap">Getting Started</a></li>
                            <li><a href="#" class="sitemap">Term & Conditions</a></li>
                            <li><a href="privacy-policy" class="sitemap">Privacy Policy</a></li>
                            <li><a href="#" class="sitemap">Partner Term</a></li>
                            <li><a href="contact-us" class="sitemap">Support</a></li>

                        </ul>
                    </div>
                    
		</div>-->
	</div>
</div>
<div id="footer">
	<div class=" container">
		<div class="col-md-9"> Copyright 2014 {{ CNF_APPNAME }} . ALL Rights Reserved. Powered by <a href="http://www.koperasiselaras.com">Koperasi Selaras</a> <a href="privacy-policy">Privacy Policy</a> | <a href="terms-conditions">Terms</a></div>
		<div class="col-md-3"></div>
	</div>	
</div>
	
<script>
jQuery(document).ready(function() {
	$('#da-slider').cslider({
		autoplay : true,
		interval: 4000,
		bgincrement : 10
	});
		$("#btn-sub").click(function()
		{	
            var data = {"email":$("#email_news").val()};	
			console.log(data);
			
            if($("#email_news").val() == "")
			{
				alert("Email Harus Diisi");
				return;
			}
			
			$.ajax({
                    type: "POST",
                    url: "protected/app/webservice/saveNewsletter.php",
                    data: data,
                    dataType: "json",
                   
                  success: function(data)
				  {
					  alert("Terima Kasih Sudah Subscribe");
				  }
                });
        });
});
</script>
        <!-- ClickDesk Live Chat Service for websites -->
    <script type='text/javascript'>
    var _glc =_glc || []; _glc.push('all_ag9zfmNsaWNrZGVza2NoYXRyDwsSBXVzZXJzGKLY8pEMDA');
    var glcpath = (('https:' == document.location.protocol) ? 'https://my.clickdesk.com/clickdesk-ui/browser/' : 
    'http://my.clickdesk.com/clickdesk-ui/browser/');
    var glcp = (('https:' == document.location.protocol) ? 'https://' : 'http://');
    var glcspt = document.createElement('script'); glcspt.type = 'text/javascript'; 
    glcspt.async = true; glcspt.src = glcpath + 'livechat-new.js';
    var s = document.getElementsByTagName('script')[0];s.parentNode.insertBefore(glcspt, s);
    </script>
    <!-- End of ClickDesk -->
    	
</body> 
</html>