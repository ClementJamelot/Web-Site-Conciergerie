<html>
  <head>
    <meta charset="utf-8">

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
        width: 20%;
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

    <link rel="stylesheet" href="stylePageclient.css"></link>
  </head>

  <body>
    <header>
      <img src="logo.png" alt="Logo" style="height: 120px">
      <div>
        <button id="btnClient" class="btnClient" onclick="window.location='pageClient.php';">Bouton client</button>
        <button id="btnCommande" class="btnCommande" onclick="window.location='pageCommande.php';">Bouton commande</button>
      </div>
    </header>
    <div class="sidebar">
      Trier par :
      <button onclick="sortTable(1)">Nom</button>
      <button onclick="sortTable(2)">Ville</button>
      <button onclick="sortTable(3)">Code Postal</button>
      <button onclick="sortTable(4)">Abonnement</button>
    </div>
    <div class="contenu">
      <h2>Liste des clients</h2>
      <table class="tableau" id="dataTable">
        <thead>
          <tr>
            <th>
              Id
            </th>
            <th>
              Nom
            </th>
            <th>
              Adresse
            </th>
            <th>
              Abonnement
            </th>
            <th>
              Nb points
            </th>
            <th>
              Téléphone
            </th>
            <th>
              Plus d'info
            </th>
          </tr>
        </thead>
        <tbody>

          <?php
          mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
          $mysqli = new mysqli("localhost", "root", "", "madeth");

          $listClient = $mysqli->query("SELECT * FROM client");

          while($client = mysqli_fetch_assoc($listClient)){?>
            <tr>
              <td>
                <?php echo $client['id_client'];?>
              </td>
              <td>
                <?php echo $client['name_client'];?>
              </td>
              <td>
                <?php echo $client['address_client'];?>
              </td>
              <td>
                
                <?php 
                if($client['ultimate'] == 1){
                  $member = "Ultimate";
                }
                elseif($points = $client['total_point']<700){
                  
                  $mem = $mysqli->query("SELECT type_member FROM membership WHERE " . $points. " BETWEEN min_point AND max_point"); /*$points BETWEEN min_point AND max_point*/
                  $mem2 = mysqli_fetch_row($mem);
                  $member = $mem2[0];
                  
                }
                else{
                  $mem = $mysqli->query("SELECT type_member FROM membership WHERE min_point >= 700");
                  $mem2 = mysqli_fetch_row($mem);
                  $member = $mem2[0];
                }
                echo $member;
                ?>
              </td>
              <td>
                <?php 
                  $nbPoint = $mysqli->query("SELECT SUM(nb_point) FROM `point` WHERE id_client = " . $client['id_client'] . " AND `expery_date`>= CURRENT_DATE");
                  $nb = mysqli_fetch_row($nbPoint);
                  echo $nb[0];
                ?>
              </td>
              <td>
                <?php echo $client['tel'];?>
              </td>
              <td>
              <button id="loadData" onclick=<?php echo "\"myFunction(" . $client['id_client'] . ")\"" ?>>Plus d'infos</button>
              </td>
            </tr> <?php
          }

          ?>

        </tbody>

      </table>

      <button id="btnPopup" class="btnPopup" onclick="openModal1()">Open Popup</button>

      <div id ="overlay" class="overlay" style="display:none">
        <div id="myPopup" class="'popup"  >
          <h2>
            Fiche du client
            <span id="btnClose" class="btnClose" onclick="closeModal()">&times;</span>
          </h2>

          <form action="PHP_MISE_A_JOUR_COMPTE.php" method="post">
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
            <input type="text" id="id_client" name="id_client" required style="visibility:hidden">
            <button type="submit">Enregistrer</button>
            <button type="reset">Annuler</button>
          </form>

        </div>
      </div>

      <div id ="overlay1" class="overlay" style="display:none">
        <div id="myPopup" class="'popup"  >
          <h2>
            Ajouter un client
            <span id="btnClose" class="btnClose" onclick="closeModal()">&times;</span>
          </h2>

          <form action="PHP_CREATION_COMPTE.php" method="post">
            <label for="name_client">Nom :</label>
            <input type="text" id="name_client1" name="name_client" required>
            <br><br>

            <label for="facebook">facebook :</label>
            <input type="text" id="facebook1" name="facebook" required>
            <br><br>

            <label for="instagram">instagram :</label>
            <input type="text" id="instagram1" name="instagram" required>
            <br><br>

            <label for="email">email :</label>
            <input type="email" id="email1" name="email" required>
            <br><br>

            <label for="tel">tel :</label>
            <input type="text" id="tel1" name="tel" required>
            <br><br>

            <button type="submit">Enregistrer</button>
            <button type="reset">Annuler</button>
          </form>

        </div>
      </div>

    </div>
  </body>

<script>
  var btnPopup = document.getElementById('btnPopup');
  var overlay1 = document.getElementById('overlay1');
  var overlay = document.getElementById('overlay');
  var btnClose = document.getElementById('btnClose');
  var popup = document.getElementById("myPopup");
  popup.style.visibility("hidden");

  btnPopup.addEventListener('click', openModal);
  btnClose.addEventListener('click', closeModal);

  function showPopup() {
    var popup = document.getElementById("myPopup");
    popup.style.visibility("visible");
  }

  function openModal1(){
    overlay1.style.display = 'block';
  }
  function openModal(){
    overlay.style.display = 'block';
  }

  function closeModal(){
    overlay1.style.display = 'none';
    overlay.style.display = 'none';
  }
</script>
<script>


  function myFunction(id){
    openModal();
    $.ajax({
      type: "POST",
      url: "load_data.php",
      data: {param1 : id, param2 : "value2"},
      success: function(data){
        console.log(data);
        var data = JSON.parse(data);
        console.log(data[0].email);
        document.getElementById("name_client").value = data[0].name_client;
        document.getElementById("email").value = data[0].email;
        document.getElementById("tel").value = data[0].tel;
        document.getElementById("id_client").value = data[0].id_client;
      }
    });
  };
    
    
    
</script>

      