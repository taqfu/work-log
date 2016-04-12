<html>
<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" type="text/css" href="index.css">
    <script src="https://code.jquery.com/jquery-1.12.3.min.js"> </script>
    <script src="index.js"> </script>
</head>
<body>
<div id='menu'>
    <span class="textButton menuButton">[ - ]</span>
    <span class="textButton menuButton">[ Routine ]</span>
    <span class="textButton menuButton">[ Incident ]</span>
    <span class="textButton menuButton">[ Tag ]</span>
</div>

<div id='newRoutine' class='form' >
    <div id="newRoutineContainer">
        <form method="POST" action="/work-log/public/routine/type">
        <span id="showNewRoutine" class='textButton'>[ + ]</span>
        <span id="hideNewRoutine" class='textButton newRoutine'>[ - ]</span>
            {{ csrf_field() }}
            <input id="newRoutineType" name="newRoutineType" class="newRoutine" type='text' />
            <input id="createNewRoutine" class="newRoutine" type='submit' value='New Routine' />
        </form>
    </div>
</div>
@if (count($routine_types)>0)
    <div> 
        <input name='routineWhen' type='radio' value='now' checked/>
        Now.
    </div>
    <div>
        <input name='routineWhen'type='radio' value='timestamp'/>
        <select id='month2' name="month" ><select>
        <select id='day2' name="day"></select>
        <select id='year2' name="year"></select>
        <select id='hour2' name="hour"></select>
        <select id='minute2' name="minute"></select>
    </div>
    @foreach($routine_types as $routine_type)
        <div class='routine_types'>
            <form method="POST" action="/work-log/public/routine/type/{{ $routine_type->id }}" class='deleteForm'>
                {{ csrf_field() }}
                {{ method_field('DELETE') }}
                <input type='submit' value='X' /> 
            </form>
            <input id="routineType{{ $routine_type->id }}" type='button' 
              class='textButton logRoutine' value='{{ $routine_type->name }}' />   
        </div>      
    @endforeach 
@endif

<div style="clear:both;margin-top:16px;">
<?php
    $old_date = 0;
    $old_time = 0;
?>
@foreach ($log_entries as $log_entry)
    <?php
        $date = date("m/d/y", strtotime($log_entry->when));
        $time = date("H:i", strtotime($log_entry->when));
    ?>
    @if ($old_date!=$date)
        <h1>{{ $date }}</h1>
        <?php $old_date = $date; ?>
    @endif
    @if ($old_time!=$time)
        <h2>{{ $time }}</h2>
        <?php $old_time = $time; ?>
    @endif
    <div class='logEntry'>
        <form method="POST" action="/work-log/public/log_entry/{{ $log_entry->id }}" class='deleteForm'>
            {{ csrf_field() }}
            {{  method_field("DELETE") }}
            <input type='submit' value="X" />
        </form>
        <div class='logRoutine'>
            {{ $log_entry }} 
        </div>
    </div>
@endforeach
</div>
</html>
<script>
for (num=1;num<=2;num++){
    $("#month" + num).html(fetchMonthOptions());
    $("#day" + num).html(fetchDayOptions());
    $("#year" + num).html(fetchYearOptions());
    $("#hour" + num).html(fetchHourOptions(true));
    $("#minute" + num).html(fetchMinuteOptions(true));
}
$(".menuButton").click(function(event){
    $(".form").hide();
    if (event.target.innerText=="[ Routine ]"){
        $("#newRoutine").show();
    } else if (event.target.innerText=="[ Incident ]"){
        $("#newIncident").show();
    } else if (event.target.innerText=="[ Tag ]"){
        $("#newTag").show();
    }
});
$("#hideNewRoutine").click(function(event){
    $("#showNewRoutine").show();
    $(".newRoutine").hide();
});
$("#showNewRoutine").click(function(event){
    $("#showNewRoutine").hide();
    $(".newRoutine").show();
});
function fetchDayOptions(){
    d = new Date();
    currentDay = d.getDate();
    
    var string = "";
    for (day=1;day<32;day++){
        dayValue = day<10
          ? "0" + day
          : day;
        selected = (day === currentDay)
          ? "selected"
          : "";
        string = string + "<option " + selected + " value='" + dayValue + "'>" + day + "</option>";
    }
    return string;
}
function fetchHourOptions(clock){
    var string = "";
    d = new Date();
    currentHour = d.getHours();
    if (clock===true){
        start=0;
    } else if (clock===false){
        start=1;
    }   
    for (hour=start;hour<24;hour++){
        selected = hour === currentHour
          ? "selected"
          : "";
        if (clock && hour<10){
            hour = "0"+hour;
        }
        string = string + "<option " + selected + " value='"+hour+"'>" + hour + "</option>";
    }
    return string;
}
function fetchMinuteOptions(clock){
    d = new Date();
    currentMinute = d. getMinutes();
    var string = "";
    if (clock===true){
        start=0;
    } else if (clock===false){
        start=1;
    }
    for (minute=start;minute<60;minute++){
        selected = (clock && minute === currentMinute)
          ? "selected"
          : "";
        if (clock && minute<10){
            minute = "0" + minute;
        }
        string = string + "<option " +  selected + " value='"+minute+"'>" + minute + "</option>";
    }
    return string;
}
function fetchMonthOptions(){
    string = "";
    var months = [ "January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
    d =new Date();
    currentMonth = d.getMonth();
    for (month=currentMonth-1;month<=currentMonth+1;month++){
        monthValue = month<10
          ? "0" + (month + 1)
          : (month + 1);
        selected = currentMonth===month
          ? "selected"
          : "";
        string = string + "<option " + selected + " value='" + monthValue + "'>" + months[month] + "</option>";          
    }
    return string;
}
function fetchYearOptions(){
    var string = "";
    d = new Date();
    year=d.getFullYear();
    string = "<option value='"+(year-1)+"'>" + (year-1) + "</option><option selected value='"+year+"'>" + year + "</option><option value='"+(year+1)+"'>" + (year+1) + "</option>";
    return string;
}
</script>
