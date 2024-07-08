<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Room History</title>
    <link rel="stylesheet" href="style6.css">
</head>
<body>
    <div class="container">
        <h1>Room History</h1>
        <form method="POST" action="">
            <label for="room_no">Filter by Room Number:</label>
            <input type="text" name="room_no" id="room_no" placeholder="Enter Room Number">
            <button type="submit">Filter</button>
        </form>

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

        // Check if form is submitted
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Get the input room number
            $room_no = $_POST['room_no'];

            // Construct the SQL query
            $sql = "SELECT * FROM allocate_room WHERE room_no = '$room_no'";

            // Execute the query
            $result = mysqli_query($con, $sql);

            // Check if there are any results
            if (mysqli_num_rows($result) > 0) {
                // Display the table header
                echo "<table>";
                echo "<tr><th>Enrollment No</th><th>Enrollment Year</th><th>Name</th><th>Email</th><th>Phone</th><th>Room No</th><th>Room Type</th><th>Date Time</th></tr>";

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
                    echo "<td>" . $row['dt'] . "</td>"; // Include Date Time column
                    echo "</tr>";
                }

                echo "</table>";
            } else {
                echo "No records found for room number $room_no";
            }
        }

        // Close the database connection
        mysqli_close($con);
        ?>
    </div>
</body>
</html>
