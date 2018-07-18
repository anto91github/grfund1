<?php
class Client extends BaseModel  {
	
	protected $table = 'cms_client';
	protected $primaryKey = 'client_id';

	public function __construct() {
		parent::__construct();
		
	}

	public static function querySelect(  ){
		
		
		return "  SELECT cms_client.* FROM cms_client  ";
	}
	public static function queryWhere(  ){
		
		return " WHERE cms_client.client_id IS NOT NULL   ";
	}
	
	public static function queryGroup(){
		return "  ";
	}
	

}
