<?php

namespace App\Http\Controllers\api\v2;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Api\Persona;

class ApiController extends Controller
{
    public function index()
    {
        return response()->json([
            "msg" => "Datos encontrados",
            "Data" => Persona::all()
        ], 200);
    }
    public function update(Request $request, int $id)
    {
        $persona = Persona::find($id);

        if ($persona) {

            $validate = Validator::make($request->all(), [
                "nombre" => "required|min:3|max:20",
                "ap_paterno" => "required|min:3|max:20",
                "ap_materno" => "nullable|min:3|max:20",
                "sexo" => "required|min:3|max:20"
            ]);

            if ($validate->fails()) {
                return response()->json([
                    'msg' => 'Error de validación de datos',
                    'errors' => $validate->errors()
                ], 422);
            }

            $persona->nombre = $request->nombre;
            $persona->ap_paterno = $request->ap_paterno;
            $persona->ap_materno = $request->get('ap_materno', null);
            $persona->sexo = $request->sexo;
            $persona->save();

            $nombre = $request->get('nombre');
            return response()->json([["msg" => "Hola $nombre tu has sido actualizada con exito", "data" => $persona, "estado" => 200]]);


        }
        return response()->json(["msg" => "Persona no fue encontrada"], 404);

    }
    public function store(Request $request, int $numero = 1)
    {

        $validate = Validator::make($request->all(), [
            "nombre" => "required|min:3|max:20",
            "ap_paterno" => "required|min:3|max:20",
            "ap_materno" => "nullable|min:3|max:20",
            "sexo" => "required|min:3|max:20"
        ]);

        if ($validate->fails()) {
            return response()->json([
                'msg' => 'Error de validación de datos',
                'errors' => $validate->errors()
            ], 422);
        }

        $nombre = $request->get('nombre');

        $persona = new Persona();
        $persona->nombre = $request->nombre;
        $persona->ap_paterno = $request->ap_paterno;
        $persona->ap_materno = $request->get('ap_materno', null);
        $persona->sexo = $request->sexo;
        $persona->save();


        return response()->json([["msg" => "Hola $nombre tu has sido registrado con exito", "data" => $persona, "estado" => 201]]);
    }
}