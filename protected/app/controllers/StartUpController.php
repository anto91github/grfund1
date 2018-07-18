<?php
class StartUpController extends BaseController 
{
    protected $data = array();  

   public function __construct() {        
        parent::__construct();
        $this->layout = "layouts.".CNF_THEME.".index";        
        
    }

    public function showStartUp()
    { 
        $page = 'pages.template.homeStartUp'; 

        $lang = Session::get('lang');
                    if($lang == '') $lang = "in";
                    //-------GET POPULAR CHARITY-------------
                    //$query = "SELECT * FROM project WHERE status >= 1 order by project_id desc LIMIT 4";
                    //$query= "SELECT a.*,b.backer FROM project a LEFT JOIN (SELECT project_id,COUNT(backer_id) as backer FROM backer WHERE status = 1 GROUP BY project_id) b on a.project_id=b.project_id WHERE a.status >= 1 order by b.backer desc LIMIT 4";
                    //$query= "SELECT a.*,b.backer,b.hitung_t FROM project a LEFT JOIN (SELECT project_id,COUNT(backer_id) as backer,COUNT(backer_amount) as hitung_t FROM backer WHERE status = 1 GROUP BY project_id) b on a.project_id=b.project_id WHERE a.status >= 1 order by b.backer desc LIMIT 4";
                    //$query="SELECT a.*,b.backer,b.hitung_t FROM project a LEFT JOIN (SELECT project_id,COUNT(backer_id) as backer,SUM(backer_amount) as hitung_t FROM backer WHERE status = 1 GROUP BY project_id) b on a.project_id=b.project_id WHERE a.status >= 1 order by b.hitung_t desc LIMIT 4";
                    //$query= "SELECT a.*,b.backer,b.hitung_t, b.hitung_t/a.amount*100 persentase FROM project a LEFT JOIN (SELECT project_id,COUNT(backer_id) as backer,SUM(backer_amount) as hitung_t FROM backer WHERE status = 1 GROUP BY project_id) b on a.project_id=b.project_id WHERE a.status >= 1 order by persentase desc LIMIT 4";
                    $query= "SELECT a.*,b.backer,b.hitung_t, b.hitung_t/a.amount*100 persentase FROM project a LEFT JOIN (SELECT project_id,COUNT(backer_id) as backer,SUM(backer_amount) as hitung_t FROM backer WHERE status = 1 GROUP BY project_id) b on a.project_id=b.project_id WHERE a.status >= 1 AND a.label_id =2 order by persentase desc LIMIT 4";
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

        $this->layout->nest('content',$page, $this->data);      
        
        
    }
}