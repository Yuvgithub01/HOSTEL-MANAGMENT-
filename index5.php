<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Allocation Info</title>
    <link rel="stylesheet" href="style5.css">
</head>
<body>
    <div class="container">
        <h1>Allocation Info</h1>
        <form method="POST" action="">
            <label for="enrollment_year">Filter by Enrollment Year:</label>
            <input type="text" name="enrollment_year" id="enrollment_year" placeholder="Enter Enrollment Year">
            <label for="room_type">Filter by Room Type:</label>
            <select name="room_type" id="room_type">
                <option value="">All</option>
                <option value="single">Single</option>
                <option value="double">Double</option>
            </select>
            <button type="submit">Filter</button>
        </form>

        <!-- PHP code to process form submission and display filtered data -->
        <?php
        // Database connection parameters
        $server = "localhost";
        $username = "root";
        $password = "";
        $database = "hostel_management";

        // Create a database connection
        $con = mysqli_connect($server, $username, $password, $database);

        // Check for connection success
        if (!$con) {
            die("Connection to the database failed due to: " . mysqli_connect_error());
        }

        // Initialize variables
        $whereClause = "";
        $enrollment_year = isset($_POST['enrollment_year']) ? $_POST['enrollment_year'] : "";
        $room_type = isset($_POST['room_type']) ? $_POST['room_type'] : "";

        // Construct the WHERE clause based on selected filters
        if (!empty($enrollment_year)) {
            $whereClause .= " WHERE enrollment_year = '$enrollment_year'";
        }

        if (!empty($room_type)) {
            if (!empty($whereClause)) {
                $whereClause .= " AND room_type = '$room_type'";
            } else {
                $whereClause .= " WHERE room_type = '$room_type'";
            }
        }

        // Construct the SQL query
        $sql = "SELECT * FROM allocate_room" . $whereClause;

        // Execute the query
        $result = mysqli_query($con, $sql);

        // Check if there are any results
        if (mysqli_num_rows($result) > 0) {
            // Display the table header
            echo "<table>";
            echo "<tr><th>Enrollment No</th><th>Enrollment Year</th><th>Name</th><th>Email</th><th>Phone</th><th>Room No</th><th>Room Type</th></tr>";
            
            // Display the data rows
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>" . $row['enrollment_no'] . "</td>";
                echo "<td>" . $row['enrollment_year'] . "</td>";
                echo "<td>" . $row['name'] . "</td>";
                echo "<td>" . $row['email'] . "</td>";
                echo "<td>" . $row['phone'] . "</td>";
                echo "<td>" . $row['room_no'] . "</td>";
                echo "<td>" . $row['room_type'] . "</td>";
                echo "</tr>";
            }

            echo "</table>";
        } else {
            echo "No records found";
        }

        // Close the database connection
        mysqli_close($con);
        ?>
    </div>
</body>
</html>
