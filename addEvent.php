<?php
include_once('DB.php');

$userId = $_GET['userId'];

if(isset($_POST['Addevent'])){
	$contact=$_POST['contact'];
	$EventName=$_POST['EventName'];
	$EventType=$_POST['event_catgry'];
	$Venue=$_POST['Location'];
	$date=$_POST['Startdate'];
	$enddate=$_POST['Enddate'];
	
	
	$description=$_POST['description'];
	$check = getimagesize($_FILES["pic"]["tmp_name"]);
    if($check !== false){
        $image = $_FILES['pic']['tmp_name'];
        $imgContent = addslashes(file_get_contents($image));

       
	
	$sql="INSERT INTO event(user_id,contact,event_name,event_category,event_location,event_date,end_date,description,image)
			 VALUES($userId,'$contact','$EventName','$EventType','$Venue','$date','$enddate','$description','$imgContent')";
	
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
	
}

?>