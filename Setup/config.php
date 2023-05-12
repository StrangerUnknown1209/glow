<?php


// Set database credentials
$host = "localhost";
$username = "admin";
$password = "l[nv844MLLbHpD9R";
$database = "DCS";

//create initial connection
echo date("Y-m-d H:i:s", time());
echo " Checking connection...<br>";
$conn = new mysqli($host, $username, $password);
//Connection check
if ($conn->connect_error) {
    echo date("Y-m-d H:i:s", time());
    echo " connection failed to database host</br>";
    die("Connection failed: " . $conn->connect_error);
}
echo date("Y-m-d H:i:s", time());
echo " Connected successfully <br>";

// SQL query to show all databases
echo date("Y-m-d H:i:s", time());
echo " Retrieving Database list from server...<br>";
$query = "SHOW DATABASES";

// Execute the query
$result = mysqli_query($conn, $query);

//loop through results and check for database
$found = false;
while ($row = mysqli_fetch_assoc($result)) {
    if ($row['Database'] == $database) {
        $found = true;
        break;
    }
    else
    continue;
}
//checking database presence
echo date("Y-m-d H:i:s", time());
echo " Checking for the presence of $database in the server...<br>";
if ($found) {
    echo date("Y-m-d H:i:s", time());
    echo " Database $database exists<br>";
} else {
    echo date("Y-m-d H:i:s", time());
    echo " Database $database does not exist...Creating database...<br>";
    $query = "CREATE DATABASE $database";

// Execute the query
    if (mysqli_query($conn, $query)) {
        echo date("Y-m-d H:i:s", time());
        echo " Database $database created successfully<br>";
    }
    else {
        echo date("Y-m-d H:i:s", time());
        echo " Error creating database: Database already exists!";
    }
}
mysqli_close($conn);





// Create database connection
echo date("Y-m-d H:i:s", time());
echo " Connecting to database...<br>";
$conn = new mysqli($host, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    echo date("Y-m-d H:i:s", time());
    die(" Connection failed: " . $conn->connect_error);
}
echo date("Y-m-d H:i:s", time());
echo " Connected successfully<br>";


//checking and creating (if needed) table usrDetails
echo date("Y-m-d H:i:s", time());
echo " Looking for table <strong>usrDetails</strong> in the database...<br>";
$table_name = "usrDetails";
$query = "SELECT COUNT(*) FROM information_schema.tables WHERE table_schema = '$database' AND table_name = '$table_name'";
$result = mysqli_query($conn, $query);



// Check if the table exists
if (mysqli_fetch_array($result)[0] > 0) {
    echo date("Y-m-d H:i:s", time());
    echo " Table $table_name exists in $database<br>";
} else {
    echo date("Y-m-d H:i:s", time());
    echo " Table not found... Creating table $table_name<br>";
    $query = "CREATE TABLE $table_name (id INT(10) AUTO_INCREMENT PRIMARY KEY, uName VARCHAR(10) NOT NULL UNIQUE, pWord VARCHAR(255), fName VARCHAR(30) NOT NULL, lName VARCHAR(30) NOT NULL, mob VARCHAR(10) NOT NULL, age INT(3) NOT NULL, refCode VARCHAR(10) UNIQUE NOT NULL, refdCode VARCHAR(10), email VARCHAR(50), regDate TIMESTAMP DEFAULT CURRENT_TIMESTAMP)";

// Execute the query
    if (mysqli_query($conn, $query)) {
        echo date("Y-m-d H:i:s", time());
        echo " Table $table_name created successfully<br>";
    }
    else {
        echo date("Y-m-d H:i:s", time());
        echo " Error creating table: Table alreaddy exists! <br>";
    }
}


/*
//checking and creating (if needed) table usrPay
echo date("Y-m-d H:i:s", time());
echo "Looking for table <strong> usrPay</strong> in the database...<br>";
$table_name = "usrPay";
$query = "SELECT COUNT(*) FROM information_schema.tables WHERE table_schema = '$database' AND table_name = '$table_name'";
$result = mysqli_query($conn, $query);



// Check if the table exists
if (mysqli_fetch_array($result)[0] > 0) {
    echo date("Y-m-d H:i:s", time());
    echo " Table $table_name exists in $database<br>";
} else {
    echo date("Y-m-d H:i:s", time());
    echo " Table not found... Creating table $table_name <br>";
    $query = "CREATE TABLE $table_name (id INT(10) NOT NULL AUTO_INCREMENT, amtIn INT(20) NOT NULL, dateIn date not null, amtOut INT(20) NOT NULL, dateOut date not null, txnStat INT(20) NOT NULL, primary key (id), foreign key (id) References usrDetails(id))ENGINE=InnoDB";
// Execute the query
    if (mysqli_query($conn, $query)) {
        echo date("Y-m-d H:i:s", time());
        echo " Table $table_name created successfully<br>";
    }
    else {
        echo date("Y-m-d H:i:s", time());
        echo " Error creating table: Table alreaddy exists! <br>";
    }
}

*/

//checking and creating (if needed) table usrTypeAct
echo date("Y-m-d H:i:s", time());
echo "Looking for table <strong> usrTypeAct</strong> in the database...<br>";
$table_name = "usrTypeAct";
$query = "SELECT COUNT(*) FROM information_schema.tables WHERE table_schema = '$database' AND table_name = '$table_name'";
$result = mysqli_query($conn, $query);



// Check if the table exists
if (mysqli_fetch_array($result)[0] > 0) {
    echo date("Y-m-d H:i:s", time());
    echo " Table $table_name exists in $database<br>";
} else {
    echo date("Y-m-d H:i:s", time());
    echo " Table not found... Creating table $table_name <br>";
    $query = "CREATE TABLE $table_name (id INT(10) NOT NULL AUTO_INCREMENT,usrType boolean NOT NULL, usrAct boolean NOT NULL, primary key (id), foreign key (id) References usrDetails(id))ENGINE=InnoDB";
// Execute the query
    if (mysqli_query($conn, $query)) {
        echo date("Y-m-d H:i:s", time());
        echo " Table $table_name created successfully<br>";
    }
    else {
        echo date("Y-m-d H:i:s", time());
        echo " Error creating table: Table alreaddy exists! <br>";
    }
}




echo date("Y-m-d H:i:s", time());
echo " All processes are Done!";
?>


