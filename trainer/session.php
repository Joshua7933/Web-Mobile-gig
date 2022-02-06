<?php
   include('../con.php');
   session_start();
   
   $user_check = $_SESSION['trainer_id'];
   
   $ses_sql = mysqli_query($con,"select trainer_id from trainers where trainer_id = '$user_check' ");
   
   $row = mysqli_fetch_array($ses_sql,MYSQLI_ASSOC);
   
   $login_session = $row['trainer_id'];

   
   if(!isset($_SESSION['trainer_id'])){
      header("location:../login.php");
      die();
   }
?>x