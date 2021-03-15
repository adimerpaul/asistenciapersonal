<?php

namespace App\Http\Controllers;

use App\Models\Asistencia;
use App\Models\Persona;
use App\Models\Unit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AsistenciaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
//        return Asistencia::with('persona')->whereDate('created_at',now())->get();
//        return Persona::with('asistencia')->with('unit')->get();
        $users=DB::table('asistencias')
            ->select('persona_id')//, DB::raw('count(*) as total'))
            ->groupBy('persona_id')
            ->whereDate('created_at',now())
            ->get();
        $id=array();

        foreach ($users as $key => $user) {
            // $user es una Instancia de la clase User
            $id[]=$user->persona_id;
        }
        return Persona::wherein('id',$id)->with('asistencia')->with('unit')->get();
    }
    public function buscar(Request $request)
    {
//        return Asistencia::with('persona')->whereDate('created_at',now())->get();
//        return Persona::with('asistencia')->with('unit')->get();
        $fechas = DB::table('asistencias')
            ->select('fecha')//, DB::raw('count(*) as total'))
            ->groupBy('fecha')
//            ->whereYear('created_at', $request->anio)
//            ->whereMonth('created_at', $request->mes)
            ->get();
        $dat = array();
//        return $users;

        foreach ($fechas as $key => $fecha) {
            // $user es una Instancia de la clase User
            $dat['fecha'] = $fecha->fecha;
            $personas=DB::table('asistencias')
                ->select('persona_id')//, DB::raw('count(*) as total'))
                ->groupBy('persona_id')
//                ->whereDate('created_at',now())
                ->whereDate('created_at', $fecha->fecha)
                ->orderBy('created_at','asc')
                ->get();
//            $id=array();
            $id=array();

            foreach ($personas as $key => $user) {
                // $user es una Instancia de la clase User
                $id[]=$user->persona_id;
            }
            $personas=Persona::wherein('id',$id)->with('asistencia')->with('unit')->get();

            $dat['asistencias'] = $personas;
        }
        return [$dat];
//        return Persona::where('unit_id',$request->unit_id)->wherein('id',$id)->with('asistencia')->with('unit')->get();
////        return $request;
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
        $p=Persona::where('targeta',$request->targeta);
        if ($p->count()==0){
            return "Targeta no registrada a un personal";
            exit;
        }else{
            $pe=$p->first();
            $a=Asistencia::where('persona_id',$pe->id)->whereDate('created_at',now())->orderBy('id','desc');
            $d=new Asistencia();
            if ($a->count()==0){
                $d->tipo='ENTRADA';
            }else{
                $a=Asistencia::where('persona_id',$pe->id)->whereDate('created_at',now())->orderBy('id','desc')->first();
                if ($a->tipo=='ENTRADA'){
                    $d->tipo='SALIDA';
                }else{
                    $d->tipo='ENTRADA';
                }
            }
            $unidad=Unit::where('id',$pe->unit_id)->first();
            $d->persona_id=$pe->id;
            $d->nombre=$pe->nombre;
            $d->unidad=$unidad->unidad;
            $d->unit_id=$pe->unit_id;
            $d->save();
            return Asistencia::where('id',$d->id)->with('persona')->first();
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Asistencia  $asistencia
     * @return \Illuminate\Http\Response
     */
    public function show(Asistencia $asistencia)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Asistencia  $asistencia
     * @return \Illuminate\Http\Response
     */
    public function edit(Asistencia $asistencia)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Asistencia  $asistencia
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Asistencia $asistencia)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Asistencia  $asistencia
     * @return \Illuminate\Http\Response
     */
    public function destroy(Asistencia $asistencia)
    {
        //
    }
}
