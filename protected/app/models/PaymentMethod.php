<?php
class PaymentMethod extends BaseModel  {
	
	protected $table = 'backer_payment';
	protected $primaryKey = 'backer_payment_id';

	public function __construct() {
		parent::__construct();
		
	}

	public static function querySelect(  ){
		
		
		return "  SELECT backer_payment.* FROM backer_payment  ";
	}
	public static function queryWhere(  ){
		
		return " WHERE backer_payment.backer_payment_id IS NOT NULL   ";
	}
	
	public static function queryGroup(){
		return "  ";
	}
	

}
