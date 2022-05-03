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
          <th>Train ID</th>
          <th>Train Name</th>
          <th>Number of Cars</th>
          <th>Number of Seats</th>
          <th>Service Type</th>
        </tr>
        <?php
          include("connect.php");
          $stmt = $conn->query('SELECT * FROM train');
          if ($stmt->num_rows > 0) {
            while ($row = $stmt->fetch_assoc()) {
              echo "<tr><td>" . $row["train_id"] . "</td><td>" . $row["train_name"] . "</td>
              <td>" . $row["num_cars"] . "</td><td>" .  $row["num_seats"] . "</td><td>". $row["service_type"] . "</td>
              </tr>
              ";
            }
          }
        ?>
      </table>
    
    </div>
  </body>

</html>