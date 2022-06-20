<?php

namespace App\Http\Controllers;

use App\Models\Archivo;
use App\Models\Evento;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\Response;


class EventoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    { 
        
        $eventos = Evento::where('activo','=',1)->orderBy('fecha','desc')->paginate(3);
        return view('eventos.index',compact('eventos'));
    }

    public function indexAdmin()
    {
        $vsevento = Evento::where('activo','=',1)->get();
        $eventos = $this->cargarDT($vsevento);
        return view('eventos.indexAdmin',compact('eventos'));
    }
    public function cargarDT($consulta)
    {
        $evento = [];

        foreach ($consulta as $key => $value){

            $ruta = "eliminar".$value['id'];
            $eliminar = route('delete-evento', $value['id']);
            $actualizar =  route('eventos.edit', $value['id']);
         

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
                      <h5 class="modal-title" id="exampleModalLabel">¿Seguro que deseas eliminar este evento?</h5>
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

            $evento[$key] = array(
                $acciones,
                $value['id'],
                $value['titulo'],
                $value['fecha'],
                $value['descripcion'],
            );

        }

        return $evento;
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('eventos.create');
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
            'descripcion'=>'required',
            'fecha'=>'required',
            'image'=>'image|max:5120',

        ]);
        
        $evento = new Evento();
        $evento->titulo = $request->input('titulo');
        $evento->descripcion = $request->input('descripcion');

        $evento->fecha = $request->input('fecha');



        $image = $request->file('imagen');
        if($image){
           $image_path = time().$image->getClientOriginalName();
           \Storage::disk('images-eventos')->put($image_path, \File::get($image));
        
           $evento->image = $image_path;
        }
        $evento->save();

        $files = $request->file('files');

        if($files){
            foreach($files as $file){

                $archivo = new Archivo();
                // $archivo->evento_id = $evento->id;
                $file_path = time().$file->getClientOriginalName();
                \Storage::disk('files')->put($file_path, \File::get($file));
                $data[] = $file_path;
         
                $archivo->path = $file_path;
                $evento->archivos()->save($archivo);
                $evento->refresh();
            }
        }

        
        
        return redirect()->route('eventos.create')->with(array(
            'message'=>'El evento se guardó correctamente'
        ));
        // return $evento->archivos;
    }
    public function getImage($filename){
        $file = Storage::disk('images-eventos')->get($filename);
        return new Response($file, 200);
    }

    public function delete_evento($evento_id){
        $evento = Evento::find($evento_id);
        if($evento && Auth::user()->rol == 'admin'){
            $evento->activo = 0;
            $evento->update();
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
            return redirect()->route('eventos.indexAdmin')->with(array(
               "message" => "El evento se ha eliminado correctamente"
            ));
        }else{
            return redirect()->route('home')->with(array(
               "message" => "El evento que trata de eliminar no existe"
            ));
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Evento $evento)
    {
        $archivos = $evento->archivos()->where('activo',1)->get();
        return view('eventos.show',compact('evento','archivos'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $evento = Evento::find($id);
        $archivos = $evento->archivos()->where('activo',1)->get();
        return view('eventos.edit',compact('evento','archivos'));
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
            'fecha'=>'required',
            'image'=>'image|max:5120',
        ]);

        $evento = Evento::find($id);
        $evento->titulo = $request->input('titulo');
        $evento->descripcion = $request->input('descripcion');
        $evento->fecha = $request->input('fecha');


        $image = $request->file('imagen');
        if($image){
           $image_path = time().$image->getClientOriginalName();
           \Storage::disk('images-eventos')->put($image_path, \File::get($image));
        
           $evento->image = $image_path;
        }

        $files = $request->file('files');

        if($files){
            foreach($files as $file){

                $archivo = new Archivo();
                // $archivo->evento_id = $evento->id;
                $file_path = time().$file->getClientOriginalName();
                \Storage::disk('files')->put($file_path, \File::get($file));
                $data[] = $file_path;
         
                $archivo->path = $file_path;
                $evento->archivos()->save($archivo);
                $evento->refresh();
            }
        }

        

        $evento->update();
        return redirect()->route('eventos.indexAdmin')->with(array(
            'message'=>'El evento se actualizó correctamente'
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
