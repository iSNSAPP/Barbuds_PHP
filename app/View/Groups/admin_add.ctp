<!-- VALIDATION ENGINE START -->
<script type="text/javascript">	
	$(document).ready(function(){
		$("#UserAdminAddForm").validationEngine()	
	});	
</script>
<!-- VALIDATION ENGINE END -->


<div class="rightMid">
	<!-- DISPLAY MESSAGE START -->
	<?php echo $this->Session->flash();?>
	<!-- DISPLAY MESSAGE END -->
	<div class="mainHd">Edit Group Details</div>

	<div>
	<?php 
		echo $this->Form->create('Group', array('action'=>'admin_add'));
	?>

		<div class="formField">
			<span>Name :</span>
			<?php echo $this->Form->input('Group.name', array('div'=>false, 'label'=>false, 'type'=>'text', 'class'=>'formInput validate[required]', 'maxlength'=>100, 'error'=>false,'style'=>'width:40%;')); echo $this->Form->error('Group.name');?>
		</div>
		<div class="norbtnmain">
			<?php echo $this->Form->submit('Add', array('div'=>false, 'label'=>false, 'class'=>'normalbtn'));?>
		</div>
		<div class="clr"></div>
	<?php echo $this->Form->end();?>
	</div>
</div>