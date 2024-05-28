@extends('super-admin')

@section('title', 'Super Admin')

@section('pagetitle')
    <div class="pagetitle">
        <h1>Mon profile</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('Connected.SuperAdmin.index')}}">Tableau de bord</a> </li>
                <li class="breadcrumb-item">Gestion de compte</li>
                <li class="breadcrumb-item"><a href="{{route('Connected.SuperAdmin.Profile.SuperAdmin.setting')}}"> Parametre de compte </a></li>
                <li class="breadcrumb-item active">Information personnelles</li>
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
    <!-- Code ruby -->
        @php 
            /** @var string $name nom de l'utilisateur */
            $name = $profile->name;
            /** @var string $last_name prenon de l'utilisateur*/
            $last_name = $profile->last_name;
            /** @var Date $dateDanniversaire Date d'anniversaire de l'utilisateur */
            $dateDanniversaire = Carbon\Carbon::parse($profile->birthday);
            $birthday = $dateDanniversaire->format('Y-m-d');
            /** @var string $username Nom d'utilisateur */
            $username = $profile->username;
            /** @var string $email Email de l'utilisateur */
            $email = $profile->email;

        @endphp
    <!-- fin du code ruby-->

    <div class="container">
        <form action="" method="post" enctype="multipart/form-data">
            @method('PUT')
            @csrf 
            <!-- nom -->
            <label for="name">Nom*:</label>
            <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" value="{{$name}}" @if(empty($name)) placeholder="Votre nom" @endif>
            @error('name')
                <p style="color: red"> {{$message}} </p>
            @enderror

            <!-- Prenom de l'utilisateur -->    
            <label for="last_name">Prénon*:</label>
            <input type="text" name="last_name" id="last_name" class="form-control @error('last_name') is-invalid @enderror" value="{{$last_name}}"  @if(empty($last_name)) placeholder="Votre prénon" @endif>
            @error('last_name')
                <p style="color: red"> {{$message}} </p>
            @enderror

            <!-- nom d'utilisateur -->
            <label for="username">Nom d'utilisateur*:</label>
            <input type="text" name="username" id="username" class="form-control @error('username') is-invalid @enderror" value="{{$username}}">
            @error('username')
                <p style="color: red"> {{$message}} </p>
            @enderror

            <!-- email -->
            <label for="email">Addresse E-mail*:</label>
            <input type="text" name="email" id="email" class="form-control @error('email') is-invalid @enderror" value="{{$email}}">
            @error('email')
                <p style="color: red"> {{$message}} </p>
            @enderror

            <div class="row mb-3" style="margin-top: 20px">
                <div class="col md-6" style="margin-top: 50px">
                    <!-- Photo de l'utilisateur -->
                    <label for="picture">Photo de profile*:</label>
                    <input type="file" class="form-control" name="picture" id="picture">
                    @error('picture')
                        <p style="color: red"> {{$message}} </p>
                    @enderror
                </div>
                <div class="col md-6 text-center">
                    @if (empty($profile->picture))
                        <img src="{{asset('users-default/default.png')}}" alt="Profile" class="rounded-circle">
                    @else
                        <img src="/storage/{{$profile->picture}}" alt="Profile" class="rounded-circle">
                    @endif
                </div>
            </div>

            <!-- Date d'anniversaire de l'utilisateur -->
            <label for="birthday">Date d'anniversaire*:</label>
            <input type="date" name="birthday" id="birthday" class="form-control @error('birthday') is-invalid @enderror" value="{{$birthday}}">
            
            @error('birthday')
                <p style="color: red"> {{$message}} </p>
            @enderror
            <input type="submit" value="Sauvgarder" class="btn btn-primary" style="width: 100%; margin-top:15px">
        </form>
    </div>
@endsection