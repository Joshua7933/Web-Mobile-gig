<?php
session_start();
error_reporting(0);
include '../con.php';
if(strlen($_SESSION['login'])==0)
  { 
header('location:../login.php');
}

if(isset($_POST["transact"])){
$amountToPay = $_POST['amountInput'];

$mobileNumber = $_POST['mobileNumber'];

$idno = $_POST['idtransact'];

$consumerKey = "xYWUtQG6bqVazyCAF9YeKZwyYwPKUbVu";
  $consumerSecret = "lb0AdC9dYvRC3mma";
    $headers = ['Content-Type:application/json; charset=utf8'];

    $url = 'https://sandbox.safaricom.co.ke/oauth/v1/generate?grant_type=client_credentials';

    $curl = curl_init($url);
    curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
    curl_setopt($curl, CURLOPT_HEADER, FALSE);
    curl_setopt($curl, CURLOPT_USERPWD, $consumerKey.':'.$consumerSecret);
    $result = curl_exec($curl);
    $status = curl_getinfo($curl, CURLINFO_HTTP_CODE);
    $result = json_decode($result);

    $access_token = $result->access_token;

  $url = 'https://sandbox.safaricom.co.ke/mpesa/stkpush/v1/processrequest';
  $BusinessShortCode = '174379';
  $Passkey = 'bfb279f9aa9bdbcf158e97dd71a467cd2e0c893059b10f78e6b72ada1ed2c919';  
  
  /*
    This are your info, for
    $PartyA should be the ACTUAL clients phone number or your phone number, format 2547********
    $AccountRefference, it maybe invoice number, account number etc on production systems, but for test just put anything
    TransactionDesc can be anything, probably a better description of or the transaction
    $Amount this is the total invoiced amount, Any amount here will be 
    actually deducted from a clients side/your test phone number once the PIN has been entered to authorize the transaction. 
    for developer/test accounts, this money will be reversed automatically by midnight.
  */
  
  $PartyA = strval( $mobileNumber ) ;// This is your phone number, 
  $AccountReference = 'Inv234';
  $TransactionDesc = 'Pay Gym and Trainer';
  $Amount = strval( $amountToPay ) ;;
 
  # Get the timestamp, format YYYYmmddhms -> 20181004151020
  $Timestamp = date('YmdHis');    
  
  # Get the base64 encoded string -> $password. The passkey is the M-PESA Public Key
  $Password = base64_encode($BusinessShortCode.$Passkey.$Timestamp);

  $CallBackURL = 'http://josh.unaux.com/callback_url.php';  
  $curl = curl_init();
  curl_setopt($curl, CURLOPT_URL, $url);
  curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type:application/json','Authorization:Bearer '.$access_token)); //setting custom header
  
  
  $curl_post_data = array(
    //Fill in the request parameters with valid values
    'BusinessShortCode' => $BusinessShortCode,
    'Password' => $Password,
    'Timestamp' => $Timestamp,
    'TransactionType' => 'CustomerPayBillOnline',
    'Amount' => $Amount,
    'PartyA' => $PartyA,
    'PartyB' => $BusinessShortCode,
    'PhoneNumber' => $PartyA,
    'CallBackURL' => $CallBackURL,
    'AccountReference' => $AccountReference,
    'TransactionDesc' => $TransactionDesc
  );
  
  $data_string = json_encode($curl_post_data);
  
  curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($curl, CURLOPT_POST, true);
  curl_setopt($curl, CURLOPT_POSTFIELDS, $data_string);
  
  $curl_response = curl_exec($curl);

  



$sql =  "SELECT * FROM `bookedschedules` WHERE  bschedule_id='$idno'";
      $result = mysqli_query($con,$sql);
     while($row = mysqli_fetch_assoc($result)) { 
$s_id = $row['bschedule_id'];
$t_id = $row['trainer_id'];
$t_name = $row['trainer_name'];
$c_name = $row['client_name'];
$date = $row['date'];
$s_time = $row['start_time'];
$e_time = $row['end_time'];
$g_name = $row['gym_name'];
$g_location = $row['gym_location'];
$amount = $row['amount'];

}
$sql = "INSERT INTO `Paid`(`paid_id`, `booked_id`, `trainer_id`, `trainer_name`, `client_name`, `date`, `start_time`, `end_time`, `gym_name`, `gym_location`, `amount_paid`, `date_paid`) VALUES (NULL,'$s_id','$t_id','$t_name','$c_name','$date','$s_time','$e_time','g_name','$g_location','$amountToPay',NOW())";
$result = mysqli_query($con,$sql);
if(!$result)
{
    echo "Something went wrong";
}
$sql ="DELETE FROM `bookedschedules` WHERE bschedule_id ='$idno'";
$result = mysqli_query($con,$sql);

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
                          <li class="active"><a href="booked.php"><i class="fa fa-bar-chart" aria-hidden="true"></i><span class="hidden-xs hidden-sm">Unpaid Sessions</span></a></li>
                        <li><a href="paid.php"><i class="fa fa-bar-chart" aria-hidden="true"></i><span class="hidden-xs hidden-sm">Paid Sessions</span></a></li>
                        <li><a href="availablegyms.php"><i class="fa fa-user" aria-hidden="true"></i><span class="hidden-xs hidden-sm">Available Gyms</span></a></li>
                       
                        <li><a href="profile.php"><i class="fa fa-cog" aria-hidden="true"></i><span class="hidden-xs hidden-sm">Profile</span></a></li>
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
                    <h1>Approved sessions</h1>
                    <table id="example" class="table table-striped table-bordered table-hover table-condensed display" width="100%">
    <thead>
       <tr>
           <th>Trainer Name</th>
           <th>Date</th>
           <th>From</th>
           <th>To</th>
           <th>Gym Name</th>
           <th>Gym Location</th>
           <th>Booked on</th>
           <th>action</th>
           
       </tr>
    </thead>
    <tbody>
        <?php
        include '../con.php';
        $name =$_SESSION['client_fname'];
            $sql = "SELECT * FROM bookedschedules WHERE client_name='$name'";
            $result = mysqli_query($con, $sql);
            if (mysqli_num_rows($result) > 0) {
    // output data of each row
    while($row = mysqli_fetch_assoc($result)) { 

        ?>
        <tr>                                                                
            
           <td><?php echo $row['trainer_name']; ?></td>
            <td><?php echo $row['date']; ?></td>
            <td><?php echo $row['start_time']; ?></td>
            <td><?php echo $row['end_time']; ?></td>
            <td><?php echo $row['gym_name']; ?></td>
             <td><?php echo $row['gym_location']; ?></td>
            <td><?php echo $row['datebooked']; ?></td>
            <td><a href="#" data-toggle="modal" data-target="#add_project" class="add-project">Pay </a></td>
          
           
             <div id="add_project" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header login-header">
                    <button type="button" class="close" data-dismiss="modal">×</button>
                    <h4 class="modal-title">Lipa Na Mpesa Ksh. <?php echo $row['amount']; ?></h4>
                </div>
                
                <div class="modal-body">
                    <form method="post" action="booked.php" id="modal-details">
                            <input type="text" placeholder="254798000000"  name="mobileNumber" >
                            <input type="text" value="<?php echo $row['amount']; ?>" name="amountInput" hidden>
                            <input type="text" hidden value="<?php echo $row['bschedule_id']; ?>" name="idtransact">
                             </form>
                            
                    </div>
                <div class="modal-footer">
                    <button type="button" class="cancel" data-dismiss="modal">Close</button>
                    <input type="submit" class="add-project" value="Pay" form="modal-details" name="transact">
                </div>
               
            </div>

        </div>
    </div>
            
        </tr>

        <?php
 }
}
else
{
 ?>
 <tr>
 <th colspan="2">There's No data found!!!</th>
 </tr>
 <?php
}
?>
    </tbody>
</table>
    </div>



    <!-- Modal -->
   
<script type="text/javascript">
	$(document).ready(function(){
   $('[data-toggle="offcanvas"]').click(function(){
       $("#navigation").toggleClass("hidden-xs");
   });
});


</script>
</body>
</html>