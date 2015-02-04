<?php //pr($userArr);die;?>
<div id="main" style=" width:700px;">
	<h3>Sub Admin Details</h3>
	<fieldset>
		<div class="fielddiv">
			<div class="fielddiv1">Username:</div>
			<div class="fielddiv2"><?php echo $userArr['Admin']['username']; ?></div>
		</div>
		<div class="clear"></div>
		<div class="fielddiv">
			<div class="fielddiv1">Email:</div>
			<div class="fielddiv2"><?php echo $userArr['Admin']['email'];?></div>
		</div>
		<div class="clear"></div>

		<div class="fielddiv">
			<div class="fielddiv1">Status:</div>
			<div class="fielddiv2"><?php 
				if($userArr['Admin']['status'] == '1')
					echo '<label style="color:green;">Active</label>';
				else
					echo '<label style="color:#FF0000;">Inactive';
			?></div>
		</div>
		<div class="clear"></div>

		<div class="fielddiv">
			<div class="fielddiv1">Created On:</div>
			<div class="fielddiv2"><?php echo date('d M, Y', strtotime($userArr['Admin']['created']));?></div>
		</div>
		<div class="clear"></div>
	</fieldset>
</div>