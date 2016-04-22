
@foreach ($tag_types as $tag_type)
    <div style='clear:both;'>
        <form method="POST" action="{{ route('TagType.destroy', ['id'=>$tag_type->id]) }}" class="deleteForm">
           {{ csrf_field() }}
           {{ method_field('DELETE') }}
           <input type='submit' value='X' />
        </form> 
    <a href="{{ route('tag.index', ['id'=>$tag_type->id]) }}">
        {{ $tag_type->name }}
    </a>
    </div>
@endforeach
