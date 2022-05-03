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
        <input type="checkbox" id="search" style="display:none;">
        <label for="search" class="popup_button">SEARCH</label>
        
        <!-- form for insert -->
        <div class="popup_content i">
          <label for="insert" class="close_button" title="Close">&#x2BBE;</label>
          Enter data for the new entry: 
          <form action="stations.php" method="post"> <!-- form starts -->
            <div class="data_item">
              <label>Station ID</label>
              <input type="number" required name="s_id">
            </div>
            <div class="data_item">
              <label>Station Name</label>
              <input type="text" required maxlength="30" name="s_name">
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
                } catch (Exception $e) {
                  echo "
                  <input type=\"checkbox\" id=\"err\" style=\"display:none;\">
                  <div class=\"error_box\">
                  <label for=\"err\" class=\"close_button\" title=\"Close\">&#x2BBE;</label>
                    Could not insert the entered data.<br>
                    Please check if the station id is unique or not.
                  </div>";
                  $conn->close();
                }
              } 
            ?>
          </form>
        </div>

        <!-- form for modify -->
        <div class="popup_content m">
          <label for="modify" class="close_button" title="Close">&#x2BBE;</label>
          Select the Station ID which you want to modify: 
          <form action="" method="post">
            <div class="data_item">
              <label>Station ID</label>
              <select required name="s_id">
                <?php 
                  include("connect.php");
                  $stmt = $conn->query('SELECT station_id FROM station');
                  if ($stmt->num_rows > 0) {
                    while ($row = $stmt->fetch_assoc()) {
                      echo "<option value=" . $row['station_id'] . ">" . $row['station_id'] . "</option>
                      ";
                    }
                  }
                ?>
              </select>
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
              <button name="modify">MODIFY</button>
            </div>
            <?php             
              if(isset($_POST['modify'])) {
                $id = $_POST['s_id'];
                $name = $_POST['s_name'];
                $num = $_POST['n_plat'];
                if (isset($_POST['is_o'])) { $is_op = '1'; }
                else { $is_op = '0'; }
                include("connect.php");
                try {
                  $inse = $conn->query("UPDATE `station` 
                  SET `station_name` = '$name', `num_platforms` = '$num', `is_open` = '$is_op' 
                  WHERE `station`.`station_id` = $id");
                  $conn->close();
                } catch (Exception $e) {
                  echo "<br>Could not modify.";
                  $conn->close();
                }
              } 
            ?>
          </form>
        </div>

        <!-- form for delete -->
        <div class="popup_content d">
          <label for="delete" class="close_button" title="Close">&#x2BBE;</label>
          Select the Station ID which you want to delete: 
          <form action="" method="post">
            <div class="data_item">
              <label>Station ID</label>
              <select required name="s_id">
                <?php 
                  include("connect.php");
                  $stmt = $conn->query('SELECT station_id FROM station');
                  if ($stmt->num_rows > 0) {
                    while ($row = $stmt->fetch_assoc()) {
                      echo "<option value=" . $row['station_id'] . ">" . $row['station_id'] . "</option>
                      ";
                    }
                  }
                ?>
              </select>
            </div>
            <div class="insert_button">
              <button name="delete">DELETE</button>
            </div>
            <?php             
              if(isset($_POST['delete'])) {
                $id = $_POST['s_id'];
                include("connect.php");
                try {
                  $inse = $conn->query("DELETE FROM station 
                  WHERE `station`.`station_id` = $id");
                  $conn->close();
                } catch (Exception $e) {
                  echo "<br>Could not delete.";
                  $conn->close();
                }
              } 
            ?>
          </form>
        </div>

        <!-- form for search -->
        <div class="popup_content s">
          <label for="search" class="close_button" title="Close">&#x2BBE;</label>
          Select the field you want search for: 
          <form action="query.php" method="post">
            <input type="text" value="station" name="table" style="display:none;">
            <div class="data_item">
              <label>Field</label>
              <select required name="sea">
                <option value="id">Station ID</option>
                <option value="name">Station Name</option>
                <option value="num_more">Number of Platforms (more than)</option>
                <option value="num_less">Number of Platforms (less than)</option>
                <option value="isop">Is Open</option>
                <option value="iscl">Is Closed</option>
              </select>
            </div>
            <div class="data_item">
              <label>Value (Optional)</label>
              <input type="text" name="term">
            </div>
            <div class="insert_button">
              <button name="search">SEARCH</button>
            </div>
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