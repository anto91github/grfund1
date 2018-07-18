<?php
class projectStartUpController extends BaseController 
{
    protected $data = array();  

   public function __construct() {        
        parent::__construct();
        $this->layout = "layouts.".CNF_THEME.".index";        
        
    }

    public function showProject()
    { 
        $page = 'pages.template.projectStartUp'; 

        //-------GET PROJECT-------------                    
                    $category = Input::get('category');
                    if($category == "") $category= "all";
                    $subcategory = Input::get('subcategory');
                    $title = Input::get('title');
                    
                    //$query = "SELECT a.* FROM project a JOIN ms_projectcategory b ON a.category=b.id WHERE a.status >= 1";
                    $query = "SELECT a.* FROM project a JOIN ms_projectcategory b ON a.category=b.id WHERE a.status >= 1 AND a.label_id = 2";
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

        $this->layout->nest('content',$page, $this->data);      
        
        
    }
}