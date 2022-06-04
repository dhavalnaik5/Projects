<?php
include 'config.php';
error_reporting(0);
session_start();
if(isset($_SESSION['uname'])){
    //header("Location: Home.php");
}

if(isset($_POST['submit'])){
    $iname = $_POST['iname'];
    $quantity = $_POST['quantity'];
    $address = $_POST['address'];

    if(isset($_SESSION['uname'])){
        $result = mysqli_query($conn,$sql);
        if(!$stock < 0)
		{
            $sql = "INSERT INTO orders (uname,iname,quantity,address)
                VALUES('$uname','$iname','$quantity','$address)";
            $result = mysqli_query($conn,$sql);
            if($result)
			{
                echo "<script>alert('Thank you! Your Order has been Placed!')</script>";
                $uname = "";
                $email = "";
                $address = "";
            }
			else
			{
                echo "<script>alert('Something Went Wrong.')</script>";
            }
            
        }else{
            echo "<script>alert('Sorry We are out of these!')</script>";
        }
        
    }else{
        echo "<script>alert('LOGIN TO PLACE ORDER.')</script>";
    }
	

}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7
.0/css/font-awesome.min.css">

    <link rel="stylesheet" type="text/css" href="loginreg.css">

    <title>Place Order</title>
</head>
<body>
    <div class="container">
        <form action="" method="POST" class="login-email">
        <p class="login-text" style="font-size: 2rem; font-weight: 800;">ORDER</p>
            <div class="input-group">
                <input type="text" placeholder="Enter User Name" name="uname" value="<?php echo $iname; ?>" required>
            </div>
            <div class="input-group">
                <input type="text" placeholder="Enter Product Name" name="iname" value="<?php echo $_POST['iname']; ?>" required>
            </div>
			<div class="input-group">
                <input type="number" placeholder="Enter Quantity" name="quantity" value="<?php echo $_POST['quantity']; ?>" required>
            </div>
            <div class="input-group">
                <input type="text" placeholder="Enter Address" name="address" value="<?php echo $_POST['address']; ?>" required>
            </div>
            <div class="input-group">
                <button name="submit" class="btn">Place Order</button>
            </div>
            <p class="login-register-text">Want to Place Order? <a href="index.php">Login Here</a></p>
        </form>
    </div>
</body>
</html>