<?php
class homeLabelController extends BaseController 
{
    protected $data = array();  

   public function __construct() {        
        parent::__construct();
        $this->layout = "layouts.".CNF_THEME.".index";        
        
    }

    public function showHome($label = null)
    { 
        
        $page = 'pages.template.homeLabel';
        $lang = Session::get('lang');
                    if($lang == '') $lang = "in";
                    //-------GET POPULAR CHARITY-------------
                    //$query = "SELECT * FROM project WHERE status >= 1 order by project_id desc LIMIT 4";
                    //$query= "SELECT a.*,b.backer FROM project a LEFT JOIN (SELECT project_id,COUNT(backer_id) as backer FROM backer WHERE status = 1 GROUP BY project_id) b on a.project_id=b.project_id WHERE a.status >= 1 order by b.backer desc LIMIT 4";
                    //$query= "SELECT a.*,b.backer,b.hitung_t FROM project a LEFT JOIN (SELECT project_id,COUNT(backer_id) as backer,COUNT(backer_amount) as hitung_t FROM backer WHERE status = 1 GROUP BY project_id) b on a.project_id=b.project_id WHERE a.status >= 1 order by b.backer desc LIMIT 4";
                    //$query="SELECT a.*,b.backer,b.hitung_t FROM project a LEFT JOIN (SELECT project_id,COUNT(backer_id) as backer,SUM(backer_amount) as hitung_t FROM backer WHERE status = 1 GROUP BY project_id) b on a.project_id=b.project_id WHERE a.status >= 1 order by b.hitung_t desc LIMIT 4";
                    //$query= "SELECT a.*,b.backer,b.hitung_t, b.hitung_t/a.amount*100 persentase FROM project a LEFT JOIN (SELECT project_id,COUNT(backer_id) as backer,SUM(backer_amount) as hitung_t FROM backer WHERE status = 1 GROUP BY project_id) b on a.project_id=b.project_id WHERE a.status >= 1 order by persentase desc LIMIT 4";
                    $query= "SELECT a.*,b.backer,b.hitung_t, b.hitung_t/a.amount*100 persentase, c.*
                             FROM project a 
                             LEFT JOIN (SELECT project_id,COUNT(backer_id) as backer,SUM(backer_amount) as hitung_t FROM backer WHERE status = 1 GROUP BY project_id) b on a.project_id=b.project_id 
                             LEFT JOIN ms_label c on a.label_id = c.label_id
                             WHERE a.status >= 1 AND c.alias = '$label' 
                             order by persentase desc LIMIT 4";                    
                    $rs = DB::select($query);                    
                    //$this->data['banner_home'] = (object)$rs;                    
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
                    $this->data['label'] = $label;

                    $query4 = "SELECT * from ms_label where alias = '$label'";
                    $rs = DB::select($query4);
                    
                    $this->data['banner'] = $rs;
                    //print_r ($this->data['banner']) ;exit();

        $this->layout->nest('content',$page, $this->data);      
        
        
    }

    public function showProject($label = null)
    { 
        $page = 'pages.template.projectLabel'; 

        //-------GET PROJECT-------------                    
                    $category = Input::get('category');
                    if($category == "") $category= "all";
                    $subcategory = Input::get('subcategory');
                    $title = Input::get('title');
                    
                    //$query = "SELECT a.* FROM project a JOIN ms_projectcategory b ON a.category=b.id WHERE a.status >= 1";
                    $query = "SELECT a.* , c.*
                              FROM project a 
                              JOIN ms_projectcategory b ON a.category=b.id 
                              JOIN ms_label c on a.label_id = c.label_id
                              WHERE a.status >= 1 AND c.alias = '$label'";
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

                    $this->layout->nest('content',$page, $this->data);                 
                    
                    //------------------------------------------------
    }
}