<?php

class DashboardController extends BaseController  {

	protected $layout = "layouts.main";
	protected $data= array();
	
	public function __construct() {
		parent::__construct();
	}
	
	public function getIndex()
	{
		$this->model = new Dashboard();
		$rs = $this->model->querySelect();
		$this->data['pending'] = $rs;

		$rs = $this->model->expiredProject();		
		$this->data['expired'] = $rs;

		$rs = $this->model->draftBacker();
		$this->data['draft'] = $rs;	

		$rs = $this->model->cancelProject();
		$this->data['cancel'] = $rs;

		$this->layout->nest('content','dashboard.index',$this->data);	
	}		
	
}	