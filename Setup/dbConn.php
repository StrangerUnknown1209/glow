<?php



function getUsrDetails($id)
{
    //start session
    $host = "localhost";
    $username = "admin";
    $password = "l[nv844MLLbHpD9R";
    $database = "DCS";

    //initiate variable conn with connection parameters
    $conn = new mysqli($host, $username, $password, $database);
    //connection check
    if ($conn->connect_error) {
        // failed connection
        echo " connection failed to database host</br>";
        die("Connection failed: " . $conn->connect_error);
    } else {
        $stmt = $conn->prepare("SELECT * FROM usrDetails WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        $stmt->close();
        $conn->close();
        return $row;
    }
}

function getTxn($id)
{
    //session start
    session_start();
    //initiate databse connection
    $host = "localhost";
    $username = "admin";
    $password = "l[nv844MLLbHpD9R";
    $database = "DCS";
    //initiate database connection
    $conn = new mysqli($host, $username, $password, $database);
    //connection check
    if ($conn->connect_error) {
        // failed connection
        echo " connection failed to database host</br>";
        die("Connection failed: " . $conn->connect_error);
    } else {
        $tname = "usrPay" . $id;
        $stmt = $conn->prepare("SELECT  FROM ?");
        //binding
        $stmt->bind_param("s", $tname);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        $stmt->close();
        $conn->close();
        return $row;
    }
}

function getRefd($id)
{
    //session start
    session_start();
    //initiate databse connection
    $host = "localhost";
    $username = "admin";
    $password = "l[nv844MLLbHpD9R";
    $database = "DCS";
    //initiate database connection
    $conn = new mysqli($host, $username, $password, $database);
    //connection check
    if ($conn->connect_error) {
        // failed connection
        echo " connection failed to database host</br>";
        die("Connection failed: " . $conn->connect_error);
    } else {

        $stmt = $conn->prepare("SELECT ud.fName, ud.lName, ud.regDate, up.amtIn, up.dateIn
    FROM usrDetails ud
    LEFT JOIN (
      SELECT CONCAT('usrPay', id) AS table_name, MAX(dateIn) AS max_date
      FROM usrDetails
      GROUP BY id
    ) AS t ON CONCAT('usrPay', ud.id) = t.table_name
    LEFT JOIN usrPay up ON up.dateIn = t.max_date
    WHERE ud.refCode = ?");
        $stmt->bind_param("s", $refdCode_value);
        $stmt->execute();

        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            echo "<div class='table-responsive'>";
            echo "<table class='table table-striped'>";
            echo "<thead><tr><th>First Name</th><th>Last Name</th><th>Registration Date</th><th>Latest Payment Amount</th><th>Latest Payment Date</th></tr></thead>";
            echo "<tbody>";
            while ($row = $result->fetch_assoc()) {
                echo "<tr><td>" . $row["fName"] . "</td><td>" . $row["lName"] . "</td><td>" . $row["regDate"] . "</td><td>" . $row["amtIn"] . "</td><td>" . $row["dateIn"] . "</td></tr>";
            }
            echo "</tbody>";
            echo "</table>";
            echo "</div>";
        } else {
            echo "<p>No results found.</p>";
        }

    }

}
?>