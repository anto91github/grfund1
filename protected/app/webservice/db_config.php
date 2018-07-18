<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */



function executeQuery($query){
    
    $dbConfig = require __DIR__.'/../config/database.php';
    $driver = $dbConfig['default'];
    $connection = $dbConfig['connections'][$driver];
    $servername = $connection['host'];
    $username = $connection['username'];
    $password = $connection['password'];
    $dbname = $connection['database'];
    
    $conn = new mysqli($servername, $username, $password, $dbname);
    if($conn->connect_error){
        return "Connection Failed : ".$conn->connect_error;
        exit(0);
    }
    try{
        $rs = $conn->query($query);
        if(!$rs){
            echo "ERROR : ".mysqli_error();
            exit(0);
        }
        $rows = array();
        if($rs!=null && $rs->num_rows > 0){
            while($r = $rs->fetch_assoc()) {
                $rows[] = $r;
            }
        }

        $conn->close();
        return $rows;
    }catch(Exception $e){
        //return "Error : ".$e->getMessage();
        throw $e;
    }
}

function nonscalarQuery($query){
    $dbConfig = require __DIR__.'/../config/database.php';
    $driver = $dbConfig['default'];
    $connection = $dbConfig['connections'][$driver];
    $servername = $connection['host'];
    $username = $connection['username'];
    $password = $connection['password'];
    $dbname = $connection['database'];
    
    $conn = new mysqli($servername, $username, $password, $dbname);
    if($conn->connect_error){
        return "Connection Failed : ".$conn->connect_error;
        exit(0);
    }
    $rs = $conn->query($query);
    $conn->close();
    return $rs;
}