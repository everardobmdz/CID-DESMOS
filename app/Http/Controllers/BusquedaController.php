<?php

namespace App\Http\Controllers;

use App\Models\Evento;
use App\Models\Investigador;
use App\Models\Publicacion;
use Illuminate\Http\Request;
use ProtoneMedia\LaravelCrossEloquentSearch\Search;



class BusquedaController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function index(Request $request)
    {
        $busqueda = $request->get('search');
        $i = 0;
        $resultados = [];
        $resultadosBusqueda = Search::addMany([
            [Evento::class,['titulo','descripcion']],
            [Investigador::class,['nombre','apellido','grado']],
            [Publicacion::class,['titulo','descripcion']]
        ])
        ->beginWithWildcard()
        ->paginate()
        ->search($busqueda);

        foreach($resultadosBusqueda as $resultado){
            

            $id = $resultado->id;
            $titulo = class_basename($resultado) == 'Investigador' ? $resultado->grado.' '.$resultado->nombre.' '.$resultado->apellido : $resultado->titulo;
            $descripcion = class_basename($resultado) == 'Investigador' ? strip_tags($resultado->publicaciones) : strip_tags($resultado->descripcion);
            $descripcionforSubstr = strtolower($descripcion);
            $descripcionforSubstr = str_replace(
                array('á', 'é', 'í', 'ó', 'ú'),
                array('a', 'e', 'i', 'o', 'u'),
                $descripcionforSubstr
            );
            $busquedaReplace = str_replace(
                array('á', 'é', 'í', 'ó', 'ú'),
                array('a', 'e', 'i', 'o', 'u'),
                $busqueda
            );
            $busquedaReplace = strtolower($busquedaReplace);
            $keywordPos = strpos($descripcionforSubstr, $busquedaReplace);
            if($keywordPos > 0){
                $descripcionKeyword = '...'.substr($descripcionforSubstr,$keywordPos-50,50).'<b>'.substr($descripcionforSubstr,$keywordPos,strlen($busquedaReplace)).'</b>'.substr($descripcionforSubstr,($keywordPos+strlen($busquedaReplace)),50).'...';
            }elseif($keywordPos === 0){
                $descripcionKeyword = '<b>'.substr($descripcionforSubstr,$keywordPos,strlen($busquedaReplace)).'</b>'.substr($descripcionforSubstr,($keywordPos+strlen($busquedaReplace)),50).'...';
            }
            else{
                $descripcionKeyword = substr($descripcion,0,100).'...';
            }

            if(class_basename($resultado) == 'Investigador'){
                $route = 'investigadores.show';
            }elseif(class_basename($resultado) == 'Evento'){
                $route = 'eventos.show';
            }else{
                if($resultado->categoria == 3)
                    $route = 'divulgaciones.show';
                elseif($resultado->categoria == 2){
                    $route = 'articulos.show';
                }
                else{
                    $route = 'libros.show';
                }
            }

            $resultados[''.$i] = [
                'id'=>$id,
                'titulo'=>$titulo,
                'descripcion'=> $descripcionKeyword,
                'route'=> $route,
                'keywordpos'=>$keywordPos,

            ];

            $i++;

            
        }

        
        if($busqueda){

            return view('busqueda',compact('resultados','busqueda','resultadosBusqueda'));
        }else{
            return view('layouts.plantilla');
        }
        // return $resultados;
    }
}

