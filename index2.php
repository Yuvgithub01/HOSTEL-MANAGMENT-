<?php
$check=false;
if(isset($_POST['username'])){

// Set connection variables
$server = "localhost";
$username = "root";
$password = "";
$database = "hostel_management"; // your database name

// Create a database connection
$con = mysqli_connect($server, $username, $password,$database);

// Check for connection success
if(!$con){
    die("Connection to the database failed due to: " . mysqli_connect_error());
}

// Collect post variables
$username = $_POST['username'];
$password = $_POST['password'];

// Secure the input
$username = mysqli_real_escape_string($con, $username);
$password = mysqli_real_escape_string($con, $password);

// // Hash the password (assuming you're storing hashed passwords)
// $password = md5($password);

// Prepare SQL query to fetch user details
$sql = "SELECT * FROM warden WHERE username='$username' AND password='$password'";
$result = mysqli_query($con, $sql);

// Check if user exists
if(mysqli_num_rows($result)){
    // User found, redirect to dashboard or whatever page you want
    // $_SESSION['username'] = $username; // Store username in session for further use
    header("Location: index3.php"); // Redirect to dashboard page
    exit();
} else {
    // User not found, redirect back to login page with an error message
    // $_SESSION['error'] = "Invalid username or password!";
    $check=true;
    header("Location: index2.php");
    exit();
}

// Close the database connection
mysqli_close($con);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Warden Login</title>
    <link rel="stylesheet" href="style1.css">
</head>
<body>
    <div class="container">
        <h1>Warden Login</h1>
        <?php 
            if($check==true)echo"<p class='.msg'> Invalid Username or Password</p> ";
            ?>
        <form action="index2.php" method="post">
            <input type="text" name="username" id="username" placeholder="Username" required>
            <input type="text" name="password" id="password" placeholder="Password" required>
            <button class="btn" type="submit">Login</button> 
        </form>
    </div>
</body>
</html>
