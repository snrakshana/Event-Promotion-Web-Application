<?php
    $eventId = $_GET['eventId'];
    include_once('DB.php');
    $sql = "DELETE FROM event WHERE event_id=".$eventId;
    $result = $conn->query("SELECT status FROM event WHERE event_id=".$eventId);
    $row = $result->fetch_assoc();
    if($row['status']=='APPROVED')
        $setback = "approved";
    else 
        $setback = "pending";
    $conn->query($sql);
    header('Location:adminDashboard.php?state='.$setback);
?>