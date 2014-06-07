function addUser()
				{
				$('.users').animate({height: '+=40'}, 300);
				$('.usersTable').append('<tr class="userRow">\
						<td><input type="text" class="userTextBox" maxlength="9"></td>\
						<td><input class="circleTextBox" readonly="true"></td>\
						<td style="font-size:14px;"><input type="button" value="Delete" class="deleteUser" onclick="deleteUser(this)"></td>\
					  </tr>');
				$("input[type=button]").button();
				$(".circleTextBox").spinner({min:1,max:3});
				}

function deleteUser(row)
			{
				$(row).parent().parent().remove();
				$('.users').animate({height: '-=40'}, 500);
			}

function createAccount()
{
	$("#createAccount").dialog("open");
}

function changePassword()
{
	$("#changePassword").dialog("open");
}

function createAccountSubmit()
{	
	var username = $.trim($("#username").val());

	var flag=false;

	if(username.length>0 && $.trim($("#pwd").val()).length>0 && $.trim($("#pwd2").val()).length>0 )
		{
			if($.trim($("#pwd").val()) == $.trim($("#pwd2").val()))
			{
				flag=true;
			}
			else
			{
				$("#createAccountError").css("display","none");
				$("#createAccountError")
		        	.text("The passwords do not match")
		        	.addClass( "errorMessage");
				$("#createAccountError").fadeIn(300);
			}
		}
	else
	{
		$("#createAccountError").css("display","none");
		$("#createAccountError")
        	.text("One of the fields is blank")
        	.addClass( "errorMessage");
		$("#createAccountError").fadeIn(300);
	}
	
	if(flag)
	{   
		var info_array = {};
		info_array["username"] = $.trim($("#username").val());
		info_array["password"] = $("#pwd").val();
		var info_json = JSON.stringify(info_array);

		$.post("save/create_account.php",
				{
					account_info:info_json
				},
			function(data,status){
					if(data == "success" && status == "success")
					{
						$("#createAccount").dialog("close");
						$("#accountCreated").dialog("open");
					}
					else if(data == "clash" && status == "success")
					{
						$("#createAccountError").css("display","none");
						$("#createAccountError")
				        	.text("Username exists. Please choose another username.")
				        	.addClass( "errorMessage");
						$("#createAccountError").fadeIn(300);
					}
					else if(data == "not_logged_in" && status == "success")
					{
						window.location.replace("../?login=1");
					}
					else
					{
						$("#createAccountError").css("display","none");
						$("#createAccountError")
				        	.text("Error. Please try again.")
				        	.addClass( "errorMessage");
						$("#createAccountError").fadeIn(300);
					}
				 });
	}		
}

function saveDate()
{
	if($("#date").val().length > 0)
	{
		var date_array = {};
		date_array["next_date"] = $("#date").val().trim();
		date_array["hour"] = $("#hour").val().trim();
		date_array["min"] = $("#min").val().trim();

		var date_json = JSON.stringify(date_array);

		$.post("save/save_date.php",
				{
					next_date: date_json
				},
			function(data,status)
				{
					if(data == "success" && status == "success")
					{
						$("#dateSaved").dialog("open");
					}
					else if(data == "not_logged_in" && status == "success")
					{
						window.location.replace("../?login=1");
					}
					else
					{
						$("#errorDialog").dialog("open");
					}
				});
	}
}

function saveUsersToDB()
{
				var usersArray = {};
				var flag = true;
				var counterFlag = true;
				
				var innerCircleCount = 0;
				var outerCircleCount = 0;
				var outsideTheCircleCount = 0;
				
				$("tr.userRow").each(function() 
				{
					$this = $(this)
					usersArray[$.trim($this.find("input.userTextBox").val())] = $.trim($this.find("input.circleTextBox").val());
				});

				$.each(usersArray, function(user,position)
				{
					if(user.length > 9 || user.length < 1 || +position < 1 || +position > 3)
					{
						flag = false;
					}
					else
					{
						flag = true;
					}
					if(+position == 1)
					{
						innerCircleCount = innerCircleCount + 1;
					}
					else if(+position == 2)
					{
						outerCircleCount = outerCircleCount + 1;
					}
					else if(+position == 3)
					{
						outsideTheCircleCount = outsideTheCircleCount + 1;
					}
				});
				
				if(innerCircleCount > 12 || outerCircleCount > 10 || outsideTheCircleCount > 12)
				{
					counterFlag = false;
				}

				if(flag && counterFlag)
				{
				var users_json = JSON.stringify(usersArray);
				$.post("save/save_users_to_db.php",
						{
							user_data:users_json
						},
					function(data,status){
							if(data == "success" && status == "success")
							{
								$("#savedDialog").dialog("open");
							}
							else if(data == "not_logged_in" && status == "success")
							{
								window.location.replace("../?login=1");
							}
							else
							{
								$("#errorDialog").dialog("open");
							}
						 });
				 }
				else
				{
					if(!flag)
					{
						$( "#errorMessage" ).dialog( "open" );
					}
					else
					{
						$( "#incorrectCount" ).dialog( "open" );
					}
					 
				}
}

function changePasswordSubmit()
{
	var flag = false;
	
	
	if($("#oldPassword").val().length>0 && $("#newPassword").val().length>0 && $("#newPassword2").val().length>0 )
	{
		if($.trim($("#newPassword").val()) == $.trim($("#newPassword2").val()))
		{
			flag=true;
		}
		else
		{
			$("#changePasswordError").css("display","none");
			$("#changePasswordError")
	        	.text("The passwords do not match")
	        	.addClass( "errorMessage");
			$("#changePasswordError").fadeIn(300);
		}
	}
	else
	{
		$("#changePasswordError").css("display","none");
		$("#changePasswordError")
        	.text("One of the fields is blank")
        	.addClass( "errorMessage");
		$("#changePasswordError").fadeIn(300);
	}
	
	if(flag)
	{   
		var password_array = {};
		password_array["old_password"] = $.trim($("#oldPassword").val());
		password_array["new_password"] = $.trim($("#newPassword").val());

		var password_json = JSON.stringify(password_array);

		$.post("save/change_password.php",
				{
					password_data:password_json
				},
			function(data,status){
					if(data == "success" && status == "success")
					{
						$("#changePassword").dialog("close");
						$("#passwordChanged").dialog("open");
					}
					else if(data == "clash" && status == "success")
					{
						$("#changePasswordError").css("display","none");
						$("#changePasswordError")
				        	.text("The old password is incorrect")
				        	.addClass( "errorMessage");
						$("#changePasswordError").fadeIn(300);
					}
					else if(data == "not_logged_in" && status == "success")
					{
						window.location.replace("../?login=1");
					}
					else
					{
						$("#changePasswordError").css("display","none");
						$("#changePasswordError")
				        	.text("Error. Please try again.")
				        	.addClass( "errorMessage");
						$("#changePasswordError").fadeIn(300);
					}
				 });
	}

}