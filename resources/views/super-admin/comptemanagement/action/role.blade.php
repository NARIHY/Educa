@extends('super-admin')
@php
    $title = "";
    if(request()->routeIS('Connected.SuperAdmin.CompteManagement.Role.create')){
        $title = 'Ajout d\'un role';
    } else {
        $title = 'Edition d\'un role';
    }
@endphp
@section('title', $title)

@section('pagetitle')
    <div class="pagetitle">
        <h1>Gestion de compte</h1>
        <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('Connected.SuperAdmin.index')}}">Tableau de bord</a> </li>
            <li class="breadcrumb-item"><a href="{{route('Connected.SuperAdmin.CompteManagement.Role.listing')}}">Gestion des rôle</a> </li>
            <li class="breadcrumb-item active">{{$title}}</li>
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
    @if(request()->routeIS('Connected.SuperAdmin.CompteManagement.Role.create'))
        <!-- Vue d'ajout --->
        <div class="container">
            <form action="" method="post">
                @csrf 
                <label for="title">Rôle: </label>
                <input type="text" name="title" id="title" class="form-control @error('title') is-invalid @enderror" value="{{@old('title')}}">
                @error('title')
                    <p style="color: red"> {{$message}} </p>
                @enderror
                <input type="submit" value="Valider" class="btn btn-primary" style="margin-top: 15px">
            </form>
        </div>
    @else
        <!-- Vue d'édition --->
        <div class="container">
            <form action="" method="post">
                @csrf 
                @method('PUT')
                <label for="title">Rôle: </label>
                <input type="text" name="title" id="title" class="form-control @error('title') is-invalid @enderror" value="{{$role->title}}">
                @error('title')
                    <p style="color: red"> {{$message}} </p>
                @enderror
                <input type="submit" value="Valider" class="btn btn-primary" style="margin-top: 15px">
            </form>
        </div>
    @endif
@endsection