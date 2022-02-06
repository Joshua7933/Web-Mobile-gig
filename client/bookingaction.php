<?php
session_start();
error_reporting(0);
include '../con.php';
if(strlen($_SESSION['login'])==0)
  { 
header('location:../login.php');
}
if(isset($_REQUEST['id']))
{
    $id = $_GET['id'];
    $clientname = $_SESSION['client_fname'];
    $sql = "UPDATE `schedules` SET `status`='booked' WHERE schedule_id='$id'";
    $result = mysqli_query($con,$sql);
    $sql = 	"SELECT `schedule_id`, `trainer_id`, `trainer_fname`, `date`, `start_time`, `end_time`, `gym_name`, `gym_location`, `status`, `date_added`,amount FROM `schedules` WHERE  schedule_id='$id'";
      $result = mysqli_query($con,$sql);
     while($row = mysqli_fetch_assoc($result)) { 
$t_id = $row['trainer_id'];
$t_name = $row['trainer_fname'];
$date = $row['date'];
$s_time = $row['start_time'];
$e_time = $row['end_time'];
$g_name = $row['gym_name'];
$g_location = $row['gym_location'];
$amount = $row['amount'];

}
$sql = "INSERT INTO `bookedschedules`(`bschedule_id`, `trainer_id`, `trainer_name`, `client_name`, `date`, `start_time`, `end_time`, `gym_name`, `gym_location`,datebooked,amount) VALUES (NULL,'$t_id','$t_name','$clientname','$date','$s_time','$e_time','$g_name','$g_location',NOW(),'$amount')";
$result = mysqli_query($con,$sql);

}
header('location: booked.php');
    ?>