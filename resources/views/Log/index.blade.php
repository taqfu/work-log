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
