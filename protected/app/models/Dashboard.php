<?php
class Dashboard extends BaseModel  {
	
	protected $table = 'project';
	protected $primaryKey = 'project_id';

	public function __construct() {
		parent::__construct();
		
	}

	public static function querySelect(){		
		
		$query = "SELECT * FROM project inner join tb_users on project.author=tb_users.id WHERE status = 0 ";
        $rs = DB::select($query);
        return $rs;
	}

	public static function expiredProject(){		
		
		$query = "SELECT * FROM project WHERE status =1 and DATEDIFF(due_date, now()) <= 0 ";
        $rs = DB::select($query);
        $tmp_pop = array();
        $i =0 ;
        foreach($rs as $hitung)
        {
        	$tmp = (array)$hitung;
        	$query2= "SELECT SUM(backer_amount) as funded from backer where project_id = $hitung->project_id and status = 1";
        	$rs2 = DB::select($query2);
        	$tmp['funded']=$rs2[0]->funded;
        	$tmp_pop[$i]=(object)$tmp;
        	$i++;
        } 
        return $tmp_pop;
	}

	public static function draftBacker(){
		$query = "SELECT * FROM backer 
				 left join project on backer.project_id = project.project_id 
				 left join reward on backer.reward_id = reward.reward_id
				 left join backer_payment on backer.backer_id  = backer_payment.backer_id 
				 where backer.status = 0";
        $rs = DB::select($query);
        return $rs;
	}

	public static function cancelProject(){
		$query = "SELECT * FROM project inner join tb_users on project.author = tb_users.id WHERE status = -1 ";
        $rs = DB::select($query);
        return $rs;
	}
	
	

}
