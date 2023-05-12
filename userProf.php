<?php
// Replace with your database credentials
$host = "localhost";
$username = "admin";
$password = "l[nv844MLLbHpD9R";
$database = "DCS";

// Start a session
session_start();

// create connection
$conn = new mysqli($host, $username, $password, $database);

// check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
$id=$_SESSION['id'];
// get user details from database
$sql = "SELECT * FROM usrDetails WHERE id='$id'";
$result = mysqli_query($conn, $sql);
echo'
<head>
  <title>User Profile</title>
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="npm/node_ modules/bootstrap/dist/css/bootstrap.min.css">
</head>';

if (mysqli_num_rows($result) > 0) {
    // output user details in a read-only format
    $row = mysqli_fetch_assoc($result);
    ?>
    <div class="container">
        <h1>User Profile</h1>
        <table class="table table-bordered">
            <tbody>
                <tr>
                    <th>Username</th>
                    <td><?php echo $row["uName"]; ?></td>
                </tr>
                <tr>
                    <th>First name</th>
                    <td><?php echo $row["fName"]; ?></td>
                </tr>
                <tr>
                    <th>Last name</th>
                    <td><?php echo $row["lName"]; ?></td>
                </tr>
                <tr>
                    <th>Age</th>
                    <td><?php echo $row["age"]; ?></td>
                </tr>
                <tr>
                    <th>Mobile</th>
                    <td><?php echo $row["mob"]; ?></td>
                </tr>
                <tr>
                    <th>Email</th>
                    <td><?php echo $row["email"]; ?></td>
                </tr>
            </tbody>
        </table>
    </div>
    <?php
} else {
    echo "<div class='alert alert-danger' role='alert'>User not found.</div>";
}

// close database connection
mysqli_close($conn);
?>