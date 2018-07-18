<?php
date_default_timezone_set("Asia/Jakarta");
class CreateProjectController extends BaseController {

	//protected $layout = "layouts.main";
        protected $layout = "layouts.main";
	protected $data = array();	
	public $module = 'create-project';
	static $per_page	= '10';
        protected $page = 'pages.template.createproject';
	
	public function __construct() {
		parent::__construct();
		$this->beforeFilter('csrf', array('on'=>'post'));
		//$this->model = new Project();
		//$this->info = $this->model->makeInfo( $this->module);
		//$this->access = $this->model->validAccess($this->info['id']);
	
		$this->data = array(
			'pageTitle'	=>  'Create Project',
			'pageNote'	=>  'Create New Project',
			'pageModule'    =>  'create-project',
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

			$query="select * from ms_projectcategory order by name ASC";
			$rs = DB::select($query);		
			$this->data['category'] = $rs;
            
                $this->layout = View::make("layouts.".CNF_THEME.".index");
		// Render into template
		$this->layout->nest('content',$this->page, $this->data);
	}
        
	public function postNewproject(){            

            /*$data = array(
                                'projectCategory'=>Input::get("categoryselect"),
								'projectName'	=> Input::get("projectName"),
								'recipientName'	=> Input::get("recipientName"),
                                'projectAmount' => Input::get("mask_currency"),
								'projectEndDate'=> Input::get("projectEndDate"),//date("Y-m-d H:i:s"),
                                'projectTags'   => Input::get("projectTags"),
                                'projectImage'  => $destinationPath.$realname,
                                'projectSmallContent'  => Input::get('editor1')
				//'user_id'	=> Session::get('uid')
			);*/
 			$amount = str_replace(array("Rp ","_","."), "", Input::get("mask_currency"));
 			$alias = str_replace(array("\"","’","'",":"," & ","&","?",",",".","!","@","#","|"," | ","/",";","(",")"),"", htmlentities(Input::get("projectName")));
            $alias = str_replace(array(" ","  "),"-", $alias);

            $duedate = Input::get("projectEndDate");
            $arr = explode("/",$duedate);
            $duedate = $arr[2]."-".$arr[0]."-".$arr[1];

            $destinationPath = "uploads/banner/";            
            $photo_name =  $alias."-";

            $realname = $photo_name."".Input::file('projectPhoto')->getClientOriginalName();
            //$realname = Input::file('projectPhoto')->getClientOriginalName();
            $realname = str_replace(array(" ","  "),"-", $realname);        

			Input::file('projectPhoto')->move($destinationPath, $realname);

            //=======siup
			/*$destinationPathDoc = "uploads/documents/";            
            $doc_name =  $alias."-";

            $realdocname = $doc_name."".Input::file('projectSIUP')->getClientOriginalName();
            Input::file('projectSIUP')->move($destinationPathDoc, $realdocname);*/
            //=========
            $realdoc_NPWP='';
            $realdoc_KTP='';
            $realdoc_SIUP='';
            $realdoc_Domi='';            

            
            $destDocument = "uploads/documents/";
            $doc_NPWP =  $alias."-NPWP";
            $doc_KTP = $alias."-KTP";            
            $doc_SIUP = $alias."-SIUP";
            $doc_Domi = $alias."-Domisili";

            $radioDoc= Input::get('ownership');
            if($radioDoc != NULL AND $radioDoc == 'individu' AND Input::file('indiNPWP')!=NULL AND Input::file('indiKTP')!=NULL)
            {
            	$realdoc_NPWP = $doc_NPWP."".Input::file('indiNPWP')->getClientOriginalName();
            	Input::file('indiNPWP')->move($destDocument, $realdoc_NPWP);

				$realdoc_KTP = $doc_KTP."".Input::file('indiKTP')->getClientOriginalName();
            	Input::file('indiKTP')->move($destDocument, $realdoc_KTP);            	
            }
            if($radioDoc != NULL AND $radioDoc == 'company' AND Input::file('comNPWP')!=NULL AND Input::file('comSIUP')!=NULL AND Input::file('comDomi')!=NULL)
            {
            	$realdoc_NPWP = $doc_NPWP."".Input::file('comNPWP')->getClientOriginalName();
            	Input::file('comNPWP')->move($destDocument, $realdoc_NPWP);

            	$realdoc_SIUP = $doc_SIUP."".Input::file('comSIUP')->getClientOriginalName();
            	Input::file('comSIUP')->move($destDocument, $realdoc_SIUP);

            	$realdoc_Domi = $doc_Domi."".Input::file('comDomi')->getClientOriginalName();
            	Input::file('comDomi')->move($destDocument, $realdoc_Domi);
            }
            /*else ->yg diatas dihapus kalau mau pake validasi lagi
            {
            	$realdoc_NPWP = $doc_NPWP."".Input::file('comNPWP')->getClientOriginalName();
            	Input::file('comNPWP')->move($destDocument, $realdoc_NPWP);

            	$realdoc_SIUP = $doc_SIUP."".Input::file('comSIUP')->getClientOriginalName();
            	Input::file('comSIUP')->move($destDocument, $realdoc_SIUP);

            	$realdoc_Domi = $doc_Domi."".Input::file('comDomi')->getClientOriginalName();
            	Input::file('comDomi')->move($destDocument, $realdoc_Domi);
            }*/
            

            //$tmpPath = "img/tmp/";
            //$arr= explode("/",Input::file("projectPhoto")->getClientOriginalName());
            //copy($tmpPath.$arr[count($arr)-1] ,"uploads/banner/".$arr[count($arr)-1]);
            date_default_timezone_set("Asia/Jakarta");
			$data = array(
                                'category'		=> Input::get("categoryselect"),
								'title'			=> Input::get("projectName"),
								'author'		=> Auth::id(),
								'start_date'	=> date('Y-m-d'),
								//'recipient'	=> Input::get("recipientName"),
                                'amount'		=> $amount,
                                'fund_amount'	=>0,
				                'status'		=>0,
				                'created_date'	=>date('Y-m-d H:i:s'),
				                'label_id'		=>1,
				                'modified_by'	=>' ',
				                'modified_date'	=>date('Y-m-d H:i:s'),
				                'subcategory'	=>0,
								'due_date'		=> $duedate,
                                'project_tags'	=> Input::get("projectTags"),
                                'entry_by'		=>Auth::id(),
                                'project_alias' =>$alias,
                                'banner_img'  	=> $realname,
                                'NPWP'			=> $realdoc_NPWP,
                                'KTP'			=> $realdoc_KTP,
                                'SIUP'			=> $realdoc_SIUP,
                                'Domicile'		=> $realdoc_Domi,
                                'small_content'	=> Input::get('editor1')
			);
            
            Session::put('createproject', $data);
            if(!Auth::check())
            {
            	Session::put('postCreateProject','1');
                return Redirect::to('user/login');
            }

            $id = DB::table('project')->insertGetId(
                $data
            );
            Session::put('projectID', $id);
            
            if(Auth::check())
            {
                return Redirect::to('create-project-content');
            }else{
                return Redirect::to('user/login');
            }
        }
         public function getPushNewProject(){
		
		$data = Session::get('createproject');
		$data['author'] = Auth::id();
		$data['entry_by'] = Auth::id();
		Session::put('createproject', $data);

		$id = DB::table('project')->insertGetId(
            $data
        );
        Session::put('projectID', $id);
        return Redirect::to('create-project-content');

	}        	        	
}