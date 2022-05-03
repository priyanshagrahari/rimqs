<?php
$currentPage= $_SERVER['SCRIPT_NAME'];
echo ' 
<div class="side-nav">' .
    (($currentPage == '/rqs/station.php') ? '<li class="current">' : '<li> <a title="Navigate to the STATIONS section" href="station.php">') .
    'STATIONS' .
    (($currentPage == '/rqs/station.php') ? '' : '</a>') .
    '</li>' . 

    (($currentPage == '/rqs/track.php') ? '<li class="current">' : '<li> <a title="Navigate to the TRACKS section" href="track.php">') .
    'TRACKS' .
    (($currentPage == '/rqs/track.php') ? '' : '</a>') .
    '</li>' .
    
    (($currentPage == '/rqs/train.php') ? '<li class="current">' : '<li> <a title="Navigate to the TRAINS section" href="train.php">') .
    'TRAINS' .
    (($currentPage == '/rqs/train.php') ? '' : '</a>') .
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