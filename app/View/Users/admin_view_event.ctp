<?php $userArr = $this->App->viewAll($this->params['pass']['0'],'Event'); ?>
<div id="main" style=" width:700px;">
	<h3>Event Details</h3>
	<?php if(!empty($userArr)) {?>
	<fieldset>
		<div style="position: absolute;border: 1px solid;width: 20%;margin-left: 72%;min-height: 20%;">
		
		<?php	if(!empty($userArr['Event']['picture'])){
				$filename = realpath('../../app/webroot/img/event_pictures/');
				$filename = $filename .'/'. basename($userArr['Event']['picture']); 
				
				if (file_exists($filename)) {
						echo $this->Html->image('event_pictures/'.$userArr['Event']['picture'],array('title' => 'Event Pic','style' =>array('width:100%'))); ?>
					<?php }else {
						echo $this->Html->image('user_pic.jpg',array('title' => 'Event Pic','style' =>array('width:100%'))); 
					}
			}else{
				echo $this->Html->image('user_pic.jpg',array('title' => 'Event Pic','style' =>array('width:100%'))); 
			}
				?>
		</div>
		<div class="fielddiv">
			<div class="fielddiv1">Event Name :</div>
			<div class="fielddiv2"><?php echo $userArr['Event']['name'];?></div>
		</div>
		<div class="clear"></div>	
		<div class="fielddiv">
			<div class="fielddiv1">Event Date :</div>
			<div class="fielddiv2"><?php echo $userArr['Event']['date'];?></div>
		</div>
		<div class="clear"></div>	
		<div class="fielddiv">
			<div class="fielddiv1">Event Time :</div>
			<div class="fielddiv2"><?php echo $userArr['Event']['time'];?></div>
		</div>
		<div class="clear"></div>	
		<div class="fielddiv">
			<div class="fielddiv1">Event Location :</div>
			<div class="fielddiv2"><?php echo $userArr['Event']['location'];?></div>
		</div>
		<div class="clear"></div>	
		<div class="fielddiv">
			<div class="fielddiv1">Event Address :</div>
			<div class="fielddiv2"><?php echo $userArr['Event']['address'];?></div>
		</div>
		<div class="clear"></div>	
		<div class="fielddiv">
			<div class="fielddiv1">Event Details :</div>
			<div class="fielddiv2"><?php echo $userArr['Event']['event_details'];?></div>
		</div>
		<div class="clear"></div>	
		<div class="fielddiv">
			<div class="fielddiv1">Status:</div>
			<div class="fielddiv2"><?php 
				if($userArr['Event']['status'] == '1')
					echo '<label style="color:green;">Active</label>';
				else if($userArr['Event']['status'] == '2')
					echo '<label style="color:#FF0000;">Deactivated by Administrator</label>';
				else
					echo '<label style="color:#FF0000;">Inactive';
			?></div>
		</div>
		<div class="clear"></div>
		<div class="fielddiv">
			<div class="fielddiv1">Registered On:</div>
			<div class="fielddiv2"><?php echo date('d M, Y', strtotime($userArr['Event']['created']));?></div>
		</div>
		<div class="clear"></div>
		<div class="fielddiv">
			<div class="fielddiv1">Modified :</div>
			<div class="fielddiv2"><?php echo date('d M, Y', strtotime($userArr['Event']['modified']));?></div>
		</div>
	</fieldset>
	<?php } ?>
</div>