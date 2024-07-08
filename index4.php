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
    $enrollment_no = $_POST['enrollment_no'];
    $enrollment_year = $_POST['enrollment_year'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $room_no = $_POST['room_no'];
    $room_type = $_POST['room_type'];
    
    $sql = "INSERT INTO `hostel_management`.`allocate_room` (`enrollment_no`,`enrollment_year`, `name`,`email`, `phone`, `room_no`,`room_type`) VALUES ('$enrollment_no', '$enrollment_year', '$name', '$email', '$phone','$room_no','$room_type');";
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
        
       <h1>Enter the details of student to allocate room</h1>
        <form action="index4.php" method="post">
            <input type="text" name="enrollment_no" id="enrollment_no" placeholder="Enrollment Number">
            <input type="number" name="enrollment_year" id="enrollment_year" placeholder="Enrollment Year">
            <input type="text" name="name" id="name" placeholder="Name">
            <input type="email" name="email" id="email" placeholder="Email">
            <input type="number" name="phone" id="phone" placeholder="Phone Number">
            <input type="number" name="room_no" id="room_no" placeholder="Allocated Room no">
            <input type="text" name="room_type" id="room_type" placeholder="Room Type">
            <button class="btn">Add Student</button> 
        </form>
    </div>
</body>
</html>