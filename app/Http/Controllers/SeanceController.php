<?php

namespace App\Http\Controllers;

use App\Models\Film;
use App\Models\Salle;
use App\Models\Seance;
use App\Models\Reservation;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreSeanceRequest;
use App\Http\Requests\UpdateSeanceRequest;

class SeanceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Film $film=null)
    {
        /**afficher toutes les seance de projection
         * ou bien seulement les seance d'un film précis
         */
        if (!is_null($film)) {
            $seances = Seance::where('film_id', $film->id)->orderBy('date_heure_debut', 'desc')->get();
        }else {
            $seances = Seance::orderBy('date_heure_debut', 'desc')->get();
        }
        $films = Film::orderBy('id', 'desc')->get();
        return view('dashboard', compact('films','seances'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $films = Film::orderBy('titre')->get();
        $salles = Salle::orderBy('nom')->get();
        return view('seance.create', compact('films', 'salles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSeanceRequest $request)
    {
        $date_debut = $request->datetime;
        $duree = Film::findOrFail($request->film)->duree;
        $salle = Salle::findOrFail($request->salle);

        // Créer une instance Carbon à partir de la date
        $dateCarbon = Carbon::parse($date_debut);

        // Afficher la date de début
        $formattedDateDebut = $dateCarbon->format('d/m/Y H:i:s');

        // Créer une copie de $dateCarbon pour ajouter la durée
        $dateAvecHeure = $dateCarbon->copy()
            ->addHours((int)substr($duree, 0, 2))
            ->addMinutes((int)substr($duree, 3, 2))
            ->addSeconds((int)substr($duree, 6, 2));
        
        $DateDebut = $dateCarbon->format('Y-m-d H:i:s');
        $DateFin = $dateAvecHeure->format('Y-m-d H:i:s');

        $seances = Seance::where('salle_id', $request->salle)
        ->where(function ($query) use ($DateDebut, $DateFin) {
            $query->whereBetween('date_heure_debut', [$DateDebut, $DateFin])
                ->orWhereBetween('date_heure_fin', [$DateDebut, $DateFin]);
        })
        ->get();
        if ($seances->isEmpty()) {
            Seance::create([
                'date_heure_debut' => $dateCarbon,
                'date_heure_fin' => $dateAvecHeure,
                'prix' => $request->prix,
                'film_id' => $request->film,
                'salle_id' => $request->salle,
            ])->saveOrFail();
            session()->flash('msg', 'Enrégistrement ok!');
            return redirect()->route('dashboard');
        }else {
            return view('seance.programmation_impossible', compact('seances', 'DateDebut', 'DateFin', 'duree', 'salle'));
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Seance $seance)
    {
        /**y'a un ptt soucis ici que je dois réglé */
        $place_total = $seance->salle->taille;
        $place_reserve = Reservation::where('seance_id', '=', ''.$seance->id.'')->sum('nbr_place');
        $place_dispo = $place_total-$place_reserve;
        $reservation = Reservation::where('user_id', Auth::user()->id)->where('seance_id', $seance->id)->first();
        return view('seance.show', compact('seance', 'place_dispo', 'reservation'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Seance $seance)
    {
        $films = Film::orderBy('titre')->get();
        $salles = Salle::orderBy('nom')->get();
        return view('seance.edit', compact('films', 'salles', 'seance'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSeanceRequest $request, Seance $seance)
    {
        $date_debut = $request->datetime;
        $duree = Film::findOrFail($request->film)->duree;
        $salle = Salle::findOrFail($request->salle);

        // Créer une instance Carbon à partir de la date
        $dateCarbon = Carbon::parse($date_debut);

        // Créer une copie de $dateCarbon pour ajouter la durée
        $dateAvecHeure = $dateCarbon->copy()
            ->addHours((int)substr($duree, 0, 2))
            ->addMinutes((int)substr($duree, 3, 2))
            ->addSeconds((int)substr($duree, 6, 2));

        $DateDebut = $dateCarbon->format('Y-m-d H:i:s');
        $DateFin = $dateAvecHeure->format('Y-m-d H:i:s');
        // dd($DateDebut, $DateFin);
        $seances = Seance::where('id', '!=', $seance->id)
        ->where('salle_id', $request->salle)
        ->where(function ($query) use ($DateDebut, $DateFin) {
            $query->whereBetween('date_heure_debut', [$DateDebut, $DateFin])
                ->orWhereBetween('date_heure_fin', [$DateDebut, $DateFin]);
        })
        ->get();
        if ($seances->isEmpty()) {
            $seance->update([
                'date_heure_debut' => $dateCarbon,
                'date_heure_fin' => $dateAvecHeure,
                'prix' => $request->prix,
                'film_id' => $request->film,
                'salle_id' => $request->salle,
            ]);
            session()->flash('msg', 'Mise à jour ok!');
            return redirect()->route('dashboard');
        }else {
            return view('seance.programmation_impossible', compact('seances', 'DateDebut', 'DateFin', 'duree', 'salle', 'seance'));
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Seance $seance)
    {
        $seance->delete();
        session()->flash('msg', 'Suppression ok!');
        return redirect()->route('dashboard');
    }
}
