<?php
session_start();
error_reporting(0);
include '../con.php';
if(strlen($_SESSION['adminName'])==0)
  { 
header('location:login.php');
}
include '../con.php';
$id = $_GET['id'];
$sql = "SELECT `review_id`, `trainer_id`, `client_fname`, `client_lname`, `review`, `review_date` FROM `reviews` WHERE trainer_id='$id";
$query = mysqli_query($con,$sql);
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
                    <a hef="home.html"><img src="../image/person_1.jpg" alt="merkery_logo" class="hidden-xs hidden-sm">
                        <img src="../image/person_1.jpg" alt="merkery_logo" class="visible-xs visible-sm circle-logo">
                    </a>
                </div>
                <div class="navi">
                    <ul>
                        <li><a href="index.php"><i class="fa fa-home" aria-hidden="true"></i><span class="hidden-xs hidden-sm">Home</span></a></li>
                        <li class="active"><a href="trainer.php"><i class="fa fa-user" aria-hidden="true"></i><span class="hidden-xs hidden-sm">Trainer</span></a></li>
                        <li><a href="client.php"><i class="fa fa-user" aria-hidden="true"></i><span class="hidden-xs hidden-sm">Client</span></a></li>
                        <li><a href="gyms.php"><i class="fa fa-user" aria-hidden="true"></i><span class="hidden-xs hidden-sm">Gyms</span></a></li>
                        
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
                                    <li><a href="#"><h4><span>Logged in as <?php echo $_SESSION['adminName']; ?></span></h4></a></li>
                                   
                                    
                                </ul>
                            </div>
                        </div>
                    </header>
                </div>
                <div class="user-dashboard">
<div class="row bootstrap snippets">
    <?php
                include '../con.php';
                 
                $sql = "SELECT `review_id`, `trainer_id`, `client_fname`, `client_lname`, `client_profilepic`, `review`, `review_date` FROM `reviews` WHERE trainer_id='$id'";
                $result = mysqli_query($con,$sql);
                while($row = mysqli_fetch_array($result))
{
    echo "<div class='col-md-12  col-sm-12'>";
    echo "<div class='comment-wrapper'>";
    echo "<div class='panel panel-info'>";
    echo "<div class='panel-body'>";
    echo "<div class='clearfix'></div>";
    echo "<hr>";
    echo "<ul class='media-list'>";
    echo "<a href='#' class='pull-left'>";
    echo "<img src='../".$row['client_profilepic']."' width='100px' height='100px' alt='' class='img-circle'>";
    echo "</a>";
    echo "<div class='media-body'>";
    echo "<span class='text-muted pull-right'>";
    echo "<small class='text-muted'>".$row['review_date']."</small>";
    echo "</span>";
    echo "<strong class='text-success'>".$row['client_fname']." ".$row['client_lname']."</strong>";
    echo "<p>
                                    ".$row['review']."
                                </p>";
 echo " </div>";
 echo " </li>";
 echo "</ul>";
 echo "</div>";
  echo "</div>";
   echo "</div>";
    echo "</div>";

    }
                ?>

</div>
  
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