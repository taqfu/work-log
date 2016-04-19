<div class='activeIncidentTagList'>
    @foreach ($tags as $tag)
        @if ($tag->incident_id == $log_entry->incident->id)
            <div class='tags'>
                <form method="POST" action="{{ route('tag.destroy', ['id'=>$tag->id]) }}" class='deleteTagForm'>
                    {{ csrf_field() }}
                    {{ method_field("DELETE") }}
                    <input type='hidden' name='logEntryID' value='{{$log_entry->id}}' />
                    <input type='submit' class='textButton tagDeleteButton' value='x' />
                </form>
                <div class='tagName'>
                    {{ $tag->type->name }}
                </div>
            </div>
        @endif
    @endforeach
</div> 
<div class="newTagMenu" style='clear:both;'>
<input type='button' id='showNewIncidentTags{{ $log_entry->incident_id }}' 
  class='textButton showNewIncidentTags' value='[ Add Tag ]'/>
<input type='button' id='hideNewIncidentTags{{ $log_entry->incident_id }}' 
  class='textButton hideNewIncidentTags' value='[ - ]' />
</div>
<div id='newIncidentTags{{ $log_entry->incident_id }}' class='newTagList'>
    @foreach ($tag_types as $tag_type)
    <form class='newTagForm' method="POST" action="{{ route('tag.store') }}">
        {{ csrf_field () }}         
        <input type='hidden' name='newTagType' value='{{ $tag_type->id }}' />
        <input type='hidden' name='incidentID' value='{{ $log_entry->incident_id }}' />
        <input type='hidden' name='routineID' value='0' />
        <input type='hidden' name='logEntryID' value='{{$log_entry->id}}' />
        <input type='submit' class='textButton' value='{{ $tag_type->name }}' />
    </form> 
    @endforeach
</div>
