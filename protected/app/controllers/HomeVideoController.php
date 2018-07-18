<?php
class HomeVideoController extends BaseController 
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
        $this->layout = "layouts.mango.blank";
    }

    public function showVideo()
    {        
        $page = 'pages.template.homeVideo';

        $query = "SELECT * FROM ms_label where label_id !=1 AND label_id != 2 AND status !=0";
        $rs = DB::select($query);
        $project_cat = array();

        //$this->data['label'] = (object)$project_cat;
        $this->data['label'] = $rs;
        $this->data['label_2'] = (object)$rs;
        


        $this->layout->nest('content',$page, $this->data);
        
    }
}