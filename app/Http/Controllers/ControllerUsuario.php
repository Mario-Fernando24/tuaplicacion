<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Usuario;
use App\Models\AdicionaUsuario;
use Illuminate\Support\Facades\Validator;

class ControllerUsuario extends Controller
{
    public function index(Request $request) 
    {
        $usuarios = Usuario::with('adicion')->get();
        return response()->json(['status' => true,'usuario'=> $usuarios], 200);
    }
    

    public function store(Request $request)
    {
            $validator = Validator::make($request->all(), [
                'name' => 'required|string|max:255',
                'lastname' => 'required|string',
                'telephone' => 'required|numeric',
                'email' => 'required|string|email|max:255|unique:usuario',
                'address' => 'required|string|max:200',
            ]);

            if($validator->fails()){
                return response()->json(['status'=>false, 'message'=>   $validator->errors()->toJson()],400);
            }

        $usuario = Usuario::create([
        'name' => $request->get('name'),
        'lastname' => $request->get('lastname'),
        'telephone' => $request->get('telephone'),
        'email' => $request->get('email'),
        'address' => $request->get('address'),
        ]);

        $adicionalusuario = AdicionaUsuario::create([
            'id_user' => $usuario->id,
            'art' => $request->get('art'),
            'cinema' => $request->get('cinema'),
            'music' => $request->get('music'),   
        ]);

        return response()->json(['status' => true,'message'=> 'registro registrado con existo'], 200);

    }


    public function update(Request $request)
    {

        $usuario = Usuario::find($request->id);

        if($usuario){
            
        $usuario->name = $request->name;
        $usuario->lastname = $request->lastname;
        $usuario->telephone = $request->telephone;
        $usuario->email = $request->email;
        $usuario->address = $request->address;
        $usuario->update();

        $Adicionusuario = AdicionaUsuario::where('id_user',$request->id)->firstOrFail();
        $Adicionusuario->art = $request->art;
        $Adicionusuario->cinema = $request->cinema;
        $Adicionusuario->music = $request->music;
        $Adicionusuario->update();
        return response()->json(['status' => true,'message'=> 'registro actualizado con existo'], 200);
        }else{ 
            return response()->json(['status' => false,'message'=> 'No se pudo actualizar el registro'], 404);
        }
    }


    public function delete(Request $request)
    {
        
        $user = Usuario::find($request->id);
        if($user){ $user->delete();
            return response()->json(['status' => true,'message'=> 'registro eliminado con existo'], 200);
        }else{ 
            return response()->json(['status' => false,'message'=> 'Registro no encontrado'], 404);
        }
        
    }

}
