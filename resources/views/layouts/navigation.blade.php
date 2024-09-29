<div class="nav_bar" id="nav_bar">
<span class="hide" id="num_menu">menu_{{$_SERVER['REQUEST_URI']}}</span>
        <ul>
            <li><a href="{{route('dashboard')}}" id="menu_seance">Projection</a></li>
            <li><a href="{{route('film.index')}}" id="menu_film">Film</a></li>
            @auth
            <li><a href="{{route('salle.index')}}" id="menu_salle">Salles</a></li>
            <li><a href="{{route('reservation.index')}}" id="menu_reservation">Mes réservations</a></li>
            @if (Auth::user()->type_id > 1)
            <li><a href="{{route('user.index')}}" id="menu_user">Utilisateurs</a></li>
            @endif
            @endauth
        </ul>

    <div class="profil_option" id="profil_option">
        @auth
        <ul>
            <li>
                <a href="">{{ Auth::user()->name }}</a>
                <ul>
                    <li><a href="{{route('profile.edit')}}" id="menu_profile">Profile</a></li>
                    <li>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <!--<input type="submit" value="Déconnexion">-->
                            <a href="route('logout')"
                                    onclick="event.preventDefault();
                                    this.closest('form').submit();">
                                Déconnexion
                            </a>
                        </form>
                    </li>
                </ul>
            </li>
        </ul>

        @endauth
        @guest
        <div>
            <a href="{{ route('login') }}" id="menu_login">Connexion</a>
            @if (Route::has('register'))
            <a href="{{ route('register') }}" id="menu_register">Inscription</a>
            @endif
        </div>

        @endguest
    </div>
</div>
<br>