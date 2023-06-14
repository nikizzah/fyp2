<div>
    <form >
        @csrf
        <div class="form-group" style='text-align:left'>
            <label for="intake">Intake: </label>
            <!-- 1. choose intake -->
            <select  style = "width: 500px;" wire:model= 'selectedIntake' id="intake" style="color:black; border:#E4B7A0" name="intake" type="text" class="form-control ">
            <option value="" selected>Select Intake</option>  
            @foreach ($intakes as $value) 
            <option value= "{{$value}}">{{$value}}</option>
            @endforeach   
            </select> <br>
            <!-- 2. choose year -->
            @if(!is_null($years))
            <label for="intake">Year: </label>
            <select  style = "width: 500px;" wire:model= 'selectedYear' id="year" style="color:black; border:#E4B7A0" name="year" type="text" class="form-control ">
            <option value="" selected>Select Year</option>  
            @foreach ($years as $value) 
            <option value= "{{$value}}">{{$value}}</option>
            @endforeach   
            </select> <br>
            @endif
        </div>  
	</form>
</div>