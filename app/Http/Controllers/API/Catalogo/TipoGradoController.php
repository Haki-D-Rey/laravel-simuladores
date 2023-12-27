<?php

namespace App\Http\Controllers\API\Catalogo;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\TipoGrado;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class TipoGradoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tipoGrados = TipoGrado::all();
        return response()->json($tipoGrados);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate(TipoGrado::rules());
        $tipoGrado = TipoGrado::create($request->all());
        return response()->json($tipoGrado, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $tipoGrado = TipoGrado::findOrFail($id);
        return response()->json($tipoGrado);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate(TipoGrado::rules());
        $tipoGrado = TipoGrado::findOrFail($id);
        $tipoGrado->update($request->all());

        return response()->json($tipoGrado, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $tipoGrado = TipoGrado::findOrFail($id);
        $tipoGrado->delete();

        return response()->json(null, 204);
    }
}
