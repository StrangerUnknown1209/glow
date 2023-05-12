<?php
// Set up database connection
$servername = "localhost";
$username = "admin";
$password = "l[nv844MLLbHpD9R";
$dbname = "DCS";
$pswd = "user123";
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Hash the password using the default bcrypt algorithm
$hashedPassword = password_hash($pswd, PASSWORD_DEFAULT);
// Insert user details into "usrDetails" table
$sql1 = "INSERT INTO usrDetails (uName, fName, pWord, refCode) VALUES ('user', 'User', '$hashedPassword',uuid())";
if ($conn->query($sql1) === TRUE) {
  $last_id = $conn->insert_id;
  // Insert user type and activity into "usrTypeAct" table
  $sql2 = "INSERT INTO usrTypeAct (id, usrType, usrAct) VALUES ('$last_id', '1', '1')";
  if ($conn->query($sql2) === TRUE) {
    //checking and creating (if needed) table usrPay
    echo date("Y-m-d H:i:s", time());
    echo "Looking for table <strong> usrPay</strong> in the database...<br>";
    $table_name = "usrPay".$last_id;
    $query = "CREATE TABLE $table_name (amtIn INT(20) NOT NULL, dateIn date not null,txnIn INT(1) NOT NULL, amtOut INT(20) NOT NULL, dateOut date not null, txnOut INT(1) NOT NULL)ENGINE=InnoDB";
    $result = mysqli_query($conn, $query);
    if ($result) {
      echo date("Y-m-d H:i:s", time());
      echo " Table $table_name created successfully<br>";
    } else {
      echo date("Y-m-d H:i:s", time());
      echo " Error creating table: Table alreaddy exists! <br>";
    }
    echo "User account created successfully";
  } else {
    echo "Error creating user account: " . $conn->error;
  }
} else {
  echo "Error creating user account: " . $conn->error;
}

// Close database connection
$conn->close();
?>