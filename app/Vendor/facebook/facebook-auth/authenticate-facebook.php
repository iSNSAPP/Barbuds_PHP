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
   	$fields=array('network_type_id'=>$uid, 'network_type' =>'facebook');
	$findRow =$db->findCount('compose_networks',$fields);
	 if(!$findRow)
	   {
		$fields=array('userId'=>$_SESSION['sessMemberId'],
				'network_type'=>'facebook',
				'network_type_id'=>$uid,
				'name'=>$name,
				'oauth_token' =>$access_token,
				'oauth_token_secret'=>''
			   );
	   $db->save('compose_networks',$fields);
	   header('Location: ../dashboard.php');
       }
	   else
		{
		 header('Location: ../dashboard.php');
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
 /*$reqParams = array(
            "scope" => 'offline_access, read_stream, friends_likes'
            //'redirect_uri' => $this->FACEBOOK_BASE_URL . 'users/edit_network'
        );
 $login_url = $facebook->getLoginUrl($reqParams);
 */
 $loginUrl = $facebook->getLoginUrl(array(
    'canvas' => 1,
    'fbconnect' => 0,
    'scope' => 'offline_access,publish_stream'
));
 header("Location:".$loginUrl);
}
?>