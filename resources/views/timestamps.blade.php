<select id='' class='{{ $timestamp_type }}Timestamp' name="month" >

@for($month=1 ; $month<13 ; $month++)
    @if ($month<10)
        <option value='0{{ $month }}' > {{ date("F",mktime(0, 0, 0, $month, 10)) }}</option> 
    @elseif ($month>9)
        <option value='{{ $month }}' > {{ date("F",mktime(0, 0, 0, $month, 10)) }}</option> 
    @endif
@endfor

<select>

<select id='' class='{{ $timestamp_type }}Timestamp' name="day">

@for($day=1 ; $day<32 ; $day++)
    @if ($day<10)
        <option value='0{{ $day }}' >{{ $day }}</option>
    @elseif ($day>9)
        <option value='{{ $day }}' >{{ $day }}</option>
    @endif
@endfor

</select>

<select id='' class='{{ $timestamp_type }}Timestamp' name="year">

@for($year=date("Y")-1 ; $year<date("Y")+2 ; $year++)
    @if ($year<10)
        <option value='0{{ $year }}' >{{ $year }}</option>
    @elseif ($year>9)
        <option value='{{ $year }}' >{{ $year }}</option>
    @endif
@endfor

</select>

<select id='hour2' class='{{ $timestamp_type }}Timestamp' name="hour"></select>
<select id='minute2' class='{{ $timestamp_type }}Timestamp' name="minute"></select>

