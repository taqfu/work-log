        <form method="POST" action="{{ route('RoutineType.store') }}">
            {{ csrf_field() }}
            <input id="newRoutineType" name="newRoutineType" type='text' />
            <input id="createNewRoutine" type='submit' value='New Routine' />
        </form>
