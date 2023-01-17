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

$name_client = mysqli_real_escape_string($conn, $_POST["name_client"]);
$facebook = mysqli_real_escape_string($conn, $_POST["facebook"]);
$instagram = mysqli_real_escape_string($conn, $_POST["instagram"]);
$email = mysqli_real_escape_string($conn, $_POST["email"]);
$tel = mysqli_real_escape_string($conn, $_POST["tel"]);




$stmt = $conn->prepare("INSERT INTO client (name_client,facebook,instagram,email,tel) VALUES (?,?,?,?,?)");
$stmt->bind_param("ssssi", $name_client, $facebook,$instagram,$email,$tel);

if ($stmt->execute() === TRUE) {
    echo "New record created successfully";
    header("Location: a finir.php");
} else {
    echo "Error: " . $conn->error;
}

$stmt->close();
$conn->close();
?>
