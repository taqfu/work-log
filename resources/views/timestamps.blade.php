<select id='{{ $timestamp_type }}Month' class='{{ $timestamp_type }}Timestamp' name="month" >

@for($month=1 ; $month<13 ; $month++)
    <?php
        $month_val = $month<10 ? "0".$month : $month;
    ?>
    @if ($month==date("n"))
        <option selected value='{{ $month_val }}' >
    @elseif ($month!=date("n"))
        <option value='{{ $month_val }}' >
    @endif
 {{ date("F",mktime(0, 0, 0, $month, 10)) }}</option> 
@endfor
</select>

<select id='{{ $timestamp_type }}Day' class='{{ $timestamp_type }}Timestamp' name="day">

@for($day=1 ; $day<32 ; $day++)
    <?php $day_val = $day<10 ? "0".$day : $day;?>
    @if ($day==date("j"))
        <option selected value='{{ $day_val }}' >
    @elseif ($day!=date("j"))
        <option value='{{ $day_val }}' >
    @endif
{{ $day }}</option
>@endfor

</select>

<select id='{{ $timestamp_type }}Year' class='{{ $timestamp_type }}Timestamp' name="year">

@for($year=date("Y")-1 ; $year<date("Y")+2 ; $year++)
    @if ($year==date("Y"))
        <option selected value='{{ $year }}' >
    @elseif ($year!=date("Y"))
        <option value='{{ $year }}' >    
    @endif
{{ $year }}</option>

@endfor

</select>

<select id='{{ $timestamp_type }}Hour' class='{{ $timestamp_type }}Timestamp' name="hour">

@for ($hour=0; $hour<24; $hour++)
    <?php $hour = $hour<10 ? "0".$hour : $hour; ?>
    @if ($hour==date("H"))
       <option selected value="{{$hour}}"> 
    @elseif ($hour!=date("H"))
       <option value="{{$hour}}"> 
    @endif
    {{ $hour }}</option>
@endfor

</select>

<select  id='{{ $timestamp_type }}Minute' class='{{ $timestamp_type }}Timestamp' name="minute">

@for ($minute=0; $minute<60; $minute++)
    <?php $minute = $minute<10 ? "0".$minute : $minute; ?>
    @if ($minute==date("i"))
       <option selected value="{{$minute}}"> 
    @elseif ($minute!=date("i"))
       <option value="{{$minute}}"> 
    @endif
    {{ $minute }}</option>
@endfor

</select>
