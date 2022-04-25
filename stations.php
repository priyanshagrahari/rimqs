<!DOCTYPE html>
<html>

  <head>
    <?php include("header.php"); ?>
  </head>

  <body>
    <?php include("sidebar.php"); ?>
    <div class="main">
    <table>
      <tr>
        <th>Station ID</th>
        <th>Station Name</th>
        <th>Number of Platforms</th>
        <th>Is Open</th>
      </tr>
      <?php
        include("connect.php");
        $stmt = $conn->query('SELECT * FROM station');
        if ($stmt->num_rows > 0) {
          while ($row = $stmt->fetch_assoc()) {
            echo "<tr><td>" . $row["station_id"] . "</td><td>" . $row["station_name"] . "</td><td>" . $row["num_platforms"] . "</td><td>" . (($row["is_open"]=='1')?'Yes':'No') . "</td></tr>
            ";
          }
        }
      ?>
    </table>
    </div>
  </body>

</html>