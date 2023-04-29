<?php

use App\Http\Controllers\PuestoController;
use Illuminate\Support\Facades\Route;



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

/////////////////////////////////session registro de empleados///////////////////////////////////////////////

Route::get('/', function () {
    return view('vista_empleados.vista_general');
});


Route::get('EmpleRegisters', function () {
    return view('vista_empleados.ConfirmRegister');
});

// Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//ruta para traer la vista
// Route::get('/login', function(){
//     return view('auth.login');
// });

////////////////////////////////////////sesion Recepcion//////////////////////////////////
Route::get('/login',[App\Http\Controllers\Auth\LoginController::class,'MostrarLogin'])->name('MostrarLogin')->middleware('guest');

//ruta para el loginAcceder
Route::post('/login', [App\Http\Controllers\Auth\LoginController::class,'login'])->name('login');

Route::post('/salir', [App\Http\Controllers\Auth\LoginController::class,'salir'])->name('salir');

Route::get('/dashboard',[App\Http\Controllers\Dashboard::class,'index'])->name('dashboard')->middleware('auth');

//probando modelos 

Route::get('emple', function(){
    return App\Models\Empleado::all();
})->middleware('auth');

////////////////////////////////////contenido empleados////////////////////////////////////////

// Route::get('/emple', function(){
//     return view('recept.empleados.empleados');
// });
Route::get( '/empleados', [App\Http\Controllers\EmpleadosController::class, 'index'])->name('empleados')->middleware('auth');
Route::post('/empleados', [App\Http\Controllers\EmpleadosController::class, 'buscar'])->name('empleados')->middleware('auth');
// Route::get('/empleados', function () {
//     return view('recept.empleados.empleados'); })->middleware('auth');
// Route::match(['get', 'post'], 'empleados', function () {
//     return view('recept.empleados.empleados');
// })->middleware('auth');
//Route::get('/empleados',[App\Http\Controllers\EmpleadosController::class,'index'])->name('empleados')->middleware('auth');

Route::get('/empleados/{folio}',[App\Http\Controllers\EmpleadosController::class,'show'])->middleware('auth');

Route::get('/empleado/create',[App\Http\Controllers\EmpleadosController::class,'create'])->name('empleado/create')->middleware('auth');

Route::post('/empleados',[App\Http\Controllers\EmpleadosController::class,'store'])->name('empleados')->middleware('auth');

Route::get('/empleado/{folio}/edit',[App\Http\Controllers\EmpleadosController::class,'edit'])->name('empleado/{folio}/edit')->middleware('auth');

Route::put('/empleados/{folio}',[App\Http\Controllers\EmpleadosController::class,'update'])->name('empleados/{folio}')->middleware('auth');

Route::delete('/empleados/{folio}',[App\Http\Controllers\EmpleadosController::class,'destroy'])->name('empleados/{folio}')->middleware('auth');

// para buscar 
Route::post('/empleados/buscar',[App\Http\Controllers\EmpleadosController::class,'buscar'])->name('empleados/buscar')->middleware('auth');

////////////////////////////////////sessionPuesto///////////////////////////////////

Route::get('/puestos', [App\Http\Controllers\ReturnPuesto::class,'index'])->name('puestos')->middleware('auth');

Route::apiResource('/apipuestos', PuestoController::class);

Route::get('/salarios', [App\Http\Controllers\ReturnSalario::class,'index'])->name('salarios')->middleware('auth');

Route::get('/usuarios', [App\Http\Controllers\ReturnUsuario::class, 'index'])->name('usuarios')->middleware('auth');

// Route::get('/new', function(){
//     return view('recept.empleados.new_empleado');
// });

///////////////////////////////////////sessionHistorialsAdmin////////////////////////////////////
Route::get('his', function(){
    return App\Models\Historial::all();
})->middleware('auth');

Route::get('/historial', [App\Http\Controllers\HistorialController::class,'index'])->name('historial')->middleware('auth');



Route::post('/historial/buscar', [App\Http\Controllers\HistorialController::class,'buscar'])->name('historial/buscar')->middleware('auth');

Route::post('historial/pdf', [App\Http\Controllers\PDFHistorial::class,'pdf'])->middleware('auth');

