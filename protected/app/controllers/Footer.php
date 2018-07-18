<?php
class Footer extends BaseController 
{
	public function show_charity()
	{
		 $query = "SELECT title, project_alias FROM project where subcategory <> 'solidarity' AND status=1 Order By project_id desc LIMIT 3"; 
		 $rs2 = DB::select($query);
		 return $rs2;
	}
	public function show_solidarity()
	{
		 $query = "SELECT title, project_alias FROM project where subcategory ='solidarity' AND status=1 Order By project_id desc LIMIT 3"; 
		 $rs = DB::select($query);
		 return $rs;
	}
	
}
$obj = new Footer;
?>