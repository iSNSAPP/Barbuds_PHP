<div class="rightMid">
	<!-- DISPLAY MESSAGE START -->
	<?php echo $this->Session->flash();?>
	<!-- DISPLAY MESSAGE END -->
	<div class="mainHd">Edit User Details</div>

	<div>
	<?php 
		echo $this->Form->create('User', array('action'=>'admin_edit','enctype' => 'multipart/form-data'));
		echo $this->Form->hidden('User.id');
		
	?>

		<div class="formField">
			<span>Name :</span>
			<?php echo $this->Form->input('User.name', array('div'=>false, 'label'=>false, 'type'=>'text', 'class'=>'formInput', 'maxlength'=>100, 'error'=>false, 'style'=>'width:40%;')); echo $this->Form->error('User.name');?>
		</div>
		<div class="formField">
			<span>Email :</span>
			<?php echo $this->Form->input('User.email', array('div'=>false, 'label'=>false, 'type'=>'text', 'class'=>'formInput validate[required,custom[email]]', 'maxlength'=>100, 'error'=>false, 'required'=>true, 'style'=>'width:40%;')); 
			echo $this->Form->error('User.email');?>
		</div>
		<div class="formField" style="width:41.5%">
			<span>Gender :</span>
			<?php $options = array('male' => 'Male', 'female' => 'Female');
				$attributes = array('div'=>false, 'label'=>false); ?>
			<?php echo $this->Form->radio('User.gender',$options, $attributes); ?>
		</div>
		<div class="formField">
			<span>Date of Birth :</span>
			<?php 
			echo $this->Form->input('User.dob', array('div'=>false, 'label'=>false,'dateFormat' => 'DMY','minYear' => date('Y') - 72,'maxYear' => date('Y') - 22,'class'=>'formInput','style'=>'width:13%;'));
			echo $this->Form->error('User.dob');?>
		</div>
		<div class="formField">
			<span>Profile Pic :</span>
			<?php echo $this->Form->input('User.file', array('div'=>false, 'label'=>false, 'type'=>'file', 'class'=>'formInput', 'maxlength'=>100, 'error'=>false, 'style'=>'width:40%;')); echo $this->Form->error('User.file');?>
		</div>
		<div class="formField">
			<span>Device Id :</span>
			<?php echo $this->Form->input('User.device_id', array('div'=>false, 'label'=>false, 'type'=>'text', 'class'=>'formInput', 'required' => false,'maxlength'=>100, 'error'=>false, 'style'=>'width:40%;')); echo $this->Form->error('User.device_id');?>
		</div>
		<div class="formField">
			<span>Longitude :</span>
			<?php echo $this->Form->input('User.longitude', array('div'=>false, 'label'=>false, 'type'=>'text', 'class'=>'formInput','required' => false, 'maxlength'=>100, 'error'=>false, 'style'=>'width:40%;')); echo $this->Form->error('User.longitude');?>
		</div>
		<div class="formField">
			<span>Latitude :</span>
			<?php echo $this->Form->input('User.latitude', array('div'=>false, 'label'=>false, 'type'=>'text', 'class'=>'formInput','required' => false, 'maxlength'=>100, 'error'=>false, 'style'=>'width:40%;')); echo $this->Form->error('User.latitude');?>
		</div>
		<div class="formField">
			<span>Altitude :</span>
			<?php echo $this->Form->input('User.altitude', array('div'=>false, 'label'=>false, 'type'=>'text', 'class'=>'formInput','required' => false, 'maxlength'=>100, 'error'=>false, 'style'=>'width:40%;')); echo $this->Form->error('User.altitude');?>
		</div>
		<div class="formField">
			<span>Platform :</span>
			<?php echo $this->Form->input('User.platform', array('div'=>false, 'label'=>false, 'type'=>'text', 'class'=>'formInput', 'required' => false,'maxlength'=>100, 'error'=>false, 'style'=>'width:40%;')); echo $this->Form->error('User.platform');?>
		</div>
		<div class="norbtnmain">
			<?php echo $this->Form->submit('Update', array('div'=>false, 'label'=>false, 'class'=>'normalbtn'));?>
		</div>
		<div class="clr"></div>
	<?php echo $this->Form->end();?>
	</div>
</div>