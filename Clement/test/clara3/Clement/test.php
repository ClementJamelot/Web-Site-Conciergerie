<!DOCTYPE html>
<html>
  <head>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
      function filterTable() {
        var input, filter, table, tr, td, i;
        input = document.getElementById("filterInput");
        filter = input.value.toUpperCase();
        table = document.getElementById("dataTable");
        tr = table.getElementsByTagName("tr");
        for (i = 0; i < tr.length; i++) {
          td = tr[i].getElementsByTagName("td")[1];
          if (td) {
            if (td.innerHTML.toUpperCase().indexOf(filter) > -1) {
              tr[i].style.display = "";
            } else {
              tr[i].style.display = "none";
            }
          }
        }
      }
    </script>
  </head>
  <body>
    <form>
      <input type="text" id="filterInput" onkeyup="filterTable()" placeholder="Filtrer par nom...">
    </form>
    <table id="dataTable">
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
  </body>
</html>
