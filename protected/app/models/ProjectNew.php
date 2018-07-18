<?php
class ProjectNew extends BaseModel  {
	
	protected $table = 'project';
	protected $primaryKey = 'project_id';

	public function __construct() {
		parent::__construct();
		
	}

	public static function querySelect(  ){
		
		
		//return "  SELECT project.* FROM project  ";
		return "  SELECT project.project_id,project.title,project.author,project.due_date,project.amount,project.status, 
				  tb_users.first_name, tb_users.last_name,
				  ms_status.status
				  FROM project
				  LEFT JOIN tb_users on project.author=tb_users.id
				  LEFT JOIN ms_status on project.status=ms_status.status_id
		  ";
	}
	public static function queryWhere(  ){
		
		return " WHERE project.project_id IS NOT NULL   ";
		//return " WHERE a.project_id IS NOT NULL   ";
	}
	
	public static function queryGroup(){
		return "  ";
	}
	

}
