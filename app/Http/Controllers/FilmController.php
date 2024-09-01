<?php

namespace App\Http\Controllers;

use App\Models\Film;
use App\Models\User;
use App\Models\Seance;
use App\Models\Commentaire;
use Illuminate\Support\Carbon;
use App\Http\Requests\StoreFilmRequest;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\UpdateFilmRequest;

class FilmController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $film = Film::all()->first();
        // $seance = Seance::where('film_id', $film->id)->first();
        // $date_debut = Carbon::parse($seance->date_heure);
        // $duree = Carbon::parse($film->duree);
        // $date_fin = $date_debut->addHours($duree->hour)->addMinutes($duree->minute)->addSeconds($duree->second);
        // $date_fin = $date_debut->add($duree);
        // dd($date_debut, $duree, $date_fin);

        $films = Film::orderBy('id', 'desc')->get();
        $seances = Seance::orderBy('id', 'desc')->get();
        return view('film.index', compact('films','seances'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('film.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreFilmRequest $request)
    {
        $img_ex = ['png','jpg','jpeg','gif','bmp','tif','tiff','raw','svg','eps','psd'];
        $movie_ex = ['avi','mp4','mov','wmv','mkv','mpeg','flv','3gp','rmvb','webm'];
        $media_enreg = false;
        if (isset($request->affiche)) {
            foreach($img_ex as $img){
                if ($img == $request->affiche->extension()) {
                    $media_enreg = true;
                }
            }
        }
        $file = 'null';
        if (($request->affiche) && ($media_enreg)) {
            $file_name = time().'.'.$request->affiche->extension();
            $file = Storage::disk('public')->put('affiche', $request->affiche);
        }
        Film::create([
            'titre' => $request->titre,
            'description' => $request->description,
            'affiche' => $file,
            'duree' => $request->duree,
        ])->saveOrFail();
        session()->flash('msg', 'Creating ok!');
        return redirect()->route('film.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Film $film)
    {
        $seances = Seance::where('film_id', $film->id)->orderBy('id', 'desc')->get();
        $commentaires = $film->commentaires()->orderBy('id')->get();
        return view('film.show', compact('film', 'commentaires', 'seances'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Film $film)
    {
        return view('film.edit', compact('film'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateFilmRequest $request, Film $film)
    {
        $img_ex = ['png','jpg','jpeg','gif','bmp','tif','tiff','raw','svg','eps','psd'];
        $movie_ex = ['avi','mp4','mov','wmv','mkv','mpeg','flv','3gp','rmvb','webm'];
        $media_enreg = false;
        if ($request->affiche) {
            foreach($img_ex as $img){
                if ($img == $request->affiche->extension()) {
                    $media_enreg = true;
                }
            }
        }
        $file = $film->affiche;
        if (($request->affiche) && ($media_enreg)) {
            $file = time().'.'.$request->affiche->extension();
            $file = Storage::disk('public')->put('affiche', $request->affiche);
            Storage::disk('public')->delete('affiche', $film->affiche);
        }
        $film->update([
            'titre' => $request->titre,
            'description' => $request->description,
            'affiche' => $file,
            'duree' => $request->duree,
        ]);
        session()->flash('msg', 'Mise à jour ok!');
        return redirect()->route('film.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Film $film)
    {
        $film->commentaires()->delete();
        $film->seances()->delete();
        $film->delete();
        session()->flash('msg', 'Suppression ok!');
        return redirect()->route('film.index');
    }

    public function forceDelete(Film $film)
    {
        $film->forceDelete();
        session()->flash('msg', 'Suppression définitive ok!');
        return redirect()->route('film.index');
    }
}
