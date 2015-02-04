<div style="margin:20px 5px 5px 5px; font-family:Arial,Helvetica,sans-serif; font-size:12px; color:#000000;">
	Hello <?php echo $userArr['User']['name'];?>, <br/><br/>
	
	Your account has been created. Your login credentials are as ,<br/><br/>
	<strong>Email:</strong> <?php echo $userArr['User']['email'];?><br/>
	<?php if(isset($newPassword)){ ?>
	<strong>Password:</strong> <?php echo $newPassword;?><br/><br/>
	

	We request you to login and change the password!!<br/>
	<?php } ?>
	Please <a href="#">Click Here</a> to login.<br/><br/>
	With Warm Regards,<br/>
	<?php echo EMAIL_SIGNATURE;?>
</div>