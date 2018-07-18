<?php
class CreateProjectContentController extends BaseController {

	//protected $layout = "layouts.main";
        protected $layout = "layouts.main";
	protected $data = array();	
	public $module = 'create-project-content';
	static $per_page = '10';
        protected $page = 'pages.template.createprojectcontent';
	
	public function __construct() {
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

	
	public function getIndex()
	{
                if(!Auth::check() || !Session::has('createproject'))
                {
                    return Redirect::to('create-project');
                }
                $this->layout = View::make("layouts.".CNF_THEME.".index");

      $projectID = Session::get('projectID');
      $query="select * from project where project_id= $projectID";
      $rs = DB::select($query);     
      $this->data['value_p'] = $rs;
      $this->data['amount'] = $rs[0]->amount;
      $this->data['due_date'] = $rs[0]->due_date;

      $query2 = "select * from reward where project_id= $projectID";
      $rs2 = DB::select($query2);  
      $this->data['rewards'] = $rs2;
      $this->data['project_id'] = $rs[0]->project_id;  

		// Render into template
                //$page = SiteHelpers::renderHtml($this->page);
		$this->layout->nest('content',$this->page, $this->data);
	}
        
	public function postContentproject()
    {
            
            $projectContent = Input::get('editor1');            

            /*$realname = Input::file('photo1')->getClientOriginalName();
            Input::file('photo1')->move($destinationPath, $realname);

            $realname2 = Input::file('photo2')->getClientOriginalName();
            Input::file('photo2')->move($destinationPath, $realname2);

            $realname3 = Input::file('photo3')->getClientOriginalName();
            Input::file('photo3')->move($destinationPath, $realname3);*/
            


            $sessionProject = Session::get('createproject');
            
            //$duedate = $sessionProject['projectEndDate'];
            //$arr = explode("/",$duedate);
            //$duedate = $arr[2]."-".$arr[0]."-".$arr[1];
            
            //$amount = str_replace(array("Rp ","_","."), "", $sessionProject['projectAmount']);
            
            //$tmpPath = "img/tmp/";
            //$arr= explode("/",$sessionProject['projectImage']);
            //copy($tmpPath.$arr[count($arr)-1] ,"uploads/banner/".$arr[count($arr)-1]);
            
            
            $alias = str_replace(array("\"","'","’",":"," & ","&","?",",",".","!","@","#","|"," | ","/",";","(",")"),"", htmlentities(Input::get("projectName")));
            $alias = str_replace(array(" ","  "),"-", $alias);
            
            //$tags = str_replace(",","|", $sessionProject['projectTags']);
			/*$tags = $sessionProject['projectTags'];
			if($tags==null) $tags='';
            
            $category = 1;
            switch($sessionProject['projectCategory']){
                case "charity" : $category = 2; break;
                case "solidarity" : $category = 3; break;
                case "birthday-gift" :
                case "farewell-gift" :
                case "wedding-gift" :
                    $category = 4; break;
                default : $category = 1; break;
            }*/
                        
            /*$dataProject = array(
                'title'=>$sessionProject['projectName'],
                'author'=>Auth::id(),
                'category'=>$category,
                'start_date'=>date('Y-m-d'),
                'small_content'=>$sessionProject['projectSmallContent'] == null ? '' : $sessionProject['projectSmallContent'],
                'content'=>$projectContent,
                'due_date'=>$duedate,
                'banner_img'=>$arr[count($arr)-1],
                'amount'=>$amount,
                'fund_amount'=>0,
                'status'=>0,
                'created_date'=>date('Y-m-d h:i:s'),
                'modified_by'=>' ',
                'modified_date'=>date('Y-m-d h:i:s'),
                'subcategory'=>$sessionProject['projectCategory'],
                'entry_by'=>Auth::id(),
                'project_tags'=>$tags,
                'project_alias'=>$alias,
                'recipient'=>$sessionProject['recipientName']
            );*/
            
                /*$dataProject = array(
                'issue'=>Input::get("issue"),
                'who_we_are'=>Input::get("who"),
                'what_need'=>Input::get("need"),
                'impact'=>Input::get("impact"),
                'time_line'=>Input::get("time_line"),
                'ack_reward'=>Input::get("ack"),
                'facebook'=>Input::get("facebook"),
                'facebook_id'=>Input::get("facebook_id"),
                'twitter'=>Input::get("twitter"),
                'twitter_id'=>Input::get("twitter_id"),
                'google'=>Input::get("google"),
                'google_id'=>Input::get("google_id"),
                'instagram'=>Input::get("instagram"),
                'instagram_id'=>Input::get("instagram_id"),
                'youtube'=>Input::get("youtube"),
                'youtube_id'=>Input::get("youtube_id"),
                'linkedin'=>Input::get("linkedin"),
                'linkedin_id'=>Input::get("linkedin_id"),
                //'img_content1'=>$realname,
                //'img_content2'=>$realname2,
                //'img_content3'=>$realname3,
                'url'=>Input::get("url")
            );*/

            $dataProject = array(
              'content'=>$projectContent  
            );

             $projectID = Session::get('projectID');
             $destinationPath = "uploads/project/";
             $realname = "";

            /*if (isset($_POST['photo1']) && $_POST['photo1'] == '') {
                    $realname = "default_project.jpg";
                    $dataProject['img_content1'] = $realname;
                } elseif ($_FILES['photo1']['error'] == 0)  {
                    $photo_name =  $projectID."-1-";
                    $realname = $photo_name."".Input::file('photo1')->getClientOriginalName();       
                    Input::file('photo1')->move($destinationPath, $realname);
                    $dataProject['img_content1'] = $realname;
                } else {
                    //do nothing
                }

            if (isset($_POST['photo2']) && $_POST['photo2'] == '') {
                    $realname = "default_project.jpg";
                    $dataProject['img_content2'] = $realname;
                } elseif ($_FILES['photo2']['error'] == 0)  {
                    $photo_name =  $projectID."-2-";
                    $realname = $photo_name."".Input::file('photo2')->getClientOriginalName();
                    Input::file('photo2')->move($destinationPath, $realname);
                    $dataProject['img_content2'] = $realname;
                } else {
                    //do nothing
                }

            if (isset($_POST['photo3']) && $_POST['photo3'] == '') {
                    $realname = "default_project.jpg";
                    $dataProject['img_content3'] = $realname;
                } elseif ($_FILES['photo3']['error'] == 0)  {
                    $photo_name =  $projectID."-3-";
                    $realname = $photo_name."".Input::file('photo3')->getClientOriginalName();
                    Input::file('photo3')->move($destinationPath, $realname);
                    $dataProject['img_content3'] = $realname;
                } else {
                    //do nothing
                }*/
            DB::table('project')->where('project_id',$projectID)->update($dataProject);
            
            //unlink($tmpPath.$arr[count($arr)-1]);
            
            Session::forget('createproject');

            $query="select project_alias from project where project_id= $projectID";
            $rs = DB::select($query); 

      
            
            if(Auth::check())
            {
                    //return Redirect::to('manage-project/'.$alias);
                    return Redirect::to('submit-project/'.$rs[0]->project_alias);
            }else{
                    return Redirect::to('');
            }
            
        } 

        public function postAddContentReward(){

            //echo "masuk sini";
            //exit();
            
            $minimum = str_replace(array("Rp ","_","."), "", Input::get("rewardMinimum0"));
            
            $dataReward = array(
                'reward_title'=>Input::get("rewardTitle0"),
                'reward_description'=>Input::get("rewardDescription0"),
                'reward_minimum'=>$minimum,
                'reward_available'=>Input::get("rewardAvailable0"),
                'project_id' => Input::get("projectId")
            );
            
            $destinationPath = "uploads/reward/";
            $realname = "";
            //$realname = Input::file('projectPhoto')->getClientOriginalName();
            //Input::file('projectPhoto')->move($destinationPath, $realname);
            
            if (isset($_POST['rewardImage']) && $_POST['rewardImage'] == '') {
                    $realname = "images/default_project.png";
                    $dataReward['reward_image'] = $realname;
                } elseif ($_FILES['rewardImage']['error'] == 0)  {
                    //change avatar
                    //echo Input::file('avatar')->getClientOriginalName();
                    $realname = Input::file('rewardImage')->getClientOriginalName();
                    Input::file('rewardImage')->move($destinationPath, $realname);
                    $dataReward['reward_image'] = $realname;
                } else {
                    //do nothing
                }
            
            $id = DB::table('reward')->insertGetId(
                $dataReward
            );
            
            $query = "SELECT project_alias FROM project WHERE project_id = '".Input::get("projectId")."'";
            $rs = DB::select($query);
            
            if(!$rs){
               return Redirect::to("create-project-content?t=2")->with('message', 'Add Reward Failed');
            }else{            
                return Redirect::to("create-project-content?t=2")->with('message', 'Add Reward Success');
            }
        } 

}