<?php
// Replace with your database credentials
session_start();
$host = "localhost";
$username = "admin";
$password = "l[nv844MLLbHpD9R";
$database = "DCS";

// Initiate variable conn with connection parameters
$conn = new mysqli($host, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Prepare and execute the SQL query to retrieve the user details
$stmt = $conn->prepare("SELECT fName, lName, regDate FROM usrDetails WHERE refdCode = ?");
$stmt->bind_param("s", $_SESSION['refCode']);
$stmt->execute();
$result = $stmt->get_result();

// Define the table headers
$headers = array('First Name', 'Last Name', 'Registration Date');

// Start building the HTML table
echo '<!DOCTYPE html>';
echo '<html>';
echo '<head>';
echo '<meta charset="UTF-8">';
echo '<meta name="viewport" content="width=device-width, initial-scale=1.0">';
echo '<title>User Details</title>';
echo '<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">';
echo '</head>';
echo '<body>';

echo '<div class="container">';
echo '<h2>User Details</h2>';

echo '<button onclick="window.print();" class="btn btn-primary">Print</button>';

echo '<table class="table">';
echo '<thead><tr>';
foreach ($headers as $header) {
    echo '<th>' . $header . '</th>';
}
echo '</tr></thead>';
echo '<tbody>';

// Loop through the results and add them to the table
while ($row = $result->fetch_assoc()) {
    echo '<tr>';
    echo '<td>' . $row['fName'] . '</td>';
    echo '<td>' . $row['lName'] . '</td>';
    echo '<td>' . $row['regDate'] . '</td>';
    echo '</tr>';
}

// Finish building the HTML table
echo '</tbody></table>';

echo '</div>';

echo '</body>';
echo '</html>';

// Close the database connection
$stmt->close();
$conn->close();
?>
