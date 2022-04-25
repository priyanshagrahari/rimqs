<?php
  // connect to db
  $conn = new mysqli('localhost', 'root', '', 'rqs');
  if ($conn->connect_errno) {
    die('Connection Failed : '.$conn->connect_error);
  } else {
    // validate existence of table station
    $stmt = $conn->prepare('CREATE TABLE IF NOT EXISTS `station` (
      `station_id` int(11) NOT NULL,
      `station_name` varchar(30) NOT NULL,
      `num_platforms` int(11) NOT NULL,
      `is_open` tinyint(1) NOT NULL,
      PRIMARY KEY (`station_id`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4');
    $stmt->execute();

    // validate existence of table track
    $stmt = $conn->prepare('CREATE TABLE IF NOT EXISTS `track` (
      `track_id` int(11) NOT NULL,
      `station_id_1` int(11) NOT NULL,
      `station_id_2` int(11) NOT NULL,
      PRIMARY KEY (`track_id`),
      KEY `stn1` (`station_id_1`),
      KEY `stn2` (`station_id_2`),
      CONSTRAINT `stn1` FOREIGN KEY (`station_id_1`) REFERENCES `station` (`station_id`),
      CONSTRAINT `stn2` FOREIGN KEY (`station_id_2`) REFERENCES `station` (`station_id`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4');
    $stmt->execute();

    // validate existence of table train
    $stmt = $conn->prepare('CREATE TABLE IF NOT EXISTS `train` (
      `train_id` int(11) NOT NULL,
      `train_name` varchar(30) NOT NULL,
      `num_cars` int(11) NOT NULL,
      `num_seats` int(11) NOT NULL,
      `service_type` varchar(9) NOT NULL,
      PRIMARY KEY (`train_id`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4');
    $stmt->execute();

    // validate existence of table schedule
    $stmt = $conn->prepare('CREATE TABLE IF NOT EXISTS `schedule` (
      `train_id` int(11) NOT NULL,
      `station_id` int(11) NOT NULL,
      `arrival_time` time NOT NULL,
      `halt_duration` time NOT NULL,
      PRIMARY KEY (`train_id`,`arrival_time`),
      KEY `stid` (`station_id`),
      KEY `trid` (`train_id`) USING BTREE,
      CONSTRAINT `stid` FOREIGN KEY (`station_id`) REFERENCES `station` (`station_id`),
      CONSTRAINT `trid` FOREIGN KEY (`train_id`) REFERENCES `train` (`train_id`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4');
    $stmt->execute();

    // validate existence of table route
    $stmt = $conn->prepare('CREATE TABLE IF NOT EXISTS `route` (
      `train_id` int(11) NOT NULL,
      `track_id` int(11) NOT NULL,
      `time` time NOT NULL,
      PRIMARY KEY (`train_id`,`track_id`,`time`),
      KEY `trid` (`train_id`),
      KEY `trkid` (`track_id`),
      CONSTRAINT `hehe` FOREIGN KEY (`train_id`) REFERENCES `train` (`train_id`),
      CONSTRAINT `trkid` FOREIGN KEY (`track_id`) REFERENCES `track` (`track_id`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4');
    $stmt->execute();
    $stmt->close();
    $conn->close();
  }
?>