<?php
// Replace with your database credentials
session_start();
$host = "localhost";
    $username = "admin";
    $password = "l[nv844MLLbHpD9R";
    $database = "DCS";

    //initiate variable conn with connection parameters
    $conn = new mysqli($host, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Set default date range to last 7 days
$start_date = date('Y-m-d', strtotime('-7 days'));
$end_date = date('Y-m-d');

// Update date range if form submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $start_date = $_POST["dateOutStart"];
  $end_date = $_POST["dateOutEnd"];
}
$tablename="usrPay".$_SESSION['id'];
// Retrieve data from database
$sql = "SELECT dateOut, amtOut, txnOut FROM $tablename WHERE dateOut BETWEEN '$start_date' AND '$end_date'";
$result = $conn->query($sql);

// Close database connection
$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
  <title>DCS Table</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>

<div class="container">
  <h2>DCS Table</h2>
  <form method="post" class="form-inline mb-3">
    <label for="start_date">Start Date:</label>
    <input type="date" name="dateOutStart" class="form-control mx-2" value="<?php echo $start_date; ?>">
    <label for="end_date">End Date:</label>
    <input type="date" name="dateOutEnd" class="form-control mx-2" value="<?php echo $end_date; ?>">
    <button type="submit" class="btn btn-primary">Filter</button>
  </form>
  
  <table class="table table-striped">
    <thead>
      <tr>
        <th>Date</th>
        <th>Amount</th>
        <th>Status</th>
      </tr>
    </thead>
    <tbody>
      <?php
      if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
          echo "<tr>";
          echo "<td>" . $row["dateOut"] . "</td>";
          echo "<td>$" . $row["amtOut"] . "</td>";
          echo "<td>" . ($row["txnOut"] ? "Completed" : "Pending") . "</td>";
          echo "</tr>";
        }
      } else {
        echo "<tr><td colspan='3'>No results found</td></tr>";
      }
      ?>
    </tbody>
  </table>

  <button onclick="window.print()" class="btn btn-primary">Print Table</button>
</div>

</body>
</html>
