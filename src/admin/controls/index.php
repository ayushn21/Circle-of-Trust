<?php 
	session_start();
	if(!isset($_SESSION['user']))
	{
		header("location:admin.php?login=1");
	}
?>

<!DOCTYPE html>
<html>
	<head>
		<title>Nando's Circle of Trust: Administration</title>
		
		<link rel="stylesheet" type="text/css" href="../../CSS/Index.css" />
		<link rel="stylesheet" type="text/css" href="../../CSS/admin.css" />
		<link rel="stylesheet" type="text/css" href="../../CSS/controls.css" />
		<link rel="stylesheet" href="../../jquery-ui-1.10.2/themes/dark-hive-red/jquery-ui.css">
		<link rel="shortcut icon" type="image/x-icon" href="../../Images/favicon.ico" />
		
		<script src="../../jquery-1.9.1.js" ></script>
		<script src="../../jquery-ui-1.10.2/ui/jquery-ui.js"></script>
		<script src="../../Scripts/controls.js" ></script>
		<script src="../../globalize.js" ></script>
		
		<script type="text/javascript">
			$(document).ready(function() 
			{
				$('.main').fadeIn("slow");
			<?php 
						$namesXML = new DOMDocument();
						$namesXML->load('../../XML/names.xml');
					
						$nameNode = $namesXML->getElementsByTagName("name");
						$circleNode = $namesXML->getElementsByTagName("circle");
						$i=0;
						foreach ($nameNode as $n)
						{
							echo("$('.users').animate({height: '+=40'}, 0);");
							echo("$('.usersTable').append('<tr class=\"userRow\">\\
															<td><input type=\"text\" class=\"userTextBox\" maxlength=\"9\" value=\"".$n->nodeValue."\"></td>\\
															<td><input class=\"circleTextBox\" readonly=\"true\" value=\"".$circleNode->item($i)->nodeValue."\"></td>\\
															<td style=\"font-size:14px;\"><input type=\"button\" value=\"Delete\" class=\"deleteUser\" onclick=\"deleteUser(this);\"></td>\\
														  </tr>');
														  ");
							$i = $i+1;
						}
			?>
				$("input[type=button]").button();

				  $(function() {
					    $( "#date" ).datepicker({dateFormat: "dd.mm.yy"});
					  });

				$('#createAccount').keyup(function(e) {
				     var code = (e.keyCode ? e.keyCode : e.which);
				     if(code == 13) { 
				    	 createAccountSubmit();
				     }
				    });

				$('#changePassword').keyup(function(e) {
				     var code = (e.keyCode ? e.keyCode : e.which);
				     if(code == 13) { 
				    	 changePasswordSubmit();
				     }
				    });
			    
				$( "#errorMessage" ).dialog({
					  autoOpen: false,  
				      modal: true,
				      resizable: false,
				      draggable: false,
				      show: 200,
				      buttons: {
				        Ok: function() {
				          $( this ).dialog( "close" );
				        }
				      }
				    });
				$( "#savedDialog" ).dialog({
					  autoOpen: false,  
				      modal: true,
				      resizable: false,
				      draggable: false,
				      show: 200,
				      buttons: {
				        Ok: function() {
				          $( this ).dialog( "close" );
				        }
				      }
				    });
				$( "#errorDialog" ).dialog({
					  autoOpen: false,  
				      modal: true,
				      resizable: false,
				      draggable: false,
				      show: 200,
				      buttons: {
				        Ok: function() {
				          $( this ).dialog( "close" );
				        }
				      }
				    });

				$( "#accountCreated" ).dialog({
					  autoOpen: false,  
				      modal: true,
				      resizable: false,
				      draggable: false,
				      show: 200,
				      buttons: {
				        Ok: function() {
				          $( this ).dialog( "close" );
				        }
				      }
				    });

				$( "#dateSaved" ).dialog({
					  autoOpen: false,  
				      modal: true,
				      resizable: false,
				      draggable: false,
				      show: 200,
				      buttons: {
				        Ok: function() {
				          $( this ).dialog( "close" );
				        }
				      }
				    });
			    

				$( "#passwordChanged" ).dialog({
					  autoOpen: false,  
				      modal: true,
				      resizable: false,
				      draggable: false,
				      show: 200,
				      buttons: {
				        Ok: function() {
				          $( this ).dialog( "close" );
				        }
				      }
				    });

				$( "#incorrectCount" ).dialog({
					  autoOpen: false,  
				      modal: true,
				      resizable: false,
				      draggable: false,
				      show: 200,
				      width:400,
				      buttons: {
				        Ok: function() {
				          $( this ).dialog( "close" );
				        }
				      }
				    });
			    

				$( "#createAccount" ).dialog({
					  autoOpen: false,  
				      modal: true,
				      resizable: false,
				      draggable: false,
				      width:450,
				      show: 200, 
				      dialogClass: "no-close",
				      buttons: {
				        "Create Account": function() {
						  createAccountSubmit();
				        },
				        Cancel: function() {
					          $( this ).dialog( "close" ); 
					        }
				      },
				      close: function(){
				    	  $("#createAccountError")
					        .removeClass( "errorMessage" ).empty();
					      $("#username").val("");
					      $("#pwd").val("");
					      $("#pwd2").val("");  
				      }
				    });

				$( "#changePassword" ).dialog({
					  autoOpen: false,  
				      modal: true,
				      resizable: false,
				      draggable: false,
				      width:450,
				      show: 200,
				      dialogClass: "no-close",
				      buttons: {
				        "Change Password": function() {
						  changePasswordSubmit();
				        },
				        Cancel: function() {
					          $( this ).dialog( "close" ); 
					        }
				      },
				      close: function(){
				    	  $("#changePasswordError")
					        .removeClass( "errorMessage" ).empty();
					      $("#oldPassword").val("");
					      $("#newPassword").val("");
					      $("#newPassword2").val("");  
				      }
				    });
			    
			    $(".circleTextBox").spinner({min:1,max:3});
			    $("#hour").spinner({min:0,max:23,numberFormat: "d2"});
			    $("#min").spinner({min:0,max:59,numberFormat:"d2"});
				
			});
		</script>
		<style type="text/css">
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
				<img src="../../Images/Logo.gif">
			</div>
			
			<div class="title">
				Controls
			</div>
			
			<div class="users">
				<div class="usersTitle">Users</div>
				
				<table class="usersTable">
					
				</table>
				
				<input type="button" value="Add User" class="controlButton" onclick="addUser()" style="top:50px;font-size:18px">
				<input type="button" value="Save" class="controlButton" onclick="saveUsersToXML()" style="top:50px;font-size:18px">
			</div>
			
			<div class="nandosDate">
				<div class="usersTitle">Next Nando's</div>
				<table class="dateTable">
					<tr>
						<td><label for="date" class="dateLabel">Date:</label></td>
						<td><input type="text" class="userTextBox" name="date" id="date" readonly="true" value="<?php $dateXML = simplexml_load_file("../../XML/date.XML"); echo $dateXML->date; ?>"></td>
					</tr>
					
					<tr>
						<td><label for="date" class="dateLabel">Time:</label></td>
						<td><input type="text" style="width:30px;" class="timeSpinner" name="date" id="hour" readonly="true" value="<?php $dateXML = simplexml_load_file("../../XML/date.XML"); echo $dateXML->hour; ?>">&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;
						<input type="text" style="width:30px;" class="timeSpinner" name="date" id="min" readonly="true" value="<?php $dateXML = simplexml_load_file("../../XML/date.XML"); echo $dateXML->min; ?>"></td>
						
					</tr>
				</table><br>
				<input type="button" value="Save" onclick="saveDate()" class="controlButton" style="top:40px;font-size:18px;">
			</div>
			
			<div class="controlButtons">
				<input type="button" value="Create Account" class="controlButton" onclick="createAccount()" style="top:40px;font-size:25px; width:275px;">
				<input type="button" value="Change Password" class="controlButton" onclick="changePassword()" style="top:50px;font-size:25px">
				<input type="button" value="Logout" class="controlButton" onclick="location.href='Login/logout.php'" style="top:90px;font-size:25px">
			</div>
		
		</div>
		<br><br><br><br><br><br><br><br>
		
		<div id="errorMessage" title="Error">
			<p>Please check the username and circle fields.</p>
		</div>
		<div id="savedDialog" title="Settings saved!">
			<p>Settings saved successfully.</p>
		</div>
		<div id="errorDialog" title="Error">
			<p>Error. Please try again.</p>
		</div>
		<div id="accountCreated" title="Account created!">
			<p>Account created successfully.</p>
		</div>
		<div id="dateSaved" title="Date Saved!">
			<p>Date saved successfully.</p>
		</div>
		<div id="passwordChanged" title="Password Changed!">
			<p>Password changed successfully.</p>
		</div>
		<div id="incorrectCount" title="Too many names in a circle">
			<p>You are only allowed to have 12 names in the Inner Circle, 10 names in the Outer Circle and 12 names Outside the Cirle.</p>
		</div>
		
		<div id="createAccount" title="Create Account">
			<p style="font-weight: bold; text-align:center;">Create a New Account</p>	
	
			<form>
				<table>
					<tr style="height:40px;">
						<td colspan="2"><span id="createAccountError"></span></td>
					</tr>
					<tr class="dialogFormRow">
						<td><label for="username">Username:</label></td>
						<td><input id="username" type="text" class="createAccountTextBox" name="username"></td>
					</tr>
					<tr class="dialogFormRow">
						<td><label for="pwd">Password:</label></td>
						<td><input id="pwd" type="password" class="createAccountTextBox" name="pwd"></td>
					</tr>
					<tr class="dialogFormRow">
						<td><label for="pwd2">Confirm Password:</label></td>
						<td><input id="pwd2" type="password" class="createAccountTextBox" name="pwd2"></td>
					</tr>
				</table>
			</form>
		</div>
		
		<div id="changePassword" title="Change your Password">
			<p style="font-weight: bold; text-align:center;">Change your Password</p>	
	
			<form>
				<table>
					<tr style="height:40px;">
						<td colspan="2"><span id="changePasswordError"></span></td>
					</tr>
					<tr class="dialogFormRow">
						<td><label for="oldPassword">Old Password:</label></td>
						<td><input id="oldPassword" type="password" name="oldPassword"></td>
					</tr>
					<tr class="dialogFormRow">
						<td><label for="newPassword">New Password:</label></td>
						<td><input id="newPassword" type="password" name="newPassword"></td>
					</tr>
					<tr class="dialogFormRow">
						<td><label for="newPassword2">Confirm Password:</label></td>
						<td><input id="newPassword2" type="password" name="newPassword2"></td>
					</tr>
				</table>
			</form>
		</div>
		<div class="bottomBanner">
			Built by Ayush Newatia. &copy; <img src="Images/dsotm.jpg" style="height:12px; width:auto;" />
		</div>
	</body>
</html>