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
          <th>Train Id</th>
          <th>Station Id</th>
          <th>Arrival Time</th>
          <th>Halt Destination</th>
        </tr>
        <?php
          include("connect.php");
          $stmt = $conn->query('SELECT * FROM schedule');
          if ($stmt->num_rows > 0) {
            while ($row = $stmt->fetch_assoc()) {
              echo "<tr><td>". $row["train_id"] . "</td><td>" . $row["station_id"] . "</td><td>" . $row["arrival_time"] . "</td>
              <td>" . $row["halt_destination"] . "</td><td>" .  "</td>
              </tr>
              ";
            }
          }
        ?>
      </table>
    
    </div>
  </body>

</html>