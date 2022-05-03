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
          <th>Station 1</th>
          <th>Station 2</th>
          
        </tr>
        <?php
          include("connect.php");
          $stmt = $conn->query('SELECT * FROM track');
          if ($stmt->num_rows > 0) {
            while ($row = $stmt->fetch_assoc()) {
              $stmt_s = $conn->query('SELECT station_id, station_name FROM station');
              $stn_1 = '';
              $stn_2 = '';
              while ($row_s = $stmt_s->fetch_assoc()) {
                if ($row_s["station_id"] == $row["station_id_1"]) $stn_1 = $row_s["station_name"];
                if ($row_s["station_id"] == $row["station_id_2"]) $stn_2 = $row_s["station_name"];
              }
              echo "<tr><td>" . $row["track_id"] . "</td><td>" . $stn_1 . " (" . $row["station_id_1"] . ") </td>
              <td>" . $stn_2 . " (" . $row["station_id_2"] .  ") </td>
              </tr>
              ";
            }
          }
        ?>
      </table>
    
    </div>
  </body>

</html>