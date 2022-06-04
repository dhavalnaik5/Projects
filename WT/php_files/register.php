<?php
include 'config.php';
error_reporting(0);
session_start();
if(isset($_SESSION['username'])){
    header("Location: index.php");
}

if(isset($_POST['submit'])){
    $uname = $_POST['uname'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $cpassword = $_POST['cpassword'];

    if($password == $cpassword){
        $sql = "SELECT * FROM users WHERE uname='$uname'";
        $result = mysqli_query($conn,$sql);
        if(!$result->num_rows > 0)
		{
            $sql = "INSERT INTO users (uname,email,password,cpassword)
                VALUES('$uname','$email','$password','$cpassword')";
            $result = mysqli_query($conn,$sql);
            if($result)
			{
                echo "<script>alert('User Registered')</script>";
                $uname = "";
                $email = "";
                $_POST['password'] = "";
                $_POST['cpassword'] = "";
            }
			else
			{
                echo "<script>alert('Something Went Wrong.')</script>";
            }
            
        }else{
            echo "<script>alert('Email Already Exists')</script>";
        }
        
    }else{
        echo "<script>alert('Password Not Matched.')</script>";
    }

}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://fonts.googleapis.com/css2?family=Roboto+Mono:wght@300&display=swap" rel="stylesheet">

    <link rel="stylesheet" type="text/css" href="loginreg.css">

    <title>Register</title>
</head>
<body>
    <div class="container">
        <form action="" method="POST" class="login-email">
        <p class="login-text" style="font-size: 2rem; font-weight: 800;">Register</p>
            <div class="input-group">
                <input type="text" placeholder="Enter User Name" name="uname" value="<?php echo $srn; ?>" required>
            </div>
            <div class="input-group">
                <input type="email" placeholder="Enter Email" name="email" value="<?php echo $email; ?>" required>
            </div>
            <div class="input-group">
                <input type="password" placeholder="Enter Password" name="password" value="<?php echo $_POST['password']; ?>" required>
            </div>
            <div class="input-group">
                <input type="password" placeholder="Confirm Password" name="cpassword" value="<?php echo $_POST['cpassword']; ?>" required>
            </div>
            <div class="input-group">
                <button name="submit" class="btn">Register</button>
            </div>
            <p class="login-register-text">Already have an account? <a href="index.php">Login Here</a></p>
        </form>
    </div>
</body>
</html>