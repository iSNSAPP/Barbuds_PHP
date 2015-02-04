<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Joule Infrastructure Pvt. Ltd.</title>
<?php 
		echo $this->Html->css('FrontEnd/bootstrap.CSS');
		echo $this->Html->css('FrontEnd/style.css');	
		?>
<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>
<div class="wrpper">
	<!--Start mainCon-->
	<div class="mainCon">
		<!--Start headerCon-->
		<?php 
		$logedin =$this->Session->read('Auth.User.id');
		if($logedin!=''){
		echo $this->element('FrontEnd/header_after_login');
		}else{
		echo $this->element('FrontEnd/header_without_login');
		}
		?>
		 <?php echo $content_for_layout;?>
		<!--Start foonetrCon-->
		<div class="footerCon">
			<?php echo $this->element('FrontEnd/footer'); ?>
		</div>
		<!--End foonetrCon -->
		 <div>
  </div>
</div>
<!-- jQuery (necessary for JavaScript plugins) --> 
<script src="js/jquery.min.js"></script> 
<!-- Include all compiled plugins (below), or include individual files as needed --> 
<script src="js/bootstrap.js"></script>
<script src="js/owl.carousel.js"></script>
<script type="text/javascript">


    $(document).ready(function() {
     
    $("#owl-demo").owlCarousel({
    autoPlay : true,
    stopOnHover : true,
    navigation:true,
    paginationSpeed : 1000,
    goToFirstSpeed : 2000,
    singleItem : true,
    autoHeight : false,
	pagination: false,
    });
     
    });



    </script>
</body>
</html>
