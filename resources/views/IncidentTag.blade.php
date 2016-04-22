<div class='activeIncidentTagList'>
    @foreach ($log_entry->incident->tags as $tag)
            <div class='tags'>
                <form method="POST" action="{{ route('tag.destroy', ['id'=>$tag->id]) }}" class='deleteTagForm'>
                    {{ csrf_field() }}
                    {{ method_field("DELETE") }}
                    <input type='hidden' name='route' value="{{Route::getCurrentRoute()->getPath()}}">
                    <input type='hidden' name='logEntryID' value='{{$log_entry->id}}' />
                    <input type='submit' class='textButton tagDeleteButton' value='x' />
                </form>
                <div class='tagName'>
                    {{ $tag->type->name }}
                </div>
            </div>
    @endforeach
</div> 
<div class="newTagMenu" style='clear:both;'>
<input type='button' id='showNewIncidentTags{{ $log_entry->incident_id }}' 
  class='textButton showNewIncidentTags' value='[ Add Tag ]'/>
<input type='button' id='hideNewIncidentTags{{ $log_entry->incident_id }}' 
  class='textButton hideNewIncidentTags' value='[ - ]' />
</div>
<div id='newIncidentTags{{ $log_entry->incident_id }}' class='newTagList'>
</div>
