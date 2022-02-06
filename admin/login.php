<?php
include("../con.php");
   session_start();
   $adminName = $adminPass = $error = '';
if($_SERVER["REQUEST_METHOD"] == "POST"){
$adminName = $_POST['adminName'];
$adminPass = $_POST['adminPass'];

 $myusername = mysqli_real_escape_string($con,$adminName);
      $mypassword = mysqli_real_escape_string($con,$adminPass); 

      $sql ="SELECT `admin_id`, `admin_name`, `admin_email`, `admin_password` FROM `admin` WHERE admin_name='$myusername' AND admin_password= '$mypassword'";
       $result = mysqli_query($con,$sql);
      
      
      
if(mysqli_num_rows($result))
{
while($row = mysqli_fetch_array($result)){
 $_SESSION['adminid']=$row['admin_id'];
}
$_SESSION['adminName']=$_POST['adminName'];
header("location: index.php");
}else {
         $error = "The Name or Password is invalid";
      }
}


?>

<!DOCTYPE html>
<html>
<head>
	<title>Admin Login</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">



    <link rel="stylesheet" type="text/css" href="../css/style.css">
    <link href="../css/font-awesome.min.css"/>
    <link rel="stylesheet" type="text/css" href="../DataTables/datatables.min.css"/>
 

<style type="text/css">
    .vis-container{
        background-color: #0e1a35;
        border-radius: 20px;
        height: 229px;
        margin: 10px;
        padding-top: 90px;
        font-size: 2.592em;
        text-align: center;
     
      }
      .header{
        font-size: 100px;
      }
      @media only screen and (max-width:620px) {
  /* For mobile phones: */
  .vis-container, .header{
    width:100%;
  }
}
</style>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<script type="text/javascript" src="../DataTables/datatables.min.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
    $('#example').DataTable( {
         } );
} );
</script>
</head>
<body>
<div class="container">
	<div class="row">
		<div class="col-md-4"></div>
		<div class="col-md-4">
			<div class="panel-group" style="margin-top: 50%;">
				<div class="panel panel-primary">
					<div class="panel-heading"><?php echo $error; ?></div>
					<div class="panel-body">
						<form class="form" method="post" action="login.php">
							<div class="form-group">
								<label>Admin Name:</label>
								<input type="text" name="adminName" class="form-control" required>
							</div>
							<div class="form-group">
								<label>Password:</label>
								<input type="password" name="adminPass" class="form-control" required>
							</div>
							<input type="submit" class="add-project" name="adminlogin">
						</form>
					</div>
					<div class="panel-footer"></div>
				</div>
			</div>
		</div>
		<div class="col-md-4"></div>
	</div>
</div>
</body>
</html>