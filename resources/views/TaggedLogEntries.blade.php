
<html>
<head>
    <title>
        Work Log
    </title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" type="text/css" href="index.css">
    <script src="jquery-1.12.3.min.js"> </script>
    <script src="index.js"> </script>
    <style>
    .form {
        display:none;
    }
    </style>
</head>
<body>
<div id='menu'>
    <a href="{{ route('today') }}">[ Home ]</a>
    <a href="{{ route('yesterday') }}">[ Yesterday ]</a>
    <a href="{{ route('log.index') }}">[ All Entries ]</a>
</div>
<div style="clear:both;margin-top:16px;">
<?php $old_date=0; ?>
@foreach ($tag_types as $tag_type)
<h1>
        {{$tag_type->name}}
</h1>

    @foreach ($tag_type->tag as $tag)
    
        @if ($tag->log_entries->routine_id!=0)
            <?php $when = date("m/d/y", strtotime($tag->log_entries->routine->when)) ?>
            @if ($when != $old_date)
                <h2 style='text-align:center;'>
                    {{ $when }}
                </h2>
                <?php $old_date = $when ?>
            @endif
            <div style='font-weight:bold;'>
                {{date("H:i", strtotime($tag->log_entries->routine->when)) }}
            </div>
            <div style='margin-bottom:16px;color:gray;'>
                {{ $tag->log_entries->routine->type->name }}
            </div>
        @elseif ($tag->log_entries->incident_id!=0)
            <?php $when = date("m/d/y", strtotime($tag->log_entries->incident->when)) ?>
            @if ($when != $old_date)
                <h2 style='text-align:center;'>
                    {{ $when }}
                </h2>
                <?php $old_date = $when ?>
            @endif
            <div style='font-weight:bold;'>
                {{date("H:i", strtotime($tag->log_entries->incident->when)) }}
            </div>
            <div style='margin-bottom:16px;background-color:lightgrey;'>
                {!! nl2br($tag->log_entries->incident->report) !!}
            </div>
        @else
        @endif
    @endforeach
@endforeach
</div>
</body>
</html>
