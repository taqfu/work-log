<div class='activeRoutineTagList'>
    @foreach ($log_entry->routine->tags as $tag)
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
<input type='button' id='showNewRoutineTags{{ $log_entry->routine_id }}' 
  class='textButton showNewRoutineTags' value='[ Add Tag ]'/>
<input type='button' id='hideNewRoutineTags{{ $log_entry->routine_id }}' 
  class='textButton hideNewRoutineTags' value='[ - ]' />
</div> 
</div>
<div id='newRoutineTags{{ $log_entry->routine_id }}' class='newTagList'>
</div>

