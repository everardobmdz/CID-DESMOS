<?php

namespace App\Http\Controllers;

use App\Models\Archivo;
use App\Models\Publicacion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\Response;


class ArticuloController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $articulos = Publicacion::where('activo','=',1)->where('categoria','=',2)->orderBy('titulo','desc')->paginate(16);
        return view('articulos.index',compact('articulos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('articulos.create');
    }
    public function indexAdmin()
    {
        $vsarticulos = Publicacion::where('activo','=',1)->where('categoria','=',2)->get();
        $articulos = $this->cargarDT($vsarticulos);
        return view('articulos.indexAdmin',compact('articulos'));
    }
    public function cargarDT($consulta)
    {
        $articulo = [];

        foreach ($consulta as $key => $value){

            $ruta = "eliminar".$value['id'];
            $eliminar = route('delete-articulo', $value['id']);
            $actualizar =  route('articulos.edit', $value['id']);
         

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
                      <h5 class="modal-title" id="exampleModalLabel">¿Seguro que deseas eliminar este articulo?</h5>
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

            $articulo[$key] = array(
                $acciones,
                $value['id'],
                $value['titulo'],
                $value['descripcion'],
                $value['anio'],
            );

        }

        return $articulo;
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
        
        $articulo = new Publicacion();
        $articulo->titulo = $request->input('titulo');
        $articulo->descripcion = $request->input('descripcion');
        $articulo->anio = $request->input('anio');
        $articulo->categoria = 2;

        $image = $request->file('imagen');
        if($image){
           $image_path = time().$image->getClientOriginalName();
           \Storage::disk('images-publicaciones')->put($image_path, \File::get($image));
        
           $articulo->image = $image_path;
        }


        $articulo->save();

        $files = $request->file('files');

        if($files){
            foreach($files as $file){

                $archivo = new Archivo();
                // $archivo->evento_id = $evento->id;
                $file_path = time().$file->getClientOriginalName();
                \Storage::disk('files')->put($file_path, \File::get($file));
                $data[] = $file_path;
         
                $archivo->path = $file_path;
                $articulo->archivos()->save($archivo);
                $articulo->refresh();
            }
        }

        return redirect()->route('articulos.create')->with(array(
            'message'=>'El articulo se guardó correctamente'
        ));
    }
    public function delete_evento($articulo_id){
        $articulo = Publicacion::find($articulo_id);
        if($articulo){
            $articulo->activo = 0;
            $articulo->update();
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
            return redirect()->route('articulos.indexAdmin')->with(array(
               "message" => "El articulo se ha eliminado correctamente"
            ));
        }else{
            return redirect()->route('home')->with(array(
               "message" => "El articulo que trata de eliminar no existe"
            ));
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response2
     */
    public function show($articulo_id)
    {
        $articulo = Publicacion::where('categoria','=',2)->where("activo","=",1)->find($articulo_id);
        $archivos = $articulo->archivos()->where('activo',1)->get();
        return view('articulos.show',compact('articulo','archivos'));
    }

    public function getImage($filename){
        $file = Storage::disk('images-publicaciones')->get($filename);
        return new Response($file, 200);
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $articulo = Publicacion::find($id);
        $archivos = $articulo->archivos()->where('activo',1)->get();

        return view('articulos.edit',compact('articulo','archivos'));
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

        $articulo = Publicacion::find($id);
        $articulo->titulo = $request->input('titulo');
        $articulo->descripcion = $request->input('descripcion');
        $articulo->anio = $request->input('anio');
        $articulo->categoria = 2;

        $image = $request->file('imagen');
        if($image){
           $image_path = time().$image->getClientOriginalName();
           \Storage::disk('images-publicaciones')->put($image_path, \File::get($image));
        
           $articulo->image = $image_path;
        }


        

        $articulo->update();

        $files = $request->file('files');

        if($files){
            foreach($files as $file){

                $archivo = new Archivo();
                // $archivo->evento_id = $evento->id;
                $file_path = time().$file->getClientOriginalName();
                \Storage::disk('files')->put($file_path, \File::get($file));
                $data[] = $file_path;
         
                $archivo->path = $file_path;
                $articulo->archivos()->save($archivo);
                $articulo->refresh();
            }
        }

        return redirect()->route('articulos.indexAdmin')->with(array(
            'message'=>'El articulo se actualizó correctamente'
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
