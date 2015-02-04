<div style="margin:20px 5px 5px 5px; font-family:Arial,Helvetica,sans-serif; font-size:12px; color:#000000;">
	Hello <?php echo $userArr['Admin']['username'];?>, <br/><br/>
	
	You Account has been <?php echo $message;?> by Administrator.<br/><br/>

	<?php if($message == 'Deactivated'){?>
	Please contact Administrator for the same!
	<?php }else{ ?>
	Please <a href="<?php echo SITE_PATH.'admin/admins/sign_in';?>">Click Here</a> to login to your account.
	<?php } ?><br/><br/>

	With Warm Regards,<br/>
	<?php echo EMAIL_SIGNATURE;?>
</div>