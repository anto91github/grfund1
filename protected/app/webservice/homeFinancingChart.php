<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

header('Content-Type: application/json');

include 'db_config.php';

$query= "SELECT invoice_category, SUM(valuation) as TotalLoan, SUM(lending_amount) as TotalFunding, SUM(paid_interest) as TotalInterest "
        . "FROM invoice "
        . "WHERE status = 1 "
        . "GROUP BY invoice_category";
$rows = executeQuery($query);
echo json_encode($rows);

