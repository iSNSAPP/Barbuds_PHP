<?php /**
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */
App::uses('Controller', 'Controller');

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package		app.Controller
 * @link		http://book.cakephp.org/2.0/en/controllers.html#the-app-controller
 */
App::import('Vendor','constants');
class AppController extends Controller {
	public $helpers = array('Html', 'Form', 'Session', 'Text');
	public $components = array('Session', 'Cookie', 'Email',
		'Auth'=>array(
			'authenticate'=>array(
				'User'=>array('userModel'=>'User'),
				'Admin'=>array('userModel'=>'Admin')
			)
		), 'Ami','General');
	//BEFORE FILTER STARTS
	function beforeFilter(){

		if(isset($this->params['prefix']) && $this->params['prefix'] == 'admin'){
			$this->Auth->loginAction = array('controller'=>'admins', 'action'=>'admin_sign_in');
			AuthComponent::$sessionKey = 'Auth.Admin';
			$this->layout = 'Admin/default';
		}

		if(!empty($this->Auth)){
			$this->Auth->allowedActions = array('admin_sign_out','registration','user_login', 'admin_add','admin_sign_in', 'forgot_password','admin_forgot_password', 'admin_change_password', 'admin_change_email');
		}
	}
	//BEFORE FILTER ENDS

	//FUNCTION FOR VALIDATING THE PAGES FOR USER START
	public function validateUser($authType, $redirectUrl){
		if($this->Session->check('Auth.User.User.id'))
			$this->redirect($redirectUrl);
	}
	//FUNCTION FOR VALIDATING THE PAGES FOR USER END
	
	
	 //FUNCTION FOR SAVING THE IMAGE WITH GIVEN DIMENSIONS START
 public function saveImageWithDimensions($width, $height, $files, $path){ //pr($files);die;
  // if uploaded image was JPG/JPEG
  if($files['type'] == 'image/jpeg' || $files['type'] == 'image/pjpeg'){ 
   $image_source = imagecreatefromjpeg($files['tmp_name']);
   $imgType = 'jpg';
  }  
  // if uploaded image was GIF
  if($files['type'] == 'image/gif'){ 
   $image_source = imagecreatefromjpeg($files['tmp_name']);
   $imgType = 'gif';
  } 
  // if uploaded image was BMP
  if($files['type'] == 'image/bmp' || $files['type'] == 'image/x-windows-bmp'){ 
   $image_source = imagecreatefromwbmp($files['tmp_name']);
   $imgType = 'bmp';
  }   
  // if uploaded image was PNG
  if($files['type'] == 'image/x-png' || $files['type'] == 'image/png'){
   $image_source = imagecreatefrompng($files['tmp_name']);
   $imgType = 'png';
  }
 
 
  if($imgType != 'png'){
   $imageName = uniqid().time().'.jpg';
   $remote_file = $path.$imageName;
 
   imagejpeg($image_source,$remote_file,100);
   chmod($remote_file,0644);
 
   // get width and height of original image
   list($image_width, $image_height) = getimagesize($remote_file);
 
   $new_image = imagecreatetruecolor($width , $height);
   $image_source = imagecreatefromjpeg($remote_file);
 
   imagecopyresampled($new_image, $image_source, 0, 0, 0, 0, $width, $height, $image_width, $image_height);
   imagejpeg($new_image,$remote_file,100);
  }else{
   $imageName = uniqid().time().'.'.$imgType;
   $remote_file = $path.$imageName;
 
   $imgInfo = getimagesize($files['tmp_name']);
   switch ($imgInfo[2]){
    case 1: $image_source = imagecreatefromgif($files['tmp_name']); break;
    case 3: $image_source = imagecreatefrompng($files['tmp_name']); break;
   }
 
   $new_image = imagecreatetruecolor($width, $height);
   /* Check if this image is PNG or GIF, then set if Transparent*/  
   if(($imgInfo[2] == 1) OR ($imgInfo[2]==3)){
    imagealphablending($new_image, false);
    imagesavealpha($new_image,true);
    $transparent = imagecolorallocatealpha($new_image, 255, 255, 255, 127);
    imagefilledrectangle($new_image, 0, 0, $width, $height, $transparent);
   }
   imagecopyresampled($new_image, $image_source, 0, 0, 0, 0, $width, $height, $imgInfo[0], $imgInfo[1]);
 
   //Generate the file, and rename it to $newfilename
   switch ($imgInfo[2]){
    case 1: imagegif($new_image, $remote_file); break;
    case 3: imagepng($new_image, $remote_file); break;
   }
  }
  imagedestroy($new_image);
  imagedestroy($image_source);
  return $imageName;
 }
 //FUNCTION FOR SAVING THE IMAGE WITH GIVEN DIMENSIONS END
 

}
