<?php
if(!function_exists('apache_get_modules')){
	echo 'Mod Not Installed!'; die;
}

$result = 'OFF';
if(in_array('mod_rewrite', apache_get_modules()))
	$result = 'ON';

echo 'mod_rewrite = '.$result;
?>