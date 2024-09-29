<p class="mt-1 text-sm text-gray-600">
    Une fois votre compte supprimé, toutes ses ressources et données seront définitivement supprimées.
</p>
<form action="{{route('user.delete_count')}}" method="post">
    @csrf
    @method('DELETE')
    <input type="submit" value="Supprimer mon compte" class="btn btn-danger">
</form>

<!-- <a href="{{route('user.delete_count', Auth::user()->id)}}"><button class="btn btn-danger">Supprimer mon compte</button></a> -->