<?php

namespace App\Http\Controllers;

use App\Models\Persona;
use Illuminate\Http\Request;
use PDF;
class PersonaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Persona::with('unit')->get();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $p=New Persona();
        $p->nombre=$request->nombre;
        $p->targeta=$request->targeta;
        $p->unit_id=$request->unit_id;
        $p->save();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Persona  $persona
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        PDF::SetTitle('Hello World');
        PDF::AddPage();
        PDF::Write(0, 'Hello World');
        PDF::Output('hello_world.pdf','I');
//        return $id;
    }
    public function credencial(Request $request){
        return "a";
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Persona  $persona
     * @return \Illuminate\Http\Response
     */
    public function edit(Persona $persona)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Persona  $persona
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $p= Persona::find($id);
        $p->nombre=$request->nombre;
        $p->targeta=$request->targeta;
        $p->unit_id=$request->unit_id;
        $p->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Persona  $persona
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $p= Persona::find($id);
        $p->delete();
    }
}
