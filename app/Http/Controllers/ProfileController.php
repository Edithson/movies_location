<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\ProfileUpdateRequest;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }

    public function changer_photo(Request $request){
        $img_ex = ['png','jpg','jpeg','gif','bmp','tif','tiff','raw','svg','eps','psd'];
        $media_enreg = false;
        if ($request->profil) {
            foreach($img_ex as $img){
                if ($img == $request->profil->extension()) {
                    $media_enreg = true;
                }
            }
        }
        $user = User::findOrFail(Auth::user()->id);
        $profil = $user->profil;
        if ($media_enreg == true) {
            $profil = Storage::disk('public')->put('profil', $request->profil);
            if ($user->profil !== 'profil/profil.png') {
                Storage::disk('public')->delete('profil', $user->profil);
            }
        }
        $user->update([
            'profil' => $profil,
        ]);
        session()->flash('msg', 'Mise à jour ok!');
        return redirect()->route('profile.edit');
    }
    
}
