<?php

namespace App\Http\Controllers;

use App\Coordenada;
use App\Empresa;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Ciudad;
use App\Deporte;
use App\Paquete;
use Carbon\Carbon;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }

    //get
    public function registroEmpresa()
    {
        $ciudades = Ciudad::all()->pluck('nombre','id');
        $deportes = Deporte::all()->pluck('nombre','id');
        $paquetes = Paquete::all();

        return view('registro_empresa')->with(compact('ciudades', 'deportes', 'paquetes'));
    }

    //post
    public function registrarEmpresa(Request $request)
    {
        $fecha = $request->get('fecha_nacimiento');
        $fecha = Carbon::parse($fecha)->format('Y-m-d');
        $ciudad = Ciudad::findOrFail($request->get('ciudad_id'));

        if($ciudad != null){
            $coordenada = new Coordenada();
            $coordenada->latitud = 312125445;
            $coordenada->longitud = -46445464;
            $coordenada->save();

            $empresa = new Empresa();
            $empresa->nombre = $request->get('nombre');
            $empresa->correo  = $request->get('correo');
            $empresa->contrasenia = $request->get('contrasenia');
            $empresa->fecha_nacimiento = $fecha;
            $empresa->ciudad()->associate($ciudad);
            $empresa->coordenada()->associate($coordenada);
            $empresa->tipo = 1;
            $empresa->save();

            $empresa->deportes()->attach($request->get('habilidades'));

            return $empresa;
        }
        //return $request->all();
    }
}
