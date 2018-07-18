<?php

class HomeController extends BaseController {

	/*
	|--------------------------------------------------------------------------
	| Default Home Controller
	|--------------------------------------------------------------------------
	|
	| You may wish to use controllers instead of, or in addition to, Closure
	| based routes. That's great! Here is an example controller method to
	| get you started. To route to this controller, just add the route:
	|
	|	Route::get('/', 'HomeController@showWelcome');
	|
	*/
	
	public function __construct() {
		
		parent::__construct();
		 $this->layout = "layouts.".CNF_THEME.".index";
		
		
	} 	
	

	public function index($alias = null)
	{
		if(CNF_FRONT =='false' ) :
			return Redirect::to('dashboard');
		endif; 
		
		if(is_null(Input::get('p')))
		{
			$page = Request::segment(1); 	
		} else {
			$page = Input::get('p'); 	
		}
		if($page !='') :
			$content = Pages::where('alias','=',$page)->where('status','=','enable');   
			if($content->count() >=1)
			{
				$content = $content->get();
				$row = $content[0];
				$this->data['pageTitle'] = $row->title;
				$this->data['pageNote'] = $row->note;		
				$this->data['breadcrumb'] = 'active';					
				
				if($row->access !='')
				{
					$access = json_decode($row->access,true)	;	
				} else {
					$access = array();
				}	

				// If guest not allowed 
				if($row->allow_guest !=1)
				{	
					$group_id = Session::get('gid');				
					$isValid =  (isset($access[$group_id]) && $access[$group_id] == 1 ? 1 : 0 );	
					if($isValid ==0)
					{
						return Redirect::to('')
							->with('message', SiteHelpers::alert('error',Lang::get('core.note_restric')));				
					}
				}				
				if($row->template =='backend')
				{
					 $this->layout = View::make("layouts.main");
				}
				
				$filename = public_path() ."protected/app/views/pages/template/".$row->filename.".blade.php";
				if(file_exists($filename))
				{
					$page = 'pages.template.'.$row->filename;
				} else {
					return Redirect::to('')
						->with('message', SiteHelpers::alert('error',Lang::get('core.note_noexists')));					
				}
				
			} else {
				return Redirect::to('')
					->with('message', SiteHelpers::alert('error',Lang::get('core.note_noexists')));	
			}
			
			
		else :
			$this->data['pageTitle'] = 'Home';
			$this->data['pageNote'] = 'Welcome To Our Site';
			$this->data['breadcrumb'] = 'inactive';			
			$page = 'pages.template.home';
		endif;	
		
		$page = SiteHelpers::renderHtml($page);
		
		//$this->layout->nest('content',$page)->with('menus', $this->menus );
				
                if($this->data['pageTitle'] == "Home")
				{
                    //-------GET POPULAR CHARITY-------------
                    //$query = "SELECT * FROM project WHERE status >= 1 order by project_id desc LIMIT 4";
                    $query= "SELECT a.*,b.backer FROM project a LEFT JOIN (SELECT project_id,COUNT(backer_id) as backer FROM backer WHERE status = 1 GROUP BY project_id) b on a.project_id=b.project_id WHERE a.status >= 1 order by b.backer desc LIMIT 4";
                    $rs = DB::select($query);
                    $charity_pop = array();
                    $i=0;
                    foreach($rs as $charity){
                            $tmp = (array)$charity;
                            $tmp['fund_percent'] = round($charity->fund_amount / $charity->amount * 100,2);
                            $tmp['days_to_go'] = date_diff(date_create(date("Y-m-d")),date_create($charity->due_date));
                            
                            $query = "SELECT COUNT(backer_id) as backer FROM backer WHERE project_id = '".$charity->project_id."' AND status = 1";
                            $rsBacker = DB::select($query);
                            $tmp['backer'] = 0;
                            if($rsBacker != null)
                                $tmp['backer'] = $rsBacker[0]->backer;
							
							$query="Select SUM(backer_amount) as hitung2 FROM backer WHERE project_id = '".$charity->project_id."' AND status = 1";
                            $rs = DB::select($query);
                            $tmp['hitung_f']=$rs[0]->hitung2;							
                            
                            $charity = (object)$tmp;
                            $charity_pop[$i]=$charity;
                            $i++;
                    }
                    $this->data['popularCharity'] = (object)$charity_pop;
                    
                    $query = "SELECT * FROM testimonial ORDER BY id DESC LIMIT 3";
                    $rs = DB::select($query);
                    $this->data['testimonials'] = $rs;

                    $query = "SELECT * FROM beneficiary_testimonial ORDER BY id DESC LIMIT 3";
                    $rs = DB::select($query);
                    $this->data['beneficiary_testimonials'] = $rs;
                    
                    $query = "SELECT a.*,IFNULL(b.project_alias,'') as alias FROM cms_favorite a LEFT JOIN project b ON a.project = b.project_id WHERE a.status = 1 LIMIT 12";
                    $rs = DB::select($query);
                    $this->data['favorite'] = $rs;
                    
                    $query = "SELECT * FROM cms_client WHERE status = 1";
                    $rs = DB::select($query);
                    $this->data['clients'] = $rs;

                    $query = "SELECT * FROM project WHERE staff_pick = 1 LIMIT 1";
                    $rs = DB::select($query);
                    $charity_pop = array();
                    $i=0;
                    foreach($rs as $charity){
                            $tmp = (array)$charity;
                            $tmp['fund_percent'] = round($charity->fund_amount / $charity->amount * 100,2);
                            $tmp['days_to_go'] = date_diff(date_create(date("Y-m-d")),date_create($charity->due_date));
                            
                            $query = "SELECT COUNT(backer_id) as backer FROM backer WHERE project_id = '".$charity->project_id."'";
                            $rsBacker = DB::select($query);
                            $tmp['backer'] = 0;
                            if($rsBacker != null)
                                $tmp['backer'] = $rsBacker[0]->backer;
                            
                            $query="Select SUM(backer_amount) as hitung2 FROM backer WHERE project_id = '".$charity->project_id."' AND status = 1";
                            $rs = DB::select($query);
                            $tmp['hitung_f']=$rs[0]->hitung2;
                            
                            
                            $charity = (object)$tmp;
                            $charity_pop[$i]=$charity;
                            $i++;
                    }
                    $this->data['staffpick'] = $charity_pop;

                    $query = "SELECT * FROM project WHERE status>=1 ORDER BY project_id DESC LIMIT 1";
                    $rs = DB::select($query);
                    $this->data['newest'] = $rs;
                    //------------------------------------------------
					
                }
                else if($this->data['pageTitle']=="Business Loan"){
                    //-------GET POPULAR BUSINESS LENDING-------------
                    $this->data['fsort']=Input::get('fsort');
                    $this->data['sort']="";
                    $this->data['term']=Input::get('term');
                    $this->data['grade']=Input::get('grade');
                    
                    $query = "SELECT a.*,b.grade,b.subgrade,b.grade_color,b.rate1,b.rate2,b.rate3 FROM invoice a JOIN ms_loangrade b ON a.loangrade_id = b.loangrade_id "
                            . "WHERE a.status = 1 ";
                    if(Input::get('term')!="")
                    {
                        $arrTerm = explode("|",Input::get('term'));
                        $whereTerm = "";
                        for($i=0;$i<count($arrTerm);$i++){
                            $whereTerm .= ($whereTerm != "" ? " OR " : "") ."a.Term = ".$arrTerm[$i];
                        }
                        if($whereTerm!="") $query .= "AND (".$whereTerm.") ";
                        
                    }
                    if(Input::get('grade')!="")
                    {
                        $arrGrade = explode("|",Input::get('grade'));
                        $whereGrade = "";
                        for($i=0;$i<count($arrGrade);$i++){
                            $whereGrade .= ($whereGrade != "" ? " OR " : "") ."a.loangrade_id = ".$arrGrade[$i];
                        }
                        if($whereGrade!="") $query .= "AND (".$whereGrade.") ";
                    }
                    if(Input::get('fsort')!="" && Input::get('sort')!="")
                    {
                        $query .= "ORDER BY ";
                        switch(Input::get('fsort'))
                        {
                            case "amount": $query.="a.valuation "; break;
                            case "rate": $query.="a.loangrade_id ";  break;
                            case "term": $query.="a.term ";  break;
                            case "purpose": $query.="a.invoice_category "; break;
                            case "outstanding" : $query.="100-round(a.lending_amount/a.valuation,2)";  break;
                            case "amountleft": $query.="(a.valuation - a.lending_amount) "; break;
                        }
                        //$this->data['fsort'] = "amount";
                        switch(Input::get('sort'))
                        {
                            case "asc": 
                                $query.="ASC";
                                $this->data['sort'] = "asc";
                                break;
                            case "desc":
                                $query.="DESC";
                                $this->data['sort'] = "desc";
                                break;
                        }
                    }
                    $rs = DB::select($query);
                    $business_pop = array();
                    $i=0;                    
                    foreach($rs as $invoice){
                            $tmp = (array)$invoice;
                            $tmp['lending_percent'] = round($invoice->lending_amount / $invoice->valuation * 100,2);
                            
                            $date1 = new DateTime();
                            $date2 = new Datetime($invoice->lending_due_date);
                            $datediff = date_diff($date1,$date2);
                            $tmp['datediff'] = $datediff->format("%a");
                            $tmp['fundleave'] = $invoice->valuation - $invoice->lending_amount;
                            
                            if($invoice->term <= 3 )
                                $tmp['loan_rate'] = $invoice->rate1;
                            else if($invoice->term == 6) 
                                $tmp['loan_rate'] = $invoice->rate2;
                            else if($invoice->term == 9) 
                                $tmp['loan_rate'] = $invoice->rate3;
                            
                            $invoice = (object)$tmp;
                            $business_pop[$i]=$invoice;
                            $i++;
                    }
                    $perPage = 10;
                    $currentPage = Input::get('page') - 1;
                    $pagedData = array_slice($business_pop, $currentPage * $perPage, $perPage);
                    if(count($pagedData)==0) $pagedData = array_slice($business_pop, 0 * $perPage, $perPage);
                    $business_pop = Paginator::make($pagedData, count($business_pop), $perPage);
                    $this->data['businessList'] = (object)$business_pop;
                    //-------END POPULAR BUSINESS LENDING-------------
                    //-------GET LOAN GRADE---------------------------
                    $query = "SELECT * FROM ms_loangrade ORDER BY loangrade_id ASC";
                    $rs = DB::select($query);
                    $loangrade_tmp = array();
                    $i=0; 
                    foreach($rs as $loangrade){
                            //$tmp = (array)$loangrade;
                            
                            //$loangrade = (object)$tmp;
                            $loangrade_tmp[$i]=$loangrade;
                            $i++;
                    }
                    $this->data['loangradeList'] = (object)$loangrade_tmp;
                    //-------END LOAN GRADE---------------------------
                }
                else if($this->data['pageTitle']=="Projects" || $this->data['pageTitle']=="Charity"){
                    //-------GET PROJECT-------------
                    $category = Input::get('category');
                    if($category == "") $category= "all";
                    $subcategory = Input::get('subcategory');
                    $title = Input::get('title');
                    
                    $query = "SELECT a.* FROM project a JOIN ms_projectcategory b ON a.category=b.id WHERE a.status >= 1";
                    if($category != "" && $category != "all"){
                        $query .= " AND b.alias='".$category."'";
                    }
                    if($subcategory!="")
                        $query .= " AND a.subcategory='".$subcategory."'";
                    if($title!="")
                        $query .= " AND a.project_alias='".$title."'";
                    
                    $query .= " ORDER BY a.status,a.project_id desc LIMIT 0,16 ";
                        
                    $rs = DB::select($query);
                    $project_cat = array();
                    $i=0;
                    foreach($rs as $project){
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
                            
                            $query = "SELECT count(project_id) as hitung 
                                      from project inner join ms_projectcategory 
                                      on project.category = ms_projectcategory.id  
                                      where project.status >= 1";
                            if($category!="")
                            $query .= " AND ms_projectcategory.alias='".$category."'";
                                      
                            $rs = DB::select($query);
                            $tmp['total'] = $rs[0]->hitung;

                            $project = (object)$tmp;
                            $project_cat[$i]=$project;
                            $i++;
                    }
                    $this->data['projectList'] = (object)$project_cat;
                    $this->data['categorySearch'] = $category;
                    if($subcategory !="") $this->data['categorySearch'] = $subcategory;
                    if($title !="") $this->data['categorySearch'] = $title;
					
					$query2= "Select * from project where subcategory='charity'  AND status= 1" ;
					$rs2 = DB::select($query2);
					$project_cat2 = $rs2;
					$this->data['listCharity'] = $project_cat2;
					
					$query3= "Select * from project where subcategory='solidarity' AND status= 1" ;
					$rs3= DB::select($query3);
					//$project_cat3 = $rs3;
					$this->data['listSolidarity'] = $rs3;
					
					
                    //------------------------------------------------
                }
                else if($this->data['pageTitle']=="Show Project"){
                    //-------GET POPULAR CHARITY-------------
                    
                    //$category = Input::get('category');
                    //if($category == "") $category= "all";
                    
                    $query = "SELECT a.*,b.first_name,b.last_name,b.avatar,b.city,b.website,c.name as country "
                            . "FROM project a LEFT JOIN tb_users b ON a.entry_by=b.id "
                            . "LEFT JOIN ms_country c ON b.country = c.id "
                            . "WHERE a.status >= 1 AND a.project_alias='".htmlentities($alias)."'";
                    //if($category != "" && $category != "all"){
                        //$query .= " AND subcategory='".$category."'";
                    //}
                    $rs = DB::select($query);
                    $project_cat = array();
                    $i=0;
                    $idProject = 0;
                    if(!$rs){
                        return Redirect::to('projects');
                    }else
                    {
                        foreach($rs as $project){
                                $tmp = (array)$project;
                                $tmp['fund_percent'] = round($project->fund_amount / $project->amount * 100,2);
                                $tmp['days_to_go'] = date_diff(date_create(date("Y-m-d")),date_create($project->due_date));
                                $idProject = $project->project_id;
                                $project = (object)$tmp;

                                $query="Select SUM(backer_amount) as hitung2 FROM backer WHERE project_id = '".$project->project_id."' AND status = 1";
                                $rs = DB::select($query);
                                $tmp['hitung_f']=$rs[0]->hitung2;

                                $project_cat[$i]=$project;
                                $i++;
                        }
                        $this->data['project'] = (object)$project_cat[0];
                        //$this->data['categorySearch'] = $category;
                    }
                    //------------------------------------Available Reward-----------------------------------------------------------//
                    $query = "SELECT * FROM reward WHERE project_id = $idProject";
                    $rs = DB::select($query);
					$reward_cat=array();
						foreach($rs as $rs_temp)
						{
							$query2 ="SELECT COUNT(backer_id) as hitung1 FROM backer WHERE project_id = $idProject and reward_id= $rs_temp->reward_id and status=1";
							$rs2 = DB::select($query2);
							$tmp = (array)$rs_temp;
							$tmp['hitung_h']=$rs2[0]->hitung1;
							$reward_cat[] = (object)$tmp;
						}					
                    $this->data['rewards'] = $reward_cat;	
					
                    //---------------------------------------Total Fund-------------------------------------------------------------//					
					$query="Select SUM(backer_amount) as hitung2 FROM backer WHERE project_id = $idProject AND status = 1";
					$rs = DB::select($query);
					$tmp['hitung_f']=$rs[0]->hitung2;
					$fund_cat[] = (object)$tmp;
					$this->data['total_fund'] = $fund_cat;
						
					
                    $query = "SELECT a.*,IFNULL(b.reward_title,'') as reward_title FROM backer a LEFT JOIN reward b ON a.reward_id = b.reward_id WHERE a.project_id = $idProject AND a.status = 1";
                    $rs = DB::select($query);
                    $this->data['backers'] = $rs;
                    
                    if(Input::get("step") == 2){
                        $idbacker = Session::get('id_topup');
                        $query = "SELECT * FROM backer WHERE backer_id = $idbacker AND status = 1";
                        $rsTopup = DB::select($query);
                        if($rsTopup != null)
                        $this->data['topup'] = $rsTopup[0];
                        $this->data['backerid'] = SiteHelpers::encryptID($idbacker);
                    }
                    
                    $this->data['pid'] = SiteHelpers::encryptID($idProject);
                    
					/*$query2 ="SELECT COUNT(backer_id) FROM backer WHERE project_id = $idProject";
					$rs2 = DB::select($query);
					$this->data['rewards2'] = $rs2[0];
					*/
					
                    //------------------------------------------------
                }
                else if($this->data['pageTitle']=="Account"){
                   
                    //-------GET Account-------------
                    
                    //$category = Input::get('category');
                    //if($category == "") $category= "all";
                    $id = Auth::id();
                    $query = "SELECT * FROM tb_users WHERE id='$id'";
                    //if($category != "" && $category != "all"){
                        //$query .= " AND subcategory='".$category."'";
                    //}
                    $rs = DB::select($query);
                    if(!$rs){
                        return Redirect::to('user/login');
                    }else
                    {
                        /*
                        foreach($rs as $project){
                                $tmp = (array)$project;
                                $tmp['fund_percent'] = round($project->fund_amount / $project->amount * 100,2);
                                $tmp['days_to_go'] = date_diff(date_create($project->start_date),date_create($project->due_date));
                                $idProject = $project->project_id;
                                $project = (object)$tmp;
                                $project_cat[$i]=$project;
                                $i++;
                        }*/
                        $this->data['profile'] = (object)$rs[0];
                        //$this->data['categorySearch'] = $category;
                    }
                    
                    $query = "SELECT * FROM project WHERE author = $id Limit 6";
                    $rs = DB::select($query);
                    $project_cat = array();
                    $i=0;
                    foreach($rs as $project){
                            $tmp = (array)$project;
                            $tmp['fund_percent'] = round($project->fund_amount / $project->amount * 100,2);
                            $tmp['days_to_go'] = date_diff(date_create(date("Y-m-d")),date_create($project->due_date));
                            
                            $query = "SELECT COUNT(backer_id) as backer FROM backer WHERE project_id = '".$project->project_id."'";
                            $rsBacker = DB::select($query);
                            $tmp['backer'] = 0;
                            if($rsBacker != null)
                                $tmp['backer'] = $rsBacker[0]->backer;

                            $query="Select SUM(backer_amount) as hitung2 FROM backer WHERE project_id = '".$project->project_id."' AND status >= 1";
                            $rs = DB::select($query);
                            $tmp['hitung_f']=$rs[0]->hitung2;
                    
                            $query = "SELECT count(project_id) as hitung 
                                      from project inner join ms_projectcategory 
                                      on project.category = ms_projectcategory.id  
                                      where project.author = $id";
                            $rs = DB::select($query);
                            $tmp['total'] = $rs[0]->hitung;

                            $project = (object)$tmp;
                            $project_cat[$i]=$project;
                            $i++;
                        }


                    $this->data['projects'] = (object)$project_cat;
                    
                    $query = "SELECT a.*, b.reward_title,b.reward_description,c.title,c.banner_img FROM backer a JOIN reward b ON a.reward_id = b.reward_id JOIN project c ON a.project_id = c.project_id WHERE a.user_id = $id AND a.status = 1 ";
                    $rs = DB::select($query);
                    $backed_cat = array();
                    $i=0;
                    
                    foreach($rs as $backed){
                            $tmp = (array)$backed;
                            $tmp['backedDate'] = date_create($tmp['backer_date']);
                            $backed = (object)$tmp;
                            $backed_cat[$i]=$backed;
                            $i++;
                    }
                    $this->data['backeds'] = (object)$backed_cat;
                    //------------------------------------------------
                }
                else if($this->data['pageTitle']=="Edit Profile"){
                    //-------GET POPULAR CHARITY-------------
                    //$category = Input::get('category');
                    //if($category == "") $category= "all";
                    $id = Auth::id();
                    $query = "SELECT * FROM tb_users WHERE id='$id'";
                    //if($category != "" && $category != "all"){
                        //$query .= " AND subcategory='".$category."'";
                    //}
                    $rs = DB::select($query);
                    if(!$rs){
                        return Redirect::to('user/login');
                    }else
                    {                        
                        $this->data['profile'] = (object)$rs[0];
                        //$this->data['categorySearch'] = $category;
                    }
                    
                }
                else if($this->data['pageTitle']=="Manage Project"){
                    //-------GET POPULAR CHARITY-------------
                    //$category = Input::get('category');
                    //if($category == "") $category= "all";
                    $query = "SELECT * FROM project WHERE project_alias='$alias'";
                    //if($category != "" && $category != "all"){
                        //$query .= " AND subcategory='".$category."'";
                    //}
                    $rs = DB::select($query);
                    if(!$rs){
                        return Redirect::to('account');
                    }else
                    {                       
                        $tmp = explode("-",$rs[0]->due_date);
                        $rs[0]->days_to_go = date_diff(date_create(date("Y-m-d")),date_create($rs[0]->due_date));
                        
                        $rslt = $tmp[1]."/".$tmp[2]."/".$tmp[0];
                        $rs[0]->enddate = $rslt;
                        
                        
                        $query = "SELECT COUNT(backer_id) as backer FROM backer WHERE project_id = '".$rs[0]->project_id."' AND status=1";
                        $rsBacker = DB::select($query);
                        $tmpCount = 0;
                        if($rsBacker != null)
                            $tmpCount = $rsBacker[0]->backer;
                        //$this->data['categorySearch'] = $category;
                        $rs[0]->backer = $tmpCount;

                        $query="Select ifnull(SUM(backer_amount),0) as hitung2 FROM backer WHERE project_id='".$rs[0]->project_id."' AND status = 1";
                        $rs_temp = DB::select($query);
                        $rs[0]->hitung_f=$rs_temp[0]->hitung2;

                        $this->data['project'] = (object)$rs[0];
                    }
                    
                    $id = $rs[0]->project_id;
                    $query = "SELECT * FROM reward WHERE project_id='$id'";
                    $rs = DB::select($query);
                    $this->data['rewards'] = (object)$rs;

                    $query="select * from ms_projectcategory order by name ASC";
                    $rs = DB::select($query);       
                    $this->data['category'] = $rs;

                    
                    
                    $tab = Input::get('t') == null || Input::get('t') == "" ? 1 : Input::get('t');
                    if($tab > 3) $tab = 1;
                    $this->data['tab'] = $tab;
                }
                else if($this->data['pageTitle']=="Change Password"){
                    $message = Session::get("message");
                    $this->data["message"] = $message;
                }                
                else if($this->data['pageTitle']=="Finish Payment"){
                    $pid = Input::get('pid');
                    $rsProject = DB::table('project')->where('project_id',$pid)->first();
                    if($rsProject == null ) return Redirect::to('/');
                    $this->data['project'] = $rsProject;
                    $this->data['pm']=Input::get('pm');
                    $this->data['status']=Input::get('status');
					//$page = 'pages.template.finishpayment.blade.php';
                }
				 else if($this->data['pageTitle']=="About Us" ){
                    //-------GET ABOUT US-------------              
                    $query = "SELECT * FROM tb_pages_content WHERE code = 'About Us' ";              
                        
                    $rs = DB::select($query);
                     $this->data['about'] = (object)$rs[0]; 
                     $lang = Session::get('lang');
                     if($lang == '') $lang = "en";
                     $content = "";
                     switch($lang){
                        case "en" : $content = $rs[0]->content; break;
                        case "in" : $content = $rs[0]->content_in; break;
                     }
                     if($content == '') $content = $rs[0]->content;
                     $this->data['contentText'] = $content;
                    //------------------------------------------------
                }
				 else if($this->data['pageTitle']=="FAQ" ){
                    //-------GET FAQ-------------              
                    $query = "SELECT * FROM tb_pages_content WHERE code = 'FAQ' ";              
                        
                    $rs = DB::select($query);
                    $lang = Session::get('lang');
                     if($lang == '') $lang = "en";
                     $content = "";
                     switch($lang){
                        case "en" : $content = $rs[0]->content; break;
                        case "in" : $content = $rs[0]->content_in; break;
                     }
                     if($content == '') $content = $rs[0]->content;
                     $this->data['faq'] = (object)$rs[0];     
                     $this->data['contentText'] = $content;            
                    //------------------------------------------------
                }
				else if($this->data['pageTitle']=="Privacy Policy" ){
                    //-------GET Privacy Policy-------------              
                    $query = "SELECT * FROM tb_pages_content WHERE code = 'Privacy Policy' ";              
                        
                    $rs = DB::select($query);
                    $lang = Session::get('lang');
                     if($lang == '') $lang = "en";
                     $content = "";
                     switch($lang){
                        case "en" : $content = $rs[0]->content; break;
                        case "in" : $content = $rs[0]->content_in; break;
                     }
                     if($content == '') $content = $rs[0]->content;
                     $this->data['prpo'] = (object)$rs[0];   
                     $this->data['contentText'] = $content;              
                    //------------------------------------------------
                }
				else if($this->data['pageTitle']=="Partner Terms" ){
                    //-------GET Partner Terms-------------              
                    $query = "SELECT * FROM tb_pages_content WHERE code = 'Partner Terms' ";              
                        
                    $rs = DB::select($query);
                    $lang = Session::get('lang');
                     if($lang == '') $lang = "en";
                     $content = "";
                     switch($lang){
                        case "en" : $content = $rs[0]->content; break;
                        case "in" : $content = $rs[0]->content_in; break;
                     }
                     if($content == '') $content = $rs[0]->content;
                     $this->data['pate'] = (object)$rs[0];   
                     $this->data['contentText'] = $content;              
                    //------------------------------------------------
                }
				else if($this->data['pageTitle']=="Terms & Conditions" ){
                    //-------GET Term Conditions-------------              
                    $query = "SELECT * FROM tb_pages_content WHERE code = 'Terms & Conditions' ";              
                        
                    $rs = DB::select($query);
                    $lang = Session::get('lang');
                     if($lang == '') $lang = "en";
                     $content = "";
                     switch($lang){
                        case "en" : $content = $rs[0]->content; break;
                        case "in" : $content = $rs[0]->content_in; break;
                     }
                     if($content == '') $content = $rs[0]->content;
                     $this->data['term'] = (object)$rs[0];   
                     $this->data['contentText'] = $content;              
                    //------------------------------------------------
                }
                else if($this->data['pageTitle']=="Submit Project" ){
                    $query = "SELECT * FROM project WHERE project_alias='$alias'";
                    //if($category != "" && $category != "all"){
                        //$query .= " AND subcategory='".$category."'";
                    //}
                    $rs = DB::select($query);
                     $this->data['project'] = (object)$rs[0];
                    /*
                    if(!$rs){
                        return Redirect::to('account');
                    }else
                    {                       
                        $tmp = explode("-",$rs[0]->due_date);
                        $rslt = $tmp[1]."/".$tmp[2]."/".$tmp[0];
                        $rs[0]->enddate = $rslt;
                        
                        
                        $query = "SELECT COUNT(backer_id) as backer FROM backer WHERE project_id = '".$rs[0]->project_id."'";
                        $rsBacker = DB::select($query);
                        $tmpCount = 0;
                        if($rsBacker != null)
                            $tmpCount = $rsBacker[0]->backer;
                        //$this->data['categorySearch'] = $category;
                        $rs[0]->backer = $tmpCount;
                        $this->data['project'] = (object)$rs[0];
                    }
                    
                    $id = $rs[0]->project_id;
                    $query = "SELECT * FROM reward WHERE project_id='$id'";
                    $rs = DB::select($query);
                    $this->data['rewards'] = (object)$rs;
                    
                    $tab = Input::get('t') == null || Input::get('t') == "" ? 1 : Input::get('t');
                    if($tab > 3) $tab = 1;
                    $this->data['tab'] = $tab;*/
                }

                else if($this->data['pageTitle']=="Preview Content" )
                {
                    
                  $id= Input::get('c');
                  $id2=SiteHelpers::encryptID($id,true);
                   
                  $query = "SELECT a.*,b.first_name,b.last_name,b.avatar,b.city,b.website,c.name as country "
                            . "FROM project a LEFT JOIN tb_users b ON a.entry_by=b.id "
                            . "LEFT JOIN ms_country c ON b.country = c.id "
                            . "WHERE a.project_id=$id2";
                    //if($category != "" && $category != "all"){
                        //$query .= " AND subcategory='".$category."'";
                    //}
                    $rs = DB::select($query);
                    $project_cat = array();
                    $i=0;
                    $idProject = 0;
                    if(!$rs){
                        return Redirect::to('projects');
                    }else
                    {
                        foreach($rs as $project){
                                $tmp = (array)$project;
                                $tmp['fund_percent'] = round($project->fund_amount / $project->amount * 100,2);
                                $tmp['days_to_go'] = date_diff(date_create(date("Y-m-d")),date_create($project->due_date));
                                $idProject = $project->project_id;
                                $project = (object)$tmp;

                                $query="Select SUM(backer_amount) as hitung2 FROM backer WHERE project_id = '".$project->project_id."' AND status = 1";
                                $rs = DB::select($query);
                                $tmp['hitung_f']=$rs[0]->hitung2;

                                $project_cat[$i]=$project;
                                $i++;
                        }
                        $this->data['project'] = (object)$project_cat[0];
                        //$this->data['categorySearch'] = $category;
                    }
                    $query = "SELECT * FROM reward WHERE project_id = $idProject";
                    $rs = DB::select($query);
                    $reward_cat=array();
                        foreach($rs as $rs_temp)
                        {
                            $query2 ="SELECT COUNT(backer_id) as hitung1 FROM backer WHERE project_id = $idProject and reward_id= $rs_temp->reward_id and status=1";
                            $rs2 = DB::select($query2);
                            $tmp = (array)$rs_temp;
                            $tmp['hitung_h']=$rs2[0]->hitung1;
                            $reward_cat[] = (object)$tmp;
                        }                   
                    $this->data['rewards'] = $reward_cat; 

                    $query="Select SUM(backer_amount) as hitung2 FROM backer WHERE project_id = $idProject AND status = 1";
                    $rs = DB::select($query);
                    $tmp['hitung_f']=$rs[0]->hitung2;
                    $fund_cat[] = (object)$tmp;
                    $this->data['total_fund'] = $fund_cat;
                        
                    
                    $query = "SELECT a.*,IFNULL(b.reward_title,'') as reward_title FROM backer a LEFT JOIN reward b ON a.reward_id = b.reward_id WHERE a.project_id = $idProject AND a.status = 1";
                    $rs = DB::select($query);
                    $this->data['backers'] = $rs;
                    
                    if(Input::get("step") == 2){
                        $idbacker = Session::get('id_topup');
                        $query = "SELECT * FROM backer WHERE backer_id = $idbacker AND status = 1";
                        $rsTopup = DB::select($query);
                        if($rsTopup != null)
                        $this->data['topup'] = $rsTopup[0];
                        $this->data['backerid'] = SiteHelpers::encryptID($idbacker);
                    }
                    
                    $this->data['pid'] = SiteHelpers::encryptID($idProject);    
                }
                
				 $query = "SELECT title FROM project"; 
				 $rs2 = DB::select($query);
				 $this->data['ftitle'] = $rs2[0]; 
                    
				 
		$this->layout->nest('content',$page, $this->data)->with('menus', $this->menus );
			
	}
        
        public function postUpdateprofile(){
            
            $data = array(
                        'first_name'=>Input::get("firstName"),
                        'last_name'	=> Input::get("lastName"),
                        'website' => Input::get("website")
                        //'user_id'	=> Session::get('uid')
                );
            
            $destinationPath = "uploads/users/";
            $realname = "";
            if (isset($_POST['avatar']) && $_POST['avatar'] == '') {
                    $realname = "default.png";
                    $data['avatar'] = $realname;
                } elseif ($_FILES['avatar']['error'] == 0)  {
                    //change avatar
                    //echo Input::file('avatar')->getClientOriginalName();
                    $realname = Input::file('avatar')->getClientOriginalName();
                    Input::file('avatar')->move($destinationPath, $realname);
                    $data['avatar'] = $realname;
                } else {
                    //do nothing
                }
            
            DB::table('tb_users')
                ->where('id', Auth::id())
                ->update($data);
            
            return Redirect::to('account')->with('message', 'Update Profile Success');
            
        }
        
        public function topupPledge($id){
            
            Session::put('id_topup', $id);
            
            $query = "SELECT b.project_alias FROM backer a JOIN project b ON a.project_id = b.project_id WHERE a.backer_id = $id";
            $rs = DB::select($query);
            if($rs != null)
                    return Redirect::to('show-project/'.$rs[0]->project_alias.'?step=2');
            else return Redirect::to('account');
        }
	
	public function  postContactform()
	{
	
		$this->beforeFilter('csrf', array('on'=>'post'));
		$rules = array(
				'name'		=>'required',
				'subject'	=>'required',
				'message'	=>'required|min:20',
				'sender'	=>'required|email'			
		);
		$validator = Validator::make(Input::all(), $rules);	
		if ($validator->passes()) 
		{
			
			$data = array('name'=>Input::get('name'),'sender'=>Input::get('sender'),'subject'=>Input::get('subject'),'notes'=>Input::get('message')); 
			$message = View::make('emails.contact', $data); 		
			
			$to 		= CNF_EMAIL;
			$subject 	= Input::get('subject');
			$headers  	= 'MIME-Version: 1.0' . "\r\n";
			$headers 	.= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
			$headers 	.= 'From: '.Input::get('name').' <'.Input::get('sender').'>' . "\r\n";
				//mail($to, $subject, $message, $headers);
                        
                        $arr = array(
                            'contact_date'=>date('Y-m-d H:i:s'),
                            'name'=>Input::get('name'),
                            'email'=>Input::get('sender'),
                            'subject'=>Input::get('subject'),
                            'message'=>Input::get('message'),
                            'status'=>0
                        );
                        DB::table('contact_us')->insert($arr);

			return Redirect::to('?p='.Input::get('redirect'))->with('message', SiteHelpers::alert('success','Thank You , Your message has been sent !'));	
				
		} else {
			return Redirect::to('?p='.Input::get('redirect'))->with('message', SiteHelpers::alert('error','The following errors occurred'))
			->withErrors($validator)->withInput();
		}		
	}
	public function  getLang($lang='en')
	{
		Session::put('lang', $lang);
		return  Redirect::back();
	}
        public function postSubmitpledge(){
            $name = Input::get('name');
            $email = Input::get('email');
            $amount = str_replace(array("Rp ","_","."), "", Input::get('amount'));
            $reward = Input::get('reward');
            $comment = Input::get('comment');
            $pm = Input::get('pm');
            $pid = SiteHelpers::encryptID(Input::get('pid'),true);
            
            $user = Auth::id() == '' ? 0 : Auth::id();
                        
            $backer = array(
                'project_id'=>$pid,
                'reward_id'=>$reward,
                'backer_amount'=>$amount,
                'user_id'=>$user,
                'name'=>$name,
                'backer_date'=>date('Y-m-d H:i:s'),
                'email'=>$email,
                'comment'=>$comment,
                'status'=>0,
            );            
            $backer_id = DB::table('backer')->insertGetId($backer);
            
            $payment = array(
                'backer_id' =>$backer_id,
                'payment_method'=>$pm,
                'amount'=>$amount
            );
            $payment_id = DB::table('backer_payment')->insertGetId($payment);
            
            $rsProject = DB::table('project')->where('project_id', $pid)->first();
            $rsReward = DB::table('reward')->where('reward_id',$reward)->first();
            
            if($pm == "veritrans"){
                    Veritrans_Config::$isProduction = false;
                    Veritrans_Config::$serverKey ='VT-server-ZJqkcuil1Mee47mCBXpD9CQo';
                    //Veritrans_Config::$serverKey = 'VT-server-HqGkKgcDXMlToi3I48zykEIW';

                    //$nameprj = substr($post->post_title, 0, 40);

                    $transaction_details = array(
                        'order_id' => $backer_id . ' - ' . substr($rsProject->title,0,40),
                        'gross_amount' => floatval($amount),
                    );

                    $item1_details = array(
                        'id' => $reward,
                        'price' => floatval($amount),
                        'quantity' => 1,
                        'name' => $rsReward->reward_title ,
                    );
                    
                    $items_details = array($item1_details);

                    $transaction = array(
                        'payment_type' => 'vtweb',
                        'vtweb' => array(
                            'credit_card_3d_secure' => true,
                        ),
                        'transaction_details' => $transaction_details,
                        'item_details' => $items_details
                    );

                    $vtweb_url = Veritrans_VtWeb::getRedirectionUrl($transaction);

                    header('Location: ' . $vtweb_url);

                    //add_post_meta($funding_id, 'funding_method', 'veritrans' , true);

                    exit;
            }else if($pm == "transfer"){
                //$url = add_query_arg('step', 3, get_post_permalink($project->ID));
                //header("Location: ".$url, true, 303);
                //exit;
                return Redirect::to('finish-payment?pm=2&pid='.$pid);
                exit;
            }else {
                return Redirect::to('finish-payment?pm=3&pid='.$pid);
                exit;
            }
            
            
        }
        public function postTopuppledge(){
            $name = Input::get('name');
            $email = Input::get('email');
            $amount = str_replace(array("Rp ","_","."), "", Input::get('pledgeamount'));
            $topupamount = str_replace(array("Rp ","_","."), "", Input::get('topupamount'));
            $reward = Input::get('reward');
            $comment = Input::get('comment');
            $pm = Input::get('pm');
            $pid = SiteHelpers::encryptID(Input::get('pid'),true);
            $bid = SiteHelpers::encryptID(Input::get('bid'),true);
                                    
            $backer = array(
                'backer_amount'=>$floatval($amount) + $floatval($topupamount),
                'reward_id'=>$reward,
                'name'=>$name,
                'backer_date'=>date('Y-m-d H:i:s'),
                'email'=>$email,
                'comment'=>$comment,
                'status'=>0,
            );            
            DB::table('backer')->where('backer_id',$bid)->update($backer);
            
            $payment = array(
                'backer_id' =>$bid,
                'payment_method'=>$pm,
                'amount'=>$amount
            );
            $payment_id = DB::table('backer_payment')->insertGetId($payment);
            
            $rsProject = DB::table('project')->where('project_id', $pid)->first();
            $rsReward = DB::table('reward')->where('reward_id',$reward)->first();
            
            if($pm == "veritrans"){
                    Veritrans_Config::$isProduction = true;
                    Veritrans_Config::$serverKey ='VT-server-ZJqkcuil1Mee47mCBXpD9CQo';

                    //$nameprj = substr($post->post_title, 0, 40);

                    $transaction_details = array(
                        'order_id' => $bid . ' - ' . $rsProject->title,
                        'gross_amount' => floatval($topupamount),
                    );

                    $item1_details = array(
                        'id' => $reward,
                        'price' => floatval($topupamount),
                        'quantity' => 1,
                        'name' => $rsReward->reward_title ,
                    );
                    
                    $items_details = array($item1_details);

                    $transaction = array(
                        'payment_type' => 'vtweb',
                        'vtweb' => array(
                            'credit_card_3d_secure' => true,
                        ),
                        'transaction_details' => $transaction_details,
                        'item_details' => $items_details
                    );

                    $vtweb_url = Veritrans_VtWeb::getRedirectionUrl($transaction);

                    header('Location: ' . $vtweb_url);

                    //add_post_meta($funding_id, 'funding_method', 'veritrans' , true);

                    exit;
            }else if($pm == "transfer"){
                return Redirect::to('finish-payment?pm=2&pid='.$pid);
                exit;
            }else {
                return Redirect::to('finish-payment?pm=3&pid='.$pid);
                exit;
            }
        }

    public function getNotification(){
        Veritrans_Config::$serverKey ='VT-server-ZJqkcuil1Mee47mCBXpD9CQo';

        $notif = new Veritrans_Notification();

        $transaction = $notif->transaction_status;
        $fraud = $notif->fraud_status;

        error_log("Order ID $notif->order_id: " .
          "transaction status = $transaction, fraud staus = $fraud");

//        print_r($notif);

        $arr = explode("-",Input::get('order_id'));
        $orderid = (int)$arr[0];

        if ($transaction == 'capture') {
            if ($fraud == 'challenge') {
                $backer = array(
                    'note'=>'capture-challenge',
                    'status'=>1,
                );
                DB::table('backer')->where('backer_id',$orderid)->update($backer);
                exit(0);
              // TODO Set payment status in merchant's database to 'challenge'
            }
            else if ($fraud == 'accept') {
              // TODO Set payment status in merchant's database to 'success'
                $backer = array(
                    'note'=>'capture-accept',
                    'status'=>1,
                );
                DB::table('backer')->where('backer_id',$orderid)->update($backer);
                exit(0);
            }
        }
        else if ($transaction == 'cancel') {
            if ($fraud == 'challenge') {
              // TODO Set payment status in merchant's database to 'failure'
                $backer = array(
                    'note'=>'cancel-challenge',
                    'status'=>0,
                );
                DB::table('backer')->where('backer_id',$orderid)->update($backer);
                exit(0);
            }
            else if ($fraud == 'accept') {
              // TODO Set payment status in merchant's database to 'failure'
                $backer = array(
                    'note'=>'cancel-accept',
                    'status'=>0,
                );
                DB::table('backer')->where('backer_id',$orderid)->update($backer);
                exit(0);
            }
        }
        else if ($transaction == 'deny') {
          // TODO Set payment status in merchant's database to 'failure'
            $backer = array(
                    'note'=>'deny',
                    'status'=>0,
                );
                DB::table('backer')->where('backer_id',$orderid)->update($backer);
                exit(0);
        }
    }

    public function getPayment($status = null){
        $arr = explode("-",Input::get('order_id'));
        $orderid = (int)$arr[0];

        if($status == "finish" )
        {
            $note = Input::get('transaction_status')."-".Input::get('fraud_status');
            $status = 0;
            if(Input::get('transaction_status') == "capture" || Input::get('transaction_status') == "settlement")
                $status = 1;
            if(Input::get('fraud_status') == "deny") $status = 0;
            $backer = array(
                'note'=>$note,
                'status'=>$status,
            );
            DB::table('backer')->where('backer_id',$orderid)->update($backer);

            $rsB = DB::table('backer')->where('backer_id', $orderid)->first();

            return Redirect::to('finish-payment?pm=1&pid='.$rsB->project_id);
        }else{

            return Redirect::to('finish-payment?pm=1&status='.$status.'&pid='.$pid);
        }
    }
}
