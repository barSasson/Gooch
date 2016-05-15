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

if(isset($_SESSION['fb_access_token']))
{
  require_once __DIR__ . '/facebook-sdk-v5/autoload.php';

  $fb = new Facebook\Facebook(array('app_id' => '123851931358081','app_secret' => '5a3f6c3d3f10f796de6efbd88783b804','default_graph_version' => 'v2.5'));

  $response = $fb->get('/me?fields=id,picture', $_SESSION['fb_access_token']);
  $user = $response->getGraphUser();
  $picUrl = $user->getPicture()['url'];
}
else
{
  $picUrl = 'http://lingvoteka.com/Media/Default/Avatar/noavatar.jpg';
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

.jumbotron p {
  margin-bottom: 15px;
  font-size: 20px;
  font-weight:100;

}

.jumbotron h1 {
  margin-bottom: 15px;
  font-weight:101;
}
body
{
    background-color:#ad8258;
    color: #cdcdcd;
  	padding-top: 70px;
}

h1
{
    padding: 5px;
}

.header-h1
{
	 font-weight:100;
	 font-size:45px;"
}

.jumbotron {
   background-color: #373f39;
    margin-top:20px;
	padding: 10%;
}
.navbar-collapse {
	font-family: "HelveticaNeue-Light", "Helvetica Neue Light", "Helvetica Neue", Helvetica, Arial, "Lucida Grande", sans-serif; 
   font-weight: 300;
    max-height: 100% !important;
}
.brand-small, .brand-small:checked, .brand-small:visited, .brand-small:link  {
	color: #ededed; font-family: League Script;
	font-size: 35px;
  margin-left: 10px;
  margin-right: 40px;
  padding: 30px;
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
  border: 0px solid #000101;
  
  background:  #be7622;
}
input[type=range]::-webkit-slider-thumb {
  border: 0px solid #000000;
  height: 35px;
  width: 39px;
  opacity: 0.8;
  cursor: pointer;
  -webkit-appearance: none;
  margin-top: -10px;
   
  border-radius: 7px;
  
   border-color: #ffffff;
   background: #2b8eff;
   border-width: 2px;

}
input[type=range]:focus::-webkit-slider-runnable-track {
    background:  #be7622;;

}
input[type=range]::-moz-range-track {
  width: 100%;
  height: 12.8px;
  cursor: pointer;
  animate: 0.2s;
  box-shadow: 0px 0px 0px #000000, 0px 0px 0px #0d0d0d;
  
  background: #be7622;;
}
input[type=range]::-moz-range-thumb {
  height: 35px;
  width: 39px;
  opacity: 0.8;
  cursor: pointer;
  
  border-color: #ffffff;
  background: #2b8eff;
  border-width: 2px;
}
input[type=range]::-ms-track {
  width: 100%;
  height: 12.8px;
  cursor: pointer;
  animate: 0.2s;
  border-width: 39px 0;
  
  background: transparent;
  border-color: transparent;
  color: transparent;
}
input[type=range]::-ms-fill-lower {
  border: 0px solid #000101;
  box-shadow: 0px 0px 0px #000000, 0px 0px 0px #0d0d0d;

  border-radius: 50px;
  background:  #be7622;;
  
}
input[type=range]::-ms-fill-upper {
  border: 0px solid #000101;
  box-shadow: 0px 0px 0px #000000, 0px 0px 0px #0d0d0d;
  
  background:  #be7622;
}
input[type=range]::-ms-thumb {
  box-shadow: 0px 0px 0px #000000, 0px 0px 0px #0d0d0d;
  border: 0px solid #000000;
  height: 35px;
  width: 39px;
  cursor: pointer;
  margin-top: 2px;
  
  border-radius: 7px;
  opacity: 0.8;
  
  border-color: #ffffff;
  background: #2b8eff;
  border-width: 2px;
}
input[type=range]:focus::-ms-fill-lower {
  background: #be7622;
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

.add-remove-control {
	padding-top: 20px;
}
.add-remove-control .default-input-style:hover {
	color: 	#9c702b;
	overflow: visible !important;

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


@media (max-width: 1081px) {
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
 .btn-group>.btn
    {
        white-space: nowrap;
        overflow: hidden;
    }
.hours-picker-wrapper
{
  transition: all 0.9s;
  opacity: 0; 

}


@media screen and (max-width: 1081px)  {
    .navbar-header
    {
       padding-left: 70px;
       text-align: center;
    }
}

input[readonly]
{
      background-color: transparent!important;
}

</style>


<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
</head>
<body>
<nav class="navbar navbar-full navbar-fixed-top  navbar-inverse bg-faded">
  <div class="container-fluid"   style="
    margin-top: 2px;">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header" style="
    margin-top: 2px; overflow: hidden;">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="brand-small" id="brand-text">Gooch</a>
    </div>
    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav navbar-center" >
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


<!-- Main jumbotron for a primary marketing message or call to action -->
    <div class="jumbotron">
      <div class="container" style="text-align: center">
        <h1 class="header-h1">Add New Shift</h1>
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
				<div class="col-lg-4" align="center">
					<div class="jumbotron">
						
						<div class="input-group" id="hours-input"></div>
						<div class="btn-group add-remove-control" data-toggle="buttons" id="addRemoveControl">
              <label class="btn default-input-style" style="padding: 10px;">
                <div id="glyphicon-add" class="glyphicon glyphicon-plus" style="cursor:pointer" onclick="appendWaiterPicker();"></div>
              </label>
              <label class="btn default-input-style"  style="padding: 10px;">
                <div id="glyphicon-minus" class="glyphicon glyphicon-minus" style="cursor:pointer" onclick="removeLastWaiterPicker()"></div>
              </label>
            </div>
					</div><!-- /.jumbotron -->
				</div><!-- /.col-lg-4 -->
				
				<div class="col-lg-4" align="center">
					<div class="jumbotron">
						<div class="container">
							<p>Tips</p>
							<input type="number" class="form-control default-input-style" id="tips-input" placeholder="<< Total Tips >>" style="text-align:center;">
						</div>
						<div class="container">
							<p>Date</p>
							<div id="datePickerContainer" >
								<input id='datePicker' data-provide='datepicker' readonly='readonly' data-date-container='#datePickerContainer' class="datepicker form-control default-input-style input-md" type="text" style='width:200px; text-align: center; color: #ffffff'>
							</div>
						</div>
						<div class="container">
							<p>Extra Data</p>		
							<div class="btn-group" data-toggle="buttons">
								<label class="btn default-input-style active  col-xs-6">
									<input type="radio" name="shift-type" id="morning-shift-input" autocomplete="off"/><span>Morning Shift</span>
								</label>
								<label class="btn default-input-style  col-xs-6">
									<input type="radio" name="shift-type" id="evening-shift-input" autocomplete="off"/><span>Evening Shift</span>
								</label>
							</div>
							<div class="btn-group" data-toggle="buttons">
								<label class="btn default-input-style active col-xs-6">
									<input type="radio" name="checker-exists" id="checker-exists-input" checked autocomplete="off"/><span>Checker Enabled</span>
								</label>
								<label class="btn default-input-style col-xs-6">
									<input type="radio" name="checker-exists" id="checker-not-exists-input" autocomplete="off"/><span>Checker Disabled</span>
								</label>
							</div>
						</div>
						<br><br>
						<input type="submit" class="btn default-input-style btn-lg" value="Submit Shift" style="width: 50%;">

					</div><!-- /.jumbotron -->
				</div><!-- /.col-lg-4 -->
				
				
					<div class="col-lg-4"  align="center">
            <div class="jumbotron">
             <div class="container">
             <p>Latest Shift</p>
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
<!-- Latest compiled and minified JavaScript -->
<script src="js/bootstrap.min.js"></script>
<script src="js/moment.js"></script>
<script src="js/TouchGestures.js" type="text/javascript" charset="utf-8"></script>
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
	var htmlSelectHoursCode = "<div class='hours-picker-wrapper' id='hours-picker-wrapper" + numOfWaiters + "'>";
	htmlSelectHoursCode += "<output class='range-value-style' id='rangevalue"+ numOfWaiters +"'>6</output> <center><small style='position:absolute; margin-left:48px; margin-top:-38px;'>  [Hours]</small><center>";
    htmlSelectHoursCode += "<input type='range' value='6' min='0.25' max='12' step='0.25' style='margin-left: 6px' id='hour-"+ numOfWaiters +"-input' oninput='updateHourOutput("+ numOfWaiters +",this.value) '/><br>";
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


    var newElement = document.getElementById("hours-picker-wrapper" + numOfWaiters);
    newElement.style.opacity = 1;

    

	numOfWaiters++;

}

function updateHourOutput(outputid, newValue)
{
	document.getElementById("rangevalue"+outputid).innerHTML = newValue;
}
function removeLastWaiterPicker() {
	if (numOfWaiters >= 1) {
			numOfWaiters--;
		var elementToRemove = document.getElementById("hours-picker-wrapper" + numOfWaiters);
		
    elementToRemove.style.opacity = 0;
		
    setTimeout(function(){elementToRemove.parentNode.removeChild(elementToRemove);}, 570)
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


document.getElementById("brand-text").addEventListener('doubleTap', touched);
function touched()
{
		alert('d');

	preventDefault();
}


function getData()
{
	var waiterHoursArray = [];
	for (var i=0; i < numOfWaiters; i++){
		var selectElement = document.getElementById("waiter-select"+ i);
		var rangeValue = document.getElementById("hour-" + i + "-input").value;
		var selectedIndex = selectElement.selectedIndex;
			waiterHoursArray[i] = {
				Id: selectElement[selectedIndex].value,
				Name:selectElement[selectedIndex].text,
				Hours: rangeValue
			};
		}
	
	return waiterHoursArray;	
}



 // i_WaitersHoursArray expecting {Id: ,Name: ,Hours: }
    function ShiftData(i_TotalTipsAmount, i_WaitersHoursArray, i_isCheckerExists)
    {
        const k_TaxReductionPerHour = 6;
        const k_CheckersAllowance = 20;
        this.m_TotalTipsAmount = i_TotalTipsAmount;
        this.m_WaitersHoursArray = i_WaitersHoursArray;
        this.m_isCheckerExists = i_isCheckerExists;
        this.m_TipsToIgnore;
        this.m_TotalHours = 0;
        this.m_TipsAfterTax;
        this.m_TotalAllowance = 0;
        this.m_MoneyPerHour = 0;

        
        //abstract
        this.sumHours = function(i_WaitersHoursArray)
        {
            this.m_TotalHours = 0;
            for (var i = i_WaitersHoursArray.length - 1; i >= 0; i--) {
                 this.m_TotalHours += parseFloat(i_WaitersHoursArray[i].Hours);
            }
        }
		
		this.CalculateTips = function()
        {
            this.sumHours(this.m_WaitersHoursArray);
			this.m_TipsToIgnore = this.TipsToIgnore(this.m_TotalTipsAmount);
			this.m_TotalTipsAmount -= this.m_TipsToIgnore;
            this.m_TaxReduction = Math.ceil(k_TaxReductionPerHour * this.m_TotalHours);
            this.m_TipsAfterTax = this.m_TotalTipsAmount - this.m_TaxReduction;
            this.m_TotalAllowance = this.GetTotalAllowance(this.m_TipsAfterTax);
		    var barAllowance = Math.ceil(this.m_TotalAllowance * 0.25)
            var kitchenAllowance = this.m_TotalAllowance - barAllowance;
            var kitchenAllowanceAfterCheckersReduction = kitchenAllowance - k_CheckersAllowance;
            var tipsAfterAllReduction = this.m_TipsAfterTax - this.m_TotalAllowance;
			
            if(this.m_isCheckerExists == false)
            {
                 tipsAfterAllReduction += k_CheckersAllowance;
            }

            this.m_MoneyPerHour = (tipsAfterAllReduction / this.m_TotalHours).toFixed(2);

            var shiftWaiterData = this.DevideTipsAndGetResultArray(this.m_WaitersHoursArray, this.m_MoneyPerHour);

            this.addTips(shiftWaiterData);
            this.devideRemainder(shiftWaiterData);

            return shiftWaiterData;
        }

        this.addTips = function(i_ShiftWaiterData) {
            var perHourToAdd = this.m_TipsToIgnore / this.m_TotalHours;
            for (var i = 0; i < i_ShiftWaiterData.length; i++) {
                i_ShiftWaiterData[i].EarnedInShift += i_ShiftWaiterData[i].Hours * perHourToAdd;
            }
        }
    }
	
	ShiftData.prototype.TipsToIgnore = function(i_TotalTipsAmount)
	{
		return i_TotalTipsAmount * 0.2;
	}

	ShiftData.prototype.GetTotalAllowance = function(i_TipsAfterTax)
	{
		return Math.floor(i_TipsAfterTax * 0.12);
	}

	ShiftData.prototype.DevideTipsAndGetResultArray = function(i_WaitersHoursArray, i_MoneyPerHour)
	{
		var shiftWaitersData = [];
		for (var i = 0; i < i_WaitersHoursArray.length; i++) {
		shiftWaitersData[i] = {
			Id: i_WaitersHoursArray[i].Id,
			Name: i_WaitersHoursArray[i].Name,
			Hours: i_WaitersHoursArray[i].Hours,
			EarnedInShift: parseFloat(i_WaitersHoursArray[i].Hours * i_MoneyPerHour)
		};
	  }  

	   return shiftWaitersData;
	}

	ShiftData.prototype.devideRemainder = function (i_ShiftWaiterData) {
		var remainder = 0;
		for (var i = 0; i < i_ShiftWaiterData.length; i++) {
			remainder += i_ShiftWaiterData[i].EarnedInShift % 1;
			i_ShiftWaiterData[i].EarnedInShift = Math.floor(i_ShiftWaiterData[i].EarnedInShift);
		}

		remainder = Math.floor(remainder);
		for (var i = 0; i < remainder; i++) {
			var waiterIndexToAdd = i % i_ShiftWaiterData.length;
			i_ShiftWaiterData[waiterIndexToAdd].EarnedInShift++;
		}
	}
	

</script>

</body>
</html>