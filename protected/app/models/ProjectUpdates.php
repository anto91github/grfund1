<?php
class ProjectUpdates extends BaseModel  {
	
	protected $table = 'tb_post';
	protected $primaryKey = 'post_id';

	public function __construct() {
		parent::__construct();
		
	}

	public static function querySelect(  ){
		
		
		return "  SELECT tb_post.* FROM tb_post  ";
	}
	public static function queryWhere(  ){
		
		return " WHERE tb_post.post_id IS NOT NULL   ";
	}
	
	public static function queryGroup(){
		return "  ";
	}
	

}
