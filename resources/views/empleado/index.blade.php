@extends('layouts.app')

@section('content')
<div class="container">

@if(Session::has('message'))
<div class="alert alert-primary alert-dismissible">
<strong>Mensaje</strong> {{Session::get('message')}}
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> 
</div>
@endif

<a href="{{url('empleado/create')}}" class="btn btn-success">Registrar nuevo empleado</a>
<br>
<br>
<table class="table table-light">
    <thead class="thead-light">
        <tr>
            <th>#</th>
            <th>Name</th>
            <th>LastName</th>
            <th>Email</th>
            <th>Photo</th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody>
            @foreach($empleados as $empleado)
            <tr>
                <td>{{$empleado->id}}</td>
                <td><img class="img-thumbnail img-fluid" src="{{asset('storage').'/'.$empleado->Photo}}" width="100" alt=""></td>
                <td>{{$empleado->Name}}</td>
                <td>{{$empleado->LastName}}</td>
                <td>{{$empleado->Email}}</td>
                <td>
                    <a href="{{url('/empleado/'.$empleado->id.'/edit')}}" class="btn btn-warning">Editar</a>
                    <form action="{{url('/empleado/'.$empleado->id)}}" class="d-inline" method="post">
                        @csrf
                        {{method_field('DELETE')}}
                        <input class="btn btn-danger" type="submit" onclick="return confirm('Do you want delete this user?')" value="Delete">
                    </form>
                </td>
            
            </tr>
            @endforeach
        </tbody>
</table>
{!! $empleados->links() !!}
</div>
@endSection