<?php
date_default_timezone_set("Asia/Jakarta");
class ManageProjectController extends BaseController {
	//protected $layout = "layouts.main";
        protected $layout = "layouts.main";
	protected $data = array();	
	public $module = 'manage-project';
	static $per_page	= '10';
        protected $page = 'pages.template.manageproject';
	
	public function __construct() {
		parent::__construct();
		$this->beforeFilter('csrf', array('on'=>'post'));
		//$this->model = new Project();
		//$this->info = $this->model->makeInfo( $this->module);
		//$this->access = $this->model->validAccess($this->info['id']);
	
		$this->data = array(
			'pageTitle'	=>  'Manage Project',
			'pageNote'	=>  'Manage New Project',
			'pageModule'    =>  'manage-project',
			//'trackUri' 	=> $this->trackUriSegmented()	
		);
			
				
	} 

	
	public function getIndex()
	{
                //$pageName = Request::segment(1);  to get page name for validasi access
                
		//if($this->access['is_view'] ==0) 
			//return Redirect::to('')
				//->with('message', SiteHelpers::alert('error',Lang::get('core.note_restric')));
				
		/*
                // Filter sort and order for query 
		$sort = (!is_null(Input::get('sort')) ? Input::get('sort') : 'project_id'); 
		$order = (!is_null(Input::get('order')) ? Input::get('order') : 'asc');
		// End Filter sort and order for query 
		// Filter Search for query		
		$filter = (!is_null(Input::get('search')) ? $this->buildSearch() : '');
		// End Filter Search for query 
		
		// Take param master detail if any
		$master  = $this->buildMasterDetail(); 
		// append to current $filter
		$filter .=  $master['masterFilter'];
	
		
		$page = Input::get('page', 1);
		$params = array(
			'page'		=> $page ,
			'limit'		=> (!is_null(Input::get('rows')) ? filter_var(Input::get('rows'),FILTER_VALIDATE_INT) : static::$per_page ) ,
			'sort'		=> $sort ,
			'order'		=> $order,
			'params'	=> $filter,
			'global'	=> (isset($this->access['is_global']) ? $this->access['is_global'] : 0 )
		);
		// Get Query 
		$results = $this->model->getRows( $params );		
		
		// Build pagination setting
		$page = $page >= 1 && filter_var($page, FILTER_VALIDATE_INT) !== false ? $page : 1;	
		$pagination = Paginator::make($results['rows'], $results['total'],$params['limit']);		
		
		
		$this->data['rowData']		= $results['rows'];
		// Build Pagination 
		$this->data['pagination']	= $pagination;
		// Build pager number and append current param GET
		$this->data['pager'] 		= $this->injectPaginate();	
		// Row grid Number 
		$this->data['i']			= ($page * $params['limit'])- $params['limit']; 
		// Grid Configuration 
		$this->data['tableGrid'] 	= $this->info['config']['grid'];
		$this->data['tableForm'] 	= $this->info['config']['forms'];
		$this->data['colspan'] 		= SiteHelpers::viewColSpan($this->info['config']['grid']);		
		// Group users permission
		$this->data['access']		= $this->access;
		// Detail from master if any
		$this->data['masterdetail']  = $this->masterDetailParam(); 
		$this->data['details']		= $master['masterView'];
		// Master detail link if any 
		$this->data['subgrid']	= (isset($this->info['config']['subgrid']) ? $this->info['config']['subgrid'] : array()); 
		// Render into template
		$this->layout->nest('content','project.index',$this->data)
						->with('menus', SiteHelpers::menus());
                 * 
                 */
            

                $this->layout = View::make("layouts.".CNF_THEME.".index");
		// Render into template
		$this->layout->nest('content',$this->page, $this->data);
	}
        
	public function postUpdateProject(){
            date_default_timezone_set("Asia/Jakarta");
            $duedate = Input::get("projectEndDate");
            $arr = explode("/",$duedate);
            $duedate = $arr[2]."-".$arr[0]."-".$arr[1];
            
            $amount = str_replace(array("Rp ","_","."), "", Input::get("mask_currency"));
            
            $alias = str_replace(array("\"","'","’",":"," & ","&","?",",",".","!","@","#",")","("),"", Input::get('projectName'));
            $alias = str_replace(" ","-", $alias);
            
            $tags = str_replace(",","|",Input::get("projectTags"));
            
            //$status = Input::get("slcStatus");
            
            /*$category = 10;
            switch(Input::get("categoryselect")){
                case "charity" : $category = 2; break;
                case "solidarity" : $category = 3; break;
                case "birthday-gift" :
                case "farewell-gift" :
                case "wedding-gift" :
                    $category = 4; break;
                default : $category = 10; break;
            }*/
            $category= Input::get("categoryselect");
            
            $dataProject = array(
                'title'=>Input::get("projectName"),
                'category'=>$category,
                'small_content'=>Input::get('editor1') == null ? '' : Input::get('editor1'),
                'due_date'=>$duedate,
                //'banner_img'=>"img/".$realname,
                'amount'=>$amount,
                //'status'=>$status,
                'modified_by'=>Auth::id(),
                'modified_date'=>date('Y-m-d H:i:s'),
                'subcategory'=>Input::get("categoryselect"),
                'project_tags'=>$tags,
                'project_alias'=>$alias,
                'recipient'=>Input::get("recipientName")
            );
            
            $destinationPath = "uploads/banner/";
            $realname = "";
            //$realname = Input::file('projectPhoto')->getClientOriginalName();
            //Input::file('projectPhoto')->move($destinationPath, $realname);
            
            if (isset($_POST['projectPhoto']) && $_POST['projectPhoto'] == '') {                    
                    $realname = "images/default_project.png";
                    $dataProject['banner_img'] = $realname;
                } elseif ($_FILES['projectPhoto']['error'] == 0)  {
                    //change avatar
                    //echo Input::file('avatar')->getClientOriginalName();
                    $photo_name =  Input::get("projectId");
                    $realname = $photo_name."-".Input::file('projectPhoto')->getClientOriginalName();
                    //$realname = Input::file('projectPhoto')->getClientOriginalName();
                    Input::file('projectPhoto')->move($destinationPath, $realname);
                    $dataProject['banner_img'] = $realname;
                } else {
                    //do nothing
                }
            
            DB::table('project')
                ->where('project_id', Input::get("projectId"))
                ->update($dataProject);
            
            return Redirect::to("manage-project/$alias")->with('message', 'Update Project Success');
            
        } 

        public function postUpdateContentProject(){
            $projectContent = Input::get('editor1');           
            date_default_timezone_set("Asia/Jakarta");

            $dataProject = array(
                'content'=>Input::get("editorContent"),
                /*'issue'=>Input::get("issue"),
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
                'url'=>Input::get("url"),*/
                'modified_by'=>Auth::id(),
                'modified_date'=>date('Y-m-d H:i:s')
            );

            $destinationPath = "uploads/project/";
            //$destinationPath = "img/";
            $realname = "";
            
            
            /*if (isset($_POST['photo1']) && $_POST['photo1'] == '') {
                    $realname = "default_project.jpg";
                    $dataProject['img_content1'] = $realname;
                } elseif ($_FILES['photo1']['error'] == 0)  {
                    $photo_name =  Input::get("projectId");
                    $realname = $photo_name."-1-".Input::file('photo1')->getClientOriginalName();                    
                    //$realname = Input::file('photo1')->getClientOriginalName();
                    Input::file('photo1')->move($destinationPath, $realname);
                    $dataProject['img_content1'] = $realname;
                } else {
                    //do nothing
                }

            if (isset($_POST['photo2']) && $_POST['photo2'] == '') {
                    $realname = "default_project.jpg";
                    $dataProject['img_content2'] = $realname;
                } elseif ($_FILES['photo2']['error'] == 0)  {
                    $photo_name =  Input::get("projectId");
                    $realname = $photo_name."-2-".Input::file('photo2')->getClientOriginalName();
                    Input::file('photo2')->move($destinationPath, $realname);
                    $dataProject['img_content2'] = $realname;
                } else {
                    //do nothing
                }

            if (isset($_POST['photo3']) && $_POST['photo3'] == '') {
                    $realname = "default_project.jpg";
                    $dataProject['img_content3'] = $realname;
                } elseif ($_FILES['photo3']['error'] == 0)  {
                    $photo_name =  Input::get("projectId");
                    $realname = $photo_name."-3-".Input::file('photo3')->getClientOriginalName();
                    //$realname = Input::file('photo3')->getClientOriginalName();
                    Input::file('photo3')->move($destinationPath, $realname);
                    $dataProject['img_content3'] = $realname;
                } else {
                    //do nothing
                }*/
            
            DB::table('project')
                ->where('project_id', Input::get("projectId"))
                ->update($dataProject);
            
            $query = "SELECT project_alias FROM project WHERE project_id = '".Input::get("projectId")."'";
            $rs = DB::select($query);
            
            if(!$rs)
                return Redirect::to("account");
            else            
                return Redirect::to("manage-project/".$rs[0]->project_alias."?t=2")->with('message', 'Update Project Success');
            
        } 
        
        public function postAddReward(){
            
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
            
            if(!$rs)
                return Redirect::to("account");
            else            
                return Redirect::to("manage-project/".$rs[0]->project_alias."?t=3")->with('message', 'Add Reward Success');
            
        }

    public function postAddPosting()
    {
        //$header=Input::get("postHeader");
        //$content = Input::get('content_post');           
        
        date_default_timezone_set("Asia/Jakarta");        

        $dataProject = array(
                'project_id'=>Input::get("projectId"),
                'post_date'=>date('Y-m-d H:i:s'),                
                'post_header'=>Input::get("postHeader"),
                'post_header_en'=>Input::get("postHeader_en"),
                'small_content'=>Input::get("small_content"),
                'small_content_en'=>Input::get("small_content_en"),
                'post_content'=>Input::get("content_post"),
                'post_content_en' =>Input::get("content_post_en")            
            );
        $id = DB::table('tb_post')->insertGetId(
                $dataProject
            );

        $query = "SELECT project_alias FROM project WHERE project_id = '".Input::get("projectId")."'";
            $rs = DB::select($query);
            
            if(!$rs)
                return Redirect::to("account");
            else            
                return Redirect::to("manage-project/".$rs[0]->project_alias."?t=4")->with('message', 'Add Updates Success');

    } 

    public function postEditPosting()
    {
            $dataProject = array(
                'post_header'=>Input::get("postHeader"),
                'post_header_en'=>Input::get("postHeader_en"),
                'small_content'=>Input::get("small_content"),
                'small_content_en'=>Input::get("small_content_en"),
                'post_content'=>Input::get("content_post"),
                'post_content_en'=>Input::get("content_post_en")              
                
            );

            $destinationPath = "uploads/project/";            
            $realname = "";       
            
            DB::table('tb_post')
                ->where('post_id', Input::get("postId"))
                ->update($dataProject);
            
            $query = "SELECT project_alias FROM project WHERE project_id = '".Input::get("projectId")."'";
            $rs = DB::select($query);
            
            if(!$rs)
                return Redirect::to("account");
            else            
                return Redirect::to("manage-project/".$rs[0]->project_alias."?t=4")->with('message', 'Update Success');
    }
}