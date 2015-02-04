<div class="rightMid">
	<!-- DISPLAY MESSAGE START -->
	<?php echo $this->Session->flash();?>
	<!-- DISPLAY MESSAGE END -->
	<div class="mainHd">Add User Details</div>

	<div>
	<?php 
		echo $this->Form->create('User', array('action'=>'admin_add','enctype' => 'multipart/form-data','type'=> 'post'));
	?>

		<div class="formField">
			<span>Name :</span>
			<?php echo $this->Form->input('User.name', array('div'=>false, 'label'=>false, 'type'=>'text', 'class'=>'formInput', 'maxlength'=>100, 'error'=>false, 'style'=>'width:40%;')); echo $this->Form->error('User.name');?>
			<input type="hidden" name="[page]" value="signup">
		</div>
		<div class="formField">
			<span>Email :</span>
			<?php echo $this->Form->input('User.email', array('div'=>false, 'label'=>false, 'type'=>'text', 'class'=>'formInput validate[required,custom[email]]', 'maxlength'=>100, 'error'=>false, 'required'=>true, 'style'=>'width:40%;')); 
			echo $this->Form->error('User.email');?>
		</div>
		<div class="formField">
			<span>Password :</span>
			<?php echo $this->Form->input('User.password', array('div'=>false, 'label'=>false, 'type'=>'password', 'class'=>'formInput validate[required]', 'maxlength'=>100, 'error'=>false, 'style'=>'width:40%;')); echo $this->Form->error('User.password');?>
		</div>
		<div class="formField" style="width:41.5%">
			<span>Gender :</span>
			
			<?php $options = array('male' => 'Male', 'female' => 'Female');
				$attributes = array('div'=>false, 'label'=>false,'required' => false); ?>
			
			<?php echo $this->Form->radio('User.gender',$options, $attributes); ?>
		</div>
		<div class="formField">
			<span>Date of Birth :</span>
			<?php echo $this->Form->input('User.dob', array('div'=>false,'required' => false, 'label'=>false,'dateFormat' => 'DMY','minYear' => date('Y') - 72,'maxYear' => date('Y') - 22,'class'=>'formInput','style'=>'width:13%;'));
			echo $this->Form->error('User.dob');?>
		</div>
		<div class="formField">
			<span>Profile Pic :</span>
			<?php echo $this->Form->input('User.file', array('div'=>false,'required' => false, 'label'=>false, 'type'=>'file', 'class'=>'formInput', 'maxlength'=>100, 'error'=>false, 'style'=>'width:40%;')); echo $this->Form->error('User.file');?>
		</div>
		<div class="formField">
			<span>Device Id :</span>
			<?php echo $this->Form->input('User.device_id', array('div'=>false, 'required' => false,'label'=>false, 'type'=>'text', 'class'=>'formInput', 'maxlength'=>100, 'error'=>false, 'style'=>'width:40%;')); echo $this->Form->error('User.device_id');?>
		</div>
		<div class="formField">
			<span>Longitude :</span>
			<?php echo $this->Form->input('User.longitude', array('div'=>false, 'required' => false,'label'=>false, 'type'=>'text', 'class'=>'formInput', 'maxlength'=>100, 'error'=>false, 'style'=>'width:40%;')); echo $this->Form->error('User.longitude');?>
		</div>
		<div class="formField">
			<span>Latitude :</span>
			<?php echo $this->Form->input('User.latitude', array('div'=>false, 'required' => false,'label'=>false, 'type'=>'text', 'class'=>'formInput', 'maxlength'=>100, 'error'=>false, 'style'=>'width:40%;')); echo $this->Form->error('User.latitude');?>
		</div>
		<div class="formField">
			<span>Altitude :</span>
			<?php echo $this->Form->input('User.altitude', array('div'=>false,'required' => false, 'label'=>false, 'type'=>'text', 'class'=>'formInput', 'maxlength'=>100, 'error'=>false, 'style'=>'width:40%;')); echo $this->Form->error('User.altitude');?>
		</div>
		<div class="formField">
			<span>Platform :</span>
			<?php echo $this->Form->input('User.platform', array('div'=>false, 'required' => false,'label'=>false, 'type'=>'text', 'class'=>'formInput', 'maxlength'=>100, 'error'=>false, 'style'=>'width:40%;')); echo $this->Form->error('User.platform');?>
		</div>		
		<div class="norbtnmain">
			<?php echo $this->Form->submit('Add', array('div'=>false,'required' => false, 'label'=>false, 'class'=>'normalbtn'));?>
		</div>
		<div class="clr"></div>
	<?php echo $this->Form->end();?>
	</div>
</div>