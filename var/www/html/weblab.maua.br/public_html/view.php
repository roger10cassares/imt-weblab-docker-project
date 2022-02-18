<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="refresh" content="1">
</head>
<body>

<?php
    //Connect to database and create table
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "weblab";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
    // Check connection
    if ($conn->connect_error) {
        die("Database Connection failed: " . $conn->connect_error);
        echo "<a href='install.php'>If first time running click here to install database</a>";
    }
?> 


<div id="cards" class="cards">

</div>
</body>
</html>