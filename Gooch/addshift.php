<?php
header('Content-Type: text/html; charset=utf-8');
session_start();

require_once('config.php'); 


$sql_query = "SELECT username_heb,id FROM users";
$query_result = $mysqli->query($sql_query);
$query_resut_array = array();

if (!$query_result) {
    echo "DB Error, could not process the query\n";
    echo 'MySQL Error: ' . mysql_error();
    exit;
}

while($curr_row_in_query = $query_result->fetch_assoc())
{
	$query_result_array[] = $curr_row_in_query;
}
mysqli_close($mysqli);

if(!isset($_SESSION["loggedin"]))
{
	header("Location: ./index.php");	
}

if(isset($_SESSION['fb_access_token']))
{
	try
	{
		require_once __DIR__ . '/facebook-sdk-v5/autoload.php';

		$fb = new Facebook\Facebook(array('app_id' => '123851931358081','app_secret' => '5a3f6c3d3f10f796de6efbd88783b804','default_graph_version' => 'v2.5'));
	  
		$response = $fb->get('/me?fields=id,picture', $_SESSION['fb_access_token']);
		$user = $response->getGraphUser();
		$picUrl = $user->getPicture()['url'];
	}
	catch(Exception $e)
	{
			header("Location: ./logout.php");	
	}
}
else
{
  $picUrl = 'imgs/noavatar.jpg';
}

?>

<!doctype html>
<head  lang="he">
<title>Gooch</title>
<meta http-equiv="Content-Type" content="text/html"  charset="utf-8" />
<link rel="stylesheet" href="css/bootstrap.min.css">
<link href='https://fonts.googleapis.com/css?family=League+Script' rel='stylesheet' type='text/css'>
<link rel="stylesheet" href="css/bootstrap-theme.min.css">
<link rel="stylesheet" href="css/selectize.default.css">
<link rel="stylesheet" href="css/datepicker.css">
<link rel="stylesheet" href="css/gooch.css">

<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
</head>
<body>
<nav class="navbar navbar-full navbar-fixed-top  navbar-inverse bg-faded">
  <div class="container-fluid"  style="margin-top: 2px;">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header" style="
    margin-top: 2px; overflow: hidden;">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="brand-small noselect" id="brand-text">Gooch</a>
    </div>
    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse " id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav navbar-center  scrollable-menu" >
        <li class="active"><a href="#">Add Shift</a></li>
         <li><a href="#">Latest Shift</a></li>
         <li><a href="#">Edit Shift</a></li>
         <li><a href="#">Show Statistics</a></li>
         <li><a href="#">Chat</a></li>
         <li><a href="#">Edit Profile</a></li>
         <li><a href="./logout.php">Logout</a></li>
         <li><a href="#"><?php echo "<img style='margin-right:10px;' height='27' width='27' src='" .$picUrl. "'>"; ?><small>Hi, <?php echo $_SESSION['name']; ?></small></a></li>
         <li>
           <form class="navbar-form" role="search">
            <div class="input-group">
					<input type="text" class="form-control" placeholder="Search">
                    <span class="glyphicon glyphicon-search white form-control-feedback" ></span>
            </div>
            </form>
        </li>
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>


    <div class="jumbotron">
      <div class="container" style="text-align: center">
        <h1 class="header-h1">Add New Shift</h1>
        <p>
			Here you can add a new shift.
			please first enter the working hours for each waiter, then enter the total amount of tips.        </p>
			<a href="#" class="btn btn-lg  default-input-style">Edit Shift</a>
			<a href="#" class="btn btn-lg default-input-style">Latest Shifts</a>

      </div><!-- .contaner -->
    </div><!-- /.jumbotron -->

	<html>
	<head>
		<title></title>
	</head>

	<body>
		<div class="container">
			<!-- Example row of columns -->

			<div class="row">
				<div class="col-lg-4" align="center">
					<div class="jumbotron">
						 <h1 class="header-h1">Hours</h1>
						<div class="input-group" id="hours-input"></div>
						<div class="btn-group add-remove-control" data-toggle="buttons" id="addRemoveControl">
              <label class="btn default-input-style" style="padding: 10px;">
                <div id="glyphicon-add" class="glyphicon glyphicon-plus" onclick="appendWaiterPicker();"></div>
              </label>
              <label class="btn default-input-style"  style="padding: 10px;">
                <div id="glyphicon-minus" class="glyphicon glyphicon-minus" onclick="removeLastWaiterPicker()"></div>
              </label>
            </div>
					</div><!-- /.jumbotron -->
				</div><!-- /.col-lg-4 -->
				
				<div class="col-lg-4" align="center">
					<div class="jumbotron">
						
						<div class="container">
							<p>Date</p>
							<div id="datePickerContainer">
								<input id='datePicker' data-provide='datepicker' readonly='readonly'  data-date-container='#datePickerContainer' class="datepicker form-control default-input-style input-md number-input" type="text" style='color: #ffffff'>
							</div>
						</div>
						<div class="container">
							<p>Extra Data</p>		
							<div class="btn-group" data-toggle="buttons">
								<label class="btn default-input-style active  col-xs-6">
									<input type="radio" name="shift-type"  value='morning' id="morning-shift-input" autocomplete="off"/><span>Morning Shift</span>
								</label>
								<label class="btn default-input-style  col-xs-6">
									<input type="radio" name="shift-type"  value ='evening' id="evening-shift-input" autocomplete="off"/><span>Evening Shift</span>
								</label>
							</div>
							<div class="btn-group" data-toggle="buttons">
								<label class="btn default-input-style active col-xs-6">
									<input type="radio" name="checker-exists"  value='on' checked autocomplete="off"/><span>Checker Enabled</span>
								</label>
								<label class="btn default-input-style col-xs-6">
									<input type="radio" name="checker-exists" value ='off' autocomplete="off"/><span>Checker Disabled</span>
								</label>
							</div>
						</div>
						<div class="container">
							<p>Tips:</p>
							<input type="number" class="form-control default-input-style" id="tips-input" min="0">
						</div>
						<div class="extended">
							<div class="container">
								<p>Total Allowance:</p>
								<input type="number" class="form-control default-input-style number-input" min="0" step="0.01" id="total-allowance" style="text-align:center;">
							</div>
							<div class="container">
								<p>Percent to Exclude:</p>
								<input type="number" class="form-control default-input-style number-input" min="0" step="0.01" id="tips-percent">
							</div>
							<div class="container">
								<p>Tips per Hour: <small id='tips-per-hour'>[Not Available]</small></p>
							</div>
							<div class="container">
								<p>Tips per Hour Real: <small id='tips-per-hour-real'>[Not Available]</small></p>
							</div>
						</div>
						<a href="#waiters-data" class="btn default-input-style btn-lg" id="submit-button" style="width: 50%; margin-top: 50px;" >Submit Shift</a>

					</div><!-- /.jumbotron -->
				</div><!-- /.col-lg-4 -->
					<div class="col-lg-4"  align="center">
			            <div class="jumbotron">
				             <div class="container">
					             <h3 class="header-h1">Waiters Data</h3>
								 <div id='waiters-data'></div>
				             </div>
			            </div>
					</div><!-- /.col-lg-4 -->
					<div class="col-lg-4">
					</div><!-- /.col-lg-4 -->
				</div><!-- /.row -->
			<hr>

			<footer>
				<p>© Bar Sasson 2016</p>
			</footer>
		</div><!-- /container -->
	</body>
	</html>
	
	
<script src="js/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/moment.js"></script>
<script src="js/TouchGestures.js" type="text/javascript" charset="utf-8"></script>
<script src="js/selectize.js"></script>
<script src="js/bootstrap-datepicker.js"></script>

<script>
var completionOptions = <?php echo json_encode($query_result_array); ?>;
</script>
<script src="js/gooch.js"></script>

</body>
</html>





