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
				$slotsWidth = "width:180px;";
				
				$innerCircleSlots = array(
									   	  "top:170px; left:5px; ".$slotsWidth,
										  "top:170px; left:190px; ".$slotsWidth,
										  "top:50px; left:95px; ".$slotsWidth,
										  "top:290px; left:95px; ".$slotsWidth,
										  "top:130px; left:10px; ".$slotsWidth,
										  "top:210px; left:10px; ".$slotsWidth,
										  "top:130px; left:190px; ".$slotsWidth,
										  "top:210px; left:190px; ".$slotsWidth,
										  "top:90px; left:15px; ".$slotsWidth,
										  "top:250px; left:15px; ".$slotsWidth,
										  "top:90px; left:185px; ".$slotsWidth,
										  "top:250px; left:185px; ".$slotsWidth
										 );
				
				$outerCircleSlots = array(
										  "top:290px; left:10px; ".$slotsWidth,
										  "top:290px; left:560px; ".$slotsWidth,
										  "top:430px; left:10px; ".$slotsWidth,
										  "top:430px; left:560px; ".$slotsWidth,
										  "top:165px; left:85px; ".$slotsWidth,
										  "top:165px; left:475px; ".$slotsWidth,
										  "top:550px; left:85px; ".$slotsWidth,
										  "top:550px; left:475px; ".$slotsWidth,
										  "top:75px; left:285px; ".$slotsWidth,
										  "top:630px; left:285px; ".$slotsWidth);
				
				$outsideTheCircleSlots = array(
											   "top:20px; left:70px; ".$slotsWidth,
											   "top:20px; left:730px; ".$slotsWidth,
											   "top:705px; left:70px; ".$slotsWidth,
											   "top:705px; left:730px; ".$slotsWidth,
											   "top:70px; left:30px; ".$slotsWidth,
											   "top:70px; left:770px; ".$slotsWidth,
											   "top:655px; left:30px; ".$slotsWidth,
											   "top:655px; left:770px; ".$slotsWidth,
											   "top:120px; left:0px; ".$slotsWidth,
											   "top:120px; left:800px; ".$slotsWidth,
											   "top:605px; left:0px; ".$slotsWidth,
											   "top:605px; left:800px; ".$slotsWidth,


											  );
			
			?>
		
			$(document).ready(function() 
			{$('.main').fadeIn("slow");
			<?php 
				$xmlDoc = simplexml_load_file("XML/names.xml");	
				$names = $xmlDoc->names->children();
				
				$innerCircleCounter = 0;
				$outerCircleCounter = 0;
				$outsideTheCircleCounter = 0;
				$userCounter = 0;
				
				foreach ($names as $n)
				{
					if($xmlDoc->circles->circle[$userCounter] == 3)
					{
						echo("$('.outsideTheCircle').prepend('<div class=\"name\" style=\"position:absolute;".$outsideTheCircleSlots[$outsideTheCircleCounter]."\">".$n."</div>');\n");
						$outsideTheCircleCounter = $outsideTheCircleCounter + 1;
					}
					else if($xmlDoc->circles->circle[$userCounter] == 2)
					{
						echo("$('.outerCircle').append('<div class=\"name\" style=\"position:absolute;".$outerCircleSlots[$outerCircleCounter]."\">".$n."</div>');\n");
						$outerCircleCounter = $outerCircleCounter + 1;
					}
					else if($xmlDoc->circles->circle[$userCounter] == 1)
					{
						echo("$('.innerCircle').append('<div class=\"name\" style=\"position:absolute;".$innerCircleSlots[$innerCircleCounter]. "\">".$n."</div>');\n");
						$innerCircleCounter = $innerCircleCounter + 1;
					}
					
					$userCounter = $userCounter + 1;
				}
				
				
			?>
				
			});

			<?php 
					
					$dateXML = simplexml_load_file("XML/date.XML");
					
					$nextNandos = new DateTime($dateXML->date);
					$nextNandos->setTime((int)$dateXML->hour, (int)$dateXML->min);

				?>
					var now = new Date();
					var nextNandos = new Date(<?php echo($nextNandos->format('Y'));
													echo(",");
													echo(((int)$nextNandos->format('m'))-1);
													echo(",");
													echo($nextNandos->format('d'));
													echo(",");
													echo((int)$nextNandos->format('H'));
													echo(",");
													echo($nextNandos->format('i'));
													echo(",");
													echo($nextNandos->format('s'));
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
			<a href="admin.php" class="bottomBanner">Admin</a> | Built by Ayush Newatia. &copy; <img src="Images/dsotm.jpg" style="height:12px; width:auto;" />
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