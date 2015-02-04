<!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta name="viewport" content="width=device-width; initial-scale=1.0">
<title>GSD Synchronicity</title>
<!--[if IE]>
<script src="include/html5.js"></script>
<![endif]-->
<link rel="shortcut icon" href="favicon.ico" type="image/x-icon">

<?php   echo $this->Html->css('FrontEnd/style');
 echo $this->Html->css('FrontEnd/custom');
		echo $this->Html->script('FrontEnd/function');
		echo $this->Html->script('FrontEnd/ddaccordion');
		echo $this->Html->script('FrontEnd/html5');
		echo $this->Html->script('FrontEnd/menu');
 ?>
<script>
$(function(){
		$('.message-green').delay(1500).slideUp('slow');
		$('.message-red').delay(1500).slideUp('slow');
	});
</script>
</head>
<body style="background:none;">
<div class="loginCon">
<div style="width:346px; margin:0 auto 0px auto;text-align:center;">
	<?php echo $this->Session->flash();	?></div>
	<div class="loginHd">Forget Password<span>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</span></div>
	<?php echo $this->Form->create('User',array('controller'=>'users','action'=>'forget_password')); ?>
    <div class="loginField">Email:</div>
    <div class="logniLabal">
	<?php  
		echo $this->Form->input('email',array('div'=>false,'label'=>false,'class'=>'loginInput'));
	?>
	</div>
    <div class="clr"></div>
    <div class="remCon">
        <div class="loginBtnCov">
		<?php echo $this->Form->submit('Submit',array('div'=>false,'label'=>false,'class'=>'loginBtn','type'=>'submit')); ?>
		</div>
    </div>
	<?php $this->Form->end(); ?>
</div>
</body>
</html>
