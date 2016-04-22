<html>
<head>
    <title>
        Work Log
    </title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" type="text/css" href="index.css">
    <script src="jquery-1.12.3.min.js"> </script>
    <script src="index.js"> </script>
    <style>
    .form {
        display:none;
    }
    </style>
</head>
<body>
<div id='menu'>
    <a href="{{ route('today') }}">[ Home ]</a>
    <input type='button' class="textButton menuButton" value='[ - ]'/>
    <input type='button' class="textButton menuButton" value='[ Routine ]'/>
    <input type='button' class="textButton menuButton" value='[ Incident ]'/>
    <input type='button' class="textButton menuButton" value='[ Tag ]'/>
    <a href="{{ route('yesterday') }}">[ Yesterday ]</a>
    <a href="{{ route('log.index') }}">[ All Entries ]</a>
</div>

<div id='tagForms' style='display:none;'>
    @foreach ($tag_types as $tag_type)
    <form class='newTagForm' method="POST" action="{{ route('tag.store') }}">
        {{ csrf_field () }}         
        <input type='hidden' name='route' value="{{Route::getCurrentRoute()->getPath()}}">
        <input type='hidden' name='newTagType' value='{{ $tag_type->id }}' />
        <input type='hidden' name='incidentID' />
        <input type='hidden' name='routineID'  />
        <input type='hidden' name='logEntryID' />
        <input type='submit' class='textButton' value='{{ $tag_type->name }}' />
    </form>
    <div class='tagSeparator'>/</div>
    @endforeach
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
@include ("Log.index")
</div>
</body>
</html>
