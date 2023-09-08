<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PlantaController;
use App\Http\Controllers\WelcomeController;
use PhpParser\Node\Stmt\Return_;
use App\Http\Controllers\ContactoController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;

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
/* Route::get('test',function(){

    return response()->download(
        storage_path('docs/hello.pdf'),
        'miprograma.pdf',
        ['Content-type'=>'application/pdf']
    );
}); */


Route::get('/', [WelcomeController::class, 'index'])->name('portada');

//crud de plantas
Route::get('/plantas',[PlantaController::class,'index'])->name('plantas.index');//lista de plantas
Route::get('/plantas/search',[PlantaController::class,'search'])->name('plantas.search');

Route::get('/plantas/create',[PlantaController::class,'create'])->name('plantas.create');//nueva planta
Route::get('/plantas/{planta}',[PlantaController::class,'show'])->name('plantas.show');//detalles de las plantas
Route::post('/plantas',[PlantaController::class,'store'])->name('plantas.store');//gusrda las plantas

Route::get('/plantas/{planta}/edit',[PlantaController::class,'edit'])->name('plantas.edit');//editar la planta
Route::put('plantas/{planta}',[PlantaController::class,'update'])->name('plantas.update');//actualiza la planta

Route::get('/plantas/{planta}/delete',[PlantaController::class,'delete'])->name('plantas.delete');//borra la planta
Route::delete('/plantass/{planta}',[PlantaController::class,'destroy'])->name('plantas.destroy');//elimina la planta



//ruta para el formulario de contacto
Route::get('/contacto', [ContactoController::class, 'index'])->name('contacto');

//ruta para rl envio del mail de contacto
Route::post('/contacto', [ContactoController::class, 'send'])->name('contacto.email');

Auth::routes(['verify'=>true]);


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//ELIMINACION DEFINITIVA DE LA PLANTA
//va por delete por varios motivos:
//evitar los borrador accidentales

Route::delete('/plantas/purge',[PlantaController::class,'purge'])->name('plantas.purge');

//restauracion de la planta

Route::get('/plantas/{planta}/restore',[PlantaController::class,'restore'])->name('plantas.restore');

Route::get('/bloqueado', [UserController::class, 'blocked'])->name('user.blocked');

//grupode rutas solamente para el administrador
//llevara prefijo admin
Route::prefix('admin')->middleware('auth','is_admin')->group(function(){

    //ver las plantas eliminadas(/admin/deletedplantas)
    Route::get('deletedplantas',[AdminController::class,'deletedPlantas'])->name('admin.deleted.plantas');

    //detalles de un usuario
    Route::get('usuario/{user}/detalles',[AdminController::class, 'userShow'])->name('admin.user.show');

    //listados de uauarios
    Route::get('usuarios',[AdminController::class, 'userList'])->name('admin.users');

    Route::get('usuario/buscar', [AdminController::class, 'userSearch'])->name('admin.users.search');

    //añadir un rol(dentro del grupo admin)
    Route::post('role', [AdminController::class, 'setRole'])->name('admin.user.setRole');

    //quitar un rol (dentro del grupo admin)
    Route::delete('role', [AdminController::class, 'removeRole'])->name('admin.user.removeRole');
});


Route::fallback([WelcomeController::class,'index']);