<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\monitores;
use Illuminate\Support\Facades\Validator;



class Monitores_Controller extends Controller
{
    public function store(Request $request, int $numero = 1)
    {

        $validate = Validator::make($request->all(), [
            "Tasa_de_refresco" => "required|min:2|max:4",
            "Pulgadas" => "required|min:2|max:3",
            "Precio" => "required|min:2|max:20",
            "Stock" => "required|min:2|max:20"
        ]);

        if ($validate->fails()) {
            return response()->json([
                'msg' => 'Error de validación de datos',
                'errors' => $validate->errors()
            ], 422);
        }

        $monitor = new monitores();
        $monitor->Tasa_de_refresco = $request->Tasa_de_refresco;
        $monitor->Pulgadas = $request->Pulgadas;
        $monitor->Precio = $request->Precio;
        $monitor->Stock = $request->Stock;
        $monitor->save();


        return response()->json([["msg" => "Hola tu monitor sido registrado con exito", "data" => $monitor, "estado" => 201]]);
    }

    public function index()
    {
        return response()->json([
            "msg" => "Datos encontrados",
            "Data" => monitores::all()
        ], 200);
    }

    public function update(Request $request, int $id)
    {
        $monitor = monitores::find($id);

        if ($monitor) {

            $validate = Validator::make($request->all(), [
                "Tasa_de_refresco" => "required|min:2|max:20",
                "Pulgadas" => "required|min:2|max:20",
                "Precio" => "required|min:2|max:20",
                "Stock" => "required|min:2|max:20"
            ]);
            
            if ($validate->fails()) {
                return response()->json([
                    'msg' => 'Error de validación de datos',
                    'errors' => $validate->errors()
                ], 422);
            }

            $monitor->Tasa_de_refresco = $request->Tasa_de_refresco;
            $monitor->Pulgadas = $request->Pulgadas;
            $monitor->Precio = $request->Precio;
            $monitor->Stock = $request->Stock;
            $monitor->save();

            return response()->json([["msg" => "Hola tu monitor sido actualizado con exito", "data" => $monitor, "estado" => 201]]);


        }
        return response()->json(["msg" => "monitor no fue encontrado"], 404);

    }

    public function destroy(int $id)
    {
        $monitores = monitores::find($id);

        if ($monitores) {
            $monitores->delete();
            return response()->json([["msg" => "Hola tu monitor sido eliminado con exito", "estado" => 200]]);
        }
        return response()->json(["msg" => "monitor no fue encontrado"], 404);

    }

}