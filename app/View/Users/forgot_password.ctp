<!-- VALIDATION ENGINE START -->
<script type="text/javascript">	
	$(document).ready(function(){
		$("#UserForgotPasswordForm").validationEngine()	
	});	
</script>
<!-- VALIDATION ENGINE END -->

<?php echo $this->Session->flash();?>

<div style="min-height:444px;">
	<h3>Forgot Password</h3>
	<?php echo $this->Form->create('User', array('action'=>'forgot_password'));?>
		<div class="contactmainbox">
			<div class="loginbox">
				<div class="contactfrmin">
					<div class="logiontogap">&nbsp;</div>
					<div class="cotactformlable">Email Address:</div>
					<div class="formfield">
						<?php echo $this->Form->input('User.email', array('div'=>false, 'label'=>false, 'type'=>'text', 'class'=>'forminput validate[required,custom[email]]', 'maxlength'=>'70', 'required'=>false));?>
						<div class="loginforgetpass">
							<span style="float:left; margin-top:10px;"><?php echo $this->Form->submit('front_end/submit_btn.png', array('label'=>false, 'div'=>false));?></span>
							<span style="float:right;"><?php echo $this->Html->link('Sign In', '/users/sign_in/', array('escape'=>false));?></span>
						</div>
					</div>
					<div class="clr"></div>
				</div>					
			</div>
		</div>
	<?php echo $this->Form->end();?>
	<div class="clr"></div>
</div>
<div class="clr"></div>