<?php $userArr = $this->App->viewAll($this->params['pass']['0'],'User'); ?>
<div id="main" style=" width:700px;">
	<h3>User Details</h3>
	<?php if(!empty($userArr)) {?>
	<fieldset>
		<div style="position: absolute;border: 1px solid;width: 20%;margin-left: 72%;min-height: 20%;">
		
		<?php	if(!empty($userArr['User']['profile_pic'])){
				$filename = realpath('../../app/webroot/img/Profile_pic/');
				$filename = $filename .'/'. basename($userArr['User']['profile_pic']); 
				
				if (file_exists($filename)) {
						echo $this->Html->image('Profile_pic/'.$userArr['User']['profile_pic'],array('title' => 'Profile Pic','style' =>array('width:100%'))); ?>
					<?php }else {
						echo $this->Html->image('user_pic.jpg',array('title' => 'Profile Pic','style' =>array('width:100%'))); 
					}
			}else{
				echo $this->Html->image('user_pic.jpg',array('title' => 'Profile Pic','style' =>array('width:100%'))); 
			}
				?>
		</div>
		<div class="fielddiv">
			<div class="fielddiv1">Name :</div>
			<div class="fielddiv2"><?php echo $userArr['User']['name'];?></div>
		</div>
		<div class="clear"></div>
		<div class="fielddiv">
			<div class="fielddiv1">Email :</div>
			<div class="fielddiv2"><?php echo $userArr['User']['email'];?></div>
		</div>
		<div class="clear"></div>
		<div class="fielddiv">
			<div class="fielddiv1">Gender :</div>
			<div class="fielddiv2"><?php echo $userArr['User']['gender'];?></div>
		</div>
		<div class="clear"></div>
		<div class="fielddiv">
			<div class="fielddiv1">Date of Birth :</div>
			<div class="fielddiv2"><?php echo $userArr['User']['dob'];?></div>
		</div>
		<div class="clear"></div>
		<div class="fielddiv">
			<div class="fielddiv1">Device Id :</div>
			<div class="fielddiv2"><?php if(empty($userArr['User']['device_id'])) echo 'N/A';else echo $userArr['User']['device_id'];?></div>
		</div>
		<div class="clear"></div>
		<div class="fielddiv">
			<div class="fielddiv1">Platform :</div>
			<div class="fielddiv2"><?php if(empty($userArr['User']['platform'])) echo 'N/A';else echo $userArr['User']['platform'];?></div>
		</div>
		<div class="clear"></div>
		<div class="fielddiv">
			<div class="fielddiv1">Status:</div>
			<div class="fielddiv2"><?php 
				if($userArr['User']['status'] == '1')
					echo '<label style="color:green;">Active</label>';
				else if($userArr['User']['status'] == '2')
					echo '<label style="color:#FF0000;">Deactivated by Administrator</label>';
				else
					echo '<label style="color:#FF0000;">Inactive';
			?></div>
		</div>
		<div class="clear"></div>
		<div class="fielddiv">
			<div class="fielddiv1">Registered On:</div>
			<div class="fielddiv2"><?php echo date('d M, Y', strtotime($userArr['User']['created']));?></div>
		</div>
		<div class="clear"></div>
		<div class="fielddiv">
			<div class="fielddiv1">Modified :</div>
			<div class="fielddiv2"><?php echo date('d M, Y', strtotime($userArr['User']['modified']));?></div>
		</div>
	</fieldset>
	<?php }else{ echo "No user detail found."; }?>
</div>