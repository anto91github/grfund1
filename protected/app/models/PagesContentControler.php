<?php
class PagesContentControler extends BaseModel  {
	
	protected $table = 'tb_pages_content';
	protected $primaryKey = 'id';

	public function __construct() {
		parent::__construct();
		
	}

	public static function querySelect(  ){
		
		
		return "  SELECT tb_pages_content.* FROM tb_pages_content  ";
	}
	public static function queryWhere(  ){
		
		return " WHERE tb_pages_content.id IS NOT NULL   ";
	}
	
	public static function queryGroup(){
		return "  ";
	}
	

}
