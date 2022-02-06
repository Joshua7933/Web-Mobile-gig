<?php
   include('../con.php');
   session_start();
   
   $user_check = $_SESSION['client_id'];
   
   $ses_sql = mysqli_query($con,"select client_id from clients where client_id = '$user_check' ");
   
   $row = mysqli_fetch_array($ses_sql,MYSQLI_ASSOC);
   
   $login_session = $row['client_id'];

   
   if(!isset($_SESSION['client_id'])){
      header("location:../login.php");
      die();
   }else{

   }
?>