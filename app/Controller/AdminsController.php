<?php
App::uses('AppController', 'Controller');
/**
 * Admins Controller
 *
 * @property Admin $Admin
 */
class AdminsController extends AppController {

	public $name = 'Admins';
	public $helpers = array('Html', 'Form', 'Session', 'Text');
	public $components = array('Session', 'Cookie', 'Email', 'Auth', 'Ami','Acl');
	public $uses = array('User','Admin');
	public $layout = 'Admin/default';

	//BEFORE FILTER STARTS
	function beforeFilter(){
		parent::beforeFilter();
	}
	//BEFORE FILTER ENDS
	

	//FUNCTION FOR ADMIN DASHBOARD START
	function admin_dashboard() { 
		
	}

	//FUNCTION FOR ADMIN LOGIN START
	public function admin_sign_in() {
		$this->layout = 'Admin/sign_in';
		$this->loadModel('User');
		$this->User->recursive = -1;
		//VALIDATE ADMIN START
		$redirectUrl = $this->Ami->validateAdmin();
		
		if($redirectUrl != '')
			$this->redirect($redirectUrl);
		//VALIDATE ADMIN END
		
		if(!empty($this->data)){ 
				$adminArr = $this->Admin->find('first',array('conditions' =>array('Admin.email'=>trim($this->request->data['Admin']['username']), 'Admin.password'=>$this->Auth->password($this->request->data['Admin']['password']))));
				
			if(!empty($adminArr)){
				if($adminArr['Admin']['group_id']=='1'){
					if(!$adminArr['Admin']['status']){
						$this->Session->setFlash(__('You account has been deactivated by admin!!', true), 'message', array('class'=>'message-red'));
					}else{
						if($this->Auth->login($adminArr))
						$this->redirect('/admin/admins/dashboard/');
					}
				}else{
					$this->Session->setFlash(__('You are not authorize to access.!!', true), 'message', array('class'=>'message-red'));
					$this->redirect('/admin/admins/dashboard/');
				}
			}else{
				$this->Session->setFlash(__('Invalid Username or Password!!', true), 'message', array('class'=>'message-red'));
			}
		}
	}
	
	//FUNCTION FOR ADMIN FORGOT PASSWORD START
	public function admin_forgot_password(){
		$this->layout = 'Admin/sign_in';

		//VALIDATE ADMIN START
		$redirectUrl = $this->Ami->validateAdmin();
		if($redirectUrl != '')
			$this->redirect($redirectUrl);
		//VALIDATE ADMIN END

		if(!empty($this->data)){ 
			$adminArr = $this->Admin->findByEmail($this->request->data['Admin']['email']);
			if(!empty($adminArr)){ 
				$newPassword = $this->Ami->createTempPassword(8);
				$encNewPassword = $this->Auth->password($newPassword);
				$saveData['Admin']['id'] = $adminArr['Admin']['id'];
				$saveData['Admin']['password'] = $encNewPassword;
				
				if($this->Admin->save($saveData, false)){
					//SEND EMAIL TO ADMINISTRATOR START
					$this->set('adminArr', $adminArr);
					$this->set('newPassword', $newPassword);
					$this->Email->to	   = $adminArr['Admin']['email'];
					$this->Email->from	   = 'test@gmail.com';
					$this->Email->subject  = 'Your New Login Password';
					$this->Email->template = 'admin/forgot_password';
					$this->Email->sendAs   = 'html'; 
					$this->Email->send();
					//SEND EMAIL TO ADMINISTRATOR END

					$this->Session->setFlash(__('New Password Sent to Your Email Successfully!!', true), 'message', array('class'=>'message-green'));
					$this->redirect('/admin/admins/sign_in/');
				}
			}else{
				$this->Session->setFlash(__('No Corresponding Email Found!!', true), 'message', array('class'=>'message-red'));
			}
		}
	}
	//FUNCTION FOR ADMIN FORGOT PASSWORD END
	
	
	//FUNCTION FOR ADMIN DASHBOARD END

	//FUNCTION FOR ADMIN SIGN OUT START
	public function admin_sign_out() {
		if($this->Session->check('Auth.Admin')){
			if($this->Session->delete('Auth.Admin'))
				$this->redirect('/admin/admins/sign_in');
		}
	}
	//FUNCTION FOR ADMIN SIGN OUT END

	//function on expotr csv start
	public function admin_export_csv(){
		$data = $this->Admin->find('all',array('conditions'=>array('Admin.group_id'=>'2')));
		$this->Export->exportCsv($data);
	
	}
	
	
	//function on expotr csv end
	
	//FUNCTION FOR CHANGING THE ADMIN EMAIL START
	public function admin_change_email() {
	if(!empty($this->request->data)){ 
			if($this->Admin->save($this->request->data)){
				$this->Session->setFlash(__('Admin Email Updated Successfully!!', true), 'message', array('class'=>'message-green'));
				$this->redirect('/admin/admins/change_email/');
			}else
				$this->Session->setFlash(__('Please Correct Following Error!!', true), 'message', array('class'=>'message-red'));
		}
		$this->data = $this->Admin->findById($this->Session->read('Auth.Admin.Admin.id'),array('contain' => false));
	}
	//FUNCTION FOR CHANGING THE ADMIN EMAIL END

	//FUNCTION FOR CHANGING THE ADMIN PASSWORD START
	public function admin_change_password() {
		if(!empty($this->request->data)){ 
			//validate current password
			$adminCount = $this->Admin->find('count', array('conditions'=>array('Admin.id'=>$this->request->data['Admin']['id'], 'Admin.password'=>$this->request->data['Admin']['password'])));
			
			if($adminCount > 0){
				//match both passwords
				if($this->request->data['Admin']['new_password'] == $this->request->data['Admin']['confirm_password']){
					$saveData['Admin']['id'] = $this->request->data['Admin']['id'];
					$saveData['Admin']['password'] = $this->Auth->password($this->request->data['Admin']['confirm_password']);
					
					if($this->Admin->save($saveData,false)){
						$this->Session->setFlash(__('Password Updated Successfully!!', true), 'message', array('class'=>'message-green'));
						$this->redirect('/admin/admins/change_password/');
					}else
						$this->Session->setFlash(__('Please Try Later!!', true), 'message', array('class'=>'message-red'));
				}else
					$this->Session->setFlash(__('Both Passwords Should be Same!!', true), 'message', array('class'=>'message-red'));
			}else
				$this->Session->setFlash(__('Invalid Current Password!!', true), 'message', array('class'=>'message-red'));
		}
		$this->data = $this->Admin->findById($this->Session->read('Auth.Admin.Admin.id'),array('contain' =>false));
		//pr($this->data);
	}
	//FUNCTION FOR CHANGING THE ADMIN PASSWORD END
	
	//FUNUCTION FOR MANAGING SUB ADMIN START	
	function admin_sub_manage(){
		$this->paginate = array('conditions'=>array('Admin.group_id'=>'2'),'limit'=>PAGING_SIZE, 'order'=>array('Admin.id'=>'DESC'));
		$this->set('viewListing', $this->paginate('Admin'));
		
	
	}
		//FUNUCTION FOR MANAGING SUB ADMIN END
	
	//FUNCTION FOR ACTIVATING/DEACTIVATING THE SUB ADMIN START
	public function admin_status_update($id, $newStatus) {
		if($id != ''){
			$this->Admin->recursive = -1;
			$userArr = $this->Admin->findById($id);
			//print_r($userArr);die;
			if(!empty($userArr)){
				$saveData['id'] = $id;
				$saveData['status'] = $newStatus;
				if($newStatus == '1'){
					if($userArr['Admin']['activation_link'] != 'verified')
						$saveData['activation_link'] = 'verified';
					$message = 'Activated';
				}else
					$message = 'Deactivated';
				if($this->Admin->save($saveData, false)){
					$this->set('userArr', $userArr);
					$this->set('message', $message);

					//send email to corresponding user start
					$this->Email->to	   = $userArr['Admin']['email'];
					$this->Email->from	   = EMAIL_ADMIN_FROM;
					$this->Email->subject  = 'Your Account '.$message.' by Administrator';
					$this->Email->template = 'admin/admin_account';
					$this->Email->sendAs   = 'html'; 
					$this->Email->send();

					$this->Session->setFlash(__('User '.$message.' Successfully!!', true), 'message', array('class'=>'message-green'));
				}else
					$this->Session->setFlash(__('No Associated User Found!!', true), 'message', array('class'=>'message-red'));
			}else
				$this->Session->setFlash(__('No Associated User Found!!', true), 'message', array('class'=>'message-red'));
		}else
			$this->Session->setFlash(__('No Associated User Found!!', true), 'message', array('class'=>'message-red'));
		$this->redirect('/admin/admins/sub_manage/');
		exit;
	}
	//FUNCTION FOR ACTIVATING/DEACTIVATING THE SUB ADMIN END
	
	//FUNCTION TO VIEW THE SUB ADMIN DETAILS START
	public function admin_view($id){
		//$this->User->recursive = -1;
		$this->layout = 'FancyBox/fancy_box_popup';
		
		$this->set('userArr', $this->Admin->findById($id));
	}
	//FUNCTION TO VIEW THE SUB ADMIN DETAILS END
	
	//FUNCTION FOR SUB ADMIN ADD START
	public function admin_add() {		
			if(!empty($this->request->data)){ //pr($this->request->data);die;
				$newPassword = $this->Ami->createTempPassword(8);
				$this->request->data['Admin']['password'] = $this->Auth->password($newPassword);
				//pr($this->request->data);die;
				if($this->Admin->save($this->request->data)){
					$userArr = $this->request->data;
					
					$this->set('userArr', $userArr);
					$this->set('newPassword', $newPassword);

					//send email to corresponding user start
					$this->Email->to	   = $userArr['Admin']['email'];
					$this->Email->from	   = EMAIL_ADMIN_FROM;
					$this->Email->subject  = 'Your New Login Password';
					$this->Email->template = 'admin/admin_add';
					$this->Email->sendAs   = 'html'; 
					$this->Email->send(); 
					//send email to corresponding user end
					
					
					
					$this->Session->setFlash(__('User Details Updated Successfully!!', true), 'message', array('class'=>'message-green'));
				}else
					$this->Session->setFlash(__('Please Try Later!!', true), 'message', array('class'=>'message-red'));
				//$this->redirect('/admin/admins/sub_manage/');
			}
	}
	//FUNCTION FOR SUB ADMIN ADD END
	
	//FUNCTION FOR SUB ADMIN EDIT START
	public function admin_edit($id) {
		if($id != ''){
			if(!empty($this->request->data)){ //pr($this->request->data);die;
				if($this->Admin->save($this->request->data))
					$this->Session->setFlash(__('User Details Updated Successfully!!', true), 'message', array('class'=>'message-green'));
				else
					$this->Session->setFlash(__('Please Try Later!!', true), 'message', array('class'=>'message-red'));
				$this->redirect('/admin/admins/sub_manage/');
			}

			$userArr = $this->Admin->findById($id);
			if(!empty($userArr)){ //pr($userArr);die;
				$this->data = $userArr;
			}else{
				$this->Session->setFlash(__('No Associated User Found!!', true), 'message', array('class'=>'message-red'));
				$this->redirect('/admin/admins/sub_manage/');
			}
		}else
			$this->redirect('/admin/admins/sub_manage/');
	}
	//FUNCTION FOR SUB ADMIN EDIT END
	
	//FUNCTION FOR DELETING THE SUB ADMIN START
	public function admin_delete($id) {
		if($id != ''){
			$this->Admin->recursive = -1;
			$usrArr = $this->Admin->findById($id);
			
			if(!empty($usrArr)){
				if($usrArr['group_id']!=1){
				if($this->Admin->delete($id))
					$this->Session->setFlash(__('User Deleted Successfully!!', true), 'message', array('class'=>'message-green'));
				else
					$this->Session->setFlash(__('Please Try Later!!', true), 'message', array('class'=>'message-red'));
				}else{
				$this->Session->setFlash(__('Please Try Later!!', true), 'message', array('class'=>'message-red'));
				}
				$this->redirect('/admin/admins/sub_manage/');
			}else{
				$this->Session->setFlash(__('No Associated User Found!!', true), 'message', array('class'=>'message-red'));
				$this->redirect('/admin/admins/sub_manage/');
			}
		}else
			$this->redirect('/admin/admins/sub_manage/');
		exit;
	}
	//FUNCTION FOR DELETING THE SUB ADMIN END
	
	//FUNCTION FOR RESETTING THE PASSWORD OF A SUB ADMIN START
	public function admin_reset_password($id) {
		if($id != ''){
			$this->Admin->recursive = -1;
			$userArr = $this->Admin->findById($id);
			if(!empty($userArr)){
				$newPassword = $this->Ami->createTempPassword(8);
				$saveData['id'] = $id;
				$saveData['password'] = $this->Auth->password($newPassword);
				if($this->Admin->save($saveData, false)){
					$this->set('userArr', $userArr);
					$this->set('newPassword', $newPassword);

					//send email to corresponding user start
					$this->Email->to	   = $userArr['Admin']['email'];
					$this->Email->from	   = EMAIL_ADMIN_FROM;
					$this->Email->subject  = 'Your New Login Password';
					$this->Email->template = 'admin/admin_reset';
					$this->Email->sendAs   = 'html'; 
					$this->Email->send();
					//send email to corresponding user end
					
					$this->Session->setFlash(__('Password Reset Successfully & Sent to the User!!', true), 'message', array('class'=>'message-green'));
					$this->redirect('/admin/admins/sub_manage/');
				}else{
					$this->Session->setFlash(__('Please Try Later!!', true), 'message', array('class'=>'message-red'));
					$this->redirect('/admin/admins/sub_manage/');
				}
			}else{
				$this->Session->setFlash(__('No Associated User Found!!', true), 'message', array('class'=>'message-red'));
				$this->redirect('/admin/admins/sub_manage/');
			}
		}else
			$this->redirect('/admin/admins/sub_manage/');
		exit;
	}
	//FUNCTION FOR RESETTING THE PASSWORD OF A SUB ADMIN END
	
	/*
		
		
	*/

}
