<?php
class BrowseFileController extends BaseController {

	//protected $layout = "layouts.main";
        protected $layout = "layouts.mainempty";
	protected $data = array();	
	public $module = 'create-project';
        protected $page = 'pages.template.browse';
	
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
						
                 $id = Auth::id();
                 $query = "SELECT * FROM user_image WHERE user_id=".$id." ORDER BY upload_time DESC";
                 $rs = DB::select($query);
                 
                 $this->data['images'] = $rs;
            
                $this->layout = View::make("layouts.mainempty");
		// Render into template
		$this->layout->nest('content',$this->page, $this->data);
	}
        
}