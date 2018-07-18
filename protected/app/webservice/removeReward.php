<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
header('Content-Type: application/json');

include 'db_config.php';

$id = $_POST["id"];

$query = "SELECT * FROM backer WHERE reward_id = '$id'";
$rs = executeQuery($query);
if(count($rs)>0){
    echo json_encode("Already backer for this reward.");
}else{
	
    $query = "DELETE "
            . "FROM reward "
            . "WHERE reward_id = $id ";    
    $tmp = nonscalarQuery($query);    

    echo json_encode($tmp);
}
