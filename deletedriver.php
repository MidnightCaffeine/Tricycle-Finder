<?php
session_start();
include_once 'lib/connection.php';


if (!isset($_SESSION['username'])) {
    session_unset();
    session_write_close();
    session_destroy();
    header("Location: index.php");
}

if (isset($_POST['delete'])) {
    $id = $_POST['id'];
    $delete = $pdo->prepare("DELETE FROM `driver_list` WHERE user_id='$id' ");
    $delete->execute();
    $delete = $pdo->prepare("DELETE FROM `user_list` WHERE user_id='$id' ");
    if ($delete->execute()) {

        $_SESSION['status'] = "dsuccess";

        header("location: drivers.php");
    } else {
        echo '<script> alert("Data Not Deleted"); </script>';
    }
}