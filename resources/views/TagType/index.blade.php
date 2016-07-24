
@foreach ($tag_types as $tag_type)
    <div style='clear:both;'>
        <form method="POST" action="{{ route('TagType.destroy', ['id'=>$tag_type->id]) }}" class="deleteForm">
           {{ csrf_field() }}
           {{ method_field('DELETE') }}
           <button type='submit' class='btn btn-danger'>
                x
            </button>
        </form> 
    <a href="{{ route('TagType.index', ['id'=>$tag_type->id]) }}">
        {{ $tag_type->name }}
    </a>
    </div>
@endforeach
