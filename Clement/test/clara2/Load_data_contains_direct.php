<?php
    $host = "localhost";
    $user = "root";
    $password = "root";
    $dbname = "madeth";

    // Create connection
    $conn = mysqli_connect($host, $user, $password, $dbname);

    // Check connection
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    $param1 = $_POST["param1"];

    $sql = "SELECT quantity_contains,id_contains FROM `contains` WHERE id_direct='$param1' ";
    $result = mysqli_query($conn, $sql);

    $data = array();
    if (mysqli_num_rows($result) > 0) {
        // output data of each row
        while($row = mysqli_fetch_assoc($result)) {
            $data[] = $row;
        }
        echo json_encode($data);
    } else {
        echo "0 results";
    }

    mysqli_close($conn);
?>