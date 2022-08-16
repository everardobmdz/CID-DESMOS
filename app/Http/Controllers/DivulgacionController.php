<?php

namespace App\Http\Controllers;

use App\Models\Archivo;
use App\Models\Evento;
use App\Models\Publicacion;;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\Response;

class DivulgacionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $divulgaciones = Publicacion::where("activo",'=',1)->where('categoria','=',3)->orderBy('fecha','desc')->paginate(9);
        return view('divulgaciones.index',compact('divulgaciones'));
    }
    public function indexAdmin()
    {
        $vsdivulgaciones = Publicacion::where("activo","=",1)->where("categoria","=",3)->get();
        $divulgaciones = $this->cargarDT($vsdivulgaciones);
        return view('divulgaciones.indexAdmin',compact('divulgaciones'));
    }
    public function cargarDT($consulta)
    {
        $divulgacion = [];

        foreach ($consulta as $key => $value){

            $ruta = "eliminar".$value['id'];
            $eliminar = route('delete-divulgacion', $value['id']);
            $actualizar =  route('divulgaciones.edit', $value['id']);
         

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
                      <h5 class="modal-title" id="exampleModalLabel">¿Seguro que deseas eliminar este post?</h5>
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

            $divulgacion[$key] = array(
                $acciones,
                $value['id'],
                $value['titulo'],
                $value['descripcion'],
                $value['link'],
            );

        }

        return $divulgacion;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('divulgaciones.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validateData = $this->validate($request,[
            'titulo'=>'required',
            'descripcion'=>'required',
            'fecha'=>'required'
        ]);

        $divulgacion = new Publicacion();

        $divulgacion->titulo = $request->input('titulo');
        $divulgacion->descripcion = $request->input('descripcion');
        $divulgacion->fecha = $request->input('fecha');
        $divulgacion->link = $request->input('link');
        $divulgacion->categoria = 3;

        $divulgacion->save();

        $files = $request->file('files');

        if($files){
            foreach($files as $file){

                $archivo = new Archivo();
                // $archivo->evento_id = $evento->id;
                $file_path = time().$file->getClientOriginalName();
                \Storage::disk('files')->put($file_path, \File::get($file));
                $data[] = $file_path;
                
         
                $archivo->path = $file_path;
                $divulgacion->archivos()->save($archivo);
                $divulgacion->refresh();
            }
        }

        return redirect()->route('divulgaciones.create')->with(array(
            'message'=>'El post se guardó correctamente'
        ));
    }
    public function delete_divulgacion($divulgacion_id){
        $divulgacion = Publicacion::find($divulgacion_id);
        if($divulgacion){
            $divulgacion->activo = 0;
            $divulgacion->update();
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
            return redirect()->route('divulgaciones.indexAdmin')->with(array(
               "message" => "El post se ha eliminado correctamente"
            ));
        }else{
            return redirect()->route('home')->with(array(
               "message" => "El post que trata de eliminar no existe"
            ));
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($divulgacion_id)
    {
        $divulgacion = Publicacion::where("activo","=",1)->where("categoria","=",3)->find($divulgacion_id);
        $archivos = $divulgacion->archivos()->where('activo',1)->get();
        return view('divulgaciones.show',compact('divulgacion','archivos'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $divulgacion = Publicacion::find($id);
        $archivos = $divulgacion->archivos()->where('activo',1)->get();
        return view('divulgaciones.edit',compact('divulgacion','archivos'));
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
            'descripcion'=>'required',
            'link'=>'required',
            'fecha'=>'required'
        ]);

        $divulgacion = Publicacion::find($id);


        $divulgacion->titulo = $request->input('titulo');
        $divulgacion->descripcion = $request->input('descripcion');
        $divulgacion->link = $request->input('link');
        $divulgacion->fecha = $request->input('fecha');
        $divulgacion->categoria = 3;

        $divulgacion->update();
        
        $files = $request->file('files');

        if($files){
            foreach($files as $file){

                $archivo = new Archivo();
                // $archivo->evento_id = $evento->id;
                $file_path = time().$file->getClientOriginalName();
                \Storage::disk('files')->put($file_path, \File::get($file));
                $data[] = $file_path;
                
         
                $archivo->path = $file_path;
                $divulgacion->archivos()->save($archivo);
                $divulgacion->refresh();
            }
        }

        return redirect()->route('divulgaciones.create')->with(array(
            'message'=>'El post se actualizó correctamente'
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
