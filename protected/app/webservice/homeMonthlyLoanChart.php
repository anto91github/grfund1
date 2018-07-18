<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
header('Content-Type: application/json');

include 'db_config.php';

$rowsLoan = array();
$curr_month = date("m");
$curr_year = date("Y");
$prev_year = $curr_year-1;
$prev_month = $curr_month+1;
if($prev_month == 13){
    $prev_month = 1;
    $prev_year=$curr_year;
}
for($i=0;$i<12;$i++){
    $query = "SELECT "
            . "IFNULL(SUM(valuation),0) as total "
            . "FROM invoice "
            . "WHERE status = 1 "
            . "AND MONTH(lending_date) <=".$prev_month." "
            . "AND YEAR(lending_date) <=".$prev_year."";    
    $tmp = executeQuery($query);    
    $rowsLoan[] = [$i+1,$prev_month,$tmp[0]['total']];
    $prev_month = $prev_month+1;
    if($prev_month > 12){
        $prev_month=1;
        $prev_year=$prev_year+1;
    }
}
echo json_encode($rowsLoan);
