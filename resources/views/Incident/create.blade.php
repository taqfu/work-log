
    <form method="POST" action="{{ route('incident.store') }} ">
    {{ csrf_field() }}
    <div> 
        <input id='incidentNow' name='incidentWhen' type='radio' value='now' checked/>
        Now.
    </div>
    <div>
        <input id='incidentTimestamp' name='incidentWhen' type='radio' value='timestamp'/>
        @include ("timestamps", ["timestamp_type"=>"incident"])
    </div>
        <textarea id='report' name='report' maxlength="20000" ></textarea> 
        <input id='createIncident' type='submit'  value='Create Incident'/>
    </form>
