<?php
class SlideController extends BaseController 
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
			'pageTitle'	=>  'csrSlide ',
			'pageNote'	=>  '',
			'pageModule'    =>  '',
			//'trackUri' 	=> $this->trackUriSegmented()	
		);			
				
	}


    public function showSlider()
    {
        $page = 'pages.template.slide';        
        $this->layout->nest('content',$page, $this->data);        
    }

    public function showSliderEn()
    {
        $page = 'pages.template.slideEn';        
        $this->layout->nest('content',$page, $this->data);        
    }
}