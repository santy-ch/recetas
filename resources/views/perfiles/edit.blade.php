@extends('layouts.app')
@section('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/trix/1.3.1/trix.css" integrity="sha512-CWdvnJD7uGtuypLLe5rLU3eUAkbzBR3Bm1SFPEaRfvXXI2v2H5Y0057EMTzNuGGRIznt8+128QIDQ8RqmHbAdg==" crossorigin="anonymous" />
@endsection

@section('botones')
    <a href={{route('recetas.index')}} class="btn btn-primary  mr-2 text-white ml-5">Lista Recetas</a>
@endsection

@section('content')


<h1 class="text-center">editar perfil</h1>
<div class="row-justify-content-center mt-5">
    <div class="col-md-10">
        <form method="POST" action="{{route('perfiles.update', ['perfil'=>$perfil->id])}}" enctype="multipart/form-data">
            @csrf
            @method('put')
            <div class="form-group">
                <label for="nombre">Nombre</label>
                <input type="text" name="nombre" class="form-control @error('nombre')
                    is-invalid
                @enderror"  
                id="nombre" placeholder="Nombre Receta" value="{{$perfil->perfilUser->name}}">
                @error('nombre')
                    <span class="invalid-feedback d-block" role="alert"> 
                        <strong>{{$message}}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-group">
                <label for="url">Sitio Web</label>
                <input type="text" name="url" class="form-control @error('url')
                    is-invalid
                @enderror"  
                id="url" placeholder="Sitio Web" value="{{$perfil->perfilUser->url}}">
                @error('url')
                    <span class="invalid-feedback d-block" role="alert"> 
                        <strong>{{$message}}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-group">
                <label for="email">Correo electronico</label>
                <input type="text" name="email" class="form-control @error('email')
                    is-invalid
                @enderror"  
                id="email" placeholder="Correo electronico" value="{{$perfil->perfilUser->email}}">
                @error('email')
                    <span class="invalid-feedback d-block" role="alert"> 
                        <strong>{{$message}}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-group">
                <label for="biografia">Biografia</label>
                <input id=biografia type="hidden" name="biografia" value="{{$perfil->biografia}}">
                <trix-editor 
                class="form-control @error('biografia') is-invalid  @enderror"
                input="biografia"></trix-editor>
                @error('biografia')
                    <span class="invalid-feedback d-block" role="alert"> 
                        <strong>{{$message}}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-group">
                <label for="imagen">Imagen</label>
                <input id=imagen type="file" class="form-control @error('preparacion') is-invalid @enderror" name="imagen" >
                
                @if($perfil->imagen)
                    <div class="mt-4">
                        <p>Imagen actual</p>
                        {{--<img src="/storege/{{$receta->imagen}}" style="width: 400px">--}}
                    </div>
                @endif
                @error('imagen')
                    <span class="invalid-feedback d-block" role="alert"> 
                        <strong>{{$message}}</strong>
                    </span>
                @enderror
            </div> 
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Guardar cambios" />
            </div>

        </form>
    </div>
</div>

@endsection
<!--Scripts-->
@section('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/trix/1.3.1/trix.js" integrity="sha512-/1nVu72YEESEbcmhE/EvjH/RxTg62EKvYWLG3NdeZibTCuEtW5M4z3aypcvsoZw03FAopi94y04GhuqRU9p+CQ==" crossorigin="anonymous" defer></script>
@endsection