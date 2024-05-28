@extends('super-admin')

@section('title', 'Edition d\'un(e) utilisateur')

@section('pagetitle')
    <div class="pagetitle">
        <h1>Gestion de compte</h1>
        <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('Connected.SuperAdmin.index')}}">Tableau de bord</a> </li>
            <li class="breadcrumb-item"><a href="{{route('Connected.SuperAdmin.CompteManagement.Compte.listing')}}">Gestion des comptes</a> </li>
            <li class="breadcrumb-item active">Edition d'un(e) utilisateur</li>
        </ol>
        </nav>
    </div>
@endsection

@section('content')
    @if (session('success'))
        <div class="container alert alert-success text-center">
            {{session('success')}}
        </div>
    @endif

    @if (session('error'))
        <div class="container alert alert-warning text-center">
            {{session('error')}}
        </div>
    @endif

    @php 
        $name = $user->name;
        if (empty($name)) {
            $name = "null";
        }
        $last_name = $user->last_name;
        if (empty($last_name)) {
            $last_name = "null";
        }
        $username = $user->username;
        if (empty($username)) {
            $username = "null";
        }
        $email = $user->email;
        if (empty($email)) {
            $email = "null";
        }
        $rol = "";
        if(empty($rol)) {
            $roles= App\Models\Role::findOrFail($user->role);
            $rol = $roles->title;
        }
    @endphp
        <form action="" method="post">
            @method('PUT')
                <div class="container">
                    <h6>Nom:   {{$name}} </h6>
                    <h6>Nom:   {{$last_name}} </h6>
                    <h6>Nom:   {{$username}} </h6>
                    <h6>Nom:   {{$email}} </h6>
                    <h6>Nom:   {{$rol}} </h6>
                </div>
            @csrf 
            <label for="role">Son rôle</label>
            <select name="role" id="role" class="form-control">
                <option value="">Séléctionner un rôle</option>
                @foreach ($role as $k => $v)
                    <option @if($user->role == $v) selected @endif value="{{$v}}"> {{$k}} </option>
                @endforeach
            </select>
            <input type="submit" value="Confirmer" class="btn btn-primary" style="margin-top:20px">
        </form>
@endsection