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
    <a href="{{ route('log.index') }}">[ All Entries ]</a>
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
