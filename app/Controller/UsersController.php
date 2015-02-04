<?php App::uses('AppController', 'Controller');
/**
 * Users Controller
 *
 * @property User $User
 */
class UsersController extends AppController {
	public $name = 'Users';	
	public $helpers = array('Html', 'Form', 'Session', 'Text');
	public $components = array('Session', 'Cookie', 'Email', 'Auth', 'Ami','General');
	public $uses = array('User','Image','Event','EventImage');
	public $layout = 'Admin/default';
	public $wallUrl = '/users/dashboard/';

	//BEFORE FILTER STARTS
	function beforeFilter(){
		parent::beforeFilter();
	}
	//BEFORE FILTER ENDS
	/*---------------------------- ADMIN SECTION START ----------------------------------------*/
	//FUNCTION FOR MANAGING THE USERS START
	public function admin_manage() {
			$this->paginate = array('limit'=>PAGING_SIZE,'order'=>array('User.id'=>'DESC'));
			$this->set('viewListing', $this->paginate('User'));
	}
	
	public function admin_events($id=NULL) {
			$this->paginate = array('limit'=>PAGING_SIZE,'order'=>array('Event.id'=>'DESC'),'conditions' => array('Event.user_id' => $id));
			$this->set('viewListing', $this->paginate('Event'));
	}

	//FUNCTION FOR USER ADD START
	public function admin_add() { 
			if(!empty($this->request->data)){ 
				$this->User->set($this->request->data);
				if($this->User->validates($this->request->data))
				{
					
					$this->request->data['User']['name'] = ucwords(trim($this->request->data['User']['name']));
					$this->request->data['User']['password'] = $this->Auth->password($this->request->data['User']['password']);
					$newPassword = $this->request->data['User']['password'];
					$this->request->data['User']['status'] = 1;
					$this->request->data['User']['dob'] = $this->request->data['User']['dob']['year'].'/'.$this->request->data['User']['dob']['month'].'/'.$this->request->data['User']['dob']['day'];
					
					
				/**** Code for image upload  ***** START */
					
					if(!empty($this->request->data['User']['file']['name']))
					{ 
						$file=$this->request->data['User']['file'];
						$file_name = time().''.$this->request->data['User']['file']['name'];
						$path =$file['name'];
						$ext = pathinfo($path, PATHINFO_EXTENSION);
						
						if ($file['name']!=''){ 
							if($ext == 'jpeg'|| $ext == 'jpg' || $ext == 'png'){
								$target_path = realpath('../../app/webroot/img/Profile_pic/');
								$target_path = $target_path .'/'. basename($file_name); 
								if(move_uploaded_file($this->request->data['User']['file']['tmp_name'], $target_path)) {
									$this->request->data['User']['profile_pic'] = $file_name;
								} 
							}
						}
					}
				/**** Code for image upload  ***** End */
					
					
				if($this->User->save($this->request->data,true)){
					
					$this->set('userArr',$this->request->data);
					$this->set('newPassword',$newPassword);
					
					$this->Email->to	   = $this->request->data['User']['email'];
					$this->Email->from	   = 'test@gmail.com';
					$this->Email->subject  = 'Your Account Has Been Created';
					$this->Email->template = 'admin/registration';
					$this->Email->sendAs   = 'html'; 
					$this->Email->send();
					
					$this->Session->setFlash(__('User Details Added!!', true), 'message', array('class'=>'message-green'));
					$this->redirect('/admin/users/manage/');
					}
				else{
					$this->Session->setFlash(__('Please Try Later!!', true), 'message', array('class'=>'message-red'));
					$this->redirect('/admin/users/manage/');
					}
					}else{
					$this->Session->setFlash(__('Please Try Later!!', true), 'message', array('class'=>'message-red'));
					}
				
			}
	}
	//FUNCTION FOR USER EDIT START
	public function admin_edit($id) {
		if($id != ''){
			if(!empty($this->request->data)){ 
			
				$this->request->data['User']['dob'] = $this->request->data['User']['dob']['year'].'/'.$this->request->data['User']['dob']['month'].'/'.$this->request->data['User']['dob']['day'];
				/**** Code for image upload  ***** START */					
				
					if(!empty($this->request->data['User']['file']['name']))
					{ 
						$profile_info = $this->User->find('first',array('conditions' =>array('User.id'=>trim($this->request->data['User']['id'])),'fields' => array('id','profile_pic')));				
						if(!empty($profile_info['User']['profile_pic'])){
							
							$old_path = SITEPATH .'/'. basename($profile_info['User']['profile_pic']); 
							$abc_link = $old_path;
							if (file_exists($old_path)) {
								unlink($old_path);
							}
						}
						$file= $this->request->data['User']['file'];
						$file_name = time().''. $this->request->data['User']['file']['name'];
						$path =$file['name'];
						$ext = pathinfo($path, PATHINFO_EXTENSION);
						
						if ($file['name']!=''){ 
							if($ext == 'jpeg'|| $ext == 'jpg' || $ext == 'png'){
								$target_path = realpath('../../app/webroot/img/Profile_pic/');
								$target_path = $target_path .'/'. basename($file_name); 
								if(move_uploaded_file( $this->request->data['User']['file']['tmp_name'], $target_path)) {
									$this->request->data['User']['profile_pic'] = $file_name;
								} 
							}
						}
					}					
					/**** Code for image upload  ***** End */
				
				if($this->User->save($this->request->data,false))
				{
					$this->Session->setFlash(__('User Details Updated Successfully!!', true), 'message', array('class'=>'message-green'));
					$this->redirect('/admin/users/manage/');
				}
				else
					$this->Session->setFlash(__('Please Try Later!!', true), 'message', array('class'=>'message-red'));
				$this->redirect('/admin/users/manage/');
			}
			
			$userArr = $this->User->find('first',array('conditions' => array('User.id' =>$id)));
			$this->set('userArr',$userArr);
			if(!empty($userArr)){ 
				$this->request->data = $userArr;
			}else{
				$this->Session->setFlash(__('No Associated User Found!!', true), 'message', array('class'=>'message-red'));
				$this->redirect('/admin/users/manage/');
			}
		}else
			$this->redirect('/admin/users/manage/');
	}
	//FUNCTION FOR USER EDIT END
	
	//FUNCTION FOR USER ADD END
	//FUNCTION FOR ACTIVATING/DEACTIVATING THE USER START
	public function admin_status_update($id, $newStatus,$model,$controller) {
		$message = $this->General->updateStateForAllFunction($id,$newStatus,$model,$controller);
		if($message)
			$this->Session->setFlash(__('Status '.$message.' Successfully!!', true), 'message', array('class'=>'message-green'));
		else
			$this->Session->setFlash(__('No Associated User Found!!', true), 'message', array('class'=>'message-red'));			
		$this->redirect('/admin/users/manage/');
	}
	
	//FUNCTION FOR ACTIVATING/DEACTIVATING THE USER END

	//FUNCTION TO VIEW THE USER DETAILS START
	public function admin_view($id){
		$this->layout = 'FancyBox/fancy_box_popup';
	}
	
	public function admin_view_images($id){
		$this->layout = 'FancyBox/fancy_box_popup';
		$this->set('userArr', $this->Image->find('all',array('conditions' => array('Image.user_id' => $id))));
	}
	public function admin_view_event_images($id){
		$this->layout = 'FancyBox/fancy_box_popup';
		$this->set('userArr', $this->EventImage->find('all',array('conditions' => array('EventImage.user_id' => $id))));
	}
	public function admin_view_event($id){
		$this->layout = 'FancyBox/fancy_box_popup';
		$this->set('userArr', $this->Event->findById($id));
	}
	//FUNCTION TO VIEW THE USER DETAILS END

	//FUNCTION FOR DELETING THE USER START
	/*public function admin_delete($id,$model,$controller) {
		if($id != ''){
			if($model =='User'){
				$this->User->id = $id;
				if($this->User->saveField('is_deleted','2')){
					$this->Session->setFlash(__('User Deleted Successfully!!', true), 'message', array('class'=>'message-green'));
				}else{
					$this->Session->setFlash(__('Please Try Later!!', true), 'message', array('class'=>'message-red'));
				}
			}
			if($model =='Event'){
				$this->Event->id = $id;
				if($this->Event->saveField('is_deleted','2')){
					$this->Session->setFlash(__('Event Deleted Successfully!!', true), 'message', array('class'=>'message-green'));
				}else{
					$this->Session->setFlash(__('Please Try Later!!', true), 'message', array('class'=>'message-red'));
				}
			}
			$this->redirect('/admin/users/manage/');
			exit;
		}
	}*/
	public function admin_delete($id) {
		if($id != ''){
			$this->User->recursive = -1;
			$usrArr = $this->User->findById($id);
			if(!empty($usrArr)){
				if($this->User->delete($id))
					$this->Session->setFlash(__('User Deleted Successfully!!', true), 'message', array('class'=>'message-green'));
				else
					$this->Session->setFlash(__('Please Try Later!!', true), 'message', array('class'=>'message-red'));
				$this->redirect('/admin/users/manage/');
			}else{
				$this->Session->setFlash(__('No Associated User Found!!', true), 'message', array('class'=>'message-red'));
				$this->redirect('/admin/users/manage/');
			}
		}else
			$this->redirect('/admin/users/manage/');
		exit;
	}
}?>