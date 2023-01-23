<?php
    include("Connection.php");
    $mysqli = connection();

    $param1 = $_POST["param1"];

    $mysqli->query("SELECT id_client,name_client,email,tel FROM client WHERE id_client='$param1' ");
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