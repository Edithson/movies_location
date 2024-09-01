@extends('index')

@section('content')
<div>
    <table>
        <tr>
            <th>Email : </th>
            <td>{{$user->email}}</td>
        </tr>
        <tr>
            <th>Nom : </th>
            <td>{{$user->name}}</td>
        </tr>
        <tr>
            <th>Type : </th>
            <td>
                <form action="{{route('user.update',$user)}}" method="post">
                    @csrf
                    @method('PUT')
                    <select name="type" id="">
                    @foreach ($types as $type)
                        <option value="{{$type->id}}" 
                        @if ($type->id == $user->type_id) selected @endif
                        >{{$type->intitule}}</option>
                    @endforeach
                    </select> 
                    <input type="submit" value="Changer le grade" class="btn btn-primary">
                </form>
            </td>
        </tr>
    </table><br>
    <form action="{{route('user.destroy', $user)}}" method="post">
        @csrf
        @method('DELETE')
        <input type="submit" value="Suspendre l'utilisateur" class="btn btn-warning">
    </form>
</div>
@endsection