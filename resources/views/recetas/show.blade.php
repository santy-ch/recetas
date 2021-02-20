@extends('layouts.app')
@section('content')
    {{--<h1>{{$receta}}</h1>--}}
    <article class="contenido-receta">
        <h1 class="text-center">{{$receta->nombre}}</h1>
        <div class="imagen-receta">
            <img src="/storage/{{$receta->imagen}}" >
        </div>
        <div class="receta-data">
            <p>
                <span class="font-weight-bold text-primary">Categoria: </span>{{$receta->categoriaReceta->nombre}}
            </p>
            <p>
                <span class="font-weight-bold text-primary">Autor: </span>{{$receta->autorReceta->name}}
            </p>
            <p>
                <span class="font-weight-bold text-primary">Fecha: </span>
                {{date('d-m-y', strtotime($receta->created_at))}}
            </p>
        </div>
        <div class="ingredientes">
            <h2 class="my-3 text-primary">Ingredientes</h2>
            {!!$receta->ingredientes!!}
        </div>
        <div class="preparacion">
            <h2 class="my-3 text-primary">Preparacion</h2>
            {!!$receta->preparacion!!}
        </div>
    </article>
@endsection