
<?php
    $last_routine=0;
    function format_interval($begin, $end){
    $begin = new DateTime($begin);
    if ($end == "now"){
        $end = new DateTime(date('y-m-d H:i:s'));
    } else {
        $end = new DateTime($end);
    }
    $interval = $end->diff($begin);
    $string="";
    $string = $interval->y>0 ? $string . $interval->y . "Y" : $string;
    $string = $interval->m>0 ? $string . $interval->m . "M" : $string;
    $string = $interval->d>0 ? $string . $interval->d . "D" : $string;
    $string = $interval->h>0 ? $string . $interval->h  : $string;
    $decimal_string = round($interval->i/60,1);

    $string = $string + substr($decimal_string, 1);
    return $string;

}
function interval($start, $end){
     return (int) DB::select("select unix_timestamp(?) - unix_timestamp(?)
      as output", [$end, $start])[0]->output;

}
?>

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
<table class="table table-bordered table-hover">
@foreach($routines as $routine)
    @if (is_object ($last_routine))
        @if ($routine->type_id==$last_routine->type_id )
            @if ($routine->type_id==2)
                <tr class='bg-danger'>
                    <td>
                        <strong>{{date('m/d/y D', strtotime($last_routine->when))}}</strong>
                    </td><td>
                        {{date('H:i', strtotime($last_routine->when))}}
                    </td><td>
                        INCOMPLETE
                    </td><td>
                    </td>
                    </tr>
            @elseif ($routine->type_id==12)
                <tr class='bg-danger'>
                    <td>
                        <strong>{{date('m/d/y D', strtotime($last_routine->when))}}</strong> -
                    </td><td>
                        INCOMPLETE -
                    </td><td>
                        {{date('H:i', strtotime($last_routine->when))}}
                    </td><td>
                    </td>

                </tr>
            @endif
        @elseif ($routine->type_id==2)
            <?php $interval=format_interval($routine->when, $last_routine->when); ?>
            @if ($interval>8.6)
                <tr class="bg-primary">
            @else
                <tr>
            @endif
            </td><td>
                    <strong>{{date('m/d/y D', strtotime($routine->when))}}</strong>
                </td><td>
                    {{date('H:i', strtotime($routine->when))}}
                </td><td>
                    {{date('H:i', strtotime($last_routine->when))}}
                 </td><td>
                    {{$interval}}h
                 </td>

            </tr>
        @endif
    @endif

    <?php $last_routine = $routine; ?>
@endforeach
</table>
</body></html>
