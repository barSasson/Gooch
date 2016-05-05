<?php
header('Content-Type: text/html; charset=utf-8');
require_once('config.php'); 


$sql_query = "SELECT username_heb,id FROM users";
$query_result = mysql_query($sql_query);
$query_resut_array = array();

if (!$query_result) {
    echo "DB Error, could not process the query\n";
    echo 'MySQL Error: ' . mysql_error();
    exit;
}

while($curr_row_in_query = mysql_fetch_assoc($query_result))
{
	$query_result_array[] = $curr_row_in_query;
}
mysql_close($server_connect_response);

session_start();
if(!isset($_SESSION["loggedin"]))
{
	header("Location: ./index.php");	
}
?>


<!doctype html>
<head  lang="he">
<title>Gooch</title>
<meta http-equiv="Content-Type" content="text/html"  charset="utf-8" />
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="css/bootstrap.min.css">
<link href='https://fonts.googleapis.com/css?family=League+Script' rel='stylesheet' type='text/css'>
<!-- Optional theme -->
<link rel="stylesheet" href="css/bootstrap-theme.min.css">
<link rel="stylesheet" href="css/selectize.default.css">
<link rel="stylesheet" href="css/datepicker.css">
<style>

::-webkit-input-placeholder {
   text-align: center;
}

:-moz-placeholder { /* Firefox 18- */
   text-align: center;  
}

::-moz-placeholder {  /* Firefox 19+ */
   text-align: center;  
}

:-ms-input-placeholder {  
   text-align: center; 
}
#glyphicon-add, #glyphicon-minus {
    font-size: 50px;
}


body
{
    background-color:#ad8258;
    color: #cdcdcd;
  	padding-top: 70px;
      font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;

}

h1
{
    padding: 5px;
}
.jumbotron {
   background-color: #373f39;
    margin-top:20px;
	padding: 10%;
}
.navbar-collapse {
    max-height: 100% !important;
}
.brand-small, .brand-small:checked, .brand-small:visited, .brand-small:link  {
	color: #ededed; font-family: League Script;
	font-size: 35px;
    margin-left: 10px;
    margin-right: 30px;
    text-decoration: none;
}
.brand-small:hover {
	color: #ffffff; font-family: League Script;
	font-size: 35px;
    text-decoration: none;
}

.navbar-header:checked
{
    text-decoration: none;
}

.input-group
{
    width: 96%;
}

.form-control
{
   background-color: inherit;
   margin-left: 7px;
}

.waiter-name-input , #tips-input
{
	width: 200px;
	color: white;
}

.white, .white a {
  color: #fff;
}



input[type=range] {
  -webkit-appearance: none;
  margin: 10px 0;
  width: 100%;
}
input[type=range]:focus {
  outline: none;
}
input[type=range]::-webkit-slider-runnable-track {
  width: 100%;
  height: 12.8px;
  cursor: pointer;
  animate: 0.2s;
  box-shadow: 0px 0px 0px #000000, 0px 0px 0px #0d0d0d;
  background: #576a54	;
  border: 0px solid #000101;
}
input[type=range]::-webkit-slider-thumb {
  border: 0px solid #000000;
  height: 35px;
  width: 39px;
  border-radius: 7px;
   background: #b66d22;
  opacity: 0.8;
  border-color: #ffffff;
  border-width: 2px;
  cursor: pointer;
  -webkit-appearance: none;
  margin-top: -10px;
}
input[type=range]:focus::-webkit-slider-runnable-track {
  background: #576a54;
}
input[type=range]::-moz-range-track {
  width: 100%;
  height: 12.8px;
  cursor: pointer;
  animate: 0.2s;
  box-shadow: 0px 0px 0px #000000, 0px 0px 0px #0d0d0d;
  background: #576a54;
}
input[type=range]::-moz-range-thumb {
  height: 35px;
  width: 39px;
  background: #b66d22;
  opacity: 0.8;
  border-color: #ffffff;
  border-width: 2px;
  cursor: pointer;
}
input[type=range]::-ms-track {
  width: 100%;
  height: 12.8px;
  cursor: pointer;
  animate: 0.2s;
  background: transparent;
  border-color: transparent;
  border-width: 39px 0;
  color: transparent;
}
input[type=range]::-ms-fill-lower {
  background: #a62c1c;
  border: 0px solid #000101;
  border-radius: 50px;
  box-shadow: 0px 0px 0px #000000, 0px 0px 0px #0d0d0d;
}
input[type=range]::-ms-fill-upper {
  background: #a62c1c;
  border: 0px solid #000101;
  box-shadow: 0px 0px 0px #000000, 0px 0px 0px #0d0d0d;
}
input[type=range]::-ms-thumb {
  box-shadow: 0px 0px 0px #000000, 0px 0px 0px #0d0d0d;
  border: 0px solid #000000;
  height: 35px;
  width: 39px;
  border-radius: 7px;
   background: #b66d22;
  opacity: 0.8;
  border-color: #ffffff;
  border-width: 2px;
  cursor: pointer;
  margin-top: 2px;
}
input[type=range]:focus::-ms-fill-lower {
  background: #a62c1c;
}
input[type=range]:focus::-ms-fill-upper {
  background: #a62c1c;
}


.range-value-style {
  text-align: center;
  font-size: 30px;
  display: block;
  width: 100%;
  color: #FFFFFF;
  font-family: monospace;
}

.AddRemoveControlWrapper {
	  border-radius: 25px;
    border: 5px solid #305da6;
    padding: 10px;
	width: 150px;
	margin-top: 20px;
}

.v-hr {
    content: "";
    display: inline-block;
    width: 0px;
    height: 50px;
	border: 2px solid #305da6;
}

.default-input-style {
	min-width:30px;
	color: #d4a449;
	margin-bottom: 9px;
	font-size: x-small;
	background-color: transparent;
    transition: all .5s;
	border-width: 1px;
	border-color: #9c702b;
}

:checked + span { color: #2b8eff;  }
.default-input-style:hover
{
		color: #2b8eff;
}


@media (max-width: 880px) {
    .navbar-header {
        float: none;
    }
    .navbar-toggle {
        display: block;
    }
    .navbar-collapse {
        border-top: 1px solid transparent;
        box-shadow: inset 0 1px 0 rgba(255,255,255,0.1);
    }
    .navbar-collapse.collapse {
        display: none!important;
    }
    .navbar-nav {
        float: none!important;
        margin: 7.5px -15px;
    }
    .navbar-nav>li {
        float: none;
    }
    .navbar-nav>li>a {
        padding-top: 10px;
        padding-bottom: 10px;
    }
    .navbar-text {
        float: none;
        margin: 15px 0;
    }
    /* since 3.1.0 */
    .navbar-collapse.collapse.in { 
        display: block!important;
    }
    .collapsing {
        overflow: hidden!important;
    }
}

</style>

<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
</head>
<body>
<nav class="navbar navbar-full navbar-fixed-top  navbar-inverse bg-faded">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="brand-small" href="#">Gooch</a>
    </div>
    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse">
      <ul class="nav navbar-nav navbar-left">
        <li class="active"><a href="#">Add Shift</a></li>
         <li><a href="#">Latest Shift</a></li>
         <li><a href="#">Edit Shift</a></li>
         <li><a href="#">Show Statistics</a></li>
         <li><a href="#">Chat</a></li>
         <li><a href="#">Edit Profile</a></li>
         <li><a href="./logout.php">Logout</a></li>
         <li>
           <form class="navbar-form" role="search">
            <div class="input-group">
					<input type="text" class="form-control" placeholder="Search">
                    <span class="glyphicon glyphicon-search white form-control-feedback"></span>
            </div>
            </form>
        </li>
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>

<!-- Main jumbotron for a primary marketing message or call to action -->
    <div class="jumbotron">
      <div class="container" style="text-align: center">
        <h1 class="display-3"">Add New Shift</h1>
        <p>
			Here you can add a new shift;
			please first enter the working hours for each waiter in the shift, then enter the total amount of tips.
			You may also change the number of waiters using the plus/minus controls below,
			and also specify a different date from current one by the date picker.
        </p>
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
				<div class="col-md-4" align="center">
					<div class="jumbotron">
						
						<div class="input-group" id="hours-input"></div>
						<div class="btn-group" data-toggle="buttons">
              <label class="btn default-input-style" style="padding: 10px;">
                <div id="glyphicon-add" class="glyphicon glyphicon-plus" style="cursor:pointer" onclick="appendWaiterPicker();"></div>
              </label>
              <label class="btn default-input-style"  style="padding: 10px;">
                <div id="glyphicon-minus" class="glyphicon glyphicon-minus" style="cursor:pointer" onclick="removeLastWaiterPicker()"></div>
              </label>
            </div>
					</div><!-- /.jumbotron -->
				</div><!-- /.col-md-4 -->
				
				<div class="col-md-4" align="center">
					<div class="jumbotron">
						<div class="container">
							<p>Tips</p>
							<input type="number" class="form-control default-input-style" id="tips-input" placeholder="Total Tips">
						</div>
						<div class="container">
							<p>Date</p>
							<div id="datePickerContainer">
								<input id='datePicker' data-provide='datepicker' data-date-container='#datePickerContainer' class="datepicker form-control default-input-style input-md" type="text" style='width:200px; text-align: center; color: #ffffff'>
							</div>
						</div>
						<div class="container">
							<p>Extra Data</p>		
							<div class="btn-group" data-toggle="buttons">
								<label class="btn default-input-style active">
									<input type="radio" name="shift-type" id="morning-shift-input" autocomplete="off"/><span>Morning Shift</span>
								</label>
								<label class="btn default-input-style">
									<input type="radio" name="shift-type" id="evening-shift-input" autocomplete="off"/><span>Evening Shift</span>
								</label>
							</div>
							<div class="btn-group" data-toggle="buttons">
								<label class="btn default-input-style active">
									<input type="radio" name="checker-exists" id="checker-exists-input" checked autocomplete="off"/><span>Checker Enabled</span>
								</label>
								<label class="btn default-input-style">
									<input type="radio" name="checker-exists" id="checker-not-exists-input" autocomplete="off"/><span>Checker Disabled</span>
								</label>
							</div>
						</div>
						<br><br>
						<input type="submit" class="btn default-input-style btn-lg" value="Submit Shift" style="width: 50%;">

					</div><!-- /.jumbotron -->
				</div><!-- /.col-md-4 -->
				
				
					<div class="col-md-4"  align="center">
            <div class="jumbotron">
             <div class="container">
             <p>Latest Shift</p>
             </div>
           </div>
					</div><!-- /.col-md-4 -->

					<div class="col-md-4">
						
					</div><!-- /.col-md-4 -->
				</div><!-- /.row -->
			<hr>

			<footer>
				<p>© Company 2015</p>
			</footer>
		</div><!-- /container -->
	</body>
	</html>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<!-- Latest compiled and minified JavaScript -->
<script src="js/bootstrap.min.js"></script>
<script src="js/moment.js"></script>

<script src="js/selectize.js"></script>
<script src="js/bootstrap-datepicker.js"></script>

<script>
const initialNumOfWaiters = 6;
var numOfWaiters = 0;
var completionOptions = <?php echo json_encode($query_result_array); ?>;
			   
for(var i=0; i<initialNumOfWaiters; i++)
{
	appendWaiterPicker();
}


function appendWaiterPicker() {
	var htmlSelectHoursCode = "<div id='hours-picker-wrapper" + numOfWaiters + "'>";
	htmlSelectHoursCode += "<output class='range-value-style' id='rangevalue"+ numOfWaiters +"'>6</output> <center><small style='position:absolute; margin-left:48px; margin-top:-38px;'>  [Hours]</small><center>";
    htmlSelectHoursCode += "<input type='range' value='6' min='0.25' max='12' step='0.25' style='margin-left: 6px' id='hour-"+ numOfWaiters +"-input'oninput='rangevalue"+ numOfWaiters +".value=value'/><br>";
	htmlSelectHoursCode += "<center>";
	htmlSelectHoursCode += "<select id='waiter-select"+ numOfWaiters +"' class='waiter-name-input'>";
	htmlSelectHoursCode += "<option value=''>Waiter Name</option>";
	
	for(var j =0; j < completionOptions.length; ++j)
	{
		htmlSelectHoursCode += "<option value='" + completionOptions[j].id + "'>" + completionOptions[j].username_heb  + "</option>";
	}
	
	htmlSelectHoursCode += "</select>";
	htmlSelectHoursCode += "<div id='result" + numOfWaiters + "'></div>";
	htmlSelectHoursCode += "</center>";
	htmlSelectHoursCode += "</br>"
	htmlSelectHoursCode += "</div>"
	
	
	$("#hours-input").append(htmlSelectHoursCode);
	$('#waiter-select' + numOfWaiters).selectize({
		maxItems:1,
		create: false,
		sortField: 'text'
		});
	numOfWaiters++;

}

function removeLastWaiterPicker() {
	if (numOfWaiters >= 1) {
			numOfWaiters--;
		var elementToRemove = document.getElementById("hours-picker-wrapper" + numOfWaiters);
		elementToRemove.parentNode.removeChild(elementToRemove);
	}
	
}

$('#datePicker').datepicker({
  container:'#datePickerContainer',
  orientation: "left",
  autoclose: true
  
});
var currentDate = new Date();
var yesterday = new Date(new Date().setDate(new Date().getDate()-1));
if (currentDate.getHours() >= 10){
	 $('#datePicker').datepicker('setDate', currentDate);
	 $("#morning-shift-input").checked = true;
	 document.getElementById("morning-shift-input").checked = true;
}
else {
	$('#datePicker').datepicker('setDate', yesterday);
	document.getElementById("evening-shift-input").checked = true;
}
 
  
</script>

</body>
</html>