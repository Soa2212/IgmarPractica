<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    public function index(int $numero, $numero2 = 10)
    {
        $tablas = [];

        for ($x = $numero; $x <= $numero2; $x++) {

            $tabla = [];

            for ($i = 1; $i <= 10; $i++) {
                $ttl = $i * $x;
                $type = "$x * $i = $ttl ";
                $tabla[] = $type;
            }

            $tablas[] = $tabla;
        }

        return response()->json([
            "data" => [
                "msg" => "Las tablas son:",
                "tablas" => $tablas
            ]
        ], 200);
    }
}