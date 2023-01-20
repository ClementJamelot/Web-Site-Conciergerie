<html>
  <head>
    <meta charset="utf-8">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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
      Barre de gauche
    </div>
    <div class="contenu">
      <h2>Liste des Produit</h2>
      <table class="tableau">
        <thead>
          <tr>
            <th>
              Id
            </th>
            <th>
              Nom
            </th>
            <th>
              Prix
            </th>
            <th>
              Quantity
            </th>
            <th>
              Description
            </th>
            <th>
            Modif
            </th>
          </tr>
        </thead>
        <tbody>

          <?php
          mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
          $mysqli = new mysqli("localhost", "root", "root", "madeth");
          @$commande=$_GET["commande"];
          $listProduct = $mysqli->query("SELECT * FROM `contains` where id_stock is null and `id_commande`=". $commande." ");

          while($product = mysqli_fetch_assoc($listProduct)){


            $id_direct= $product['id_direct'];
            $listProductdirect = $mysqli->query("SELECT * FROM `productdirect` where `id_direct`=".$id_direct."");
            while($productdirect = mysqli_fetch_assoc($listProductdirect)){
          ?>
            <tr>
              <td>
                <?php echo $productdirect['id_direct'];?>
              </td>
              <td>
                <?php echo $productdirect['direct_name'];?>
              </td>
              <td>
                <?php echo $productdirect['direct_sell_price'];?>
              </td>
              <td>
              <?php echo $product['quantity_contains'];?>
              </td>
              <td>
              <?php echo $productdirect['direct_desc'];?>
              </td>
              <td>
              <button id="loadData" onclick=<?php echo "\"myFunction(" . $productdirect['id_direct'] . ",'direct')\"" ?>>Modif</button>
            </td>

            </tr> <?php
            }
   
        }
        $listProduct = $mysqli->query("SELECT * FROM `contains` where id_direct is null and `id_commande`=". $commande." ");

          while($product = mysqli_fetch_assoc($listProduct)){
            $id_stock= $product['id_stock'];
            $listProductstock = $mysqli->query("SELECT * FROM `productstock` where `id_stock`=".$id_stock."");
            while($productstock = mysqli_fetch_assoc($listProductstock)){
          ?>
            <tr>
              <td>
                <?php echo $productstock['id_stock'];?>
              </td>
              <td>
                <?php echo $productstock['stock_name'];?>
              </td>
              <td>
                <?php echo $productstock['stock_sell_price'];?>
              </td>
              <td>
              <?php echo $product['quantity_contains'];?>
              </td>
              <td>
              <?php echo $productstock['stock_desc'];?>
              </td>
              <td>
              <button id="loadData" onclick=<?php echo "\"myFunction(" . $productstock['id_stock'] . ",'stock')\"" ?>>Modif</button>
              </td>

            </tr> <?php
            }
        }
          ?>

        </tbody>

      </table>
    </div>

    <button id="btnPopup" class="btnPopup" onclick="openModal1()" style="margin-left: 50%;
margin-top: 500px;">Open Popup</button>
    <div id ="overlay1" class="overlay" style="display:none">
        <div id="myPopup" class="'popup" style="position: fixed;top: 150px;left: 30%;background-color: wheat;width: 50%;" >
          <h2>
            Modifier Produit
            <span id="btnClose" class="btnClose" onclick="closeModal()">&times;</span>
          </h2>

          <form action="AugmenteQuantity.php" method="post">
            <label for="Quantity">Quantité :</label>
            <input type="text" id="name_client1" name="name_client1" required style="width:10%">
            <br><br>

            <button>Supprimer</button>
            <br><br>
            <input type="text" id="id" name="id" required style="visibility:hidden">
            <?php echo "<input type=\"text\" id=\"commande\" name=\"commande\" required value=$commande style=\"visibility:hidden\" >";?>
            <button type="submit">Enregistrer</button>
          </form>

        </div>
      </div>



      <div id ="overlay" class="overlay" style="display:none">
        <div id="myPopup" class="'popup"  style="position: fixed;top: 150px;left: 30%;background-color: wheat;width: 50%;">
          <h2>
            Ajouter un client
            <span id="btnClose" class="btnClose" onclick="closeModal()">&times;</span>
          </h2>

          <form action="AjouterProductDirect.php" method="post">
            <label for="name_client">Direct_name :</label>
            <input type="text" id="name_client1" name="name_client" required>
            <br><br>

            <label for="facebook">Quantity :</label>
            <input type="text" id="facebook1" name="facebook" required>
            <br><br>
            <label for="facebook">Direct_price :</label>
            <input type="text" id="facebook1" name="facebook" required>
            <br><br>
            <label for="facebook">select Supplier :</label>
            <input type="text" id="facebook1" name="facebook" required>

            <label for="facebook">bouton new supplier</label>
            <input type="text" id="facebook1" name="facebook" required>

            <label for="facebook">new Supplier :</label>
            <input type="text" id="facebook1" name="facebook" required>








            <button type="submit">Enregistrer</button>
            <button type="reset">Annuler</button>
          </form>
          <form action="AjouterProductStock.php" method="post">
            <label for="name_client">Nom :</label>
            <input type="text" id="name_client1" name="name_client" required>
            <br><br>

            <label for="facebook">facebook :</label>
            <input type="text" id="facebook1" name="facebook" required>
            <br><br>

            <button type="submit">Enregistrer</button>
            <button type="reset">Annuler</button>
          </form>

        </div>
      </div>  



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

  function openModal(){
    overlay1.style.display = 'block';
  }
  function openModal1(){
    overlay.style.display = 'block';
  }

  function closeModal(){
    overlay1.style.display = 'none';
    overlay.style.display = 'none';
  }
</script>
<script>


  function myFunction(id,text){
    openModal();
    if(text=='direct')
    {
        $.ajax({
      type: "POST",
      url: "load_data_contains_direct.php",
      data: {param1 : id, param2 : "value2"},
      success: function(data){
        var data = JSON.parse(data);
        document.getElementById("name_client1").value = data[0].quantity_contains;
        document.getElementById("id").value = data[0].id_contains;

      }
    });
    }
    else
    {
        $.ajax({
      type: "POST",
      url: "load_data_contains_stock.php",
      data: {param1 : id, param2 : "value2"},
      success: function(data){
        var data = JSON.parse(data);
        document.getElementById("name_client1").value = data[0].quantity_contains;
        document.getElementById("id").value = data[0].id_contains;
      }
    });
    }
    
  };
    
    
    
</script>





  </body>

      