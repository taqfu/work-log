
$(document.body).ready(function () {
    $("#incidentNow").prop("checked", true);
    $("#routineNow").prop("checked", true);
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
    $(document).on("click", ".menuButton", function (event) {
        $("#incidentNow").prop("checked", true);
        $("#routineNow").prop("checked", true);
    });
    $(document).on("click", ".logRoutine", function (event) {
        var id = event.target.id.substr(11, event.target.id.length-11);
        var name = $("#routineType"+id).val();
        var when = $("input[name=routineWhen]:checked").val();
        if (when==="now"){
            var timestamp="now";
        } else if (when==="timestamp"){
            var timestamp = $("#routineYear").val() + "-" + $("#routineMonth").val() + "-" + $("#routineDay").val() 
              + " " + $("#routineHour").val() + ":" + $("#routineMinute").val();
        }
        logRoutine(id,timestamp);
    });
    $(document).on("change", "select.incidentTimestamp", function(event){
        $("#incidentTimestamp").prop("checked", true);
    });
    $(document).on("change", "select.routineTimestamp", function(event){
        $("#routineTimestamp").prop("checked", true);
    });
    
    $(document).on("click", ".showNewTags", function (event) {
        $(".hideNewTags").hide();
        $(".showNewTags").show();
        $(".newTagList").html("");
        logEntryID = event.target.id.substr(11, event.target.id.length-11); 
        console.log($("#logEntryRoutineID"+logEntryID).val());
        $("#newTags"+logEntryID).html($("#tagForms").html());
        $("#newTags"+logEntryID).show();
        $("#showNewTags"+logEntryID).hide();
        $("#hideNewTags"+logEntryID).show();
        $("input[name='logEntryID']").val(logEntryID);
        $("input[name='routineID']").val($("#logEntryRoutineID"+logEntryID).val());
        $("input[name='incidentID']").val($("#logEntryIncidentID"+logEntryID).val());
    });
    $(document).on("click", ".hideNewTags", function (event) {
        logEntryID = event.target.id.substr(18, event.target.id.length-18); 
        $("#showNewTags"+logEntryID).show();
        $("#hideNewTags"+logEntryID).hide();
        $("#newTags"+logEntryID).hide();
    });
});


function logRoutine(id, timestamp){
    console.log(id, timestamp);
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        method: "POST",
        url: "/work-log/public/routine",
        //check just one side can suffice
        data:{id:id, timestamp:timestamp}
    })
        .done(function (result){
            console.log(result);
            location.reload();
        });
}
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
