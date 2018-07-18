<!DOCTYPE html>

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
{{$content}}

</body> 
</html>