<?php
   // include('init.php');
   // session_start();
   // $db = mysqli_select_db($conn,'srms');
   // $user_check = $_SESSION['login_user'];
      
   // $ses_sql = mysqli_query($conn,"select username from Reg where username= '$user_check'");
   // $row = mysqli_fetch_array($ses_sql);
   
   // $login_session = $row['username'];
   
   // if(!isset($_SESSION['login_user'])){
   //    header("Location:ulogin.php");
   // } 
include('init.php');
session_start();
$db = mysqli_select_db($conn, 'srms');
$user_check = $_SESSION['login_user'];

$ses_sql = mysqli_query($conn, "SELECT username FROM Reg WHERE username = '$user_check'");
$row = mysqli_fetch_array($ses_sql);



if ($row && isset($row['username'])) {
    $login_session = $row['username'];
} else {
    $login_session = null;
}

if (!isset($_SESSION['login_user']) || !$login_session) {
    header("Location: ulogin.php");
    exit();
}
?>