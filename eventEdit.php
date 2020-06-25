<?php
    $eventId = $_GET['eventId'];
    $userId = $_GET['userId'];
    include_once('DB.php');

    if(isset($_POST['edit'])){
        $contact=$_POST['contact'];
        $EventName=$_POST['EventName'];
        $location=$_POST['Location'];
        $date=$_POST['Startdate'];
        $enddate=$_POST['Enddate'];
        $description=$_POST['description'];
        
           
        
        $sql="UPDATE event SET event_name='$EventName', event_location=' $location',contact='$contact',event_date='$date',end_date='$enddate',description='$description' 
                WHERE event_id=$eventId";
        
            if($conn->query($sql)===TRUE)
            {
                header('location:eventHolderDashboard.php?state=edit&userId='.$userId);
            
            }
            
            else if($conn->query($sql)===FALSE)
            {
                echo "<br/> error". $conn->error;
            }
                else
                {
                    echo "<br/> error". $conn->error;
                }
                
                
                
      
      
      
        
                $conn->close();
        
        
        
    }
    
?>