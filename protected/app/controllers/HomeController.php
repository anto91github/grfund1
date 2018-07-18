<?php
date_default_timezone_set("Asia/Jakarta");
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
					$access = json_decode($row->access,true);	
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
            //$page = 'pages.template.homeSplit';
		endif;

        /*$query2 = "SELECT project_id FROM project where project_alias='".htmlentities($alias)."'";
                    $rs3 = DB::select($query2);
                    $this->data['project_id'] = (object)$rs3[0];
                        if($rs3[0]->project_id == '12')
                        {
                          Session::put('lang','en');
                        }*/

		$page = SiteHelpers::renderHtml($page);
		
		//$this->layout->nest('content',$page)->with('menus', $this->menus );
				
                if($this->data['pageTitle'] == "Home")
                //if($this->data['pageTitle'] == "Homepage")
				{
                    $lang = Session::get('lang');
                    if($lang == '') $lang = "in";
                    //-------GET POPULAR CHARITY-------------
                    //$query = "SELECT * FROM project WHERE status >= 1 order by project_id desc LIMIT 4";
                    //$query= "SELECT a.*,b.backer FROM project a LEFT JOIN (SELECT project_id,COUNT(backer_id) as backer FROM backer WHERE status = 1 GROUP BY project_id) b on a.project_id=b.project_id WHERE a.status >= 1 order by b.backer desc LIMIT 4";
                    //$query= "SELECT a.*,b.backer,b.hitung_t FROM project a LEFT JOIN (SELECT project_id,COUNT(backer_id) as backer,COUNT(backer_amount) as hitung_t FROM backer WHERE status = 1 GROUP BY project_id) b on a.project_id=b.project_id WHERE a.status >= 1 order by b.backer desc LIMIT 4";
                    //$query="SELECT a.*,b.backer,b.hitung_t FROM project a LEFT JOIN (SELECT project_id,COUNT(backer_id) as backer,SUM(backer_amount) as hitung_t FROM backer WHERE status = 1 GROUP BY project_id) b on a.project_id=b.project_id WHERE a.status >= 1 order by b.hitung_t desc LIMIT 4";
                    $query= "SELECT a.*,b.backer,b.hitung_t, b.hitung_t/a.amount*100 as persentase FROM project a LEFT JOIN (SELECT project_id,COUNT(backer_id) as backer,SUM(backer_amount) as hitung_t FROM backer WHERE status = 1 GROUP BY project_id) b on a.project_id=b.project_id WHERE a.status >= 1 order by persentase desc LIMIT 4";
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

                            switch($lang){
                                    case "en" :
                                        if ($charity->title_en != '' || $charity->small_content_en != '')
                                        {
                                            $tmp['title_lang'] = $charity->title_en;
                                            $tmp['small_content_lang'] = $charity->small_content_en;
                                        } 
                                        else
                                        {
                                            $tmp['title_lang'] = $charity->title;
                                            $tmp['small_content_lang'] = $charity->small_content;
                                        }
                                        break;

                                    case "in" : $tmp['title_lang'] = $charity->title;
                                                $tmp['small_content_lang'] = $charity->small_content;
                                                break;
                                }							
                            
                            $charity = (object)$tmp;
                            $charity_pop[$i]=$charity;
                            $i++;
                    }
                    $this->data['popularCharity'] = (object)$charity_pop;
                    ////////////////////===Language===////////////////////////////////////
                    
                    ////////////////////////////////////////////////////////////////
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
                    
                    //$query = "SELECT a.* FROM project a JOIN ms_projectcategory b ON a.category=b.id WHERE a.status >= 1";
                    $query = "SELECT a.* FROM project a JOIN ms_projectcategory b ON a.category=b.id WHERE a.status >= 1 AND a.label_id = 1";
                    if($category != "" && $category != "all"){
                        $query .= " AND b.alias='".$category."'";
                    }
                    if($subcategory!="")
                        $query .= " AND a.subcategory='".$subcategory."'";
                    if($title!="")
                        $query .= " AND a.project_alias='".$title."'";
                    
                    //$query .= " ORDER BY a.status asc, a.project_id desc LIMIT 0,16 ";
                    $query .= " ORDER BY a.status desc, a.project_id desc LIMIT 0,50 ";
                        
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

                            $lang = Session::get('lang');
                            if($lang == '') $lang = "in";

                            switch($lang){
                                    case "en" :
                                        if ($project->title_en != '' || $project->small_content_en != '')
                                        {
                                            $tmp['title_lang'] = $project->title_en;
                                            $tmp['small_content_lang'] = $project->small_content_en;
                                        } 
                                        else
                                        {
                                            $tmp['title_lang'] = $project->title;
                                            $tmp['small_content_lang'] = $project->small_content;
                                        }
                                        break;

                                    case "in" : $tmp['title_lang'] = $project->title;
                                                $tmp['small_content_lang'] = $project->small_content;
                                                break;
                                }

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
                    $message = Session::get("message");
                    $this->data["message"] = $message;
                    //$category = Input::get('category');
                    //if($category == "") $category= "all";

                    /*$query2 = "SELECT project_id FROM project where project_alias='".htmlentities($alias)."'";
                    $rs3 = DB::select($query2);
                    $this->data['project_id'] = (object)$rs3[0];
                        if($rs3[0]->project_id == '12' && Session::get('lang')=="in")
                        {
                          Session::put('lang','in');
                        }*/
                   
                   $url = 'http://' . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];
                   if (strpos($url,'?lang=en') !== false) 
                    {
                        $lang = $_GET['lang'];
                        $lang= "en";
                    } 
                    else 
                    {
                        $lang = Session::get('lang');
                        if($lang == '') $lang = "in";
                    }

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
                                
                                
                                switch($lang){
                                    case "en" :
                                        if ($project->title_en != '' || $project->small_content_en != '')
                                        {
                                            $tmp['title_lang'] = $project->title_en;
                                            $tmp['small_content_lang'] = $project->small_content_en;
                                        } 
                                        else
                                        {
                                            $tmp['title_lang'] = $project->title;
                                            $tmp['small_content_lang'] = $project->small_content;
                                        }
                                        break;

                                    case "in" : $tmp['title_lang'] = $project->title;
                                                $tmp['small_content_lang'] = $project->small_content;
                                                break;
                                }

                                

                                $idProject = $project->project_id;
                                $project = (object)$tmp;

                                $query="Select SUM(backer_amount) as hitung2 FROM backer WHERE project_id = '".$project->project_id."' AND status = 1";
                                $rs = DB::select($query);
                                $tmp['hitung_f']=$rs[0]->hitung2;

                                $project_cat[$i]=$project;
                                $i++;
                        }
                        $this->data['project'] = (object)$project_cat[0];

                        $query= "SELECT count(post_id) as hitung_u from tb_post where project_id= '".$project->project_id."'";
                        $rs = DB::select($query);
                        $total_updates="";
                        $this->data['term']=(object)$rs[0];
                        $this->data['updates_count']= $rs[0]->hitung_u;

                        $tab = Input::get('t') == null || Input::get('t') == "" ? 1 : Input::get('t');
                        if($tab > 4) $tab = 1;
                        $this->data['tab'] = $tab;

                        
                        $og_img= $project->banner_img;
                        Session::put('og_img', $og_img);   

                        $og_title= $project->title;
                        Session::put('og_title', $og_title);

                        $og_desc= $project->small_content;                     
                        Session::put('og_desc', $og_desc);

                        $og_url = "http://www.gotongroyong.fund/show-project/".$project->project_alias."";
                        Session::put('og_url', $og_url);

                        $query = "SELECT * from project where status =1";
                        $rs = DB::select($query);

                        $this->data['project_list'] = (object)$rs;

                        //$this->data['categorySearch'] = $category;
                    }

                    /////// Change Language content /////////
                     $query = "SELECT content, content_en FROM project where project_alias='".htmlentities($alias)."'";              
                        
                     $rs2 = DB::select($query);
                     $this->data['project_content'] = (object)$rs2[0]; 
                     

                     $url = 'http://' . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];
                       if (strpos($url,'?lang=') !== false) 
                        {
                            $lang = $_GET['lang'];
                        } 
                        else 
                        {
                            $lang = Session::get('lang');
                            if($lang == '') $lang = "in";
                        }                     

                     $content = "";
                     switch($lang){
                        case "en" : $content = $rs2[0]->content_en; break;
                        case "in" : $content = $rs2[0]->content; break;
                     }

                     /*$query2 = "SELECT project_id FROM project where project_alias='".htmlentities($alias)."'";
                     $rs3 = DB::select($query2);
                     $this->data['project_id'] = (object)$rs3[0];
                     if($rs3[0]->project_id == '95')
                     {
                        $content = $rs2[0]->content_en;
                     }*/
                     

                     if($content == '') $content = $rs2[0]->content;
                     $this->data['contentProject'] = $content;

                     //////////////////////////////////////////////////////////////

                     //---------------------------------- Comment / Messages -----------------------------
                         $id = Auth::id() == '' ? 0 : Auth::id();  
                         //$id = Auth::id();
                         $query = "SELECT * from project where author= $id AND project_alias='".htmlentities($alias)."'";
                         $rs = DB::select($query);
                         
                         if($rs)
                         {
                            Session::put('is_author', 1);
                         }
                         else
                         {
                            Session::put('is_author', 0);
                         }
                         //$user_id = Input::get('user_id2');


                         /*$query2 = "SELECT * FROM tb_comment INNER JOIN tb_users ON tb_comment.user_id = tb_users.id where tb_comment.user_id= $user_id";
                         $rs2 = DB::select($query2);
                         $this->data['comment'] = (object)$rs2;*/

                         $query2 ="SELECT * FROM backer where project_id = $project->project_id and status = 1";
                         $rs2 = DB::select($query2);
                         

                         $i=0;
                         $com_cat=array();
                        /*foreach($rs2 as $get_user_id)
                        {
                         $user_id[$i] = $get_user_id->user_id;
                         $query3= "SELECT * FROM tb_comment a LEFT JOIN tb_users b ON a.user_id=b.id 
                                   where a.user_id= $user_id[$i] and a.project_id = $project->project_id";                                                 
                         $rs3 = DB::select($query3);                           
                         //$this->data['comment'] = (object)$rs3;
                         $com_cat[] = (object)$rs3;                         
                         $i++;                                        
                        }
                        $this->data['comment1'] = $com_cat;*/


                        
                        

                        

                     //---------------------------------------------------------------------------------

                     //----------------------------------Recent Updates Tab-----------------------------------

                     $query = "SELECT * from tb_post where project_id= $idProject ORDER BY post_id DESC";
                     $rs = DB::select($query);
                     $updates_cat=array();                    
                     foreach($rs as $updates){
                        $tmp = (array)$updates;
                        switch($lang){
                                    case "en" :
                                        if ($updates->post_header_en != '' || $updates->post_content_en != ''|| $updates->small_content_en != '')
                                        {
                                            $tmp['post_header_lang'] = $updates->post_header_en;
                                            $tmp['post_content_lang'] = $updates->post_content_en;
                                            $tmp['small_content_lang'] = $updates->small_content_en;
                                        } 
                                        else
                                        {
                                            $tmp['post_header_lang'] = $updates->post_header;
                                            $tmp['post_content_lang'] = $updates->post_content;
                                            $tmp['small_content_lang'] = $updates->small_content;
                                        }
                                        break;

                                    case "in" : $tmp['post_header_lang'] = $updates->post_header;
                                                $tmp['post_content_lang'] = $updates->post_content;
                                                $tmp['small_content_lang'] = $updates->small_content;
                                                break;
                                }

                                 /*$query2 = "SELECT project_id FROM project where project_alias='".htmlentities($alias)."'";
                                 $rs3 = DB::select($query2);
                                 $this->data['project_id'] = (object)$rs3[0];
                                 if($rs3[0]->project_id == '95')
                                 {
                                    $tmp['post_header_lang'] = $updates->post_header_en;
                                    $tmp['post_content_lang'] = $updates->post_content_en;
                                    $tmp['small_content_lang'] = $updates->small_content_en;
                                 }*/

                                $updates_cat[] = (object)$tmp;                        

                     }  
                     $this->data['recent_updates'] = $updates_cat;               
                     
                     

                    //------------------------------------Available Reward-----------------------------------------------------------//
                    $url = 'http://' . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];
                   if (strpos($url,'?lang=') !== false) 
                    {
                        $lang = $_GET['lang'];
                    } 
                    else 
                    {
                        $lang = Session::get('lang');
                        if($lang == '') $lang = "in";
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
                            switch($lang){
                                    case "en" :
                                        if ($rs_temp->reward_title_en != '' || $rs_temp->reward_description_en != '')
                                        {
                                            $tmp['reward_title_lang'] = $rs_temp->reward_title_en;
                                            $tmp['reward_description_lang'] = $rs_temp->reward_description_en;
                                        } 
                                        else
                                        {
                                            $tmp['reward_title_lang'] = $rs_temp->reward_title;
                                            $tmp['reward_description_lang'] = $rs_temp->reward_description;
                                        }
                                        break;

                                    case "in" : $tmp['reward_title_lang'] = $rs_temp->reward_title;
                                                $tmp['reward_description_lang'] = $rs_temp->reward_description;
                                                break;
                                }

                            /*$query2 = "SELECT project_id FROM project where project_alias='".htmlentities($alias)."'";
                            $rs3 = DB::select($query2);
                            $this->data['project_id'] = (object)$rs3[0];
                                if($rs3[0]->project_id == '95')
                                 {
                                    $tmp['reward_title_lang'] = $rs_temp->reward_title_en;
                                    $tmp['reward_description_lang'] = $rs_temp->reward_description_en;
                                 }*/

                            $reward_cat[] = (object)$tmp;
                        }                   
                    $this->data['rewards'] = $reward_cat;	
					
                    //---------------------------------------Total Fund-------------------------------------------------------------//					
					$query="Select SUM(backer_amount) as hitung2 FROM backer WHERE project_id = $idProject AND status = 1";
					$rs = DB::select($query);
					$tmp['hitung_f']=$rs[0]->hitung2;
					$fund_cat[] = (object)$tmp;
					$this->data['total_fund'] = $fund_cat;
						
					
                    //$query = "SELECT a.*,IFNULL(b.reward_title,'') as reward_title FROM backer a LEFT JOIN reward b ON a.reward_id = b.reward_id WHERE a.project_id = $idProject AND a.status = 1";
                    $query = "SELECT a.*, 
                            IFNULL(c.avatar,'default.png') as avatar,
                            IFNULL(b.reward_title,'') as reward_title, 
                            IFNULL(b.reward_title_en,'') as reward_title_en
                            
                            FROM backer a 
                            LEFT JOIN reward b ON a.reward_id = b.reward_id 
                            LEFT JOIN tb_users c ON a.user_id = c.id
                            
                            WHERE a.project_id = $idProject AND a.status = 1 ";
                    $rs = DB::select($query);

                    //$this->data['backers'] = $rs;

                    $reward_cat=array();
                    $msg_cat=array();
                        foreach($rs as $rs_temp)
                        {
                            $tmp = (array)$rs_temp;
                            //$tmp2 = (array)$rs_temp;                            
                            switch($lang){
                                    case "en" :
                                        if ($rs_temp->reward_title_en != '')
                                        {
                                            $tmp['reward_title_lang'] = $rs_temp->reward_title_en;                                            
                                        } 
                                        else
                                        {
                                            $tmp['reward_title_lang'] = $rs_temp->reward_title;                                            
                                        }
                                        break;

                                    case "in" : $tmp['reward_title_lang'] = $rs_temp->reward_title;                                                
                                                break;
                                            
                                    }
                                    /*$query2 = "SELECT project_id FROM project where project_alias='".htmlentities($alias)."'";
                                    $rs3 = DB::select($query2);
                                    $this->data['project_id'] = (object)$rs3[0];
                                        if($rs3[0]->project_id == '95')
                                         {
                                            $tmp['reward_title_lang'] = $rs_temp->reward_title_en;
                                         }*/

                                    $tmp['user_id_msg'] =$rs_temp->user_id;
                                    $user_id_msg = $tmp['user_id_msg'];

                                        //$query2 = "SELECT message from tb_comment where user_id= $user_id_msg";
                                       // $rs2 = DB::select($query2);
                                       
                                        //$msg_cat[]= (object)$rs2;                                        
                                        $reward_cat[] = (object)$tmp;                                        
                                        //$msg_cat[]= (object)$tmp2;                              
                                    }                   
                            $this->data['backers'] = $reward_cat;                            
                            //$this->data['msg'] = $msg_cat;

                    
                    if(Input::get("step") == 2){                        
                        $idbacker = Session::get('id_topup');
                        $query = "SELECT * FROM backer WHERE backer_id = $idbacker AND status = 1";
                        $rsTopup = DB::select($query);
                        if($rsTopup != null)
                        $this->data['topup'] = $rsTopup[0];
                        $this->data['backerid'] = SiteHelpers::encryptID($idbacker);
                    }
                    if(Input::get("step")== 1 AND  Auth::id()== null ){  
                        return Redirect::to('user/login');
                    }

                    if(Input::get("step")== 1 AND  Auth::id()!= null ){ 
                    $idlogin= Auth::id();
                    $query= "SELECT email from tb_users where id= $idlogin";
                    $rs = DB::select($query);
                    $this->data['email_login'] = $rs[0];
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
                    $message = Session::get("message");
                    $this->data["message"] = $message;

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
                            
                            $query = "SELECT COUNT(backer_id) as backer FROM backer WHERE project_id = '".$project->project_id."' AND status >=1";
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
                    
                    $query = "SELECT a.*,
                              b.reward_title,b.reward_description,
                              c.title,c.banner_img,
                              c.project_alias, c.project_id 
                              FROM backer a 
                              LEFT JOIN reward b ON a.reward_id = b.reward_id 
                              JOIN project c ON a.project_id = c.project_id
                              WHERE a.user_id = $id 
                              Order by a.backer_id desc";
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
                    if($tab > 4) $tab = 1;
                    $this->data['tab'] = $tab;

                    $query = "SELECT * from tb_post where project_id= $id ORDER BY post_id DESC";
                    $rs = DB::select($query);
                    $this->data['recent_updates'] = (object)$rs;
                }

                else if($this->data['pageTitle']=="EditUpdate"){
                    $pid = $_GET['pid'];                    
                    //-------GET POPULAR CHARITY-------------
                    //$category = Input::get('category');
                    //if($category == "") $category= "all";
                    $query = "SELECT project.*, 
                              tb_post.post_id,
                              tb_post.small_content as small_post,tb_post.small_content_en as small_post_en,
                              tb_post.post_header, tb_post.post_header_en,
                              tb_post.post_content, tb_post.post_content_en
                              FROM project inner join tb_post on project.project_id=tb_post.project_id WHERE tb_post.post_id='$pid'";
                    //if($category != "" && $category != "all"){
                        //$query .= " AND subcategory='".$category."'";
                    //}
                    $rs = DB::select($query);
                                          
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
                    
                    
                    $id = $rs[0]->project_id;
                    $query = "SELECT * FROM reward WHERE project_id='$id'";
                    $rs = DB::select($query);
                    $this->data['rewards'] = (object)$rs;

                    $query="select * from ms_projectcategory order by name ASC";
                    $rs = DB::select($query);       
                    $this->data['category'] = $rs;                    
                    
                    $tab = Input::get('t') == null || Input::get('t') == "" ? 1 : Input::get('t');
                    if($tab > 4) $tab = 1;
                    $this->data['tab'] = $tab;

                    $query = "SELECT * from tb_post where project_id= $id ORDER BY post_id DESC";
                    $rs = DB::select($query);
                    $this->data['recent_updates'] = (object)$rs;
                }
                
                else if($this->data['pageTitle']=="Change Password"){
                    $message = Session::get("message");
                    $this->data["message"] = $message;
                }                
                else if($this->data['pageTitle']=="Finish Payment"){
                    $pid = Input::get('pid');
                    $rsProject = DB::table('project')->where('project_id',$pid)->first();

                    $rsInvoice = DB::table('backer_payment')->where('backer_id',$pid)->first();
                    if($rsProject == null ) return Redirect::to('/');
                    $this->data['project'] = $rsProject;
                    $this->data['pm']=Input::get('pm');
                    $this->data['status']=Input::get('status');
                    $this->data['bank']=Input::get('bank');
					//$page = 'pages.template.finishpayment.blade.php';
                }
				 else if($this->data['pageTitle']=="About Us" ){
                    //-------GET ABOUT US-------------              
                    $query = "SELECT * FROM tb_pages_content WHERE code = 'About Us' ";              
                        
                    $rs = DB::select($query);
                     $this->data['about'] = (object)$rs[0]; 
                     $lang = Session::get('lang');
                     if($lang == '') $lang = "in";
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
                     if($lang == '') $lang = "in";
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
                     if($lang == '') $lang = "in";
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
                     if($lang == '') $lang = "in";
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
                     if($lang == '') $lang = "in";
                     
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

                 else if($this->data['pageTitle']=="Forgot Password" )
                 {
                    $message = Session::get("message");
                    $this->data["message"] = $message;
                 }
                 else if($this->data['pageTitle']=="payment-landing" )
                 {
                    $pid = SiteHelpers::encryptID(Input::get('pid'),true);                   
                    $amount = str_replace(array("Rp ","_","."), "", Input::get('amount'));
                    $reward_count= Input::get('reward_count');
                    $reward_id = Input::get('reward');

                    $name = Input::get('name');
                    $email = Input::get('email');
                    $phone = Input::get('phone');
                    $comment = Input::get('comment');

                    $fund_choice = Input::get('tran_fund');
                    $project_alternate = Input::get('select_tran_fund');
                    
                    Session::put('pid', $pid);
                    Session::put('amount', $amount);
                    Session::put('reward_count', $reward_count);
                    Session::put('reward_id', $reward_id);
                    Session::put('name_pay', $name);
                    Session::put('email_pay', $email);
                    Session::put('phone_pay', $phone);
                    Session::put('comment_pay', $comment);                    
                    Session::put('fund_choice', $fund_choice);
                    Session::put('project_alternate', $project_alternate);
                 }
                 else if($this->data['pageTitle']=="Testimoni" )
                 {
                    $query = "SELECT * FROM testimonial ORDER BY id DESC LIMIT 3";
                    $rs = DB::select($query);
                    $this->data['testimonials'] = $rs;

                    
                    $query = "SELECT * FROM beneficiary_testimonial ORDER BY id DESC LIMIT 3";
                    $rs = DB::select($query);
                    $this->data['beneficiary_testimonials'] = $rs;

                    $query = "SELECT * FROM cms_client WHERE status = 1";
                    $rs = DB::select($query);
                    $this->data['clients'] = $rs;
                 }
                 else if($this->data['pageTitle']=="ShowUpdates")
                 {
                    $project_id= $_GET['pid'];
                    $id= $_GET['id'];
                    $query= "SELECT * FROM tb_post inner join project on tb_post.project_id=project.project_id where post_id=$id";
                    $rs = DB::select($query);

                    $lang = Session::get('lang');
                     if($lang == '') $lang = "in";
                     
                     $content = "";
                     $header="";
                     $title="";
                     switch($lang){
                        case "en" : $content = $rs[0]->post_content_en; 
                                    $header = $rs[0]->post_header_en; 
                                    $title = $rs[0]->title_en; break;
                        case "in" : $content = $rs[0]->post_content; 
                                    $header = $rs[0]->post_header;
                                    $title = $rs[0]->title; break;
                     }
                     if($content == '') $content = $rs[0]->post_content;
                     if($header == '') $header = $rs[0]->post_header;
                     if($title == '') $header = $rs[0]->title;

                     $this->data['term'] = (object)$rs[0]; 
                       
                     $this->data['post_header'] = $header;
                     $this->data['post_content'] = $content;
                     $this->data['title'] = $title;
                     $this->data['date']= $rs[0]->post_date;

                     $lang = Session::get('lang');
                   if($lang == '') $lang = "in";
                   ////////////////////  Backers   /////////////////////////////////////////////////
                    $query="Select SUM(backer_amount) as hitung2 FROM backer WHERE project_id = $project_id AND status = 1";
                    $rs = DB::select($query);
                    $tmp['hitung_f']=$rs[0]->hitung2;
                    $fund_cat[] = (object)$tmp;
                    $this->data['total_fund'] = $fund_cat;
                        
                    
                    //$query = "SELECT a.*,IFNULL(b.reward_title,'') as reward_title FROM backer a LEFT JOIN reward b ON a.reward_id = b.reward_id WHERE a.project_id = $idProject AND a.status = 1";
                    $query = "SELECT a.*, IFNULL(c.avatar,'default.png') as avatar,IFNULL(b.reward_title,'') as reward_title, IFNULL(b.reward_title_en,'') as reward_title_en  FROM backer a LEFT JOIN reward b ON a.reward_id = b.reward_id LEFT JOIN tb_users c ON a.user_id = c.id WHERE a.project_id = $project_id AND a.status = 1 ";
                    $rs = DB::select($query);
                    //$this->data['backers'] = $rs;

                    $reward_cat=array();
                        foreach($rs as $rs_temp)
                        {
                            $tmp = (array)$rs_temp;                            
                            switch($lang){
                                    case "en" :
                                        if ($rs_temp->reward_title_en != '')
                                        {
                                            $tmp['reward_title_lang'] = $rs_temp->reward_title_en;                                            
                                        } 
                                        else
                                        {
                                            $tmp['reward_title_lang'] = $rs_temp->reward_title;                                            
                                        }
                                        break;

                                    case "in" : $tmp['reward_title_lang'] = $rs_temp->reward_title;                                                
                                                break;
                                }
                            $reward_cat[] = (object)$tmp;
                        }                   
                    $this->data['backers'] = $reward_cat;

                    if(Input::get("step") == 2){
                        $idbacker = Session::get('id_topup');
                        $query = "SELECT * FROM backer WHERE backer_id = $idbacker AND status = 1";
                        $rsTopup = DB::select($query);
                        if($rsTopup != null)
                        $this->data['topup'] = $rsTopup[0];
                        $this->data['backerid'] = SiteHelpers::encryptID($idbacker);
                    }
                    
                    $this->data['pid'] = SiteHelpers::encryptID($project_id); 
                   ////////////////////////////////////////////////////////////////////////////

                //  Recent Updates //
                    $query = "SELECT * from tb_post where project_id= $project_id ORDER BY post_id DESC";
                     $rs = DB::select($query);
                     $updates_cat=array();                    
                     foreach($rs as $updates){
                        $tmp = (array)$updates;
                        switch($lang){
                                    case "en" :
                                        if ($updates->post_header_en != '' || $updates->post_content_en != ''|| $updates->small_content_en != '')
                                        {
                                            $tmp['post_header_lang'] = $updates->post_header_en;
                                            $tmp['post_content_lang'] = $updates->post_content_en;
                                            $tmp['small_content_lang'] = $updates->small_content_en;
                                        } 
                                        else
                                        {
                                            $tmp['post_header_lang'] = $updates->post_header;
                                            $tmp['post_content_lang'] = $updates->post_content;
                                            $tmp['small_content_lang'] = $updates->small_content;
                                        }
                                        break;

                                    case "in" : $tmp['post_header_lang'] = $updates->post_header;
                                                $tmp['post_content_lang'] = $updates->post_content;
                                                $tmp['small_content_lang'] = $updates->small_content;
                                                break;
                                }
                                $updates_cat[] = (object)$tmp;                        

                     }  
                     $this->data['recent_updates'] = $updates_cat; 
                /////////////////////

                //////////////////////////// Rewards ////////////////////
                     $lang = Session::get('lang');
                    if($lang == '') $lang = "in";

                    $query = "SELECT * FROM reward WHERE project_id = $project_id";
                    $rs = DB::select($query);
                    $reward_cat=array();
                        foreach($rs as $rs_temp)
                        {
                            $query2 ="SELECT COUNT(backer_id) as hitung1 FROM backer WHERE project_id = $project_id and reward_id= $rs_temp->reward_id and status=1";
                            $rs2 = DB::select($query2);
                            $tmp = (array)$rs_temp;
                            $tmp['hitung_h']=$rs2[0]->hitung1;
                            switch($lang){
                                    case "en" :
                                        if ($rs_temp->reward_title_en != '' || $rs_temp->reward_description_en != '')
                                        {
                                            $tmp['reward_title_lang'] = $rs_temp->reward_title_en;
                                            $tmp['reward_description_lang'] = $rs_temp->reward_description_en;
                                        } 
                                        else
                                        {
                                            $tmp['reward_title_lang'] = $rs_temp->reward_title;
                                            $tmp['reward_description_lang'] = $rs_temp->reward_description;
                                        }
                                        break;

                                    case "in" : $tmp['reward_title_lang'] = $rs_temp->reward_title;
                                                $tmp['reward_description_lang'] = $rs_temp->reward_description;
                                                break;
                                }
                            $reward_cat[] = (object)$tmp;
                        }                   
                    $this->data['rewards'] = $reward_cat;
                /////////////////////////////////////////////////////////
                                        

                    $query = "SELECT a.*,b.first_name,b.last_name,b.avatar,b.city,b.website,c.name as country "
                            . "FROM project a LEFT JOIN tb_users b ON a.entry_by=b.id "
                            . "LEFT JOIN ms_country c ON b.country = c.id "
                            . "WHERE a.status >= 1 AND a.project_id='$project_id'";
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
                                
                                switch($lang){
                                    case "en" :
                                        if ($project->title_en != '' || $project->small_content_en != '')
                                        {
                                            $tmp['title_lang'] = $project->title_en;
                                            $tmp['small_content_lang'] = $project->small_content_en;
                                        } 
                                        else
                                        {
                                            $tmp['title_lang'] = $project->title;
                                            $tmp['small_content_lang'] = $project->small_content;
                                        }
                                        break;

                                    case "in" : $tmp['title_lang'] = $project->title;
                                                $tmp['small_content_lang'] = $project->small_content;
                                                break;
                                }

                                $idProject = $project->project_id;
                                $project = (object)$tmp;

                                $query="Select SUM(backer_amount) as hitung2 FROM backer WHERE project_id = '".$project->project_id."' AND status = 1";
                                $rs = DB::select($query);
                                $tmp['hitung_f']=$rs[0]->hitung2;

                                $project_cat[$i]=$project;
                                $i++;
                        }
                        $this->data['project'] = (object)$project_cat[0];

                        $query= "SELECT count(post_id) as hitung_u from tb_post where project_id= '".$project->project_id."'";
                        $rs = DB::select($query);
                        $total_updates="";
                        $this->data['term']=(object)$rs[0];
                        $this->data['updates_count']= $rs[0]->hitung_u;

                        
                        $og_img= $project->banner_img;
                        Session::put('og_img', $og_img);   

                        $og_title= $project->title;
                        Session::put('og_title', $og_title);

                        $og_desc= $project->small_content;                     
                        Session::put('og_desc', $og_desc);

                        $og_url = "http://www.gotongroyong.fund/show-project/".$project->project_alias."";
                        Session::put('og_url', $og_url);                      
                 }
                }

                 else if($this->data['pageTitle']=="NewestProjects")
                 {
                    //$query = "SELECT * FROM project where status >=1 ORDER BY 'project_id'  ASC limit 4";
                    $query="SELECT * FROM project where status >=1 ORDER BY project.project_id DESC LIMIT 4 ";
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
                    $this->data['newest_pro'] = (object)$charity_pop;
                 }

                 else if($this->data['pageTitle']=="showMessageUser"){
                    //-------GET Account-------------
                    
                    //$category = Input::get('category');
                    //if($category == "") $category= "all";
                    $message = Session::get("message");
                    $this->data["message"] = $message;

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
                            
                            $query = "SELECT COUNT(backer_id) as backer FROM backer WHERE project_id = '".$project->project_id."' AND status >=1";
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
                    
                    $query = "SELECT a.*, b.reward_title,b.reward_description,c.title,c.banner_img,c.project_id,c.project_alias FROM backer a LEFT JOIN reward b ON a.reward_id = b.reward_id JOIN project c ON a.project_id = c.project_id WHERE a.user_id = $id Order by a.backer_id desc";
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

                    $project_id= $_GET["pid"];
                    $bid= $_GET["bid"];
                    $email = $_GET["e"];
                    $email_de = Crypt::decrypt($email);

                    $query2 = "SELECT * FROM tb_comment
                               LEFT JOIN tb_users
                               on tb_comment.from_user_id = tb_users.id                        
                               where tb_comment.project_id=$project_id and tb_comment.email='$email_de'
                               ORDER BY tb_comment.date DESC";
                         $rs2 = DB::select($query2);
                         $this->data['pesan'] = $rs2;

                         $query3= "SELECT * FROM backer
                                   where backer_id=$bid";
                         $rs3 = DB::select($query3);
                         $this->data['donatur'] = $rs3;

                         $query4 = "SELECT first_name,last_name from tb_users
                                    INNER JOIN project
                                    on tb_users.id = project.author
                                    where project.project_id = $project_id";
                        $rs4 = DB::select($query4);
                        $this->data['p_owner'] = $rs4[0];

                        $query5= "SELECT * from project where project_id= $project_id";
                        $rs5 = DB::select($query5);
                        $this->data['p_project']= $rs5[0];
                        //$this->data['p_owner'] = (object)$rs4;
                        //print_r($rs4);
                        //exit();                        
                }

                 else if($this->data['pageTitle']=="showMessages"){                    
                    //-------GET POPULAR CHARITY-------------
                    $message = Session::get("message");
                    $this->data["message"] = $message;
                    //$category = Input::get('category');
                    //if($category == "") $category= "all";
                   $lang = Session::get('lang');
                   if($lang == '') $lang = "in";

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
                                
                                switch($lang){
                                    case "en" :
                                        if ($project->title_en != '' || $project->small_content_en != '')
                                        {
                                            $tmp['title_lang'] = $project->title_en;
                                            $tmp['small_content_lang'] = $project->small_content_en;
                                        } 
                                        else
                                        {
                                            $tmp['title_lang'] = $project->title;
                                            $tmp['small_content_lang'] = $project->small_content;
                                        }
                                        break;

                                    case "in" : $tmp['title_lang'] = $project->title;
                                                $tmp['small_content_lang'] = $project->small_content;
                                                break;
                                }

                                $idProject = $project->project_id;
                                $project = (object)$tmp;

                                $query="Select SUM(backer_amount) as hitung2 FROM backer WHERE project_id = '".$project->project_id."' AND status = 1";
                                $rs = DB::select($query);
                                $tmp['hitung_f']=$rs[0]->hitung2;

                                $project_cat[$i]=$project;
                                $i++;
                        }
                        $this->data['project'] = (object)$project_cat[0];

                        $query= "SELECT count(post_id) as hitung_u from tb_post where project_id= '".$project->project_id."'";
                        $rs = DB::select($query);
                        $total_updates="";
                        $this->data['term']=(object)$rs[0];
                        $this->data['updates_count']= $rs[0]->hitung_u;

                        $tab = Input::get('t') == null || Input::get('t') == "" ? 1 : Input::get('t');
                        if($tab > 4) $tab = 1;
                        $this->data['tab'] = $tab;

                        
                        $og_img= $project->banner_img;
                        Session::put('og_img', $og_img);   

                        $og_title= $project->title;
                        Session::put('og_title', $og_title);

                        $og_desc= $project->small_content;                     
                        Session::put('og_desc', $og_desc);

                        $og_url = "http://www.gotongroyong.fund/show-project/".$project->project_alias."";
                        Session::put('og_url', $og_url);

                        //$this->data['categorySearch'] = $category;
                    }

                    /////// Change Language content /////////
                     $query = "SELECT content, content_en FROM project where project_alias='".htmlentities($alias)."'";              
                        
                     $rs2 = DB::select($query);
                     $this->data['project_content'] = (object)$rs2[0]; 
                     $lang = Session::get('lang');
                     if($lang == '') $lang = "in";
                     $content = "";
                     switch($lang){
                        case "en" : $content = $rs2[0]->content_en; break;
                        case "in" : $content = $rs2[0]->content; break;
                     }
                     if($content == '') $content = $rs2[0]->content;
                     $this->data['contentProject'] = $content;

                     //////////////////////////////////////////////////////////////

                     //---------------------------------- Comment / Messages -----------------------------
                         $id = Auth::id() == '' ? 0 : Auth::id();  
                         //$id = Auth::id();
                         $query = "SELECT * from project where author= $id AND project_alias='".htmlentities($alias)."'";
                         $rs = DB::select($query);
                         
                         if($rs)
                         {
                            Session::put('is_author', 1);
                         }
                         else
                         {
                            Session::put('is_author', 0);
                         }                    

                         //lanjut sini
                         $project_id= $_GET['pid'];
                         $email= $_GET['e'];
                         $email_de = Crypt::decrypt($email);
                         $bid=$_GET['bid'];
                         

                         $query2 = "SELECT * FROM tb_comment
                                    LEFT JOIN tb_users
                                    on tb_comment.from_user_id = tb_users.id                        
                                    where tb_comment.project_id=$project_id and tb_comment.email='$email_de'
                                    ORDER BY tb_comment.date DESC";
                         $rs2 = DB::select($query2);
                         $this->data['pesan'] = $rs2;

                         $query3= "SELECT * FROM backer
                                   where backer_id=$bid";
                         $rs3 = DB::select($query3);
                         $this->data['donatur'] = $rs3;
                        
                        

                        

                     //---------------------------------------------------------------------------------

                     //----------------------------------Recent Updates Tab-----------------------------------

                     $query = "SELECT * from tb_post where project_id= $idProject ORDER BY post_id DESC";
                     $rs = DB::select($query);
                     $updates_cat=array();                    
                     foreach($rs as $updates){
                        $tmp = (array)$updates;
                        switch($lang){
                                    case "en" :
                                        if ($updates->post_header_en != '' || $updates->post_content_en != ''|| $updates->small_content_en != '')
                                        {
                                            $tmp['post_header_lang'] = $updates->post_header_en;
                                            $tmp['post_content_lang'] = $updates->post_content_en;
                                            $tmp['small_content_lang'] = $updates->small_content_en;
                                        } 
                                        else
                                        {
                                            $tmp['post_header_lang'] = $updates->post_header;
                                            $tmp['post_content_lang'] = $updates->post_content;
                                            $tmp['small_content_lang'] = $updates->small_content;
                                        }
                                        break;

                                    case "in" : $tmp['post_header_lang'] = $updates->post_header;
                                                $tmp['post_content_lang'] = $updates->post_content;
                                                $tmp['small_content_lang'] = $updates->small_content;
                                                break;
                                }
                                $updates_cat[] = (object)$tmp;                        

                     }  
                     $this->data['recent_updates'] = $updates_cat;               
                     
                     

                    //------------------------------------Available Reward-----------------------------------------------------------//
                    $lang = Session::get('lang');
                    if($lang == '') $lang = "in";

                    $query = "SELECT * FROM reward WHERE project_id = $idProject";
                    $rs = DB::select($query);
                    $reward_cat=array();
                        foreach($rs as $rs_temp)
                        {
                            $query2 ="SELECT COUNT(backer_id) as hitung1 FROM backer WHERE project_id = $idProject and reward_id= $rs_temp->reward_id and status=1";
                            $rs2 = DB::select($query2);
                            $tmp = (array)$rs_temp;
                            $tmp['hitung_h']=$rs2[0]->hitung1;
                            switch($lang){
                                    case "en" :
                                        if ($rs_temp->reward_title_en != '' || $rs_temp->reward_description_en != '')
                                        {
                                            $tmp['reward_title_lang'] = $rs_temp->reward_title_en;
                                            $tmp['reward_description_lang'] = $rs_temp->reward_description_en;
                                        } 
                                        else
                                        {
                                            $tmp['reward_title_lang'] = $rs_temp->reward_title;
                                            $tmp['reward_description_lang'] = $rs_temp->reward_description;
                                        }
                                        break;

                                    case "in" : $tmp['reward_title_lang'] = $rs_temp->reward_title;
                                                $tmp['reward_description_lang'] = $rs_temp->reward_description;
                                                break;
                                }
                            $reward_cat[] = (object)$tmp;
                        }                   
                    $this->data['rewards'] = $reward_cat;   
                    
                    //---------------------------------------Total Fund-------------------------------------------------------------//                  
                    $query="Select SUM(backer_amount) as hitung2 FROM backer WHERE project_id = $idProject AND status = 1";
                    $rs = DB::select($query);
                    $tmp['hitung_f']=$rs[0]->hitung2;
                    $fund_cat[] = (object)$tmp;
                    $this->data['total_fund'] = $fund_cat;
                        
                    
                    //$query = "SELECT a.*,IFNULL(b.reward_title,'') as reward_title FROM backer a LEFT JOIN reward b ON a.reward_id = b.reward_id WHERE a.project_id = $idProject AND a.status = 1";
                    $query = "SELECT a.*, 
                            IFNULL(c.avatar,'default.png') as avatar,
                            IFNULL(b.reward_title,'') as reward_title, 
                            IFNULL(b.reward_title_en,'') as reward_title_en
                            
                            FROM backer a 
                            LEFT JOIN reward b ON a.reward_id = b.reward_id 
                            LEFT JOIN tb_users c ON a.user_id = c.id
                            
                            WHERE a.project_id = $idProject AND a.status = 1 ";
                    $rs = DB::select($query);

                    //$this->data['backers'] = $rs;

                    $reward_cat=array();
                    $msg_cat=array();
                        foreach($rs as $rs_temp)
                        {
                            $tmp = (array)$rs_temp;
                            //$tmp2 = (array)$rs_temp;                            
                            switch($lang){
                                    case "en" :
                                        if ($rs_temp->reward_title_en != '')
                                        {
                                            $tmp['reward_title_lang'] = $rs_temp->reward_title_en;                                            
                                        } 
                                        else
                                        {
                                            $tmp['reward_title_lang'] = $rs_temp->reward_title;                                            
                                        }
                                        break;

                                    case "in" : $tmp['reward_title_lang'] = $rs_temp->reward_title;                                                
                                                break;
                                            
                                    }
                                    $tmp['user_id_msg'] =$rs_temp->user_id;
                                    $user_id_msg = $tmp['user_id_msg'];

                                        //$query2 = "SELECT message from tb_comment where user_id= $user_id_msg";
                                        //$rs2 = DB::select($query2);
                                       
                                        $msg_cat[]= (object)$rs2;                                        
                                        $reward_cat[] = (object)$tmp;                                        
                                        //$msg_cat[]= (object)$tmp2;                              
                                    }                   
                            $this->data['backers'] = $reward_cat;                            
                            $this->data['msg'] = $msg_cat;

                    
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
                
				 $query = "SELECT title FROM project"; 
				 $rs2 = DB::select($query);
				 $this->data['ftitle'] = $rs2[0]; 
                 
                 $query = "SELECT * FROM cms_client WHERE status = 1";
                 $rs = DB::select($query);
                 $this->data['clients'] = $rs;

				 
		$this->layout->nest('content',$page, $this->data)->with('menus', $this->menus );
	  //$this->layout->nest('content',$page, $this->data);	
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

        public function postAddMessages(){                        
            date_default_timezone_set("Asia/Jakarta");
            $message= Input::get("message_body");
            $from_user_id = Auth::id();
            $to_user_id = Input::get("user_id");
            $project_id = Input::get("project_id");            
            $email= Input::get("email");           
            $date =date('Y-m-d H:i:s');

            $dataProject = array(
                //'owner_id'=>$owner_id,
                'project_id'=>$project_id,                
                'from_user_id'=>$from_user_id,
                'to_user_id'=>$to_user_id,
                'email'=>$email,                
                'message'=>$message,                
                'date' =>$date            
            );
        $id = DB::table('tb_comment')->insertGetId(
                $dataProject
            );
        $query= "SELECT first_name, last_name from tb_users where id= $from_user_id";
        $rs = DB::select($query);
        
        $first_name = $rs[0]->first_name;
        $last_name = $rs[0]->last_name;

        $query2= "SELECT title from project where project_id = $project_id";
        $rs2 = DB::select($query2);

        $project_title= $rs2[0]->title;

        //-------------------------Email---------------------
        $to = $email;
        $subject = "Gotongroyong.fund notification message";
        //$message = "file_get_contents('http://localhost/Dropbox/grfund1/emailMessageNotif');";
        
        $message = "
        <html xmlns='http://www.w3.org/1999/xhtml' xmlns:v='urn:schemas-microsoft-com:vml' xmlns:o='urn:schemas-microsoft-com:office:office'>
<head>
<meta charset='UTF-8'>
<meta http-equiv='X-UA-Compatible' content='IE=edge'>
<meta name='viewport' content='width=device-width, initial-scale=1'>
<title>Project Notification</title>
</head>
<body style='height: 100%;margin: 0;padding: 0;width: 100%;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;background-color: white;'>
<center>
<table align='center' border='0' cellpadding='0' cellspacing='0' height='100%' width='100%' id='bodyTable' style='border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;height: 100%;margin: 0;padding: 0;width: 100%;background-color: #596c78;'>
<tr>
<td align='center' valign='top' id='bodyCell' style='mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;height: 100%;margin: 0;padding: 10px;width: 100%;border-top: 0;'>
<table border='0' cellpadding='0' cellspacing='0' width='100%' class='templateContainer' style='border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;border: 0;max-width: 600px !important;'>
<tr>
<td valign='top' id='templatePreheader' style='mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;background-color: #f0594d;border-top: 0;border-bottom: 0;padding-top: 9px;padding-bottom: 9px;'><table class='mcnTextBlock' style='min-width: 100%;border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;' border='0' cellpadding='0' cellspacing='0' width='100%'>
<tbody class='mcnTextBlockOuter'>
<tr>
<td class='mcnTextBlockInner' valign='top' style='mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;'>
<table style='min-width: 100%;border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;' class='mcnTextContentContainer' align='left' border='0' cellpadding='0' cellspacing='0' width='100%'>
<tbody><tr>
<td class='mcnTextContent' style='padding-top: 9px;padding-right: 18px;padding-bottom: 9px;padding-left: 18px;mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;word-break: break-word;color: #ffffff;font-family: Helvetica;font-size: 12px;line-height: 150%;text-align: left;' valign='top'>
                        
                            

                        </td>
                    </tr>
                </tbody></table>
                
            </td>
        </tr>
    </tbody>
</table></td>
                            </tr>
                            <tr>
                                <td valign='top' id='templateHeader' style='mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;background-color: #FFFFFF;border-top: 0;border-bottom: 0;padding-top: 0px;padding-bottom: 8px;'><table class='mcnTextBlock' style='min-width: 100%;border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;' border='0' cellpadding='0' cellspacing='0' width='100%'>
    <tbody class='mcnTextBlockOuter'>
        <tr>
            <td class='mcnTextBlockInner' valign='top' style='mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;'>
                
                <table style='min-width: 100%;border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;' class='mcnTextContentContainer' align='left' border='0' cellpadding='0' cellspacing='0' width='100%'>
                    <tbody><tr>
                        
                        <td class='mcnTextContent' style='padding-top: 9px;padding-right: 18px;padding-bottom: 9px;padding-left: 18px;mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;word-break: break-word;color: #202020;font-family: Helvetica;font-size: 16px;line-height: 150%;text-align: left;' valign='top'>
                        
                            <div style='text-align: center;'><a href='http://gotongroyong.fund' target='_blank' style='mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;color: #2BAADF;font-weight: normal;text-decoration: underline;'><img src='https://gallery.mailchimp.com/ed13f18d9c1789c1c3ade430c/images/082b47dc-50a4-441c-9359-8a043a33d5bc.png' style='width: 244px;height: 45px;margin: 0px;border: 0;outline: none;text-decoration: none;-ms-interpolation-mode: bicubic;' align='none' height='45' width='244'></a></div>

                        </td>
                    </tr>
                </tbody></table>
                
            </td>
        </tr>
    </tbody>
</table><table class='mcnImageBlock' style='min-width: 100%;border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;' border='0' cellpadding='0' cellspacing='0' width='100%'>
    <tbody class='mcnImageBlockOuter'>
            <tr>
                <td style='padding: 0px;mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;' class='mcnImageBlockInner' valign='top'>
                    <table class='mcnImageContentContainer' style='min-width: 100%;border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;' align='left' border='0' cellpadding='0' cellspacing='0' width='100%'>
                        <tbody><tr>
                            <td class='mcnImageContent' style='padding-right: 0px;padding-left: 0px;padding-top: 0;padding-bottom: 0;text-align: center;mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;' valign='top'>
                                
                                    <a href='https://www.youtube.com/watch?v=RDR02AzqUBA&autoplay=1' title='' class='' target='_blank' style='mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;'>
                                        <img alt='' src='https://gallery.mailchimp.com/d368955e51966a52a292946aa/images/c5334885-fb78-4d8a-8aa4-9033dca6eb7e.png' style='max-width: 800px;padding-bottom: 0;display: inline !important;vertical-align: bottom;border: 0;height: auto;outline: none;text-decoration: none;-ms-interpolation-mode: bicubic;' class='mcnImage' align='middle' width='600'>
                                    </a>
                                <p><u>Project Notification</u></p>

                            </td>
                        </tr>
                    </tbody></table>
                    <div style='font-size:14px'>
                        <p>One of the owners of our project, <b>$project_title</b> write a message to you:</p>
                        <p style='padding-left:3em'><u>$first_name $last_name</u></p>
                        <p style='padding-left:3em'>$message</p>
                        <p style='padding-left:3em'>$date</p>
                        <p>&nbsp;</p>
                        <p>To reply you can <a href='http://www.gotongroyong.fund'>login</a> to our website, choose account, scrool down, in Backed Project, click 'Message'</p>
                    </div>
                </td>
            </tr>
    </tbody>
</table></td>
                            </tr>
                            
                            <tr>
                                <td valign='top' id='templateFooter' style='mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;background-color: #f0594d;border-top: 0;border-bottom: 0;padding-top: 9px;padding-bottom: 9px;'><table class='mcnFollowBlock' style='min-width: 100%;border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;' border='0' cellpadding='0' cellspacing='0' width='100%'>
    <tbody class='mcnFollowBlockOuter'>
        <tr>
            <td style='padding: 9px;mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;' class='mcnFollowBlockInner' align='center' valign='top'>
                <table class='mcnFollowContentContainer' style='min-width: 100%;border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;' border='0' cellpadding='0' cellspacing='0' width='100%'>
    <tbody><tr>
        <td style='padding-left: 9px;padding-right: 9px;mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;' align='center'>
            <table style='min-width: 100%;border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;' class='mcnFollowContent' border='0' cellpadding='0' cellspacing='0' width='100%'>
                <tbody><tr>
                    <td style='padding-top: 9px;padding-right: 9px;padding-left: 9px;mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;' align='center' valign='top'>
                        <table align='center' border='0' cellpadding='0' cellspacing='0' style='border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;'>
                            <tbody><tr>
                                <td align='center' valign='top' style='mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;'>
                                    <!--[if mso]>
                                    <table align='center' border='0' cellspacing='0' cellpadding='0'>
                                    <tr>
                                    <![endif]-->
                                    
                                        <!--[if mso]>
                                        <td align='center' valign='top'>
                                        <![endif]-->
                                        
                                        
                                            <table style='display: inline;border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;' align='left' border='0' cellpadding='0' cellspacing='0'>
                                                <tbody><tr>
                                                    <td style='padding-right: 10px;padding-bottom: 9px;mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;' class='mcnFollowContentItemContainer' valign='top'>
                                                        <table class='mcnFollowContentItem' border='0' cellpadding='0' cellspacing='0' width='100%' style='border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;'>
                                                            <tbody><tr>
                                                                <td style='padding-top: 5px;padding-right: 10px;padding-bottom: 5px;padding-left: 9px;mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;' align='left' valign='middle'>
                                                                    <table align='left' border='0' cellpadding='0' cellspacing='0' width='' style='border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;'>
                                                                        <tbody><tr>
                                                                            
                                                                                <td class='mcnFollowIconContent' align='center' valign='middle' width='24' style='mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;'>
                                                                                    <a href='https://www.facebook.com/gotongroyongfund' target='_blank' style='mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;'><img src='http://cdn-images.mailchimp.com/icons/social-block-v2/light-facebook-48.png' style='display: block;border: 0;height: auto;outline: none;text-decoration: none;-ms-interpolation-mode: bicubic;' class='' height='24' width='24'></a>
                                                                                </td>
                                                                            
                                                                            
                                                                        </tr>
                                                                    </tbody></table>
                                                                </td>
                                                            </tr>
                                                        </tbody></table>
                                                    </td>
                                                </tr>
                                            </tbody></table>
                                        
                                        <!--[if mso]>
                                        </td>
                                        <![endif]-->
                                    
                                        <!--[if mso]>
                                        <td align='center' valign='top'>
                                        <![endif]-->
                                        
                                        
                                            <table style='display: inline;border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;' align='left' border='0' cellpadding='0' cellspacing='0'>
                                                <tbody><tr>
                                                    <td style='padding-right: 10px;padding-bottom: 9px;mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;' class='mcnFollowContentItemContainer' valign='top'>
                                                        <table class='mcnFollowContentItem' border='0' cellpadding='0' cellspacing='0' width='100%' style='border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;'>
                                                            <tbody><tr>
                                                                <td style='padding-top: 5px;padding-right: 10px;padding-bottom: 5px;padding-left: 9px;mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;' align='left' valign='middle'>
                                                                    <table align='left' border='0' cellpadding='0' cellspacing='0' width='' style='border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;'>
                                                                        <tbody><tr>
                                                                            
                                                                                <td class='mcnFollowIconContent' align='center' valign='middle' width='24' style='mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;'>
                                                                                    <a href='http://twitter.com/GRFund' target='_blank' style='mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;'><img src='http://cdn-images.mailchimp.com/icons/social-block-v2/light-twitter-48.png' style='display: block;border: 0;height: auto;outline: none;text-decoration: none;-ms-interpolation-mode: bicubic;' class='' height='24' width='24'></a>
                                                                                </td>
                                                                            
                                                                            
                                                                        </tr>
                                                                    </tbody></table>
                                                                </td>
                                                            </tr>
                                                        </tbody></table>
                                                    </td>
                                                </tr>
                                            </tbody></table>
                                        
                                        <!--[if mso]>
                                        </td>
                                        <![endif]-->
                                    
                                        <!--[if mso]>
                                        <td align='center' valign='top'>
                                        <![endif]-->
                                        
                                        
                                            <table style='display: inline;border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;' align='left' border='0' cellpadding='0' cellspacing='0'>
                                                <tbody><tr>
                                                    <td style='padding-right: 10px;padding-bottom: 9px;mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;' class='mcnFollowContentItemContainer' valign='top'>
                                                        <table class='mcnFollowContentItem' border='0' cellpadding='0' cellspacing='0' width='100%' style='border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;'>
                                                            <tbody><tr>
                                                                <td style='padding-top: 5px;padding-right: 10px;padding-bottom: 5px;padding-left: 9px;mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;' align='left' valign='middle'>
                                                                    <table align='left' border='0' cellpadding='0' cellspacing='0' width='' style='border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;'>
                                                                        <tbody><tr>
                                                                            
                                                                                <td class='mcnFollowIconContent' align='center' valign='middle' width='24' style='mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;'>
                                                                                    <a href='https://plus.google.com/108338590412015686244' target='_blank' style='mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;'><img src='http://cdn-images.mailchimp.com/icons/social-block-v2/light-googleplus-48.png' style='display: block;border: 0;height: auto;outline: none;text-decoration: none;-ms-interpolation-mode: bicubic;' class='' height='24' width='24'></a>
                                                                                </td>
                                                                            
                                                                            
                                                                        </tr>
                                                                    </tbody></table>
                                                                </td>
                                                            </tr>
                                                        </tbody></table>
                                                    </td>
                                                </tr>
                                            </tbody></table>
                                        
                                        <!--[if mso]>
                                        </td>
                                        <![endif]-->
                                    
                                        <!--[if mso]>
                                        <td align='center' valign='top'>
                                        <![endif]-->
                                        
                                        
                                            <table style='display: inline;border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;' align='left' border='0' cellpadding='0' cellspacing='0'>
                                                <tbody><tr>
                                                    <td style='padding-right: 10px;padding-bottom: 9px;mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;' class='mcnFollowContentItemContainer' valign='top'>
                                                        <table class='mcnFollowContentItem' border='0' cellpadding='0' cellspacing='0' width='100%' style='border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;'>
                                                            <tbody><tr>
                                                                <td style='padding-top: 5px;padding-right: 10px;padding-bottom: 5px;padding-left: 9px;mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;' align='left' valign='middle'>
                                                                    <table align='left' border='0' cellpadding='0' cellspacing='0' width='' style='border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;'>
                                                                        <tbody><tr>
                                                                            
                                                                                <td class='mcnFollowIconContent' align='center' valign='middle' width='24' style='mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;'>
                                                                                    <a href='https://www.youtube.com/channel/UCtjiTvU4D8cSSZYnQBGZlhA' target='_blank' style='mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;'><img src='http://cdn-images.mailchimp.com/icons/social-block-v2/light-youtube-48.png' style='display: block;border: 0;height: auto;outline: none;text-decoration: none;-ms-interpolation-mode: bicubic;' class='' height='24' width='24'></a>
                                                                                </td>
                                                                            
                                                                            
                                                                        </tr>
                                                                    </tbody></table>
                                                                </td>
                                                            </tr>
                                                        </tbody></table>
                                                    </td>
                                                </tr>
                                            </tbody></table>
                                        
                                        <!--[if mso]>
                                        </td>
                                        <![endif]-->
                                    
                                        <!--[if mso]>
                                        <td align='center' valign='top'>
                                        <![endif]-->
                                        
                                        
                                            <table style='display: inline;border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;' align='left' border='0' cellpadding='0' cellspacing='0'>
                                                <tbody><tr>
                                                    <td style='padding-right: 0;padding-bottom: 9px;mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;' class='mcnFollowContentItemContainer' valign='top'>
                                                        <table class='mcnFollowContentItem' border='0' cellpadding='0' cellspacing='0' width='100%' style='border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;'>
                                                            <tbody><tr>
                                                                <td style='padding-top: 5px;padding-right: 10px;padding-bottom: 5px;padding-left: 9px;mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;' align='left' valign='middle'>
                                                                    <table align='left' border='0' cellpadding='0' cellspacing='0' width='' style='border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;'>
                                                                        <tbody><tr>
                                                                            
                                                                                <td class='mcnFollowIconContent' align='center' valign='middle' width='24' style='mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;'>
                                                                                    <a href='https://www.linkedin.com/company/gotong-royong-fund' target='_blank' style='mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;'><img src='http://cdn-images.mailchimp.com/icons/social-block-v2/light-linkedin-48.png' style='display: block;border: 0;height: auto;outline: none;text-decoration: none;-ms-interpolation-mode: bicubic;' class='' height='24' width='24'></a>
                                                                                </td>
                                                                            
                                                                            
                                                                        </tr>
                                                                    </tbody></table>
                                                                </td>
                                                            </tr>
                                                        </tbody></table>
                                                    </td>
                                                </tr>
                                            </tbody></table>
                                        
                                        <!--[if mso]>
                                        </td>
                                        <![endif]-->
                                    
                                    <!--[if mso]>
                                    </tr>
                                    </table>
                                    <![endif]-->
                                </td>
                            </tr>
                        </tbody></table>
                    </td>
                </tr>
            </tbody></table>
        </td>
    </tr>
</tbody></table>

            </td>
        </tr>
    </tbody>
</table><table class='mcnTextBlock' style='min-width: 100%;border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;' border='0' cellpadding='0' cellspacing='0' width='100%'>
    <tbody class='mcnTextBlockOuter'>
        <tr>
            <td class='mcnTextBlockInner' valign='top' style='mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;'>
                
                <table style='min-width: 100%;border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;' class='mcnTextContentContainer' align='left' border='0' cellpadding='0' cellspacing='0' width='100%'>
                    <tbody><tr>
                        
                        <td class='mcnTextContent' style='padding-top: 9px;padding-right: 18px;padding-bottom: 9px;padding-left: 18px;mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;word-break: break-word;color: #ffffff;font-family: Helvetica;font-size: 12px;line-height: 150%;text-align: center;' valign='top'>
                        
                            <span style='font-size:14px'><em>Copyright 2015 Gotong Royong Fund All Rights Reserved</em></span><br>
<br>

                        </td>
                    </tr>
                </tbody></table>
                
            </td>
        </tr>
    </tbody>
</table></td>
                            </tr>
                        </table>
                        <!--[if gte mso 9]>
                        </td>
                        </tr>
                        </table>
                        <![endif]-->
                        <!-- // END TEMPLATE -->
                    </td>
                </tr>
            </table>
        </center>
                <center>
                
                
                
            </center></body>
</html>
        ";

        // Always set content-type when sending HTML email
        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

        // More headers
        $headers .= 'From: support@gotongroyong.fund' . "\r\n";
        

        mail($to,$subject,$message,$headers);        
//-------------------------------------------------------------------------//

        $query = "SELECT project_alias FROM project WHERE project_id = '".Input::get("project_id")."'";
            $rs = DB::select($query);
            
            if(!$rs)
                return Redirect::to("account");
            else            
                return Redirect::to("show-project/".$rs[0]->project_alias."?t=2")->with('message', 'Add Message Success');
        }

        public function postAddMessagesUser(){                                   
            date_default_timezone_set("Asia/Jakarta");
            $message= Input::get("message_body");
            $from_user_id = Auth::id();
            $to_user_id = Input::get("user_id");
            $project_id = Input::get("project_id");            
            $email= Input::get("email");
            $date =date('Y-m-d H:i:s');

            $dataProject = array(
                //'owner_id'=>$owner_id,
                'project_id'=>$project_id,                
                'from_user_id'=>$from_user_id,
                'to_user_id'=>$to_user_id,
                'email'=>$email,                
                'message'=>$message,                
                'date' =>$date            
            );
        $id = DB::table('tb_comment')->insertGetId(
                $dataProject
            );
        $query= "SELECT first_name, last_name from tb_users where id= $from_user_id";
        $rs = DB::select($query);
        
        $first_name = $rs[0]->first_name;
        $last_name = $rs[0]->last_name;

        $query2= "SELECT title from project where project_id = $project_id";
        $rs2 = DB::select($query2);

        $project_title= $rs2[0]->title;

        //-------------------------Email---------------------
        $query = "SELECT tb_users.email 
                  from tb_users
                  LEFT JOIN project
                  ON project.author = tb_users.id
                  where project_id=$project_id";
        $rs = DB::select($query);
        $to= $rs[0]->email;       

        //$to = $email;
        $subject = "Gotongroyong.fund notification message";
        //$message = "file_get_contents('http://localhost/Dropbox/grfund1/emailMessageNotif');";
        
        $message = "
        <html xmlns='http://www.w3.org/1999/xhtml' xmlns:v='urn:schemas-microsoft-com:vml' xmlns:o='urn:schemas-microsoft-com:office:office'>
<head>
<meta charset='UTF-8'>
<meta http-equiv='X-UA-Compatible' content='IE=edge'>
<meta name='viewport' content='width=device-width, initial-scale=1'>
<title>Project Notification</title>
</head>
<body style='height: 100%;margin: 0;padding: 0;width: 100%;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;background-color: white;'>
<center>
<table align='center' border='0' cellpadding='0' cellspacing='0' height='100%' width='100%' id='bodyTable' style='border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;height: 100%;margin: 0;padding: 0;width: 100%;background-color: #596c78;'>
<tr>
<td align='center' valign='top' id='bodyCell' style='mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;height: 100%;margin: 0;padding: 10px;width: 100%;border-top: 0;'>
<table border='0' cellpadding='0' cellspacing='0' width='100%' class='templateContainer' style='border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;border: 0;max-width: 600px !important;'>
<tr>
<td valign='top' id='templatePreheader' style='mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;background-color: #f0594d;border-top: 0;border-bottom: 0;padding-top: 9px;padding-bottom: 9px;'><table class='mcnTextBlock' style='min-width: 100%;border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;' border='0' cellpadding='0' cellspacing='0' width='100%'>
<tbody class='mcnTextBlockOuter'>
<tr>
<td class='mcnTextBlockInner' valign='top' style='mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;'>
<table style='min-width: 100%;border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;' class='mcnTextContentContainer' align='left' border='0' cellpadding='0' cellspacing='0' width='100%'>
<tbody><tr>
<td class='mcnTextContent' style='padding-top: 9px;padding-right: 18px;padding-bottom: 9px;padding-left: 18px;mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;word-break: break-word;color: #ffffff;font-family: Helvetica;font-size: 12px;line-height: 150%;text-align: left;' valign='top'>
                        
                            

                        </td>
                    </tr>
                </tbody></table>
                
            </td>
        </tr>
    </tbody>
</table></td>
                            </tr>
                            <tr>
                                <td valign='top' id='templateHeader' style='mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;background-color: #FFFFFF;border-top: 0;border-bottom: 0;padding-top: 0px;padding-bottom: 8px;'><table class='mcnTextBlock' style='min-width: 100%;border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;' border='0' cellpadding='0' cellspacing='0' width='100%'>
    <tbody class='mcnTextBlockOuter'>
        <tr>
            <td class='mcnTextBlockInner' valign='top' style='mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;'>
                
                <table style='min-width: 100%;border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;' class='mcnTextContentContainer' align='left' border='0' cellpadding='0' cellspacing='0' width='100%'>
                    <tbody><tr>
                        
                        <td class='mcnTextContent' style='padding-top: 9px;padding-right: 18px;padding-bottom: 9px;padding-left: 18px;mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;word-break: break-word;color: #202020;font-family: Helvetica;font-size: 16px;line-height: 150%;text-align: left;' valign='top'>
                        
                            <div style='text-align: center;'><a href='http://gotongroyong.fund' target='_blank' style='mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;color: #2BAADF;font-weight: normal;text-decoration: underline;'><img src='https://gallery.mailchimp.com/ed13f18d9c1789c1c3ade430c/images/082b47dc-50a4-441c-9359-8a043a33d5bc.png' style='width: 244px;height: 45px;margin: 0px;border: 0;outline: none;text-decoration: none;-ms-interpolation-mode: bicubic;' align='none' height='45' width='244'></a></div>

                        </td>
                    </tr>
                </tbody></table>
                
            </td>
        </tr>
    </tbody>
</table><table class='mcnImageBlock' style='min-width: 100%;border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;' border='0' cellpadding='0' cellspacing='0' width='100%'>
    <tbody class='mcnImageBlockOuter'>
            <tr>
                <td style='padding: 0px;mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;' class='mcnImageBlockInner' valign='top'>
                    <table class='mcnImageContentContainer' style='min-width: 100%;border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;' align='left' border='0' cellpadding='0' cellspacing='0' width='100%'>
                        <tbody><tr>
                            <td class='mcnImageContent' style='padding-right: 0px;padding-left: 0px;padding-top: 0;padding-bottom: 0;text-align: center;mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;' valign='top'>
                                
                                    <a href='https://www.youtube.com/watch?v=RDR02AzqUBA&autoplay=1' title='' class='' target='_blank' style='mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;'>
                                        <img alt='' src='https://gallery.mailchimp.com/d368955e51966a52a292946aa/images/c5334885-fb78-4d8a-8aa4-9033dca6eb7e.png' style='max-width: 800px;padding-bottom: 0;display: inline !important;vertical-align: bottom;border: 0;height: auto;outline: none;text-decoration: none;-ms-interpolation-mode: bicubic;' class='mcnImage' align='middle' width='600'>
                                    </a>
                                <p><u>Project Notification</u></p>

                            </td>
                        </tr>
                    </tbody></table>
                    <div style='font-size:14px'>
                        <p>One of backer of your project, <b>$project_title</b> write a message to you:</p>
                        <p style='padding-left:3em'><u>$first_name $last_name</u></p>
                        <p style='padding-left:3em'>$message</p>
                        <p style='padding-left:3em'>$date</p>
                        <p>&nbsp;</p>
                        <p>To reply you can <a href='http://www.gotongroyong.fund'>login</a> to our website, browse your project, select backer tab, click 'Message'</p>
                    </div>
                </td>
            </tr>
    </tbody>
</table></td>
                            </tr>
                            
                            <tr>
                                <td valign='top' id='templateFooter' style='mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;background-color: #f0594d;border-top: 0;border-bottom: 0;padding-top: 9px;padding-bottom: 9px;'><table class='mcnFollowBlock' style='min-width: 100%;border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;' border='0' cellpadding='0' cellspacing='0' width='100%'>
    <tbody class='mcnFollowBlockOuter'>
        <tr>
            <td style='padding: 9px;mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;' class='mcnFollowBlockInner' align='center' valign='top'>
                <table class='mcnFollowContentContainer' style='min-width: 100%;border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;' border='0' cellpadding='0' cellspacing='0' width='100%'>
    <tbody><tr>
        <td style='padding-left: 9px;padding-right: 9px;mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;' align='center'>
            <table style='min-width: 100%;border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;' class='mcnFollowContent' border='0' cellpadding='0' cellspacing='0' width='100%'>
                <tbody><tr>
                    <td style='padding-top: 9px;padding-right: 9px;padding-left: 9px;mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;' align='center' valign='top'>
                        <table align='center' border='0' cellpadding='0' cellspacing='0' style='border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;'>
                            <tbody><tr>
                                <td align='center' valign='top' style='mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;'>
                                    <!--[if mso]>
                                    <table align='center' border='0' cellspacing='0' cellpadding='0'>
                                    <tr>
                                    <![endif]-->
                                    
                                        <!--[if mso]>
                                        <td align='center' valign='top'>
                                        <![endif]-->
                                        
                                        
                                            <table style='display: inline;border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;' align='left' border='0' cellpadding='0' cellspacing='0'>
                                                <tbody><tr>
                                                    <td style='padding-right: 10px;padding-bottom: 9px;mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;' class='mcnFollowContentItemContainer' valign='top'>
                                                        <table class='mcnFollowContentItem' border='0' cellpadding='0' cellspacing='0' width='100%' style='border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;'>
                                                            <tbody><tr>
                                                                <td style='padding-top: 5px;padding-right: 10px;padding-bottom: 5px;padding-left: 9px;mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;' align='left' valign='middle'>
                                                                    <table align='left' border='0' cellpadding='0' cellspacing='0' width='' style='border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;'>
                                                                        <tbody><tr>
                                                                            
                                                                                <td class='mcnFollowIconContent' align='center' valign='middle' width='24' style='mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;'>
                                                                                    <a href='https://www.facebook.com/gotongroyongfund' target='_blank' style='mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;'><img src='http://cdn-images.mailchimp.com/icons/social-block-v2/light-facebook-48.png' style='display: block;border: 0;height: auto;outline: none;text-decoration: none;-ms-interpolation-mode: bicubic;' class='' height='24' width='24'></a>
                                                                                </td>
                                                                            
                                                                            
                                                                        </tr>
                                                                    </tbody></table>
                                                                </td>
                                                            </tr>
                                                        </tbody></table>
                                                    </td>
                                                </tr>
                                            </tbody></table>
                                        
                                        <!--[if mso]>
                                        </td>
                                        <![endif]-->
                                    
                                        <!--[if mso]>
                                        <td align='center' valign='top'>
                                        <![endif]-->
                                        
                                        
                                            <table style='display: inline;border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;' align='left' border='0' cellpadding='0' cellspacing='0'>
                                                <tbody><tr>
                                                    <td style='padding-right: 10px;padding-bottom: 9px;mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;' class='mcnFollowContentItemContainer' valign='top'>
                                                        <table class='mcnFollowContentItem' border='0' cellpadding='0' cellspacing='0' width='100%' style='border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;'>
                                                            <tbody><tr>
                                                                <td style='padding-top: 5px;padding-right: 10px;padding-bottom: 5px;padding-left: 9px;mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;' align='left' valign='middle'>
                                                                    <table align='left' border='0' cellpadding='0' cellspacing='0' width='' style='border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;'>
                                                                        <tbody><tr>
                                                                            
                                                                                <td class='mcnFollowIconContent' align='center' valign='middle' width='24' style='mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;'>
                                                                                    <a href='http://twitter.com/GRFund' target='_blank' style='mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;'><img src='http://cdn-images.mailchimp.com/icons/social-block-v2/light-twitter-48.png' style='display: block;border: 0;height: auto;outline: none;text-decoration: none;-ms-interpolation-mode: bicubic;' class='' height='24' width='24'></a>
                                                                                </td>
                                                                            
                                                                            
                                                                        </tr>
                                                                    </tbody></table>
                                                                </td>
                                                            </tr>
                                                        </tbody></table>
                                                    </td>
                                                </tr>
                                            </tbody></table>
                                        
                                        <!--[if mso]>
                                        </td>
                                        <![endif]-->
                                    
                                        <!--[if mso]>
                                        <td align='center' valign='top'>
                                        <![endif]-->
                                        
                                        
                                            <table style='display: inline;border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;' align='left' border='0' cellpadding='0' cellspacing='0'>
                                                <tbody><tr>
                                                    <td style='padding-right: 10px;padding-bottom: 9px;mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;' class='mcnFollowContentItemContainer' valign='top'>
                                                        <table class='mcnFollowContentItem' border='0' cellpadding='0' cellspacing='0' width='100%' style='border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;'>
                                                            <tbody><tr>
                                                                <td style='padding-top: 5px;padding-right: 10px;padding-bottom: 5px;padding-left: 9px;mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;' align='left' valign='middle'>
                                                                    <table align='left' border='0' cellpadding='0' cellspacing='0' width='' style='border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;'>
                                                                        <tbody><tr>
                                                                            
                                                                                <td class='mcnFollowIconContent' align='center' valign='middle' width='24' style='mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;'>
                                                                                    <a href='https://plus.google.com/108338590412015686244' target='_blank' style='mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;'><img src='http://cdn-images.mailchimp.com/icons/social-block-v2/light-googleplus-48.png' style='display: block;border: 0;height: auto;outline: none;text-decoration: none;-ms-interpolation-mode: bicubic;' class='' height='24' width='24'></a>
                                                                                </td>
                                                                            
                                                                            
                                                                        </tr>
                                                                    </tbody></table>
                                                                </td>
                                                            </tr>
                                                        </tbody></table>
                                                    </td>
                                                </tr>
                                            </tbody></table>
                                        
                                        <!--[if mso]>
                                        </td>
                                        <![endif]-->
                                    
                                        <!--[if mso]>
                                        <td align='center' valign='top'>
                                        <![endif]-->
                                        
                                        
                                            <table style='display: inline;border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;' align='left' border='0' cellpadding='0' cellspacing='0'>
                                                <tbody><tr>
                                                    <td style='padding-right: 10px;padding-bottom: 9px;mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;' class='mcnFollowContentItemContainer' valign='top'>
                                                        <table class='mcnFollowContentItem' border='0' cellpadding='0' cellspacing='0' width='100%' style='border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;'>
                                                            <tbody><tr>
                                                                <td style='padding-top: 5px;padding-right: 10px;padding-bottom: 5px;padding-left: 9px;mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;' align='left' valign='middle'>
                                                                    <table align='left' border='0' cellpadding='0' cellspacing='0' width='' style='border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;'>
                                                                        <tbody><tr>
                                                                            
                                                                                <td class='mcnFollowIconContent' align='center' valign='middle' width='24' style='mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;'>
                                                                                    <a href='https://www.youtube.com/channel/UCtjiTvU4D8cSSZYnQBGZlhA' target='_blank' style='mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;'><img src='http://cdn-images.mailchimp.com/icons/social-block-v2/light-youtube-48.png' style='display: block;border: 0;height: auto;outline: none;text-decoration: none;-ms-interpolation-mode: bicubic;' class='' height='24' width='24'></a>
                                                                                </td>
                                                                            
                                                                            
                                                                        </tr>
                                                                    </tbody></table>
                                                                </td>
                                                            </tr>
                                                        </tbody></table>
                                                    </td>
                                                </tr>
                                            </tbody></table>
                                        
                                        <!--[if mso]>
                                        </td>
                                        <![endif]-->
                                    
                                        <!--[if mso]>
                                        <td align='center' valign='top'>
                                        <![endif]-->
                                        
                                        
                                            <table style='display: inline;border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;' align='left' border='0' cellpadding='0' cellspacing='0'>
                                                <tbody><tr>
                                                    <td style='padding-right: 0;padding-bottom: 9px;mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;' class='mcnFollowContentItemContainer' valign='top'>
                                                        <table class='mcnFollowContentItem' border='0' cellpadding='0' cellspacing='0' width='100%' style='border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;'>
                                                            <tbody><tr>
                                                                <td style='padding-top: 5px;padding-right: 10px;padding-bottom: 5px;padding-left: 9px;mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;' align='left' valign='middle'>
                                                                    <table align='left' border='0' cellpadding='0' cellspacing='0' width='' style='border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;'>
                                                                        <tbody><tr>
                                                                            
                                                                                <td class='mcnFollowIconContent' align='center' valign='middle' width='24' style='mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;'>
                                                                                    <a href='https://www.linkedin.com/company/gotong-royong-fund' target='_blank' style='mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;'><img src='http://cdn-images.mailchimp.com/icons/social-block-v2/light-linkedin-48.png' style='display: block;border: 0;height: auto;outline: none;text-decoration: none;-ms-interpolation-mode: bicubic;' class='' height='24' width='24'></a>
                                                                                </td>
                                                                            
                                                                            
                                                                        </tr>
                                                                    </tbody></table>
                                                                </td>
                                                            </tr>
                                                        </tbody></table>
                                                    </td>
                                                </tr>
                                            </tbody></table>
                                        
                                        <!--[if mso]>
                                        </td>
                                        <![endif]-->
                                    
                                    <!--[if mso]>
                                    </tr>
                                    </table>
                                    <![endif]-->
                                </td>
                            </tr>
                        </tbody></table>
                    </td>
                </tr>
            </tbody></table>
        </td>
    </tr>
</tbody></table>

            </td>
        </tr>
    </tbody>
</table><table class='mcnTextBlock' style='min-width: 100%;border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;' border='0' cellpadding='0' cellspacing='0' width='100%'>
    <tbody class='mcnTextBlockOuter'>
        <tr>
            <td class='mcnTextBlockInner' valign='top' style='mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;'>
                
                <table style='min-width: 100%;border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;' class='mcnTextContentContainer' align='left' border='0' cellpadding='0' cellspacing='0' width='100%'>
                    <tbody><tr>
                        
                        <td class='mcnTextContent' style='padding-top: 9px;padding-right: 18px;padding-bottom: 9px;padding-left: 18px;mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;word-break: break-word;color: #ffffff;font-family: Helvetica;font-size: 12px;line-height: 150%;text-align: center;' valign='top'>
                        
                            <span style='font-size:14px'><em>Copyright 2015 Gotong Royong Fund All Rights Reserved</em></span><br>
<br>

                        </td>
                    </tr>
                </tbody></table>
                
            </td>
        </tr>
    </tbody>
</table></td>
                            </tr>
                        </table>
                        <!--[if gte mso 9]>
                        </td>
                        </tr>
                        </table>
                        <![endif]-->
                        <!-- // END TEMPLATE -->
                    </td>
                </tr>
            </table>
        </center>
                <center>
                
                
                
            </center></body>
</html>
        ";

        // Always set content-type when sending HTML email
        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

        // More headers
        $headers .= 'From: support@gotongroyong.fund' . "\r\n";
        

        mail($to,$subject,$message,$headers);
//-------------------------------------------------------------------------//

        $query = "SELECT project_alias FROM project WHERE project_id = '".Input::get("project_id")."'";
            $rs = DB::select($query);
            
            if(!$rs)
                return Redirect::to("account");
            else            
                //return Redirect::to("show-project/".$rs[0]->project_alias."?t=2")->with('message', 'Add Message Success');
                return Redirect::to("account")->with('message', 'Add Message Success');
        }

        public function postViewMessages(){  
            $project_id = Input::get("project_id");
            $user_id = Input::get("user_id");

            //$query = "SELECT message from tb_comment where project_id=$project_id AND user_id=$user_id";
            //$rs = DB::select($query);
            //$this->data['view_msg'] = (object)$rs;
            return Redirect::to('show-project/'.$rs[0]->project_alias.'?step=2');
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
	date_default_timezone_set("Asia/Jakarta");
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
        public function postSubmitpledge($pm=null){
            date_default_timezone_set("Asia/Jakarta");            
                /*if($reward_count==0)
                {
                    $name = "-"
                }
                else
                {
                   $name = Input::get('name'); 
                }*/

            /*
            $name = Input::get('name');            
            $email = Input::get('email');
            $phone = Input::get('phone');            
            $amount = str_replace(array("Rp ","_","."), "", Input::get('amount'));            
            $reward_count = Input::get('reward_count');
            $comment = Input::get('comment');
            */
            //$reward_id;
            $name =Session::get('name_pay');
            $email =Session::get('email_pay');
            $phone =Session::get('phone_pay');
            $amount =Session::get('amount');
            $reward_count =Session::get('reward_count');                       
            $comment =Session::get('comment_pay');

            $fund_choice = Session::get('fund_choice');
            if(Session::get('project_alternate')!= NULL || Session::get('project_alternate')!= '')
            {
                $project_alternate = Session::get('project_alternate');           
            }
            else
            {
                $project_alternate = 0;              
            }
            
            //kalau project nya tidak ada reward
            if($reward_count == "")
            {
                $reward = 0;   
            }
            else
            {
               //$reward = Input::get('reward');
                if( Session::get('reward_id') == "" )
                {
                    $reward = 0;
                }
                else
                {
                   $reward = Session::get('reward_id');  
                }
                 
            }

            /*if($reward_count == "")
            {
                $reward = 0;
            }
            else
            {
               //$reward = Input::get('reward');
               $reward = Session::get('reward_id'); 
            }*/      
            ///////////////////////////////////////

            //$pm = Input::get('pm');
            $pid = Session::get('pid');           

            $user = Auth::id() == '' ? 0 : Auth::id();                         
            if($name==NULL || $email==NULL || $phone==NULL|| $amount==NULL ||$pid==NULL)
            {
               return Redirect::to('projects');
            }           
            $backer = array(
                'project_id'=>$pid,
                'project_id_alt'=>$project_alternate,
                'reward_id'=>$reward,
                'backer_amount'=>$amount,
                'user_id'=>$user,
                'name'=>$name,
                'backer_date'=>date('Y-m-d H:i:s'),
                'email'=>$email,
                'phone'=>$phone,
                'comment'=>$comment,
                'choice'=>$fund_choice,
                'status'=>0,
            ); 
            //SET @session.time_zone='+07:00';
            $backer_id = DB::table('backer')->insertGetId($backer);
            $invoice = date('ym'.+$backer_id);
            
            $payment = array(
                'backer_id' =>$backer_id,
                'payment_method'=>$pm,
                'amount'=>$amount,
                'invoice'=>$invoice
            );
            $payment_id = DB::table('backer_payment')->insertGetId($payment);           

            Session::forget('pid');
            Session::forget('amount');
            Session::forget('reward_count');
            Session::forget('reward_id');
            Session::forget('name_pay');
            Session::forget('email_pay');
            Session::forget('phone_pay');
            Session::forget('comment_pay');
            Session::forget('fund_choice');
            Session::forget('project_alternate');

            $rsProject = DB::table('project')->where('project_id', $pid)->first();            
            $rsReward = DB::table('reward')->where('reward_id',$reward)->first();
                if($reward_count == "" || $reward == 0)
                {
                    $reward_title = "-";   
                }
                else
                {
                   $reward_title = $rsReward->reward_title; 
                }
                                
            /*if($rsReward->reward_title == "")
            {
                $rsReward->reward_title == "-";
            }*/

            
            if($pm == "veritrans"){
                    Veritrans_Config::$isProduction = true;
                    Veritrans_Config::$serverKey = 'VT-server-ZJqkcuil1Mee47mCBXpD9CQo';
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
                        'name' => $reward_title,                        
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
                //disini transfer
                $to = $email;
                $subject = "Gotongroyong.fund notification payment";
                $query = "SELECT title from project where project_id = $pid";
                $rs = DB::select($query);
                $p_title= $rs[0]->title;
                $message = "
        <html xmlns='http://www.w3.org/1999/xhtml' xmlns:v='urn:schemas-microsoft-com:vml' xmlns:o='urn:schemas-microsoft-com:office:office'>
<head>
<meta charset='UTF-8'>
<meta http-equiv='X-UA-Compatible' content='IE=edge'>
<meta name='viewport' content='width=device-width, initial-scale=1'>
<title>Project Notification</title>
</head>
<body style='height: 100%;margin: 0;padding: 0;width: 100%;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;background-color: white;'>
<center>
<table align='center' border='0' cellpadding='0' cellspacing='0' height='100%' width='100%' id='bodyTable' style='border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;height: 100%;margin: 0;padding: 0;width: 100%;background-color: #596c78;'>
<tr>
<td align='center' valign='top' id='bodyCell' style='mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;height: 100%;margin: 0;padding: 10px;width: 100%;border-top: 0;'>
<table border='0' cellpadding='0' cellspacing='0' width='100%' class='templateContainer' style='border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;border: 0;max-width: 600px !important;'>
<tr>
<td valign='top' id='templatePreheader' style='mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;background-color: #f0594d;border-top: 0;border-bottom: 0;padding-top: 9px;padding-bottom: 9px;'><table class='mcnTextBlock' style='min-width: 100%;border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;' border='0' cellpadding='0' cellspacing='0' width='100%'>
<tbody class='mcnTextBlockOuter'>
<tr>
<td class='mcnTextBlockInner' valign='top' style='mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;'>
<table style='min-width: 100%;border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;' class='mcnTextContentContainer' align='left' border='0' cellpadding='0' cellspacing='0' width='100%'>
<tbody><tr>
<td class='mcnTextContent' style='padding-top: 9px;padding-right: 18px;padding-bottom: 9px;padding-left: 18px;mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;word-break: break-word;color: #ffffff;font-family: Helvetica;font-size: 12px;line-height: 150%;text-align: left;' valign='top'>
                        
                            

                        </td>
                    </tr>
                </tbody></table>
                
            </td>
        </tr>
    </tbody>
</table></td>
                            </tr>
                            <tr>
                                <td valign='top' id='templateHeader' style='mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;background-color: #FFFFFF;border-top: 0;border-bottom: 0;padding-top: 0px;padding-bottom: 8px;'><table class='mcnTextBlock' style='min-width: 100%;border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;' border='0' cellpadding='0' cellspacing='0' width='100%'>
    <tbody class='mcnTextBlockOuter'>
        <tr>
            <td class='mcnTextBlockInner' valign='top' style='mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;'>
                
                <table style='min-width: 100%;border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;' class='mcnTextContentContainer' align='left' border='0' cellpadding='0' cellspacing='0' width='100%'>
                    <tbody><tr>
                        
                        <td class='mcnTextContent' style='padding-top: 9px;padding-right: 18px;padding-bottom: 9px;padding-left: 18px;mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;word-break: break-word;color: #202020;font-family: Helvetica;font-size: 16px;line-height: 150%;text-align: left;' valign='top'>
                        
                            <div style='text-align: center;'><a href='http://gotongroyong.fund' target='_blank' style='mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;color: #2BAADF;font-weight: normal;text-decoration: underline;'><img src='https://gallery.mailchimp.com/ed13f18d9c1789c1c3ade430c/images/082b47dc-50a4-441c-9359-8a043a33d5bc.png' style='width: 244px;height: 45px;margin: 0px;border: 0;outline: none;text-decoration: none;-ms-interpolation-mode: bicubic;' align='none' height='45' width='244'></a></div>

                        </td>
                    </tr>
                </tbody></table>
                
            </td>
        </tr>
    </tbody>
</table><table class='mcnImageBlock' style='min-width: 100%;border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;' border='0' cellpadding='0' cellspacing='0' width='100%'>
    <tbody class='mcnImageBlockOuter'>
            <tr>
                <td style='padding: 0px;mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;' class='mcnImageBlockInner' valign='top'>
                    <table class='mcnImageContentContainer' style='min-width: 100%;border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;' align='left' border='0' cellpadding='0' cellspacing='0' width='100%'>
                        <tbody><tr>
                            <td class='mcnImageContent' style='padding-right: 0px;padding-left: 0px;padding-top: 0;padding-bottom: 0;text-align: center;mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;' valign='top'>
                                
                                    <a href='https://www.youtube.com/watch?v=RDR02AzqUBA&autoplay=1' title='' class='' target='_blank' style='mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;'>
                                        <img alt='' src='https://gallery.mailchimp.com/d368955e51966a52a292946aa/images/c5334885-fb78-4d8a-8aa4-9033dca6eb7e.png' style='max-width: 800px;padding-bottom: 0;display: inline !important;vertical-align: bottom;border: 0;height: auto;outline: none;text-decoration: none;-ms-interpolation-mode: bicubic;' class='mcnImage' align='middle' width='600'>
                                    </a>
                                <p><u>Project Notification</u> <br> <br></p>

                            </td>
                        </tr>
                    </tbody></table>
                    <div style='font-size:14px;text-align:center'>
                        
                        <p>Terima kasih telah mendanai project <b>$p_title</b></p>
                        <p>Dana yang anda kirim akan di konfirmasi oleh tim kami kurang dari 24jam</p>
                        <p>Dana yang sudah di konfirmasi akan terdaftar di tab 'Backer' yang ada di projek tersebut</p>
                        <p>Silahkan Konfirmasi ke support@gotongroyong.fund atau hubungi kami di +6221 - 3190 9100</p>
                        <br> <br>
                    </div>
                </td>
            </tr>
    </tbody>
</table></td>
                            </tr>
                            
                            <tr>
                                <td valign='top' id='templateFooter' style='mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;background-color: #f0594d;border-top: 0;border-bottom: 0;padding-top: 9px;padding-bottom: 9px;'><table class='mcnFollowBlock' style='min-width: 100%;border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;' border='0' cellpadding='0' cellspacing='0' width='100%'>
    <tbody class='mcnFollowBlockOuter'>
        <tr>
            <td style='padding: 9px;mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;' class='mcnFollowBlockInner' align='center' valign='top'>
                <table class='mcnFollowContentContainer' style='min-width: 100%;border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;' border='0' cellpadding='0' cellspacing='0' width='100%'>
    <tbody><tr>
        <td style='padding-left: 9px;padding-right: 9px;mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;' align='center'>
            <table style='min-width: 100%;border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;' class='mcnFollowContent' border='0' cellpadding='0' cellspacing='0' width='100%'>
                <tbody><tr>
                    <td style='padding-top: 9px;padding-right: 9px;padding-left: 9px;mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;' align='center' valign='top'>
                        <table align='center' border='0' cellpadding='0' cellspacing='0' style='border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;'>
                            <tbody><tr>
                                <td align='center' valign='top' style='mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;'>
                                    <!--[if mso]>
                                    <table align='center' border='0' cellspacing='0' cellpadding='0'>
                                    <tr>
                                    <![endif]-->
                                    
                                        <!--[if mso]>
                                        <td align='center' valign='top'>
                                        <![endif]-->
                                        
                                        
                                            <table style='display: inline;border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;' align='left' border='0' cellpadding='0' cellspacing='0'>
                                                <tbody><tr>
                                                    <td style='padding-right: 10px;padding-bottom: 9px;mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;' class='mcnFollowContentItemContainer' valign='top'>
                                                        <table class='mcnFollowContentItem' border='0' cellpadding='0' cellspacing='0' width='100%' style='border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;'>
                                                            <tbody><tr>
                                                                <td style='padding-top: 5px;padding-right: 10px;padding-bottom: 5px;padding-left: 9px;mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;' align='left' valign='middle'>
                                                                    <table align='left' border='0' cellpadding='0' cellspacing='0' width='' style='border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;'>
                                                                        <tbody><tr>
                                                                            
                                                                                <td class='mcnFollowIconContent' align='center' valign='middle' width='24' style='mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;'>
                                                                                    <a href='https://www.facebook.com/gotongroyongfund' target='_blank' style='mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;'><img src='http://cdn-images.mailchimp.com/icons/social-block-v2/light-facebook-48.png' style='display: block;border: 0;height: auto;outline: none;text-decoration: none;-ms-interpolation-mode: bicubic;' class='' height='24' width='24'></a>
                                                                                </td>
                                                                            
                                                                            
                                                                        </tr>
                                                                    </tbody></table>
                                                                </td>
                                                            </tr>
                                                        </tbody></table>
                                                    </td>
                                                </tr>
                                            </tbody></table>
                                        
                                        <!--[if mso]>
                                        </td>
                                        <![endif]-->
                                    
                                        <!--[if mso]>
                                        <td align='center' valign='top'>
                                        <![endif]-->
                                        
                                        
                                            <table style='display: inline;border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;' align='left' border='0' cellpadding='0' cellspacing='0'>
                                                <tbody><tr>
                                                    <td style='padding-right: 10px;padding-bottom: 9px;mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;' class='mcnFollowContentItemContainer' valign='top'>
                                                        <table class='mcnFollowContentItem' border='0' cellpadding='0' cellspacing='0' width='100%' style='border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;'>
                                                            <tbody><tr>
                                                                <td style='padding-top: 5px;padding-right: 10px;padding-bottom: 5px;padding-left: 9px;mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;' align='left' valign='middle'>
                                                                    <table align='left' border='0' cellpadding='0' cellspacing='0' width='' style='border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;'>
                                                                        <tbody><tr>
                                                                            
                                                                                <td class='mcnFollowIconContent' align='center' valign='middle' width='24' style='mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;'>
                                                                                    <a href='http://twitter.com/GRFund' target='_blank' style='mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;'><img src='http://cdn-images.mailchimp.com/icons/social-block-v2/light-twitter-48.png' style='display: block;border: 0;height: auto;outline: none;text-decoration: none;-ms-interpolation-mode: bicubic;' class='' height='24' width='24'></a>
                                                                                </td>
                                                                            
                                                                            
                                                                        </tr>
                                                                    </tbody></table>
                                                                </td>
                                                            </tr>
                                                        </tbody></table>
                                                    </td>
                                                </tr>
                                            </tbody></table>
                                        
                                        <!--[if mso]>
                                        </td>
                                        <![endif]-->
                                    
                                        <!--[if mso]>
                                        <td align='center' valign='top'>
                                        <![endif]-->
                                        
                                        
                                            <table style='display: inline;border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;' align='left' border='0' cellpadding='0' cellspacing='0'>
                                                <tbody><tr>
                                                    <td style='padding-right: 10px;padding-bottom: 9px;mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;' class='mcnFollowContentItemContainer' valign='top'>
                                                        <table class='mcnFollowContentItem' border='0' cellpadding='0' cellspacing='0' width='100%' style='border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;'>
                                                            <tbody><tr>
                                                                <td style='padding-top: 5px;padding-right: 10px;padding-bottom: 5px;padding-left: 9px;mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;' align='left' valign='middle'>
                                                                    <table align='left' border='0' cellpadding='0' cellspacing='0' width='' style='border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;'>
                                                                        <tbody><tr>
                                                                            
                                                                                <td class='mcnFollowIconContent' align='center' valign='middle' width='24' style='mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;'>
                                                                                    <a href='https://plus.google.com/108338590412015686244' target='_blank' style='mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;'><img src='http://cdn-images.mailchimp.com/icons/social-block-v2/light-googleplus-48.png' style='display: block;border: 0;height: auto;outline: none;text-decoration: none;-ms-interpolation-mode: bicubic;' class='' height='24' width='24'></a>
                                                                                </td>
                                                                            
                                                                            
                                                                        </tr>
                                                                    </tbody></table>
                                                                </td>
                                                            </tr>
                                                        </tbody></table>
                                                    </td>
                                                </tr>
                                            </tbody></table>
                                        
                                        <!--[if mso]>
                                        </td>
                                        <![endif]-->
                                    
                                        <!--[if mso]>
                                        <td align='center' valign='top'>
                                        <![endif]-->
                                        
                                        
                                            <table style='display: inline;border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;' align='left' border='0' cellpadding='0' cellspacing='0'>
                                                <tbody><tr>
                                                    <td style='padding-right: 10px;padding-bottom: 9px;mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;' class='mcnFollowContentItemContainer' valign='top'>
                                                        <table class='mcnFollowContentItem' border='0' cellpadding='0' cellspacing='0' width='100%' style='border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;'>
                                                            <tbody><tr>
                                                                <td style='padding-top: 5px;padding-right: 10px;padding-bottom: 5px;padding-left: 9px;mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;' align='left' valign='middle'>
                                                                    <table align='left' border='0' cellpadding='0' cellspacing='0' width='' style='border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;'>
                                                                        <tbody><tr>
                                                                            
                                                                                <td class='mcnFollowIconContent' align='center' valign='middle' width='24' style='mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;'>
                                                                                    <a href='https://www.youtube.com/channel/UCtjiTvU4D8cSSZYnQBGZlhA' target='_blank' style='mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;'><img src='http://cdn-images.mailchimp.com/icons/social-block-v2/light-youtube-48.png' style='display: block;border: 0;height: auto;outline: none;text-decoration: none;-ms-interpolation-mode: bicubic;' class='' height='24' width='24'></a>
                                                                                </td>
                                                                            
                                                                            
                                                                        </tr>
                                                                    </tbody></table>
                                                                </td>
                                                            </tr>
                                                        </tbody></table>
                                                    </td>
                                                </tr>
                                            </tbody></table>
                                        
                                        <!--[if mso]>
                                        </td>
                                        <![endif]-->
                                    
                                        <!--[if mso]>
                                        <td align='center' valign='top'>
                                        <![endif]-->
                                        
                                        
                                            <table style='display: inline;border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;' align='left' border='0' cellpadding='0' cellspacing='0'>
                                                <tbody><tr>
                                                    <td style='padding-right: 0;padding-bottom: 9px;mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;' class='mcnFollowContentItemContainer' valign='top'>
                                                        <table class='mcnFollowContentItem' border='0' cellpadding='0' cellspacing='0' width='100%' style='border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;'>
                                                            <tbody><tr>
                                                                <td style='padding-top: 5px;padding-right: 10px;padding-bottom: 5px;padding-left: 9px;mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;' align='left' valign='middle'>
                                                                    <table align='left' border='0' cellpadding='0' cellspacing='0' width='' style='border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;'>
                                                                        <tbody><tr>
                                                                            
                                                                                <td class='mcnFollowIconContent' align='center' valign='middle' width='24' style='mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;'>
                                                                                    <a href='https://www.linkedin.com/company/gotong-royong-fund' target='_blank' style='mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;'><img src='http://cdn-images.mailchimp.com/icons/social-block-v2/light-linkedin-48.png' style='display: block;border: 0;height: auto;outline: none;text-decoration: none;-ms-interpolation-mode: bicubic;' class='' height='24' width='24'></a>
                                                                                </td>
                                                                            
                                                                            
                                                                        </tr>
                                                                    </tbody></table>
                                                                </td>
                                                            </tr>
                                                        </tbody></table>
                                                    </td>
                                                </tr>
                                            </tbody></table>
                                        
                                        <!--[if mso]>
                                        </td>
                                        <![endif]-->
                                    
                                    <!--[if mso]>
                                    </tr>
                                    </table>
                                    <![endif]-->
                                </td>
                            </tr>
                        </tbody></table>
                    </td>
                </tr>
            </tbody></table>
        </td>
    </tr>
</tbody></table>

            </td>
        </tr>
    </tbody>
</table><table class='mcnTextBlock' style='min-width: 100%;border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;' border='0' cellpadding='0' cellspacing='0' width='100%'>
    <tbody class='mcnTextBlockOuter'>
        <tr>
            <td class='mcnTextBlockInner' valign='top' style='mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;'>
                
                <table style='min-width: 100%;border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;' class='mcnTextContentContainer' align='left' border='0' cellpadding='0' cellspacing='0' width='100%'>
                    <tbody><tr>
                        
                        <td class='mcnTextContent' style='padding-top: 9px;padding-right: 18px;padding-bottom: 9px;padding-left: 18px;mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;word-break: break-word;color: #ffffff;font-family: Helvetica;font-size: 12px;line-height: 150%;text-align: center;' valign='top'>
                        
                            <span style='font-size:14px'><em>Copyright 2015 Gotong Royong Fund All Rights Reserved</em></span><br>
<br>

                        </td>
                    </tr>
                </tbody></table>
                
            </td>
        </tr>
    </tbody>
</table></td>
                            </tr>
                        </table>
                        <!--[if gte mso 9]>
                        </td>
                        </tr>
                        </table>
                        <![endif]-->
                        <!-- // END TEMPLATE -->
                    </td>
                </tr>
            </table>
        </center>
                <center>
                
                
                
            </center></body>
</html>
        ";

        // Always set content-type when sending HTML email
        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

        // More headers
        $headers .= 'From: support@gotongroyong.fund' . "\r\n";

                mail($to,$subject,$message,$headers);
                $bank = Input::get('bank');    
                return Redirect::to('finish-payment?pm=2&pid='.$pid.'&bank='.$bank.'&inv='.$invoice);
                exit;
            }else {                
                $to = $email;
                $subject = "Gotongroyong.fund notification payment";
                $query = "SELECT title from project where project_id = $pid";
                $rs = DB::select($query);
                $p_title= $rs[0]->title;
                $message = "
        <html xmlns='http://www.w3.org/1999/xhtml' xmlns:v='urn:schemas-microsoft-com:vml' xmlns:o='urn:schemas-microsoft-com:office:office'>
<head>
<meta charset='UTF-8'>
<meta http-equiv='X-UA-Compatible' content='IE=edge'>
<meta name='viewport' content='width=device-width, initial-scale=1'>
<title>Project Notification</title>
</head>
<body style='height: 100%;margin: 0;padding: 0;width: 100%;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;background-color: white;'>
<center>
<table align='center' border='0' cellpadding='0' cellspacing='0' height='100%' width='100%' id='bodyTable' style='border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;height: 100%;margin: 0;padding: 0;width: 100%;background-color: #596c78;'>
<tr>
<td align='center' valign='top' id='bodyCell' style='mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;height: 100%;margin: 0;padding: 10px;width: 100%;border-top: 0;'>
<table border='0' cellpadding='0' cellspacing='0' width='100%' class='templateContainer' style='border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;border: 0;max-width: 600px !important;'>
<tr>
<td valign='top' id='templatePreheader' style='mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;background-color: #f0594d;border-top: 0;border-bottom: 0;padding-top: 9px;padding-bottom: 9px;'><table class='mcnTextBlock' style='min-width: 100%;border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;' border='0' cellpadding='0' cellspacing='0' width='100%'>
<tbody class='mcnTextBlockOuter'>
<tr>
<td class='mcnTextBlockInner' valign='top' style='mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;'>
<table style='min-width: 100%;border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;' class='mcnTextContentContainer' align='left' border='0' cellpadding='0' cellspacing='0' width='100%'>
<tbody><tr>
<td class='mcnTextContent' style='padding-top: 9px;padding-right: 18px;padding-bottom: 9px;padding-left: 18px;mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;word-break: break-word;color: #ffffff;font-family: Helvetica;font-size: 12px;line-height: 150%;text-align: left;' valign='top'>
                        
                            

                        </td>
                    </tr>
                </tbody></table>
                
            </td>
        </tr>
    </tbody>
</table></td>
                            </tr>
                            <tr>
                                <td valign='top' id='templateHeader' style='mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;background-color: #FFFFFF;border-top: 0;border-bottom: 0;padding-top: 0px;padding-bottom: 8px;'><table class='mcnTextBlock' style='min-width: 100%;border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;' border='0' cellpadding='0' cellspacing='0' width='100%'>
    <tbody class='mcnTextBlockOuter'>
        <tr>
            <td class='mcnTextBlockInner' valign='top' style='mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;'>
                
                <table style='min-width: 100%;border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;' class='mcnTextContentContainer' align='left' border='0' cellpadding='0' cellspacing='0' width='100%'>
                    <tbody><tr>
                        
                        <td class='mcnTextContent' style='padding-top: 9px;padding-right: 18px;padding-bottom: 9px;padding-left: 18px;mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;word-break: break-word;color: #202020;font-family: Helvetica;font-size: 16px;line-height: 150%;text-align: left;' valign='top'>
                        
                            <div style='text-align: center;'><a href='http://gotongroyong.fund' target='_blank' style='mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;color: #2BAADF;font-weight: normal;text-decoration: underline;'><img src='https://gallery.mailchimp.com/ed13f18d9c1789c1c3ade430c/images/082b47dc-50a4-441c-9359-8a043a33d5bc.png' style='width: 244px;height: 45px;margin: 0px;border: 0;outline: none;text-decoration: none;-ms-interpolation-mode: bicubic;' align='none' height='45' width='244'></a></div>

                        </td>
                    </tr>
                </tbody></table>
                
            </td>
        </tr>
    </tbody>
</table><table class='mcnImageBlock' style='min-width: 100%;border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;' border='0' cellpadding='0' cellspacing='0' width='100%'>
    <tbody class='mcnImageBlockOuter'>
            <tr>
                <td style='padding: 0px;mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;' class='mcnImageBlockInner' valign='top'>
                    <table class='mcnImageContentContainer' style='min-width: 100%;border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;' align='left' border='0' cellpadding='0' cellspacing='0' width='100%'>
                        <tbody><tr>
                            <td class='mcnImageContent' style='padding-right: 0px;padding-left: 0px;padding-top: 0;padding-bottom: 0;text-align: center;mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;' valign='top'>
                                
                                    <a href='https://www.youtube.com/watch?v=RDR02AzqUBA&autoplay=1' title='' class='' target='_blank' style='mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;'>
                                        <img alt='' src='https://gallery.mailchimp.com/d368955e51966a52a292946aa/images/c5334885-fb78-4d8a-8aa4-9033dca6eb7e.png' style='max-width: 800px;padding-bottom: 0;display: inline !important;vertical-align: bottom;border: 0;height: auto;outline: none;text-decoration: none;-ms-interpolation-mode: bicubic;' class='mcnImage' align='middle' width='600'>
                                    </a>
                                <p><u>Project Notification</u> <br> <br></p>

                            </td>
                        </tr>
                    </tbody></table>
                    <div style='font-size:14px;text-align:center'>
                        
                        <p>Terima kasih telah mendanai project <b>$p_title</b></p>
                        <p>Dana yang anda kirim akan di konfirmasi oleh tim kami kurang dari 24jam</p>
                        <p>Dana yang sudah di konfirmasi akan terdaftar di tab 'Backer' yang ada di projek tersebut</p>
                        <p>Silahkan Konfirmasi ke support@gotongroyong.fund atau hubungi kami di +6221 - 3190 9100</p>
                        <br> <br>
                    </div>
                </td>
            </tr>
    </tbody>
</table></td>
                            </tr>
                            
                            <tr>
                                <td valign='top' id='templateFooter' style='mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;background-color: #f0594d;border-top: 0;border-bottom: 0;padding-top: 9px;padding-bottom: 9px;'><table class='mcnFollowBlock' style='min-width: 100%;border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;' border='0' cellpadding='0' cellspacing='0' width='100%'>
    <tbody class='mcnFollowBlockOuter'>
        <tr>
            <td style='padding: 9px;mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;' class='mcnFollowBlockInner' align='center' valign='top'>
                <table class='mcnFollowContentContainer' style='min-width: 100%;border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;' border='0' cellpadding='0' cellspacing='0' width='100%'>
    <tbody><tr>
        <td style='padding-left: 9px;padding-right: 9px;mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;' align='center'>
            <table style='min-width: 100%;border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;' class='mcnFollowContent' border='0' cellpadding='0' cellspacing='0' width='100%'>
                <tbody><tr>
                    <td style='padding-top: 9px;padding-right: 9px;padding-left: 9px;mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;' align='center' valign='top'>
                        <table align='center' border='0' cellpadding='0' cellspacing='0' style='border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;'>
                            <tbody><tr>
                                <td align='center' valign='top' style='mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;'>
                                    <!--[if mso]>
                                    <table align='center' border='0' cellspacing='0' cellpadding='0'>
                                    <tr>
                                    <![endif]-->
                                    
                                        <!--[if mso]>
                                        <td align='center' valign='top'>
                                        <![endif]-->
                                        
                                        
                                            <table style='display: inline;border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;' align='left' border='0' cellpadding='0' cellspacing='0'>
                                                <tbody><tr>
                                                    <td style='padding-right: 10px;padding-bottom: 9px;mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;' class='mcnFollowContentItemContainer' valign='top'>
                                                        <table class='mcnFollowContentItem' border='0' cellpadding='0' cellspacing='0' width='100%' style='border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;'>
                                                            <tbody><tr>
                                                                <td style='padding-top: 5px;padding-right: 10px;padding-bottom: 5px;padding-left: 9px;mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;' align='left' valign='middle'>
                                                                    <table align='left' border='0' cellpadding='0' cellspacing='0' width='' style='border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;'>
                                                                        <tbody><tr>
                                                                            
                                                                                <td class='mcnFollowIconContent' align='center' valign='middle' width='24' style='mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;'>
                                                                                    <a href='https://www.facebook.com/gotongroyongfund' target='_blank' style='mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;'><img src='http://cdn-images.mailchimp.com/icons/social-block-v2/light-facebook-48.png' style='display: block;border: 0;height: auto;outline: none;text-decoration: none;-ms-interpolation-mode: bicubic;' class='' height='24' width='24'></a>
                                                                                </td>
                                                                            
                                                                            
                                                                        </tr>
                                                                    </tbody></table>
                                                                </td>
                                                            </tr>
                                                        </tbody></table>
                                                    </td>
                                                </tr>
                                            </tbody></table>
                                        
                                        <!--[if mso]>
                                        </td>
                                        <![endif]-->
                                    
                                        <!--[if mso]>
                                        <td align='center' valign='top'>
                                        <![endif]-->
                                        
                                        
                                            <table style='display: inline;border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;' align='left' border='0' cellpadding='0' cellspacing='0'>
                                                <tbody><tr>
                                                    <td style='padding-right: 10px;padding-bottom: 9px;mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;' class='mcnFollowContentItemContainer' valign='top'>
                                                        <table class='mcnFollowContentItem' border='0' cellpadding='0' cellspacing='0' width='100%' style='border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;'>
                                                            <tbody><tr>
                                                                <td style='padding-top: 5px;padding-right: 10px;padding-bottom: 5px;padding-left: 9px;mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;' align='left' valign='middle'>
                                                                    <table align='left' border='0' cellpadding='0' cellspacing='0' width='' style='border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;'>
                                                                        <tbody><tr>
                                                                            
                                                                                <td class='mcnFollowIconContent' align='center' valign='middle' width='24' style='mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;'>
                                                                                    <a href='http://twitter.com/GRFund' target='_blank' style='mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;'><img src='http://cdn-images.mailchimp.com/icons/social-block-v2/light-twitter-48.png' style='display: block;border: 0;height: auto;outline: none;text-decoration: none;-ms-interpolation-mode: bicubic;' class='' height='24' width='24'></a>
                                                                                </td>
                                                                            
                                                                            
                                                                        </tr>
                                                                    </tbody></table>
                                                                </td>
                                                            </tr>
                                                        </tbody></table>
                                                    </td>
                                                </tr>
                                            </tbody></table>
                                        
                                        <!--[if mso]>
                                        </td>
                                        <![endif]-->
                                    
                                        <!--[if mso]>
                                        <td align='center' valign='top'>
                                        <![endif]-->
                                        
                                        
                                            <table style='display: inline;border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;' align='left' border='0' cellpadding='0' cellspacing='0'>
                                                <tbody><tr>
                                                    <td style='padding-right: 10px;padding-bottom: 9px;mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;' class='mcnFollowContentItemContainer' valign='top'>
                                                        <table class='mcnFollowContentItem' border='0' cellpadding='0' cellspacing='0' width='100%' style='border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;'>
                                                            <tbody><tr>
                                                                <td style='padding-top: 5px;padding-right: 10px;padding-bottom: 5px;padding-left: 9px;mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;' align='left' valign='middle'>
                                                                    <table align='left' border='0' cellpadding='0' cellspacing='0' width='' style='border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;'>
                                                                        <tbody><tr>
                                                                            
                                                                                <td class='mcnFollowIconContent' align='center' valign='middle' width='24' style='mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;'>
                                                                                    <a href='https://plus.google.com/108338590412015686244' target='_blank' style='mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;'><img src='http://cdn-images.mailchimp.com/icons/social-block-v2/light-googleplus-48.png' style='display: block;border: 0;height: auto;outline: none;text-decoration: none;-ms-interpolation-mode: bicubic;' class='' height='24' width='24'></a>
                                                                                </td>
                                                                            
                                                                            
                                                                        </tr>
                                                                    </tbody></table>
                                                                </td>
                                                            </tr>
                                                        </tbody></table>
                                                    </td>
                                                </tr>
                                            </tbody></table>
                                        
                                        <!--[if mso]>
                                        </td>
                                        <![endif]-->
                                    
                                        <!--[if mso]>
                                        <td align='center' valign='top'>
                                        <![endif]-->
                                        
                                        
                                            <table style='display: inline;border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;' align='left' border='0' cellpadding='0' cellspacing='0'>
                                                <tbody><tr>
                                                    <td style='padding-right: 10px;padding-bottom: 9px;mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;' class='mcnFollowContentItemContainer' valign='top'>
                                                        <table class='mcnFollowContentItem' border='0' cellpadding='0' cellspacing='0' width='100%' style='border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;'>
                                                            <tbody><tr>
                                                                <td style='padding-top: 5px;padding-right: 10px;padding-bottom: 5px;padding-left: 9px;mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;' align='left' valign='middle'>
                                                                    <table align='left' border='0' cellpadding='0' cellspacing='0' width='' style='border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;'>
                                                                        <tbody><tr>
                                                                            
                                                                                <td class='mcnFollowIconContent' align='center' valign='middle' width='24' style='mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;'>
                                                                                    <a href='https://www.youtube.com/channel/UCtjiTvU4D8cSSZYnQBGZlhA' target='_blank' style='mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;'><img src='http://cdn-images.mailchimp.com/icons/social-block-v2/light-youtube-48.png' style='display: block;border: 0;height: auto;outline: none;text-decoration: none;-ms-interpolation-mode: bicubic;' class='' height='24' width='24'></a>
                                                                                </td>
                                                                            
                                                                            
                                                                        </tr>
                                                                    </tbody></table>
                                                                </td>
                                                            </tr>
                                                        </tbody></table>
                                                    </td>
                                                </tr>
                                            </tbody></table>
                                        
                                        <!--[if mso]>
                                        </td>
                                        <![endif]-->
                                    
                                        <!--[if mso]>
                                        <td align='center' valign='top'>
                                        <![endif]-->
                                        
                                        
                                            <table style='display: inline;border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;' align='left' border='0' cellpadding='0' cellspacing='0'>
                                                <tbody><tr>
                                                    <td style='padding-right: 0;padding-bottom: 9px;mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;' class='mcnFollowContentItemContainer' valign='top'>
                                                        <table class='mcnFollowContentItem' border='0' cellpadding='0' cellspacing='0' width='100%' style='border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;'>
                                                            <tbody><tr>
                                                                <td style='padding-top: 5px;padding-right: 10px;padding-bottom: 5px;padding-left: 9px;mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;' align='left' valign='middle'>
                                                                    <table align='left' border='0' cellpadding='0' cellspacing='0' width='' style='border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;'>
                                                                        <tbody><tr>
                                                                            
                                                                                <td class='mcnFollowIconContent' align='center' valign='middle' width='24' style='mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;'>
                                                                                    <a href='https://www.linkedin.com/company/gotong-royong-fund' target='_blank' style='mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;'><img src='http://cdn-images.mailchimp.com/icons/social-block-v2/light-linkedin-48.png' style='display: block;border: 0;height: auto;outline: none;text-decoration: none;-ms-interpolation-mode: bicubic;' class='' height='24' width='24'></a>
                                                                                </td>
                                                                            
                                                                            
                                                                        </tr>
                                                                    </tbody></table>
                                                                </td>
                                                            </tr>
                                                        </tbody></table>
                                                    </td>
                                                </tr>
                                            </tbody></table>
                                        
                                        <!--[if mso]>
                                        </td>
                                        <![endif]-->
                                    
                                    <!--[if mso]>
                                    </tr>
                                    </table>
                                    <![endif]-->
                                </td>
                            </tr>
                        </tbody></table>
                    </td>
                </tr>
            </tbody></table>
        </td>
    </tr>
</tbody></table>

            </td>
        </tr>
    </tbody>
</table><table class='mcnTextBlock' style='min-width: 100%;border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;' border='0' cellpadding='0' cellspacing='0' width='100%'>
    <tbody class='mcnTextBlockOuter'>
        <tr>
            <td class='mcnTextBlockInner' valign='top' style='mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;'>
                
                <table style='min-width: 100%;border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;' class='mcnTextContentContainer' align='left' border='0' cellpadding='0' cellspacing='0' width='100%'>
                    <tbody><tr>
                        
                        <td class='mcnTextContent' style='padding-top: 9px;padding-right: 18px;padding-bottom: 9px;padding-left: 18px;mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;word-break: break-word;color: #ffffff;font-family: Helvetica;font-size: 12px;line-height: 150%;text-align: center;' valign='top'>
                        
                            <span style='font-size:14px'><em>Copyright 2015 Gotong Royong Fund All Rights Reserved</em></span><br>
<br>

                        </td>
                    </tr>
                </tbody></table>
                
            </td>
        </tr>
    </tbody>
</table></td>
                            </tr>
                        </table>
                        <!--[if gte mso 9]>
                        </td>
                        </tr>
                        </table>
                        <![endif]-->
                        <!-- // END TEMPLATE -->
                    </td>
                </tr>
            </table>
        </center>
                <center>
                
                
                
            </center></body>
</html>
        ";

        // Always set content-type when sending HTML email
        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

        // More headers
        $headers .= 'From: support@gotongroyong.fund' . "\r\n";
                mail($to,$subject,$message,$headers);
                return Redirect::to('finish-payment?pm=3&pid='.$pid.'&inv='.$invoice);
                exit;
            }
            
            
        }
        public function postTopuppledge(){
            date_default_timezone_set("Asia/Jakarta");
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
                    Veritrans_Config::$serverKey = 'VT-server-ZJqkcuil1Mee47mCBXpD9CQo';

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
        Veritrans_Config::$serverKey = 'VT-server-ZJqkcuil1Mee47mCBXpD9CQo';

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
        $statusflag = 0;
        if($status == "finish" )
        {
            $note = Input::get('transaction_status')."-".Input::get('fraud_status');
            if(Input::get('transaction_status') == "capture" || Input::get('transaction_status') == "settlement")
                $statusflag = 1;
            if(Input::get('fraud_status') == "deny") $statusflag = 0;
            $backer = array(
                'note'=>$note,
                'status'=>$statusflag,
            );
            DB::table('backer')->where('backer_id',$orderid)->update($backer);

            $rsB = DB::table('backer')->where('backer_id', $orderid)->first();

            return Redirect::to('finish-payment?pm=1&pid='.$rsB->project_id);
        }else{
            $rsB = DB::table('backer')->where('backer_id', $orderid)->first();
            return Redirect::to('finish-payment?pm=1&status='.$statusflag.'&pid='.$rsB->project_id);
        }
    }

    public function payment1()
    {
        
    }
}
