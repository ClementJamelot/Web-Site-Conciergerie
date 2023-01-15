<!DOCTYPE html>
<html>
  <head>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
      function filterTable(filter) {
        var table, tr, td, i;
        table = document.getElementById("dataTable");
        tr = table.getElementsByTagName("tr");
        for (i = 0; i < tr.length; i++) {
          td = tr[i].getElementsByTagName("td")[2];
          if (td) {
            if (td.innerHTML == filter || filter == "all") {
              tr[i].style.display = "";
            } else {
              tr[i].style.display = "none";
            }
          }
        }
      }
    </script>
    <style>
      /* Styles pour le header */
      header {
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        height: 100px;
        background-color: #333;
        display: flex;
        align-items: center;
        justify-content: space-between;
      }
      /* Styles pour la barre de gauche */
      .sidebar {
        position: fixed;
        top: 100px;
        bottom: 0;
        left: 0;
        width: 10%;
        background-color: #333;
        color: #fff;
        padding: 20px;
      }
      /* Styles pour le formulaire */
      form {
        margin: 150px auto;
        width: 80%;
        text-align: center;
      }
      /* Styles pour les boutons */
      button {
        background-color: #333;
        color: #fff;
        padding: 10px 20px;
        border: none;
        cursor: pointer;
        margin-right: 10px;
      }
    </style>
  </head>
  <body>

  
    <header>
      <img src="logo.png" alt="Logo" style="height: 190%">
      <div>
        <button id="btnClient" class="btnClient" onclick="window.location='pageClient.html';">Bouton client</button>
        <button id="btnCommande" class="btnCommande" onclick="window.location='pageCommande.html';">Bouton commande</button>
      </div>
    </header>
    <div class="sidebar">
      <button onclick="filterTable('Paris')">Paris</button>
      <button onclick="filterTable('Lyon')">Lyon</button>
      <button onclick="filterTable('Marseille')">Marseille</button>
      <button onclick="filterTable('all')">Tout afficher</button>
    </div>
    <div class="contenu">
      <h2>Liste des clients</h2>
    <table id="dataTable" class="tableau" style="margin-left: 300px;
margin-top: 150px;" >
    <tr>
        <th>ID</th>
        <th>Nom</th>
        <th>Facebook</th>
        <th>Instagram</th>
        <th>Email</th>
        <th>Telephone</th>
        <th>Total point</th>
      </tr>
      <?php
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

        mysqli_close($conn);
      ?>
    </table>
    </div>
  </body>
</html>
