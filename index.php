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
        To create a new query, click on the button below:
      </p> <br>
      <input type="checkbox" id="query" style="display:none;">
      <label for="query" class="popup_button">QUERY</label>
      <div class="popup_content q">
        <label for="query" class="close_button" title="Close">&#x2BBE;</label>
        Select the field(s) you want to display in the query:
        <form action="" method="post">
            <div class="data_item">
              <label>Fields</label>
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
        </form>
      </div>
    </div>
  </body>

</html>