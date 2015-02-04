<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link type="text/css" href="/amigalatina/app/webroot/cometchat/cometchatcss.php" rel="stylesheet" charset="utf-8">
<script type="text/javascript" src="/amigalatina/app/webroot/cometchat/cometchatjs.php" charset="utf-8"></script>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Amigalatina</title>
<?php 
		echo $this->Html->css('FrontEnd/style');
		echo $this->Html->css('FrontEnd/dropkick.css');
		echo $this->Html->script('FrontEnd/jquery');		
		echo $this->Html->script('FrontEnd/jquery.dropkick-1.0.0');
		echo $this->Html->script('FrontEnd/scripts');		
		echo $this->Html->script('FrontEnd/function');
		echo $this->Html->script('validation/languages/jquery.validationEngine-en');
		echo $this->Html->script('validation/jquery.validationEngine');
		echo $this->Html->css('validation/validationEngine.jquery');
		echo $this->Html->script('FrontEnd/jquery.colorbox');
		echo $this->Html->css('FrontEnd/colorbox');	
		//echo 'asdasas';die;
		?>
<script type="text/javascript" charset="utf-8">
    $(function () {      
      $('.custom_theme').dropkick({
        theme: 'black',
        change: function (value, label) {
          $(this).dropkick('theme', value);
        }
      });
    });
</script>

</head>

<body>
<!--Start wrapCon -->
<div class="wrapCon">
	<!--Start mainCon-->
	<div class="mainCon">
		<!--Start headerCon-->
		<div class="headbox">
			<?php echo $this->element('FrontEnd/header_after_login'); ?>
		</div>
		<!--End headerCon -->
		<!--Start menuCon-->
		<div class="menuCon">
			<?php echo $this->element('FrontEnd/tab_bar'); ?>
	   </div>
	   <!--End menuCon-->
		
		<!--Start midCon-->
		<div class="midCon">
			<?php echo $content_for_layout; ?>
		</div>
		<!--End midCon -->
		<!--Start foonetrCon-->
		<div class="footerCon">
			<?php echo $this->element('FrontEnd/footer'); ?>
		</div>
		<!--End foonetrCon -->
		
	</div>
	<!--End mainCon -->
</div>
<!--End wrapCon -->
</body>
</html>
