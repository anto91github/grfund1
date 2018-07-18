<?php
class Report extends BaseModel  {
	
	protected $table = 'report';
	protected $primaryKey = 'report_id';

	public function __construct() {
		parent::__construct();
		
	}

	public static function querySelect(  ){
		
		
		return "  SELECT report.* FROM report  ";
	}
	public static function queryWhere(  ){
		
		return " WHERE report.report_id IS NOT NULL   ";
	}
	
	public static function queryGroup(){
		return "  ";
	}
	

}
