<?php
include_once 'lib/connection.php';
session_start();
date_default_timezone_set('Asia/Manila');
$d = date("Y-m-d");
$t = date("h:i:s A");
$action = 'Logout';


$insertLog = $pdo->prepare("INSERT INTO user_log(user_id, username, action, logDate, logTime) values(:id, :user, :action, :logDate, :logTime)");

$insertLog->bindParam(':id', $_SESSION['myid']);
$insertLog->bindParam(':user', $_SESSION['username']);
$insertLog->bindParam(':action', $action);
$insertLog->bindParam(':logDate', $d);
$insertLog->bindParam(':logTime', $t);
$insertLog->execute();

session_unset();
session_write_close();
session_destroy();

header('location: ./index.php');
