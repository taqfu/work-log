<html>
<head>
    <title>
        Work Log
    </title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" type="text/css" href="index.css">
    <script src="jquery-1.12.3.min.js"> </script>
    <script src="index.js"> </script>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
    
    <!-- Optional theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css" integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r" crossorigin="anonymous">
    
    <!-- Latest compiled and minified JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
    <style>
    .form {
        display:none;
    }
    </style>
</head>
<body>
<ul class='nav nav-pills nav-justified page-nav-bar'>
    <li
      @if($period=="today")
          class='active'
      @endif
      >
        <a href="{{ route('today') }}">Today</a>
    </li>
    <li
      @if($period=="yesterday")
          class='active'
      @endif
      >
        <a href="{{ route('yesterday') }}">Yesterday</a>
    </li>
    <li
      @if($period=="all")
          class='active'
      @endif
      >
        <a href="{{ route('log.index') }}">All</a>
    </li>
    <li
      @if($period=="shifts")
          class='active'
      @endif
      >
        <a href="{{ route('shifts') }}">Shifts</a>
    </li>
</ul>
<ul class='nav nav-pills nav-justified margin-top-2 menu-nav-bar'>
    <li class='text-center'>
        <input type='button' class="textButton menuButton" value='Routine'/>
    </li>
    <li class='text-center'>
        <input type='button' class="textButton menuButton" value='Incident'/>
    </li>
    <li class='text-center'>
        <input type='button' class="textButton menuButton" value='Tag'/>
    </li>
    <li class='text-center'>
        <input type='button' class="textButton menuButton" value='Hide'/>
    </li>
</ul>
<div id='tagForms' style='display:none;'>
    @foreach ($tag_types as $tag_type)
    <form class='newTagForm' method="POST" action="{{ route('tag.store') }}">
        {{ csrf_field () }}         
        <input type='hidden' name='route' value="{{Route::getCurrentRoute()->getPath()}}">
        <input type='hidden' name='newTagType' value='{{ $tag_type->id }}' />
        <input type='hidden' name='incidentID' />
        <input type='hidden' name='routineID'  />
        <input type='hidden' name='logEntryID' />
        <button type='submit' class='btn btn-info'>
            {{ $tag_type->name }}
        </button>
    </form>
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
