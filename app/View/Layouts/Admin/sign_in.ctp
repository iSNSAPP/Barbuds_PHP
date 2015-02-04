<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
	<title>Web Services Admin Panel.</title>
	<?php
		echo $this->Html->css('admin/stylesheet');
		echo $this->Html->css('admin/custom');
		echo $this->Html->script('admin/function');

		/*----- Code for Validation Engine Start -----*/
		echo $this->Html->css('validation/validationEngine.jquery');
		echo $this->Html->css('validation/template');
		echo $this->Html->css('validation/customMessages.css');
		echo $this->Html->script('validation/jquery-1.7.2.min');
		echo $this->Html->script('validation/languages/jquery.validationEngine-en');
		echo $this->Html->script('validation/jquery.validationEngine');
		/*----- Code for Validation Engine End ------*/
	?>
</head>
<body>
	<div class="homeLogo"><?php echo $this->Html->image('admin/logo.png', array('width'=>'179px', 'height'=>'68px;' ,'alt'=>'', 'border'=>0));?></div>
	<!-- MAIN CONTAINER START -->
	<div class="loginCon">
		<!-- LOGIN BOX CONTAINER START -->
		<?php echo $content_for_layout;?>
		<!-- LOGIN BOX CONTAINER END -->
	</div>
	<!-- MAIN CONTAINER END -->
</body>
</html>
