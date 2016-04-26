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
	color:#ffffff
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
<style>


</style>
<div class="container">
	<div class="login-container">
		<h1>Gooch</h1>
        		<form class="login-inner-container" action="connect0.php" method="post">
    				<input type="text" class="form-control input-lg username-txt" name="username-input" placeholder="Enter User Name">
    				<input type="password" class="form-control input-lg password-txt" name="password-input" placeholder="Password">
					<input class="btn btn-lg btn-block login-btn" type="submit" value="Login">
				</form>
				
										
<?php
if (isset($_GET["login_failed"]))
{
echo "<div class='alert alert-danger'>";
echo "<strong>Login Failed!</strong> The user name or password is incorrect";
}

?>
					
</div>
			<a href="#" class="btn btn-md  halfWidth-btn">Register</a>
			<a href="#" class="btn btn-md  halfWidth-btn">Forgot your password?</a>
	</div>
</div>
</body>
</html>
