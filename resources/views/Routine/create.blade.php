@if (count($routine_types)>0)
    <div> 
        <input  id='routineNow' name='routineWhen' type='radio' value='now' checked/>
        Now.
    </div>
    <div>
        <input id='routineTimestamp' name='routineWhen' type='radio' value='timestamp'/>
        @include ("timestamps", ["timestamp_type"=>"routine"])
    </div>
    @foreach($routine_types as $routine_type)
        <div class='routineTypes'>
            <form method="POST" action="{{ route('RoutineType.destroy', ['id'=>$routine_type->id]) }}" 
              class='deleteRoutineTypeForm'>
                {{ csrf_field() }}
                {{ method_field('DELETE') }}
                <input type='submit' value='X' /> 
            </form>
            <input id="routineType{{ $routine_type->id }}" type='button' 
              class='textButton logRoutine' value='{{ $routine_type->name }}' />   
        </div>      
    @endforeach 
@endif
