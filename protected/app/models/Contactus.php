<?php
class Contactus extends BaseModel  {
	
	protected $table = 'contact_us';
	protected $primaryKey = 'id';

	public function __construct() {
		parent::__construct();
		
	}

	public static function querySelect(  ){
		
		
		return "  SELECT contact_us.* FROM contact_us  ";
	}
	public static function queryWhere(  ){
		
		return " WHERE contact_us.id IS NOT NULL   ";
	}
	
	public static function queryGroup(){
		return "  ";
	}
	

}
