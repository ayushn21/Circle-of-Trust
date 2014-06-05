<!DOCTYPE html>
<html>
	<head>
		<title>Nando's Circle of Trust: Login</title>
		
		<!--[if IE]>
		<script type="text/javascript">
			window.location = "ieerror.html";
		</script>
		<![endif]-->
		
		<link rel="stylesheet" type="text/css" href="../CSS/Index.css" />
		<link rel="stylesheet" type="text/css" href="../CSS/admin.css" />
		<link rel="stylesheet" href="../jquery-ui-1.10.2/themes/custom-theme/jquery-ui.css">
		<link rel="shortcut icon" type="image/x-icon" href="../Images/favicon.ico" />
		
		<script src="../jquery-1.9.1.js" ></script>
		<script src="../jquery-ui-1.10.2/ui/jquery-ui.js"></script>
		<script type="text/javascript">
		
		$(document).ready(function() 
		{

			$('.main').fadeIn();
			$("input[type=button]").button();

			$('#username').keyup(function(e) {
			     var code = (e.keyCode ? e.keyCode : e.which);
			     if(code == 13) { 
			    	 login();
			     }
			    });

			$('#pwd').keyup(function(e) {
			     var code = (e.keyCode ? e.keyCode : e.which);
			     if(code == 13) { 
			    	 login();
			     }
			    });
		});

		function login()
		{
			$.post("../Login/login.php",
					{
						username:$("#username").val(),pwd:$("#pwd").val()
					},
				function(data,status)
					{
						if(data == "success" && status == "success")
						{
							window.location = "/admin/controls/";
						}
						else if(data == "failure" && status == "success")
						{
							$("#usernameError").css("display","none");	
							$(".error").css("display","none");	
							$("#usernameError").text("Check the Username or Password.");
							$("#usernameError").fadeIn();
						}
						else
						{
							$("#usernameError").css("display","none");
							$(".error").css("display","none");	
							$("#usernameError").text("Server Error. Please try again.");
							$("#usernameError").fadeIn();
						}
					});
		}
		
		</script>
		<style>
		
		div.logo
		{	
			position:relative;
			top:0;
			text-align:center;
			width:400px;
			margin-left:auto;
			margin-right:auto;
		}
		</style>
	</head>
	
	<body>
		<div class="main">
		
			<div class="logo">
				<a href="../"><img src="../Images/Logo.gif"></a>
			</div>
			
			<div class="title">
				Login	
			</div>
			<br><br><br><br>
			
			<div class="loginPanel">	
				<div class="form">
					<form class="loginForm" method="post">
						<table class="form">
							<tr height="70px">
								<td>Username: &nbsp;&nbsp;</td>
								<td><input type="text" name="username" id="username" class="textBox"/></td>
							</tr>
							<tr height="70px">
								<td>Password: &nbsp;&nbsp;</td>
								<td><input type="password" name="pwd" id="pwd" class="textBox"/></td>
							</tr>
							<tr>
								<td colspan="2" style="text-align: center; font-size: 30px;"><input type="button" value="Login" onclick="login()" class="submit" style="top:10px;"/></td>
							</tr>
						</table>
					</form>
				</div>
				<div class="errorMessage">	
					<span class="usernameError" id="usernameError"></span>
				<?php 
				
					
					$logout=false;
					
					if(isset($_GET["login"]))
					{
						$login=true;
					}
					else
					{
						$login=false;
					}
										
					if(isset($_GET["logout"]))
					{
						$logout=true;
					}
					else
					{
						$logout=false;
					}

					if($login)
					{
						echo("<p class=\"error\">You are not logged in.</p>");
					}
					else if($logout)
					{
						echo("<p class=\"error\">You have successfully logged out.</p>");
					}
				?>
				</div>
			</div>
			<div class="goToCircle">
			<span class="goToCircle"><a class="goToCircle" href="../">Click here to go to the Circle</a></span>
			<br><br><br><br><br>
			</div>
		</div>
		<div class="bottomBanner" style="position:absolute;">
			Built by Ayush Newatia. &copy; <img src="../Images/dsotm.jpg" style="height:12px; width:auto;" />
		</div>
	</body>
</html>