<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

header('Content-Type: application/json');

include 'db_config.php';

$id = $_POST["id"];
try{
$query = "SELECT * FROM user_image WHERE id = $id";
$rs = executeQuery($query);
foreach($rs as $row){
    $url = $row['url'];
    $arrs = explode("/",$url);
    $img = "";
    $start = 0;
    foreach($arrs as $arr){
        if($arr == "uploads") $start = 1;
        if($start == 1){
            $img .= $arr."/";
        }
    }
    $img = substr($img, 0, strlen($img)-1);
    $img = "../../../".$img;
    if (file_exists($img)) {
        unlink($img); // Delete now
    }
}
    $query = "DELETE FROM user_image "
        . "WHERE id = $id ";    
    $tmp = nonscalarQuery($query);    
    echo json_encode(1);
}catch(Exception $e){
    echo json_encode($e->getMessage());
}
