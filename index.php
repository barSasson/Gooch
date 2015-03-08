<?php
session_start();


    chmod("css/flicity.css", 777);
     chmod("css/flickity.pkgd.min.js", 777)

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<meta http-equiv="content-type" type="text/html;charset=utf-8" />
  <link rel="stylesheet" href="css/flickity.css" media="screen">
       <script src="css/flickity.pkgd.min.js"></script>
       <script>

docReady( function() {
  var flkty = new Flickity('.gallery');
  
});

</script>
       
<title>-Gooch-</title>
<head>
	<link rel="shortcut icon" href="imgs/ico.png">
	
	
<style>

* {
  -webkit-box-sizing: border-box;
  box-sizing: border-box;
}

body { font-family: sans-serif; }

.gallery {
position:fixed;
left:300px;
let:300px;
  background: #87CEFA ;
}

.gallery-cell {
margin-right: 10px;
  width: 100px;
  height: 100px;

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

.gallery-cell img {
  display: block;
  max-width: 100%;
  max-height: 100%;
   text-align: center;
  /* dim unselected */
  opacity: 0.7;
  -webkit-transform: scale(0.85);
          transform: scale(0.85);
  -webkit-filter: blur(5px);
          filter: blur(5px);
  -webkit-transition: opacity 0.3s, -webkit-transform 0.3s, transform 0.3s, -webkit-filter 0.3s, filter 0.3s;
          transition: opacity 0.3s, transform 0.3s, filter 0.3s;
}

/* brighten selected image */
.is-selected img {
  opacity: 1;
 
  background-image: url(./imgs/background2.png);
  -webkit-transform: scale(1);
          transform: scale(1);
  -webkit-filter: none;
          filter: none;
}

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
  width: 30px;
  height: 30px;
  background: transparent;
  opacity: 0.6;
}
.flickity-prev-next-button:hover {
  background: transparent;
  opacity: 1;
}
/* arrow color */
.flickity-prev-next-button .arrow {
  fill: white;
}
.flickity-prev-next-button.no-svg {
  color: white;
}
/* closer to edge */
.flickity-prev-next-button.previous { left: 0; }
.flickity-prev-next-button.next { right: 0; }
/* hide disabled button */
.flickity-prev-next-button:disabled {
  display: none;
}
 .gallery-cell.is-selected {
  background: #74e244;
  opacity:0.8;
  
  }
</style>
<style>
<?php

 if ($_SESSION["id"]==5) 
 {  echo "div.login   {visibility:hidden;} div.buttons {visibility:visible;}";   }
else
echo "div.login   {visibility:visible;} div.buttons {visibility:hidden;}" ;


?>


div.background {
    background-image: url(./imgs/background2.png);
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

    width: 203px;
    height: 39px;
    left:2%;
    top:1.7%;
    position:absolute;
    background-image: url(./imgs/gooch.png);
    float:left;
    z-index: -1;
    opacity:0.8;
    
    -webkit-animation: fadein 1s; /* Safari, Chrome and Opera > 12.1 */
       -moz-animation: fadein 1s; /* Firefox < 16 */
        -ms-animation: fadein 1s; /* Internet Explorer */
         -o-animation: fadein 1s; /* Opera < 12.1 */
            animation: fadein 1s;
  
}

div.gooch:hover {
    opacity:1;
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
    left: 0%;
   
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

input[type=submit] {padding:5px 15px; background:	#74e244; border:0 none;
cursor:pointer;
-webkit-border-radius: 5px;
border-radius: 5px; 
opacity: 0.8;
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

<div class="gooch"></div>


<div class="login">

<form action="login.php" method="post" >

<b>User name: </b><input type="text" name="userName">
<b>Password: </b><input type="password" name="Password" >
<input type="submit" value="-->>"> 

</form>
</div><!--login-->

<form action="logout.php" method=post><input type="submit" value="-->>" style="background: black; z-index: -1; left: 70%;top: 1%; position:fixed;"> </form>

</div><!--toolbar-->

<div class="wrapper" style="top:80px; z-index:100;">
<div class="gallery" style="width:300px;height:50px;">

  <div class="gallery-cell">
  apple
  </div>
  <div class="gallery-cell">
   בר ששון
  </div>
  <div class="gallery-cell" >
    שני
  </div>
  
</div>
</div>

</head>
<body>
 


</div><!--background-div-->
</body>
</html>