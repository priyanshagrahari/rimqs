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
          <form action="" method="post"> <!-- form starts -->
            <div class="data_item">
              <label>Train ID</label>
              <select required name="t_id">
              <?php 
                  include("connect.php");
                  $stmt = $conn->query('SELECT * FROM train');
                  if ($stmt->num_rows > 0) {
                    while ($row = $stmt->fetch_assoc()) {
                      echo "<option value=" . $row['train_id'] . ">" . $row['train_name'] . ' (' . $row['train_id'] . ")</option>
                      ";
                    }
                  }
                ?>
              </select>
            </div>
            <div class="data_item">
              <label>Station ID</label>
              <select required name="s_id">
                <?php 
                  include("connect.php");
                  $stmt = $conn->query('SELECT * FROM station');
                  if ($stmt->num_rows > 0) {
                    while ($row = $stmt->fetch_assoc()) {
                      echo "<option value=" . $row['station_id'] . ">" . $row['station_name'] . ' (' . $row['station_id'] . ")</option>
                      ";
                    }
                  }
                ?>
              </select>
            </div>
            <div class="data_item">
              <label>Arrival Time</label>
              <input type="time" required name="a_time">
            </div>
            <div class="data_item">
              <label>Halt Duration</label>
              <input type="time" requied name="h_duration">
            </div>
            <div class="insert_button">
              <button name="insert">INSERT</button>
            </div>
            <?php 
              if(isset($_POST['insert'])) {
                $id_1 = $_POST['t_id'];
                $id_2= $_POST['s_id'];
                $time= date("H:i:s", strtotime($_POST['a_time']));
                $duration= date("H:i:s",strtotime($_POST['h_duration']));
                include("connect.php");
                try {
                  $inse = $conn->query("INSERT INTO schedule (train_id, station_id, arrival_time, halt_duration) 
                  VALUES ('$id_1', '$id_2', '$time', '$duration')");
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

        <!-- form for modify -->
        <div class="popup_content m">
          <label for="modify" class="close_button" title="Close">&#x2BBE;</label>
          Select the Train ID and Arrival time pair for the entry which you want to modify:
          <form action="" method="post"> 
            <div class="data_item">
              <label>Train ID, Arrival Time</label>
              <select required name="id">
              <?php 
                  include("connect.php");
                  $stmt = $conn->query('SELECT train_id, arrival_time FROM schedule');
                  if ($stmt->num_rows > 0) {
                    while ($row = $stmt->fetch_assoc()) {
                      $stmt_t = $conn->query('SELECT * FROM train');
                      while ($row_t = $stmt_t->fetch_assoc()) {
                        if ($row['train_id'] == $row_t['train_id']) {
                          $tname = $row_t['train_name'];
                          break;
                        }
                      }
                      echo "<option value=\"schedule.train_id='" . $row['train_id'] . "' AND schedule.arrival_time='" . 
                      $row['arrival_time'] . "'\">" . $tname . ' (' . $row['train_id'] . "), " . $row['arrival_time'] . "</option>
                      ";
                    }
                  }
                ?>
              </select>
            </div>
            <div class="data_item">
              <label>Station ID</label>
              <select required name="s_id">
                <?php 
                  include("connect.php");
                  $stmt = $conn->query('SELECT * FROM station');
                  if ($stmt->num_rows > 0) {
                    while ($row = $stmt->fetch_assoc()) {
                      echo "<option value=" . $row['station_id'] . ">" . $row['station_name'] . ' (' . $row['station_id'] . ")</option>
                      ";
                    }
                  }
                ?>
              </select>
            </div>
            <div class="data_item">
              <label>Halt Duration</label>
              <input type="time" requied name="h_duration">
            </div>
            <div class="insert_button">
              <button name="modify">MODIFY</button>
            </div>
            <?php 
              if(isset($_POST['modify'])) {
                $cond = $_POST['id'];
                $stn = $_POST['s_id'];
                $duration= date("H:i:s",strtotime($_POST['h_duration']));
                include("connect.php");
                try {
                  $inse = $conn->query("UPDATE `schedule`
                  SET `station_id` = '$stn', `halt_duration` = '$duration' 
                  WHERE ($cond)");
                  $conn->close();
                } catch (Exception $e) {
                  echo "
                  <input type=\"checkbox\" id=\"err\" style=\"display:none;\">
                  <div class=\"error_box\">
                  <label for=\"err\" class=\"close_button\" title=\"Close\">&#x2BBE;</label>
                    Could not modify.<br>
                    Please check the new entries.
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
          Select the Train ID and Arrival time pair for the entry which you want to delete: 
          <form action="" method="post">
            <div class="data_item">
              <label>Train ID, Arrival Time</label>
              <select required name="id">
              <?php 
                  include("connect.php");
                  $stmt = $conn->query('SELECT train_id, arrival_time FROM schedule');
                  if ($stmt->num_rows > 0) {
                    while ($row = $stmt->fetch_assoc()) {
                      $stmt_t = $conn->query('SELECT * FROM train');
                      while ($row_t = $stmt_t->fetch_assoc()) {
                        if ($row['train_id'] == $row_t['train_id']) {
                          $tname = $row_t['train_name'];
                          break;
                        }
                      }
                      echo "<option value=\"schedule.train_id='" . $row['train_id'] . "' AND schedule.arrival_time='" . 
                      $row['arrival_time'] . "'\">" . $tname . ' (' . $row['train_id'] . "), " . $row['arrival_time'] . "</option>
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
                $cond = $_POST['id'];
                include("connect.php");
                try {
                  $inse = $conn->query("DELETE FROM schedule 
                  WHERE ($cond)");
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
            <input type="text" value="schedule" name="table" style="display:none;">
            <div class="data_item">
              <label>Field</label>
              <select required name="sea">
                <option value="tn">Train (Name)</option>
                <option value="tid">Train (ID)</option>
                <option value="sn">Station (Name)</option>
                <option value="sid">Station (ID)</option>
                <option value="teq">Arrival Time (equal to)</option>
                <option value="tbe">Arrival Time (before)</option>
                <option value="taf">Arrival Time (after)</option>
                <option value="heq">Halt Duration (equal to)</option>
                <option value="hle">Halt Duration (less than)</option>
                <option value="hge">Halt Duration (greater than)</option>
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
          <th>Station</th>
          <th>Arrival Time</th>
          <th>Halt Duration</th>
        </tr>
        <?php
          include("connect.php");
          $stmt = $conn->query('SELECT * FROM schedule');
          if ($stmt->num_rows > 0) {
            while ($row = $stmt->fetch_assoc()) {
              $stmt_t = $conn->query('SELECT train_id, train_name FROM train');
              $stmt_s = $conn->query('SELECT station_id, station_name FROM station');
              $tname = '';
              $sname = '';
              while ($row_t = $stmt_t->fetch_assoc()) {
                if ($row['train_id'] == $row_t['train_id']) {
                  $tname = $row_t['train_name'];
                  break;
                }
              }
              while ($row_s = $stmt_s->fetch_assoc()) {
                if ($row['station_id'] == $row_s['station_id']) {
                  $sname = $row_s['station_name'];
                  break;
                }
              }
              echo "<tr><td>" . $tname . ' (' . $row["train_id"] . ")</td><td>" . 
              $sname . ' (' . $row["station_id"] . ")</td><td>" . $row["arrival_time"] . "</td>
              <td>" . $row["halt_duration"] . "</td>
              </tr>
              ";
            }
          }
        ?>
      </table>
    
    </div>
  </body>

</html>