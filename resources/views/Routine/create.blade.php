@if (count($routine_types)>0)
    <div> 
        <input  id='routineNow' name='routineWhen' type='radio' value='now' checked/>
        Now.
    </div>
    <div class='margin-bottom'>
        <input id='routineTimestamp' name='routineWhen' type='radio' 
          value='timestamp'/>
        @include ("timestamps", ["timestamp_type"=>"routine"])
    </div>
    @foreach($routine_types as $routine_type)
        <div class='routineTypes'>
            <form method="POST" action="{{ route('RoutineType.destroy', ['id'=>$routine_type->id]) }}" 
              class='deleteRoutineTypeForm'>
                {{ csrf_field() }}
                {{ method_field('DELETE') }}
                <button type='submit' class='btn btn-danger'>
                    x
                </button> 
            </form>
            <button id="routineType{{ $routine_type->id }}"  
              class='logRoutine btn btn-info'>
                {{ $routine_type->name }}
            </button>   
        </div>      
    @endforeach 
@endif
