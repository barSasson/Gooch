<?php
session_start();


 if (isset($_SESSION["id"]) && $_SESSION["id"]==5) {
header("Location: ./calc.php");
}


?>
	
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<meta http-equiv="content-type" type="text/html;charset=utf-8" />
  <link rel="stylesheet" href="css/flickity.css" media="screen">
       <script src="css/flickity.pkgd.min.js"></script>
       <script>
       
       docReady      ( 
       function() {
  var flkty2 = new Flickity('.gallery',{pageDots:false});
                  }
                    );

       
var position_top=20;
var position_left=50;
var gallery_num=0;
function add_gallery (){
if(gallery_num>=14)
{
alert("Too Many Waiters");
} 
else
{
var wrapper = document.createElement("div");
wrapper.style.position="absolute"
wrapper.style.left=position_left.toString() + "px";
wrapper.style.top=position_top.toString()+"px";
wrapper.innerHTML = "<div class='gallery" + gallery_num.toString() + "' style=' width:200px;height:52px;position:absolute;background-color: rgba(135, 206, 250, 0.5);border-radius: 15px;border-style: solid;border-width: 1px;' ><div class='gallery-cell'>אופיר</div>  <div class='gallery-cell'>אריאל</div><div class='gallery-cell'>בר</div> <div class='gallery-cell'>גלית</div><div class='gallery-cell'>גף</div><div class='gallery-cell'>הראל</div><div class='gallery-cell'>חי</div><div class='gallery-cell'>טל</div><div class='gallery-cell'>טלי</div><div class='gallery-cell'>יעל</div><div class='gallery-cell'>לבנת</div><div class='gallery-cell'>ליה</div><div class='gallery-cell'>מור</div><div class='gallery-cell'>נועם</div><div class='gallery-cell'>עדן</div><div class='gallery-cell'>עופר</div><div class='gallery-cell'>עלמה</div><div class='gallery-cell'>פנחס</div><div class='gallery-cell'>קטיה</div><div class='gallery-cell'>רועי</div></div>";

document.getElementsByClassName("main")[0].appendChild(wrapper);
 var flkty2 = new Flickity('.gallery' + gallery_num.toString(),{pageDots:false});
 gallery_num+=1;
 position_top+=70;
 if (position_top>500)
 {
 position_top=20;
 position_left+=250;
 }
}
}

</script>
       
<title>-Gooch-</title>
<head>
	<link rel="shortcut icon" href="imgs/ico.png">
	
	
<style>

* {
  -webkit-box-sizing: border-box;
  box-sizing: border-box;
}

body { font-family:"Myriad Set Pro","Lucida Grande","Helvetica Neue","Helvetica","Arial","Verdana","sans-serif"; }

.gallery {
 width:200px;
 height:52px;
position:absolute;
 background-color: rgba(135, 206, 250, 0.5);
  border-radius: 15px;
 border-style: solid;
 
    border-width: 1px;
 
}

.gallery-cell {
margin-right: 10px;
  width: 100px;
  height: 100px;
opacity: 1;
  /* flex-box, center image in cell */
  display: -webkit-box;
  display: -webkit-flex;
  display:         flex;
  -webkit-box-pack: center;
  -webkit-justify-content: center;
          justify-content: center;
  -webkit-align-items: center;
          align-items: center;
}


/* brighten selected image */


@media screen and ( min-width: 768px ) {
  .gallery-cell {
    height: 50px;
  }
}

@media screen and ( min-width: 960px ) {
  .gallery-cell {
    width: 70px;
  }
}

/* buttons, no circle */
.flickity-prev-next-button {
  width: 20px;
  height: 20px;
  background: black;
  opacity: 0.5;
}
.flickity-prev-next-button:hover {
   width: 20px;
  height: 20px;
  background: black;
  opacity: 1;
}
/* arrow color */
.flickity-prev-next-button .arrow {
  fill: white;
}
.flickity-prev-next-button.no-svg {
  color: black;
}
/* closer to edge */
.flickity-prev-next-button.previous { left: 0; }
.flickity-prev-next-button.next { right: 0; }
/* hide disabled button */
.flickity-prev-next-button:disabled {
  display: none;
}
 .gallery-cell.is-selected {
   background-color: rgba(166, 233, 137, 0.6);
  border: 1px solid black;
  font-weight: bold;
  border-radius: 15px;
  color: black;
  }
  
  .flickity-page-dots {
  bottom: -35px;
}
/* white circles */
.flickity-page-dots .dot {
  width: 12px;
  height: 12px;
  opacity: 1;
  background: transparent;
  border: 3px solid black;
}
/* fill-in selected dot */
.flickity-page-dots .dot.is-selected {
  background: white;
  opacity:1;
}
</style>
<style>
<?php

 if ($_SESSION["id"]==5) 
 {  echo "div.login   {visibility:hidden;} div.buttons {visibility:visible;}";   }
else
echo "div.login   {visibility:visible;} div.buttons {visibility:hidden;}  div.main {visibility:hidden;} #logout{display:none;}" ;

if (!isset($_SESSION["LogInError"]))
echo "div.error{visibility:hidden;}"

?>

div.error{display:inline;}
div.background {
    background-image: url(./imgs/background1.png);
    height: 100%;
    width: 100%;
    position:fixed;

    padding:0;
    top: 0;
    left: 0;
    z-index: -1; /* Just to keep it at the very top */
}
div.upperToolBar {
    width: 100%;
    height: 60px;
	opacity: 0.9;
    background: #87CEFA ;
    z-index: -1;
    
}


div.gooch {
 background:transparent;
 opacity:0.7;
color:black;
font-weight: bold;
left:5px;
top:-5px;
position:fixed;
font-size: 40pt;
    
    -webkit-animation: fadein 1s; /* Safari, Chrome and Opera > 12.1 */
       -moz-animation: fadein 1s; /* Firefox < 16 */
        -ms-animation: fadein 1s; /* Internet Explorer */
         -o-animation: fadein 1s; /* Opera < 12.1 */
            animation: fadein 1s;
  
}
div.gooch:hover {
opacity:1;
}

@media screen and (max-width:1000px){
div.gooch{
    font-size: 25pt;
    left:10px;
    top:6px;
        }
    

}

div.calc {
    width: 48px;
    height: 54px;
    position: fixed;
    left:30%;
    top:0.5%;
    background-image: url(./imgs/calc.png);
    z-index: 1;
    
}
div.calc:hover {
    background-image: url(./imgs/calchover.png);
}
div.reports {
    width: 48px;
    height: 54px;
    position: fixed;
    left:45%;
    top:0.5%;
    background-image: url(./imgs/reports.png);
    z-index: 1;
    
}
div.reports:hover {
    background-image: url(./imgs/reportshover.png);
}
div.add {
    width: 48px;
    height: 54px;
    position: fixed;
    left:60%;
    top:0.5%;
    background-image: url(./imgs/add.png);
    z-index: 1;
}
div.add:hover {
    background-image: url(./imgs/addhover.png);
}
div.trash {
    width: 48px;
    height: 54px;
    position: fixed;
    left:75%;
    top:0.5%;
    background-image: url(./imgs/trash.png);
    z-index: 1;
    
}
div.trash:hover {
    background-image: url(./imgs/trashhover.png);
}





div.login {
font-family:"Myriad Set Pro","Lucida Grande","Helvetica Neue","Helvetica","Arial","Verdana","sans-serif";
 width: 600px;
 height: 50px;
    line-height: 50px;
    position: fixed;
    top: 0.8%; 
    left: 50px;
   
 margin-left: 230px; 
    opacity:0.8;
    border-radius: 5px;
    text-align: center;
    z-index: 1000; /* 1px higher than the overlay layer */



    -webkit-animation: fadein 1s; /* Safari, Chrome and Opera > 12.1 */
       -moz-animation: fadein 1s; /* Firefox < 16 */
        -ms-animation: fadein 1s; /* Internet Explorer */
         -o-animation: fadein 1s; /* Opera < 12.1 */
            animation: fadein 1s;
  
}

input {
    border: 5px solid white; 
    -webkit-box-shadow: 
      inset 0 0 8px  rgba(0,0,0,0.1),
            0 0 16px rgba(0,0,0,0.1); 
    -moz-box-shadow: 
      inset 0 0 8px  rgba(0,0,0,0.1),
            0 0 16px rgba(0,0,0,0.1); 
    box-shadow: 
      inset 0 0 8px  rgba(0,0,0,0.1),
            0 0 16px rgba(0,0,0,0.1); 
    padding: 2px;
    background: rgba(255,255,255,0.5);
    margin: 0 0 10px 0;
}

input[type=submit] {padding:5px 15px; background:	 #C0EC20; border:2px solid black;
cursor:pointer;
-webkit-border-radius: 5px;
border-radius: 5px; 
opacity: 1;
}



@keyframes fadein {
    from { opacity: 0; }
    to   { opacity: 0.8; }
}

/* Firefox < 16 */
@-moz-keyframes fadein {
    from { opacity: 0; }
    to   { opacity: 0.8; }
}

/* Safari, Chrome and Opera > 12.1 */
@-webkit-keyframes fadein {
    from { opacity: 0; }
    to   { opacity: 0.8; }
}

/* Internet Explorer */
@-ms-keyframes fadein {
    from { opacity: 0; }
    to   { opacity: 0.8; }
}

/* Opera < 12.1 */
@-o-keyframes fadein {
    from { opacity: 0; }
    to   { opacity: 0.8; }
}

</style>
 
<div class="background">
   <div class="upperToolBar">



 


<div class="buttons">

<div class="calc"></div>
<div class="reports"></div>
<div class="add"></div>
<div class="trash"></div>

</div><!--buttons-->

<div class="gooch">-Gooch- |</div>


<div class="login">

<form action="login.php" method="post" >

<b>User name: </b><input type="text" name="userName">
<b>Password: </b><input type="password" name="Password" >
<input type="submit" value="8==D" style="left:8px; position:relative"> 
<div class="error" style="color:red;left:870px;position: fixed;top: 0.8%;">Wrong Password or UserName</div>
</form>
</div><!--login-->

<form action="logout.php" id="logout" method=post><input type="submit" value="Logout" style="background: white; z-index: -1; left: 90%;top: 3%; position:fixed;"> </form>

</div><!--toolbar-->


 <div class="main" style="width:100%;height:auto;position:fixed;top:60px; background-color: rgba(249, 252, 255, 0.9);">
 
 <img src="imgs/add_gallery.png" style="width:30px;height:30px; position:absolute; left:7px;top:31.5px;" onclick="add_gallery()" />


</head>
<body>
 

</div><!--background-div-->
</body>
</html>