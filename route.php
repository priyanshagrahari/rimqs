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
      <input type="checkbox" id="delete" style="display:none;">
      <label for="delete" class="popup_button">DELETE</label>
      <input type="checkbox" id="search" style="display:none;">
      <label for="search" class="popup_button">SEARCH</label>
      
      <!-- form for insert -->
      <div class="popup_content i">
        <label for="insert" class="close_button" title="Close">&#x2BBE;</label>
        Enter data for the new entry: 
        <form action="" method="post"> <!-- form starts -->
          <div class="data_item">
              <label>Train ID</label>
              <select name="t_1_id">
              <?php 
                  include("connect.php");
                  $stmt = $conn->query('SELECT * FROM train');
                  if ($stmt->num_rows > 0) {
                    while ($row = $stmt->fetch_assoc()) {
                      echo "<option value=" . $row['train_id'] . ">" . $row['train_id'] . "</option>
                      ";
                    }
                  }
                ?>
              </select>
            </div>
            <div class="data_item">
              <label>Track ID</label>
              <select name="t_2_id">
              <?php 
                  include("connect.php");
                  $stmt = $conn->query('SELECT * FROM track');
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
              <label>Time</label>
              <input type="time" required name="time">
             </div>
             <div class="insert_button">
            <button name="insert">INSERT</button>
          </div>
          <?php 
            if(isset($_POST['insert'])) {
              $id_1 = $_POST['t_1_id'];
              $id_2= $_POST['t_2_id'];
              $time= date("H:i:s", strtotime($_POST['time']));
              include("connect.php");
              try {
                $inse = $conn->query("INSERT INTO `route` (`train_id`, `track_id`, `time`)
                  VALUES ('$id_1', '$id_2', '$time')");
                $conn->close();
              } catch (Exception $e) {
                echo "
                <input type=\"checkbox\" id=\"err\" style=\"display:none;\">
                <div class=\"error_box\">
                <label for=\"err\" class=\"close_button\" title=\"Close\">&#x2BBE;</label>
                  Could not insert the entered data.<br>
                  Please try again.
                </div>";
                $conn->close();
              }
            } 
          ?>
        </form>
      </div>

      <!-- form for delete -->
      <div class="popup_content d">
        <label for="delete" class="close_button" title="Close">&#x2BBE;</label>
        Select the row which you want to delete: 
        <form action="" method="post">
          <div class="data_item">
            <label>Train ID, Track ID, Time</label>
            <select required name="id">
              <?php 
                include("connect.php");
                $stmt = $conn->query('SELECT * FROM route');
                if ($stmt->num_rows > 0) {
                  while ($row = $stmt->fetch_assoc()) {
                    $tname = '';
                    $trname = '';
                    $stmt_t = $conn->query('SELECT train_id, train_name FROM train');
                    while ($row_t = $stmt_t->fetch_assoc()) {
                      if ($row_t['train_id'] == $row['train_id']) {
                        $tname = $row_t['train_name'];
                        break;
                      }
                    }
                    $stmt_tr = $conn->query('SELECT * FROM track');
                    while ($row_tr = $stmt_tr->fetch_assoc()) {
                      if ($row_tr['track_id'] == $row['track_id']) {
                        $stmt_s = $conn->query('SELECT station_id, station_name FROM station');
                        $stn_1 = '';
                        $stn_2 = '';
                        while ($row_s = $stmt_s->fetch_assoc()) {
                          if ($row_s["station_id"] == $row_tr["station_id_1"]) $stn_1 = $row_s["station_name"];
                          if ($row_s["station_id"] == $row_tr["station_id_2"]) $stn_2 = $row_s["station_name"];
                        }
                        $trname = $stn_1 . ' - ' . $stn_2;
                        break;
                      }
                    }
                    echo "<option value=\"route.train_id = '". $row['train_id'] . "' AND  route.track_id = '" . $row["track_id"] . 
                    "' AND route.time = '" . $row['time'] . "'\">" . $tname . " (" . $row['train_id'] . "), " . $trname . ' (' . 
                    $row["track_id"] . "), " . $row["time"] . "</option>
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
                echo "
                  <input type=\"checkbox\" id=\"err\" style=\"display:none;\">
                  <div class=\"error_box\">
                  <label for=\"err\" class=\"close_button\" title=\"Close\">&#x2BBE;</label>
                    Could not delete.
                  </div>";
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
          <input type="text" value="route" name="table" style="display:none;">
          <div class="data_item">
            <label>Field</label>
            <select required name="sea">
              <option value="tn">Train (Name)</option>
              <option value="ti">Train (ID)</option>
              <option value="trn">Track (Station Name)</option>
              <option value="tri">Track (ID)</option>
              <option value="teq">Time (equal)</option>
              <option value="tbe">Time (before)</option>
              <option value="taf">Time (after)</option>
            </select>
          </div>
          <div class="data_item">
            <label>Value</label>
            <input type="text" required name="term">
          </div> 
          <div class="insert_button">
            <button name="search">SEARCH</button>
          </div>
        </form>
      </div>
    </div>
    
    <table>
      <tr>
        <th>Train</th>
        <th>Track</th>
        <th>Time</th>
      </tr>
      <?php
        include("connect.php");
        $stmt=$conn->query('SELECT * FROM route');
        if ($stmt->num_rows > 0) {
          while ($row = $stmt->fetch_assoc()) {
            $tname = '';
            $trname = '';
            $stmt_t = $conn->query('SELECT train_id, train_name FROM train');
            while ($row_t = $stmt_t->fetch_assoc()) {
              if ($row_t['train_id'] == $row['train_id']) {
                $tname = $row_t['train_name'];
                break;
              }
            }
            $stmt_tr = $conn->query('SELECT * FROM track');
            while ($row_tr = $stmt_tr->fetch_assoc()) {
              if ($row_tr['track_id'] == $row['track_id']) {
                $stmt_s = $conn->query('SELECT station_id, station_name FROM station');
                $stn_1 = '';
                $stn_2 = '';
                while ($row_s = $stmt_s->fetch_assoc()) {
                  if ($row_s["station_id"] == $row_tr["station_id_1"]) $stn_1 = $row_s["station_name"];
                  if ($row_s["station_id"] == $row_tr["station_id_2"]) $stn_2 = $row_s["station_name"];
                }
                $trname = $stn_1 . ' - ' . $stn_2;
                break;
              }
            }
            echo "<tr><td>". $tname . ' (' . $row["train_id"] . ")</td><td>" . 
            $trname . ' (' . $row["track_id"] . ")</td><td>" . $row["time"] . "</td>
            </tr>
            ";
          }
        }
      ?>
    </table> 
    
    </div>
  </body>

</html>