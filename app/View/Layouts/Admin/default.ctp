<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
	<title>Web Services Admin Panel.</title>
	<?php
		echo $this->Html->css('admin/stylesheet');
		echo $this->Html->css('admin/custom');
		echo $this->Html->css('admin/jquery.dataTables');
		echo $this->Html->script('admin/jquery');
		echo $this->Html->script('admin/function');
		echo $this->Html->script('admin/simpla');
		

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
<body class="inerbackground">
	<!-- MAIN CONTAINER START -->
	<div class="mainCon">
		<!-- LEFT NAVIGATION START -->
		<?php echo $this->Element('admin/left_navigation');?>
		<!-- LEFT NAVIGATION END -->

		<!-- MIDDLE CONTAINER START -->

		<div class="midRight">
			<div class="topPart">Hello  <strong><?php echo ucwords($this->Session->read('Auth.Admin.Admin.username'));?></strong></div>

			<!-- MAIN CONTENT START -->
			<?php echo $content_for_layout;?>
			<!-- MAIN CONTENT END -->

			<div class="footer">&copy; <?php echo date('Y');?> <a href="http://simplyideaz.com">simplyideaz.com</a> All Rights are Reserved.
				<?php // $this->element('sql_dump'); ?>
			</div>
			<!-- FOOTER SECTION END -->

		</div>
		<!-- MIDDLE CONTAINER END -->
	</div>
	<!-- MAIN CONTAINER END -->
</body>
</html>