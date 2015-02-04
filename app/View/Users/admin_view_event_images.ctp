<div id="main" style=" width:700px;">
	<h3>Event Pic Gallery</h3>
	<?php if(!empty($userArr)) {?>
	<fieldset>
		<!---<div style="position: absolute;border: 1px solid;width: 20%;margin-left: 72%;min-height: 20%;">
		</div>-->
		<?php foreach($userArr as $userArr){ ?>
		<div class="fielddiv">
			<div class="fielddiv1" style="width:132px;">
			<?php	if(!empty($userArr['EventImage']['event_pic'])){
				$filename = realpath('../../app/webroot/img/event_pictures/');
				$filename = $filename .'/'. basename($userArr['EventImage']['event_pic']); 
				
				if (file_exists($filename)) {
						echo $this->Html->image($userArr['EventImage']['event_pic_path'],array('title' => 'Event Pic','style' =>array('width:100%;height:185px'))); ?>
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
	<?php }else{ echo "No Event pic found."; }?>
		
</div>