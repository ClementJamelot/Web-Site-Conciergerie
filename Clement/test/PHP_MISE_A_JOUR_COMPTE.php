<?php
$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "madeth";

// Créer la connexion
$conn = new mysqli($servername, $username, $password, $dbname);

// Vérifier la connexion
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$id_client = mysqli_real_escape_string($conn, $_POST["id_client"]);
$name_client = mysqli_real_escape_string($conn, $_POST["name_client"]);
$facebook = mysqli_real_escape_string($conn, $_POST["facebook"]);
$instagram = mysqli_real_escape_string($conn, $_POST["instagram"]);
$email = mysqli_real_escape_string($conn, $_POST["email"]);
$tel = mysqli_real_escape_string($conn, $_POST["tel"]);




$sql="UPDATE client SET name_client = '$name_client', facebook = '$facebook', instagram = '$instagram', email = '$email', tel = '$tel' WHERE id_client = '$id_client';";


if (mysqli_query($conn, $sql)) {
    echo "Record updated successfully";
    header("Location: pageClient.php");
    
} else {
    echo "Error updating record: " . mysqli_error($conn);
}
mysqli_close($conn);

?>
