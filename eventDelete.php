<?php
    $eventId = $_GET['eventId'];
    $userId = $_GET['userId'];
    include_once('DB.php');
    $sql = "DELETE FROM event WHERE event_id=".$eventId;
    $result = $conn->query("SELECT status FROM event WHERE event_id=".$eventId);
    $row = $result->fetch_assoc();
    header('location:eventHolderDashboard.php?state=edit&userId='.$userId);
    $conn->query($sql);
    
?>