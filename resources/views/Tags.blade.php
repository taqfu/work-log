
    
<div class='activeTagList'>
    <?php 
        if ($log_entry->routine_id!=0) {
            $tags = $log_entry->routine->tags;
        } else if ($log_entry->incident_id!=0){
            $tags = $log_entry->incident->tags;
        }
    ?>
    <div class='bg-info'>
        <button id='showNewTags{{ $log_entry->id }}' 
          class='showNewTags btn btn-primary pull-left'> 
            Add Tag
        </button>
        <button id='hideNewTags{{ $log_entry->id }}' 
          class='hideNewTags btn btn-primary hidden pull-left'>
            -
        </button>
        <input type='hidden' id='logEntryIncidentID{{ $log_entry->id }}' 
          value='{{ $log_entry->incident_id }}' />
        <input type='hidden' id='logEntryRoutineID{{ $log_entry->id }}' 
          value='{{ $log_entry->routine_id }}' />
        <ul class='nav nav-pills'>
        @foreach ($tags as $tag)
            <li class='tags'>
                <form method="POST" action="{{ route('tag.destroy', ['id'=>$tag->id])}}" class='deleteTagForm'>
                    {{ csrf_field() }}
                    {{ method_field("DELETE") }}
                    <input type='hidden' name='route' value="{{Route::getCurrentRoute()->getPath()}}">
                    <input type='hidden' name='logEntryID' value='{{$log_entry->id}}' />
                    <label>
                    <button type='submit' class='tagDeleteButton btn btn-danger'>
                        x
                    </button>
                    {{ $tag->type->name }}
                    </label>
                </form>
            </li>
        @endforeach
        </ul>
    </div>
</div>
<div id='newTags{{ $log_entry->id }}' class='newTagList'></div>


