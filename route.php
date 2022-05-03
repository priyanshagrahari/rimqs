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
          <th>Train Id<th>
          <th>Track Id<th>
          <th>Time<th>
        </tr>
        <?php
         include("connect.php");
         $stmt=$conn->query('SELECT * FROM route');
         if ($stmt->num_rows > 0) {
          while ($row = $stmt->fetch_assoc()) {
            echo "<tr><td>". $row["train_id"] . "</td><td>" . $row["track_id"] . "</td><td>" . $row["time"] . "</td>
            </tr>
            ";
          }
        }
      ?>
    </table>
    
    </div>
  </body>

</html>