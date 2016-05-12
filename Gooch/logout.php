<?php
session_start();
require_once __DIR__ . '/facebook-sdk-v5/autoload.php';


if(isset($_SESSION['facebook_access_token']))
{
	try 
	{
		$fb = new Facebook\Facebook(array('app_id' => '123851931358081','app_secret' => '5a3f6c3d3f10f796de6efbd88783b804','default_graph_version' => 'v2.5'));
		$helper = $fb->getRedirectLoginHelper();
		$accessToken = $helper->getAccessToken();
		$logoutUrl = 'https://www.facebook.com/logout.php?next=http://localhost/Gooch/logout-redirect.php&access_token='.$_SESSION['facebook_access_token'] ;
		header("Location: ".$logoutUrl);	

	}
	catch(\Exception $ex) 
	{
		header("Location: ./logout-redirect.php");	
	}
}
else
{
	header("Location: ./logout-redirect.php");	
}


?>