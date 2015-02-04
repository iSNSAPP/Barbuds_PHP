<div class="shadeBox">
            <div class="topSpace">
                <div class="skillHd">Change Your Password</div>
                <div class="uploadForm">
				<?php 	echo $this->Form->create('User');	
							echo $this->Form->input('User.id',array('type'=>'hidden'));	
					?>
                    <div>
					<?php echo $this->Form->input('User.old_password',array('class'=>'uploadInput','placeholder'=>'Old Password *','div'=>false,'label'=>false,'type'=>'password')); ?>
					</div>
                    <div><?php echo $this->Form->input('User.new_password',array('class'=>'uploadInput','placeholder'=>'New Password *','div'=>false,'label'=>false,'type'=>'password')); ?></div>
                    <div><?php echo $this->Form->input('User.confirm_new_password',array('class'=>'uploadInput','placeholder'=>'Confirm New Password *','div'=>false,'label'=>false,'type'=>'password')); ?></div>
                    <div>
					<?php echo $this->Form->submit('change password',array('class'=>'cpBtn','div'=>false,'label'=>false,'value'=>'change password')); ?>
					</div>
					<?php echo $this->Form->end(); ?>
                </div><br>
            </div>                
</div>