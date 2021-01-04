<?php
session_start();
?>

<!DOCTYPE html>
<html>
<head>
	<title>Login</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <?php include 'config.php'; 
include 'connection.php';
?>
</head>
<body>
 <div class="div1" style="margin-top: 10%;">
    <h1>Admin Login</h1>
    <form action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" method="POST" name="register">
        <div class="form-group">
            <label for="username">User Name</label>
            <input type="text" class="form-control" name="username"  placeholder="username.." required>
            
        </div>
        
        <div class="form-group">
            <label for="name">Password</label>
            <input type="password" class="form-control" name="txtpassword"  placeholder="password" required>
            
        </div>
        <input type="submit" name="submit" value="Login" class="btn btn-primary">
    </form>
</div>
<?php
if(isset($_POST['submit'])){
    $username = $_POST['username'];
    $password = $_POST['txtpassword'];

    $query_email="select * from admin where username='$username'";
    $res= $conn->query($query_email);
    if($res->num_rows>0){
        $data= $res->fetch_assoc();
        $dbpass = $data['password'];
        $_SESSION['username']= $data['username'];

        if ($dbpass === $password) {
            echo "<script> alert('Login successful') 
            location.replace('adminhome.php');
            </script>";
        }
        else{
            echo "<script> alert('Password wrong!') </script>";
        }
    }
    else{
        echo "<script> alert('Email not registered!');</script>";
    }
}
?>
</body>
</html>