<?php
class ReportNewProject extends BaseModel  {
	
	protected $table = 'rep_new_project';
	protected $primaryKey = 'rep_id';

	public function __construct() {
		parent::__construct();
		
	}

	public static function querySelect(  ){
		
		
		return "  SELECT rep_new_project.* FROM rep_new_project  ";
	}
	public static function queryWhere(  ){
		
		return " WHERE rep_new_project.rep_id IS NOT NULL   ";
	}
	
	public static function queryGroup(){
		return "  ";
	}
	

}
