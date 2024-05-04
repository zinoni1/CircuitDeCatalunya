<?php

namespace App\Http\Controllers;

use App\Models\cargos;
use Illuminate\Http\Request;

class CargosController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }
    public function indexAndroid(){
        $cargos = cargos::all();
        return response()->json($cargos, 200);
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(cargos $cargos)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(cargos $cargos)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, cargos $cargos)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(cargos $cargos)
    {
        //
    }
}
