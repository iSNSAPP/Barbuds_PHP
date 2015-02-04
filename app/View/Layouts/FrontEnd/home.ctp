<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Joule Infrastructure Pvt. Ltd.</title>
<?php 
		echo $this->Html->css('FrontEnd/bootstrap.css');
		echo $this->Html->css('FrontEnd/style.css');
                echo $this->Html->css('FrontEnd/owl.carousel.css');	
                echo $this->Html->script('FrontEnd/jquery.min.js');
                echo $this->Html->script('FrontEnd/owl.carousel.js');
                echo $this->Html->script('FrontEnd/SpryAccordion.js');
                echo $this->Html->script('FrontEnd/jquery.bpopup.min.js');
                echo $this->Html->script('FrontEnd/bootstrap.js');
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

<div id="sign_up" class="popup"> <span class="button b-close"><span>X</span></span>
  <div class="popup-content">
    <div class="a-center">
      <h2>Join Jobzmart</h2>
      <p>Use one of your social networks or start fresh with an email address</p>
    </div>
    <a href="" class="facebook-login">Login With Facebook</a> <a href="" class="linkedin-login">Login With Facebook</a>
    <div class="or"><?php echo $this->Html->image('FrontEnd/or.png',array('alt'=>'or','div'=>false,'label'=>false)) ?></div>
    <div class="clear"></div>
    <div class="row centered-form">
      <div class=" col-md-12">
	<?php echo $this->Form->create('User',array('url'=>array('controller'=>'users','action'=>'register'),'role'=>'form')); ?>        
          <div class="row">
            <div class="col-xs-6 col-sm-6 col-md-6">
              <div class="form-group">
                <?php echo $this->Form->input('User.first_name',array('class'=>'form-control','placeholder'=>'First Name','div'=>false,'label'=>false)); ?>
              </div>
            </div>
            <div class="col-xs-6 col-sm-6 col-md-6">
              <div class="form-group">
                <?php echo $this->Form->input('User.last_name',array('class'=>'form-control','placeholder'=>'Last Name','div'=>false,'label'=>false)); ?>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-xs-6 col-sm-6 col-md-6">
              <div class="form-group">
               <?php echo $this->Form->input('User.city',array('class'=>'form-control','placeholder'=>'Location(City)','div'=>false,'label'=>false)); ?>
              </div>
            </div>
            <div class="col-xs-6 col-sm-6 col-md-6">
              <div class="form-group">
                	<?php echo $this->Form->input('User.zip_code',array('class'=>'form-control','placeholder'=>'Zip Code','div'=>false,'label'=>false)); ?>
              </div>
            </div>
          </div>
          <div class="form-group">
           	<?php echo $this->Form->input('User.email',array('class'=>'form-control','placeholder'=>'Email Address','div'=>false,'label'=>false)); ?>
          </div>
          <div class="row">
            <div class="col-xs-6 col-sm-6 col-md-6">
              <div class="form-group">
                	<?php echo $this->Form->input('User.password',array('class'=>'form-control','placeholder'=>'Password','div'=>false,'label'=>false)); ?>
              </div>
            </div>
            <div class="col-xs-6 col-sm-6 col-md-6">
              <div class="form-group">
	<?php echo $this->Form->input('User.password_confirmation',array('class'=>'form-control','placeholder'=>'Confirm Password','div'=>false,'label'=>false)); ?>
              </div>
            </div>
          </div>
          <div class="form-group">
              <div class="what-are-looking">What are you looking for?</div>
              <div class="row">
	<div class="col-md-4">
                  <div class="radio">
                    <label>
                      <input type="radio" class='radio_sel' name="optionsRadios" id="optionsRadios1" value="1" checked>
                      Buyer </label>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="radio">
                    <label>
                      <input type="radio" class='radio_sel' name="optionsRadios" id="optionsRadios1" value="2" checked>
                      Seller</label>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="radio">
                    <label>
                      <input type="radio" class='radio_sel' name="optionsRadios" id="optionsRadios1" value="3" checked>
                      Both </label>
                  </div>
                </div>
                </div>
<?php echo $this->Form->input('User.user_type', array('type' => 'hidden','label'=>false,'div'=>false,'class'=>'user_type')); ?>  
              <div class="row">
            <div class="col-md-12">
              <div class="checkbox">
                <label>
<?php echo $this->Form->checkbox('User.terms', array('hiddenField' => false)); ?>                  
                  By creating an account, I accept <a href="">Terms of Service</a> and <a href="">Privacy Policy.</a> </label>
              </div>
            </div>
          </div>
          </div>
          
          <input type="submit" value="Sign up" class="btn btn-lg btn-default btn-block sign-up">
        <?php echo $this->Form->end(); ?>
      </div>
    </div>
  </div>
  <div class="signup app-box"> Already have an Account? <a href="">Sign in</a></div>
</div>
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
		$('#signup-button').bind('click', function(e) {
		e.preventDefault();
                $('#sign_up').bPopup({
 				 follow: [true, 50]
				,positionStyle: 'absolute' //'fixed' or ''
                , zIndex: 2
                , modalClose: true
				,speed: 250
            	,transition: 'slideDown'
                });
            });

$('.radio_sel').bind('click',function(e){

var val_nw =$(this).val();
				$('#UserUserType').val(val_nw);
				});
    });
    </script>
</body>
</html>