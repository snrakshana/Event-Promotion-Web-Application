<?php
	 include_once('DB.php');
	 
	 if(isset($_POST['login'])){
         $username= $_POST['uname'];
         $password= $_POST['password'];
    }
     
    $admin="admin";
    $adminpwd="password";

	 if($username == $admin && $password == $adminpwd){
        header('location:adminDashboard.php?state=all');
     }
     else{
		$sql = "SELECT * FROM user WHERE username='".$username."' AND password='".$password."'";
                    
        $result = $conn->query($sql);
		if($result->num_rows==1){
            $row = $result->fetch_assoc();
            //echo $row['user_id'];
			header('location:eventHolderDashboard.php?state=approved&userId='.$row['user_id']);
		}
		else{
			header('location:registerLogin.php?state=loginerror');
		}
    }
	 
	 $conn->close();
 
 
?> 