<?php

namespace App\Http\Controllers;

use App\Models\QuienesSomos;
use Illuminate\Http\Request;

class QuienesSomosController extends Controller
{
    public function index()
    {
        
        $secciones = QuienesSomos::where('activo','=',1)->get();
        return view('quienes-somos.index',compact('secciones'));
    }
    public function indexAdmin()
    {
        $vssecciones = QuienesSomos::where('activo','=',1)->get();
        $secciones = $this->cargarDT($vssecciones);
        return view('quienes-somos.indexAdmin',compact('secciones'));
    }
    public function cargarDT($consulta)
    {
        $seccion = [];

        foreach ($consulta as $key => $value){

            $ruta = "eliminar".$value['id'];
            $eliminar = route('delete-quienes-somos', $value['id']);
            $actualizar =  route('quienes-somos.edit', $value['id']);
         

            $acciones = '
                <div class="btn-acciones">
                    <div class="btn-circle">
                        <a href="'.$actualizar.'" role="button" class="btn btn-success" title="Actualizar">
                            <i class="far fa-edit"></i>
                        </a>
                        <a href="#'.$ruta.'" role="button" class="btn btn-danger" data-toggle="modal" title="Eliminar">
                            <i class="far fa-trash-alt"></i>
                        </a>
                    </div>
                </div>
                <div class="modal fade" id="'.$ruta.'" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">¿Seguro que deseas eliminar esta sección?</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      <p class="text-primary">
                        <small> 
                            '.$value['id'].'. '.$value['titulo'].'                 </small>
                      </p>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                      <a href="'.$eliminar.'" type="button" class="btn btn-danger">Eliminar</a>
                    </div>
                  </div>
                </div>
              </div>
            ';

            $seccion[$key] = array(
                $acciones,
                $value['id'],
                $value['titulo'],

            );

        }

        return $seccion;
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('quienes-somos.create');
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
        $validateData = $this->validate($request,[
            'titulo'=>'required',
            'contenido'=>'required',

        ]);

        $seccion = new QuienesSomos();
        $seccion->titulo = $request->input('titulo');
        $seccion->contenido = $request->input('contenido');
        $seccion->icono = $request->input('icono');

        

        $seccion->save();
        return redirect()->route('quienes-somos.create')->with(array(
            'message'=>'La sección se guardó correctamente'
        ));
    }


    public function delete_seccion_quienes_somos($quienes_somos_id){
        $seccion = QuienesSomos::find($quienes_somos_id);
        if($seccion){
            $seccion->activo = 0;
            $seccion->update();
	    // //
        //     $log = new Log();
        //     $log->tabla = "areas";
        //     $mov="";
        //     $mov=$mov." tipo_espacio:".$area->tipo_espacio ." sede:". $area->sede ." edificio" .$area->edificio;
        //     $mov=$mov." piso:".$area->piso ." division:". $area->division ." coordinacion" .$area->coordinacion;
        //     $mov=$mov." equipamiento:".$area->equipamiento ." area:". $area->area .".";
        //     $log->movimiento = $mov;
        //     $log->usuario_id = Auth::user()->id;
        //     $log->acciones = "Borrado";
        //     $log->save();
            //
            return redirect()->route('quienes-somos.indexAdmin')->with(array(
               "message" => "La sección se ha eliminado correctamente"
            ));
        }else{
            return redirect()->route('home')->with(array(
               "message" => "La sección que trata de eliminar no existe"
            ));
        }

    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $seccion = QuienesSomos::find($id);
        return view('quienes-somos.edit')->with('seccion', $seccion);
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
        $validateData = $this->validate($request,[
            'titulo'=>'required',
            'contenido'=>'required',

        ]);

        $seccion = QuienesSomos::find($id);
        $seccion->titulo = $request->input('titulo');
        $seccion->contenido = $request->input('contenido');
        $seccion->icono = $request->input('icono');

        

        $seccion->update();
        return redirect()->route('quienes-somos.indexAdmin')->with(array(
            'message'=>'La sección se actualizó correctamente'
        ));
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
    //
