<html>
<head>
    <title>
        Work Log
    </title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" type="text/css" href="index.css">
    <script src="jquery-1.12.3.min.js"> </script>
    <script src="index.js"> </script>
</head>
<body>
@if (count($errors) > 0)
    @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
    @endforeach
@endif
<div id='menu'>
    <input type='button' class="textButton menuButton" value='[ - ]'/>
    <input type='button' class="textButton menuButton" value='[ Routine ]'/>
    <input type='button' class="textButton menuButton" value='[ Incident ]'/>
    <input type='button' class="textButton menuButton" value='[ Tag ]'/>
</div>

<div id='newTag' class='form'>  
    <form method="POST" action="/work-log/public/tag/type">
        {{ csrf_field() }}
        <input name="tagTypeName" type='text'/> 
        <input id="createTag" type='submit' value='Create Tag' />
    </form>
@foreach ($tag_types as $tag_type)
    <div style='clear:both;'>
        <form method="POST" action="/work-log/public/tag/type/{{ $tag_type->id }}" class="deleteForm">
            {{ csrf_field() }}
           {{ method_field('DELETE') }}
           <input type='submit' value='X' />
        </form> 
    {{ $tag_type->name }}
    </div>
@endforeach
</div>

<div id='newIncident' class='form'>
    <form method="POST" action="/work-log/public/incident">
    {{ csrf_field() }}
    <div> 
        <input id='nowRadio1' name='incidentWhen' type='radio' value='now' checked/>
        Now.
    </div>
    <div>
        <input id='timestampRadio1' name='incidentWhen' type='radio' value='timestamp'/>
        <select id='month1' class='timeSelector1' name="month" ><select>
        <select id='day1' class='timeSelector1' name="day"></select>
        <select id='year1' class='timeSelector1' name="year"></select>
        <select id='hour1' class='timeSelector1' name="hour"></select>
        <select id='minute1' class='timeSelector1' name="minute"></select>
    </div>
        <textarea id='report' name='report' maxlength="21000" style='height:100px;width:400px;'></textarea> 
        <input id='createIncident' type='submit'  value='Create Incident'/>
    </form>
</div>
<div id='newRoutine' class='form' >
    <div id="newRoutineContainer">
        <form method="POST" action="/work-log/public/routine/type">
        <input type='button' id="showNewRoutine" class='textButton' value='[ + ]' />
        <input type='button' id="hideNewRoutine" class='textButton newRoutine' value='[ - ]' />
            {{ csrf_field() }}
            <input id="newRoutineType" name="newRoutineType" class="newRoutine" type='text' />
            <input id="createNewRoutine" class="newRoutine" type='submit' value='New Routine' />
        </form>
    </div>
@if (count($routine_types)>0)
    <div> 
        <input  id='nowRadio2' name='routineWhen' type='radio' value='now' checked/>
        Now.
    </div>
    <div>
        <input id='timestampRadio2' name='routineWhen' type='radio' value='timestamp'/>
        <select id='month2' class='timeSelector2' name="month" ><select>
        <select id='day2' class='timeSelector2' name="day"></select>
        <select id='year2' class='timeSelector2' name="year"></select>
        <select id='hour2' class='timeSelector2' name="hour"></select>
        <select id='minute2' class='timeSelector2' name="minute"></select>
    </div>
    @foreach($routine_types as $routine_type)
        <div class='routineTypes'>
            <form method="POST" action="/work-log/public/routine/type/{{ $routine_type->id }}" class='deleteRoutineTypeForm'>
                {{ csrf_field() }}
                {{ method_field('DELETE') }}
                <input type='submit' value='X' /> 
            </form>
            <input id="routineType{{ $routine_type->id }}" type='button' 
              class='textButton logRoutine' value='{{ $routine_type->name }}' />   
        </div>      
    @endforeach 
@endif
</div>

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
        <a name='entry{{ $log_entry->id }}'></a>
        <form method="POST" action="/work-log/public/log/{{ $log_entry->id }}" class='deleteLogForm'>
            {{ csrf_field() }}
            {{  method_field("DELETE") }}
            <input type='hidden' name='logEntryID' value='{{$log_entry->id}}' />
            <input type='submit' value="X" />
        </form>
        @if ($log_entry->routine_id!=0 && $log_entry->incident_id==0)
        <div class='logRoutine'>
            {{ $log_entry -> routine-> type ->name}} 
        </div>
        <div class='activeRoutineTagList'>
            @foreach ($tags as $tag)
                @if ($tag->routine_id == $log_entry->routine->id)
                    <span class='tags'>
                        <form method="POST" action='/work-log/public/tag/{{ $tag->id }}' class='deleteTagForm'>
                            {{ csrf_field() }}
                            {{ method_field("DELETE") }}
                            <input type='hidden' name='logEntryID' value='{{$log_entry->id}}' />
                            <input type='submit' class='textButton tagDeleteButton' value='x' />
                        </form>
                        <div class='tagName'>
                            {{ $tag->type->name }}
                        </div>
                    </span>
                @endif
            @endforeach
        <div class="newTagMenu" style='clear:both;'>
        <input type='button' id='showNewRoutineTags{{ $log_entry->routine_id }}' 
          class='textButton showNewRoutineTags' value='[ Add Tag ]'/>
        <input type='button' id='hideNewRoutineTags{{ $log_entry->routine_id }}' 
          class='textButton hideNewRoutineTags' value='[ - ]' />
        </div> 
        </div>
        <div id='newRoutineTags{{ $log_entry->routine_id }}' class='newTagList'>

            @foreach ($tag_types as $tag_type)
            <form class='newTagForm' method="POST" action="/work-log/public/tag">
                {{ csrf_field () }}         
                <input type='hidden' name='newTagType' value='{{ $tag_type->id }}' />
                <input type='hidden' name='incidentID' value='0' />
                <input type='hidden' name='routineID' value='{{ $log_entry->routine_id }}' />
                <input type='hidden' name='logEntryID' value='{{$log_entry->id}}' />
                <input type='submit' class='textButton' value='{{ $tag_type->name }}' />
            </form> 
            @endforeach
        </div>
        @elseif ($log_entry->routine_id==0 && $log_entry->incident_id!=0)
        <div class='logIncidentTitle'>Incident Report  </div> 
       <div class='logIncident'>
            <div class='incidentCreatedAt'>
                Created {{$log_entry->created_at}}
            </div>
            <div class='incidentReport'>
                {{ $log_entry -> incident -> report }} 
            </div>
        </div>
        <div class='activeIncidentTagList'>
            @foreach ($tags as $tag)
                @if ($tag->incident_id == $log_entry->incident->id)
                    <div class='tags'>
                        <form method="POST" action='/work-log/public/tag/{{ $tag->id }}' class='deleteTagForm'>
                            {{ csrf_field() }}
                            {{ method_field("DELETE") }}
                            <input type='hidden' name='logEntryID' value='{{$log_entry->id}}' />
                            <input type='submit' class='textButton tagDeleteButton' value='x' />
                        </form>
                        <div class='tagName'>
                            {{ $tag->type->name }}
                        </div>
                    </div>
                @endif
            @endforeach
        </div> 
        <div class="newTagMenu" style='clear:both;'>
        <input type='button' id='showNewIncidentTags{{ $log_entry->incident_id }}' 
          class='textButton showNewIncidentTags' value='[ Add Tag ]'/>
        <input type='button' id='hideNewIncidentTags{{ $log_entry->incident_id }}' 
          class='textButton hideNewIncidentTags' value='[ - ]' />
        </div>
        <div id='newIncidentTags{{ $log_entry->incident_id }}' class='newTagList'>
            @foreach ($tag_types as $tag_type)
            <form class='newTagForm' method="POST" action="/work-log/public/tag">
                {{ csrf_field () }}         
                <input type='hidden' name='newTagType' value='{{ $tag_type->id }}' />
                <input type='hidden' name='incidentID' value='{{ $log_entry->incident_id }}' />
                <input type='hidden' name='routineID' value='0' />
                <input type='hidden' name='logEntryID' value='{{$log_entry->id}}' />
                <input type='submit' class='textButton' value='{{ $tag_type->name }}' />
            </form> 
            @endforeach
        </div>
        @endif
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
    if (event.target.value=="[ Routine ]"){
        $("#newRoutine").show();
    } else if (event.target.value=="[ Incident ]"){
        $("#newIncident").show();
    } else if (event.target.value=="[ Tag ]"){
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
