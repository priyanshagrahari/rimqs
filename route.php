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
                </div>";
                $conn->close();
              }
            } 
          ?>
        </form>
      </div>
     <table>
        <tr>
          <th>Train Id</th>
          <th>Track Id</th>
          <th>Time</th>
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