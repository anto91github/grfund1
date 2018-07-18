<?php
class GetWidget extends BaseModel  {
	
	protected $table = 'getwidget';
	protected $primaryKey = 'id';

	public function __construct() {
		parent::__construct();
		
	}

	public static function querySelect(  ){
		
		
		return "  SELECT getwidget.* FROM getwidget  ";
	}
	public static function queryWhere(  ){
		
		return " WHERE getwidget.id IS NOT NULL   ";
	}
	
	public static function queryGroup(){
		return "  ";
	}
	

}
