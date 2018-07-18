<?php
date_default_timezone_set("Asia/Jakarta");
class testController extends BaseController {

	/*
	|--------------------------------------------------------------------------
	| Default Home Controller
	|--------------------------------------------------------------------------
	|
	| You may wish to use controllers instead of, or in addition to, Closure
	| based routes. That's great! Here is an example controller method to
	| get you started. To route to this controller, just add the route:
	|
	|	Route::get('/', 'HomeController@showWelcome');
	|
	*/
	
	public function __construct() {
		
		parent::__construct();
		 $this->layout = "layouts.".CNF_THEME.".index";
		
		
	} 

	public function index()
	{
		$query = "SELECT * from project where title = 'Mengembalikan Penglihatan bagi Penduduk Miskin di NTT'";
		//$query = "SELECT a.title FROM project a JOIN ms_projectcategory b ON a.category=b.id WHERE a.status >= 1 AND a.label_id = 1";
		//$query .= " ORDER BY a.status desc, a.project_id desc LIMIT 0,50 ";

		/*$query = 'UPDATE project
				  SET label_id=1
				  WHERE project_id=107';*/
		$rs = DB::select($query);

		/*$backer = array(
                'label_id'=>1
            );*/
           // DB::table('project')->where('project_id',107)->update($backer);
		print_r($rs);
		exit();
	}
}