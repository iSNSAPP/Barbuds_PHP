<?php

App::uses('AppController', 'Controller');

/**
 * Api Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package		app.Controller
 * @link		http://book.cakephp.org/2.0/en/controllers.html#the-app-controller
 */
class ApiController extends AppController {

    public $name = 'Api';
    public $helpers = array('Html', 'Form', 'Session', 'Text');
    public $components = array('Session', 'Cookie', 'Email', 'Auth', 'Ami', 'Acl');
    public $layout = 'ajax';
    public $uses = array('User', 'Event', 'Image', 'EventImage', 'Chat', 'Comment', 'EventUser');

    //BEFORE FILTER STARTS
    function beforeFilter() {
        parent::beforeFilter();
        $this->Auth->allowedActions = array('registration', 'upload_profile_pic', 'event_details', 'events', 'user_login', 'save_profile', 'get_profile_detail', 'forgot_password', 'change_password', 'edit_profile', 'create_events', 'user_logout', 'upload_event_pic', 'user_chat', 'get_chat_message', 'facebook_login', 'get_profile_pics', 'delete_profile_pic', 'delete_event_pic', 'save_event_pic', 'get_event_pics', 'get_event_detail', 'search', 'delete_event', 'update_events', 'comment', 'get_comment', 'get_all_users', 'send_game_invite', 'delete_comment', 'change_attend', 'send_notification');
    }

    //FUNCTION FOR REGISTERING THE USER START
    public function registration() {
        if (!empty($_POST) && $_POST['page'] == 'signup') {
            $encData = $_REQUEST;
            // if POST fields are present, then manipulate the data and save
            if (isset($encData) && !empty($encData)) {
                // check if the email is registered
                $info = $this->User->find('count', array('conditions' => array('User.email' => $encData['email'])));
                if ($info >= 1) {
                    $result['status'] = 'This email already registered';
                    $result['result'] = 'Fail';
                    $result = JSON_encode($result);
                    echo $result;
                    exit;
                } else {
                    $info = $this->User->find('count', array('conditions' => array('User.device_id' => $encData['device_id'])));
                    if ($info) {
                        $result['status'] = 'It is not allowed to make more than one account on the same device';
                        $result['result'] = 'Fail';
                        echo json_encode($result);
                        exit;
                    }
                    if (!empty($encData['email'])) {
                        if ($encData['password'] == $encData['confirmpassword']) {
                            $data['User'] = $encData;
                            $newPassword = $encData['password'];
                            $data['User']['password'] = $this->Auth->password($encData['password']);
                            $data['User']['status'] = 1;

                            // Code snippet for image uploading
                            $file_name = '';
                            if (!empty($_FILES['file']['name'])) {
                                $file = $_FILES['file'];
                                $file_name = time() . '' . $_FILES['file']['name'];
                                $path = $file['name'];
                                $ext = pathinfo($path, PATHINFO_EXTENSION);
                                if ($file['name'] != '') {
                                    if ($ext == 'jpeg' || $ext == 'jpg' || $ext == 'png') {
                                        $target_path = realpath('../../app/webroot/img/Profile_pic/');
                                        $target_path = $target_path . '/' . basename($file_name);
                                        if (move_uploaded_file($_FILES['file']['tmp_name'], $target_path)) {
                                            $data['User']['profile_pic'] = $file_name;
                                            $data['User']['profile_pic_path'] = SITE_PATH . 'app/webroot/img/Profile_pic/' . $file_name;
                                        }
                                    }
                                }
                            }

                            if ($this->User->save($data, false)) {
                                $UserId = $this->User->getLastInsertID();
                                $data1['Image']['user_id'] = $UserId;
                                if (isset($data['User']['profile_pic'])) {
                                    $data1['Image']['profile_pic'] = $data['User']['profile_pic'];
                                    $this->Image->save($data1, false);
                                }

                                $UserData = $this->User->find('first', array(
                                    'conditions' => array('User.id' => $UserId),
                                    'fields' => array()));

                                $this->set('userArr', $data);
                                $this->set('newPassword', $newPassword);
                                //$this->Email->to	   = $data['User']['email'];
                                //$this->Email->from	   = 'test@gmail.com';
                                //$this->Email->subject  = 'Your account has been created';
                                //$this->Email->template = 'admin/registration';
                                //$this->Email->sendAs   = 'html'; 
                                //$this->Email->send();
                                $result['status'] = 'User Registered Successful.';
                                $result['result'] = 'Success';
                                // $UserData['User']['event_count'] = strval($this->Event->find('count', array('conditions' => array('Event.user_id' => $_POST['id']))));
                                $result['User'] = $UserData['User'];
                                $result = JSON_encode($result);
                                echo $result;
                                die;
                            } else {
                                $result['status'] = 'Error to register a user. Please try later!!';
                                $result['result'] = 'Fail';
                                $result = JSON_encode($result);
                                echo $result;
                                die;
                            }
                        } else {
                            $result['status'] = 'Confirm password mismatch.';
                            $result['result'] = 'Fail';
                            $result = JSON_encode($result);
                            echo $result;
                            die;
                        }
                    } else {
                        $result['status'] = 'Please provide a valid email';
                        $result['result'] = 'Fail';
                        $result = JSON_encode($result);
                        echo $result;
                        die;
                    }
                }
            }
        }
    }

    public function user_login() {
        $encData = $_POST;
        //if POST fields are present,then check login
        if (!empty($_POST) && isset($_POST)) {
            $adminArr = $this->User->find('first', array(
                'conditions' => array(
                    'User.email' => trim($encData['email']),
                    'User.password' => $this->Auth->password($encData['password'])
                ),
                'fields' => array('id', 'chat_account_id', 'name', 'email', 'gender', 'dob', 'head_line_code', 'interest',
                    'favourite_drink', 'chat_count', 'event_count', 'about_me', 'message_count',
                    'longitude', 'latitude', 'altitude', 'profile_pic', 'profile_pic_path', 'status', 'apns_token')));
            if (!empty($adminArr) && $adminArr['User']['status'] == '2') {
                $result['status'] = 'Your account has been deactivated by Admin.';
                $result['result'] = 'Fail';
                echo JSON_encode($result);
                exit;
            } else {
                if (!empty($adminArr)) {
                    if (!empty($_POST['device_id'])) {
                        $this->User->id = $adminArr['User']['id'];
                        $this->User->saveField('device_id', $_POST['device_id']);
                        $this->User->saveField('latitude', $_POST['latitude']);
                        $this->User->saveField('longitude', $_POST['longitude']);
                        $this->User->saveField('altitude', $_POST['altitude']);
                        $this->User->saveField('apns_token', $_POST['apns_token']);
                        $adminArr['User']['device_id'] = $_POST['device_id'];
                    }
                    $result['status'] = 'User Already Registered';
                    $result['result'] = 'Success';

                    $result['User']['event_count'] = strval($this->Event->find('count', array('conditions' => array('Event.user_id' => $adminArr['User']['id']))));
                    $result['User'] = $adminArr['User'];
                    echo JSON_encode($result);
                    exit;
                } else {
                    $result['status'] = 'Invalid Email or Password';
                    $result['result'] = 'Fail';
                    echo JSON_encode($result);
                    exit;
                }
            }
        }
    }

    public function forgot_password() {
        if (!empty($_POST['email'])) {
            $info = $this->User->find('first', array('conditions' => array('User.email' => $_POST['email'])));

            if (!empty($info)) {
//                $newPassword = $this->Ami->createTempPassword(8);
//                $this->set('userArr', $info);
//                $this->set('newPassword', $newPassword);
//
//                $this->Email->to = $info['User']['email'];
//                $this->Email->from = 'test@gmail.com';
//                $this->Email->subject = 'Your password has been reset.';
//                $this->Email->template = 'admin/user_forgot_password';
//                $this->Email->sendAs = 'html';
//                $this->Email->send();

                $result['status'] = 'Your Login Password has been reset and new login credentials has been sent to your email address';
                $result['result'] = 'Success';
                $result = JSON_encode($result);
                echo $result;
                die;
            } else {
                $result['status'] = 'We could not find an account for that email address.';
                $result['result'] = 'Fail';
                echo JSON_encode($result);
                die;
            }
        }
    }

    public function change_password() {
        if (!empty($_POST['id'])) {
            //validate current password
            $adminCount = $this->User->find('count', array('conditions' => array('User.id' => $_POST['id'], 'User.password' => $this->Auth->password($_POST['old_password']))));
            if ($adminCount > 0) {
                //match both passwords
                if ($_POST['new_password'] == $_POST['confirm_password']) {
                    $saveData['User']['id'] = $_POST['id'];
                    $saveData['User']['password'] = $this->Auth->password($_POST['confirm_password']);

                    if ($this->User->save($saveData, false)) {
                        $result['status'] = 'Password updated successfully!';
                        $result['result'] = 'Success';
                        $result = JSON_encode($result);
                        echo $result;
                        die;
                    } else {
                        $result['status'] = 'Password does not match!';
                        $result['result'] = 'Fail';
                        $result = JSON_encode($result);
                        echo $result;
                        die;
                    }
                } else {
                    $result['status'] = 'Password does not match!';
                    $result['result'] = 'Fail';
                    $result = JSON_encode($result);
                    echo $result;
                    die;
                }
            } else {
                $result['status'] = 'Old Password does not match!';
                $result['result'] = 'Fail';
                $result = JSON_encode($result);
                echo $result;
                die;
            }
        }
    }

    public function get_all_users() {
        $user_id = $_POST['id'];
        if (!empty($user_id)) {
            $user_id = $_POST['id'];

            $surQuery = sprintf("SELECT id, chat_account_id, name, email, gender, dob, 
                    head_line_code, interest, favourite_drink, chat_count, event_count, 
                    about_me, message_count, longitude, latitude, altitude, profile_pic, 
                    profile_pic_path, status,"
                    . "( 3959 * acos( cos( radians(0) ) * cos( radians( latitude ) ) *	"
                    . "cos( radians( longitude ) - radians(0) ) + sin( radians(0) ) * sin( radians( latitude ) ) ) ) "
                    . "AS distance FROM job_users");
            $surQuery = "SELECT B.* FROM (" . $surQuery . ") AS B ";
            $surQuery .= sprintf(" WHERE B.id <> '%s' ", $user_id);

            $adminArr = $this->User->find('first', array('conditions' => array('User.id' => trim($_POST['id'])), 'fields' => array()));

            $userArr = $this->User->query($surQuery);
            if (!empty($userArr)) {

                $this->User->id = $adminArr['User']['id'];
                $this->User->saveField('latitude', $_POST['latitude']);
                $this->User->saveField('longitude', $_POST['longitude']);
                $this->User->saveField('altitude', $_POST['altitude']);

                $result['status'] = 'Online Users!!';
                $result['result'] = 'Success';
                $result['Admin'] = $adminArr['User'];
                $i = 0;
                foreach ($userArr as $arr) {
                    $result['User'][$i++] = $arr['B'];
                }
                $result = JSON_encode($result);
                echo $result;
                die;
            } else {
                $result['status'] = 'No User Found!!';
                $result['result'] = 'Fail';
                $result = JSON_encode($result);
                echo $result;
                die;
            }
        }
    }

    public function edit_profile() {

        //if POST fields are present,then check login
        if (!empty($_POST)) {
            $adminArr = $this->User->find('first', array('conditions' => array('User.id' => trim($_POST['id'])), 'fields' => array('id', 'name', 'email', 'gender', 'dob', 'head_line_code', 'interest', 'favourite_drink', 'chat_count', 'event_count', 'about_me', 'message_count', 'longitude', 'latitude', 'altitude', 'profile_pic', 'profile_pic_path')));

            if (!empty($adminArr)) {
                $result['status'] = 'Your Profile Detail.';
                $result['result'] = 'Success';
                $result['User'] = $adminArr['User'];
                $result = JSON_encode($result);
                echo $result;
                die;
            } else {
                $result['status'] = 'User does not exist!!';
                $result['result'] = 'Fail';
                $result = JSON_encode($result);
                echo $result;
                die;
            } die;
        }
    }

    public function save_profile() {
        if (!empty($_POST['id'])) {
            $data['User'] = $_POST;
            if (!empty($_POST['file_name']) && !empty($_POST['file_path'])) {
                if (!empty($_POST['file_name']))
                    $data['User']['profile_pic'] = $_POST['file_name'];
                $data['User']['profile_pic_path'] = $_POST['file_path'];
            }

            // Code for image upload
            if ($this->User->save($data, false)) {
                $adminArr = $this->User->find('first', array(
                    'conditions' => array('User.id' => trim($_POST['id'])),
                    'fields' => array('id', 'chat_account_id', 'name', 'email', 'gender', 'dob', 'head_line_code', 'interest',
                        'favourite_drink', 'chat_count', 'event_count', 'about_me', 'message_count',
                        'longitude', 'latitude', 'altitude', 'profile_pic', 'profile_pic_path', 'status', 'apns_token')
                        )
                );
                $result['status'] = 'Your Profile has been updated';
                $result['result'] = 'Success';
                $result['User'] = $adminArr['User'];
                $result = JSON_encode($result);
                echo $result;
                die;
            } else {
                $result['status'] = 'User does not exist!!';
                $result['result'] = 'Fail';
                $result = JSON_encode($result);
                echo $result;
                die;
            }
        }
    }

    public function create_events() {
        $user_id = $_POST['user_id'];
        if (!empty($user_id)) {
            $data['Event'] = $_POST;
            $data['Event']['status'] = 1;
            $user = $this->User->findById($user_id);
            if ($user) {
                if (!empty($_FILES['file']['name'])) {
                    $file = $_FILES['file'];
                    $file_name = time() . '' . $_FILES['file']['name'];
                    $path = $file['name'];
                    $ext = pathinfo($path, PATHINFO_EXTENSION);

                    if ($file['name'] != '') {
                        if ($ext == 'jpeg' || $ext == 'jpg' || $ext == 'png') {
                            $target_path = realpath('../../app/webroot/img/event_pictures/');
                            $target_path = $target_path . '/' . basename($file_name);
                            if (move_uploaded_file($_FILES['file']['tmp_name'], $target_path)) {
                                $data['Event']['picture'] = $file_name;
                                $data['Event']['event_picture_path'] = SITE_PATH . 'app/webroot/img/event_pictures/' . $file_name;
                            }
                        }
                    }
                }
                if ($this->Event->save($data, false)) {
                    $dataEventImages['EventImage']['event_id'] = $this->Event->getLastInsertID();
                    $dataEventImages['EventImage']['status'] = 1;
                    $this->EventImage->save($dataEventImages, false);
                    $result['status'] = 'Event Created';
                    $result['result'] = 'Success';
                    $result['new_id'] = $this->Event->id;
                    $user = $user['User'];
                    $result['near_users'] = $this->getNearUsers($user['id'], $user['latitude'], $user['longitude'], $data['Event']['invite_radius'], -1);
                    $this->add_users_to_event($user_id, $result['new_id'], $result['near_users']);
                    echo JSON_encode($result);
                    die;
                } else {
                    $result['result'] = 'Fail';
                    $result['status'] = 'Event is not created. Please try again.';
                    $result = JSON_encode($result);
                    echo $result;
                    die;
                }
            } else {
                $result['status'] = 'Event is not created. Please try again.';
                $result['result'] = 'Fail';
                $result = JSON_encode($result);
                echo $result;
                die;
            }
        }
    }

    private function add_users_to_event($creator_id, $event_id, $user_array) {
        $creator['event_id'] = $event_id;
        $creator['user_id'] = $creator_id;
        $creator['user_status'] = '2';
        $this->EventUser->save($creator);
        $data = array();
        foreach ($user_array as $user) {
            $row = array();
            $row['event_id'] = $event_id;
            $row['user_id'] = $user['id'];
            $row['user_status'] = '0';
            $data[] = $row;
            // Increase new event count on user table row
            $this->User->id = $user['id'];
            $this->User->saveField('event_count', $user['event_count'] + 1);
        }
        $this->EventUser->saveMany($data, array());
    }

    public function user_logout() {
        if (!empty($_POST['id'])) {
            $this->User->id = $_POST['id'];
            if ($this->User->saveField('device_id', '')) {
                $result['status'] = 'Logout successfully!!';
                $result['result'] = 'Success';
                $result = JSON_encode($result);
                echo $result;
                die;
            } else {
                $result['status'] = 'Please try again.';
                $result['result'] = '';
                $result = JSON_encode($result);
                echo $result;
                die;
            }
        }
    }

    public function get_profile_detail() {
        if (!empty($_POST['id']) && isset($_POST['id'])) {
            $adminArr = $this->User->find(
                    'first', array(
                'conditions' => array('User.id' => trim($_POST['id'])),
                'fields' => array('id', 'chat_account_id', 'name', 'gender', 'dob', 'head_line_code', 'interest',
                    'favourite_drink', 'chat_count', 'event_count', 'about_me', 'message_count',
                    'longitude', 'latitude', 'altitude', 'profile_pic', 'profile_pic_path')
                    )
            );
            if (!empty($adminArr)) {
                $result['status'] = 'Your Profile Detail.';
                $result['result'] = 'Success';
                $result['User'] = $adminArr['User'];
                $result['User']['event_count'] = strval($this->Event->find('count', array('conditions' => array('Event.user_id' => $_POST['id']))));
                $result = JSON_encode($result);
                echo $result;
                die;
            } else {
                $result['status'] = 'User does not exist!!';
                $result['result'] = 'Fail';
                $result = JSON_encode($result);
                echo $result;
                die;
            } die;
        }
    }

    public function events() {
        $user_id = $_POST['user_id'];
        if (!empty($user_id)) {
            $all_events = $this->EventUser->find('all', array(
                'conditions' => array('EventUser.user_id' => $user_id),
                'order' => array('Event.start_date')));
            if (empty($all_events)) {
                $result['result'] = 'Fail';
                $result['status'] = 'No Event Found';
                echo JSON_encode($result);
                exit;
            }

            // initialize event count of the user
            $this->User->id = $user_id;
            $this->User->saveField('event_count', 0);

            $result_events = array();
            foreach ($all_events as $info) {
                $data['Event'] = $info['Event'];
                $data['status'] = $info['EventUser']['user_status'];
                $result_events[] = $data;
            }
            $result['result'] = 'Success';
            $result['status'] = 'All Events';
            $result['Event'] = $result_events;
            echo JSON_encode($result);
            exit;
        } else {
            $result['result'] = 'Fail';
            $result['status'] = 'Bad request';
            echo JSON_encode($result);
            exit;
        }
    }

    public function event_details() {
        if (!empty($_POST)) {
            if (!empty($_POST['id'])) {
                $detail = $this->Event->findById($_POST['id']);
                if (!empty($detail)) {
                    $result['status'] = 'Event Detail Found';
                    $result['result'] = 'Success';
                    $result['Event'] = $detail['Event'];
                    $result = JSON_encode($result);
                    echo $result;
                    die;
                } else {
                    $result['status'] = 'No Events detail found.';
                    $result['result'] = 'Fail';
                    $result = JSON_encode($result);
                    echo $result;
                    die;
                }
            } else {
                $result['status'] = 'No Events detail found.';
                $result['result'] = 'Fail';
                $result = JSON_encode($result);
                echo $result;
                die;
            }
        }
    }

    public function upload_profile_pic() {
        if (!empty($_POST)) {
            /*             * ** Code for image upload  ***** START */
            $profile_info = $this->User->find('count', array('conditions' => array('User.id' => trim($_POST['user_id']))));
            if (!empty($_POST['user_id']))
                $data['Image']['user_id'] = $_POST['user_id'];
            $data['Image']['status'] = 1;
            if ($profile_info) {
                if (!empty($_FILES['file']['name'])) {
                    $file = $_FILES['file'];
                    $file_name = time() . '' . $_FILES['file']['name'];
                    $path = $file['name'];
                    $ext = pathinfo($path, PATHINFO_EXTENSION);

                    if ($file['name'] != '') {
                        if ($ext == 'jpeg' || $ext == 'jpg' || $ext == 'png') {
                            $target_path = realpath('../../app/webroot/img/Profile_pic/');
                            $target_path = $target_path . '/' . basename($file_name);
                            if (move_uploaded_file($_FILES['file']['tmp_name'], $target_path)) {
                                $data['Image']['profile_pic'] = $file_name;
                            }
                        }
                    }
                }
                /*                 * ** Code for image upload  ***** End */
                if ($this->Image->save($data, false)) {
                    $adminArr = $this->Image->find('all', array('conditions' => array('Image.user_id' => trim($_POST['user_id'])), 'fields' => array('user_id', 'profile_pic', 'id')));
                    $i = 0;
                    foreach ($adminArr as $img) {
                        $new[$i]['profile_pic_path'] = SITE_PATH . 'app/webroot/img/Profile_pic/' . $img['Image']['profile_pic'];
                        $new[$i++]['id'] = $img['Image']['id'];
                    }

                    $result['status'] = 'Your Profile pic has been updated';
                    $result['result'] = 'Success';
                    $result['Images'] = $new;
                    $result = JSON_encode($result);
                    echo $result;
                    die;
                } else {
                    $result['status'] = 'User does not exist!!';
                    $result['result'] = 'Fail';
                    $result = JSON_encode($result);
                    echo $result;
                    die;
                }
            } else {
                $result['status'] = 'Please choose jpeg, png and jpg pic!!';
                $result['result'] = 'Fail';
                $result = JSON_encode($result);
                echo $result;
                die;
            }
        }
    }

    public function upload_event_pic() {
        if (!empty($_POST['user_id'])) {
            /*             * ** Code for image upload  ***** START */
            $event_info = $this->User->find('count', array('conditions' => array('User.id' => trim($_POST['user_id']))));
            if ($event_info) {
                $data['EventImage']['user_id'] = $_POST['user_id'];
                $data['EventImage']['status'] = 1;
                $file_name = '';
                if (!empty($_FILES['file']['name'])) {
                    $file = $_FILES['file'];
                    $file_name = time() . '' . $_FILES['file']['name'];
                    $path = $file['name'];
                    $ext = pathinfo($path, PATHINFO_EXTENSION);
                    if ($file['name'] != '') {
                        if ($ext == 'jpeg' || $ext == 'jpg' || $ext == 'png') {
                            $target_path = realpath('../../app/webroot/img/event_pictures/');
                            $target_path = $target_path . '/' . basename($file_name);
                            if (move_uploaded_file($_FILES['file']['tmp_name'], $target_path)) {
                                $data['EventImage']['event_pic'] = $file_name;
                                $data['EventImage']['event_pic_path'] = SITE_PATH . 'app/webroot/img/event_pictures/' . $file_name;
                            }
                        }
                    }
                }
                /*                 * ** Code for image upload  ***** End */
                if ($this->EventImage->save($data, false)) {
                    $adminArr = $this->EventImage->find('all', array('conditions' => array('EventImage.user_id' => trim($_POST['user_id'])), 'fields' => array('event_pic_path', 'id', 'event_pic')));
                    $new = array();
                    if (!empty($adminArr)) {
                        $i = 0;
                        foreach ($adminArr as $img) {
                            $new[$i]['event_pic_path'] = $img['EventImage']['event_pic_path'];
                            $new[$i]['id'] = $img['EventImage']['id'];
                            $new[$i++]['event_pic'] = $img['EventImage']['event_pic'];
                        }
                    }
                    $result['status'] = 'Event pic has been uploaded';
                    $result['result'] = 'Success';
                    $result['Event'] = $new;
                    $result = JSON_encode($result);
                    echo $result;
                    die;
                } else {
                    $result['status'] = 'Event does not exist!!';
                    $result['result'] = 'Fail';
                    $result = JSON_encode($result);
                    echo $result;
                    die;
                }
            } else {
                $result['result'] = 'Fail';
                $result['status'] = 'No Event Found. Please check your event list.';
                $result = JSON_encode($result);
                echo $result;
                die;
            }
        }
    }

    public function user_chat() {
        if (!empty($_POST)) {
            if (!empty($_POST['send_by']) && !empty($_POST['send_to'])) {
                $data['Chat']['send_by'] = $_POST['send_by'];
                $data['Chat']['send_to'] = $_POST['send_to'];
                $data['Chat']['message'] = $_POST['message'];
                $data['Chat']['status'] = 1;
                if ($this->Chat->save($data, false)) {
                    $result['status'] = 'Message has send!!';
                    $result['result'] = 'Success';
                    $result = JSON_encode($result);
                    echo $result;
                    die;
                } else {
                    $result['status'] = 'User does not exist!!';
                    $result['result'] = 'Fail';
                    $result = JSON_encode($result);
                    echo $result;
                    die;
                }
            } else {
                $result['status'] = 'User does not exist!!';
                $result['result'] = 'Fail';
                $result = JSON_encode($result);
                echo $result;
                die;
            }
        }
    }

    public function get_chat_message() {
        if (!empty($_POST)) {
            if (!empty($_POST['user_id'])) {
                $info = $this->Chat->find('all', array('conditions' => array('Chat.send_by' => $_POST['user_id'])));
                if (!empty($info)) {
                    $result['status'] = 'Message has Found!!';
                    $result['result'] = 'Success';
                    $result['Message'] = $info;
                    $result = JSON_encode($result);
                    echo $result;
                    die;
                } else {
                    $result['status'] = 'No Message has Found!!';
                    $result['result'] = 'Success';
                    $result = JSON_encode($result);
                    echo $result;
                    die;
                }
            } else {
                $result['status'] = 'User does not exist!!';
                $result['result'] = 'Fail';
                $result = JSON_encode($result);
                echo $result;
                die;
            }
        }
    }

    public function facebook_login() {
        if (!empty($_POST)) {
            $encData = $_POST;
            if (isset($encData['email'])) {
                // check is email register or not
                $info = $this->User->find('first', array('conditions' => array('User.email' => $encData['email']), 'fields' => array()));
                if (!empty($info['User']['email']) && !empty($info['User']['facebook_id'])) {
                    $result['result'] = 'Success';
                    $result['status'] = 'Facebook Login Successful.';
                    $result['User'] = $info['User'];
                    $result = JSON_encode($result);
                    echo $result;
                    die;
                } else {
                    if (!empty($info['User']['email'])) {
                        $result['User']['id'] = $info['User']['id'];
                        $result['result'] = 'Fail';
                        $result['status'] = 'The email which is used with your Facebook is already registered.';
                        $result = JSON_encode($result);
                        echo $result;
                        die;
                    } else {
                        if (empty($encData['facebook_id'])) {
                            $result['status'] = 'Facebook id can not be blank';
                            $result['result'] = 'Fail';
                            $result = JSON_encode($result);
                            echo $result;
                            die;
                        }
                        $data['User'] = $encData;
                        $data['User']['status'] = 1;
                        if (isset($encData['profile_pic'])) {
                            $data['User']['profile_pic_path'] = $encData['profile_pic'];
                        }

                        // Code snippet for image upload
                        if ($this->User->save($data, false)) {
                            $UserId = $this->User->getLastInsertID();
                            $UserData = $this->User->find('first', array('conditions' => array('User.id' => $UserId), 'fields' => array()));
                            $this->set('userArr', $data);
//                            $this->Email->to = $data['User']['email'];
//                            $this->Email->from = 'test@gmail.com';
//                            $this->Email->subject = 'Congrates!!Your account has been created';
//                            $this->Email->template = 'admin/registration';
//                            $this->Email->sendAs = 'html';
//                            $this->Email->send();
                            $result['User'] = $UserData['User'];
                            $result['result'] = 'Success';
                            $result['status'] = 'User Registered successfully';
                            echo JSON_encode($result);
                            die;
                        } else {
                            $result['status'] = 'Error to login please try later.';
                            $result['result'] = mysql_error();
                            echo JSON_encode($result);
                            die;
                        }
                    }
                }
            } else {
                $result['status'] = 'Please provide a valid email.';
                $result['result'] = 'Fail';
                $result = JSON_encode($result);
                echo $result;
                die;
            }
        }
    }

    public function get_profile_pics() {
        if (!empty($_POST)) {
            if ($_POST['user_id']) {
                $adminArr = $this->Image->find('all', array('conditions' => array('Image.user_id' => trim($_POST['user_id'])), 'fields' => array('profile_pic', 'id')));

                if (!empty($adminArr)) {
                    $i = 0;
                    foreach ($adminArr as $img) {
                        $new[$i]['profile_pic_path'] = SITE_PATH . 'app/webroot/img/Profile_pic/' . $img['Image']['profile_pic'];
                        $new[$i++]['id'] = $img['Image']['id'];
                    }

                    $result['status'] = 'All Profile Pics Here';
                    $result['result'] = 'Success';
                    $result['Images'] = $new;
                    $result = JSON_encode($result);
                    echo $result;
                    die;
                } else {
                    $result['status'] = 'Profile Pic does not exist!!';
                    $result['result'] = 'Success';
                    $result = JSON_encode($result);
                    echo $result;
                    die;
                }
            }
        }
    }

    public function delete_profile_pic() {
        if (!empty($_POST['user_id'])) { //pr($_POST);die;
            $data['User']['id'] = $_POST['user_id'];
            if (!empty($_POST['pic_name']) && !empty($_POST['image_id'])) {
                $old_path = realpath('../../app/webroot/img/Profile_pic/');
                $old_path = $old_path . '/' . basename($_POST['pic_name']);
                if (file_exists($old_path)) {
                    unlink($old_path);
                    $data['User']['profile_pic'] = '';
                    $data['User']['profile_pic_path'] = '';
                    $this->User->save($data, false);
                    $this->Image->id = $_POST['image_id'];
                    if ($this->Image->delete($_POST['image_id'])) {
                        $new = array();
                        $adminArr = $this->Image->find('all', array('conditions' => array('Image.user_id' => trim($_POST['user_id'])), 'fields' => array('profile_pic', 'id')));
                        $i = 0;
                        foreach ($adminArr as $img) {
                            $new[$i]['profile_pic_path'] = SITE_PATH . 'app/webroot/img/Profile_pic/' . $img['Image']['profile_pic'];
                            $new[$i++]['id'] = $img['Image']['id'];
                        }
                        $result['status'] = 'Your Profile Pics has been deleted successfully.';
                        $result['result'] = 'Success';
                        $result['Images'] = $new;
                        $result = JSON_encode($result);
                        echo $result;
                        die;
                    } else {
                        $result['status'] = 'Error!Please try again!!';
                        $result['result'] = 'Fail';
                        $result = JSON_encode($result);
                        echo $result;
                        die;
                    }
                } else {
                    $result['status'] = 'Error!Please try again!!';
                    $result['result'] = 'Fail';
                    $result = JSON_encode($result);
                    echo $result;
                    die;
                }
            }
        }
    }

    public function delete_event_pic() {
        if (!empty($_POST['id']) && !empty($_POST['event_pic']) && !empty($_POST['user_id'])) {
            $data['EventImage'] = $_POST;
            $old_path = realpath('../../app/webroot/img/event_pictures/');
            $old_path = $old_path . '/' . basename($_POST['event_pic']);
            if (file_exists($old_path))
                unlink($old_path);

            $this->EventImage->id = $data['EventImage']['id'];
            if ($this->EventImage->delete($_POST['id'])) {
                $new = array();
                $adminArr = $this->EventImage->find('all', array('conditions' => array('EventImage.user_id' => trim($_POST['user_id'])), 'fields' => array('id', 'event_pic', 'event_pic_path', 'user_id')));
                $i = 0;
                foreach ($adminArr as $img) {
                    $new[$i]['event_pic'] = $img['EventImage']['event_pic'];
                    $new[$i]['id'] = $img['EventImage']['id'];
                    $new[$i]['user_id'] = $img['EventImage']['user_id'];
                    $new[$i++]['event_pic_path'] = $img['EventImage']['event_pic_path'];
                }
                $result['status'] = 'Event Pic has been deleted successfully.';
                $result['result'] = 'Success';
                $result['EventImage'] = $new;
                $result = JSON_encode($result);
                echo $result;
                die;
            } else {
                $result['result'] = 'Fail';
                $result['status'] = 'Event pic not found.';
                $result = JSON_encode($result);
                echo $result;
                die;
            }
        }
    }

    public function save_event_pic() {
        if (!empty($_POST['event_id']) && !empty($_POST['pic_name'])) {
            $data['Event']['id'] = $_POST['event_id'];
            $data['Event']['picture'] = $_POST['pic_name'];
            $data['Event']['event_picture_path'] = $_POST['pic_path'];
            if ($this->Event->save($data, false)) {
                $adminArr = $this->Event->findById($_POST['event_id']);
                $result['result'] = 'Success';
                $result['status'] = 'Event Pic has been saved.';
                $result['Event'] = $adminArr['Event'];
                $result = JSON_encode($result);
                echo $result;
                die;
            } else {
                $result['status'] = 'User does not exist!!';
                $result['result'] = 'Fail!!';
                $result = JSON_encode($result);
                echo $result;
                die;
            }
        }
    }

    public function get_event_pics() {
        if (!empty($_POST)) {
            if ($_POST['user_id']) {
                $adminArr = $this->EventImage->find('all', array('conditions' => array('EventImage.user_id' => trim($_POST['user_id'])), 'fields' => array('event_pic', 'id', 'event_pic_path', 'user_id')));

                if (!empty($adminArr)) {
                    $i = 0;
                    foreach ($adminArr as $img) {
                        $new[$i]['event_pic_path'] = $img['EventImage']['event_pic_path'];
                        $new[$i]['event_pic'] = $img['EventImage']['event_pic'];
                        $new[$i]['user_id'] = $img['EventImage']['user_id'];
                        $new[$i++]['id'] = $img['EventImage']['id'];
                    }

                    $result['status'] = 'All Event Pics Here';
                    $result['result'] = 'Success';
                    $result['EventImage'] = $new;
                    $result = JSON_encode($result);
                    echo $result;
                    die;
                } else {
                    $result['status'] = 'Event Pics not found.!';
                    $result['result'] = 'Success';
                    $result = JSON_encode($result);
                    echo $result;
                    die;
                }
            }
        }
    }

    public function get_event_detail() {
        $event_id = $_POST['event_id'];
        if (!empty($event_id)) {
            $attendingUsers = $this->EventUser->find('all', array(
                'conditions' => array('EventUser.event_id' => $event_id, 'EventUser.user_status' => '1')
            ));
//            $attendingUsers = $this->EventUser->find('all', array(
//                'conditions' => array(''),
//                'group' => array('EventUser.user_id')
//            ));
            if (empty($attendingUsers)) {
                $result['status'] = 'No user';
                $result['result'] = 'Fail';
                echo JSON_encode($result);
                exit;
            }
            $resultArray = array();
            foreach ($attendingUsers as $user) {
                $resultArray[] = $user['User'];
            }
            $result['status'] = 'Attending Users';
            $result['result'] = 'Success';
            $result['User'] = $resultArray;
            echo JSON_encode($result);
            exit;
        }
    }

    public function search() {
        if (isset($_POST['latitude']) && isset($_POST['longitude']) && isset($_POST['distance'])) {
            $userArr = $this->getNearUsers($_POST['id'], $_POST['latitude'], $_POST['longitude'], $_POST['distance'], $_POST['age']);
            if (!empty($userArr)) {
                $result['status'] = 'Online Users!!';
                $result['result'] = 'Success';
                $result['User'] = $userArr;
                echo JSON_encode($result);
                exit;
            } else {
                $result['status'] = 'No User Found!!';
                $result['result'] = 'Fail';
                $result = JSON_encode($result);
                echo $result;
                exit;
            }
        } else {
            $result['status'] = 'Search failed, no user found';
            $result['result'] = 'Fail';
            $result = JSON_encode($result);
            echo $result;
            exit;
        }
    }

    private function getNearUsers($user_id, $latitude, $longitude, $distance, $age) {
        $surQuery = sprintf("SELECT id, chat_account_id, name, email, gender, dob, 
                    head_line_code, interest, favourite_drink, chat_count, event_count, 
                    about_me, message_count, longitude, latitude, altitude, profile_pic, 
                    profile_pic_path, status,"
                . "( 3959 * acos( cos( radians('%s') ) * cos( radians( latitude ) ) *	"
                . "cos( radians( longitude ) - radians('%s') ) + sin( radians('%s') ) * sin( radians( latitude ) ) ) ) "
                . "AS distance FROM job_users", $latitude, $longitude, $latitude);
        $surQuery = "SELECT B.* FROM (" . $surQuery . ") AS B ";
        $surQuery .= sprintf(" WHERE B.id <> '%s' ", $user_id);
        $surQuery .= sprintf(" AND B.distance <= '%s' ", $distance);

        if ($age != -1) {
            $surQuery .= sprintf(" AND YEAR(CURDATE()) - YEAR(B.dob) < %s", $age);
        }
        $userArr = $this->User->query($surQuery);
        $retArr = array();
        if (!empty($userArr)) {
            foreach ($userArr as $row) {
                $retArr[] = $row['B'];
            }
        }
        return $retArr;
    }

    public function delete_event() {
        $user_id = $_POST['user_id'];
        $event_id = $_POST['event_id'];
        $event_count = $this->Event->find('count', array('conditions' => array('Event.id' => $event_id)));
        if ($event_count == 0) {
            $result['result'] = 'Fail';
            $result['status'] = 'Event does not exist.';
            echo JSON_encode($result);
            exit;
        }
        $event = $this->Event->findById($event_id);
        if ($event['Event']['user_id'] == $user_id) {
            // delete event and event picture as well
            $old_path = realpath('../../app/webroot/img/event_pictures/');
            $old_path = $old_path . '/' . basename($event['Event']['event_picture_path']);
            if (file_exists($old_path) && !empty($event['Event']['event_picture_path']))
                unlink($old_path);
            $this->EventUser->deleteAll(array('EventUser.event_id' => $event_id));
            $this->Comment->deleteAll(array('Comment.event_id' => $event_id));
            if ($this->Event->delete($event_id)) {
                $result['status'] = 'Event has been deleted successfully.';
                $result['result'] = 'Success';
                echo JSON_encode($result);
                exit;
            }
            $result['result'] = 'Fail';
            $result['status'] = 'Failed to delete event';
            echo JSON_encode($result);
            exit;
        } else {
            if ($this->EventUser->deleteAll(array('EventUser.event_id' => $event_id, 'EventUser.user_id' => $user_id))) {
                $result['status'] = 'Event has been deleted successfully.';
                $result['result'] = 'Success';
                echo JSON_encode($result);
                exit;
            }
            $result['result'] = 'Fail';
            $result['status'] = 'Failed to delete event';
            echo JSON_encode($result);
            exit;
        }
    }

    public function update_events() {
        if (!empty($_POST['event_id']) && !empty($_POST['user_id'])) {
            $data['Event'] = $_POST;
            $data['Event']['id'] = $_POST['event_id'];
            $count = $this->Event->find('first', array('conditions' => array('Event.id' => $_POST['event_id'])));
            if (!empty($count)) {
                if (!empty($_FILES['file']['name'])) {
                    if (!empty($count['Event']['picture'])) {
                        $old_path = realpath('../../app/webroot/img/event_pictures/');
                        $old_path = $old_path . '/' . basename($count['Event']['picture']);
                        if (file_exists($old_path)) {
                            unlink($old_path);
                        }
                    }
                    $file = $_FILES['file'];
                    $file_name = time() . '' . $_FILES['file']['name'];
                    $path = $file['name'];
                    $ext = pathinfo($path, PATHINFO_EXTENSION);

                    if ($file['name'] != '') {
                        if ($ext == 'jpeg' || $ext == 'jpg' || $ext == 'png') {
                            $target_path = realpath('../../app/webroot/img/event_pictures/');
                            $target_path = $target_path . '/' . basename($file_name);
                            if (move_uploaded_file($_FILES['file']['tmp_name'], $target_path)) {
                                $data['Event']['picture'] = $file_name;
                                $data['Event']['event_picture_path'] = SITE_PATH . 'app/webroot/img/event_pictures/' . $file_name;
                            }
                        }
                    }
                }
                if ($this->Event->save($data, false)) {
                    $result['status'] = 'Event updated successfully.';
                    $result['result'] = 'Success';
                    $i = 0;
                    $event_list = $this->Event->find('all', array('conditions' => array('Event.user_id' => $_POST['user_id'])));
                    foreach ($event_list as $info) {
                        $result['Event'][$i++] = $info['Event'];
                    }
                    $result = JSON_encode($result);
                    echo $result;
                    die;
                } else {
                    $result['result'] = 'Fail';
                    $result['status'] = 'Event is not update. Please try again.';
                    $result = JSON_encode($result);
                    echo $result;
                    die;
                }
            } else {
                $result['status'] = 'Event is not update. Please try again.';
                $result['result'] = 'Fail';
                $result = JSON_encode($result);
                echo $result;
                die;
            }
        }
    }

    public function comment() {
        if (!empty($_POST['user_id']) && !empty($_POST['event_id'])) {
            if ($this->Comment->save($_POST, false)) {
                $result['status'] = 'You have post comment successfully.';
                $result['result'] = 'Success';
                $result = JSON_encode($result);
                echo $result;
                die;
            } else {
                $result['result'] = 'Fail';
                $result['status'] = 'You can not post comment on this event.';
                $result = JSON_encode($result);
                echo $result;
                die;
            }
        }
    }

    public function get_comment() {
        if (!empty($_POST['event_id'])) {
            $comments = $this->Comment->find('all', array(
                'conditions' => array('Comment.event_id' => $_POST['event_id']),
                'order' => array('Comment.created DESC')
            ));
            if (!empty($comments)) {
                $result['status'] = 'All Comments.';
                $result['result'] = 'Success';
                $i = 0;
                foreach ($comments as $info) {
                    $result['Comment'][$i] = $info['Comment'];
                    $result['Comment'][$i]['name'] = $info['User']['name'];
                    $result['Comment'][$i]['profile_pic'] = $info['User']['profile_pic'];
                    $result['Comment'][$i]['profile_pic_path'] = $info['User']['profile_pic_path'];
                    $i++;
                }
                $result = JSON_encode($result);
                echo $result;
                die;
            } else {
                $result['result'] = 'Fail';
                $result['status'] = 'No Comment Found.';
                $result = JSON_encode($result);
                echo $result;
                die;
            }
        }
    }

    public function delete_comment() {
        $comment_id = $_POST['comment_id'];
        if (empty($comment_id)) {
            $result['result'] = 'Fail';
            $result['status'] = 'No Comment Found.';
            echo JSON_encode($result);
            exit;
        }
        if ($this->Comment->delete($comment_id)) {
            $result['result'] = 'Success';
            $result['status'] = 'Comment delete successfully';
            echo JSON_encode($result);
            exit;
        }
        $result['result'] = 'Fail';
        $result['status'] = 'Delete failed';
        echo JSON_encode($result);
        exit;
    }

    public function change_attend() {
        $user_id = $_POST['user_id'];
        $event_id = $_POST['event_id'];
        $user_status = $_POST['user_status'];
        if (empty($user_id) || empty($event_id)) {
            $result['result'] = 'Fail';
            $result['status'] = 'Bad Request';
            echo JSON_encode($result);
            exit;
        }
        $data['EventUser']['user_id'] = $user_id;
        $data['EventUser']['event_id'] = $event_id;
        $data['EventUser']['user_status'] = $user_status;
        $row = $this->EventUser->find('first', array('conditions' => array(
                'EventUser.user_id' => $user_id,
                'EventUser.event_id' => $event_id,
        )));
        $this->EventUser->id = $row['EventUser']['id'];
        if ($this->EventUser->save($data)) {
            $result['result'] = 'Success';
            $result['status'] = 'Updated successfully';
            echo JSON_encode($result);
            exit;
        }
        $result['result'] = 'Fail';
        $result['status'] = 'Failed to change status';
        echo JSON_encode($result);
        exit;
    }

    public function send_notification() {
        $postData = $_POST;
//        $user_id = $_POST['user_id'];
//        $opponent_id = $_POST['opponent_id'];
//        $tag = $_POST['tag'];

        $opponentIds = $postData['opponent_id'];
        $tag = $postData['tag'];
        $body = $postData['body'];

        $resultStatus = "";

        if (isset($opponentIds)) {
            foreach ($opponentIds as $opponentId) {
                $opponent_row = $this->User->find('first', array('conditions' => array('User.id' => $opponentId),
                    'fields' => array('id', 'apns_token', 'status')));
                if (!empty($opponent_row) && $opponent_row['User']['status'] == '2') {
                    $resultStatus = 'The opponent is deactivated by Admin.';
                } else {
                    if (!empty($opponent_row)) {
                        // Send invite with push notification
                        $deviceToken = $opponent_row['User']['apns_token'];

                        $message = array();
                        $message['opponent_id'] = $user_id;
                        $message['tag'] = $tag;
                        if ($tag == 'activity') {
                            $message['body'] = $_POST['activity'];
                        } else {
                            $message['body'] = "new notifiation";
                        }

                        $body['aps'] = array(
                            'alert' => $message,
                            'sound' => 'default'
                        );

                        $payload = json_encode($body);
                        $msg = chr(0) . pack('n', 32) . pack('H*', $deviceToken) . pack('n', strlen($payload)) . $payload;

                        $ctx = stream_context_create();
                        stream_context_set_option($ctx, 'ssl', 'local_cert', dirname(__FILE__) . '/ck.pem');
                        stream_context_set_option($ctx, 'ssl', 'passphrase', 'lopez');

                        $fp = stream_socket_client(
                                'ssl://gateway.sandbox.push.apple.com:2195', $err, $errstr, 60, STREAM_CLIENT_CONNECT | STREAM_CLIENT_PERSISTENT, $ctx);

                        if ($fp) {
                            $resultFlag = fwrite($fp, $msg, strlen($msg));
                            if ($resultFlag) {
                                $result['status'] = 'Success';
                                $result['result'] = 'Success';
                                echo JSON_encode($result);
                                exit;
                            }
                        }

                        $resultStatus = 'Invite failed';
                    } else {
                        $resultStatus = 'User not found on server';
                    }
                }
            }
        } else {
            $resultStatus = 'Failed to send invite to the user';
        }

        $result['status'] = $resultStatus;
        $result['result'] = 'Fail';
        echo JSON_encode($result);
        exit;
    }

}

?>
