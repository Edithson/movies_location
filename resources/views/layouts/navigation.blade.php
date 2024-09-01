    <div class="">
        <div class="">
            <ul>
                <li><a href="{{route('dashboard')}}">Accueil</a></li>
                <li><a href="{{route('film.index')}}">Film</a></li>
                <li><a href="{{route('seance.create')}}">Ajouter une séance de ciné</a></li>
                <li><a href="{{route('salle.index')}}">Gestion des salles</a></li>
                <li><a href="{{route('reservation.index')}}">Affichez mes réservations</a></li>
                <li><a href="{{route('user.index')}}">Utilisateurs</a></li>
            </ul>
        </div>

        <div class="">
        @auth
            <div class="">
                <div class="">{{ Auth::user()->name }}</div>
                <div class="">{{ Auth::user()->email }}</div>
                
            </div>

            <div class="">
                <a href="{{route('profile.edit')}}">Profile</a>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <!--<input type="submit" value="Déconnexion">-->
                    <x-responsive-nav-link :href="route('logout')"
                            onclick="event.preventDefault();
                                        this.closest('form').submit();">
                        {{ __('Déconnexion') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
        @endauth
        @guest
        <a href="{{ route('login') }}">
            Connexion
        </a>

        @if (Route::has('register'))
            <a href="{{ route('register') }}">
                Inscription
            </a>
        @endif
        @endguest
    </div>
