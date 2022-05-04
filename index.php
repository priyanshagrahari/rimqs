<!DOCTYPE html>
<html>
  
  <head>
    <?php include("header.php"); ?>
  </head>

  <body>
    <?php include("sidebar.php"); ?>
    <?php include("validate.php"); ?>
    <div class="main">
      <p>
        Welcome to Railway Query System (RQS).
      </p>
      <p>
        The aim of RQS is to provide its users with an easy to use interface to
query information regarding stations, trains, tracks, the schedules of trains and the
routes of trains.
      </p>
      <p>
        To add/modify/remove table entries, select one of the tables from the sidebar.
      </p>
      <p>
        To create run the current query, click on the button below:
      </p> <br>
      <div>
        <form action="query.php" method="post">
          <div class="insert_button q">
            <button name="run">RUN QUERY</button>
          </div>
          <input type="text" value='index' name='table' style="display:none;">


          <div class="data_item">
            <label>Include constraints on Stations:</label>
            <input type="checkbox" name="station">
          </div>

          <div class="display">
            <label>Display </label>
            <input type="checkbox" name="d_s_id">
          </div>
          <div class="data_item">
            <label>Station ID</label>
            <select name="s_id">
              <option value="None">None</option>
              <?php 
                include("connect.php");
                $stmt = $conn->query('SELECT station_id FROM station');
                if ($stmt->num_rows > 0) {
                  while ($row = $stmt->fetch_assoc()) {
                    echo "<option value=\"station.station_id=" . $row['station_id'] . "\">" . $row['station_id'] . "</option>
                    ";
                  }
                }
              ?>
            </select>
          </div>

          <div class="display">
            <label>Display </label>
            <input type="checkbox" name="d_s_name">
          </div>
          <div class="data_item">
            <label>Station Name (Exact)</label>
            <select name="s_name">
              <option value="NULL">None</option>
              <?php 
                include("connect.php");
                $stmt = $conn->query('SELECT station_name FROM station');
                if ($stmt->num_rows > 0) {
                  while ($row = $stmt->fetch_assoc()) {
                    echo "<option value=\"station.station_name='" . $row['station_name'] . "'\">" . $row['station_name'] . "</option>
                    ";
                  }
                }
              ?>
            </select>
          </div>

          <div class="display">
            <label>Display </label>
            <input type="checkbox" name="d_s_name_l">
          </div>
          <div class="data_item">
            <label>Station Name (Like)</label>
            <input type="text" value="None" name="s_name_l">
          </div>

          <div class="display">
            <label>Display </label>
            <input type="checkbox" name="d_s_num">
          </div>
          <div class="data_item">
            <label>Number of Platforms</label>
            <select name="s_num_cmp">
              <option value="NULL">None</option>
              <option value="eq">Equal to</option>
              <option value="lt">Less than</option>
              <option value="mt">More than</option>
            </select>
          </div>
          <div class="data_item">
            <input type="number" value="0" name="s_num">
          </div>

          <div class="display">
            <label>Display </label>
            <input type="checkbox" name="d_s_isop">
          </div>
          <div class="data_item">
            <label>Is Open</label>
            <select name="s_isop">
              <option value="NULL">None</option>
              <option value="yes">Yes</option>
              <option value="nop">No</option>
            </select>
          </div>
          <div class="data_item"></div>


          <div class="data_item">
            <label>Include constraints on Tracks:</label>
            <input type="checkbox" name="track">
          </div>

          <div class="display">
            <label>Display </label>
            <input type="checkbox" name="d_tr_id">
          </div>
          <div class="data_item">
            <label>Track ID</label>
            <select name="tr_id">
              <option value="None">None</option>
              <?php 
                include("connect.php");
                $stmt = $conn->query('SELECT track_id FROM track');
                if ($stmt->num_rows > 0) {
                  while ($row = $stmt->fetch_assoc()) {
                    echo "<option value=\"track.track_id=" . $row['track_id'] . "\">" . $row['track_id'] . "</option>
                    ";
                  }
                }
              ?>
            </select>
          </div>

          <div class="display">
            <label>Display </label>
            <input type="checkbox" name="d_tr_s1">
          </div>
          <div class="data_item">
            <label>Station 1 (ID)</label>
            <select name="tr_s1">
              <option value="None">None</option>
              <?php 
                include("connect.php");
                $stmt = $conn->query('SELECT * FROM track');
                if ($stmt->num_rows > 0) {
                  while ($row = $stmt->fetch_assoc()) {
                    echo "<option value=\"track.station_id_1=" . $row['station_id_1'] . "\">" . $row['station_id_1'] . "</option>
                    ";
                  }
                }
              ?>
            </select>
          </div>

          <div class="display">
            <label>Display </label>
            <input type="checkbox" name="d_tr_s1_l">
          </div>
          <div class="data_item">
            <label>Station 1 (Name like)</label>
            <input type="text" name="tr_s1_l" value="None">
          </div>

          <div class="display">
            <label>Display </label>
            <input type="checkbox" name="d_tr_s2">
          </div>
          <div class="data_item">
            <label>Station 2 (ID)</label>
            <select name="tr_s2">
              <option value="None">None</option>
              <?php 
                include("connect.php");
                $stmt = $conn->query('SELECT * FROM track');
                if ($stmt->num_rows > 0) {
                  while ($row = $stmt->fetch_assoc()) {
                    echo "<option value=\"track.station_id_2=" . $row['station_id_2'] . "\">" . $row['station_id_2'] . "</option>
                    ";
                  }
                }
              ?>
            </select>
          </div>

          <div class="display">
            <label>Display </label>
            <input type="checkbox" name="d_tr_s2_l">
          </div>
          <div class="data_item">
            <label>Station 2 (Name like)</label>
            <input type="text" name="tr_s2_l" value="None">
          </div>
          <div class="data_item"></div>


          <div class="data_item">
            <label>Include constraints on Trains:</label>
            <input type="checkbox" name="train">
          </div>

          <div class="display">
            <label>Display </label>
            <input type="checkbox" name="d_t_id">
          </div>
          <div class="data_item">
            <label>Train ID</label>
            <select name="t_id">
              <option value="None">None</option>
              <?php 
                include("connect.php");
                $stmt = $conn->query('SELECT * FROM train');
                if ($stmt->num_rows > 0) {
                  while ($row = $stmt->fetch_assoc()) {
                    echo "<option value=\"train.train_id=" . $row['train_id'] . "\">" . $row['train_id'] . "</option>
                    ";
                  }
                }
              ?>
            </select>
          </div>

          <div class="display">
            <label>Display </label>
            <input type="checkbox" name="d_t_name">
          </div>
          <div class="data_item">
            <label>Train Name (Exact)</label>
            <select name="t_name">
              <option value="None">None</option>
              <?php 
                include("connect.php");
                $stmt = $conn->query('SELECT * FROM train');
                if ($stmt->num_rows > 0) {
                  while ($row = $stmt->fetch_assoc()) {
                    echo "<option value=\"train.train_name=" . $row['train_name'] . "\">" . $row['train_name'] . "</option>
                    ";
                  }
                }
              ?>
            </select>
          </div>

          <div class="display">
            <label>Display </label>
            <input type="checkbox" name="d_t_name_l">
          </div>
          <div class="data_item">
            <label>Train Name (Like)</label>
            <input type="text" name="t_name_l" value="None">
          </div>

          <div class="display">
            <label>Display </label>
            <input type="checkbox" name="d_t_num">
          </div>
          <div class="data_item">
            <label>Number of Cars</label>
            <select name="t_num_cmp">
              <option value="NULL">None</option>
              <option value="eq">Equal to</option>
              <option value="lt">Less than</option>
              <option value="mt">More than</option>
            </select>
          </div>
          <div class="data_item">
            <input type="number" value="0" name="t_num">
          </div>

          <div class="display">
            <label>Display </label>
            <input type="checkbox" name="d_t_snum">
          </div>
          <div class="data_item">
            <label>Number of Seats</label>
            <select name="t_snum_cmp">
              <option value="NULL">None</option>
              <option value="eq">Equal to</option>
              <option value="lt">Less than</option>
              <option value="mt">More than</option>
            </select>
          </div>
          <div class="data_item">
            <input type="number" value="0" name="t_snum">
          </div>

          <div class="display">
            <label>Display </label>
            <input type="checkbox" name="d_t_serv">
          </div>
          <div class="data_item">
            <label>Service Type</label>
            <select name="t_serv">
              <option value="NULL">None</option>
              <option value="Passenger">Passenger</option>
              <option value="Express">Express</option>
              <option value="Special">Special</option>
            </select>
          </div>
          <div class="data_item"></div>


          <div class="data_item">
            <label>Include contraints on Schedule:</label>
            <input type="checkbox" name="schedule">
          </div>

          <div class="display">
            <label>Display </label>
            <input type="checkbox" name="d_sc_t_id">
          </div>
          <div class="data_item">
            <label>Train (ID)</label>
            <select name="sc_t_id">
              <option value="None">None</option>
              <?php 
                include("connect.php");
                $stmt = $conn->query('SELECT * FROM schedule');
                if ($stmt->num_rows > 0) {
                  while ($row = $stmt->fetch_assoc()) {
                    echo "<option value=\"schedule.train_id=" . $row['train_id'] . "\">" . $row['train_id'] . "</option>
                    ";
                  }
                }
              ?>
            </select>
          </div>

          <div class="display">
            <label>Display </label>
            <input type="checkbox" name="d_sc_t_name_l">
          </div>
          <div class="data_item">
            <label>Train (Name like)</label>
            <input type="text" name="sc_t_name_l" value = "None">
          </div>

          <div class="display">
            <label>Display </label>
            <input type="checkbox" name="d_sc_s_id">
          </div>
          <div class="data_item">
            <label>Station (ID)</label>
            <select name="sc_s_id">
              <option value="None">None</option>
              <?php 
                include("connect.php");
                $stmt = $conn->query('SELECT * FROM schedule');
                if ($stmt->num_rows > 0) {
                  while ($row = $stmt->fetch_assoc()) {
                    echo "<option value=\"schedule.station_id=" . $row['station_id'] . "\">" . $row['station_id'] . "</option>
                    ";
                  }
                }
              ?>
            </select>
          </div>

          <div class="display">
            <label>Display </label>
            <input type="checkbox" name="d_sc_s_name_l">
          </div>
          <div class="data_item">
            <label>Station (Name like)</label>
            <input type="text" name="sc_s_name_l" value="None">
          </div>

          <div class="display">
            <label>Display </label>
            <input type="checkbox" name="d_sc_atime">
          </div>
          <div class="data_item">
            <label>Arrival Time</label>
            <select name="sc_atime_cmp">
              <option value="NULL">None</option>
              <option value="eq">At</option>
              <option value="lt">Before</option>
              <option value="mt">After</option>
            </select>
          </div>
          <div class="data_item">
            <input type="time" name="sc_atime">
          </div>

          <div class="display">
            <label>Display </label>
            <input type="checkbox" name="d_sc_hdur">
          </div>
          <div class="data_item">
            <label>Halt Duration</label>
            <select name="sc_hdur_cmp">
              <option value="NULL">None</option>
              <option value="eq">Equal to</option>
              <option value="lt">Less than</option>
              <option value="mt">More than</option>
            </select>
          </div>
          <div class="data_item">
            <input type="time" name="sc_hdur">
          </div>
          <div class="data_item"></div>


          <div class="data_item">
            <label>Include constraints on Route</label>
            <input type="checkbox" name="route">
          </div>

          <div class="display">
            <label>Display </label>
            <input type="checkbox" name="d_r_t_id">
          </div>
          <div class="data_item">
            <label>Train (ID)</label>
            <select name="r_t_id">
              <option value="None">None</option>
              <?php 
                include("connect.php");
                $stmt = $conn->query('SELECT * FROM route');
                if ($stmt->num_rows > 0) {
                  while ($row = $stmt->fetch_assoc()) {
                    echo "<option value=\"route.train_id=" . $row['train_id'] . "\">" . $row['train_id'] . "</option>
                    ";
                  }
                }
              ?>
            </select>
          </div>

          <div class="display">
            <label>Display </label>
            <input type="checkbox" name="d_r_t_name_l">
          </div>
          <div class="data_item">
            <label>Train (Name like)</label>
            <input type="text" name="r_t_name_l" value = "None">
          </div>

          <div class="display">
            <label>Display </label>
            <input type="checkbox" name="d_r_tr_id">
          </div>
          <div class="data_item">
            <label>Track (ID)</label>
            <select name="r_tr_id">
              <option value="None">None</option>
              <?php 
                include("connect.php");
                $stmt = $conn->query('SELECT * FROM route');
                if ($stmt->num_rows > 0) {
                  while ($row = $stmt->fetch_assoc()) {
                    echo "<option value=\"route.track_id=" . $row['track_id'] . "\">" . $row['track_id'] . "</option>
                    ";
                  }
                }
              ?>
            </select>
          </div>

          <div class="display">
            <label>Display </label>
            <input type="checkbox" name="d_r_time">
          </div>
          <div class="data_item">
            <label>Time</label>
            <select name="r_time_cmp">
              <option value="NULL">None</option>
              <option value="eq">At</option>
              <option value="lt">Before</option>
              <option value="mt">After</option>
            </select>
          </div>
          <div class="data_item">
            <input type="time" name="r_time">
          </div>
        </form>
      </div>
    </div>
  </body>

</html>