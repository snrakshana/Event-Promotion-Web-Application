<?php
	 include_once('DB.php');
	 
	 if(isset($_POST['register'])){
		 $fname = $_POST['fname'];
		 $lname = $_POST['lname'];
		 $email = $_POST['email'];
		 $contact = $_POST['contact'];
         $username= $_POST['uname'];
         $password= $_POST['password1'];
         
	 }
	 
	 $sql = "SELECT * FROM user WHERE username='$username'";
                    
        $result = $conn->query($sql);
		if($result->num_rows==1){
			$row = $result->fetch_assoc();
		
			$set = "regerror";
		}
		else{
			$addsql = "Insert Into user(first_name,last_name,email,contact,username,password)
					values('$fname','$lname','$email','$contact','$username','$password')";
					
			if($conn->query($addsql)===true){
				$set = "login";
			}
			else{
				echo "</br> Error :".$conn->error;
			}
		}
		
		header('location:registerLogin.php?state='.$set);
	 
	 $conn->close();
 
 
?> 