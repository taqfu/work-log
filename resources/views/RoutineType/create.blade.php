        <form method="POST" action="{{ route('RoutineType.store') }}">
            {{ csrf_field() }}
            <input id="newRoutineType" name="newRoutineType" type='text' class='form-control'/>
            <button id="createNewRoutine" type='submit' class='btn btn-success'>
                New Routine
            </button>
        </form>
