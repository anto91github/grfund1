<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

header('Content-Type: application/json');

include 'db_config.php';

$id = $_POST["id"];
$title = $_POST["title"];
$description = $_POST["description"];
$minimum = str_replace(array("Rp ","_","."), "", $_POST["minimum"]);
$available = $_POST["available"];

$updateimage = "";
$destinationPath = "uploads/reward/";
$realname = "";
if($_POST['changeImage'] == 'true'){
    if (isset($_POST['rewardImage'])) {
    //if (isset($_POST['rewardImage']) ) {
        $realname = "";
        $updateimage = ", reward_image= '". $realname."' ";
    } elseif ($_FILES['rewardImage']['error'] == 0)  {
        //change avatar
        //echo Input::file('avatar')->getClientOriginalName();
        $realname = $_FILES['rewardImage']['name'];
        move_uploaded_file($_FILES['rewardImage']['tmp_name'], "../../../".$destinationPath.$realname);
        $updateimage = ", reward_image= '".$realname."' ";
    } else {
        //do nothing
    }
}

$query = "UPDATE reward SET "
        . "reward_title = '$title',"
        . "reward_description = '$description',"
        . "reward_minimum = '$minimum',"
        . "reward_available = '$available' "
        . $updateimage
        . "WHERE reward_id = $id ";    
$tmp = nonscalarQuery($query);    

echo json_encode($tmp);