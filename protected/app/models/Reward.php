<?php
class Reward extends BaseModel  {
	
	protected $table = 'reward';
	protected $primaryKey = 'reward_id';

	public function __construct() {
		parent::__construct();
		
	}

	public static function querySelect(  ){
		
		
		return "  SELECT reward.* FROM reward  ";
	}
	public static function queryWhere(  ){
		
		return " WHERE reward.reward_id IS NOT NULL   ";
	}
	
	public static function queryGroup(){
		return "  ";
	}
	

}
