<?php
 include("con.php");
   session_start();
   $clienterror = $active =$trainererror='';
   if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['loginTrainer'])) {
      // username and password sent from form 
      
          $myusername = mysqli_real_escape_string($con,$_POST['trainerFname']);
          $mypassword = mysqli_real_escape_string($con,$_POST['trainerPass']); 
      
      $sql = "SELECT `trainer_id`, `trainer_fname`, `trainer_lname`, `trainer_pass`, `trainer_email`, `trainer_phone`, `trainer_address`, `trainer_profilepic`, `trainer_gender`, `trainer_shortdesc`, `date_joined` FROM `trainers` WHERE trainer_fname = '$myusername' and trainer_pass = '$mypassword'";
      $result = mysqli_query($con,$sql);
      
      
      
if(mysqli_num_rows($result))
{
while($row = mysqli_fetch_array($result)){
 $_SESSION['trainer_id']=$row['trainer_id'];
$_SESSION['trainer_fname']=$row['trainer_fname'];
$_SESSION['trainer_lname'] = $row['trainer_lname'];
$_SESSION['trainer_profilepic']=$row['trainer_profilepic'];



}
$_SESSION['trainerlogin']=$_POST['trainerFname'];
header("location: trainer/index.php");
}else {
         $trainererror = "The Trainer's Login Name or Password is invalid";
      }
   }else if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['loginClient'])){
      // username and password sent from form 
      
      $myusername = mysqli_real_escape_string($con,$_POST['clientFname']);
      $mypassword = mysqli_real_escape_string($con,$_POST['clientPass']); 
      
      $sql = "SELECT `client_id`, `client_fname`, `client_lname`, `client_email`, `client_phone`, `client_address`, `client_password`, `client_gender`, `client_profilepic`, `date_joined` FROM `clients` WHERE client_fname = '$myusername' and client_password = '$mypassword'";
      $results = mysqli_query($con,$sql);

if(mysqli_num_rows($results) ==1)
{
while($row = mysqli_fetch_array($results)){
 $_SESSION['client_id']=$row['client_id'];
$_SESSION['client_fname']=$row['client_fname'];
$_SESSION['client_lname'] = $row['client_lname'];
$_SESSION['client_profilepic']=$row['client_profilepic'];



}
$_SESSION['login']=$_POST['clientFname'];
header("location: client/index.php");
}else{
     $clienterror ="The Client Login Name or Password is invalid";
}
   }
?>
<!DOCTYPE html>
<html>
<head>
	<title>Get Started</title>
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="css/style.css">
<script src="js/bootstrap.min.js"></script>
<script src="js/jquery-3.2.1.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="js/bootstrap.min.js"></script>
</head>
<body>
<div class="container register">
                <div class="row">
                    <div class="col-md-3 register-left">
                        <img src="https://image.ibb.co/n7oTvU/logo_white.png" alt=""/>
                        <h3>Welcome</h3>
                        <p>Login</p>
                        <a href="signup.php"><input type="submit" name="" value="Register"/><br/></a>
                    </div>
                    <div class="col-md-9 register-right">
                        <ul class="nav nav-tabs nav-justified" id="myTab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Trainer</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Client</a>
                            </li>
                        </ul>
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                <h3 class="register-heading">Login as a Trainer</h3>
                                <span class="error"><?php echo $trainererror; ?></span>
                                <div class="row register-form">
                                    <div class="col-md-3"></div>
                                    <div class="col-md-6">
                                        <form method="post" action="login.php">
                                         <div class="form-group">
                                            <input type="text" class="form-control" placeholder="Your First name *" name="trainerFname" value="" />
                                        </div>

                                        <div class="form-group">
                                            <input type="password" class="form-control" placeholder="Password *" name="trainerPass" value="" />
                                        </div>

                                       

                                        
                                   

                                        <input type="submit" name="loginTrainer" class="btnRegister"  value="Login"/>
                                         </div>
                                         </form>
                                   
                                </div>
                                <div class="col-md-3"></div>
                            </div>
                            <div class="tab-pane fade show" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                                <h3  class="register-heading">Login as a Client</h3>
                                <span class="error"><?php echo $clienterror; ?>
                                <div class="row register-form">
<div class="col-md-3"></div>
                                    <div class="col-md-6">
                                         <form method="post" action="login.php">
                                         <div class="form-group">
                                            <input type="text" class="form-control" placeholder="Your First Name " name="clientFname" value="" />
                                        </div>

                                        <div class="form-group">
                                            <input type="password" class="form-control" placeholder="Password *" name="clientPass" value="" />
                                        </div>

                                       

                                        
                                   

                                        <input type="submit" name="loginClient" class="btnRegister"  value="Login"/>
                                         </div>
                                     </form>
                                   
                                </div>
                                <div class="col-md-3"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
</body>
</html>