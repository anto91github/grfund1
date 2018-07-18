<?php
class WidgetController extends BaseController 
{
	//$this->layout = "layouts..index";
	protected $layout = "layouts.mango.blank";
	protected $data = array();	
	public $module = 'create-project-content';
	static $per_page = '10';
    protected $page = 'pages.template.widgetShow';
	
	public function __construct() 
    {
		parent::__construct();
		$this->beforeFilter('csrf', array('on'=>'post'));
		//$this->model = new Project();
		//$this->info = $this->model->makeInfo( $this->module);
		//$this->access = $this->model->validAccess($this->info['id']);
	
		$this->data = array(
			'pageTitle'	=>  'Widget Show',
			'pageNote'	=>  '',
			'pageModule'    =>  '',
			//'trackUri' 	=> $this->trackUriSegmented()	
		);			
				
	}

	public function showWidget($alias=null)
    {
    	$page = 'pages.template.widgetShow';
    	$query = " SELECT * from project where project_alias = '".$alias."' ";
    	$rs = DB::select($query);
        $project_cat = array();
    	$i=0;
    	foreach($rs as $project)
    	{
    		$tmp = (array)$project;
            $tmp['fund_percent'] = round($project->fund_amount / $project->amount * 100,2);
            $tmp['days_to_go'] = date_diff(date_create(date("Y-m-d")),date_create($project->due_date));

            $query = "SELECT COUNT(backer_id) as backer FROM backer WHERE project_id = '".$project->project_id."' and status=1";
            $rsBacker = DB::select($query);
            $tmp['backer'] = 0;
            if($rsBacker != null)
            	$tmp['backer'] = $rsBacker[0]->backer;

            $query="Select SUM(backer_amount) as hitung2 FROM backer WHERE project_id = '".$project->project_id."' AND status = 1";
			$rs = DB::select($query);
			$tmp['hitung_f']=$rs[0]->hitung2;
			
			$project = (object)$tmp;
            $project_cat[$i]=$project;
            $i++;
    	}
    	$this->data['projectList'] = (object)$project_cat;
    	
    	$this->layout->nest('content',$page, $this->data);
    }

    public function showWidgetMed($alias=null)
    {
    	$page = 'pages.template.widgetMed';
    	$query = " SELECT * from project where project_alias = '".$alias."' ";
    	$rs = DB::select($query);
        $project_cat = array();
    	$i=0;
    	foreach($rs as $project)
    	{
    		$tmp = (array)$project;
            $tmp['fund_percent'] = round($project->fund_amount / $project->amount * 100,2);
            $tmp['days_to_go'] = date_diff(date_create(date("Y-m-d")),date_create($project->due_date));

            $query = "SELECT COUNT(backer_id) as backer FROM backer WHERE project_id = '".$project->project_id."' and status=1";
            $rsBacker = DB::select($query);
            $tmp['backer'] = 0;
            if($rsBacker != null)
            	$tmp['backer'] = $rsBacker[0]->backer;

            $query="Select SUM(backer_amount) as hitung2 FROM backer WHERE project_id = '".$project->project_id."' AND status = 1";
			$rs = DB::select($query);
			$tmp['hitung_f']=$rs[0]->hitung2;
			
			$project = (object)$tmp;
            $project_cat[$i]=$project;
            $i++;
    	}
    	$this->data['projectList'] = (object)$project_cat;
    	
    	$this->layout->nest('content',$page, $this->data);
    }

    public function showWidgetSml($alias=null)
    {
        $page = 'pages.template.widgetSml';
        $query = " SELECT * from project where project_alias = '".$alias."' ";
        $rs = DB::select($query);
        $project_cat = array();
        $i=0;
        foreach($rs as $project)
        {
            $tmp = (array)$project;
            $tmp['fund_percent'] = round($project->fund_amount / $project->amount * 100,2);
            $tmp['days_to_go'] = date_diff(date_create(date("Y-m-d")),date_create($project->due_date));

            $query = "SELECT COUNT(backer_id) as backer FROM backer WHERE project_id = '".$project->project_id."' and status=1";
            $rsBacker = DB::select($query);
            $tmp['backer'] = 0;
            if($rsBacker != null)
                $tmp['backer'] = $rsBacker[0]->backer;

            $query="Select SUM(backer_amount) as hitung2 FROM backer WHERE project_id = '".$project->project_id."' AND status = 1";
            $rs = DB::select($query);
            $tmp['hitung_f']=$rs[0]->hitung2;
            
            $project = (object)$tmp;
            $project_cat[$i]=$project;
            $i++;
        }
        $this->data['projectList'] = (object)$project_cat;
        
        $this->layout->nest('content',$page, $this->data);
    }

    public function showWidgetGen()
    {
    $page = 'pages.template.widgetgen';  
        
    $this->layout->nest('content',$page, $this->data);
    }

    public function showWidgetGenMed()
    {
        $page = 'pages.template.widgetGenMed';

        
        $this->layout->nest('content',$page, $this->data);
    }
    public function showWidgetGenSml()
    {
        $page = 'pages.template.widgetGenSml';

        
        $this->layout->nest('content',$page, $this->data);
    }
}