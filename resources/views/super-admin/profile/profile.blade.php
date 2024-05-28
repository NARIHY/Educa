@extends('super-admin')

@section('title', 'Mon compte')

@section('pagetitle')
    <div class="pagetitle">
        <h1>Mon profile</h1>
        <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('Connected.SuperAdmin.index')}}">Tableau de bord</a> </li>
            <li class="breadcrumb-item active">Gestion de compte</li>
            <li class="breadcrumb-item active">Mon compte</li>
        </ol>
        </nav>
    </div>
@endsection

@section('content')
    <div class="container text">
        <div class="card" style="padding: 20px">
            <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">
                @if (empty($profile->picture))
                    <img src="{{asset('users-default/default.png')}}" alt="Profile" class="rounded-circle">
                @else
                    <img src="/storage/{{$profile->picture}}" alt="Profile" class="rounded-circle">
                @endif
                @php
                    $name = $profile->name;
                    $last_name = $profile->last_name;
                    if (empty($name)) {
                    $name = "Null";
                    }
                    if (empty($last_name)) {
                    $last_name = "Null";
                    }
              @endphp
                <h2> {{$last_name}} {{$name}} </h2>
                <h5> {{'@'.$profile->username}} </h5>
            </div>
                    @php
                        //Récuperation du rôle de l'utilisateur
                        $roles = App\Models\Role::findOrFail($profile->role);
                        // formatage de date avec carbone
                        $dateCreation = Carbon\Carbon::parse($profile->created_at);
                        $formatCreation = $dateCreation->format('D d M Y');
                        //récupération du status, On vas mettre tous à null si il est vide
                        $status = $profile->status;
                        if (empty($status)) {
                            $status = "Null";
                        }
                        $birthday = null;
                        //il y en as un bug sur ce partie
                        $dateDaniversaire = $profile->birthday;
                        if ($dateDaniversaire) {
                            $date = Carbon\Carbon::parse($dateDaniversaire);
                            $birthday = $date->format('D d M Y'); 
                        } else {
                            $birthday = "Null";
                        }
                        
                    @endphp
            <div class="row mb-3">
                <div class="col md-6 text-center">
                    <h4>Role: </h4>
                    <h4>Status: </h4>
                    <h4>Date d'anniversaire: </h4>
                    <h4>Date de création du compte: </h4>
                </div>
                <div class="col md-6 text-center">
                    <h4> {{$roles->title}} </h4>
                    <h4> {{$status}} </h4>
                    <h4> {{$birthday}} </h4>
                    <h4> {{$formatCreation}} </h4>
                </div>
            </div>
        </div>
    </div>
@endsection