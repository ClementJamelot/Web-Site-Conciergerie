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
    </div>

    <div class="contenu">
      <h2>Listes des commandes</h2>
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
          mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
          $mysqli = new mysqli("localhost", "root", "root", "madeth");

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

      