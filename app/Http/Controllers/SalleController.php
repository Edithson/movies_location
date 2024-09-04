<?php

namespace App\Http\Controllers;

use App\Models\Salle;
use App\Http\Requests\StoreSalleRequest;
use App\Http\Requests\UpdateSalleRequest;

class SalleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $salles = Salle::orderBy('id', 'desc')->get();
        return view('salle.index', compact('salles'));
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
    public function store(StoreSalleRequest $request)
    {
        Salle::create([
            'nom' => $request->nom,
            'adresse' => $request->adresse,
            'taille' => $request->taille
        ])->saveOrFail();
        session()->flash('msg', 'Creating ok!');
        return redirect()->route('salle.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Salle $salle)
    {
        //
    }

    public function seance_salle(Salle $salle)
    {
        $seances = $salle->seances()->orderBy('date_heure_debut')->get();
        return view('salle.seance_salle', compact('salle', 'seances'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Salle $salle)
    {
        return view('salle.edit', compact('salle'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSalleRequest $request, Salle $salle)
    {
        $salle->update([
            'nom' => $request->nom,
            'adresse' => $request->adresse,
            'taille' => $request->taille
        ]);
        session()->flash('msg', 'mise à jour ok!');
        return redirect()->route('salle.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Salle $salle)
    {
        $salle->delete();
        session()->flash('msg', 'Creating ok!');
        return redirect()->route('salle.index');
    }
}
