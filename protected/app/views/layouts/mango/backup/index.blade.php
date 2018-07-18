<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title> <?php echo isset($page['pageTitle']) ? $page['pageTitle'].' | '.$page['pageNote'] : CNF_APPNAME ;?></title>
<meta name="keywords" content="{{ CNF_METAKEY }}">
<meta name="description" content="{{ CNF_METADESC }}"/>
<link rel="shortcut icon" href="{{ URL::to('')}}/logo.ico" type="image/x-icon">	
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
                        <li><i class="fa fa-phone"></i><span>+1 765 1190</span></li>
                        <li><i class="fa fa-envelope-o"></i><span>Support@mycompany.com</span></li>
                    </ul>				
                </div>
                <!-- END TOP BAR LEFT PART -->
                <!-- BEGIN TOP BAR MENU -->
                <div class="col-md-6 col-sm-6 right">
                    <ul class="list-unstyled list-inline pull-right">
                         @if(!Auth::check()) 
						 	<li><a href="{{ URL::to('user/login') }}"><i class="fa fa-sign-in"></i> Log In</a></li>
                        	<li><a href="{{ URL::to('user/register') }}"><i class="fa fa-user"></i> Registration</a></li>
                        @else
                                <!--<li><a href="{{-- URL::to('user/profile') --}}"><i class="fa fa-user "></i>Account</a></li>-->
                                <li><a href="{{ URL::to('account') }}"><i class="fa fa-user "></i>Account</a></li>
                                @if(Auth::user()->group_id==1)
                                <li><a href="{{ URL::to('dashboard') }}"><i class="fa fa-desktop"></i> Dashboard</a></li>	
                                @endif
                                <li><a href="{{ URL::to('user/logout') }}"><i class="fa  fa-sign-out"></i> Log Out</a></li>					 
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
                            <a href="{{ URL::to('') }}" class="site-logo"><img src="{{ asset('sximo/themes/mango/img/logo.png')}}" alt="{{ CNF_APPNAME }}" /></a>
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
	

<div class="sitemap" style="background-color: #333333;">
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
                <div style="margin-bottom:10px;"><a href='about-us'>
                        <h2 class="color-orange" style="font-size:20px;">About Us</h2></a>
                <div style="color:#fff;">GotongRoyongFund is a sub-division of Koperasi Selaras, an Indonesian Cooperative involves in micro financing, commodities trading and corporate farming to local farmers in Eastern of Indonesia, Sumatra and Sulawesi.<br/><br/>
                    Koperasi Selaras’s established from 2011 and our management comes from a collection experts in finance, commodities, technology and art.</div>                   
              </div>
                <div class="photo-stream">
                <h2>Photos Stream</h2>
                <ul class="list-unstyled">
                  <li><a href="#">{{ HTML::image("img/people/img5-small.jpg", "People") }}</a></li>
                  <li><a href="#">{{ HTML::image("img/works/img1.jpg", "Works") }}</a></li>
                  <li><a href="#">{{ HTML::image("img/people/img4-large.jpg", "People") }}</a></li>
                  <li><a href="#">{{ HTML::image("img/works/img6.jpg", "Works") }}</a></li>
                  <li><a href="#">{{ HTML::image("img/works/img3.jpg", "Works") }}</a></li>
                  <li><a href="#">{{ HTML::image("img/people/img2-large.jpg", "People") }}</a></li>
                  <li><a href="#">{{ HTML::image("img/works/img2.jpg", "Works") }}</a></li>
                  <li><a href="#">{{ HTML::image("img/works/img5.jpg", "Works") }}</a></li>
                  <li><a href="#">{{ HTML::image("img/people/img5-small.jpg", "People") }}</a></li>
                  <li><a href="#">{{ HTML::image("img/works/img1.jpg", "Works") }}</a></li>
                </ul>                    
              </div>
            </div>
		<div class="col-sm-8 col-md-4 sitemap-container">
			<h2><small class="color-orange">Project</small></h2>
                        <div class="col-sm-6 col-md-6" style="padding-left:0px;">
                            <ul>
				<li><a href="projects?subcategory=art" class="sitemap">Art</a></li>
				<li><a href="projects?subcategory=crafts" class="sitemap">Crafts</a></li>
				<li><a href="projects?subcategory=dance" class="sitemap">Dance</a></li>
                                <li><a href="projects?subcategory=design" class="sitemap">Design</a></li>
                                <li><a href="projects?subcategory=film-video" class="sitemap">Film & Video</a></li>
                                <li><a href="projects?subcategory=fashion" class="sitemap">Fashion</a></li>
                                <li><a href="projects?subcategory=food" class="sitemap">Food</a></li>
                            </ul>
                        </div>
			<div class="col-sm-6 col-md-6" style="padding-left:0px;">
                            <ul>
				<li><a href="projects?subcategory=games" class="sitemap">Games</a></li>
				<li><a href="projects?subcategory=journalism" class="sitemap">Journalism</a></li>
				<li><a href="projects?subcategory=music" class="sitemap">Music</a></li>
                                <li><a href="projects?subcategory=photography" class="sitemap">Photography</a></li>
				<li><a href="projects?subcategory=publishing" class="sitemap">Publishing</a></li>
				<li><a href="projects?subcategory=technology" class="sitemap">Technology</a></li>
                                <li><a href="projects?subcategory=theater" class="sitemap">Theater</a></li>
                            </ul>
                        </div>
                        <div class="col-md-12 pre-footer-subscribe-box pre-footer-subscribe-box-vertical" style="padding-left:0px;">
                            <h2>Newsletter</h2>
                            <p>Subscribe to our newsletter and stay up to date with the latest news!</p>
                            <form action="#">
                              <div class="input-group">
                                <input type="text" placeholder="youremail@mail.com" class="form-control">
                                <span class="input-group-btn">
                                  <button class="btn btn-primary" type="submit">Subscribe</button>
                                </span>
                              </div>
                            </form>
                          </div>
                        <div class="col-md-12" style="padding-left:0px;padding-right:0px;margin-top:10px;">
                            <h2 class="color-orange" style="font-size:20px; margin-right:10px;">Connect with us</h2>
                            <a href="#" class="sitemap">{{ HTML::image("img/icons/tweeter-icon.png", "twitter", array( 'width' => 24 )) }} Twitter</a>&nbsp;
                            <a href="#" class="sitemap">{{ HTML::image("img/icons/fb-icon.png", "fb", array( 'width' => 24 )) }} Facebook</a>&nbsp;
                            <a href="#" class="sitemap">{{ HTML::image("img/icons/lk-icon.png", "lk", array( 'width' => 24 )) }} Linkedin</a>&nbsp;
                            <a href="#" class="sitemap">{{ HTML::image("img/icons/youtube-icon2.png", "youtube", array( 'width' => 24 )) }} Youtube</a>&nbsp;
                            <a href="#" class="sitemap">{{ HTML::image("img/icons/vimeo-icon.png", "vimeo", array( 'width' => 24 )) }} Vimeo</a>
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
                    <!--
			<h2><small class="color-orange">Follow Us</small></h2>
			<ul style="list-style:none;">
                            <li><a href="#" class="sitemap"><img src="img/icons/tweeter-icon.png" /> Twitter</a></li>
                            <li><a href="#" class="sitemap"><img src="img/icons/fb-icon.png" /> Facebook</a></a></li>
                            <li><a href="#" class="sitemap"><img src="img/icons/lk-icon.png" /> Linkedin</a></a></li>
                            <li><a href="#" class="sitemap"><img src="img/icons/youtube-icon.png" /> Youtube</a></a></li>
                            <li><a href="#" class="sitemap"><img src="img/icons/vimeo-icon.png" /> Vimeo</a></a></li>
                        </ul>-->
		</div>
	</div>
</div>
<div id="footer">
	<div class=" container">
		<div class="col-md-9"> Copyright 2014 {{ CNF_APPNAME }} . ALL Rights Reserved. Powered by <a href="http://www.koperasiselaras.com">Koperasi Selaras</a> <a href="privacy-policy">Privacy Policy</a> | <a href="#">Terms of Service</a></div>
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
});
</script>	
</body> 
</html>