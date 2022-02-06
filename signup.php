<?php
include 'con.php';
// initializing variables
// define variables and set to empty values

$fnameErr = $lnameErr = $emailErr = $genderErr = $passErr = $profilepicErr = $phoneErr = $addressErr = $confPassErr = $servicesErr = $descErr = "";
$fname = $lname = $email = $gender = $pass = $phone = $address = $profilepic = $checkbox =   $confPass = $services = $desc = "";
if(isset($_POST["regTrainer"])) {
$target_dir = "trainer/uploads/";
$target_file = $target_dir . basename($_FILES["trainerProfilePic"]["name"]);
$uploadOk = 1;
$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
// Check if image file is a actual image or fake image

    $check = getimagesize($_FILES["trainerProfilePic"]["tmp_name"]);
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
if ($_FILES["trainerProfilePic"]["size"] > 500000) {
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
    if (move_uploaded_file($_FILES["trainerProfilePic"]["tmp_name"], $target_file)) {
        
    } else {
        $profilepicErr=  "Sorry, there was an error uploading your file.";
    }
}

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
  if (empty($_POST["trainerFName"])) {
    $fnameErr = "First Name is required";
  } else {
    $fname = test_input($_POST["trainerFName"]);
    if (!preg_match("/^[a-zA-Z ]*$/",$fname)) {
  $fnameErr = "Only letters and white space allowed";
}
  }

  if (empty($_POST["trainerLName"])) {
    $lnameErr = "Last name is required";
  } else {
    $lname = test_input($_POST["trainerLName"]);
    if (!preg_match("/^[a-zA-Z ]*$/",$lname)) {
  $lnameErr = "Only letters and white space allowed";
}
  }
  if (empty($_POST["trainerPass"])) {
    $passErr = "Password is required";
  } else {
    $pass = test_input($_POST["trainerPass"]);
  }

  if (empty($_POST["trainerConfirmPass"])) {
    $confPassErr = "Password confirmation is required";
  }else if($pass!=$_POST["clientConfirmPass"]){
  	$confPassErr = "The two passwords do not match";
  }
   else {
    $confPass = test_input($_POST["trainerConfirmPass"]);
  }
   if (empty($_POST["trainerEmail"])) {
    $emailErr = "Email is required";
  } else {
    $email = test_input($_POST["trainerEmail"]);
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
  $emailErr = "Invalid email format";
}

  }
   if (empty($_POST["trainerPhone"])) {
    $phoneErr = "Phone number is required";
  } else {
    $phone = test_input($_POST["trainerPhone"]);
  }
   if (empty($_POST["trainerAddress"])) {
    $addressErr = "Address is required";
  } else {
    $address = test_input($_POST["trainerAddress"]);
  }

  if (empty($_POST["trainerProfilePic"])) {
    $profilepicErr = "";
  } else {
    $profilepic = test_input($_POST["trainerProfilePic"]);
  }

  if (empty($_POST["gender"])) {
    $genderErr = "Gender is required";
  } else {
    $gender = test_input($_POST["gender"]);
  }
   if (empty($_POST["trainerservice[]"])) {
    $serviceErr = "Services are required";
  } else {
    $service = $_POST["trainerservice"];
  }
  if (empty($_POST["shortdescription"])) {
    $descErr = "Description is required";
  } else {
    $desc = test_input($_POST["shortdescription"]);
  }





	$sql = "INSERT INTO `trainers`(`trainer_id`, `trainer_fname`, `trainer_lname`, `trainer_pass`, `trainer_email`, `trainer_phone`, `trainer_address`, `trainer_profilepic`, `trainer_gender`, `trainer_shortdesc`, `date_joined`) VALUES (NULL,'$fname','$lname','$pass','$email','$phone','$address','$target_file','$gender','$desc',NOW())";
	echo $sql;
$result = mysqli_query($con, $sql);
if(!$result)
{
	$fnameErr = "An errror occurred";
}else{
$fnameErr = "successful";
}


}

else if ($_SERVER["REQUEST_METHOD"] == "POST"){
	

$target_dir = "client/uploads/";
$target_file = $target_dir . basename($_FILES["clientProfilePic"]["name"]);
$uploadOk = 1;
$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
// Check if image file is a actual image or fake image

    $check = getimagesize($_FILES["clientProfilePic"]["tmp_name"]);
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
if ($_FILES["clientProfilePic"]["size"] > 500000) {
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
    if (move_uploaded_file($_FILES["clientProfilePic"]["tmp_name"], $target_file)) {
       
    } else {
       $profilepicErr=  "Sorry, there was an error uploading your file.";
    }
}

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
if (empty($_POST["clientFName"])) {
    $fnameErr = "First Name is required";
  } else {
    $fname = test_input($_POST["clientFName"]);
    if (!preg_match("/^[a-zA-Z ]*$/",$fname)) {
  $fnameErr = "Only letters and white space allowed";
}
  }

  if (empty($_POST["clientLName"])) {
    $lnameErr = "Last name is required";
  } else {
    $lname = test_input($_POST["clientLName"]);
    if (!preg_match("/^[a-zA-Z ]*$/",$lname)) {
  $lnameErr = "Only letters and white space allowed";
}
  }
  if (empty($_POST["clientPass"])) {
    $passErr = "Password is required";
  } else {
    $pass = test_input($_POST["clientPass"]);
  }

  if (empty($_POST["clientConfirmPass"])) {
    $confPassErr = "Password confirmation is required";
  }else if($pass!=$_POST["clientConfirmPass"]){
  	$confPassErr = "The two passwords do not match";
  }
   else {
    $confPass = test_input($_POST["clientConfirmPass"]);
  }
   if (empty($_POST["clientEmail"])) {
    $emailErr = "Email is required";
  } else {
    $email = test_input($_POST["clientEmail"]);
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
  $emailErr = "Invalid email format";
}

  }
   if (empty($_POST["clientPhone"])) {
    $phoneErr = "Phone number is required";
  } else {
    $phone = test_input($_POST["clientPhone"]);
  }
   if (empty($_POST["clientAdddress"])) {
    $addressErr = "Address is required";
  } else {
    $address = test_input($_POST["clientAdddress"]);
  }
  if (empty($_POST["clientgender"])) {
    $genderErr = "Gender is required";
  } else {
    $gender = test_input($_POST["clientgender"]);
  }
  $sql = "INSERT INTO `clients`(`client_id`, `client_fname`, `client_lname`, `client_email`, `client_phone`, `client_address`, `client_password`, `client_gender`, `client_profilepic`, `date_joined`) VALUES (NULL,'$fname','$lname','$email','$phone','$address','$pass','$gender','$target_file',NOW())";
	echo $sql;
$result = mysqli_query($con, $sql);
if(!$result)
{
	$fnameErr = "An errror occurred";
}else{
$fnameErr = "successful";
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
                        <p>Create an account</p>
                        <a href="login.php"><input type="submit" name="" value="Login"/><br/></a>
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
                                <h3 class="register-heading">Apply as a Trainer</h3>
                                <form method="post" action="signup.php" enctype="multipart/form-data">
                                <div class="row register-form">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                        	<span class="error">* <?php echo $fnameErr;?></span>
                                            <input type="text" class="form-control" placeholder="First Name *" name="trainerFName" value="" />
                                        </div>
                                        <div class="form-group">
                                        	<span class="error">* <?php echo $lnameErr;?></span>
                                            <input type="text" class="form-control" placeholder="Last Name *" name="trainerLName" value="" />
                                        </div>
                                        <div class="form-group">
                                        	<span class="error">* <?php echo $passErr;?></span>
                                            <input type="password" class="form-control" placeholder="Password *" name="trainerPass" value="" />
                                        </div>
                                        <div class="form-group">
                                        	<span class="error">* <?php echo $confPassErr;?></span>
                                            <input type="password" class="form-control"  placeholder="Confirm Password *" name="trainerConfirmPass" value="" />
                                        </div>
                                             <div class="form-group">
                                        	<span class="error">* <?php echo $emailErr;?></span>
                                            <input type="email" class="form-control" placeholder="Your Email *" name="trainerEmail" value="" />
                                        </div>
                                        <div class="form-group">
                                        	<span class="error">* <?php echo $phoneErr;?></span>
                                            <input type="text" minlength="10" maxlength="10" name="trainerPhone" class="form-control" placeholder="Your Phone *" value="" />
                                        </div>
                                       
                                    </div>
                                    <div class="col-md-6">

                                        
                                         <div class="form-group">
                                         	<span class="error">* <?php echo $addressErr;?></span>
                                            <input type="text" class="form-control" placeholder="Your Address *" name="trainerAddress" value="" />
                                        </div>
                                        
                                    	<div class="form-group">
                                    		<span class="error">* <?php echo $profilepicErr;?></span>
                                            <input type="file" class="form-control" value="ProfilePic" id="Pic" placeholder="Pic"  name="trainerProfilePic" />
                                        </div>
                                        <div class="form-group">
                                        	<span class="error">* <?php echo $genderErr;?></span>
                                            <div class="maxl">
                                                <label class="radio inline"> 
                                                    <input type="radio" name="gender" <?php if (isset($gender) && $gender=="male") echo "checked";?> value="male" checked>
                                                    <span> Male </span> 
                                                </label>
                                                <label class="radio inline"> 
                                                    <input type="radio" name="gender" <?php if (isset($gender) && $gender=="female") echo "checked";?>value="female">
                                                    <span>Female </span> 
                                                </label>
                                            </div>
                                        </div>
                                         
                                        <div class="form-group">
                                        	<span class="error">* <?php echo $descErr;?></span>
                                        	<textarea class="form-control" name="shortdescription" rows="3" cols="35"></textarea>
                                        </div>
                                        <input type="submit" name="regTrainer" class="btnRegister"  value="Register"/>
                                    </div>
                                </div>
                                </form>
                            </div>
                            <div class="tab-pane fade show" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                                <h3  class="register-heading">Apply as a Client</h3>
                                <form method="post" action="signup.php#profile" enctype="multipart/form-data">
                                <div class="row register-form">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                        	<span class="error">* <?php echo $fnameErr;?></span>
                                            <input type="text" class="form-control" placeholder="First Name *" name="clientFName" value="" />
                                        </div>
                                        <div class="form-group">
                                        	<span class="error">* <?php echo $lnameErr;?></span>
                                            <input type="text" name="clientLName" class="form-control" placeholder="Last Name *" value="" />
                                        </div>
                                        <div class="form-group">
                                        	<span class="error">* <?php echo $emailErr;?></span>
                                            <input type="email" name="clientEmail" class="form-control" placeholder="Email *" value="" />
                                        </div>
                                        <div class="form-group">
                                        	<span class="error">* <?php echo $phoneErr;?></span>
                                            <input type="text" name="clientPhone" maxlength="10" minlength="10" class="form-control" placeholder="Phone *" value="" />
                                        </div>
                                         <div class="form-group">
                                         	<span class="error">* <?php echo $addressErr;?></span>
                                            <input type="text" name="clientAdddress" class="form-control" placeholder="`Address *" value="" />
                                        </div>

                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                        	<span class="error">* <?php echo $passErr;?></span>
                                            <input type="password" class="form-control" placeholder="Password *" name="clientPass" value="" />
                                        </div>
                                        <div class="form-group">
                                        	<span class="error">* <?php echo $confPassErr;?></span>
                                            <input type="password" class="form-control" placeholder="Confirm Password *" name="clientConfirmPass" value="" />
                                        </div>
                                        
                                       
                                        <div class="form-group">
                                        	<span class="error">* <?php echo $genderErr;?></span>
                                            <div class="maxl">
                                                <label class="radio inline"> 
                                                    <input type="radio" name="clientgender" <?php if (isset($gender) && $gender=="male") echo "checked";?> value="male" checked>
                                                    <span> Male </span> 
                                                </label>
                                                <label class="radio inline"> 
                                                    <input type="radio" name="clientgender" <?php if (isset($gender) && $gender=="female") echo "checked";?>value="female">
                                                    <span>Female </span> 
                                                </label>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                    		<span class="error">* <?php echo $profilepicErr;?></span>
                                            <input type="file" class="form-control" value="ProfilePic" id="Pic" placeholder="Pic"  name="clientProfilePic" />
                                        </div>
                                        <input type="submit" name="regClient" class="btnRegister"  value="Register"/>
                                    </div>
                                </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
</body>
</html>
