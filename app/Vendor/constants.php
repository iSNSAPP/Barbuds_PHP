<?php
	//FOR HTTPS
	 
	$protocol = 'http';
	if(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on')
		$protocol = 'https';

	//FOR WEBSITE CONSTANTS START
	define('PAGING_SIZE','20');
	define('SITE_PATH', 'http://172.16.1.90:81/chatting_app/');
	define('SITEPATH', 'http://172.16.1.90:81/chatting_app/');
	
	
	define('EMAIL_ADMIN_FROM', 'Web Services Admin Panel');
	define('DOCUMENT_ROOT', $_SERVER['DOCUMENT_ROOT'].'/');
	define('EMAIL_SIGNATURE', 'Web Services Admin Panel.');
	
	
	define('ALLOWED_IMAGE_TYPES', serialize(array('image/jpeg', 'image/pjpeg', 'image/png')));
	define('GOOGLE_MAP_API_KEY', 'AIzaSyAwRX-ElDvyL7oiWafWaomBiGg5jlSPbCA');

	//FOR GEOGRAPHIC LOCATIONS START
	define('IP_LOCATION_API_KEY', 'efd67dca864cbe8b45fb21b7d19916bf471afd1bfcfe0b3e975d1f238d6c7ed3');
	//define('IP_ADDRESS', $_SERVER['REMOTE_ADDR']);
	define('IP_ADDRESS', '125.63.73.82');
	//FOR GEOGRAPHIC LOCATIONS END
	
	define('FACEBOOK_APP_ID', '236974896450428');
	define('FACEBOOK_APP_SECRET', '125.63.73.82');
	//FOR CONFIGURING THE SMTP ON LOCAL END
?>