<div>
    <form >
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if(session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif
        @csrf
        <div class="form-group" style='text-align:left'>
            <label for="intake">Intake: </label>
        <!-- 1. choose intake -->
        <select  style = "width: 500px; color:black; border:#E4B7A0" wire:model= 'selectedIntake' id="intake" name="intake" type="text" class="form-control ">
        <option value="" selected>Select Intake</option>  
        @foreach ($intakes as $value) 
        <option value= "{{$value}}">{{$value}}</option>
        @endforeach   
        </select> <br>
        <!-- 2. choose year -->
        @if(!is_null($years))
        <label for="intake">Year: </label>
        <select  style = "width: 500px; color:black; border:#E4B7A0" wire:model= 'selectedYear' id="year"  name="year" type="text" class="form-control ">
        <option value="" selected>Select Year</option>  
        @foreach ($years as $value) 
        <option value= "{{$value}}">{{$value}}</option>
        @endforeach   
        </select> <br>
        @endif
        <!-- 3. choose semester -->
        @if(!is_null($sem))
        <label for="sem">Semester: </label>
        <select style = "width: 500px;" wire:model= 'selectedSem' style="color:black; border:#E4B7A0" name="semester" type="text" class="form-control ">
        <option  value="" selected="true">Select Semester</option>
        @foreach ($sem as $value) 
        <option value= "{{$value}}">{{$value}}</option>
        @endforeach  
        </select>
        @endif
		</div>
	</form>
</div>