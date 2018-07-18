<?php
class ProjectController extends BaseController {

	protected $layout = "layouts.main";
	protected $data = array();	
	public $module = 'project';
	static $per_page	= '10';
	
	public function __construct() {
		parent::__construct();
		$this->beforeFilter('csrf', array('on'=>'post'));
		$this->model = new Project();
		$this->info = $this->model->makeInfo( $this->module);
		$this->access = $this->model->validAccess($this->info['id']);
	
		$this->data = array(
			'pageTitle'	=> 	$this->info['title'],
			'pageNote'	=>  $this->info['note'],
			'pageModule'=> 'project',
			'trackUri' 	=> $this->trackUriSegmented()	
		);
			
				
	} 

	
	public function getIndex()
	{
		if($this->access['is_view'] ==0) 
			return Redirect::to('')
				->with('message', SiteHelpers::alert('error',Lang::get('core.note_restric')));
				
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
	}		
	

	function getAdd( $id = null)
	{
		//category
		$query = "SELECT * from ms_projectcategory";
		$rs = DB::select($query);
		$this->data["select_category"] = (object)$rs;
		
		//label_id
		$query3 = "SELECT * from ms_label";
		$rs3 = DB::select($query3);
		$this->data["select_id"] = (object)$rs3;
		
		if($id =='')
		{
			if($this->access['is_add'] ==0 )
			return Redirect::to('')->with('message', SiteHelpers::alert('error',Lang::get('core.note_restric')));
		}	
		
		if($id !='')
		{
			if($this->access['is_edit'] ==0 )
			return Redirect::to('')->with('message', SiteHelpers::alert('error',Lang::get('core.note_restric')));
		}				
			
		$id = ($id == null ? '' : SiteHelpers::encryptID($id,true)) ;
		
		//category
		if($id !='')
		{
		$query2 = "SELECT category from project where project_id=$id";
		$rs2 = DB::select($query2);
		$this->data["select_edit"] = (object)$rs2[0];
		}
		
		//label_id
		if($id !='')
		{
		//SELECT nama_kolom_tampil FROM nama_tabel_pertama INNER JOIN nama_tabel_kedua ON nama_kolom_join_tabel_pertama = nama_kolom_join_tabel_kedua
		$query4 = "SELECT ms_label.label_id, name FROM ms_label INNER JOIN project ON project.label_id = ms_label.label_id where project.project_id = $id";
		$rs4 = DB::select($query4);
		$this->data["edit_id"] = (object)$rs4[0];
		}
		
		if($id !='')
		{
		$query5 = "SELECT label_id, name FROM ms_label";
		$rs5 = DB::select($query5);
		$this->data["select_edit_id"] = (object)$rs5;
		}
		
		$row = $this->model->find($id);
		if($row)
		{
			$this->data['row'] =  $row;
		} else {
			$this->data['row'] = $this->model->getColumnTable('project'); 
		}
		/* Master detail lock key and value */
		if(!is_null(Input::get('md')) && Input::get('md') !='')
		{
			$filters = explode(" ", Input::get('md') );
			$this->data['row'][$filters[3]] = SiteHelpers::encryptID($filters[4],true); 	
		}
		/* End Master detail lock key and value */
		
		$this->data['masterdetail']  = $this->masterDetailParam(); 
		$this->data['filtermd'] = str_replace(" ","+",Input::get('md')); 		
		$this->data['id'] = $id;
		$this->layout->nest('content','project.form',$this->data)->with('menus', $this->menus );	
	}
	
	function getShow( $id = null)
	{
	
		if($this->access['is_detail'] ==0) 
			return Redirect::to('')
				->with('message', SiteHelpers::alert('error',Lang::get('core.note_restric')));
					
		$ids = (is_numeric($id) ? $id : SiteHelpers::encryptID($id,true)  );
		$row = $this->model->getRow($ids);
		if($row)
		{
			$this->data['row'] =  $row;
		} else {
			$this->data['row'] = $this->model->getColumnTable('project'); 
		}
		$this->data['masterdetail']  = $this->masterDetailParam(); 
		$this->data['id'] = $id;
		$this->data['access']		= $this->access;
		$this->layout->nest('content','project.view',$this->data)->with('menus', $this->menus );	
	}	
	
	function postSave( $id =0)
	{
		$trackUri = $this->data['trackUri'];
		$rules = $this->validateForm();
		
		$dataContent = htmlentities(Input::get('content'));

		$validator = Validator::make(Input::all(), $rules);	
		if ($validator->passes()) {
			$data = $this->validatePost('project');
			$data['content'] = $dataContent;

			$alias = str_replace(array("\"","'","’",":"," & ","&","?",",",".","!","@","#","(",")"),"", Input::get('title'));
            $alias = str_replace(" ","-", $alias);
            $data['project_alias'] = $alias;

            $data['subcategory'] = $data['category'];
            $data['entry_by'] = $data['author'];
            
			/*if($data['category'] == "charity" ){
				$data['category'] = 2;
			}else if($data['category'] == "solidarity"){
				$data['category'] = 3;
			}else if($data['category'] == "birthday-gift" || $data['category'] == "farewell-gift" || $data['category'] == "wedding-gift"){
				$data['category'] = 4;
			}else $data['category'] = 1;*/
			$data['category'] = Input::get("category");
			$data['label_id'] = Input::get("labelid");
			//print_r($data['label_id']);exit(); mengecek BUG

			if(!isset($data['staff_pick'])) $data['staff_pick'] = 0;
			if($data['staff_pick'] == 1){
				DB::table('project')->where('staff_pick',1)->update(array('staff_pick'=>0));
			}
			
			$ID = $this->model->insertRow($data , Input::get('project_id'));
			// Input logs
			if( Input::get('project_id') =='')
			{
				$this->inputLogs("New Entry row with ID : $ID  , Has Been Save Successfull");
				$id = SiteHelpers::encryptID($ID);
			} else {
				$this->inputLogs(" ID : $ID  , Has Been Changed Successfull");
			}
			// Redirect after save	
			$md = str_replace(" ","+",Input::get('md'));
			$redirect = (!is_null(Input::get('apply')) ? 'project/add/'.$id.'?md='.$md.$trackUri :  'project?md='.$md.$trackUri );
			return Redirect::to($redirect)->with('message', SiteHelpers::alert('success',Lang::get('core.note_success')));
		} else {
			$md = str_replace(" ","+",Input::get('md'));
			return Redirect::to('project/add/'.$id.'?md='.$md)->with('message', SiteHelpers::alert('error',Lang::get('core.note_error')))
			->withErrors($validator)->withInput();
		}	
	
	}
	
	public function postDestroy()
	{
		
		if($this->access['is_remove'] ==0) 
			return Redirect::to('')
				->with('message', SiteHelpers::alert('error',Lang::get('core.note_restric')));		
		// delete multipe rows 
		$this->model->destroy(Input::get('id'));
		$this->inputLogs("ID : ".implode(",",Input::get('id'))."  , Has Been Removed Successfull");
		// redirect
		Session::flash('message', SiteHelpers::alert('success',Lang::get('core.note_success_delete')));
		return Redirect::to('project?md='.Input::get('md'));
	}			
		
}