<!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta name="viewport" content="width=device-width; initial-scale=1.0">
<title>GSD Synchronicity</title>
<!--[if IE]>
<script src="include/html5.js"></script>
<![endif]-->
<?php   echo $this->Html->css('FrontEnd/style');
echo $this->Html->script('FrontEnd/jquery');
	echo $this->Html->script('FrontEnd/function');
		echo $this->Html->script('FrontEnd/ddaccordion');
		echo $this->Html->script('FrontEnd/html5');
		echo $this->Html->script('FrontEnd/menu');
 ?> 
<link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
<script>
$(function(){
var characters= 200;
$("#counter").append("<strong>"+ characters+"</strong> characters remaining");
$('#UserAboutMe').bind('keyup', function(e){
	 if($(this).val().length > characters){
        $(this).val($(this).val().substr(0, characters));
		}
		var  remaining = characters - $(this).val().length;
$("#counter").html("<strong>"+ remaining+"</strong> characters remaining");
});
});
</script>
</head>
<body style="background:none;">
<div class="regCon">
<?php echo $this->Form->create('User'); ?>
	<div class="registerHd">Registration<span>Please fill following field to complete the process for registration.</span></div>
    <div class="regField">First Name:</div>
    <div class="regLabal"><?php echo $this->Form->input('User.first_name',array('div'=>false,'label'=>false,'class'=>'regInput')); ?></div>
    <div class="clr"></div>
    <div class="regField">Last Name:</div>
    <div class="regLabal"><?php echo $this->Form->input('User.last_name',array('div'=>false,'label'=>false,'class'=>'regInput')); ?></div>
    <div class="clr"></div>
    <div class="regField">Country:</div>
    <div class="regLabal">
    <?php echo $this->Form->input('User.country_id',array('div'=>false,'label'=>false,'class'=>'regSel','options'=>$countryArr)); ?>
    </div>
    <div class="clr"></div>
    <div class="regField">State:</div>
    <div class="regLabal"><?php echo $this->Form->input('User.state',array('div'=>false,'label'=>false,'class'=>'regInput')); ?></div>
    <div class="clr"></div>
    <div class="regField">Postcode:</div>
    <div class="regLabal"><?php echo $this->Form->input('User.postcode',array('div'=>false,'label'=>false,'class'=>'regInput')); ?></div>
    <div class="clr"></div>
    <div class="regField">Phone:</div>
    <div class="regLabal"><?php echo $this->Form->input('User.phone',array('div'=>false,'label'=>false,'class'=>'regInput','maxlength'=>13)); ?></div>
    <div class="clr"></div>
	<div class="regField">About Your Self:</div>
    <div class="regLabal"><?php echo $this->Form->input('User.about_me',array('div'=>false,'label'=>false,'class'=>'regInput ','cols'=>'15','rows'=>'20')); ?></div>
	<div id='counter' style='float:right'></div>
    <div class="clr"></div>
    <div class="regField"></div>
    <div class="regLabal"><?php echo $this->Form->input('Submit',array('div'=>false,'label'=>false,'class'=>'loginBtn','type'=>'Submit','value'=>'SUBMIT')); ?></div>
    <div class="clr"></div>
	<?php echo $this->Form->end(); ?>
</div>
</body>
</html>