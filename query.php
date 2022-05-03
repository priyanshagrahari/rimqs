<!DOCTYPE html>
<html>

  <head>
    <?php include("header.php"); ?>
  </head>

  <body>
    <?php include("sidebar.php"); ?>
    <div class="main">
      <a href="<?php echo $_POST['table'] . ".php" ?>" class="popup_button">BACK</a>
      <table> 
      <?php
        if ($_POST['table'] == "station") {
          echo "
          <tr>
            <th>Station ID</th>
            <th>Station Name</th>
            <th>Number of Platforms</th>
            <th>Is Open</th>
          </tr> ";
          include("connect.php");
          $s_q = "SELECT * FROM station WHERE ";
          if ($_POST['sea'] == "id") {
            $s_q = $s_q . " station.station_id = " . $_POST['term'];
          }
          if ($_POST['sea'] == "name") {
            $s_q = $s_q . " station.station_name LIKE '%" . $_POST['term'] . "%'";
          }
          if ($_POST['sea'] == "num_more") {
            $s_q = $s_q . " station.num_platforms > '" . $_POST['term'] . "'";
          }
          if ($_POST['sea'] == "num_less") {
            $s_q = $s_q . " station.num_platforms < '" . $_POST['term'] . "'";
          }
          if ($_POST['sea'] == "isop") {
            $s_q = $s_q . " station.is_open = '1'";
          }
          if ($_POST['sea'] == "iscl") {
            $s_q = $s_q . " station.is_open = '0'";
          }
          $stmt = $conn->query($s_q);
          if ($stmt->num_rows > 0) {
            while ($row = $stmt->fetch_assoc()) {
              echo "<tr><td>" . $row["station_id"] . "</td><td>" . $row["station_name"] . "</td>
              <td>" . $row["num_platforms"] . "</td><td>" . (($row["is_open"]=='1')?'Yes':'No') . "</td>
              </tr>
              ";
            }
          }
          $conn->close();
        }
      ?>
      </table>
    </div>
  </body>

</html>