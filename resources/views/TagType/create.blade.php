
    <form method="POST" action="{{ route('TagType.store') }}">
        {{ csrf_field() }}
        <input name="tagTypeName" type='text' class='form-control'/> 
        <button id="createTag" type='submit' class='btn btn-success'>
            Create Tag
        </button>
    </form>

