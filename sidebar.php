<?php
$currentPage= $_SERVER['SCRIPT_NAME'];
echo ' 
<div class="side-nav">
    <li>
      <a title="Navigate to the STATIONS section" href="stations.php"';
    echo ($currentPage == '/rqs/stations.php') ? 'class="current"' : '';
    echo '>STATIONS</a>
    </li>

    <li>
      <a title="Navigate to the TRACKS section" href="tracks.php"';
    echo ($currentPage == '/rqs/tracks.php') ? 'class="current"' : '';
    echo '>TRACKS</a>
    </li>

    <li>
      <a title="Navigate to the TRAINS section" href="trains.php"';
    echo ($currentPage == '/rqs/trains.php') ? 'class="current"' : '';
    echo '>TRAINS</a>
    </li>

    <li>
      <a title="Navigate to the SCHEDULE section" href="schedule.php"';
    echo ($currentPage == '/rqs/schedule.php') ? 'class="current"' : '';
    echo '>SCHEDULE</a>
    </li>

    <li>
      <a title="Navigate to the ROUTE section" href="route.php"';
    echo ($currentPage == '/rqs/route.php') ? 'class="current"' : '';
    echo '>ROUTE</a>
    </li>
</div>
';
?>