<section>
    <h3>Photo</h3><br>
    @foreach ($errors as $error)
        {{$error}}
    @endforeach
    <div>
        <img class="profil_photo" src="{{Storage::url(Auth::user()->profil)}}" alt="">
    </div><br>
    <form action="{{route('profile.photo')}}" method="post" enctype="multipart/form-data">
    @csrf
    @method('PUT')
        <input class="form-control" type="file" id="formFile" name="profil"><br>
        <input type="submit" value="Mettre à jour" name="Validate" class="btn btn-primary">
    </form>
</section>