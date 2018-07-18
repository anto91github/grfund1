<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
header('Content-Type: application/json');

include 'db_config.php';

$query = "SELECT lending_purpose, Count(invoice_id) as total FROM invoice WHERE status = 1 GROUP BY lending_purpose";
$rows = executeQuery($query);

echo json_encode($rows);
