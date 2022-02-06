<?php
session_start();
error_reporting(0);
include '../con.php';
if(strlen($_SESSION['adminName'])==0)
  { 
header('location:login.php');
}
if(isset($_REQUEST['gid']))
{
    $gyid = $_GET['gid'];

}
$gymid = $_SESSION['gymid'];
include '../con.php';
$gymName=$gymLocation=$gympic=$gymdesc=$service[]=$contactemail=$contactphone=$profilepicErr='';
if(isset($_POST["editGym"])){
$gymName=$_POST['gymName'];
$gymLocation=$_POST['gymLocation'];
$gymdesc=$_POST['gymdesc'];
$service = $_POST['service'];
$contactemail=$_POST['contactemail'];
$contactphone=$_POST['contactphone'];
$amount = $_POST['amount'];
$facil ="";
foreach ($service as $facility) {
    $facil   .=$facility.","; 
}
$target_dir = "uploads/";
$target_file = $target_dir . basename($_FILES["gympic"]["name"]);
$uploadOk = 1;
$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
// Check if image file is a actual image or fake image

    $check = getimagesize($_FILES["gympic"]["tmp_name"]);
    if($check !== false) {
        
        $uploadOk = 1;
    } else {
        $profilepicErr= "File is not an image."; 
        $uploadOk = 0;
    }

// Check if file already exists
if (file_exists($target_file)) {
   $profilepicErr=  "Sorry, file already exists.";
    $uploadOk = 0;
}
// Check file size
if ($_FILES["gympic"]["size"] > 500000) {
   $profilepicErr=  "Sorry, your file is too large.";
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
    if (move_uploaded_file($_FILES["gympic"]["tmp_name"], $target_file)) {
       
    } else {
       $profilepicErr=  "Sorry, there was an error uploading your file.";
    }
}

$sql = "UPDATE `gym` SET `gym_name`='$gymName',`gym_location`='$gymLocation',`gym_image`='$target_file',`gym_contactemail`='$contactemail',`gym_contactmobile`='$contactphone',`gym_desc`='$gymdesc',`gym_services`='$facil',amount='$amount' WHERE gym_id='$gymid'";
$results=mysqli_query($con,$sql);
if(!$results){
    $profilepicErr="An error occurred";

}else{
    $profilepicErr = "Successful";
    header("location:gyms.php");
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
<script src="../js/jquery.js"></script>

<!-- Latest compiled JavaScript -->
<script src="../js/bootstrap.js"></script>
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
                    <a hef="home.html"><img src="../image/person_1.jpg" alt="merkery_logo" class="hidden-xs hidden-sm">
                        <img src="../image/person_1.jpg" alt="merkery_logo" class="visible-xs visible-sm circle-logo">
                    </a>
                </div>
                <div class="navi">
                    <ul>
                        <li><a href="index.php"><i class="fa fa-home" aria-hidden="true"></i><span class="hidden-xs hidden-sm">Home</span></a></li>
                        <li><a href="trainer.php"><i class="fa fa-user" aria-hidden="true"></i><span class="hidden-xs hidden-sm">Trainer</span></a></li>
                        <li><a href="client.php"><i class="fa fa-user" aria-hidden="true"></i><span class="hidden-xs hidden-sm">Client</span></a></li>
                        <li class="active"><a href="gyms.php"><i class="fa fa-user" aria-hidden="true"></i><span class="hidden-xs hidden-sm">Gyms</span></a></li>
                        
                        <li><a href="logout.php"><i class="fa fa-cog" aria-hidden="true"></i><span class="hidden-xs hidden-sm">Logout</span></a></li>
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
                                    <li><a href="#"><h4><span>Logged in as <?php echo $_SESSION['adminName']; ?></span></h4></a></li>
                                   
                                    
                                </ul>
                            </div>
                        </div>
                    </header>
                </div>
                <div class="user-dashboard">
                    
<div class="row">
  <div class="col-md-3"></div>
  <div class="col-md-6">
    <div class="panel-group">
      <div class="panel panel-primary">
        <div class="panel-heading"></div>
        <div class="panel-body">

<?php
 if(isset($_REQUEST['gid']))
{
    $id = $_GET['gid'];

    $sql = "SELECT `gym_id`, `gym_name`, `gym_location`, `gym_image`, `gym_contactemail`, `gym_contactmobile`, `gym_dateadded`, `gym_desc`, `gym_services` FROM `gym` WHERE gym_id='$id'";
$result = mysqli_query($con,$sql);


while($row = mysqli_fetch_array($result))
{
?>

          <form class="form" enctype="multipart/form-data" method="post" action="editgym.php">


            <div class="form-group">
              <label>Gym Name:</label>
              <input type="text" <?php echo "value='".$row['gym_name']."'"; ?> name="gymName" class="form-control" required>
            </div>
             <div class="form-group">
              <label>Gym Location:</label>
              <input type="text" <?php echo "value='".$row['gym_location']."'"; ?> name="gymLocation" class="form-control" required>
            </div>
             <div class="form-group">
              <label>Gym Email:</label>
              <input type="text" <?php echo "value='".$row['gym_contactemail']."'"; ?> name="contactemail" class="form-control" required>
            </div>
             <div class="form-group">
              <label>Gym Mobile:</label>
              <input type="text" <?php echo "value='".$row['gym_contactmobile']."'"; ?> name="contactphone" class="form-control" required>
            </div>
             <div class="form-group">
              <label>About Gym</label>
            <textarea class="form-control" <?php echo "value='".$row['gym_desc']."'"; ?> name="gymdesc"></textarea>
            </div>
             <div class="form-group">
              <label>Image</label>
              <input type="file" name="gympic" class="form-control" required>
            </div>
             <div class="form-group">
               <span>Facilities</span><br><br>
                           <input style="width:10%;" type="checkbox" name="service[]" value="Jogging">Jogging <br><br>
                           <input style="width:10%;" type="checkbox" name="service[]" value="stretching">stretching <br><br>
                           <input style="width:10%;" type="checkbox" name="service[]" value="Body building">Body Building <br><br>
                           <input style="width:10%;" type="checkbox" name="service[]" value="flexibility">Flexibility <br><br>
                           <input style="width:10%;" type="checkbox" name="service[]" value="slimming">slimming <br>
            </div>
            <input type="submit" name="editGym" class="add-project" value="Update">
           
          </form>
           <?php
          }}

            ?>
        </div>
        <div class="panel-footer"></div>
      </div>
    </div>
  </div>
  <div class="col-md-3"></div>
</div>
    </div>
    <!-- modal edit gym -->
      <div id="edit_gym" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header login-header">
                    <button type="button" class="close" data-dismiss="modal">×</button>
                    <h4 class="modal-title">Edit Gym</h4>
                </div>
                <div class="modal-body">
                    <?php
                    if(isset($_REQUEST['id']))
{
    $id = $_GET['gymid'];
    $sql = "SELECT `gym_id`, `gym_name`, `gym_location`, `gym_image`, `gym_contactemail`, `gym_contactmobile`, `gym_dateadded`, `gym_desc`, `gym_services` FROM `gym` WHERE gym_id='$gymid'";
$result = mysqli_query($con,$sql);
while($row = mysqli_fetch_array($result))
{
?>
                            <form method="post" action="editgym.php" enctype="multipart/form-data" id="modal-details">

                                <input type="text" placeholder="Gym Name" <?php echo "value='".$row['gym_name']."'" ?> name="gymName" >
                            <input type="text" placeholder="Location" name="gymLocation">
                            <span><?php echo $profilepicErr;?></span>
                            <input type="file" name="gympic">
                            <input type="email" placeholder="contact Email" name="contactemail">
                            <input type="phone" placeholder="contact phone" name="contactphone">
                             <input type="number" placeholder="Amount" name="amount">
                            <textarea placeholder="Short Description" name="gymdesc" cols="40" rows="10"></textarea>
                            <span>Facilities</span><br><br>
                           <input style="width:10%;" type="checkbox" name="service[]" value="Jogging">Jogging <br><br>
                           <input style="width:10%;" type="checkbox" name="service[]" value="stretching">stretching <br><br>
                           <input style="width:10%;" type="checkbox" name="service[]" value="Body building">Body Building <br><br>
                           <input style="width:10%;" type="checkbox" name="service[]" value="flexibility">Flexibility <br><br>
                           <input style="width:10%;" type="checkbox" name="service[]" value="slimming">slimming <br>
                           <?php
                           }}
?>
                            </form>
                           
                    </div>
                <div class="modal-footer">
                    <button type="button" class="cancel" data-dismiss="modal">Close</button>
                    <input type="submit" class="add-project" value="Save" form="modal-details" name="gymdata">
                </div>
            </div>

        </div>
    </div>



    <!-- Modal -->
    <div id="add_gym" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header login-header">
                    <button type="button" class="close" data-dismiss="modal">×</button>
                    <h4 class="modal-title">Add Gym</h4>
                </div>
                <div class="modal-body">
                            <form method="post" action="gyms.php" enctype="multipart/form-data" id="modal-details">

                                <input type="text" placeholder="Gym Name"  name="gymName" >
                            <input type="text" placeholder="Location" name="gymLocation">
                            <span><?php echo $profilepicErr;?></span>
                            <input type="file" name="gympic">
                            <input type="email" placeholder="contact Email" name="contactemail">
                            <input type="phone" placeholder="contact phone" name="contactphone">
                            <textarea placeholder="Short Description" name="gymdesc" cols="40" rows="10"></textarea>
                            <span>Facilities</span><br><br>
                           <input style="width:10%;" type="checkbox" name="service[]" value="Jogging">Jogging <br><br>
                           <input style="width:10%;" type="checkbox" name="service[]" value="stretching">stretching <br><br>
                           <input style="width:10%;" type="checkbox" name="service[]" value="Body building">Body Building <br><br>
                           <input style="width:10%;" type="checkbox" name="service[]" value="flexibility">Flexibility <br><br>
                           <input style="width:10%;" type="checkbox" name="service[]" value="slimming">slimming <br>
                            </form>
                           
                    </div>
                <div class="modal-footer">
                    <button type="button" class="cancel" data-dismiss="modal">Close</button>
                    <input type="submit" class="add-project" value="Save" form="modal-details" name="gymdata">
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
