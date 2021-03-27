@extends('layouts.app')
@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-5">
        </div>
        <div class="col-md-7">
            <h2 class="text-center text-primary">{{$perfil->perfilUser->name}}</h2>
            <a href="{{$perfil->perfilUser->url}}">Visitar sitio web</a>
            <p>{{$perfil->perfilUser->email}}</p>
            <div class="biografia">
                {{$perfil->biografia}}
            </div>
        </div>
    </div>
</div>
    
@endsection