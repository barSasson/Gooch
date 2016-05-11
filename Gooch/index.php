

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
</style>
</head>
<body>
<div class="container">
	<div class="login-container">
		<h1>Gooch</h1>
        		<form class="login-inner-container" action="login.php" method="post">
    				<input type="text" class="form-control input-lg username-txt" name="username-input" placeholder="User Name">
    				<input type="password" class="form-control input-lg password-txt" name="password-input" placeholder="Password">
					<input class="btn btn-lg btn-block login-btn" type="submit" value="Login">
				</form>
									<button class="btn btn-md  halfWidth-btn"><div class="fb-login-button"   tag= "facebook-jssdk" style=" margin-right: 10px;" data-max-rows="2" data-size="icon" data-show-faces="false" data-auto-logout-link="true"  scope="public_profile,email"> </div>Facebook Login</button><div id="status">sdsd</div>

				
										
<?php

session_start();
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
					

			<a href="#" class="btn btn-md  halfWidth-btn">Register</a>
			<a href="#" class="btn btn-md  halfWidth-btn">Forgot your password?</a>
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
    window.location.assign("./facebooklogin.php");

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
