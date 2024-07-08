<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Check Room Availability</title>
    <link rel="stylesheet" href="style7.css">
</head>
<body>
    <div class="container">
        <h1>Check Room Availability</h1>
        <form method="POST" action="">
            <label for="room_type">Filter by Room Type:</label>
            <select name="room_type" id="room_type">
                <option value="">All</option>
                <option value="single">Single</option>
                <option value="double">Double</option>
            </select>
            <button type="submit">Check Availability</button>
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
    // Initialize variables
    $whereClause = "";
    $room_type = isset($_POST['room_type']) ? $_POST['room_type'] : "";

    // Construct the WHERE clause based on selected room type
    if (!empty($room_type)) {
        $whereClause .= " WHERE room_type = '$room_type'";
    }

    // Construct the SQL query
    $sql = "SELECT room_no, COUNT(*) as count FROM allocate_room" . $whereClause . " GROUP BY room_no";

    // Execute the query
    $result = mysqli_query($con, $sql);

    // Check for query execution success
    if (!$result) {
        die("Error executing the query: " . mysqli_error($con));
    }

    // Check if there are any results
    if (mysqli_num_rows($result) > 0) {
        // Initialize an array to store rooms allocated exactly twice
        $rooms_not_available = array();

        // Fetch room numbers and their counts
        while ($row = mysqli_fetch_assoc($result)) {
            if ($room_type == "double" && $row['count'] == 2) {
                $rooms_not_available[] = $row['room_no'];
            } elseif ($room_type == "single" && $row['count'] > 0) {
                $rooms_not_available[] = $row['room_no'];
            }
        }

        // Display the room numbers
        echo "<div class='result'>";
        echo "<h2>Allocated Room Numbers</h2>";
        if ($room_type == "double") {
            echo "<p>The following double rooms are not available:</p>";
        } elseif ($room_type == "single") {
            echo "<p>The following single rooms are not available:</p>";
        }
        echo "<ul>";
        foreach ($rooms_not_available as $room) {
            echo "<li>$room</li>";
        }
        echo "</ul>";
        echo "</div>";
    } else {
        echo "<div class='result'>All " . ucfirst($room_type) . " rooms are available</div>";
    }
}

// Close the database connection
mysqli_close($con);
?>

    </div>
</body>
</html>
