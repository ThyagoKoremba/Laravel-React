<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Models\Categoria;
use Illuminate\Http\Request;

class EmpresaController extends Controller
{
    public function index(){
        $data = Categoria::orderBy('order')->all();
        return response()->json($data,200);
    }

    public function store(Request $request){

        $data = new Categoria($request->all());
         
        $data->save();
        return response()->json($data, 200);
    }

    public function show($id){
        $data = Categoria::find($id);
        return response()->json($data,200);
    }

    
    public function update(Request $request, $id){
        //validacion
        $data = Categoria::find($id);
        $data->fill($request->all());
        $data->save();
        
        return response()->json($data,200);
    }
}
