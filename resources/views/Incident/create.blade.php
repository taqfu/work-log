
    <form method="POST" action="{{ route('incident.store') }} ">
    {{ csrf_field() }}
    <div> 
        <input id='incidentNow' name='incidentWhen' type='radio' value='now' checked/>
        Now.
    </div>
    <div class='margin-bottom'>
        <input id='incidentTimestamp' name='incidentWhen' type='radio' value='timestamp'/>
        @include ("timestamps", ["timestamp_type"=>"incident"])
    </div>
        <textarea name='report' maxlength="20000" class='form-control'></textarea> 
        <button id='createIncident' type='submit' class='btn btn-success'>
            Create Incident
        </button>
    </form>
