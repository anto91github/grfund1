<?php
$domain= apache_request_headers();
/*$base_url= '';
		if($domain['Host']= 'localhost')
		{
			$base_url = 'http://localhost/grfund/fbauth/auth';			
		}
		else
		{
			$base_url = $domain['Host'].'/fbauth/auth';
		}*/
$base_url = 'http://'.$_SERVER['HTTP_HOST'].'/fbauth/auth';	


return array(
    "base_url" => $base_url ,
    "providers" => array (
        "Facebook" => array (
            "enabled" => TRUE,
            "keys" => array ("id" => "835062946569282", "secret" =>"55df0dc31f7014a8fd27ae408b6f320a"),
            "scope" => "public_profile,email"
        )
    )
);

