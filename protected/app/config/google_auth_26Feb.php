<?php
$domain2 = apache_request_headers();
/*$base_url2 = '';
		if($domain2['Host']= 'localhost')
		{
			$base_url2 = 'http://localhost/grfund/gauth/auth';			
		}
		else
		{
			$base_url2 = $domain['Host'].'/gauth/auth';
		}*/
$base_url2 = 'http://'.$_SERVER['HTTP_HOST'].'/gauth/auth';	

return array(
    "base_url" => $base_url2,
    "providers" => array (
        "Google" => array (
            "enabled" => true,
            "keys"    => array ( "id" => "414323831550-9apstpvgmkmps94bcbf0e90gg66sp22h.apps.googleusercontent.com", "secret" => "vPJJSV2UUyhxXyWiQvju51kE" ),
            "scope"           => "https://www.googleapis.com/auth/userinfo.profile ". // optional
                "https://www.googleapis.com/auth/userinfo.email"

        )));