<?php
session_start();
# We require the library
include('../include/include.php');
require("facebook.php");
require("facebook_key.php");
# Creating the facebook object
$facebook = new Facebook(array(
	'appId'  => $appId,
	'secret' => $secret,
	'cookie' => true
));
# Let's see if we have an active session
$facebook_session = $facebook->getSession();
echo $facebook->getAccessToken();

/*
if(!empty($facebook_session)) 
   {
	try
	{
	 $uid = $facebook_session['uid'];
   	 $fields=array('network_type_id'=>$uid, 'network_type' =>'facebook');
	 $findRow =$db->findCount('compose_networks',$fields);
	 if(!$findRow)
	   {
		$fields=array('userId'=>$_SESSION['sessMemberId'],
				'network_type'=>'facebook',
				'network_type_id'=>$uid,
				'name'=>'',
				'oauth_token' =>$facebook_session['access_token'],
				'oauth_token_secret'=>''
			   );
	   $db->save('compose_networks',$fields);
	   unset($_SESSION['access_token']);
	   header('Location: ../dashboard.php');
       }
	   else
		{
		 header('Location: ../dashboard.php');
		}
	} 
	catch (Exception $e){print_r($e);}
} 

else 
{
	# There's no active session, let's generate one
	define('SITE_URL', 'http://'.$_SERVER['HTTP_HOST'].'/lab/compose');
	$login_url = $facebook->getLoginUrl(SITE_URL.'/facebook/facebookAuth.php');
	header("Location:".$login_url);
}
*/
?>