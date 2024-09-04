@extends('index')

@section('content')
<div>
    <p>Vous ne pouvez pas programmer cette séance qui ira du {{$DateDebut}} au {{$DateFin}} dans la salle {{$salle->nom}} car elle entre en conflit avec une autre séance dans la meme salle</p>
    @foreach ($seances as $une_seance)
        <p>En effet, il sera programmé en {{$salle->nom}} entre le {{$une_seance->date_heure_debut}} et le {{$une_seance->date_heure_fin}} le film {{$une_seance->film->titre}}</p>
    @endforeach
    <br>
    @if (isset($seance))
        <a href="{{route('seance.edit', $seance)}}"><button class="btn btn-primary">OK, je comprends</button></a>
    @else
        <a href="{{route('seance.create')}}"><button class="btn btn-primary">OK, je comprends</button></a>
    @endif
</div>
@endsection