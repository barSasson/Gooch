
<?php
session_start();

require_once __DIR__ . '/facebook-sdk-v5/autoload.php';

$fb = new Facebook\Facebook(array('app_id' => '123851931358081','app_secret' => '5a3f6c3d3f10f796de6efbd88783b804','default_graph_version' => 'v2.5'));

$helper = $fb->getRedirectLoginHelper();

$permissions = ['email']; // Optional permissions
$loginUrl = $helper->getLoginUrl('http://localhost/Gooch/fb_callback.php', $permissions);
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Login</title>

<!-- Bootstrap -->
<link href="css/bootstrap.css" rel="stylesheet">
<link href='https://fonts.googleapis.com/css?family=League+Script' rel='stylesheet' type='text/css'>

<style>
body {
    background-color:#996633;
	color:#ffffff;
}

h1 {
		
	margin-top:30px !important;
    margin-bottom: 30px !important;
	color: #4c4c4c; font-family: League Script;
	font-size: 100px;
}

hr {
border-color: #aaaaaa;
}

.login-container {
	margin-top: 25px !important;
	padding: 5px;
	width: auto;
	min-width: 320px;
	max-width: 400px;
	height: inherit;
	background-color:#ebe3d8;
	margin:0 auto;
	border-radius: 10px;
	border: 30px ;
	border-style: solid;
    border-width: 5px;
	border-color: #5d3517;
    text-align: center;
}
.login-inner-container {
	margin:0 auto;
	max-width: 380px;
	width: auto;
}

.username-txt {
		margin-bottom: 3px;
}
.password-txt {
	margin-bottom: 4px;
}

.login-btn
{
	background-color:#18759c;
	margin-bottom: 20px;
	
}

.halfWidth-btn {
	min-width:50px;
	width: 50%;
	color: #0f618b;
	margin-bottom: 9px;
	font-size: x-small;
	background-color: transparent;
    transition: all .5s;
	border-width: 1px;
	border-color: #0f618b;
}



@media (max-width: 320px) {
	.forgot {
		font-size: 9px;
		font-weight: 700;
		padding: 8px;
	}
}

.btn-social{position:relative;padding-left:44px;text-align:center;white-space:nowrap;overflow:hidden;text-overflow:ellipsis; margin-bottom: 10px;}.btn-social>:first-child{position:absolute;left:0;top:0;bottom:0;width:32px;line-height:34px;font-size:1.6em;text-align:center;border-right:1px solid #0f618b}
.btn-facebook{color:#0f618b;background-color:transparent;border-color: #0f618b;font-size:small; height:35px; width: 300px; padding: 8px; }.btn-facebook:focus,.btn-facebook.focus{color:#fff;background-color:#0f618b;border-color:#0f618b}

</style>

</head>
<body>
<div class="container">

	<div class="login-container">
		<h1>Gooch</h1>
		<form class="login-inner-container" action="login.php" method="post">
			<input type="text" class="form-control input-lg username-txt" name="username-input" placeholder="User Name">
			<input type="password" class="form-control input-lg password-txt" name="password-input" placeholder="Password">
			<input class="btn btn-lg btn-block login-btn" style="font-size: medium;" type="submit" value="Login">
		</form>
								

				
										
<?php

if(isset($_SESSION["loggedin"]))
{
	header("Location: ./addshift.php");	
}
else if (isset($_GET["login_failed"]))
{
echo "<div class='alert alert-danger'>";
echo "<strong>Login Failed!</strong> The user name or password is incorrect";
echo "</div>";
}

?>
		<ul style="list-style: none; padding-left:0;">
			<li>
				<a href=<?php echo htmlspecialchars($loginUrl) ;?>>
				<button class="btn  btn-facebook   btn-social "><img  style="padding-right: 0px; width:34px; height:32.5px;" src="imgs/fbicon.png">Login With Facebook
				</button>
				<a/>
			</li>
			<li><a href="#" class="btn btn-md  halfWidth-btn">Register</a></li>
			<li><a href="#" class="btn btn-md  halfWidth-btn">Forgot your password?</a> </li>
		</ul>
				
	</div>
</div>
</body>
<script>
  
  
   window.fbAsyncInit = function() {
    FB.init({
      appId      : '123851931358081',
      xfbml      : true,
      cookie : true, 
      version    : 'v2.6'

    });

    FB.getLoginStatus(function(response) {
    statusChangeCallback(response);
  	});

  
  };


  (function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.6&appId=123851931358081";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));

// This is called with the results from from FB.getLoginStatus().
  function statusChangeCallback(response) {

    console.log(response);
    // The response object is returned with a status field that lets the
    // app know the current login status of the person.
    // Full docs on the response object can be found in the documentation
    // for FB.getLoginStatus().
    if (response.status === 'connected') {
    //window.location.assign("./facebooklogin.php");

      // Logged into your app and Facebook.
    } else if (response.status === 'not_authorized') {
      // The person is logged into Facebook, but not your app.

    } else {
      // The person is not logged into Facebook, so we're not sure if
      // they are logged into this app or not.

    }
  }

</script>

<div id="fb-root"></div>



</html>
