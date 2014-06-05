<!DOCTYPE html>
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
		
		<script src="jquery-1.9.1.js" ></script>
		<script>
			<?php 
				require("slots.php");
			?>
		
			$(document).ready(function() 
			{
				$('.main').fadeIn("slow");
			<?php 
				ob_start();
				include "get_names.php";
				$names = ob_get_clean();
				$names = json_decode($names);
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
				
				
			?>
				
			});
			<?php 
					
					ob_start();
					include "get_date.php";
					$date = ob_get_clean();
					$date = json_decode($date);
					ob_end_clean();

					foreach ($date as $key => $value) 
					{
						if($key == "next_date")
						{
							$next_date = $value;
						}
						else if($key == "hour")
						{
							$hour = $value;
						}
						else if($key == "min")
						{
							$min = $value;
						}
					}

					$next_nandos = new DateTime($next_date);
					$next_nandos->setTime((int)$hour, (int)$min);

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