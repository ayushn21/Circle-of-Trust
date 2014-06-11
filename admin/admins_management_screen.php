			<script type="text/javascript">
				$("input[type=button]").button();
			</script>
			<?php
			ob_start();
			include "get_admin_info.php";
			$admin_info = ob_get_clean();
			if($admin_info == "db_connection_error" || $admin_info == "table_error")
			{
				$admin_info = array();
				echo ("<script type=\"text/javascript\">$(\"#database_error\").dialog(\"open\");</script>");
			}
			else
			{
				$admin_info = json_decode($admin_info);
			}
			?>
			<p autofocus style="font-weight: bold; text-align:center;">Manage Administrators</p>	
			<table width="500px" style="position: relative; text-align: center; margin-left:auto; margin-right:auto;">
				<tr style="height:40px;">
					<td colspan="4"><span id="manageAdminsError"></span></td>
				</tr>
				<tr>
					<td title="Administrator's username">Username</td>
					<td title="Does the Administrator have manager privileges">Manager?</td>
					<td title="Grant or revoke manager privileges">Permission</td>
					<td>&nbsp;</td>
				</tr>
				<tr>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
				</tr>
				<?php 
					foreach ($admin_info as $admin_name => $permission) 
					{
						if($permission == "t")
						{
							$permission = "Yes";
						}
						else
						{
							$permission = "No";
						}
						echo '<tr>';
						echo '<td>'.$admin_name.'</td>';
						echo '<td>'.$permission.'</td>';
						if($permission == "Yes")
						{
							echo '<td><input type="button" value="Revoke" onClick="revokeManagerClick(this)" style="width:100px;"></td>';
						}
						else
						{
							echo '<td><input type="button" value="Grant" onClick="grantManagerClick(this)" style="width:100px;"></td>';
						}
						echo '<td><input type="button" value="Delete" onClick="deleteAdminClick(this)"></td>';
						echo '</tr>';
					}
				?>
			</table>