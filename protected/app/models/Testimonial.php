<?php
class Testimonial extends BaseModel  {
	
	protected $table = 'testimonial';
	protected $primaryKey = 'id';

	public function __construct() {
		parent::__construct();
		
	}

	public static function querySelect(  ){
		
		
		return "  SELECT testimonial.* FROM testimonial  ";
	}
	public static function queryWhere(  ){
		
		return " WHERE testimonial.id IS NOT NULL   ";
	}
	
	public static function queryGroup(){
		return "  ";
	}
	

}
