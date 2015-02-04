<!-- VALIDATION ENGINE START -->
<script type="text/javascript">	
	$(document).ready(function(){
		$("#UserAdminEditForm").validationEngine()	
	});	
</script>
<!-- VALIDATION ENGINE END -->

<!-- CALL CALENDER FILES START -->
<?php
	echo $this->Html->script('calender/jscal2');
	echo $this->Html->script('calender/lang/en');
	echo $this->Html->css('calender/jscal2');
	echo $this->Html->css('calender/border-radius');
	echo $this->Html->css('calender/steel/steel');
?>
<!-- CALL CALENDER FILES END -->

<div class="rightMid">
	<!-- DISPLAY MESSAGE START -->
	<?php echo $this->Session->flash();?>
	<!-- DISPLAY MESSAGE END -->
	<div class="mainHd">Edit Sub Admin Details</div>

	<div>
	<?php 
		echo $this->Form->create('Admin', array('action'=>'admin_edit'));
		echo $this->Form->hidden('Admin.id');
		echo $this->Form->hidden('Admin.country');
		echo $this->Form->hidden('Admin.state');
	?>

		<div class="formField">
			<span>Username :</span>
			<?php echo $this->Form->input('Admin.username', array('div'=>false, 'label'=>false, 'type'=>'text', 'class'=>'formInput validate[required]', 'maxlength'=>100, 'error'=>false, 'style'=>'width:40%;')); echo $this->Form->error('User.username');?>
		</div>
		<div class="formField">
			<span>Email :</span>
			<?php echo $this->Form->input('Admin.email', array('div'=>false, 'label'=>false, 'type'=>'text', 'class'=>'formInput validate[required,custom[email]]', 'maxlength'=>100, 'error'=>false, 'required'=>false, 'style'=>'width:40%;')); echo $this->Form->error('Admin.email');?>
		</div>
			<div class="norbtnmain">
			<?php echo $this->Form->submit('Update', array('div'=>false, 'label'=>false, 'class'=>'normalbtn'));?>
		</div>
		<div class="clr"></div>
	<?php echo $this->Form->end();?>
	</div>
</div>