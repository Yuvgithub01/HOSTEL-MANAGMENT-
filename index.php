<?php
// $insert = false;
if(isset($_POST['name'])){
    // Set connection variables
    $server = "localhost";
    $username = "root";
    $password = "";

    // Create a database connection
    $con = mysqli_connect($server, $username, $password);

    // Check for connection success
    if(!$con){
        die("connection to this database failed due to" . mysqli_connect_error());
    }
    // echo "Success connecting to the db";

    // Collect post variables
    $name = $_POST['name'];
    $email = $_POST['email'];
    $username = $_POST['username'];
    $phone = $_POST['phone'];
    $password = $_POST['password'];
    $sql = "INSERT INTO `hostel_management`.`warden` (`name`, `email`,`username`, `phone`, `password`) VALUES ('$name', '$email', '$username', '$phone', '$password');";
    //database table name
    // echo $sql;

    // Execute the query
    if($con->query($sql) == true){
        // echo "Successfully inserted";

        // Flag for successful insertion
        // $insert = true;
        header("Location: index3.php");
    }
    else{
        echo "ERROR: $sql <br> $con->error";
    }

    // Close the database connection
    $con->close();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Warden Register</title>
    <link rel="stylesheet" href="style1.css">
</head>
<body>
    <div class="container">
        
       <h1>Warden SignUp</h1>
        <form action="index.php" method="post">
            <input type="text" name="name" id="name" placeholder="Name">
            <input type="email" name="email" id="email" placeholder="Email id">
            <input type="text" name="username" id="username" placeholder="Username">
            <input type="number" name="phone" id="phone" placeholder="Phone number">
            <input type="text" name="password" id="password" placeholder="Password">
            <button class="btn">Submit</button> 
        </form>
        <p>Already Have an Account then <a href="index2.php">Login</a></p>
    </div>
</body>
</html>