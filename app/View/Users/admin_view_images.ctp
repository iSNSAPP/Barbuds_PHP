<div id="main" style=" width:700px;">
	<h3>User Current Gallery</h3>
	<?php if(!empty($userArr)) {?>
	<fieldset>
		<!---<div style="position: absolute;border: 1px solid;width: 20%;margin-left: 72%;min-height: 20%;">
		</div>-->
		<?php foreach($userArr as $userArr){ ?>
		<div class="fielddiv">
			<div class="fielddiv1" style="width:132px;">
			<?php	if(!empty($userArr['Image']['profile_pic'])){
				$filename = realpath('../../app/webroot/img/Profile_pic/');
				$filename = $filename .'/'. basename($userArr['Image']['profile_pic']); 
				
				if (file_exists($filename)) {
						echo $this->Html->image('Profile_pic/'.$userArr['Image']['profile_pic'],array('title' => 'Profile Pic','style' =>array('width:100%;height:185px'))); ?>
					<?php }else {
						echo $this->Html->image('user_pic.jpg',array('title' => 'Profile Pic','style' =>array('width:100%'))); 
					}
			}else{
				echo $this->Html->image('user_pic.jpg',array('title' => 'Profile Pic','style' =>array('width:100%'))); 
			}
				?>
			</div>
		</div>
		<?php }?>
	</fieldset>
	<?php }else { echo "No user pic found.";  }?>
</div>