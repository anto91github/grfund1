<?php
class Backer extends BaseModel  {
	
	protected $table = 'backer';
	protected $primaryKey = 'backer_id';

	public function __construct() {
		parent::__construct();
		
	}

	public static function querySelect(  ){
		
		
		return "  SELECT backer.* FROM backer  ";
	}
	public static function queryWhere(  ){
		
		return " WHERE backer.backer_id IS NOT NULL   ";
	}
	
	public static function queryGroup(){
		return "  ";
	}
	

}
