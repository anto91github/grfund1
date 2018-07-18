<?php
$domain3= apache_request_headers();
$base_url3= '';
		if($domain3['Host']= 'localhost')
		{
			$base_url3 = 'http://localhost/grfund/user/socmed';			
		}
		else
		{
			$base_url3 = $domain['Host'].'/user/socmed';
		}

return array(	
	"base_url"   => $base_url3,
	"providers"  => array (
		"Google"     => array (
			"enabled"    => true,
			"keys"       => array ( "id" => "1038196167526-euluve7af4mhfgde9vr79a8s1or4t8it", "secret" => "Z_Wq238T-bSWC5Azmyk2jSs6" ),
			),
		"Facebook"   => array (
			"enabled"    => true,
			"keys"       => array ( "id" => "835062946569282", "secret" => "55df0dc31f7014a8fd27ae408b6f320a" ),
			),
		"Twitter"    => array (
			"enabled"    => true,
			"keys"       => array ( "key" => "q2NR24fPB2VtayTOMa6NDAG9s", "secret" => "deLBI0nVkllV1aAOrohk0X9nDJY1tognRQO2myJsGis9GnmBCY" )
			)
	),
);