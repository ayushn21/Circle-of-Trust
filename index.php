<?php echo 
"<!DOCTYPE html>
<html>
	<head>
		<title>Nando's Circle of Trust</title>
		
		<!--[if IE]>
		<script type="text/javascript">
			window.location = "ieerror.html";
		</script>
		<![endif]-->
		
		<link rel="stylesheet" type="text/css" href="CSS/Index.css" />
		<link rel="shortcut icon" type="image/x-icon" href="Images/favicon.ico" />
		<link rel="stylesheet" href="../../jquery-ui-1.10.2/themes/dark-hive-red/jquery-ui.css">

		<script src="jquery-1.9.1.js" ></script>
		<script src="jquery-ui-1.10.2/ui/jquery-ui.js"></script>


		<script>"

				require("slots.php");
			?>
		
			$(document).ready(function() 
			{
				$( "#database_error" ).dialog({
					  autoOpen: false,  
				      modal: true,
				      resizable: false,
				      draggable: false,
				      width:450,
				      show: 200,
				      buttons: {
				        Ok: function() {
				          $( this ).dialog( "close" );
				        }
				      }
				    });

				$('.main').fadeIn("slow");
			<?php 
				ob_start();
				include "get_names.php";
				$names = ob_get_clean();
				if($names == "db_connection_error" || $date == "table_error")
				{	
					echo ("$(\"#database_error\").dialog(\"open\");");
				}
				else
				{
					$names = json_decode($names,true);
					ob_end_clean();
				
					$innerCircleCounter = 0;
					$outerCircleCounter = 0;
					$outsideTheCircleCounter = 0;
					$userCounter = 0;
				
					foreach($names as $name => $position)
					{
						if($position == 3)
						{
							echo("$('.outsideTheCircle').prepend('<div class=\"name\" style=\"position:absolute;".$outsideTheCircleSlots[$outsideTheCircleCounter]."\">".$name."</div>');\n");
							$outsideTheCircleCounter = $outsideTheCircleCounter + 1;
						}
						else if($position == 2)
						{
							echo("$('.outerCircle').append('<div class=\"name\" style=\"position:absolute;".$outerCircleSlots[$outerCircleCounter]."\">".$name."</div>');\n");
							$outerCircleCounter = $outerCircleCounter + 1;
						}
						else if($position == 1)
						{
							echo("$('.innerCircle').append('<div class=\"name\" style=\"position:absolute;".$innerCircleSlots[$innerCircleCounter]. "\">".$name."</div>');\n");
							$innerCircleCounter = $innerCircleCounter + 1;
						}
						$userCounter = $userCounter + 1;
					}
				}
				
			?>
				
			});
			<?php 
					
					ob_start();
					include "get_date.php";
					$date = ob_get_clean();
					if($date == "db_connection_error" || $date == "table_error")
					{	
						$next_nandos = new DateTime("01.01.2001");
						$next_nandos->setTime(00,00);
						echo ("$(\"#database_error\").dialog(\"open\");");
					}
					else
					{
						$date = json_decode($date,true);
						ob_end_clean();

						$next_nandos = new DateTime($date["next_date"]);
						$next_nandos->setTime((int)$date["hour"], (int)$date["min"]);
					}
				?>
					var now = new Date();
					var nextNandos = new Date(<?php echo($next_nandos->format('Y'));
													echo(",");
													echo(((int)$next_nandos->format('m'))-1);
													echo(",");
													echo($next_nandos->format('d'));
													echo(",");
													echo((int)$next_nandos->format('H'));
													echo(",");
													echo($next_nandos->format('i'));
													echo(",");
													echo($next_nandos->format('s'));
													echo(",");
													echo("0");

					?>);
				
					

					if(now.getTime()<nextNandos.getTime())
					{
						var difference = parseInt(nextNandos.getTime()/1000)-parseInt(now.getTime()/1000);

						var seconds = difference % 60;
						difference = parseInt(difference/60);
						var minutes = difference % 60;
						difference = parseInt(difference/60);
						var hours = difference % 24;
						difference = parseInt(difference/24);
						var days = difference;
												
					}
					else
					{
						var days = 0;
						var hours = 0;
						var minutes = 0;
						var seconds = 1;
					}
			var countdown = setInterval(timer, 1000);
			function timer()
			{
				seconds = seconds - 1;
				if(seconds==0 && minutes==0 && hours==0 && days==0)
				{
					clearInterval(countdown);
				}
				else if(seconds < 0)
				{
					seconds = 59;
					minutes = minutes - 1;

					if(minutes < 0)
					{
						minutes = 59;
						hours = hours - 1;

						if(hours < 0)
						{
							hours = 23;
							days = days - 1;
						}
					}
				}
				document.getElementById("countdownTimer").innerHTML = days + "<span style=\"font-size:15px; font-family:sans-serif;\"> d </span>" + hours + "<span style=\"font-size:15px; font-family:sans-serif;\"> h </span>" + minutes + "<span style=\"font-size:15px; font-family:sans-serif;\"> m </span>" + seconds + "<span style=\"font-size:15px; font-family:sans-serif;\"> s</span>";	
			} 

		</script>
	</head>
	
	<body>
		<div class="main">
				
				<div class="countdown">
					<span class="countdownTitle">Time To Next Nando's</span><br>
					<span class="countdownNumber" id="countdownTimer"></span>
				</div>
				
			<div class="logo">
				<img src="Images/Logo.gif">	
			</div>

			<div class="mainTitle">
				Circle of Trust	
			</div>
			
			<div class="outsideTheCircle">
				<div class="outerCircle">
					<div class="innerCircle">
					
					</div>
				</div>
			</div>
		</div>
		<br><br><br>
		<div class="bottomBanner">
			<a href="/admin" class="bottomBanner">Admin</a> | Built by Ayush Newatia. &copy; <img src="Images/dsotm.jpg" style="height:12px; width:auto;" />
		</div>


		<div id="database_error" title="Database Connection Error">
			<p>Error connecting to the database. Please try again later.</p>
		</div>

	</body>	
	<!--
	
	
	/\    
 ------/  \------______
 -----/    \---------___
-----/      \---___
    /        \     ---
   /__________\

	
	-->
</html>