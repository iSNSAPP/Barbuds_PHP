<?php
session_start();
include('../include/include.php');
require("facebook.php");
require("facebook_key.php");
$facebook = new Facebook(array(
	'appId'  => $appId,
	'secret' => $secret,
	'cookie' => true
));
$user = $facebook->getUser();
if ($user) 
{
  try 
 {
    $user_profile = $facebook->api('/me');
	$access_token =$facebook->getAccessToken();
	$uid  = $user_profile['id'];
	$name = $user_profile['name'];
	$firstName =$user_profile['first_name'];
	$lastName	=$user_profile['last_name'];
	$fields=array('facebook_id'=>$uid, 'used_site' =>'Facebook');
	$findRow =$db->findCount('compose_register',$fields);
	if(!$findRow)
	   {
		$fields=array('reg_first_name' =>$firstName,
						'reg_last_name' =>$lastName,
						'reg_created'=>date('y-m-d H:i:s'),
						'first_login'=>date('Y-m-d H:i:s'),
						'facebook_id'=>$uid,
						'is_email_verified'=>'1',
						'used_site' =>'Facebook',
						'reg_status'	=>'1'
					   );
	   $db->save('compose_register',$fields);
	   $user_insert_id =$db->lastId();
	   $_SESSION['sessMemberId']	 = $user_insert_id;
	   $_SESSION['sessMemberfName']	 = $firstName;
	   $_SESSION['sessMemberlName']	 = $lastName;
	   $_SESSION['usedSite']		 = 'Facebook';
	   		
	   $fields=array('userId'=>$user_insert_id,
				'network_type'=>'facebook',
				'network_type_id'=>$uid,
				'name'=>$name,
				'oauth_token' =>$access_token,
				'oauth_token_secret'=>''
			   );
	   $db->save('compose_networks',$fields);
	   header("Location:../edit_profile.php");
       }
	   else
		{
		  $checkUser = $db->find('compose_register',$fields);
		  $_SESSION['sessMemberId']		= $checkUser['reg_id'];
		  $_SESSION['sessMemberfName']	= $checkUser['reg_first_name'];
		  $_SESSION['sessMemberlName']	= $checkUser['reg_last_name'];
		  $_SESSION['sessuserName']		= $checkUser['username'];
		  $_SESSION['sessMemberEmail']	= $checkUser['reg_email'];
		  $_SESSION['usedSite']		    = $checkUser['used_site'];

		  $fields=array('last_login'=>date('Y-m-d H:i:s'));
		  $update_last_login=$db->update('compose_register', array('reg_id'=>$checkUser['reg_id']) ,$fields);

		  $conditions=array('user_id'=>$_SESSION['sessMemberId']);
	      $checkUserBackInformation = $db->find('compose_user_back_information', $conditions);

		  if($checkUserBackInformation['dob'] !="" && $checkUserBackInformation['dob'] !="0000-00-00" && $_SESSION['sessMemberfName'] !="" && $_SESSION['sessMemberlName'] !="")
				{
					header("Location:../dashboard.php");
				}
				else
				{
					header("Location:../edit_profile.php");
				}
		}
 } 
 catch (FacebookApiException $e) 
  {
    error_log($e);
    $user = null;
  }
}
else
{
 $loginUrl = $facebook->getLoginUrl(array(
    'canvas' => 1,
    'fbconnect' => 0,
    'scope' => 'offline_access,publish_stream'
));
 header("Location:".$loginUrl);
}
?>