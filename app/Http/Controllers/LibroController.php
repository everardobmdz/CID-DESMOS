<?php

namespace App\Http\Controllers;

use App\Models\Archivo;
use App\Models\Publicacion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class LibroController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $libros = Publicacion::where('activo','=',1)->where('categoria','=',1)->orderBy('titulo','desc')->paginate(10);


        return view('libros.index',compact('libros'));
    }
    public function indexAdmin()
    {
        $vslibros = Publicacion::where('activo','=',1)->where('categoria','=',1)->get();
        $libros = $this->cargarDT($vslibros);
        return view('libros.indexAdmin',compact('libros'));
    }
    public function cargarDT($consulta)
    {
        $libro = [];

        foreach ($consulta as $key => $value){

            $ruta = "eliminar".$value['id'];
            $eliminar = route('delete-libro', $value['id']);
            $actualizar =  route('libros.edit', $value['id']);
         

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
                      <h5 class="modal-title" id="exampleModalLabel">¿Seguro que deseas eliminar este libro?</h5>
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

            $libro[$key] = array(
                $acciones,
                $value['id'],
                $value['titulo'],
                $value['descripcion'],
            );

        }

        return $libro;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('libros.create');
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
        ]);
        
        $libro = new Publicacion();
        $libro->titulo = $request->input('titulo');
        $libro->descripcion = $request->input('descripcion');
        $libro->categoria = 1;


        $libro->save();

        $files = $request->file('files');

        if($files){
            foreach($files as $file){

                $archivo = new Archivo();
                // $archivo->evento_id = $evento->id;
                $file_path = time().$file->getClientOriginalName();
                \Storage::disk('files')->put($file_path, \File::get($file));
                $data[] = $file_path;
         
                $archivo->path = $file_path;
                $libro->archivos()->save($archivo);
                $libro->refresh();
            }
        }

        return redirect()->route('libros.create')->with(array(
            'message'=>'El libro se guardó correctamente'
        ));
    }
    public function delete_evento($libro_id){
        $libro = Publicacion::find($libro_id);
        if($libro){
            $libro->activo = 0;
            $libro->update();
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
            return redirect()->route('libros.indexAdmin')->with(array(
               "message" => "El libro se ha eliminado correctamente"
            ));
        }else{
            return redirect()->route('home')->with(array(
               "message" => "El libro que trata de eliminar no existe"
            ));
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($libro_id)
    {
        $libro = Publicacion::where('categoria','=',1)->where("activo","=",1)->find($libro_id);
        $archivos = $libro->archivos()->where('activo',1)->get();
        return view('libros.show',compact('libro','archivos'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $libro = Publicacion::find($id);
        $archivos = $libro->archivos()->where('activo',1)->get();
        return view('libros.edit',compact('libro','archivos'));
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

        ]);

        $libro = Publicacion::find($id);
        $libro->titulo = $request->input('titulo');
        $libro->descripcion = $request->input('descripcion');
        $libro->categoria = 1;



        

        $libro->update();

        $files = $request->file('files');

        if($files){
            foreach($files as $file){

                $archivo = new Archivo();
                // $archivo->evento_id = $evento->id;
                $file_path = time().$file->getClientOriginalName();
                \Storage::disk('files')->put($file_path, \File::get($file));
                $data[] = $file_path;
         
                $archivo->path = $file_path;
                $libro->archivos()->save($archivo);
                $libro->refresh();
            }
        }

        return redirect()->route('libros.indexAdmin')->with(array(
            'message'=>'El libro se actualizó correctamente'
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
