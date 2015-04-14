<?php

$id = $_GET['id'];

require_once 'DBConnect.php';
$db = new DBConnect();
$flag = $db->ignoreQuery($id);
if($flag){
    header("Location: http://localhost/tpomanagement/admin/home.php");
}
