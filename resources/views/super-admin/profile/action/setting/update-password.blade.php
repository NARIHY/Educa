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
    <div class="container">
        <form method="post" action="{{ route('password.update') }}" class="mt-6 space-y-6">
            @csrf
            @method('put')
           
            <label for="current_password">Votre Mots de passe actuel*:</label>
            <input type="password" name="current_password" id="current_password" class="form-control @error('current_password') is-invalid @enderror">
            @error('current_password')
                <p style="color: red"> {{$message}} </p>
            @enderror

            <label for="password">Votre nouveau mots de passe*:</label>
            <input type="password" name="password" id="password" class="form-control @error('password') is-invalid @enderror">
            @error('password')
                <p style="color: red"> {{$message}} </p>
            @enderror
            
            <label for="password_confirmation">Votre nouveau mots de passe*:</label>
            <input type="password" name="password_confirmation" id="password_confirmation" class="form-control @error('password_confirmation') is-invalid @enderror">
            @error('password_confirmation')
                <p style="color: red"> {{$message}} </p>
            @enderror
            <input type="submit" value="Sauvgarder" class="btn btn-primary" style="margin-top:15px">
            @if (session('status'))
            <p style="color:green">
                {{session('status')}}
            </p>
            
        @endif
        </form>
    </div>
@endsection