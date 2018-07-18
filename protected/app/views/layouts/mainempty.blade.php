<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
                {{ HTML::style('sximo/js/plugins/bootstrap/css/bootstrap.css')}}
		{{ HTML::style('sximo/fonts/awesome/css/font-awesome.min.css')}}
                
                {{ HTML::script('sximo/js/plugins/jquery.min.js') }}
		{{ HTML::script('sximo/js/plugins/jquery.cookie.js') }}			
		{{ HTML::script('sximo/js/plugins/jquery-ui.min.js') }}	
                {{ HTML::script('sximo/js/plugins/bootstrap/js/bootstrap.js') }}
</head>

<body >
		{{ $content }}		 
</body> 
</html>