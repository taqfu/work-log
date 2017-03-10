
@extends('master')
@section('content')
<?php
    $old_date = 0;
    $old_time = 0;
?>
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
            <h3 class=' row'>{{ $time }}</h3>
            <?php $old_time = $time; ?>
        @endif
        <div class='logEntry row'>
            <a name='entry{{ $log_entry->id }}'></a>
            <form method="POST" action="{{route('log.destroy', ['id'=>$log_entry->id])}}" class='deleteLogForm'>
                {{ csrf_field() }}
                {{  method_field("DELETE") }}
                <input type='hidden' name='logEntryID' value='{{$log_entry->id}}' />
                <button type='submit' class='btn btn-danger'>
                    x
                </button>
            </form>
            @if ($log_entry->routine_id!=0)
                <div class='logRoutine'>
                    {{ $log_entry -> routine-> type ->name}}
                </div>
                @include ("Tags")
            @elseif ($log_entry->incident_id!=0)

                <div class=''>
                    <div class='logIncidentTitle'>Incident Report  </div>
                    <div class='logIncident well'>
                        <div class='incidentCreatedAt'>
                            Created {{$log_entry->created_at}}
                        </div>
                        <div class='incidentReport'>
                            {!! nl2br($log_entry -> incident -> report) !!}
                        </div>
                    </div>
                    @include ("Tags")

                </div>

            @endif
        </div>
    @endforeach
@endsection
