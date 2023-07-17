<h1>{{ $modo }} empleado</h1>

@if(count($errors)>0)

<div class="alert alert-danger">
    @foreach($errors->all() as $error)
        <ul>
            <li>
                {{$error}}
            </li>
        </ul>
    @endforeach.
</div>

   
@endif


<div class="form-group">
    <label for="Name">Name:</label>
    <input type="text" class="form-control" name="Name" value="{{isset($empleado->Name)?$empleado->Name:old('Name')}}" id="Name">
</div>

<div class="form-group">
    <label for="LastName">LastName:</label>
    <input type="text" class="form-control" name="LastName" value="{{isset($empleado->LastName)?$empleado->LastName:old('LastName')}}" id="LastName">
</div>

<div class="form-group">
    <label for="Email">Email:</label>
    <input type="email" class="form-control" name="Email" value="{{isset($empleado->Email)?$empleado->Email:old('Email')}}" id="Email">
</div>

<div class="form-group">
    <label for="Photo"></label>
    @if(isset($empleado->Photo))
    <img  class="img-thumbnail img-fluid" src="{{asset('storage').'/'.$empleado->Photo}}" width="100" alt="">
    @endif
    <input type="file" class="form-control" name="Photo" value="" id="Photo"><br>
</div>

<input type="submit" class="btn btn-success" value="Save Data">
<a class="btn btn-primary" href="{{url('empleado')}}">Regresar</a>
