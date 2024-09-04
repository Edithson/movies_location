<?php

namespace App\Http\Controllers;

use App\Models\Seance;
use App\Models\Reservation;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreReservationRequest;
use App\Http\Requests\UpdateReservationRequest;

class ReservationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()//affiche les réservations d'un utilisateur
    {
        $reservations = Reservation::where('user_id', Auth::user()->id)->orderBy('id', 'desc')->get();
        return view('reservation.index', compact('reservations'));
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
    public function store(StoreReservationRequest $request, Seance $seance)
    {
        $DateDebut = $seance->date_heure_debut;
        $DateFin = $seance->date_heure_fin;
        $nbr_place = $request->nbr_place;
        $seances = Seance::whereHas('reservations', function($query) {
            $query->where('user_id', 2);
        })
        ->where(function($query) use ($DateDebut, $DateFin) {
            $query->whereBetween('date_heure_debut', [$DateDebut, $DateFin])
                  ->orWhereBetween('date_heure_fin', [$DateDebut, $DateFin]);
        })
        ->get();
        if ($seances->isEmpty()) {
            Reservation::create([
                'seance_id' => $seance->id,
                'user_id' => Auth::user()->id,
                'nbr_place' => $request->nbr_place
            ])->saveOrFail();
            session()->flash('msg', 'votre réservation a été enrégistré<br/>Nous vous recontacterons pour vous indiquez le moyen de payement afin de finaliser votre réservation');
            return redirect()->route('seance.show', $seance);
        }else{
            return view('reservation.validation', compact('seances', 'seance', 'nbr_place'));
        }
        
    }

    public function validate(StoreReservationRequest $request, Seance $seance){
        Reservation::create([
            'seance_id' => $seance->id,
            'user_id' => Auth::user()->id,
            'nbr_place' => $request->nbr_place
        ])->saveOrFail();
        session()->flash('msg', 'votre réservation a été enrégistré<br/>Nous vous recontacterons pour vous indiquez le moyen de payement afin de finaliser votre réservation');
        return redirect()->route('seance.show', $seance);
    }

    /**
     * Display the specified resource.
     */
    public function show(Reservation $reservation)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Reservation $reservation)
    {
        $place_total = $reservation->seance->salle->taille;
        $place_reserve = Reservation::where('seance_id', '=', ''.$reservation->seance->id.'')->sum('nbr_place');
        $place_dispo = $place_total-$place_reserve;
        return view('reservation.edit', compact('reservation', 'place_dispo'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateReservationRequest $request, Reservation $reservation)
    {
        $reservation->update([
            'nbr_place' => $request->nbr_place
        ]);
        $seance = $reservation->seance;
        session()->flash('msg', 'votre réservation a été enrégistré<br/>Nous vous recontacterons pour vous indiquez le moyen de payement afin de finaliser votre réservation');
        return redirect()->route('seance.show', $seance);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Reservation $reservation)
    {
        $seance = $reservation->seance;
        $reservation->delete();
        session()->flash('msg', 'votre réservation a été annulé');
        return redirect()->route('seance.show', $seance);
    }
}
