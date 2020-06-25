<!DOCTYPE html>
<html>
	<head>
		<link rel="stylesheet" type="text/css" href="css/mainStyle.css">
		<style type="text/css">
			table{
				display:inline-block;
				background-color:white;
				
			}
			td{
				padding-right:30px;
				padding-left:30px;
				text-align:left;
			}
			div.body img{
				border:4px solid #8888AA;
			}
		</style>
		
		<?php
			include_once('DB.php');
			$eventId = $_GET['eventId'];
			$sql = "SELECT * FROM event WHERE event_id=".$eventId;
			$result = $conn->query($sql);
			$event = $result->fetch_assoc();
		?>
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
		
		<div class="body">
			<h2><?php echo $event["event_name"]?></h2>
			<table>
				<tr>
					<td rowspan="4"><img src="getImage.php?id=<?php echo $event['event_id'];?>" alt="No Image" height="250px" width="350px"></td>
					<td><h3>On : <?php echo $event["event_date"]?></h3></td>
				</tr>
				<tr>
					<td><h3>At : <?php echo $event["event_location"]?></h3></td>
				</tr>
				<tr>
					<td><h3><?php echo $event["event_category"]?></h3></td>
				</tr>
				<tr>
					<td><h3>Contact : <?php echo $event["contact"]?></h3></td>
				</tr>
				<tr>
					<td colspan="2" style="text-align:center;"><p><?php echo $event["description"]?></p></td>
				</tr>
			</table>
		</div>
	</body>
</html>