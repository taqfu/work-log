
    <form method="POST" action="{{ route('TagType.store') }}">
        {{ csrf_field() }}
        <input name="tagTypeName" type='text'/> 
        <input id="createTag" type='submit' value='Create Tag' />
    </form>

