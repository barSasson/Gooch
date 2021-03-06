<?php
session_start();
if(!isset($_SESSION["loggedin"]))
header("Location: ./index.php");

 $xml = simplexml_load_file('./waiters.xml') or die ("Error: failed to open xml") ;
 $waiters[]=array();
 foreach($xml->children() as $waiter)
{
   $waiters[] = (string)$waiter;
  
}       

?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
        "http://www.w3.org/TR/html4/loose.dtd">
<meta http-equiv="content-type" type="text/html;charset=utf-8" />
<link rel="stylesheet" href="css/flickity.css" media="screen">
<script src="css/flickity.pkgd.min.js"></script>
<script>
    function shuffleArray(array) {
        var currentIndex = array.length,
            temporaryValue, randomIndex;

        // While there remain elements to shuffle...
        while (0 !== currentIndex) {

            // Pick a remaining element...
            randomIndex = Math.floor(Math.random() * currentIndex);
            currentIndex -= 1;

            // And swap it with the current element.
            temporaryValue = array[currentIndex];
            array[currentIndex] = array[randomIndex];
            array[randomIndex] = temporaryValue;
        }

        return array;
    }

    var position_top = -80;
    var position_left = 50;
    var gallery_num = 0;
    var taxReductionPerHour = 6;
    var checkersAllowance = 20;
    var flkty = [];
    var size = <?php echo sizeof($waiters); ?> ;
    var json_waiters = <?php echo json_encode($waiters); ?>;
    var k_defaultTipsPercentToAdd = 0.2;
    var tipsPercentToAdd = k_defaultTipsPercentToAdd;
    var k_prefix = 'x';
    var extendedView = false;
    var waiterIndices = [];
    for (var i = 0; i < size - 1; i++) {
        waiterIndices[i] = i;
    }

    shuffleArray(waiterIndices);

    function append_gallery() {
        if (gallery_num >= 15) {
            alert("Too Many Waiters");
        } else {
            gallery_num += 1;
            position_top += 100;


            var waitersList = "";
            for (var i = 1; i < size; i++) {
                waitersList += "<div class='gallery-cell'>" + json_waiters[i] + "</div>";
            }

            var wrapper = document.createElement("div");
            wrapper.id = gallery_num;
            wrapper.style.position = "absolute";
            wrapper.style.left = position_left.toString() + "px";
            wrapper.style.top = position_top.toString() + "px";
            wrapper.innerHTML = "<div class='gallery" + gallery_num.toString() + "' style=' display:block;width:300px;height:52px;position:absolute;background-color: rgba(198, 134, 245, 0.5);border-radius: 15px;border-style: solid;border-width: 1px;' >" + waitersList + " </div><span><input type='text' id='textBox" + gallery_num.toString() + "' placeholder='fill-in Hours' autofocus style='text-align:center;position:absolute; top:60px; left:72px; border:1px solid black;' /></span>";
            document.getElementsByClassName("main")[0].appendChild(wrapper);


            var initial = waiterIndices[0];
            waiterIndices.shift();


            flkty[gallery_num - 1] = new Flickity('.gallery' + gallery_num.toString(), {
                pageDots: false,
                "initialIndex": initial
            });
            var add_gallery_button = document.getElementById("append_gallery_id");
            add_gallery_button.style.top = (position_top + 12) + "px";

            document.getElementsByClassName("main")[0].style.height += 100;


        } //else

    } //add_gallery_func

    docReady(
        function() {
            for (var i = 0; i < 6; i++)
                append_gallery();

        });

    function delete_gallery() {
        if (gallery_num > 1) {
            repeatBucket = [];
            document.getElementById(gallery_num).innerHTML = "";
            document.getElementById(gallery_num).parentNode.removeChild(document.getElementById(gallery_num));
            if (gallery_num > 1) {
                position_top -= 100;
                document.getElementById("append_gallery_id").style.top = (position_top + 12) + "px";
            }

            gallery_num -= 1;
        }

    }
    // i_WaitersHoursArray expecting {Id: ,Name: ,Hours: }
    function ShiftData(i_TotalTipsAmount, i_WaitersHoursArray, i_isCheckerExists)
    {
        const k_TaxReductionPerHour = 6;
        const k_CheckersAllowance = 20;
        var m_TotalTipsAmount = i_TotalTipsAmount;
        var m_WaitersHoursArray = i_WaitersHoursArray;
        var m_isCheckerExists = i_isCheckerExists;

        var m_TipsToIgnore;
        var m_TotalHours = 0;
        var m_TipsAfterTax;
        var m_TotalAllowance = 0;
        var m_MoneyPerHour;

        ShiftData.prototype.CalculateTips()
        {
            m_TotalHours = sumHours();
            m_TipsToIgnore = ShiftData.TipsToIgnore(m_TotalTipsAmount);
            m_TotalTipsAmount -= m_TipsToIgnore;
            m_TotalAllowance = ShiftData.GetTotalAllowance();

            var taxReduction = Math.ceil(k_TaxReductionPerHour * m_TotalHours);
            m_TipsAfterTax = m_TotalTipsAmount - taxReduction;
            var barAllowance = Math.ceil(m_TotalAllowance * 0.25)
            var kitchenAllowance = m_TotalAllowance - barAllowance;
            var kitchenAllowanceAfterCheckersReduction = kitchenAllowance - k_CheckersAllowance;
            var tipsAfterAllReduction = tipsAfterTax - totalAllowance;
            if(m_isCheckerExists == false)
            {
                 tipsAfterAllReduction += k_CheckersAllowance;
            }

            m_MoneyPerHour = (tipsAfterAllReduction / m_TotalHours).toFixed(2);

            var shiftWaiterData = ShiftData.DevideTipsAndGetResultArray();

            addTips(shiftWaiterData);
            ShiftData.devideRemainder(shiftWaiterData);

            return shiftWaiterData;
        }

        //abstract
        var sumHours = function()
        {
            m_TotalHours = 0;
            for (var i = m_WaitersHoursArray.length - 1; i >= 0; i--) {
                 m_TotalHours += m_WaitersHoursArray[i];
            }
        }

        ShiftData.prototype.TipsToIgnore = function(i_TotalTipsAmount)
        {
            return i_TotalTipsAmount * 0.2;
        }

        ShiftData.prototype.GetTotalAllowance = function()
        {
            return Math.floor(m_TipsAfterTax * 0.12);
        }

        ShiftData.prototype.DevideTipsAndGetResultArray = function()
        {
            var shiftWaitersData = [];
            for (var i = 0; i < m_WaitersHoursArray.length; i++) {
            shiftWaitersData[i] = {
                Id: m_WaitersHoursArray[i].Id,
                Name: m_WaitersHoursArray[i].Name,
                Hours: m_WaitersHoursArray[i].Hours
                EarnedInShift: m_WaitersHoursArray[i].Hours * m_MoneyPerHour;
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

        function addTips(i_ShiftWaiterData) {
            var perHourToAdd = m_TipsToIgnore / m_TotalHours;
            for (var i = 0; i < i_ShiftWaiterData.length; i++) {
                i_ShiftWaiterData[i].EarnedInShift += i_ShiftWaiterData[i].Hours * perHourToAdd;
            }
        }
    }

     ShiftData.prototype.FetchHoursArray = function()
        {
            for (var i = 0; i < gallery_num; i++) {
            var waiterid = 
            var waitername = 
            var waiterhours = parseFloat()
            if (isNaN(waiterhours)) {
                waiterhours = 0;
            }

            waitersData[i] = {
                m_waiterId: waiterid,
                m_waiterName: waitername,
                m_hours: waiterhours
            };
          }
        }

    function calculateTips() {
        var shiftData = {};
        var waitersData = [];
        shiftData.TotalTipsAmount = document.getElementById('TotalTipsAmount').value;
        extendedView = false;
        tipsPercentToAdd = k_defaultTipsPercentToAdd;
        var splittedStringArray = shiftData.TotalTipsAmount.split(k_prefix);
        if (splittedStringArray.length == 2) {
            if (splittedStringArray[0] != 0) {
                tipsPercentToAdd = parseFloat(splittedStringArray[0])
            }
            shiftData.TotalTipsAmount = parseFloat(splittedStringArray[1]);
            extendedView = true;
        }
        if (isNaN(shiftData.TotalTipsAmount)) {
            shiftData.TotalTipsAmount = 0;
        }
        shiftData.totalHours = 0;
        for (var i = 0; i < gallery_num; i++) {
            //hours = document.getElementById("textBox" + i.toString()).value.parseInt();
            var waiterid = flkty[i].selectedIndex + 1;
            var waitername = json_waiters[waiterid];
            var waiterhours = parseFloat(document.getElementById('textBox' + (i + 1).toString()).value);
            if (isNaN(waiterhours)) {
                waiterhours = 0;
            }

            waitersData[i] = {
                m_waiterId: waiterid,
                m_waiterName: waitername,
                m_hours: waiterhours
            };
            shiftData.totalHours += waiterhours;
        }
        var taxReduction = Math.ceil(taxReductionPerHour * shiftData.totalHours);
        var tipsAfterTax = shiftData.TotalTipsAmount - taxReduction;
        var totalAllowance = Math.floor(tipsAfterTax * 0.12);
        var barAllowance = Math.ceil(totalAllowance * 0.25)
        var kitchenAllowance = totalAllowance - barAllowance;
        var kitchenAllowanceAfterCheckersReduction = kitchenAllowance - checkersAllowance;
        var tipsAfterAllReduction = tipsAfterTax - totalAllowance;
        shiftData.m_moneyPerHour = (tipsAfterAllReduction / shiftData.totalHours).toFixed(2);

        for (var i = 0; i < waitersData.length; i++) {
            waitersData[i].m_earnedInShift = waitersData[i].m_hours * shiftData.m_moneyPerHour;
        }
        shiftData.m_waitersData = waitersData;

        clearHtmlcodeFromElement("TipsCalculations");

        var calculationStringHeader = "Total Hours :" + shiftData.totalHours + "</br>Tax Reduction: " + taxReduction + "</br> Total Allowance: " + totalAllowance + "</br> Kitchen: " + kitchenAllowanceAfterCheckersReduction + "</br> Bar: " + barAllowance + "</br>Checkers: " + checkersAllowance + "</br> Money Per Hour:" + shiftData.m_moneyPerHour;
        concatenateHtmlCodeIntoHtmlElement("TipsCalculations", calculationStringHeader);


        devideRemainder(shiftData);
        concatenateHtmlCodeIntoHtmlElement("TipsCalculations", getWaitersshiftData(shiftData));
        if (extendedView == true) {
            addTips(shiftData);
            devideRemainder(shiftData);
            concatenateHtmlCodeIntoHtmlElement("TipsCalculations", getWaitersshiftData(shiftData));
        }


    }

    function addTips(shiftData) {
        var perHourToAdd = (tipsPercentToAdd * shiftData.TotalTipsAmount / (1 - tipsPercentToAdd)) / shiftData.totalHours;
        for (var i = 0; i < shiftData.m_waitersData.length; i++) {
            shiftData.m_waitersData[i].m_earnedInShift += shiftData.m_waitersData[i].m_hours * perHourToAdd;
        }
    }

    function clearHtmlcodeFromElement(elementName) {
        document.getElementById(elementName).innerHTML = "";
    }

    function getWaitersshiftData(shiftData) {
        var htmldata = "<div>-------------";
        for (var i = 0; i < shiftData.m_waitersData.length; i++) {
            htmldata += "</br>" + shiftData.m_waitersData[i].m_waiterName + "</br>" + shiftData.m_waitersData[i].m_hours + " X " + shiftData.m_moneyPerHour + " = " + shiftData.m_waitersData[i].m_earnedInShift + "</div>";
        }
        return htmldata;
    }

    function concatenateHtmlCodeIntoHtmlElement(htmlEelementName, htmlcode) {
        var elementToAdd = document.getElementById(htmlEelementName);
        elementToAdd.innerHTML += htmlcode;
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
        
        body {
            font-family: "Myriad Set Pro", "Lucida Grande", "Helvetica Neue", "Helvetica", "Arial", "Verdana", "sans-serif";
        }
        
        .gallery-cell {
            margin-right: 10px;
            width: 50px;
            height: 50px;
            opacity: 1;
            /* flex-box, center image in cell */
            display: -webkit-box;
            display: -webkit-flex;
            display: flex;
            -webkit-box-pack: center;
            -webkit-justify-content: center;
            justify-content: center;
            -webkit-align-items: center;
            align-items: center;
        }
        /* brighten selected image */
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
        
        .flickity-prev-next-button.previous {
            left: 0;
        }
        
        .flickity-prev-next-button.next {
            right: 0;
        }
        /* hide disabled button */
        
        .flickity-prev-next-button:disabled {
            display: none;
        }
        
        .gallery-cell.is-selected {
            background-color: rgba(135, 206, 250, 0.5);
            border: 1px solid black;
            font-weight: bold;
            border-radius: 3px;
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
            opacity: 1;
        }
    </style>
    <style>
        <?php if ($_SESSION["id"]==5) {
            echo "div.login   {visibility:hidden;} div.buttons {visibility:visible;}";
        }
        
        else echo "div.login   {visibility:visible;} div.buttons {visibility:hidden;}  div.main {visibility:hidden;} #logout{display:none;}";
        ?> div.background {
            background-image: url(./imgs/background.png);
            height: 100%;
            width: 100%;
            position: fixed;
            overflow: scroll;
            padding: 0;
            top: 0;
            left: 0;
            z-index: -1;
            /* Just to keep it at the very top */
        }
        
        div.upperToolBar {
            width: 100%;
            position: fixed;
            height: 60px;
            opacity: 0.9;
            background: #FAFBEE;
            z-index: -1;
        }
        
        div.gooch {
            background: transparent;
            opacity: 0.7;
            color: black;
            font-weight: bold;
            left: 5px;
            top: -5px;
            position: fixed;
            font-size: 40pt;
            -webkit-animation: fadein 1s;
            /* Safari, Chrome and Opera > 12.1 */
            -moz-animation: fadein 1s;
            /* Firefox < 16 */
            -ms-animation: fadein 1s;
            /* Internet Explorer */
            -o-animation: fadein 1s;
            /* Opera < 12.1 */
            animation: fadein 1s;
        }
        
        div.gooch:hover {
            opacity: 1;
        }
        
        @media screen and (max-width:800px) {
            div.gooch {
                font-size: 25pt;
                left: 10px;
                top: 6px;
            }
        }
        
        @media screen and (max-width:500px) {
            div.gooch {
                font-size: 15pt;
                position: absolute;
                top: 16px;
            }
        }
        
        div.calc {
            width: 48px;
            height: 54px;
            position: fixed;
            left: 30%;
            top: 0.5%;
            background-image: url(./imgs/calchover.png);
            z-index: 1;
        }
        
        div.reports {
            width: 48px;
            height: 54px;
            position: fixed;
            left: 45%;
            top: 0.5%;
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
            left: 60%;
            top: 0.5%;
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
            left: 75%;
            top: 0.5%;
            background-image: url(./imgs/trash.png);
            background-repeat: no-repeat;
            z-index: 1;
        }
        
        div.trash:hover {
            background-image: url(./imgs/trashhover.png);
        }
        
        div.login {
            font-family: "Myriad Set Pro", "Lucida Grande", "Helvetica Neue", "Helvetica", "Arial", "Verdana", "sans-serif";
            width: 600px;
            height: 50px;
            line-height: 50px;
            position: fixed;
            top: 0.8%;
            left: 0%;
            margin-left: 230px;
            opacity: 0.8;
            border-radius: 5px;
            text-align: center;
            z-index: 1000;
            -webkit-animation: fadein 1s;
            /* Safari, Chrome and Opera > 12.1 */
            -moz-animation: fadein 1s;
            /* Firefox < 16 */
            -ms-animation: fadein 1s;
            /* Internet Explorer */
            -o-animation: fadein 1s;
            /* Opera < 12.1 */
            animation: fadein 1s;
        }
        
        input {
            border: 5px solid white;
            -webkit-box-shadow: inset 0 0 8px rgba(0, 0, 0, 0.1), 0 0 16px rgba(0, 0, 0, 0.1);
            -moz-box-shadow: inset 0 0 8px rgba(0, 0, 0, 0.1), 0 0 16px rgba(0, 0, 0, 0.1);
            box-shadow: inset 0 0 8px rgba(0, 0, 0, 0.1), 0 0 16px rgba(0, 0, 0, 0.1);
            padding: 2px;
            background: rgba(255, 255, 255, 0.5);
            margin: 0 0 10px 0;
        }
        
        input[type=submit] {
            padding: 5px 15px;
            background: #74e244;
            border: 0 none;
            cursor: pointer;
            -webkit-border-radius: 5px;
            border-radius: 5px;
            opacity: 0.8;
        }
        
        @keyframes fadein {
            from {
                opacity: 0;
            }
            to {
                opacity: 0.8;
            }
        }
        /* Firefox < 16 */
        
        @-moz-keyframes fadein {
            from {
                opacity: 0;
            }
            to {
                opacity: 0.8;
            }
        }
        /* Safari, Chrome and Opera > 12.1 */
        
        @-webkit-keyframes fadein {
            from {
                opacity: 0;
            }
            to {
                opacity: 0.8;
            }
        }
        /* Internet Explorer */
        
        @-ms-keyframes fadein {
            from {
                opacity: 0;
            }
            to {
                opacity: 0.8;
            }
        }
        /* Opera < 12.1 */
        
        @-o-keyframes fadein {
            from {
                opacity: 0;
            }
            to {
                opacity: 0.8;
            }
        }
    </style>

    <div class="background">
        <div class="upperToolBar">




            <div class="gooch">-Gooch-</div>

            <div class="buttons">

                <div class="calc"></div>
                <div class="reports"></div>
                <div class="add"></div>
                <div class="trash"></div>

            </div>
            <!--buttons-->




            <div class="login">

                <form action="login.php" method="post">

                    <b>User name: </b><input type="text" name="userName">
                    <b>Password: </b><input type="password" name="Password">
                    <input type="submit" value="-->>">

                </form>
            </div>
            <!--login-->


            <form action="logout.php" id="logout" method=post><input type="submit" value="Logout" style="background: white; z-index: -1; left: 90%;top: 3%; position:fixed;"> </form>


        </div>
        <!--toolbar-->


        <div class="main" style="margin-left:auto;margin-right:auto; width:70%;height:800px;border-radius: 10px;position:relative;overflow-y:scroll;top:60px; background-color: #FFDC84; opacity:0.9; z-index:-2">


            <img src="imgs/append_gallery.png" id="append_gallery_id" onClick="append_gallery();" style="width:30px;height:30px; position:absolute; left:7px;top:31.5px; opacity:0.8;z-index:1000;" />
            <img src="imgs/delete_gallery.png" id="delete_gallery_id" onClick="delete_gallery();" style="width:30px;height:30px; position:absolute; left:370px;top:31.5px; opacity:0.8;z-index:1000;" />

            <div style="width:400px;height:100px; position:absolute; left:525px;top:24px; opacity:0.8;z-index:1000;">

                <div>
                    <input type='text' id='TotalTipsAmount' placeholder='Total Tips'>
                    <input type='button' value='Calculate' onClick='calculateTips()'>
                </div>

                <div style="font-weight:bold ;text-align: center;display: inline-block; background-color: #D3D3F4" id="TipsCalculations">
                </div>

            </div>


        </div>

        <div id="footer" style="position : absolute;
bottom : 0;
height : 20px;
background:rgba(206,216,246,0.7);
width:100%;
position:fixed;
margin-top : 40px;"></div>

</head>

<body>



    </div>
    <!--background-div-->
</body>

</html>