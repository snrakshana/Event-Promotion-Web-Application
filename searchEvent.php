<!DOCTYPE html>
<html>
	<head>
		<link rel="stylesheet" type="text/css" href="css/mainStyle.css">
		<link rel="stylesheet" type="text/css" href="css/form.css">
		<style type="text/css">
			div.img{
				margin:10px;
				border:2px insert #0A6A09;
				background:linear-gradient(180deg,transparent,transparent -1%,#001818);;
				opacity:0.9;
				height:280px;
				width:275px;
				float:left;
			}
			div.img img{
				display:inline;
				height:70%;
				width:97%;
				margin:3px;
				opacity:0.9;
				border:2px solid #ffffff;
				border-radius:30px;
			}
			
			div.img a:hover img{
				border:4px solid #000000;
				opacity:1;
			}
			div.desc{
				text-align:center;
				font-weight:bold;
				font-family:Arial;
				padding:3px;
				margin:2px;
				color:#ffffff;
			}
			h2{
				color:#000000;
			}
		</style>
		<?php include_once('DB.php');?>
	</head>
	
	<body>
		<div class="header">
			<span class="logo"><img src="images/Logo_1.png" alt="Logo_1.png"></span>
			<a href="registerLogin.php?state=register"><button>Register</button></a>
			<a href="registerLogin.php?state=login"><button>Login</button></a>
			<p>Want to publish your own event?</p>
		</div>
	
		<hr>
		
		<div class="navbar">
			<ul>
				<li><a href="homePage.html">Home</a></li>
				<li><a href="searchEvent.php">Search Event</a></li>
				<li><a href="about.html">About</a></li>
			</ul>
		</div>
		
		<?php 
			if(isset($_GET['eventType']))
				$eventType = $_GET['eventType'];
			else
				$eventType = "All";
		?>
		
		<div class="body">
			<h2>See If There Is Anything Interesting!</h2>
			<form method="POST">
				<b>Search by type</b> 
				<select name="eventType">
					<option value="All" <?php if($eventType=='All') echo 'selected="selected"';?>>All</option>
					<option value="Concerts, Musical shows" <?php if($eventType=='Concerts, Musical shows') echo 'selected="selected"';?>>Concerts, Musical shows</option>
					<option value="Art and Drama" <?php if($eventType=='Art and Drama') echo 'selected="selected"';?>>Art and Drama</option>
					<option value="Food and Drink Carnivals" <?php if($eventType=='Food and Drink Carnivals') echo 'selected="selected"';?>>Food and Drink Carnivals</option>
					<option value="Technology Sessions" <?php if($eventType=='Technology Sessions') echo 'selected="selected"';?>>Technology Sessions</option>
					<option value="Exhibitions" <?php if($eventType=='Exhibitions') echo 'selected="selected"';?>>Exhibitions</option>
					<option value="Workshops" <?php if($eventType=='Workshops') echo 'selected="selected"';?>>Workshops</option>
					<option value="Health Camps" <?php if($eventType=='Health Camps') echo 'selected="selected"';?>>Health Camps</option>
					<option value="Fashion Shows" <?php if($eventType=='Fashion Shows') echo 'selected="selected"';?>>Fashion Shows</option>
				</select>
				&nbsp;&nbsp;&nbsp;&nbsp;
				<b>Search by location</b> 
				<input type="text" name="location">
				&nbsp;&nbsp;&nbsp;&nbsp;
				<input type="submit" value="Search" >
				<br><br>
			</form>
			
			<div id="results">
				<?php
					if($_SERVER['REQUEST_METHOD']=='POST'){
						if($_POST["eventType"]=='All')
							$sql = "SELECT * FROM event WHERE event_location LIKE '%".$_POST['location']."%' AND status='APPROVED' AND end_date > CURDATE()";
						else
							$sql = "SELECT * FROM event WHERE event_category='".$_POST['eventType']."' AND event_location LIKE '%".$_POST['location']."%' AND status='APPROVED' AND end_date > CURDATE()";
						$result = $conn->query($sql);
						if($result->num_rows>0){
							echo "<h3>".$_POST['eventType']."</h3>";
							while($row = $result->fetch_assoc()){
				?>
						
				<div class="img">
					<a href=<?php echo "eventDetails.php?eventId=".$row["event_id"]?>>
						<img src="getImage.php?id=<?php echo $row['event_id'];?>" alt="No Image">
					</a>
					<div class="desc"><?php echo $row["event_name"]."<br>".$row["event_date"]."<br>".$row["event_location"]?></div>
				</div>
				
				<?php 
							}
						}else{
							echo "<h3>No ".$_POST['eventType']." Going On For Now! :(<br>Try Something Else!</h3>";
						}
					}
					$conn->close();
				?>
			</div>
		</div>
	</body>
</html>