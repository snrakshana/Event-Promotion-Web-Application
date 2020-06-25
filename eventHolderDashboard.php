<!DOCTYPE html>
<html>
	<head>
	<link rel="stylesheet" href="css/bootstrap.min.css">
        <script src="js/bootstrap.min.js"></script>
        <link rel="stylesheet" href="css/admin.css">
		<link rel="stylesheet" type="text/css" href="css/form.css">
		<style type="text/css">
				.logo img{
					width: 25%;
					height: 20%px;
					display: inline;
					padding-top: 1%;
					padding-bottom: 1%;
					padding-left: 1%;
				
					
				}

				li.nav-item a.nav-link:hover{
					background-color:#595959;	
				}

				a.nav-link{
					margin-left:75px; 
				}

				td[colspan="7"] {
					text-align: center;
				}
			<?php 
				$state = $_GET['state'];
				if($state=='new')
				{
					echo "div#edit{display:none;}";
					echo "div#approved{display:none;}";
					echo "div#editform{display:none;}";
				}else if($state=='edit')
				{
					echo "div#approved{display:none;}";
					echo "div#editform{display:none;}";
					echo "div#new{display:none;}";
				}else if($state=='editform')
				{
					echo "div#approved{display:none;}";
					echo "div#new{display:none;}";
					echo "div#edit{display:none;}";
				}else
				{
					echo "div#editform{display:none;}";
					echo "div#new{display:none;}";
					echo "div#edit{display:none;}";
				}
			?>
		</style>
		<script>

				function validation()
				{
				var dvalue = document.getElementById('formin').Startdate.value;
				var evalue=document.getElementById('formin').Enddate.value;
				var eventname=document.getElementById('formin').EventName.value;
				

				var venue=document.getElementById('formin').Location.value;

				var description=document.getElementById('formin').description.value;

				var phone=document.getElementById('formin').contact.value;


				if(isNaN(phone))
				{
					alert('invalid phone number');
					return false;
				}
				else if(dvalue<evalue)
				{
				alert('Last Ad Date cannot exceed Event Date');
				return false;
				}
				else
				{
				return true;
				}
				}

				
			</script>
		<?php include_once('DB.php');?>
		<?php $userId = $_GET['userId'];?>

	</head>
	
	<body>
	<div class="container-fluid">

		<span class="logo"><img src="images/Logo_1.png" alt="Logo_1.png"></span>
		<nav style="margin: fill" class="navbar navbar-expand-xl navbar-light bg-dark">

			
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="#navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>

			<div class="collapse navbar-collapse" id="navbarSupportedContent">
				<ul class="navbar-nav mr-auto">

					<li class="nav-item">
						<a class="nav-link" href="eventHolderDashboard.php?state=new&userId=<?php echo $userId;?>" style="color:white;">New Request</a>
					</li>
					<li class="nav-item">
					<a class="nav-link" href="eventHolderDashboard.php?state=edit&userId=<?php echo $userId;?>" style="color:white;">Edit Request</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="eventHolderDashboard.php?state=approved&userId=<?php echo $userId;?>" style="color:white;">Approved Requests</a>
					</li>
					<li class="nav" id="log">

						<a  href="homePage.html" class="btn btn-light" role="button" style="margin-left:100px;">Logout</a>
					</li>
					



				</ul>
			</div>
		</nav>
		
		
		<div class="Line" style="height: 20px; background: white"> </div>

        <div class="Line" style="height: 100px; background: white">

            <div class="view intro-2">
                <div class="full-bg-img">
                    <div class="mask rgba-black-light flex-center">
                        <div class="container text-center white-text">
                            <div class="white-text text-center wow fadeInUp">
                                <h2>
									<?php 
										switch($state){
											case "new" : echo "Add Your Event Here";
																			break;
											case "edit" : echo "Not Approved Events";
																			break;
											case "editform" : echo "Edit Your Form Here";
																			break;
											case "approved" : echo "Approved Events";
																			break;
											default : echo "Welcome !";
										}										
									?>
								</h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
			


		<div id="approved">
			<?php
				$sql = "SELECT * FROM event WHERE user_id=".$userId." AND status='APPROVED'";
				$result = $conn->query($sql);
				
			?>


			<div class="table-responsive">
				<table class="table table-striped table-dark">
					<tr>
						<th>Event Name</th>
						<th>Event Category</th>
						<th>Event Location</th>
						<th>Event Date</th>
						<th>Bill Amount</th>
					</tr>
					
				
					
				<?php
					if($result->num_rows>0){
						while($row = $result->fetch_assoc()){
				?>
							<tr>
								<td><?php echo $row['event_name']?></td>
								<td><?php echo $row['event_category']?></td>
								<td><?php echo $row['event_location']?></td>
								<td><?php echo $row['event_date']?></td>
								<td><?php echo $row['payment']?></td>
							</tr>
					<?php
					}

					}else
					{
						echo "<tr colspan='5'><td>No Events</td></tr>";
					}
				?>
				</table>
			
			</div>
		</div>


		<div id="new">
			
			<form action="addEvent.php?userId=<?php echo $userId;?>" method="post" enctype="multipart/form-data" id="formin" onsubmit="return(validation());">
			<div class="table-responsive">
				<table>
					
					<tr>
					<td>Event Name</td>
					<td><input type="text" name="EventName" required></td>
					</tr>
					<tr><td>Event Category</td><td><select name="event_catgry" required>

							<option value="Concerts, Musical shows" >Concerts, Musical shows</option>
							<option value="Art and Drama">Art and Drama</option>
							<option value="Food and Drink Carnivals">Food and Drink Carnivals</option>
							<option value="Technology Sessions">Technology Sessions</option>
							<option value="Exhibitions">Exhibitions</option>
							<option value="Workshops">Workshops</option>
							<option value="Health Camps">Health Camps</option>
							<option value="Fashion Shows">Fashion Shows</option>
								</select></td></tr>
								<tr>
					<td>Location</td>
					<td><input type="text" name="Location" required></td>
					</tr> 
					<tr>
					<td>Event Date</td>
					<td><input type="date" name="Startdate" required></td>
					</tr>
					<tr>
					<tr>
					<td>Advertisment Last Date</td>
					<td><input type="date" name="Enddate" required></td>
					</tr>
					<tr>
					<td>Phone number</td>
					<td><input type="text" name="contact" required></td>
					</tr>
		
					<tr>
					<td>Description</td>
					<td><textarea rows="4" cols="50" name="description" required></textarea></td>
					</tr>
					<tr>
					<td>Image</td>
					<td><input type="file" name="pic" accept="image/*" required>
					
					</tr>
					<tr>
					<td></td>
					<td style="text-align:right;"><input type="submit" name="Addevent" value="Add Event" required></td>
					<tr>
					
				</table>
			
			</div>
			
			</form>
			
		</div>
			
			
			
		<div id="edit">
			<?php

				$sql = "SELECT * FROM event WHERE user_id=".$userId." AND status='NOT APPROVED'";
				$result = $conn->query($sql);

			?>
				<div class="table-responsive">
					<table class="table table-striped table-dark" >
						<tr>
							<th>Event Name</th>
							<th>Event Category</th>
							<th>Event Location</th>
							<th>Event Date</th>
							<th>Ad Last Date</th>
							<th></th>
							<th></th>
						</tr>


					<?php
						
						if($result->num_rows>0){
							while($row = $result->fetch_assoc()){
					?>
						<tr>
							<td><?php echo $row['event_name'];?></td>
							<td><?php echo $row['event_category'];?></td>
							<td><?php echo $row['event_location'];?></td>
							<td><?php echo $row['event_date'];?></td>
							<td><?php echo $row['end_date'];?></td>
							<form method="POST">
								<td>
									<a href=<?php echo "eventHolderDashboard.php?state=editform&userId=".$userId."&eventId=".$row['event_id'];?>><span class="btn btn-light">Edit</span></a>
								</td>
								<td>
									<a href=<?php echo "eventDelete.php?userId=".$userId."&eventId=".$row['event_id'];?>><span class="btn btn-danger">Delete</span></a>
								</td>
							</form>
							
						</tr>

					<?php
							}
						}else{

							echo "<tr colspan='7'><td>No Events</td></tr>";
						}
					?>
					</table>
				</div>
		</div>

		<div id="editform">

				<?php 
					$eventId = $_GET['eventId'];
					$sql = "SELECT * FROM event WHERE event_id=".$eventId;
					$result = $conn->query($sql);
					$row = $result->fetch_assoc();
				?>
			<form action="eventEdit.php?userId=<?php echo $userId;?>&eventId=<?php echo $eventId;?>" method="post"  id="formin" onsubmit="return(validation());">
				<div class="table-responsive">
					<table>
						
						<tr>
						<td>Event Name</td>
						<td><input type="text" name="EventName" value=<?php echo $row['event_name'];?> required></td>
						</tr>
			
						<tr>
						<td>Location</td>
						<td><input type="text" name="Location" value="<?php echo $row['event_location'];?>" required></td>
						</tr> 
						<tr>
						<td>Event Date</td>
						<td><input type="date" name="Startdate" value="<?php echo $row['event_date'];?>" required></td>
						</tr>
						<tr>
						<td>Advertisment Last Date</td>
						<td><input type="date" name="Enddate" value="<?php echo $row['end_date'];?>" required></td>
						</tr>
						<tr>
						<td>Phone number</td>
						<td><input type="text" name="contact" value=<?php echo $row['contact'];?> required></td>
						</tr>


						<tr>
						<td>Description</td>
						<td><textarea rows="4" cols="50" name="description" required><?php echo $row['description'];?></textarea></td>
						</tr>
						<tr>
						<td></td>
						<td style="text-align:right;"><input type="submit" name="edit" value="Save Changes"></td>
						</tr>
						
					</table>
				</div>
				
			</form>
		</div>
		
	</div>
	</body>
</html>