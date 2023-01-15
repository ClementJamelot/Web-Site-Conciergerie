<!DOCTYPE html>
<html>
  <head>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
      var ascending = true;
      var sortBy = "nom";

      function sortTable(sort) {
        var table, rows, switching, i, x, y, shouldSwitch;
        table = document.getElementById("dataTable");
        switching = true;

        while (switching) {
          switching = false;
          rows = table.rows;

          for (i = 1; i < (rows.length - 1); i++) {
            shouldSwitch = false;
            x = rows[i].getElementsByTagName("TD")[sort];
            y = rows[i + 1].getElementsByTagName("TD")[sort];

            if (ascending) {
              if (x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) {
                shouldSwitch = true;
                break;
              }
            } else {
              if (x.innerHTML.toLowerCase() < y.innerHTML.toLowerCase()) {
                shouldSwitch = true;
                break;
              }
            }
          }
          if (shouldSwitch) {
            rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
            switching = true;
          }
        }
        ascending = !ascending;
        sortBy = sort;
      }


      function showPopup() {
      var popup = document.getElementById("myPopup");
      popup.classList.toggle("show");
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
       /*Styles pour le formulaire */
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

      .popup {
      position: relative;
      display: inline-block;
      cursor: pointer;
      text-align: center;
    }

    /* The actual popup */
    .popup .popuptext {
      visibility: hidden;
      width: 160px;
      background-color: #555;
      color: #fff;
      text-align: center;
      border-radius: 6px;
      padding: 8px 0;
      position: absolute;
      z-index: 1;
      bottom: 125%;
      left: 50%;
      margin-left: -80px;
    }

    /* Popup arrow */
    .popup .popuptext::after {
      content: "";
      position: absolute;
      top: 100%;
      left: 50%;
      margin-left: -5px;
      border-width: 5px;
      border-style: solid;
      border-color: #555 transparent transparent transparent;
    }

    /* Toggle this class when clicking on the popup container (hide and show the popup) */
    .popup .show {
      visibility: visible;
      -webkit-animation: fadeIn 1s;
      animation: fadeIn 1s;
    }
    .btnPopup
    {
      margin-left: 60% ;
    }

    

    /* Add animation (fade in the popup) */
    @-webkit-keyframes fadeIn {
      from {opacity: 0;}
      to {opacity: 1;}
    }

    @keyframes fadeIn {
      from {opacity: 0;}
      to {opacity:1 ;}
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
    <button onclick="sortTable(1)">Trier par nom</button>
    <button onclick="sortTable(2)">Trier par ville</button>
    <button onclick="sortTable(3)">Trier par code postal</button>
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
<button id="btnPopup" class="btnPopup">Open Popup</button>

<div id ="overlay" class="overlay">
  <div id="popup" class="'popup">
    <h2>
      Ajouter un client
      <span id="btnClose" class="btnClose">&times;</span>
    </h2>

    <form action="PHP_CREATION_COMPTE.php" method="post">
      <label for="name_client">Nom :</label>
      <input type="text" id="name_client" name="name_client" required>
      <br><br>

      <label for="facebook">facebook :</label>
      <input type="text" id="facebook" name="facebook" required>
      <br><br>

      <label for="instagram">instagram :</label>
      <input type="text" id="instagram" name="instagram" required>
      <br><br>

      <label for="email">email :</label>
      <input type="email" id="email" name="email" required>
      <br><br>

      <label for="tel">tel :</label>
      <input type="text" id="tel" name="tel" required>
      <br><br>

      <button type="submit">Enregistrer</button>
      <button type="reset">Annuler</button>
    </form>

  </div>
</div>
</body>
<script>
        var btnPopup = document.getElementById('btnPopup');
      var overlay = document.getElementById('overlay');
      var btnClose = document.getElementById('btnClose');

      btnPopup.addEventListener('click', openModal);
      btnClose.addEventListener('click', closeModal);

      function openModal(){
      overlay.style.display = 'block';
      }

      function closeModal(){
      overlay.style.display = 'none';
      }
  </script>
</html>
