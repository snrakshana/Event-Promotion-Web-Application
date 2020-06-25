<!DOCTYPE html>
<html>
	<head>

        <link rel="stylesheet" href="css/bootstrap.min.css">
        <script src="js/bootstrap.min.js"></script>
        <link rel="stylesheet" href="css/admin.css">
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

				
				
			<?php
				$state = $_GET['state'];
				if($state=='pending')
				{
					echo "div#approved{display:none;}";
					echo "div#all{display:none;}";
				}
				else if($state=='approved')
				{
					echo "div#all{display:none;}";
					echo "div#pending{display:none;}";
				}else
				{
					echo "div#pending{display:none;}";
					echo "div#approved{display:none;}";
				}
			?>
		</style>
		<?php include_once('DB.php');?>
	</head>
	<body>
    <div class="container-fluid" >






		<span class="logo"><img src="images/Logo_1.png" alt="Logo_1.png"></span>
        <nav style="margin: fill" class="navbar navbar-expand-xl navbar-light bg-dark">

            
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">

                    <li class="nav-item">
                        <a class="nav-link" href="adminDashboard.php?state=pending" style="color:white;">Pending Requests</a>
                    </li>
                    <li class="nav-item">
                    <a class="nav-link" href="adminDashboard.php?state=approved" style="color:white;">Approved Requests</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="adminDashboard.php?state=all" style="color:white;"> All Requests</a>
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
											case "pending" : echo "Pending Requests";
																			break;
											case "approved" : echo "Approved Events";
																			break;
											case "all" : echo "Events History";
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


		
		<div id="all">
			<?php

				$sql = "SELECT * FROM event";
				$result = $conn->query($sql);

			?>





                <div class="table-responsive">
				<table class="table table-striped table-dark">
					<tr>
						<th>Event Id</th>
						<th>Event Category</th>
						<th>Event Name</th>
						<th>Start Date</th>
						<th>Location</th>
					</tr>

			<?php 

				if ($result->num_rows > 0) {
				// output data of each row
					while ($row = $result->fetch_assoc()) { 
			?>

					<tr>
						<td><?php echo $row["event_id"]; ?></td>
						<td><?php echo $row["event_category"]; ?></td>
						<td><?php echo $row["event_name"]; ?></td>
						<td><?php echo $row["event_date"]; ?></td>
						<td><?php echo $row["event_location"]; ?></td>
					</tr>

				<?php	 

				}

				} else 

				{
					echo "<tr colspan='5'><td>No Events</td></tr>";
				}
				
				?>
				</table>
				
				</div>
			</div>
			
			<div id="approved">
		
			<?php

				$sql = "SELECT * FROM event where status=1";
				$result1 = $conn->query($sql);

			?>
                <div class="table-responsive">
				<table class="table table-striped table-dark" >
					<t>
						<th>Event Id</th>
						<th>Event Category</th>
						<th>Event Name</th>
						<th>Start Date</th>
						<th>Ad Last Date</th>
						<th>Location</th>
						<th>Bill Amount</th>
						<th></th>
					</t>

			<?php 

				if ($result1->num_rows > 0) {
				// output data of each row
					while ($row = $result1->fetch_assoc()) { 
			?>

					<tr>
						<td><?php echo $row["event_id"]; ?></td>
						<td><?php echo $row["event_category"]; ?></td>
						<td><?php echo $row["event_name"]; ?></td>
						<td><?php echo $row["event_date"]; ?></td>
						<td><?php echo $row['end_date']?></td>
						<td><?php echo $row["event_location"]; ?></td>
						<td><?php echo $row["payment"]; ?></td>
						<form method="POST">
							<td>

                                <a href=<?php echo "delete.php?eventId=".$row['event_id'];?>><span class="btn btn-danger">Delete</span></a>
                            </td>
						</form>
					</tr>

				<?php	 

				}

				} else 

				{
					echo "<tr colspan='8'><td>No Events</td></tr>";
				}
				
				?>
				</table>
                </div>

			</div>
			
			<div id="pending">
				<?php

				$sql = "SELECT * FROM event where status=2";
				$result = $conn->query($sql);

				?>
                <div class="table-responsive">
				<table class="table table-striped table-dark">
					<tr>
						<th>Event Id</th>
						<th>Event Category</th>
						<th>Event Name</th>
						<th>Start Date</th>
						<th>Location</th>
						<th></th>
						<th></th>
					</tr>

				<?php 

				if ($result->num_rows > 0) {
				// output data of each row
					while ($row = $result->fetch_assoc()) { 
				?>

					<tr>
						<form method="POST">
						<td><?php echo $row["event_id"]; ?></td>
						<td><?php echo $row["event_category"]; ?></td>
						<td><?php echo $row["event_name"]; ?></td>
						<td><?php echo $row["event_date"]; ?></td>
						<td><?php echo $row["event_location"]; ?></td>






							<td>
                                <a href=<?php echo "approve.php?eventId=".$row['event_id'];?>><span class="btn btn-light">Approve</span></a>
                            </td>
							<td>
                                <a href=<?php echo "delete.php?eventId=".$row['event_id'];?>><span class="btn btn-danger">Delete</span></a>
                            </td>
						</form>
					</tr>

					

				<?php	 

				}

				} else 

				{
					echo "<tr colspan='7'><td>No Events</td></tr>";
				}

				?>
				</table>
                </div>
			</div>
    </div>
	<?php $conn->close();?>
	</body>
</html>