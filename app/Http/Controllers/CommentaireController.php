<?php

namespace App\Http\Controllers;

use App\Models\Film;
use App\Models\Commentaire;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreCommentaireRequest;
use App\Http\Requests\UpdateCommentaireRequest;

class CommentaireController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
    public function store(StoreCommentaireRequest $request, Film $film)
    {
        Commentaire::create([
            'user_id' => Auth::user()->id,
            'film_id' => $film->id,
            'commentaire' => $request->commentaire
        ])->saveOrFail();
        session()->flash('msg', 'Commentaire publié!');
        return redirect()->route('film.show', $film);
    }

    /**
     * Display the specified resource.
     */
    public function show(Commentaire $commentaire)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Commentaire $commentaire)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCommentaireRequest $request, Commentaire $commentaire)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Commentaire $commentaire)
    {
        $film = $commentaire->film;
        $commentaire->delete();
        session()->flash('msg', 'Commentaire supprimé!');
        return redirect()->route('film.show', $film);
    }
}
