<!-- VALIDATION ENGINE START -->
<script type="text/javascript">	
	$(document).ready(function(){
		$("#AdminAdminChangeEmailForm").validationEngine()	
	});	
</script>
<!-- VALIDATION ENGINE END -->

<div class="rightMid">
	<!-- DISPLAY MESSAGE START -->
	<?php echo $this->Session->flash();?>
	<!-- DISPLAY MESSAGE END -->
	<div class="mainHd">Change Email</div>

	<div>
	<?php 
		echo $this->Form->create('Admin', array('action'=>'admin_change_email'));
		echo $this->Form->hidden('Admin.id');
	?>
		<div class="formField">
			<span>Email :</span>
			<?php echo $this->Form->input('Admin.email', array('div'=>false, 'label'=>false, 'type'=>'text', 'class'=>'formInput validate[required,custom[email]]', 'maxlength'=>100, 'error'=>false, 'required'=>false)); echo $this->Form->error('User.email');?>
		</div>

		<div class="norbtnmain">
			<?php echo $this->Form->submit('Change Email', array('div'=>false, 'label'=>false, 'class'=>'normalbtn'));?>
		</div>
		<div class="clr"></div>
	<?php echo $this->Form->end();?>
	</div>
</div>