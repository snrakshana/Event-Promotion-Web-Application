<?php
    $eventId = $_GET['eventId'];
    include_once('DB.php');
    $sql = "UPDATE event SET status='APPROVED' WHERE event_id=".$eventId;
    $conn->query($sql);
   
    $sql1 = "SELECT * FROM event WHERE event_id=".$eventId;
	$result = $conn->query($sql1);
    $row = $result->fetch_assoc();

    $date=date('y-m-d');
    $endDate=$row['end_date'];

    $current=strtotime($date);
    $mydate=strtotime($endDate);
  
    $num_of_day=round(($mydate-$current)/60/60/24);

    switch($row['event_category']){
        case "Concerts, Musical shows" : $amount=2000;
                                        break;
        case "Art and Drama" : $amount=2500;
                                        break;
        case "Food and Drink Carnivals" : $amount=1000;
                                        break;
        case "Technology Sessions" : $amount=3000;
                                        break;
        case "Exhibitions" : $amount=2000;
                                        break;
        case "Workshops" : $amount=500;
                                        break;
        case "Health Camps" : $amount=200;
                                        break;
        case "Fashion Shows" : $amount=5000;
                                         break;
        default : $amount=3000;
    }

    $payment=$amount*$num_of_day;

    $addpaySql = "UPDATE event SET payment=".$payment." WHERE event_id=".$eventId;

    $conn->query($addpaySql);
    header('Location:adminDashboard.php?state=pending');

    $conn->close();

?>