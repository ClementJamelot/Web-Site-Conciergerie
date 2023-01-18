<?php

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
$mysqli = new mysqli("localhost", "root", "root", "madeth");

@$keywords=$_GET["keywords"];
@$valider=$_GET["valider"];
$afficher = false;

if(isset($valider) && !empty($keywords)){
  $res = $mysqli->query("SELECT * FROM commande WHERE id_client IN (SELECT id_client FROM client WHERE name_client LIKE '%" . trim($keywords) . "%')");
  $afficher = true;
}
else{
  $afficher = false;
}
?>

<html>
  <head>
    <meta charset="utf-8">
    
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
      Ajouter la génération de facture
      Exporter la liste des commandes
    </div>

    <div class="contenu">
      <div class="recherche">



        <form name="fo" method="get" action="">
          <input type="text" name="keywords" placehorder="Mots-clés">
          <input type="submit" name="valider" placehorder="Rechercher">
        </form>

        <div id="resultat">
          <?php if($afficher){ ?>

          <h2>Résultats de la recherche</h2>

          <div id="nbTrouve"><?php echo mysqli_num_rows($res); ?> résultats trouvés</div>

          <?php /* le tableau de la recherche*/ ?>
          <table class="tableau">
            <thead>
              <tr>
                <th>Id</th>
                <th>Nom client</th>
                <th>Date de commande</th>
                <th>Statut</th>
                <th>Prix total</th>
                <th>Plus d'info</th>
              </tr>
            </thead>

            <tbody>

              <?php

              while($resultat = mysqli_fetch_assoc($res)){?>
                <tr>
                  <td>
                    <?php echo $resultat['id_commande'];?>
                  </td>
                  <td>
                    <?php 
                    $cli = $mysqli->query("SELECT name_client FROM client WHERE id_client = " . $resultat['id_client']);
                    $client = mysqli_fetch_row($cli);
                    echo $client[0];
                    ?>
                  </td>
                  <td>
                    <?php echo $resultat['date_commande'];?>
                  </td>
                  <td>
                    <?php echo $resultat['status_commande'];?>
                  </td>
                  <td>
                    <?php 
                    $itemlist = $mysqli->query("SELECT quantity_contains, unit_price FROM contains WHERE id_commande = " . $resultat['id_commande']);

                    $tot = 0;

                    while($item = mysqli_fetch_assoc($itemlist)){
                      $tot = $tot + $item['quantity_contains'] * $item['unit_price'];
                    }

                    echo $tot;

                    ?>
                  </td>
                  <td>
                    Plus d'infos
                  </td>
                </tr> <?php
              }

              ?>

            </tbody>
          </table>
          <?php
          }?>

        </div>

      </div>

      <h2>Listes des commandes</h2>

      <?php /* le tableau classique*/ ?>

      <table class="tableau">
        <thead>
          <tr>
            <th>
              Id
            </th>
            <th>
              Nom client
            </th>
            <th>
              Date de commande
            </th>
            <th>
              Statut
            </th>
            <th>
              Prix total
            </th>
            <th>
              Plus d'info
            </th>
          </tr>
        </thead>
        <tbody>

          <?php

          $listCommande = $mysqli->query("SELECT * FROM commande");

          while($commande = mysqli_fetch_assoc($listCommande)){?>
            <tr>
              <td>
                <?php echo $commande['id_commande'];?>
              </td>
              <td>
                <?php 
                $cli = $mysqli->query("SELECT name_client FROM client WHERE id_client = " . $commande['id_client']);
                $client = mysqli_fetch_row($cli);
                echo $client[0];
                ?>
              </td>
              <td>
                <?php echo $commande['date_commande'];?>
              </td>
              <td>
                <?php echo $commande['status_commande'];?>
              </td>
              <td>
                <?php 
                $itemlist = $mysqli->query("SELECT quantity_contains, unit_price FROM contains WHERE id_commande = " . $commande['id_commande']);

                $tot = 0;

                while($item = mysqli_fetch_assoc($itemlist)){
                  $tot = $tot + $item['quantity_contains'] * $item['unit_price'];
                }

                echo $tot;

                ?>
              </td>
              <td>
                Plus d'infos
              </td>
            </tr> <?php
          }

          ?>

        </tbody>

      </table>

    </div>
  </body>

      