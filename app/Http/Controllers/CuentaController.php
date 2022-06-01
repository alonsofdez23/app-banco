<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCuentaRequest;
use App\Http\Requests\UpdateCuentaRequest;
use App\Models\Cliente;
use App\Models\Cuenta;
use App\Models\Movimiento;
use Carbon\Carbon;
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
        return view('cuentas.create', [
            'cuenta' => new Cuenta(),
            'clientes' => Cliente::adultos(),
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
        $cuenta->delete();

        return redirect()->route('cuentas.index')
            ->with('success', "Cuenta $cuenta->numero borrada correctamente");
    }

    public function titulares(Cuenta $cuenta)
    {
        return view('cuentas.titulares', [
            'cuenta' => $cuenta,
        ]);
    }

    public function addtitular(Cuenta $cuenta)
    {
        $clientes = Cliente::all()->diff($cuenta->clientes);

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

        if ($cuenta->clientes->isEmpty()){
            $cliente->cuentas()->attach($cuenta);

            return redirect()->route('cuentas.titulares', $cuenta)
                ->with('error', 'Las cuentas debe tener al menos un titular');
        };

        if ($cuenta->clientes->diff(Cliente::menores())->isEmpty()) {
            $cliente->cuentas()->attach($cuenta);

            return redirect()->route('cuentas.titulares', $cuenta)
                ->with('error', 'Las cuentas debe tener un titular mayor de edad al menos');
        };

        return redirect()->route('cuentas.titulares', $cuenta)
            ->with('success', "$cliente->nombre borrado correctamente");
    }

    public function movimientos(Cuenta $cuenta)
    {
        $movimientos = $cuenta->withSum('movimientos', 'importe')->get()->where('id', $cuenta->id)->first();

        return view('cuentas.movimientos', [
            'cuenta' => $cuenta,
            'movimientos' => $movimientos,
        ]);
    }

    public function addmovimiento(Cuenta $cuenta, Movimiento $movimiento)
    {
        return view('cuentas.addmovimiento', [
            'movimiento' => $movimiento,
            'cuenta' => $cuenta,
        ]);
    }

    public function addmovimientostore(Request $request, Cuenta $cuenta)
    {
        $movimiento = new Movimiento([
            'cuenta_id' => $cuenta->id,
            'fecha' => Carbon::now(),
            'concepto' => $request->concepto,
            'importe' => $request->importe,
        ]);

        $movimiento->save();

        return redirect()->route('cuentas.movimientos', $cuenta);
    }

    public function deleteMovimiento(Cuenta $cuenta, Movimiento $movimiento)
    {
        $movimiento->delete();

        return redirect()->route('cuentas.movimientos', $cuenta);
    }
}
