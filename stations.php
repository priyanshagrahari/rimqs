<!DOCTYPE html>
<html>

  <head>
    <?php include("header.php"); ?>
  </head>

  <body>
    <?php include("sidebar.php"); ?>
    <div class="main">
      <div>
        <input type="checkbox" id="insert" style="display:none;">
        <label for="insert" class="popup_button">INSERT</label>
        <input type="checkbox" id="modify" style="display:none;">
        <label for="modify" class="popup_button">MODIFY</label>
        <input type="checkbox" id="delete" style="display:none;">
        <label for="delete" class="popup_button">DELETE</label>
        <input type="checkbox" id="err" style="display:none;">
        
        <!-- form for insert -->
        <div class="popup_content i">
          <label for="insert" class="close_button" title="Close">&#x2BBE;</label>
          Enter data for the new entry: 
          <form action="" method="post"> <!-- form starts -->
            <div class="data_item">
              <label>Station ID</label>
              <input type="number" required name="s_id">
            </div>
            <div class="data_item">
              <label>Station Name</label>
              <input type="text" value="Name" required maxlength="30" name="s_name">
            </div>
            <div class="data_item">
              <label>Number of Platforms</label>
              <input type="number" required name="n_plat">
            </div>
            <div class="data_item">
              <label>Is Open?</label>
              <input type="checkbox" name="is_o">
            </div>
            <div class="insert_button">
              <button name="insert">INSERT</button>
            </div>
            <?php 
              if(isset($_POST['insert'])) {
                $id = $_POST['s_id'];
                $name = $_POST['s_name'];
                $num = $_POST['n_plat'];
                if (isset($_POST['is_o'])) { $is_op = '1'; }
                else { $is_op = '0'; }
                include("connect.php");
                try {
                  $inse = $conn->query("INSERT INTO station (station_id, station_name, num_platforms, is_open) 
                  VALUES ('$id', '$name', '$num', '$is_op')");
                  $conn->close();
                  header("Location:stations.php");
                  exit;
                } catch (Exception $e) {
                  echo "
                  <div class=\"error_box\">
                    <label for=\"err\" class=\"close_button\" title=\"Close\">&#x2BBE;</label>
                    Could not insert the entered data.<br>
                    Please check if the station id is unique or not.
                  </div>"; 
                  if (isset($err)) {
                    header("Location:stations.php");
                    exit;
                  }
                }
              } 
            ?>
          </form>
        </div>

        <!-- form for modify -->
        <div class="popup_content m">
          <label for="modify" class="close_button" title="Close">&#x2BBE;</label>
          Enter data for the new entry: 
          <form action="" method="post">
            <div class="data_item">
              <label>Station ID</label>
              <input type="number" required name="s_id">
            </div>
            <div class="data_item">
              <label>Station Name</label>
              <input type="text" name="s_name">
            </div>
            <div class="data_item">
              <label>Number of Platforms</label>
              <input type="number" name="n_plat">
            </div>
            <div class="data_item">
              <label>Is Open?</label>
              <input type="checkbox" name="is_o">
            </div>
            <div class="insert_button">
              <button name="insert">INSERT</button>
            </div>
            <?php             
              if(isset($_POST['insert'])) {
                $id = $_POST['s_id'];
                $name = $_POST['s_name'];
                $num = $_POST['n_plat'];
                if (isset($_POST['is_o'])) { $is_op = '1'; }
                else { $is_op = '0'; }
                include("connect.php");
                try {
                  $inse = $conn->query("INSERT INTO station (station_id, station_name, num_platforms, is_open) 
                  VALUES ('$id', '$name', '$num', '$is_op')");
                  $conn->close();
                  header("Location:stations.php");
                  exit;
                } catch (Exception $e) {
                  echo "<br>Could not insert the entered data.<br>
                  Please check if the station id is unique or not.";
                }
              } 
            ?>
          </form>
        </div>
      </div>

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
              echo "<tr><td>" . $row["station_id"] . "</td><td>" . $row["station_name"] . "</td>
              <td>" . $row["num_platforms"] . "</td><td>" . (($row["is_open"]=='1')?'Yes':'No') . "</td>
              </tr>
              ";
            }
          }
          $conn->close();
        ?>
      </table>
    </div>
  </body>

</html>