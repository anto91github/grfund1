<?php
class ForgotPasswordController extends BaseController 
{

	//protected $layout = "layouts.main";
        protected $layout = "layouts.main";
	protected $data = array();	
	public $module = 'create-project-content';
	static $per_page = '10';
        protected $page = 'pages.template.createprojectcontent';
	
	public function __construct() 
    {
		parent::__construct();
		$this->beforeFilter('csrf', array('on'=>'post'));
		//$this->model = new Project();
		//$this->info = $this->model->makeInfo( $this->module);
		//$this->access = $this->model->validAccess($this->info['id']);
	
		$this->data = array(
			'pageTitle'	=>  'Content Project',
			'pageNote'	=>  'Content Project',
			'pageModule'    =>  'create-project-content',
			//'trackUri' 	=> $this->trackUriSegmented()	
		);
			
				
	}

    public function requestPassword()
    {        
       if (User::where('email', '=', Input::get('femail'))->exists()) 
       {
          $to = Input::get('femail');
          $subject = "Forgot Password";
          $txt = "You have request new password from gotongroyong.fund. Your new password is";
          //$headers = "From: webmaster@example.com" . "\r\n" .
          //"CC: somebodyelse@example.com";
          $headers = "From: support@gotongroyong.fund";       
          
        mail($to,$subject,$txt,$headers);
        return Redirect::to('forgot-password')->with('message', "Your password has been sent to your Email");
       }
       else
       {
        return Redirect::to('forgot-password')->with('message', "Email is not Registered");
       }
    } 
	
} 
