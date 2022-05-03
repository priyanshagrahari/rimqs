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
        
        <!-- form for insert -->
        <div class="popup_content i">
          <label for="insert" class="close_button" title="Close">&#x2BBE;</label>
          Enter data for the new entry: 
          <form action="" method="post"> <!-- form starts -->
            <div class="data_item">
              <label>Track Id</label>
              <input type="number" required name="t_id">
            </div>
            <div class="data_item">
              <label>Station 1</label>
              <select required name="stn_1">
              <?php 
                  include("connect.php");
                  $stmt = $conn->query('SELECT station_id, station_name FROM station');
                  if ($stmt->num_rows > 0) {
                    while ($row = $stmt->fetch_assoc()) {
                      echo "<option value=" . $row["station_id"] . ">" . $row["station_name"] . "(" . $row["station_id"] . ")" . "</option>
                      ";
                    }
                  }
                ?>
              </select>
            </div>
            <div class="data_item">
              <label>Station 2</label>
              <select required name="stn_2">
              <?php 
                  include("connect.php");
                  $stmt = $conn->query('SELECT station_id, station_name FROM station');
                  if ($stmt->num_rows > 0) {
                    while ($row = $stmt->fetch_assoc()) {
                      echo "<option value=" . $row["station_id"] . ">" . $row["station_name"] . "(" . $row["station_id"] . ")" . "</option>
                      ";
                    }
                  }
                ?>
              </select> 
              </div>
            <div class="insert_button">
              <button name="insert">INSERT</button>
            </div>
            <?php 
              if(isset($_POST['insert'])) {
                $id = $_POST['t_id'];
                $s1= $_POST['stn_1'];
                $s2= $_POST['stn_2'];
                include("connect.php");
                try {
                  $inse = $conn->query("INSERT INTO `track` (`track_id`, `station_id_1`, `station_id_2`)
                   VALUES ('$id', '$s1', '$s2')");
                  $conn->close();
                } catch (Exception $e) {
                  echo "
                  <input type=\"checkbox\" id=\"err\" style=\"display:none;\">
                  <div class=\"error_box\">
                  <label for=\"err\" class=\"close_button\" title=\"Close\">&#x2BBE;</label>
                    Could not insert the entered data.<br>
                    Please check if the track  id is unique or not.
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
          Select the Track Id which you want to modify:
          <form action="" method="post"> 
            <div class="data_item">
              <label>Track Id</label>
              <select required name="t_id">
              <?php 
                  include("connect.php");
                  $stmt = $conn->query('SELECT track_id FROM track');
                  if ($stmt->num_rows > 0) {
                    while ($row = $stmt->fetch_assoc()) {
                      echo "<option value=" . $row['track_id'] . ">" . $row['track_id'] . "</option>
                      ";
                    }
                  }
                ?>
              </select>
            </div>
            <div class="data_item">
              <label>Station 1</label>
              <select required name="stn_1">
              <?php 
                  include("connect.php");
                  $stmt = $conn->query('SELECT station_id, station_name FROM station');
                  if ($stmt->num_rows > 0) {
                    while ($row = $stmt->fetch_assoc()) {
                      echo "<option value=" . $row["station_id"] . ">" . $row["station_name"] . "(" . $row["station_id"] . ")" . "</option>
                      ";
                    }
                  }
                ?>
              </select>
            </div>
            <div class="data_item">
              <label>Station 2</label>
              <select required name="stn_2">
              <?php 
                  include("connect.php");
                  $stmt = $conn->query('SELECT station_id, station_name FROM station');
                  if ($stmt->num_rows > 0) {
                    while ($row = $stmt->fetch_assoc()) {
                      echo "<option value=" . $row["station_id"] . ">" . $row["station_name"] . "(" . $row["station_id"] . ")" . "</option>
                      ";
                    }
                  }
                ?>
              </select> 
              </div>
              <div class="insert_button">
              <button name="modify">MODIFY</button>
            </div>
              <?php 
              if(isset($_POST['modify'])) {
                $id = $_POST['t_id'];
                $s1= $_POST['stn_1'];
                $s2= $_POST['stn_2'];
                include("connect.php");
                try {
                  $inse = $conn->query("UPDATE `track`
                   SET `station_id_1` = '$s1', `station_id_2` = '$s2' 
                   WHERE `track`.`track_id` = $id");
                   $conn->close();
                  } catch (Exception $e) {
                    echo "<br>Could not modify.";
                    $conn->close();
                  }
                } 
              ?>
            </form>
          </div>
  

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