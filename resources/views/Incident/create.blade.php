
    <form method="POST" action="{{ route('incident.store') }} ">
    {{ csrf_field() }}
    <div> 
        <input id='incidentNow' name='incidentWhen' type='radio' value='now' checked/>
        Now.
    </div>
    <div>
        <input id='incidentTimestamp' name='incidentWhen' type='radio' value='timestamp'/>
        <select id='month1' class='incidentTimestamp' name="month" ><select>
        <select id='day1' class='incidentTimestamp' name="day"></select>
        <select id='year1' class='incidentTimestamp' name="year"></select>
        <select id='hour1' class='incidentTimestamp' name="hour"></select>
        <select id='minute1' class='incidentTimestamp' name="minute"></select>
    </div>
        <textarea id='report' name='report' maxlength="20000" ></textarea> 
        <input id='createIncident' type='submit'  value='Create Incident'/>
    </form>
