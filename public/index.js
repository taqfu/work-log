
$(document.body).ready(function () {
    $("#nowRadio1").prop("checked", true);
    $("#nowRadio2").prop("checked", true);
    $(document).on("click", ".menuButton", function (event) {
        $("#nowRadio1").prop("checked", true);
        $("#nowRadio2").prop("checked", true);
    });
    $(document).on("click", ".logRoutine", function (event) {
        var id = event.target.id.substr(11, event.target.id.length-11);
        var name = $("#routineType"+id).val();
        var when = $("input[name=routineWhen]:checked").val();
        if (when==="now"){
            var timestamp="now";
        } else if (when==="timestamp"){
            var timestamp = $("#year2").val() + "-" + $("#month2").val() + "-" + $("#day2").val() 
              + " " + $("#hour2").val() + ":" + $("#minute2").val();
        }
        logRoutine(id,timestamp);
    });
    $(document).on("change", ".timeSelector1", function(event){
        $("#timestampRadio1").prop("checked", true);
    });
    $(document).on("change", ".timeSelector2", function(event){
        $("#timestampRadio2").prop("checked", true);
    });
    
    $(document).on("click", ".showNewIncidentTags", function (event) {
        incidentID = event.target.id.substr(19, event.target.id.length-19); 
        $("#showNewIncidentTags"+incidentID).hide();
        $("#hideNewIncidentTags"+incidentID).show();
        $("#newIncidentTags"+incidentID).show();
    });
    $(document).on("click", ".hideNewIncidentTags", function (event) {
        incidentID = event.target.id.substr(19, event.target.id.length-19); 
        $("#showNewIncidentTags"+incidentID).show();
        $("#hideNewIncidentTags"+incidentID).hide();
        $("#newIncidentTags"+incidentID).hide();
    });
    $(document).on("click", ".showNewRoutineTags", function (event) {
        routineID = event.target.id.substr(18, event.target.id.length-18); 
        $("#showNewRoutineTags"+routineID).hide();
        $("#hideNewRoutineTags"+routineID).show();
        $("#newRoutineTags"+routineID).show();
    });
    $(document).on("click", ".hideNewRoutineTags", function (event) {
        routineID = event.target.id.substr(18, event.target.id.length-18); 
        $("#showNewRoutineTags"+routineID).show();
        $("#hideNewRoutineTags"+routineID).hide();
        $("#newRoutineTags"+routineID).hide();
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
