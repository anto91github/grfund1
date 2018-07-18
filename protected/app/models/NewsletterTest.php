<?php
class NewsletterTest extends BaseModel  {
	
	protected $table = 'tb_newsletter';
	protected $primaryKey = 'newsletter_id';

	public function __construct() {
		parent::__construct();
		
	}

	public static function querySelect(  ){
		
		
		return "  SELECT tb_newsletter.* FROM tb_newsletter  ";
	}
	public static function queryWhere(  ){
		
		return " WHERE tb_newsletter.newsletter_id IS NOT NULL   ";
	}
	
	public static function queryGroup(){
		return "  ";
	}
	

}
