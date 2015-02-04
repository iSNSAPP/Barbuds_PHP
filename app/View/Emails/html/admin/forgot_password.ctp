<div style="margin:20px 5px 5px 5px; font-family:Arial,Helvetica,sans-serif; font-size:12px; color:#000000;">
	Hello <?php echo $adminArr['Admin']['username']?>, <br/><br/>
	Your Login Password has been reset. Your new login credentials are as ,<br/><br/>
	<strong>Email :</strong> <?php echo $adminArr['Admin']['email'];?><br/>
	<strong>Password :</strong> <?php echo $newPassword;?><br/><br/>

	We request you to login and change the password!!<br/>
	Please <a href="<?php echo SITE_PATH.'/';?>">click here</a> to login.<br/><br/>
	With Warm Regards,<br/>
	<?php echo EMAIL_SIGNATURE;?>
</div>