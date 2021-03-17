<?php

namespace App\Http\Controllers;

use App\Models\Asistencia;
use App\Models\Log;
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
//        $users=DB::table('asistencias')
//            ->select('persona_id')//, DB::raw('count(*) as total'))
//            ->groupBy('persona_id')
//            ->whereDate('created_at',now())
//            ->get();
//        $id=array();
//
//        foreach ($users as $key => $user) {
//            // $user es una Instancia de la clase User
//            $id[]=$user->persona_id;
//        }
//        return Persona::wherein('id',$id)->with('asistencia')->with('unit')->get();
        return  Asistencia::with('persona')->with('logs')->whereDate('created_at',now())->get();
    }
    public function buscar(Request $request)
    {
        $fechas = DB::table('asistencias')
            ->select('fecha')//, DB::raw('count(*) as total'))
            ->groupBy('fecha')
            ->where('unit_id',$request->unit_id)
            ->whereYear('created_at', $request->anio)
            ->whereMonth('created_at', $request->mes)
            ->get();
//        return $fechas;
        $dat = array();
        foreach ($fechas as $key => $fecha) {
            $a=array();
            $a['fecha'] = $fecha->fecha;
            $a['asistencia']=Asistencia::with('logs')->where('unit_id',$request->unit_id)->whereDate('created_at',$fecha->fecha)->get();
            $dat[]=$a;
        }
        return $dat;
//        return $fechas;
//        return Asistencia::with('logs')->get();
//        return Asistencia::with('persona')->whereDate('created_at',now())->get();
//        return Persona::with('asistencia')->with('unit')->get();
//        $fechas = DB::table('asistencias')
//            ->select('fecha')//, DB::raw('count(*) as total'))
//            ->groupBy('fecha')
////            ->whereYear('created_at', $request->anio)
////            ->whereMonth('created_at', $request->mes)
//            ->get();
//        $dat = array();
//        return $fechas;
//        return $users;

//        foreach ($fechas as $key => $fecha) {
//            // $user es una Instancia de la clase User
//            $dat['fecha'] = $fecha->fecha;
//            $personas=DB::table('asistencias')
//                ->select('persona_id')//, DB::raw('count(*) as total'))
//                ->groupBy('persona_id')
////                ->whereDate('created_at',now())
//                ->whereDate('created_at', $fecha->fecha)
//                ->orderBy('created_at','asc')
//                ->get();
////            $id=array();
//            $id=array();
//
//            foreach ($personas as $key => $user) {
//                // $user es una Instancia de la clase User
//                $id[]=$user->persona_id;
//            }
//            $personas=Persona::wherein('id',$id)->with('asistencia')->with('unit')->get();
//
//            $dat['asistencias'] = $personas;
//        }
//        return [$dat];
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
//            return $a->first();
//            exit;
            if ($a->count()==0){
                $as=new Asistencia();
                $as->tipo='ENTRADA';
                $unidad=Unit::where('id',$pe->unit_id)->first();
                $as->persona_id=$pe->id;
                $as->fecha=now();
                $as->nombre=$pe->nombre;
                $as->unidad=$unidad->unidad;
                $as->unit_id=$pe->unit_id;
                $as->save();
                $l=new Log();
                $l->estado='ENTRADA';
                $l->fecha=now();
                $l->hora=now();
                $l->asistencia_id=$as->id;
                $l->save();
                //return Asistencia::where('id',$as->id)->with('persona')->with('logs')->first();
                return Log::with('asistencia')->where('id',$l->id)->first();
            } else{
                $a=$a->first();
                $co=Log::where('asistencia_id',$a->id)->whereDate('created_at',now())->count();
                if ($co==2){
                    return "Solo se permite 2 asistencias";
                    exit;
                }
                $l=Log::where('asistencia_id',$a->id)->whereDate('created_at',now())->orderBy('id','desc')->first();

                if ($l->estado=='ENTRADA'){
                    $l=new Log();
                    $l->estado='SALIDA';
                }else{
                    $l=new Log();
                    $l->estado='ENTRADA';
                }
                $l->fecha=now();
                $l->hora=now();
                $l->asistencia_id=$a->id;
                $l->save();
                return Log::with('asistencia')->where('id',$l->id)->first();
            }

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
