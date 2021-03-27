@extends('layouts.app')
@section('botones')
    <a href={{route('recetas.create')}} class="btn btn-primary  mr-2 text-white ml-5">Crear Receta</a>
@endsection
@section('content')
    <h2 class="text-center mb-5">Administra tus Recetas</h5>
    <div class="col-md-10 mx-auto bg-white p-3">
        <table class="table">
            <thead class="bg-primary text-light">
                <tr>
                    <th scole="col">Título</th>
                    <th scole="col">Categoría</th>
                    <th scole="col">Acciones</th>
                </tr>
            </thead>
            <tbody>
            @foreach($userRecetas as $userReceta)
                <tr>
                    <td>{{$userReceta->nombre}}</td>
                    <td>{{$userReceta->categoriaReceta->nombre}}</td>
                    <td>
                    <a href="{{route('recetas.show',['receta'=>$userReceta->id])}}" class="btn btn-success d-block">Ver</a>
                    <a href="{{route('recetas.edit',['receta'=>$userReceta->id])}}" class="btn btn-dark d-block">Editar</a>
                    <eliminar-receta id-receta={{$userReceta->id}}></eliminar-receta>                    
                    </td>
                </tr>
             @endforeach
            </tbody>
        </table>
    </div>
@endsection
