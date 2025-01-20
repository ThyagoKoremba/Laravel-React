<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use function Laravel\Prompts\error;

class AuthController extends Controller
{
    public function register(Request $request){ 

        $response=["successs"=>false];

        $validator = Validator::make($request->all(),[
            'name'=>'required',
            'email'=>'required|email',
            'password'=>'required',
        ]);

        if($validator->fails()){
            $response = ["error"=>$validator->errors()];
            return response()->json($response,200);
        }

        $input=$request->all();
        $input["password"] = bcrypt($input["password"]);

        $user=User::create($input);
        $user->assignRole('admin');

        $response["success"]=true;
        $response["token"]= $user->createToken("codea")->plainTextToken;

        return response()->json($response, 200);

    }

    public function login(Request $request)
    {
    $response=["success"=>false];
    // Validar las credenciales recibidas
    $validator=Validator::make($request->all(),[
        'email'=>'required|email',
        'password'=>'required',
    ]);

    if($validator->fails()){
        $response=["error"=>$validator->errors()];
        return response()->json($response,200);
    }

    if(auth()->attempt(['email'=>$request->email,'password'=>$request->password])){
        $user=auth()->user();
        $user->hasRole('client');

        $response['token']=$user->createToken('codea.app')->plainTextToken;
        $response['user']=$user;
        $response['success']=true;
        
        
    }
    return response()->json($response,200);
}

public function logout(){
    $response=["success"=>false];
    auth()->user()->tokens()->delete();
    return response()->json($response, 200);
}
}
