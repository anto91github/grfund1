<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
header('Content-Type: application/json');
include 'db_config.php';

$email = $_POST["email"];

$query = "select email from tb_newsletter where email = '$email' " ;
$rs = executeQuery($query);


if( count($rs) > 0)
{
	echo json_encode("success");
}
else
{
$query2 = "Insert into tb_newsletter (email,status)  values ( '$email' , '1')";
$rs2 = nonscalarQuery($query2);
echo json_encode("success");
}


?>
