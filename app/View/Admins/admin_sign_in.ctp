<!-- VALIDATION ENGINE START -->
<script type="text/javascript">	
	$(document).ready(function(){
		$("#AdminAdminSignInForm").validationEngine()	
	});	
</script>
<!-- VALIDATION ENGINE END -->

<!-- DISPLAY MESSAGE START -->
<?php echo $this->Session->flash();?>
<!-- DISPLAY MESSAGE END -->

<div class="loginBox">
	<?php echo $this->Form->create('Admin', array('action'=>'sign_in'));?>
	<div class="loginHd">Web Services Administration Login</div>
	<div class="loginField">Your Email:</div>
	<div class="loginLabal">
		<?php echo $this->Form->input('Admin.username', array('div'=>false, 'label'=>false, 'type'=>'text', 'error'=>false, 'class'=>'loginInput validate[required]', 'maxlength'=>50, 'required'=>false)); echo $this->Form->error('Admin.username');
		?>
	</div>
	<div class="clr"></div>

	<div class="loginField">Password:</div>
	<div class="loginLabal">
		<?php echo $this->Form->input('Admin.password', array('div'=>false, 'label'=>false, 'type'=>'password', 'error'=>false, 'class'=>'loginInput validate[required]', 'maxlength'=>70, 'required'=>false)); echo $this->Form->error('Admin.password1');
		?>
	</div>
	<div class="clr"></div>

	<div class="loginField"></div>
	<div class="loginLabal">
		<span style="float:right; margin-right:12px;">
			<?php echo $this->Html->link('Forgot Password', '/admin/admins/forgot_password/', array('escape'=>false, 'style'=>'color:#FFFFFF;'));?>
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
