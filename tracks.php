<!DOCTYPE html>
<html>

  <head>
    <?php include("header.php"); ?>
  </head>

  <body>
    <?php include("sidebar.php"); ?>
    <div class="main">
    <!-- add insert etc stuff here -->
    <table>
        <tr>
          <th>Track Id</th>
          <th>Station Id 1</th>
          <th>Station Id 2</th>
          
        </tr>
        <?php
          include("connect.php");
          $stmt = $conn->query('SELECT * FROM track');
          if ($stmt->num_rows > 0) {
            while ($row = $stmt->fetch_assoc()) {
              echo "<tr><td>" . $row["track_id"] . "</td><td>" . $row["station_id_1"] . "</td>
              <td>" . $row["station_id_2"] .  "</td>
              </tr>
              ";
            }
          }
        ?>
      </table>
    
    </div>
  </body>

</html>