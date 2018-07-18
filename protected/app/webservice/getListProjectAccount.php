<?php
session_start();
header('Content-Type: application/json');

include 'db_config.php';
$page = $_POST["page"];
$id = $_SESSION['ses_id'];


$query = " SELECT * FROM project where author = $id ";


if($page=="" || $page < 0) 
{
    $page = 0;
}
$query .= " ORDER BY project_id ASC LIMIT ".($page*6).",6 ";

$rs = executeQuery($query);
$result = array();
$i=0;
foreach($rs as $project){
        
        $project['fund_percent'] = round($project['fund_amount'] / $project['amount'] * 100,2);
        $project['days_to_go'] = date_diff(date_create(date("Y-m-d")),date_create($project['due_date']));
        $project['formated_title'] = substr($project['title'],0,20);
        $project['formated_funded'] = number_format($project['fund_amount'],0,",",".");
        $project['formated_amount'] = number_format($project['amount'],0,",",".");
        $project['formated_days'] = $project['days_to_go']->format("%r%a");


        $query = "SELECT COUNT(backer_id) as backer FROM backer WHERE project_id = '".$project['project_id']."'";
        $rsBacker = executeQuery($query);
        $project['backer'] = 0;
        if($rsBacker != null)
            $project['backer'] = $rsBacker[0]['backer'];

        $query="Select SUM(backer_amount) as hitung2 FROM backer WHERE project_id = '".$project['project_id']."' AND status = 1";
        $rs = executeQuery($query);
        $project['hitung_f'] = $rs[0]['hitung2'];
        $project['formated_hitung_f'] = number_format($rs[0]['hitung2'],0,",",".");

        $query="SELECT count(project_id) as hitung from project where author= $id ";
        $rs = executeQuery($query);
        $project['total'] = $rs[0]['hitung'];

        $project['project_total']= ceil($project['total']/6);

        $result[$i]=$project;
        $i++;
}
echo json_encode($result);