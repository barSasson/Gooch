


<?php
session_start();
require_once __DIR__ . '/facebook-sdk-v5/autoload.php';
$fb = new Facebook\Facebook(array('app_id' => '123851931358081','app_secret' => '5a3f6c3d3f10f796de6efbd88783b804','default_graph_version' => 'v2.5'));
$helper = $fb->getJavaScriptHelper();

try {
  $accessToken = $helper->getAccessToken();
  $response = $fb->get('/me');
  $userNode = $response->getGraphUser();
} catch(Facebook\Exceptions\FacebookResponseException $e) {
  // When Graph returns an error
  echo 'Graph returned an error: ' . $e->getMessage();
  exit;
} catch(Facebook\Exceptions\FacebookSDKException $e) {
  // When validation fails or other local issues
  echo 'Facebook SDK returned an error: ' . $e->getMessage();
  exit;
}







if (isset($accessToken)) {
  echo "<script>alert('in facebook login page');</script>";
	$_SESSION["loggedin"] = true;
   $_SESSION['user_id'] = $userNode->getId();
	header("Location: ./addshift.php");
}
else
{
  echo "<script>alert('in facebook login page');</script>";
  
header("Location: ./index.php?login_failed");
}

?>


