<!DOCTYPE html>
<html>
	<head>
		<link rel="stylesheet" type="text/css" href="css/mainStyle.css">
		<link rel="stylesheet" type="text/css" href="css/form.css">
		<script type="text/javascript">
			function register_validate(){
				var fname = document.getElementById('register').fname.value;
				var lname=document.getElementById('register').lname.value;
				var email=document.getElementById('register').email.value;
				var contact=document.getElementById('register').contact.value;

				var password1=document.getElementById('register').password1.value;

				var password2=document.getElementById('register').password2.value;

			
			if(password1!=password2)
			{
				alert('please fill password correctly');
				
				return false;
			}	
			else if(isNaN(contact))
			{
				alert('invalid phone number');
				return false;
			}
			else
			{
				return true;
			}
			}
			function login_validate(){
				
			}
		</script>
		<style type="text/css">
			table{
				background-color:gray;
				padding:15px;
			}
			td{
				padding:10px;
			}
			th{
				text-align:left;
			}
			input[type=submit],input[type=reset]{
				padding:5px;
				margin:5px;
				font-weight:bold;
			}
			<?php 
				$state = $_GET['state'];
				if($state=='register')
				{
					echo "form#login{display:none;}";
					echo "div#loginerror{display:none}";
					echo "div#regerror{display:none}";
				}
				else if($state=='login')
				{
					echo "form#register{display:none;}";
					echo "div#loginerror{display:none}";
					echo "div#regerror{display:none}";
				}else if($state=='regerror')
				{
					echo "form#login{display:none;}";
					echo "div#loginerror{display:none}";
			
				}else
				{
					echo "form#register{display:none;}";

				}
			?>
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
		
		<div class="body">
			<h2 align="center">Register/Login</h2>
			
			<form id="register" method="post" action="register.php" onsubmit="return(register_validate());">
				<table>
					<tr>
						<th>First Name:</th>
						<td><input type="text" name="fname" required></td>
					</tr>
					<tr>
						<th>Last Name:</th>
						<td><input type="text" name="lname" required></td>
					</tr>
					<tr>
						<th>E-Mail:</th>
						<td><input type="text" name="email" required></td>
					</tr>
					<tr>
						<th>Contact No:</th>
						<td><input type="text" name="contact" required></td>
					</tr>
					<tr>
						<th>Username:</th>
						<td><input type="text" name="uname" required></td>
					</tr>
					<tr>
						<th>Password:</th>
						<td><input type="password" name="password1" required></td>
					</tr>
					<tr>
						<th>Confirm Password:</th>
						<td><input type="password" name="password2" required></td>
					</tr>
					<tr>
						<td colspan="2"><input type="submit" name="register" value="Register"><input type="reset" value="Cancel"></td>
					</tr>
				</table>
			</form>
			
			<form id="login" method="post" action="login.php" onsubmit="">
				<table>
					<tr>
						<th>Username:</th>
						<td><input type="text" name="uname" required></td>
					</tr>
					<tr>
						<th>Password:</th>
						<td><input type="password" name="password" required></td>
					</tr>
					<tr>
						<td colspan="2"><input type="submit" name="login" value="Log In"><input type="reset" value="Cancel"></td>
					</tr>
				</table>
			</form>
			<div id="loginerror">
				<h4>Login failed please try again!</h4>
			</div>
			<div id="regerror">
				<h4>Username already exists please try different Username!</h4>
			</div>
		</div>
	</body>
</html>