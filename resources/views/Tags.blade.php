
    
<div class='activeTagList'>
    <?php 
        if ($log_entry->routine_id!=0) {
            $tags = $log_entry->routine->tags;
        } else if ($log_entry->incident_id!=0){
            $tags = $log_entry->incident->tags;
        }
    ?>
    @foreach ($tags as $tag)
        <span class='tags'>
            <form method="POST" action="{{ route('tag.destroy', ['id'=>$tag->id])}}" class='deleteTagForm'>
                {{ csrf_field() }}
                {{ method_field("DELETE") }}
                <input type='hidden' name='route' value="{{Route::getCurrentRoute()->getPath()}}">
                <input type='hidden' name='logEntryID' value='{{$log_entry->id}}' />
                <input type='submit' class='textButton tagDeleteButton' value='x' />
            </form>
            <div class='tagName'>
                {{ $tag->type->name }}
            </div>
        </span>
    @endforeach
    <div class="newTagMenu" style='clear:both;'>
        <input type='button' id='showNewTags{{ $log_entry->id }}' 
          class='textButton showNewTags' value='[ Add Tag ]'/>
        <input type='button' id='hideNewTags{{ $log_entry->id }}' 
          class='textButton hideNewTags' value='[ - ]' />
        <input type='hidden' id='logEntryIncidentID{{ $log_entry->id }}' value='{{ $log_entry->incident_id }}' />
        <input type='hidden' id='logEntryRoutineID{{ $log_entry->id }}' value='{{ $log_entry->routine_id }}' />
    </div> 
</div>
<div id='newTags{{ $log_entry->id }}' class='newTagList'></div>


