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
              <input type="number" required name="t_id">
            </div>
            <div class="data_item">
              <label>Train Name</label>
              <input type="text" required maxlength="30" name="t_name">
            </div>
            <div class="data_item">
              <label>Number of Cars</label>
              <input type="number" required name="n_cars">
            </div>
            <div class="data_item">
              <label>Number of Seats</label>
              <input type="number" required name="n_seats">
            </div>
            <div class="data_item">
              <label>Service Type</label>
              <select name="s_type">
                <option value="Passenger">Passenger</option>
                <option value="Express">Express</option>
                <option value="Special">Special</option>
              </select>
            </div>
            <div class="insert_button">
              <button name="insert">INSERT</button>
            </div>
            <?php 
              if(isset($_POST['insert'])) {
                $id = $_POST['t_id'];
                $name = $_POST['t_name'];
                $num_cars = $_POST['n_cars'];
                $num_seats= $_POST['n_seats'];
                $type =$_POST['s_type'];
                include("connect.php");
                try {
                  $inse = $conn->query("INSERT INTO `train` (`train_id`, `train_name`, `num_cars`, `num_seats`, `service_type`)
                   VALUES ('$id', '$name', '$num_cars', '$num_seats', '$type')");
                  $conn->close();
                } catch (Exception $e) {
                  echo "
                  <input type=\"checkbox\" id=\"err\" style=\"display:none;\">
                  <div class=\"error_box\">
                  <label for=\"err\" class=\"close_button\" title=\"Close\">&#x2BBE;</label>
                    Could not insert the entered data.<br>
                    Please check if the train  id is unique or not.
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
          Select the Train ID which you want to modify: 
          <form action="" method="post">
            <div class="data_item">
              <label>Train ID</label>
              <select required name="t_id">
                <?php 
                  include("connect.php");
                  $stmt = $conn->query('SELECT train_id FROM train');
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
              <label>Train Name</label>
              <input type="text" required maxlength="30" name="t_name">
            </div>
            <div class="data_item">
              <label>Number of Cars</label>
              <input type="number" required name="n_cars">
            </div>
            <div class="data_item">
              <label>Number of Seats</label>
              <input type="number" required name="n_seats">
            </div>
            <div class="data_item">
              <label>Service Type</label>
              <select name="s_type">
                <option value="Passenger">Passenger</option>
                <option value="Express">Express</option>
                <option value="Special">Special</option>
              </select>
            </div>
            <div class="insert_button">
              <button name="modify">MODIFY</button>
            </div>
            <?php             
              if(isset($_POST['modify'])) {
                $id = $_POST['t_id'];
                $name = $_POST['t_name'];
                $num_cars = $_POST['n_cars'];
                $num_seats= $_POST['n_seats'];
                $type =$_POST['s_type'];
                include("connect.php");
                try {
                  $inse = $conn->query("UPDATE `train`
                   SET `train_name` = '$name', `num_cars` = '$num_cars', `num_seats` = '$num_seats', `service_type` = '$type' 
                   WHERE `train`.`train_id` = $id");
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
          Select the Train ID which you want to delete: 
          <form action="" method="post">
            <div class="data_item">
              <label>Train ID</label>
              <select required name="t_id">
                <?php 
                  include("connect.php");
                  $stmt = $conn->query('SELECT train_id FROM train');
                  if ($stmt->num_rows > 0) {
                    while ($row = $stmt->fetch_assoc()) {
                      echo "<option value=" . $row['train_id'] . ">" . $row['train_id'] . "</option>
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
                $id = $_POST['t_id'];
                include("connect.php");
                try {
                  $inse = $conn->query("DELETE FROM train
                  WHERE `train`.`train_id`=$id");
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
            <input type="text" value="train" name="table" style="display:none;">
            <div class="data_item">
              <label>Field</label>
              <select required name="sea">
                <option value="id">Train ID</option>
                <option value="name">Train Name</option>
                <option value="car_more">Number of Cars (more than)</option>
                <option value="car_less">Number of Cars (less than)</option>
                <option value="seat_more">Number of Seats (more than)</option>
                <option value="seat_less">Number of Seats (less than)</option>
                <option value="ser">Service Type</option>
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