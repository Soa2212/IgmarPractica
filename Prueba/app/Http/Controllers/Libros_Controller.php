<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\libros;
use Illuminate\Support\Facades\Validator;

class Libros_Controller extends Controller
{
    public function store(Request $request)
    {
        $validate = Validator::make($request->all(), [
            "titulo" => "required|min:2|max:50",
            "autor" => "required|regex:/^[\pL\s\-]+$/u|min:2|max:50", 
            "editorial" => "required|regex:/^(?=.*[A-Za-zÁÉÍÓÚáéíóúÜü])[A-Za-zÁÉÍÓÚáéíóúÜü\s\-]+$/u|min:2|max:50",
            "precio" => "required|numeric|min:0.1|max:9999.99"
            ], [
                "precio.numeric" => "Por favor, utilice solo números.",
                "precio.max" => "No se manejan libros con costo mayor a 9999.99.",
                "precio.min" => "No se manejan libros con costos menores a 0.1.",
                "autor.regex" => "Por favor, utilice solo letras.",
                "editorial.regex" => "Use al menos una letra. Solo puede usar espacios y guiones además de letras"
        ]);

        if ($validate->fails()) {
            return response()->json([
                'msg' => 'Error de validación de datos',
                'errors' => $validate->errors()
            ], 422);
        }

        $libro = new libros();
        $libro->titulo = $request->titulo;
        $libro->autor = $request->autor;
        $libro->editorial = $request->editorial;
        $libro->precio = $request->precio;
        $libro->save();


        return response()->json([["msg" => "Hola tu libro ha sido registrado con exito", "data" => $libro, "estado" => 201]]);
    }

    public function index()
    {
        return response()->json([
            "msg" => "Datos encontrados",
            "Data" => libros::all()
        ], 200);
    }

    public function update(Request $request, int $id)
    {
        $libro = libros::find($id);

        if ($libro) {

            $validate = Validator::make($request->all(), [
                "titulo" => "required|min:2|max:50",
                "autor" => "required|regex:/^[\pL\s\-]+$/u|min:2|max:50", 
                "editorial" => "required|regex:/^(?=.*[A-Za-zÁÉÍÓÚáéíóúÜü])[A-Za-zÁÉÍÓÚáéíóúÜü\s\-]+$/u|min:2|max:50",
                "precio" => "required|numeric|min:0.1|max:9999.99"
                ], [
                    "precio.numeric" => "Por favor, utilice solo números.",
                    "precio.max" => "No se manejan libros con costo mayor a 9999.99.",
                    "precio.min" => "No se manejan libros con costos menores a 0.1.",
                    "autor.regex" => "Por favor, utilice solo letras.",
                    "editorial.regex" => "Use al menos una letra. Solo puede usar espacios y guiones además de letras"
            ]);
    
            if ($validate->fails()) {
                return response()->json([
                    'msg' => 'Error de validación de datos',
                    'errors' => $validate->errors()
                ], 422);
            }

            $libro->titulo = $request->titulo;
            $libro->autor = $request->autor;
            $libro->editorial = $request->editorial;
            $libro->precio = $request->precio;
            $libro->save();

            return response()->json([["msg" => "Hola tu libro ha sido actualizado con exito", "data" => $libro, "estado" => 200]]);
        }
        return response()->json(["msg" => "Libro no encontrado"], 404);
    }

    public function destroy(int $id)
    {
        $libro = libros::find($id);

        if ($libro) {
            $libro->delete();
            return response()->json([["msg" => "Hola tu libro sido eliminado con exito", "estado" => 200]]);
        }
        return response()->json(["msg" => "Libro no encontrado"], 404);

    }
}
