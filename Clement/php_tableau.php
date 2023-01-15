<?php

// Connexion à la base de données
$host = "localhost";
$username = "root";
$password = "root";
$dbname = "madeth";

$conn = mysqli_connect($host, $username, $password, $dbname);

// Vérification de la connexion
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Requête SQL pour récupérer les données
$sql = "SELECT * FROM client";
$result = mysqli_query($conn, $sql);

echo "<table>";

// Entêtes du tableau
echo "<tr>
        <th>ID</th>
        <th>Nom</th>
        <th>Facebook</th>
        <th>Instagram</th>
        <th>Email</th>
        <th>Telephone</th>
        <th>Total point</th>
      </tr>";

// Affichage des données dans le tableau
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>
                <td>" . $row["id_client"] . "</td>
                <td>" . $row["name_client"] . "</td>
                <td>" . $row["facebook"] . "</td>
                <td>" . $row["instagram"] . "</td>
                <td>" . $row["email"] . "</td>
                <td>" . $row["tel"] . "</td>
                <td>" . $row["total_point"] . "</td>
              </tr>";
    }
} else {
    echo "Aucun résultat";
}

echo "</table>";

// Fermeture de la connexion
mysqli_close($conn);

?>
