<?php

namespace App\Http\Controllers;

use App\Models\Evento;
use App\Models\Investigador;
use App\Models\Publicacion;
use App\Models\QuienesSomos;
use App\Models\Contacto;




use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $eventos = Evento::where('activo','=',1)->orderBy('fecha','DESC')->take(3)->get();
        $investigadores = Investigador::where('activo','=',1)->orderBy('apellido','asc')->take(3)->get();
        $divulgaciones = Publicacion::where('activo','=',1)->where('categoria','=',3)->orderBy('titulo','desc')->take(3)->get();
        $secciones = QuienesSomos::where('activo','=',1)->get();
        $contactos = Contacto::where('activo','=',1)->get();
        return view('welcome',['eventos'=>$eventos,'investigadores'=>$investigadores,'divulgaciones'=>$divulgaciones, 'secciones'=>$secciones, 'contactos'=>$contactos]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
