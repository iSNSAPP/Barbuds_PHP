<!-- VALIDATION ENGINE START -->
<script type="text/javascript">	
	$(document).ready(function(){
		$("#AdminAdminChangePasswordForm").validationEngine()	
	});	
</script>
<!-- VALIDATION ENGINE END -->

<div class="rightMid">
	<!-- DISPLAY MESSAGE START -->
	<?php echo $this->Session->flash();?>
	<!-- DISPLAY MESSAGE END -->
	<div class="mainHd">Change Login Password</div>

	<div>
	<?php 
		echo $this->Form->create('Admin', array('action'=>'admin_change_password'));
		echo $this->Form->hidden('Admin.id');
	?>
		<div class="formField">
			<span>Current Password :</span>
			<?php echo $this->Form->password('Admin.password', array('div'=>false, 'label'=>false, 'class'=>'formInput validate[required]', 'maxlength'=>50, 'error'=>false)); echo $this->Form->error('User.password');?>
		</div>

		<div class="formField">
			<span>New Password :</span>
			<?php echo $this->Form->password('Admin.new_password', array('div'=>false, 'label'=>false, 'class'=>'formInput validate[required]', 'maxlength'=>50, 'error'=>false)); echo $this->Form->error('User.new_password');?>
		</div>

		<div class="formField">
			<span>Confirm Password :</span>
			<?php echo $this->Form->password('Admin.confirm_password', array('div'=>false, 'label'=>false, 'class'=>'formInput validate[required]', 'maxlength'=>50, 'error'=>false)); echo $this->Form->error('User.confirm_password');
			//equals[AdminNewPassword]
			?>
		</div>

		<div class="norbtnmain">
			<?php echo $this->Form->submit('Change Password', array('div'=>false, 'label'=>false, 'class'=>'normalbtn'));?>
		</div>
		<div class="clr"></div>
	<?php echo $this->Form->end();?>
	</div>
</div>