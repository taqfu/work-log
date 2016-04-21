<div class='activeRoutineTagList'>
    @foreach ($tags as $tag)
        @if ($tag->routine_id == $log_entry->routine->id)
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
        @endif
    @endforeach
<div class="newTagMenu" style='clear:both;'>
<input type='button' id='showNewRoutineTags{{ $log_entry->routine_id }}' 
  class='textButton showNewRoutineTags' value='[ Add Tag ]'/>
<input type='button' id='hideNewRoutineTags{{ $log_entry->routine_id }}' 
  class='textButton hideNewRoutineTags' value='[ - ]' />
</div> 
</div>
<div id='newRoutineTags{{ $log_entry->routine_id }}' class='newTagList'>
    @foreach ($tag_types as $tag_type)
    <form class='newTagForm' method="POST" action="{{ route('tag.store') }}">
        {{ csrf_field () }}         
        <input type='hidden' name='route' value="{{Route::getCurrentRoute()->getPath()}}">
        <input type='hidden' name='newTagType' value='{{ $tag_type->id }}' />
        <input type='hidden' name='incidentID' value='0' />
        <input type='hidden' name='routineID' value='{{ $log_entry->routine_id }}' />
        <input type='hidden' name='logEntryID' value='{{$log_entry->id}}' />
        <input type='submit' class='textButton' value='{{ $tag_type->name }}' />
    </form>
    <div class='tagSeparator'>/</div>
    @endforeach
</div>

