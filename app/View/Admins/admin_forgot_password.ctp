<!-- VALIDATION ENGINE START -->
<script type="text/javascript">	
	$(document).ready(function(){
		$("#AdminAdminForgotPasswordForm").validationEngine()	
	});	
</script>
<!-- VALIDATION ENGINE END -->

<!-- DISPLAY MESSAGE START -->
<?php echo $this->Session->flash();?>
<!-- DISPLAY MESSAGE END -->

<div class="loginBox">
	<?php echo $this->Form->create('Admin', array('action'=>'admin_forgot_password'));?>
	<div class="loginHd">Forgot Password?</div>

	<div class="loginField">Email:</div>
	<div class="loginLabal">
		<?php echo $this->Form->input('Admin.email', array('div'=>false, 'label'=>false, 'type'=>'text', 'error'=>false, 'class'=>'loginInput validate[required,custom[email]]', 'maxlength'=>100, 'required'=>false)); echo $this->Form->error('Admin.email');
		?>
	</div>
	<div class="clr"></div>

	<div class="loginField"></div>
	<div class="loginLabal">
		<span style="float:right; margin-right:10px;">
			<?php echo $this->Html->link('Sign In', '/admin/admins/sign_in/', array('escape'=>false, 'style'=>'color:#FFFFFF;'));?>
		</span>
	</div>
	<div class="clr"></div>

	<div class="loginField"></div>
	<div class="loginLabal">
		<?php
			echo $this->Form->submit('Submit', array('class'=>'signinbtn', 'div'=>false, 'label'=>false));
			echo $this->Form->reset('Reset', array('class'=>'signinbtn', 'div'=>false, 'label'=>false));
		?>
	</div>
	<div class="clr"></div>
	<?php echo $this->Form->end();?>
</div>
