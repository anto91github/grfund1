<?php
class Comment extends BaseModel  {
	
	protected $table = 'tb_comment';
	protected $primaryKey = 'comment_id';

	public function __construct() {
		parent::__construct();
		
	}

	public static function querySelect(  ){
		
		
		return "  SELECT tb_comment.* FROM tb_comment  ";
	}
	public static function queryWhere(  ){
		
		return " WHERE tb_comment.comment_id IS NOT NULL   ";
	}
	
	public static function queryGroup(){
		return "  ";
	}
	

}
