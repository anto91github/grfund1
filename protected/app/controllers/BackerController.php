<?php
date_default_timezone_set("Asia/Jakarta");
class BackerController extends BaseController {

	protected $layout = "layouts.main";
	protected $data = array();	
	public $module = 'backer';
	static $per_page	= '10';
	
	public function __construct() {
		parent::__construct();
		$this->beforeFilter('csrf', array('on'=>'post'));
		$this->model = new Backer();
		$this->info = $this->model->makeInfo( $this->module);
		$this->access = $this->model->validAccess($this->info['id']);
	
		$this->data = array(
			'pageTitle'	=> 	$this->info['title'],
			'pageNote'	=>  $this->info['note'],
			'pageModule'=> 'backer',
			'trackUri' 	=> $this->trackUriSegmented()	
		);
			
				
	} 

	
	public function getIndex()
	{
		if($this->access['is_view'] ==0) 
			return Redirect::to('')
				->with('message', SiteHelpers::alert('error',Lang::get('core.note_restric')));
				
		// Filter sort and order for query 
		$sort = (!is_null(Input::get('sort')) ? Input::get('sort') : 'backer_id'); 
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
		$this->layout->nest('content','backer.index',$this->data)
						->with('menus', SiteHelpers::menus());
	}		
	

	function getAdd( $id = null)
	{
	
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
		
		$row = $this->model->find($id);
		if($row)
		{
			$this->data['row'] =  $row;
		} else {
			$this->data['row'] = $this->model->getColumnTable('backer'); 
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
		$this->layout->nest('content','backer.form',$this->data)->with('menus', $this->menus );	
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
			$this->data['row'] = $this->model->getColumnTable('backer'); 
		}
		$this->data['masterdetail']  = $this->masterDetailParam(); 
		$this->data['id'] = $id;
		$this->data['access']		= $this->access;
		$this->layout->nest('content','backer.view',$this->data)->with('menus', $this->menus );	
	}	
	
	function postSave( $id =0)
	{

		$trackUri = $this->data['trackUri'];
		$rules = $this->validateForm();
		$validator = Validator::make(Input::all(), $rules);	
		if ($validator->passes()) {
			$data = $this->validatePost('backer');
			$ID = $this->model->insertRow($data , Input::get('backer_id'));
			// Input logs
			if( Input::get('backer_id') =='')
			{
				$this->inputLogs("New Entry row with ID : $ID  , Has Been Save Successfull");
				$id = SiteHelpers::encryptID($ID);
			} else {
				$this->inputLogs(" ID : $ID  , Has Been Changed Successfull");
			}
			$status = Input::get('status');
			$pid= Input::get('project_id');
			

                $query = "SELECT title from project where project_id = $pid";
                $rs = DB::select($query);
                $p_title= $rs[0]->title;

			$to = Input::get('email');
			$subject = "Gotongroyong.fund notification message";
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
                        <p>Dana yang anda sudah konfirmasi oleh tim kami</p>
                        <p>Dana yang sudah di konfirmasi terdaftar di tab 'Backer' yang ada di projek tersebut</p>
                        <p>Untuk keterangan lebih lanjut, silahkan email kami ke support@gotongroyong.fund atau hubungi kami di +6221 - 3190 9100</p>
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
        if($status == 1)
        {
        	mail($to,$subject,$message,$headers);
        }
        

			// Redirect after save	
			$md = str_replace(" ","+",Input::get('md'));
			$redirect = (!is_null(Input::get('apply')) ? 'backer/add/'.$id.'?md='.$md.$trackUri :  'backer?md='.$md.$trackUri );
			return Redirect::to($redirect)->with('message', SiteHelpers::alert('success',Lang::get('core.note_success')));
		} else {
			$md = str_replace(" ","+",Input::get('md'));
			return Redirect::to('backer/add/'.$id.'?md='.$md)->with('message', SiteHelpers::alert('error',Lang::get('core.note_error')))
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
		return Redirect::to('backer?md='.Input::get('md'));
	}	

	function getComboselectreward(){
        if(Request::ajax() == true && Auth::check() == true)
        {
                $param = explode(':',Input::get('filter'));
                $limit = (!is_null(Input::get('limit')) ? Input::get('limit') : null);
                $projectid = (!is_null(Input::get('projectid')) ? Input::get('projectid') : 0);
                if($projectid=="") $projectid=0;
                $rows = DB::select('SELECT * FROM `reward` WHERE `project_id` ='.$projectid.'');
                $items = array();

                $fields = explode("|",$param[2]);

                foreach($rows as $row) 
                {
                        $value = "";
                        foreach($fields as $item=>$val)
                        {
                                if($val != "") $value .= $row->$val." ";
                        }
                        $items[] = array($row->$param['1'] , $value); 	

                }

                return json_encode($items); 	
        } else {
                return json_encode(array('OMG'=>" Are u trying to cheat ?? !!"));
        }
    }			
		
}