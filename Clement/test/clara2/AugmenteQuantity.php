<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "madeth";

// Créer la connexion
$conn = new mysqli($servername, $username, $password, $dbname);

// Vérifier la connexion
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$quanity = mysqli_real_escape_string($conn, $_POST["name_client1"]);
$id = mysqli_real_escape_string($conn, $_POST["id"]);
$commande = mysqli_real_escape_string($conn, $_POST["commande"]);





$sql="UPDATE `contains` SET quantity_contains = '$quanity' WHERE id_contains = '$id';";


if (mysqli_query($conn, $sql)) {
    echo "Record updated successfully";
    header("Location: pagecontains.php?commande=".$commande."");
    
} else {
    echo "Error updating record: " . mysqli_error($conn);
}
mysqli_close($conn);

?>