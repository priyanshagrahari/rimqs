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
      </p>
      <input type="checkbox" id="query" style="display:none;">
      <label for="query" class="popup_button">QUERY</label>
    </div>
  </body>

</html>