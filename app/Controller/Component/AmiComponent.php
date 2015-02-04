<?php
App::uses('Component', 'Controller');
class AmiComponent extends Component{
	public $components = array('Session', 'Cookie', 'Auth');

	//FUNCTION FOR ENCRYPTION START
	public function encrypt($data){
		return base64_encode($data);
	}
	//FUNCTION FOR ENCRYPTION END

	//FUNCTION FOR DECRYPTION START
	public function decrypt($data){
		return base64_decode($data);
	}
	//FUNCTION FOR DECRYPTION END
   
   //FUNCTION TO GENERATE PASSWORD START
   public function createTempPassword($len){
		$pass = '';
		$lchar = 0;
		$char = 0;
		for($i = 0; $i < $len; $i++){
			while($char == $lchar){
				$char = rand(48, 109);
				if($char > 57) $char += 7;
				if($char > 90) $char += 6;
			}
			$pass .= chr($char);
			$lchar = $char;
		}
		return $pass;
	}
   //FUNCTION TO GENERATE PASSWORD END

     //FUNCTION FOR VALIDATING ADMIN LOGIN START
   public function validateAdmin(){
	   $ret = '';
	   if($this->Session->check('Auth.Admin')){
		  $ret = '/admin/admins/dashboard/';
	   }
	   return $ret;
   }
   //FUNCTION FOR VALIDATING ADMIN LOGIN END

   //FUNCTION FOR VALIDATING ADMIN LOGIN START
   public function validateUser(){
	   $ret = '';
	   if($this->Session->check('Auth.User')){
		  $ret = '/users/wall/';
	   }
	   return $ret;
   }
   //FUNCTION FOR VALIDATING ADMIN LOGIN END	

	//FUNCTION FOR FETCHING THE SCROLL PAGINATION START
	public function set_scroll_pagination_data($model, $lastViewedPage, $offset, $conditions, $order){
	   Controller::loadModel($model);

	   $limitArr = ($lastViewedPage * $offset).','.$offset;

	   $faqArr = $this->$model->find('all', array('conditions'=>$conditions, 'order'=>$order, 'limit'=>$limitArr));
	   return $faqArr;
   }
	//FUNCTION FOR FETCHING THE SCROLL PAGINATION END

	//FUNCTION FOR CREATING A COOKIE START
	public function createCookie($name, $arr, $time){
		$this->Cookie->write($name, $arr, false, $time);
	}
	//FUNCTION FOR CREATING A COOKIE END

	//FUNCTION FOR VALIDATING THE COOKIE START
	public function validateCookie($model, $name){
		Controller::loadModel($model);

		$cookieArr = '';
		$cookieArr = $this->Cookie->read($name);
		if(!empty($cookieArr)){ //pr($cookieArr);die;
			$conditions = '';
			foreach($cookieArr as $key => $val){ //echo $key.' => '.$val;die;
				$conditions[$model.'.'.$key] = $val;
			}
			$conditions[$model.'.status'] = '1';

			$modelArr = $this->$model->find('first', array('conditions'=>$conditions));
			if(!empty($modelArr)){
				if($modelArr[$model]['status'] == '1'){
					if($this->Auth->login($modelArr))
						return true;
					else
						$this->Cookie->delete($name);
				}else
					$this->Cookie->delete($name);
			}else
				$this->Cookie->delete($name);
		}
	}
	//FUNCTION FOR VALIDATING THE COOKIE END

	//FUNCTION TO UPLOAD THE FILE START
	function uploadFiles($path, $ext, $formData){
		$filename = $this->createTempPassword(15).'.'.$ext;
		$url = $path.$filename;
		
		if(move_uploaded_file($formData['tmp_name'], $url))
			return $filename;
		else
			return '';
	}
	//FUNCTION TO UPLOAD THE FILE END

	//FUNCTION TO UPLOAD THE FILE START
	function uploadFile($path, $fileData){ 
		//find file extention
		$extArr = explode('.',  $fileData['name']);
		$ext = end($extArr);

		$filename = $this->createTempPassword(15).'.'.$ext;
		$url = $path.$filename;
		
		if(move_uploaded_file($fileData['tmp_name'], $url))
			return $filename;
		else
			return '';
	}
	//FUNCTION TO UPLOAD THE FILE END

	
	



	//FUNCTION FOR CONVERTING A VIDEO FILE TO FLV END
	public function convert_to_flv($input, $output){
		$shellCommand = "ffmpeg -i ".$input."-ar 22050 -ab 32 -f flv -s 320x240 ".$output;
		$convert_video = exec($shellCommand, $ret);

		//check for the presence of flv file whether created or not
		$return = 'false';
		if(is_file($output))
			$return = 'true';
		return $return;
	}
	//FUNCTION FOR CONVERTING A VIDEO FILE TO FLV END

	//FUNCTION FOR MAKING AN IMAGE OF A VIDEO FILE START
	public function snap_from_video($input, $output){
		$shellCommand = "ffmpeg -i ".$input." -an -ss 00:00:05 -r 1 -vframes 1 -f mjpeg -y ".$output;
		$convert_image = exec($shellCommand, $ret);

		//check for the presence of flv file whether created or not
		$return = 'false';
		if(is_file($output))
			$return = 'true';
		return $return;
	}
	//FUNCTION FOR MAKING AN IMAGE OF A VIDEO FILE END

		
	
	function generateRandomString($length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, strlen($characters) - 1)];
    }
    return $randomString;
}
	function getFriend($user_id){
		App::import('Model','UserFriend');
		$this->UserFriend = new UserFriend();
		$user_fri='';
		$user_friend = $this->UserFriend->find('all',array('conditions'=>array('or'=>array('UserFriend.user_id'=>$user_id,'UserFriend.friend_user_id'=>$user_id))));
		if(!empty($user_friend)){
			foreach($user_friend as $user_data){
				if($user_data['UserFriend']['user_id']==$user_id){
					$user_fri[] =  $user_data['UserFriend']['friend_user_id'];
				}else{
					$user_fri[] =  $user_data['UserFriend']['user_id'];
				}
			}
			
		}
		return $user_fri;
	
	}
	
	

}
?>