<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCuentaRequest;
use App\Http\Requests\UpdateCuentaRequest;
use App\Models\Cliente;
use App\Models\Cuenta;
use Illuminate\Http\Request;

class CuentaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('cuentas.index', [
            'cuentas' => Cuenta::all(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $clientes = Cliente::all();

        return view('cuentas.create', [
            'cuenta' => new Cuenta(),
            'clientes' => $clientes,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreCuentaRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCuentaRequest $request)
    {
        $cuenta = new Cuenta($request->validated());
        $cuenta->save();

        $cuenta->clientes()->attach($request->cliente);

        return redirect()->route('cuentas.index')
            ->with('success', "Cuenta $cuenta->numero creada correctamente");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Cuenta  $cuenta
     * @return \Illuminate\Http\Response
     */
    public function show(Cuenta $cuenta)
    {
        return view('cuentas.show', [
            'cuenta' => $cuenta,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Cuenta  $cuenta
     * @return \Illuminate\Http\Response
     */
    public function edit(Cuenta $cuenta)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCuentaRequest  $request
     * @param  \App\Models\Cuenta  $cuenta
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCuentaRequest $request, Cuenta $cuenta)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Cuenta  $cuenta
     * @return \Illuminate\Http\Response
     */
    public function destroy(Cuenta $cuenta)
    {
        //
    }

    public function titulares(Cuenta $cuenta)
    {
        return view('cuentas.titulares', [
            'cuenta' => $cuenta,
        ]);
    }

    public function addtitular(Cuenta $cuenta)
    {
        $clientes = Cliente::all();

        return view('cuentas.addtitular', [
            'cuenta' => $cuenta,
            'clientes' => $clientes,
        ]);
    }

    public function addtitularupdate(Request $request, Cuenta $cuenta)
    {
        $cuenta->clientes()->attach($request->cliente);

        return redirect()->route('cuentas.titulares', $cuenta);
    }

    public function deleteTitular(Cuenta $cuenta, Cliente $cliente)
    {
        $cliente->cuentas()->detach($cuenta);

        return redirect()->route('cuentas.titulares', $cuenta);
    }
}
