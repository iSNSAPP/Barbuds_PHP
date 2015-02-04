<div class="rightMid">
	<!-- DISPLAY MESSAGE START -->
	<?php echo $this->Session->flash();?>
	<!-- DISPLAY MESSAGE END -->
	<div class="mainHd">Add User Details</div>

	<div>
	<?php 
		echo $this->Form->create('Event', array('action'=>'create_events','enctype' => 'multipart/form-data','type'=> 'post'));
	?>

		<div class="formField">
			<span>Event Name :</span>
			<?php echo $this->Form->input('Event.name', array('div'=>false, 'label'=>false, 'type'=>'text', 'class'=>'formInput', 'maxlength'=>100, 'error'=>false, 'style'=>'width:40%;')); echo $this->Form->error('Event.name');?>
		</div>
		<div class="formField">
			<span>Event Picture :</span>
			<?php echo $this->Form->input('Event.file', array('div'=>false,'required' => false, 'label'=>false, 'type'=>'file', 'class'=>'formInput', 'maxlength'=>100, 'error'=>false, 'style'=>'width:40%;')); echo $this->Form->error('Event.file');?>
		</div>
		<div class="formField">
			<span>Event Location :</span>
			<?php echo $this->Form->input('Event.location', array('div'=>false, 'label'=>false, 'type'=>'text', 'class'=>'formInput', 'maxlength'=>100, 'error'=>false, 'style'=>'width:40%;')); echo $this->Form->error('Event.location');?>
		</div>
		<div class="formField">
			<span>Event Address :</span>
			<?php echo $this->Form->textarea('Event.address', array('div'=>false, 'label'=>false, 'class'=>'formInput', 'rows'=>6,'rows' =>6, 'error'=>false, 'style'=>'width:40%;')); 
			echo $this->Form->error('Event.address');?>
		</div>
		<div class="formField">
			<span>Event Date :</span>
			<?php echo $this->Form->input('User.date', array('div'=>false,'required' => false, 'type' =>'date','label'=>false,'dateFormat' => 'DMY','minYear' => date('Y') - 72,'maxYear' => date('Y') - 22,'class'=>'formInput','style'=>'width:13%;'));
			echo $this->Form->error('User.date');?>
		</div>
		<div class="formField">
			<span>Event Time :</span>
			<?php echo $this->Form->input('User.time', array('div'=>false,'required' => false, 'type' =>'time','label'=>false,'class'=>'formInput','style'=>'width:13%;'));
			echo $this->Form->error('User.date');?>
		</div>
		<div class="formField">
			<span>Event Details :</span>
			<?php echo $this->Form->textarea('Event.event_details', array('div'=>false, 'label'=>false, 'class'=>'formInput', 'rows'=>6,'rows' =>6, 'error'=>false, 'style'=>'width:40%;')); 
			echo $this->Form->error('Event.event_details');?>
		</div>
		<div class="norbtnmain">
			<?php echo $this->Form->submit('Submit', array('div'=>false,'required' => false, 'label'=>false, 'class'=>'normalbtn'));?>
		</div>
		<div class="clr"></div>
	<?php echo $this->Form->end();?>
	</div>
</div>