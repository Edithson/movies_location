<?php

namespace App\Http\Controllers;

use App\Models\Type;
use App\Models\User;
use App\Models\Commentaire;
use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index() //affichez tout les utilisateurs actif de l'application
    {
        $users = User::where('type_id', '!=', '4')->orderBy('email')->get();
        $types = Type::where('id', '!=', '4')->get();
        return view('user.index',compact('users', 'types'));
    }

    public function index_delete() //affichez tout les utilisateurs désactivé de l'application
    {
        $users = User::onlyTrashed()->orderBy('name')->get();
        $types = Type::where('id', '!=', '4')->get();
        return view('user.index_delete',compact('users', 'types'));
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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        $types = Type::where('id', '!=', '4')->get();
        return view('user.show',compact('user', 'types'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $user->update([
            'type_id' => $request->type,
        ]);
        session()->flash('msg', 'Mise à jour réussie!');
        return redirect()->route('user.index');
    }

    public function restore(int $id)
    {
        User::onlyTrashed()->findOrFail($id)->restore();
        session()->flash('msg', 'Restauration réussie!');
        return redirect()->route('user.index-delete');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $user->delete();
        session()->flash('msg', 'Suspention de l\'utilisateur réussie!');
        return redirect()->route('user.index');
    }

    public function delete_count(Request $request){
        Commentaire::where('user_id', Auth::user()->id)->delete();
        Reservation::where('user_id', Auth::user()->id)->delete();
        $user = Auth::user();
        
        $user->delete();

        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();
        
        return redirect()->route('seance.index');
    }

}
