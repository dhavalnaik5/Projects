<?php
include 'config.php';
session_start();
error_reporting(0);
if(isset($_SESSION['uname'])){
    header("Location: Home.php");
}

if(isset($_POST['submit']))
{
    $uname = $_POST['uname'];
    $password = $_POST['password'];
    $sql = "SELECT * FROM users WHERE uname='$uname' AND password='$password'";
    $result = mysqli_query($conn,$sql);
    if($result->num_rows > 0){
        $row = mysqli_fetch_assoc($result);
        $_SESSION['uname'] = $row['uname'];
        header("Location: index.php");
    }else{
        echo "<script>alert('Wrong uname or Password.')</script>";
    }

$inactive = 10; 
ini_set('session.gc_maxlifetime', $inactive); // set the session max lifetime to 2 hours
session_start();

if (isset($_SESSION['testing']) && (time() - $_SESSION['testing'] > $inactive)) {
    // last request was more than 2 hours ago
    session_unset();     // unset $_SESSION variable for this page
    session_destroy();   // destroy session data
}
$_SESSION['testing'] = time(); // Update session
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
	<script src="login.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="loginreg.css">
	<!--Google font - Roboto Mono-->
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Roboto+Mono:wght@300&display=swap" rel="stylesheet">
    <title>Login</title>
</head>
<body>
    <div class="container">
        <form action="" method="POST" class="login-email">
            <p class="login-text" style="font-size: 2rem; font-weight: 800;">Login</p>
            <!--username-->
			<div class="input-group">
                <input type="text" placeholder="User Name" name="uname" value="<?php echo $uname; ?>" required>
            </div>
			<!--password-->
            <div class="input-group">
                <input type="password" placeholder="Password" name="password" value="<?php echo $_POST['password']; ?>" required>
            </div>
			<!--submit button-->
            <div class="input-group">
                <button name="submit" class="btn" onclick="register()">Login</button>
            </div>
            <p class="login-register-text">Don't have an account? <a href="register.php">Register Here</a></p>
        </form>
    </div>
</body>
</html>