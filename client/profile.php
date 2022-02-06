<?php
session_start();
error_reporting(0);
include '../con.php';
if(strlen($_SESSION['login'])==0)
  { 
header('location:../login.php');
}
$fname = $lname = $pass1 = $pass2 = $phone =$address = $email = $gender = $profilepic = $shortdesc = $errors = "";
if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['profileupdate']))
{
$target_dir = "uploads/";
$target_file = $target_dir . basename($_FILES["clientProfilepic"]["name"]);
$uploadOk = 1;
$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
// Check if image file is a actual image or fake image

    $check = getimagesize($_FILES["clientProfilepic"]["tmp_name"]);
    if($check !== false) {
        
        $uploadOk = 1;
    } else {
        $profilepicErr=  "File is not an image."; 
        $uploadOk = 0;
    }

// Check if file already exists
if (file_exists($target_file)) {
   $profilepicErr=  "Sorry, file already exists.";
    $uploadOk = 0;
}
// Check file size
if ($_FILES["clientProfilepic"]["size"] > 500000) {
   $profilepicErr= "Sorry, your file is too large.";
    $uploadOk = 0;
}
// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
    $profilepicErr=  "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    $uploadOk = 0;
}
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    $profilepicErr=  "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["clientProfilepic"]["tmp_name"], $target_file)) {
        
    } else {
        $profilepicErr=  "Sorry, there was an error uploading your file.";
    }
}
$fname = $_POST['clientFname'];
$lname = $_POST['clientLname'];
$pass1 = $_POST['clientPass1'];
$pass2 = $_POST['clientpass2'];
$phone = $_POST['clientPhone'];
$address = $_POST['clientAddress'];
$email = $_POST['clientEmail'];
$shortdesc = $_POST['clientShortdesc'];
$gender = $_POST['gender'];
if(empty($gender)){
  $errors = "Gender field cannot be empty";
}
else{
   $id =$_SESSION['client_id'];
  $sql = "UPDATE `clients` SET `client_fname`='$fname',`client_lname`='$lname',`client_email`='$email',`client_phone`='$phone',`client_address`='$address',`client_password`='$pass1',`client_gender`='$gender',`client_profilepic`='$target_file' WHERE client_id='$id'";
  $result = mysqli_query($con, $sql);
  if(!$result){
    $errors = "A problem occurred";
  }else{
    header("location:index.php");
  }
}
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Gym Management</title>
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

	
<body class="home">
    <div class="container-fluid display-table">
        <div class="row display-table-row">
            <div class="col-md-2 col-sm-1 hidden-xs display-table-cell v-align box" id="navigation">
                <div class="logo">
                    <a hef="home.html"><?php echo "<img src='../".$_SESSION['client_profilepic']."' alt='Trainer profilepic' class='hidden-xs hidden-sm'>"; ?>
                        <?php echo "<img src='../".$_SESSION['client_profilepic']."'' alt='merkery_logo' class='visible-xs visible-sm circle-logo'>"; ?>
                    </a>
                </div>
                <div class="navi">
                    <ul>
                        <li><a href="index.php"><i class="fa fa-home" aria-hidden="true"></i><span class="hidden-xs hidden-sm">Home</span></a></li>
                        <li><a href="trainers.php"><i class="fa fa-tasks" aria-hidden="true"></i><span class="hidden-xs hidden-sm">Trainers</span></a></li>
                        <li><a href="booked.php"><i class="fa fa-bar-chart" aria-hidden="true"></i><span class="hidden-xs hidden-sm">Unpaid Sessions</span></a></li>
                        <li><a href="paid.php"><i class="fa fa-bar-chart" aria-hidden="true"></i><span class="hidden-xs hidden-sm">Paid Sessions</span></a></li>
                        <li><a href="availablegyms.php"><i class="fa fa-user" aria-hidden="true"></i><span class="hidden-xs hidden-sm">Available Gyms</span></a></li>
                      
                        <li class="active"><a href="profile.php"><i class="fa fa-cog" aria-hidden="true"></i><span class="hidden-xs hidden-sm">Profile</span></a></li>
                    </ul>
                </div>
            </div>
            <div class="col-md-10 col-sm-11 display-table-cell v-align">
                <!--<button type="button" class="slide-toggle">Slide Toggle</button> -->
                <div class="row">
                    <header>
                        <div class="col-md-7">
                            <nav class="navbar-default pull-left">
                                <div class="navbar-header">
                                    <button type="button" class="navbar-toggle collapsed" data-toggle="offcanvas" data-target="#side-menu" aria-expanded="false">
                                        <span class="sr-only">Toggle navigation</span>
                                        <span class="icon-bar"></span>
                                        <span class="icon-bar"></span>
                                        <span class="icon-bar"></span>
                                    </button>
                                </div>
                            </nav>
                            <div class="search hidden-xs hidden-sm">
                               <form name="Tick">
<input type="text" size="11" name="Clock">
</form>
<script>
<!--
/*By George Chiang (JK's JavaScript tutorial)
http://javascriptkit.com
Credit must stay intact for use*/
function show(){
var Digital=new Date()
var hours=Digital.getHours()
var minutes=Digital.getMinutes()
var seconds=Digital.getSeconds()
var dn="AM"
if (hours>12){
dn="PM"
hours=hours-12
}
if (hours==0)
hours=12
if (minutes<=9)
minutes="0"+minutes
if (seconds<=9)
seconds="0"+seconds
document.Tick.Clock.value=hours+":"+minutes+":"
+seconds+" "+dn
setTimeout("show()",1000)
}
show()
//-->
</script>
                            </div>
                        </div>
                                                <div class="col-md-5">
                            <div class="header-rightside">
                                <ul class="list-inline header-top pull-right">
                                    <li class="hidden-xs"><a href="logout.php" class="add-project">Logout </a></li>
                                    <li><a href="#"><h4><span>Logged in as <?php echo $_SESSION['client_fname']; ?></span></h4></a></li>
                                   
                                    
                                </ul>
                            </div>
                        </div>

                    </header>
                </div>
                <div class="user-dashboard">
                    <h1>Client</h1>
                                        <span class="error"><?php echo $errors; ?></span>
                    <div class="row">
                      <div class="col-md-3"></div>
                      <div class="col-md-6">
                        <div class="panel-group">
                          <div class="panel panel-primary">
                            <div class="panel-heading">Edit Profile</div>
                            <div class="panel-body">

                              <form class="form" method="post" enctype="multipart/form-data" action="profile.php">
                                                              <?php
                                                              $id =$_SESSION['client_id'];
$sql = "SELECT * FROM clients WHERE client_id='$id'";
$result = mysqli_query($con,$sql);
while($row = mysqli_fetch_array($result))
{
                              ?>
                                <div class="form-group">
                                  <label>First Name:</label>
                                  <input type="text" <?php echo "value='".$row['client_fname']."'"; ?> class="form-control" name="clientFname" required>
                                </div>
                                <div class="form-group">
                                  <label>Last Name:</label>
                                  <input type="text" <?php echo "value='".$row['client_lname']."'"; ?> class="form-control" name="clientLname" required>
                                </div>
                                <div class="form-group">
                                  <label>Password:</label>
                                  <input type="password" <?php echo "value='".$row['client_password']."'"; ?> class="form-control" name="clientPass1" required>
                                </div>
                                <div class="form-group">
                                  <label>Confirm Password:</label>
                                  <input type="password"  class="form-control" name="clientPass2" required>
                                </div>
                                <div class="form-group">
                                  <label>Email:</label>
                                  <input type="email" <?php echo "value='".$row['client_email']."'"; ?> class="form-control" name="clientEmail" required>
                                </div>
                                <div class="form-group">
                                  <label>Phone:</label>
                                  <input type="text" <?php echo "value='".$row['client_phone']."'"; ?> class="form-control" name="clientPhone" required>
                                </div>
                                <div class="form-group">
                                  <label>Address:</label>
                                  <input type="text" <?php echo "value='".$row['client_address']."'"; ?> class="form-control" name="clientAddress" required>
                                </div>
                                <div class="form-group">
                                  <label>Profile Pic:</label>
                                  <input type="file" class="form-control" name="clientProfilepic" required>
                                </div>
                               
                                 <div class="form-group">
                                  <label>Gender</label><br>
                                  <input type="radio" name="gender" value="male"><span>Male</span>
                                  <input type="radio"  name="gender" value="female"><span>Female</span>
                                </div>
                                 <?php
                            }
                              ?>
                              <input type="submit" name="profileupdate" class="add-project" value="Update">
                              </form>
                              
                            </div>
                            <div class="panel-footer"></div>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-3"></div>
                    </div>
    </div>



    <!-- Modal -->
    <div id="add_project" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header login-header">
                    <button type="button" class="close" data-dismiss="modal">×</button>
                    <h4 class="modal-title">Add Project</h4>
                </div>
                <div class="modal-body">
                            <input type="text" placeholder="Project Title" name="name">
                            <input type="text" placeholder="Post of Post" name="mail">
                            <input type="text" placeholder="Author" name="passsword">
                            <textarea placeholder="Desicrption"></textarea>
                    </div>
                <div class="modal-footer">
                    <button type="button" class="cancel" data-dismiss="modal">Close</button>
                    <button type="button" class="add-project" data-dismiss="modal">Save</button>
                </div>
            </div>

        </div>
    </div>
<script type="text/javascript">
	$(document).ready(function(){
   $('[data-toggle="offcanvas"]').click(function(){
       $("#navigation").toggleClass("hidden-xs");
   });
});


</script>
</body>
</html>