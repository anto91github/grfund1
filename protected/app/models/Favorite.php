<?php
class Favorite extends BaseModel  {
	
	protected $table = 'cms_favorite';
	protected $primaryKey = 'favorite_id';

	public function __construct() {
		parent::__construct();
		
	}

	public static function querySelect(  ){
		
		
		return "  SELECT cms_favorite.* FROM cms_favorite  ";
	}
	public static function queryWhere(  ){
		
		return " WHERE cms_favorite.favorite_id IS NOT NULL   ";
	}
	
	public static function queryGroup(){
		return "  ";
	}
	

}
