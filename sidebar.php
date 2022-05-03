<?php
$currentPage= $_SERVER['SCRIPT_NAME'];
echo ' 
<div class="side-nav">' .
    (($currentPage == '/rqs/stations.php') ? '<li class="current">' : '<li> <a title="Navigate to the STATIONS section" href="station.php">') .
    'STATIONS' .
    (($currentPage == '/rqs/stations.php') ? '' : '</a>') .
    '</li>' . 

    (($currentPage == '/rqs/tracks.php') ? '<li class="current">' : '<li> <a title="Navigate to the TRACKS section" href="track.php">') .
    'TRACKS' .
    (($currentPage == '/rqs/tracks.php') ? '' : '</a>') .
    '</li>' .
    
    (($currentPage == '/rqs/trains.php') ? '<li class="current">' : '<li> <a title="Navigate to the TRAINS section" href="train.php">') .
    'TRAINS' .
    (($currentPage == '/rqs/trains.php') ? '' : '</a>') .
    '</li>' .

    (($currentPage == '/rqs/schedule.php') ? '<li class="current">' : '<li> <a title="Navigate to the SCHEDULE section" href="schedule.php">') .
    'SCHEDULE' .
    (($currentPage == '/rqs/schedule.php') ? '' : '</a>') .
    '</li>' .
    
    (($currentPage == '/rqs/route.php') ? '<li class="current">' : '<li> <a title="Navigate to the ROUTE section" href="route.php">') .
    'ROUTE' .
    (($currentPage == '/rqs/route.php') ? '' : '</a>') .
    '</li>
</div>
';
?>