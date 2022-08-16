<?php

use App\Http\Controllers\ArchivoController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\InvestigadorController;
use App\Http\Controllers\EventoController;
use App\Http\Controllers\ArticuloController;
use App\Http\Controllers\BusquedaController;
use App\Http\Controllers\ContactoController;
use App\Http\Controllers\DivulgacionController;
use App\Http\Controllers\LibroController;
use App\Http\Controllers\PublicacionController;
use App\Http\Controllers\QuienesSomosController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WelcomeController;
use App\Models\Investigador;
use App\Models\Publicacion;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


// Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
//     return view('dashboard');
// })->name('dashboard');

Auth::routes();



Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/creditos',function() {
    return view('creditos');
})->name('creditos');

Route::get('/', function(){
    return view('welcome');
});

// Route::get('/investigadores',[InvestigadorController::class,'index']);
// Route::get('/investigadores',[InvestigadorController::class,'create']);
// Route::get('/investigadores/edit',[InvestigadorController::class,'edit']);



Route::get('/investigadores/indexAdmin',[InvestigadorController::class,'indexAdmin'])->name('investigadores.indexAdmin');
Route::get('/eventos/indexAdmin',[EventoController::class,'indexAdmin'])->name('eventos.indexAdmin');
Route::get('/libros/indexAdmin',[LibroController::class,'indexAdmin'])->name('libros.indexAdmin');
Route::get('/articulos/indexAdmin',[ArticuloController::class,'indexAdmin'])->name('articulos.indexAdmin');
Route::get('/divulgaciones/indexAdmin',[DivulgacionController::class,'indexAdmin'])->name('divulgaciones.indexAdmin');
Route::get('/quienes-somos/indexAdmin',[QuienesSomosController::class,'indexAdmin'])->name('quienes-somos.indexAdmin');
Route::get('/contactos/indexAdmin',[ContactoController::class,'indexAdmin'])->name('contactos.indexAdmin');
Route::get('/usuarios/indexAdmin',[UserController::class,'indexAdmin'])->name('usuarios.indexAdmin');



Route::get('/eventos',[EventoController::class,'index']);



Route::resource('investigadores', 'App\Http\Controllers\InvestigadorController');
Route::resource('/eventos','App\Http\Controllers\EventoController');
Route::resource('/','App\Http\Controllers\WelcomeController');
Route::resource('/libros',LibroController::class);
Route::resource('articulos',ArticuloController::class);
Route::resource('divulgaciones',DivulgacionController::class);
Route::resource('publicaciones',PublicacionController::class);
Route::resource('busqueda',BusquedaController::class);
Route::resource('quienes-somos',QuienesSomosController::class);
Route::resource('contactos',ContactoController::class);
Route::resource('archivos',ArchivoController::class);
Route::resource('usuarios',UserController::class);


Route::get('eventos/{evento}',[EventoController::class,'show'])->name('eventos.show'); 
Route::get('divulgaciones/{divulgacion}',[EventoController::class,'show'])->name('divulgaciones.show'); 
Route::get('investigadores/{investigador}',[InvestigadorController::class,'show'])->name('investigadores.show'); 
Route::get('libros/{libro}',[LibroController::class,'show'])->name('libros.show');
Route::get('articulos/{articulo}',[ArticuloController::class,'show'])->name('articulos.show'); 


Route::get('/images/investigadores/{filename}', array(
    'as' => 'images',
    'middleware' => 'auth',
    'uses' => 'App\Http\Controllers\InvestigadorController@getImage'
));

Route::get('/images/articulos/{filename}', array(
    'as' => 'images',
    'middleware' => 'auth',
    'uses' => 'App\Http\Controllers\ArticuloController@getImage'
));
Route::get('/images/eventos/{filename}', array(
    'as' => 'images',
    'middleware' => 'auth',
    'uses' => 'App\Http\Controllers\EventoController@getImage'
));
Route::get('/images/publicaciones/{filename}', array(
    'as' => 'images',
    'middleware' => 'auth',
    'uses' => 'App\Http\Controllers\ArticuloController@getImage'
));
Route::get('/delete-investigador/{investigador_id}', array(
    'as' => 'delete-investigador',
    'middleware' => 'auth',
    'uses' => 'App\Http\Controllers\InvestigadorController@delete_investigador'
));

Route::get('/delete-evento/{evento_id}', array(
    'as' => 'delete-evento',
    'middleware' => 'auth',
    'uses' => 'App\Http\Controllers\EventoController@delete_evento'
));
Route::get('/delete-libro/{libro_id}', array(
    'as' => 'delete-libro',
    'middleware' => 'auth',
    'uses' => 'App\Http\Controllers\LibroController@delete_libro'
));
Route::get('/delete-articulo/{articulo_id}', array(
    'as' => 'delete-articulo',
    'middleware' => 'auth',
    'uses' => 'App\Http\Controllers\ArticuloController@delete_articulo'
));
Route::get('/delete-divulgacion/{divulgacion_id}', array(
    'as' => 'delete-divulgacion',
    'middleware' => 'auth',
    'uses' => 'App\Http\Controllers\DivulgacionController@delete_divulgacion'
));
Route::get('/delete-quienes-somos/{quienes_somos_id}', array(
    'as' => 'delete-quienes-somos',
    'middleware' => 'auth',
    'uses' => 'App\Http\Controllers\QuienesSomosController@delete_seccion_quienes_somos'
));
Route::get('/delete-contacto/{contacto_id}', array(
    'as' => 'delete-contacto',
    'middleware' => 'auth',
    'uses' => 'App\Http\Controllers\ContactoController@delete_contacto'
));
Route::get('/delete-usuario/{usuario_id}', array(
    'as' => 'delete-usuario',
    'middleware' => 'auth',
    'uses' => 'App\Http\Controllers\UserController@delete_usuario'
));
Route::get('/delete-archivo/{archivo_id}', array(
    'as' => 'delete-archivo',
    'middleware' => 'auth',
    'uses' => 'App\Http\Controllers\ArchivoController@delete_archivo'
));
Route::get('/files/{filename}', array(
    'as' => 'files',
    'middleware' => 'auth',
    'uses' => 'App\Http\Controllers\ArchivoController@download'
));
