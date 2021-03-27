<?php

namespace App\Http\Controllers;

use App\Receta;
use App\Categoria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;

class RecetaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct(){
        $this->middleware('auth', ['except'=>'show']);
    }

    public function index()
    {
        $userRecetas=Auth::user()->userRecetas;

        return view('recetas.index')->with('userRecetas',$userRecetas);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //DB::table('categorias')->get()->dd();
        //obtener categorías sin modelo
        //$categorias=DB::table('categorias')->get()->pluck ('nombre', 'id')->dd();

        //obtener categorias con el modelo
        $categorias=Categoria::all(['id','nombre']);
        return view('recetas.create')->with('categorias',$categorias);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   
       // dd($request['imagen']->store('upload-recetas','public'));

        //Insertar en la BDD
        $data=$request->validate([
            'nombre'=>'required|min:6',
            'categoria'=>'required',
            'ingredientes'=>'required',
            'preparacion'=>'required',
            'imagen'=>'required|image'
        ]);

        $rutaImagen=$request['imagen']->store('upload-recetas','public');
       // $imgResize=Image::make(public_path("storage/{$rutaImagen}"))->resize(1000,500);
       // $imgResize->save();


        //almacenamos en la BDD sin modelo
        /*DB::table('recetas')->insert([ 
            'nombre'=>$data['nombre'],
            'ingredientes'=>$data['ingredientes'],
            'preparacion'=>$data['preparacion'],
            'imagen'=>$rutaImagen,
            'categoria_id'=>$data['categoria'],
            'user_id'=>Auth::user()->id

        ]);*/
        //dd($request->all()); 
        //Redireccionar

        //almacenamos con Modelo
        Auth::user()->userRecetas()->create([
            'nombre'=>$data['nombre'],
            'ingredientes'=>$data['ingredientes'],
            'preparacion'=>$data['preparacion'],
            'imagen'=>$rutaImagen,
            'categoria_id'=>$data['categoria'],
        ]);
        

        return redirect()->action('RecetaController@index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Receta  $receta
     * @return \Illuminate\Http\Response
     */
    public function show(Receta $receta)
    {
        return view('recetas.show')->with('receta', $receta);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Receta  $receta
     * @return \Illuminate\Http\Response
     */
    public function edit(Receta $receta)
    {
        $categorias=Categoria::all(['id','nombre']);

        return view('recetas.edit')->with('categorias',$categorias)
                                   ->with('receta', $receta);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Receta  $receta
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Receta $receta)
    {
        $this->authorize('update', $receta);
        $data=$request->validate([
            'nombre'=>'required|min:6',
            'categoria'=>'required',
            'ingredientes'=>'required',
            'preparacion'=>'required',
            
        ]);

        //asignar valores ya editados
        $receta->nombre=$data['nombre'];
        $receta->ingredientes=$data['ingredientes'];
        $receta->preparacion=$data['preparaacion'];
        $receta->categoria_id=$data['categoria'];

        //nueva imagen
        $rutaImagen=$request['imagen']->store('upload-recetas','public');
        $rutaImagen->save();
            $receta->imagen=$rutaImagen;

        $receta->save();
        return redirect()->action('RecetaController@index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Receta  $receta
     * @return \Illuminate\Http\Response
     */
    public function destroy(Receta $receta)
    {
        $this->authorize('delete', $receta);

        // metodo para eliminar
        $receta->delete();

        return redirect()->action('RecetaController@index');
    }
}
