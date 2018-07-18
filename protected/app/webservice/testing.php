<?php 

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

header('Content-Type: application/json');

$dbConfig = require_once __DIR__.'/../config/database.php';
$driver = $dbConfig['default'];
$connection = $dbConfig['connections'][$driver];
$servername = $connection['host'];
$username = $connection['username'];
$password = $connection['password'];
$dbname = $connection['database'];

$conn = new mysqli($servername, $username, $password, $dbname);
if($conn->connect_error){
    die("Connection Failed : ".$conn->connect_error);
}
/*
$query= "SELECT * FROM project WHERE status = 1";
$rs = $conn->query($query);
$rows = array();
while($r = mysqli_fetch_assoc($rs)) {
    $rows[] = $r;
}

$conn->close();
 * */
$rows = array( "coba","isi" );
echo json_encode($rows);
/*
$driver = Config::get('database.default');
		$database = Config::get('database.connections');
		$this->db = $database[$driver]['database'];
$query= "SELECT * FROM project WHERE status = 1";
$rs = DB::select($query);

echo json_encode(array('foo' => 'bar'));
*/
