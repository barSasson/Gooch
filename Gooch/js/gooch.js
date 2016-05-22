const initialNumOfWaiters = 2   ;
var numOfWaiters = 0;
var defaultHoursNum = 6;
var getHtmlOptionValuesForWaiterSelect = "<option value=''>Waiter Name</option>";

for (var j = 0; j < window.completionOptions.length; ++j)
{
    getHtmlOptionValuesForWaiterSelect += "<option value='" + window.completionOptions[j].id + "'>" +
        window.completionOptions[j].username_heb +
        "</option>";
}
getHtmlOptionValuesForWaiterSelect += "</select>";

function getHtmlwaiterPicker(pickerId)
{
    var htmlSelectWaiterCode = "<select id='" + pickerId + "' class='waiter-name-input'>";
    htmlSelectWaiterCode += getHtmlOptionValuesForWaiterSelect;
    htmlSelectWaiterCode += "</select>";
    return htmlSelectWaiterCode;
}

for (var i = 0; i < initialNumOfWaiters; i++)
{
    appendWaiterPicker();
}

function getHtmlRangePicker(id, initialHours)
{
    var htmlRangePicker = '';
    htmlRangePicker += "<output class='range-value-style' id='rangevalue" + id + "'>" + initialHours +
        "</output> <center><small style='position:absolute; margin-left:48px; margin-top:-38px;'>[Hours]</small>";
    htmlRangePicker += "<input type='range' value='" + initialHours +
        "' min='0.25' max='12' step='0.25' style='margin-left: 6px' id='hour-" + id +
        "-input' oninput='updateHourOutput(" + id + ",this.value) '/><br>";

    return htmlRangePicker;
}

function appendWaiterPicker()
{
    var htmlSelectHoursCode = "<div class='hours-picker-wrapper' id='hours-picker-wrapper" + numOfWaiters +
        "'>";

    htmlSelectHoursCode += "<center>";
    htmlSelectHoursCode += getHtmlRangePicker(numOfWaiters, defaultHoursNum);
    htmlSelectHoursCode += getHtmlwaiterPicker("waiter-select" + numOfWaiters);
    htmlSelectHoursCode += "<div id='err-msg" + numOfWaiters + "' style='height:0px;width:0px;'></div>";
    htmlSelectHoursCode += "<div id='result" + numOfWaiters + "'></div>";
    htmlSelectHoursCode += "</center>";
    htmlSelectHoursCode += "</br>";
    htmlSelectHoursCode += "</div>";

    $("#hours-input").append(htmlSelectHoursCode);
    $('#waiter-select' + numOfWaiters).selectize(
    {
        maxItems: 1,
        create: false,
        sortField: 'text',
        onChange: function(value)
        {
            onWaiterSelectEvent(this, value);
        }
    });

    var newElement = document.getElementById("hours-picker-wrapper" + numOfWaiters);
    newElement.style.opacity = 1;
    numOfWaiters++;
}

function onWaiterSelectEvent(i_Callee, i_Value)
{
    var currentElementIndex, isAlreadySelected = false;
    for (var i = 0; i < numOfWaiters; ++i)
    {
        if ($('#waiter-select' + i)[0].selectize !== i_Callee)
        {
            if ($("#waiter-select" + i + " option:selected").val() === i_Value && i_Value)
            {
                isAlreadySelected = true;
            }
        }
        else
        {
            currentElementIndex = i;
        }
    }
    if (isAlreadySelected)
    {
        i_Callee.setValue('');
        i_Callee.blur();
        $('#err-msg' + currentElementIndex).popover(
        {
            title: "Error!",
            placement: 'bottom',
            trigger: 'manual',
        });
        $('#err-msg' + currentElementIndex).attr(
            'data-content',
            "Waiter Already Selected");
        $('#err-msg' + currentElementIndex).popover("show");
        setTimeout(function()
        {
            $('#err-msg' + currentElementIndex).popover("hide");
        }, 2000);
    }
}

function updateHourOutput(outputid, newValue)
{
    document.getElementById("rangevalue" + outputid).innerHTML = newValue;
    onRangeChange(outputid);
}

function removeLastWaiterPicker()
{
    if (numOfWaiters >= 1)
    {
        numOfWaiters--;
        var elementToRemove =
            document.getElementById("hours-picker-wrapper" + numOfWaiters);
        elementToRemove.style.opacity = 0;
        setTimeout(function()
            {
                elementToRemove.parentNode.removeChild(elementToRemove);
            },
            570)
    }
}

(function createDatePickerAndSetDate(date)
{

    $('#datePicker').datepicker(
    {
        container: '#datePickerContainer',
        orientation: "left",
        autoclose: true,
        todayHighlight: true,
        todayBtn: 'linked'
    });
    if (!date)
    {
        var currentDate = new Date();
        var yesterday = new Date(new Date().setDate(new Date().getDate() - 1));
        if (currentDate.getHours() >= 10)
        {
            $('#datePicker').datepicker('setDate', currentDate);
            document.getElementById("morning-shift-input").checked = true;
        }
        else
        {
            $('#datePicker').datepicker('setDate', yesterday);
            document.getElementById("evening-shift-input").checked = true;
        }
    }
    else
    {
        $('#datePicker').datepicker('setDate', date);
    }
})();

document.getElementById("brand-text").addEventListener('doubleTap', touched);

function touched()
{
    if ($('.extended').css("display") == "none")
    {
        $('.extended').css("display", "inline");
    }
    else
    {
        $('.extended').css("display", "none");
    }

}

function checkPercentValueAndGetOpts()
{
    var tipsPercentValue = $('#tips-percent').val(),
        opts;
    if (tipsPercentValue)
    {
        opts = ['percent', tipsPercentValue]
    }

    return opts;
}


function getWaiterArrayDataFromHtml()
{
    var waiterHoursArray = [];
    for (var i = 0; i < numOfWaiters; i++)
    {
        var selectElement = document.getElementById("waiter-select" + i);
        var rangeValue = document.getElementById("hour-" + i + "-input").value;
        if (selectElement.value === "")
        {
            throw "All waiters names must be selected"
        }
        waiterHoursArray[i] = {
            Id: selectElement.value,
            Name: selectElement.textContent,
            Hours: rangeValue
        };
    }

    return waiterHoursArray;
}


function ShiftBasicData()
{
        var checkerRadio = $("input[type='radio'][name='checker-exists']:checked");
        var shiftTypeRadio = $("input[type='radio'][name='shift-type']:checked");
        
        this.m_WaitersHourArray = getWaiterArrayDataFromHtml();
        this.m_TotalTips = $('#tips-input').val();
        this.m_CheckerOn = (checkerRadio.val() == "on");
        this.m_IsMorning = (shiftTypeRadio.val() == "morning");
        this.m_Date = $("#datePicker").data('datepicker').getFormattedDate('yyyy-mm-dd');
}


function PopulateData(objectIdOfPopluator, opts)
{
    var jqueryObjectName = '#' + objectIdOfPopluator;
    try
    {

       
        var shiftData = ShiftDataFactory.GetInstance(new ShiftBasicData(), opts);
        shiftData.CalculateTips();
        $(jqueryObjectName).popover("hide");

        return shiftData;
    }
    catch (e)
    {
        $(jqueryObjectName).popover(
        {
            title: "Error!",
            placement: 'bottom',
            trigger: 'manual',
        });
        $(jqueryObjectName).attr('data-content', e);
        $(jqueryObjectName).popover("show");
        setTimeout(function()
        {
            $(jqueryObjectName).popover("hide");
        }, 2000)


        return null;
    }
}

function calculateInEvent(calleeId, opts)
{
    var shiftData = PopulateData(calleeId, opts);
    if(!shiftData)
    {
        $('#' + calleeId).val('');
        return;
    }
    $('#tips-per-hour').html(shiftData.m_MoneyPerHour);
    $('#tips-per-hour-real').html(shiftData.m_MoneyPerHourAfterInclusion);

    return shiftData

}
$('#tips-percent').on('input', function()
{   var opts = checkPercentValueAndGetOpts(),
        shiftData = calculateInEvent($(this).attr('id'), opts);
    if(shiftData)
    {
        $('#total-allowance').val(shiftData.m_TotalAllowance);
    }

    /*var opts = checkPercentValueAndGetOpts(),
        shiftData = PopulateData(calleeId, opts);
    if(!shiftData)
    {
        $(this).val('');
        return;
    }

    $('#total-allowance').val(shiftData.m_TotalAllowance);
    $('#tips-per-hour').html(shiftData.m_MoneyPerHour);
    $('#tips-per-hour-real').html(shiftData.m_MoneyPerHourAfterInclusion);*/
});

$('#total-allowance').on('input', function()
{
    var opts = ['allowance', $(this).val()],
        shiftData = calculateInEvent($(this).attr('id'), opts);
    if(shiftData)
    {
        $('#tips-percent').val(shiftData.m_TipsPercentToExclude);
    }
});

$('#tips-input').on('input', function()
{
    var opts = checkPercentValueAndGetOpts(),
        shiftData = calculateInEvent($(this).attr('id'), opts);
    if(shiftData)
    {
        $('#tips-percent').val(shiftData.m_TipsPercentToExclude);
        $('#total-allowance').val(shiftData.m_TotalAllowance);
    }
});

var onRangeChange = function(calleeIndex)
{
    var opts = checkPercentValueAndGetOpts();
    if ($('#tips-input').val())
    {
        var shiftData = calculateInEvent('err-msg' + calleeIndex, opts);
        if(shiftData)
        { 
            $('#tips-percent').val(shiftData.m_TipsPercentToExclude);
            $('#total-allowance').val(shiftData.m_TotalAllowance);
            $('#tips-per-hour').html(shiftData.m_MoneyPerHour);
            $('#tips-per-hour-real').html(shiftData.m_MoneyPerHourAfterInclusion);
        }
    }
}

function getHtmlWaitersData(waiterData)
{
    var htmlWaiterData = "";
    for (i = 0; i < waiterData.length; i++)
    {
        htmlWaiterData +=
            "<br><div class='btn default-input-style' style='width:200px;padding:3px; font-size:medium'><p><strong>" +
            waiterData[i].Name + "</strong><br>Hours: " + waiterData[i].Hours + "<br> Earned: " + waiterData[
                i].EarnedInShift +
            "</p></div>";
    }
    return htmlWaiterData;
}

$('#submit-button').click(function(e)
{

    var opts = checkPercentValueAndGetOpts(),
        shiftData = calculateInEvent($(this).attr('id'), opts),
        shiftDataString;
    if(shiftData)
    { 
        $('#tips-percent').val(shiftData.m_TipsPercentToExclude);
        $('#total-allowance').val(shiftData.m_TotalAllowance);
        $('#tips-per-hour').html(shiftData.m_MoneyPerHour);
        $('#tips-per-hour-real').html(shiftData.m_MoneyPerHourAfterInclusion);
        shiftDataString = JSON.stringify(shiftData);
        $.ajax(
        {
            type: 'POST',
            url: 'saveshift.php',
            dataType:'json',
            data:
            {
                shift_data: shiftDataString
            },
            success: function(answer)
            {
                if(answer.success)
                {
                    $('#waiters-data').html("<p>" + answer.msg + getHtmlWaitersData(shiftData.m_ShiftWaitersData)  + "</p>");
                }
                else
                {
                    $('#waiters-data').html("<p>" + answer.msg + "<br> if you want to edit an existing shift, go to <a href='#'>Edit Shift</a> Page</p>");
                }
            }
        });
    }
    else
    {
        e.preventDefault();
    }
});

// i_WaitersHoursArray expecting {Id: ,Name: ,Hours: }

function ShiftData(i_BasicShiftData)
{
    const k_TaxReductionPerHour = 6;
    const k_CheckersAllowance = 20;
    this.m_CheckerAllowance = i_BasicShiftData.m_CheckerOn ? k_CheckersAllowance : 0;
    this.m_AllowancePercent = 0.12;
    this.m_TotalInitialTipsAmount = i_BasicShiftData.m_TotalTips;
    this.m_TotalTipsAmount = i_BasicShiftData.m_TotalTips;
    this.m_WaitersHoursArray = i_BasicShiftData.m_WaitersHourArray;
    this.m_isCheckerExists = i_BasicShiftData.m_CheckerOn;
    this.m_IsMorning = i_BasicShiftData.m_IsMorning;
    this.m_TipsPercentToExclude = 20;
    this.m_TipsToExclude = 0;
    this.m_TipsAfterTax = 0;
    this.m_TotalAllowance = 0;
    this.m_MoneyPerHour = 0;

    this.m_Date = i_BasicShiftData.m_Date;

    this.m_TotalHours = (function(waitersHoursArray)
    {
        var totalHours = 0;
        for (i = waitersHoursArray.length - 1; i >= 0; i--)
        {
            totalHours += parseFloat(waitersHoursArray[i].Hours);
        }

        return totalHours;
    })(this.m_WaitersHoursArray);


    if (!this.m_TotalTipsAmount)
    {
        throw "Tips amount must be entered!";
    }
    if (!this.m_WaitersHoursArray)
    {
        throw "All waiters names must be selected";
    }

    this.TaxReduction = function()
    {
        return Math.ceil(k_TaxReductionPerHour * this.m_TotalHours);
    }
    this.GetMoneyPerHour = function()
    {
        return this.m_MoneyPerHour;
    };

    ShiftData.prototype.CalculateTips = function()
    {

        this.m_TipsToExclude = this.TipsToExclude();
        this.m_TotalTipsAmount -= this.m_TipsToExclude;
        this.m_TipsAfterTax = this.m_TotalTipsAmount - this.TaxReduction();
        this.m_TotalAllowance = this.GetTotalAllowance(this.m_TipsAfterTax);
        this.m_BarAllowance = Math.ceil(this.m_TotalAllowance * 0.25);
        this.m_KitchenAllowance = this.m_TotalAllowance - this.m_BarAllowance - k_CheckersAllowance;
        this.m_TipsAfterAllReduction = this.m_TipsAfterTax - this.m_TotalAllowance;
        this.m_TipsAfterAllReduction += k_CheckersAllowance - this.m_CheckerAllowance;
        this.m_MoneyPerHour = (this.m_TipsAfterAllReduction / this.m_TotalHours).toFixed(2);


        var shiftWaiterData = this.DevideTipsAndGetResultArray(this.m_WaitersHoursArray, this.m_MoneyPerHour);

        this.addTips(shiftWaiterData);
        this.devideRemainder(shiftWaiterData);

        this.m_ShiftWaitersData = shiftWaiterData;
    }

    ShiftData.prototype.addTips = function(i_ShiftWaiterData)
    {
        var perHourToAdd = this.m_TipsToExclude / this.m_TotalHours;
        this.m_MoneyPerHourAfterInclusion = (perHourToAdd + parseFloat(this.m_MoneyPerHour)).toFixed(2);

        for (i = 0; i < i_ShiftWaiterData.length; i++)
        {
            i_ShiftWaiterData[i].EarnedInShift += i_ShiftWaiterData[i].Hours * perHourToAdd;
        }
    };

    ShiftData.prototype.GetTotalAllowance = function(i_TipsAfterTax)
    {
        return (i_TipsAfterTax * this.m_AllowancePercent).toFixed(2);
    }
    ShiftData.prototype.DevideTipsAndGetResultArray = function(i_WaitersHoursArray, i_MoneyPerHour)
    {
        var shiftWaitersData = [];
        for (i = 0; i < i_WaitersHoursArray.length; i++)
        {
            shiftWaitersData[i] = {
                Id: i_WaitersHoursArray[i].Id,
                Name: i_WaitersHoursArray[i].Name,
                Hours: i_WaitersHoursArray[i].Hours,
                EarnedInShift: parseFloat(i_WaitersHoursArray[i].Hours * i_MoneyPerHour)
            };
        }

        return shiftWaitersData;
    };

    ShiftData.prototype.devideRemainder = function(i_ShiftWaiterData)
    {
        var remainder = 0;
        for (i = 0; i < i_ShiftWaiterData.length; i++)
        {
            remainder += i_ShiftWaiterData[i].EarnedInShift % 1;
            i_ShiftWaiterData[i].EarnedInShift = Math.floor(i_ShiftWaiterData[i].EarnedInShift);
        }

        remainder = Math.floor(remainder);
        for (j = 0; j < remainder; j++)
        {
            var waiterIndexToAdd = j % i_ShiftWaiterData.length;
            i_ShiftWaiterData[waiterIndexToAdd].EarnedInShift++;
        }
    };

    ShiftData.prototype.TipsToExclude = function()
    {
        return this.m_TotalTipsAmount * this.m_TipsPercentToExclude / 100;
    };
}


function ShiftDataWithTipsPercent(i_BasicShiftData,
    i_TipsPercentToExclude)
{
    ShiftData.call(this, i_BasicShiftData);
    this.m_TipsPercentToExclude = i_TipsPercentToExclude;
}
ShiftDataWithTipsPercent.prototype = Object.create(ShiftData.prototype);
ShiftDataWithTipsPercent.prototype.TipsPercentToExclude = function()
{
    return this.m_TipsPercentToExclude;
};
ShiftDataWithTipsPercent.prototype.TipsToExclude = function()
{
    return (this.TipsPercentToExclude()) / 100 * this.m_TotalTipsAmount;
};


function ShiftDataWithSpecificAllowance(i_BasicShiftData,
    i_SpecificAllowance)
{
    ShiftDataWithTipsPercent.call(this, i_BasicShiftData, 0);
    var tipsPercentToExclude;
    if (i_SpecificAllowance === 0)
    {
        tipsPercentToExclude = 0;
    }
    else
    {
        tipsPercentToExclude = (((i_SpecificAllowance / this.m_AllowancePercent) - this.m_TotalTipsAmount +
                this.TaxReduction()) /
            -this.m_TotalTipsAmount) * 100;
    }
    this.m_TipsPercentToExclude = (tipsPercentToExclude).toFixed(2);

}
ShiftDataWithSpecificAllowance.prototype = Object.create(ShiftDataWithTipsPercent.prototype);

function ShiftDataFactory()
{}
ShiftDataFactory.GetInstance = function(i_BasicShiftData, opts)
{
    if (opts)
    {
        if (opts[0] == 'percent')
        {
            var tipsPercentToExclude = opts[1];
            return new ShiftDataWithTipsPercent(i_BasicShiftData,
                tipsPercentToExclude);
        }
        else if (opts[0] == 'allowance')
        {
            var specificAllowance = opts[1];
            return new ShiftDataWithSpecificAllowance(i_BasicShiftData,
                specificAllowance);
        }
        else
        {
            throw "Option is not valid";
        }
    }
    else
    {
        return new ShiftData(i_BasicShiftData);
    }
};