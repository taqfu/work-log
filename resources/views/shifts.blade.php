<?php
    $yesterday=0;
?>
@foreach($routines as $routine)
    @if ($yesterday != date('m/d/y', strtotime($routine->when)))
        @if ($routine->type_id==2)
            <div>{{date('m/d/y H:i', strtotime($routine->when))}} - 
        @else
            <div>
        @endif
    @elseif ($yesterday == date('m/d/y', strtotime($routine->when)))

        @if ($routine->type_id==12)
            {{date('H:i', strtotime($routine->when))}}</div>
        @else
            </div>
        @endif

    @endif
   
    <?php $yesterday = date('m/d/y', strtotime($routine->when)); ?>
@endforeach
