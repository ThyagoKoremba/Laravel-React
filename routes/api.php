<?php

use App\Http\Controllers\Api\Admin\CategoriaController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\Client\EmpresaController;
use App\Http\Controllers\Api\Admin\EmpresaController as EmpresaAdm;
use App\Http\Controllers\Api\Admin\UserController;
use App\Http\Controllers\Api\FrontController;
use App\Models\Categoria;
use Illuminate\http\Request;
use Illuminate\Support\Facades\Route;


Route::prefix('v1')->group(function(){

    //Public
    //::public
    Route::get('public/{slug}',[FrontController::class,'categoria']);

    //::auth
    Route::get('/auth/register',[AuthController::class],'register');
    Route::get('/auth/login',[AuthController::class],'login');


    //Private
    Route::group(['middleware'=>'auth:sanctum'],function(){
        Route::post('/auth/logout',[AuthController::class,'logout']); 

        //::roll cleint
        Route::apiResource('/client/empresa',EmpresaController::class);

        //::roll admin
        Route::apiResource('/admin/empresa',EmpresaAdm::class);
        Route::apiResource('/admin/categoria',CategoriaController::class);
        Route::apiResource('/admin/categoria',UserController::class);


    });

});



Route::middleware('auth:sanctum')->get('/user', function (Request $request){
    return $request->user();
}); 