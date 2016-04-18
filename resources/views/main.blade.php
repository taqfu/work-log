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
<div id='menu'>
    <input type='button' class="textButton menuButton" value='[ - ]'/>
    <input type='button' class="textButton menuButton" value='[ Routine ]'/>
    <input type='button' class="textButton menuButton" value='[ Incident ]'/>
    <input type='button' class="textButton menuButton" value='[ Tag ]'/>
</div>

<div id='newTag' class='form'>  
@include ('TagType.create')
@include ('TagType.index')
</div>

<div id='newIncident' class='form'>
@include ('Incident.create')
</div>
<div id='newRoutine' class='form' >
@include ('RoutineType.create')
@include ('Routine.create')
</div>

<div style="clear:both;margin-top:16px;">
<?php
    $old_date = 0;
    $old_time = 0;
?>
<?php /*
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
*/?>
</div>
</html>
<script>
</script>
