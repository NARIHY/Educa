@extends('super-admin')
@php
    $page = "";
    $titre = "";
    if(request()->routeIS('Connected.GestionDuSite.InterfaceVisuel.Acceuil.create')){
        $titre = 'Ajout d\'une publication';
        $page = 'Ajout d\'une publication';
    } else {
        $titre = 'Edition d\'une publication';
        $page = 'Edition d\'une publication';
    }
@endphp

@section('title', $titre)

@section('pagetitle')
    <div class="pagetitle">
        <h1>Interface visuel</h1>
        <nav> 
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('Connected.SuperAdmin.index')}}">Tableau de bord</a> </li>
            <li class="breadcrumb-item"> Interface Visuel </li>
            <li class="breadcrumb-item"><a href="{{route('Connected.GestionDuSite.InterfaceVisuel.Acceuil.index')}}">Acceuil</a> </li>
            <li class="breadcrumb-item active">{{$page}}</li>
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
    <!-- Globale pour la page -->
    <div class="container">
        @if (request()->routeIS('Connected.GestionDuSite.InterfaceVisuel.Acceuil.create'))
            <form action="" method="post" enctype="multipart/form-data">
                @csrf 
                <!-- Pour le titre -->
                <label for="titre"> Titre de la publication: *</label>
                <input type="text" name="titre" id="titre" class="form-control @error('titre') is-invalid @enderror" value="{{@old('titre')}}">
                @error('titre') 
                    <p style="color: red"> {{$message}} </p>
                @enderror
                <!-- Pour le premier contenu -->
                <label for="contenu_1">Le premier contenu de la publication: *</label>
                <textarea name="contenu_1" id="contenu_1" class="form-control @error('contenu_1') is-invalid @enderror" cols="30" rows="10">{{@old('contenu_1')}}</textarea>
                @error('contenu_1') 
                    <p style="color: red"> {{$message}} </p>
                @enderror

                <!-- liste -->
                <label for="liste"> Ajouter un petit liste:</label>
                <input type="text" name="liste" id="liste" class="form-control @error('liste') is-invalid @enderror" value="{{@old('liste')}}">
                <p>Nb: Les listes que vous entrez ici doivent être séparer par une virgule</p>
                @error('liste') 
                    <p style="color: red"> {{$message}} </p>
                @enderror

                <!-- pour l'image -->
                <label for="image">Inserer une image</label>
                <input type="file" name="image" id="image" class="form-control">
                @error('image') 
                    <p style="color: red"> {{$message}} </p>
                @enderror
                
                <!-- Pour la deuxieme contenu -->
                <label for="contenu_2">Le deuxieme contenu de la publication: </label>
                <textarea name="contenu_2" id="contenu_2" class="form-control @error('contenu_2') is-invalid @enderror" cols="30" rows="10">{{@old('contenu_1')}}</textarea>
                @error('contenu_2') 
                    <p style="color: red"> {{$message}} </p>
                @enderror

                <input type="submit" value="Enregistrer" class="btn btn-primary" style="margin-top: 15px; width: 100%">
            </form>
        @else
            <form action="" method="post" enctype="multipart/form-data">
                @csrf 
                @method('PUT')
                <!-- Pour le titre -->
                <label for="titre"> Titre de la publication: *</label>
                <input type="text" name="titre" id="titre" class="form-control @error('titre') is-invalid @enderror" value="{{$acceuilInterface->titre}}">
                @error('titre') 
                    <p style="color: red"> {{$message}} </p>
                @enderror
                <!-- Pour le premier contenu -->
                <label for="contenu_1">Le premier contenu de la publication: *</label>
                <textarea name="contenu_1" id="contenu_1" class="form-control @error('contenu_1') is-invalid @enderror" cols="30" rows="10">{{$acceuilInterface->contenu_1}}</textarea>
                @error('contenu_1') 
                    <p style="color: red"> {{$message}} </p>
                @enderror

                <!-- liste -->
                <label for="liste"> Ajouter un petit liste:</label>
                <input type="text" name="liste" id="liste" class="form-control @error('liste') is-invalid @enderror" value="{{$acceuilInterface->liste}}">
                <p>Nb: Les listes que vous entrez ici doivent être séparer par une virgule</p>
                @error('liste') 
                    <p style="color: red"> {{$message}} </p>
                @enderror

                <!-- pour l'image -->
                <label for="image">Inserer une image</label>
                <div class="row mb-3">
                    <div class="col md-6">
                        <input type="file" name="image" id="image" class="form-control" style="margin-top: 42%">
                        @error('image') 
                            <p style="color: red"> {{$message}} </p>
                        @enderror
                    </div>
                    <div class="col md-6">
                        <img src="/storage/{{$acceuilInterface->image}}" alt="{{$acceuilInterface->titre}}">
                    </div>
                </div>
                
                <!-- Pour la deuxieme contenu -->
                <label for="contenu_2">Le deuxieme contenu de la publication: </label>
                <textarea name="contenu_2" id="contenu_2" class="form-control @error('contenu_2') is-invalid @enderror" cols="30" rows="10">{{$acceuilInterface->contenu_2}}</textarea>
                @error('contenu_2') 
                    <p style="color: red"> {{$message}} </p>
                @enderror
                
                <!-- Pour le status de la publication -->
                <label for="status">Status de la publication: *</label>
                <select name="status" id="status" class="form-control">
                    <option value="">Selectionner un status</option>
                    <option value="0" @if($acceuilInterface->status === '0') selected @endif>Non publier</option>
                    <option value="1" @if($acceuilInterface->status === '1') selected @endif>Publier</option>
                </select>
                @error('status') 
                    <p style="color: red"> {{$message}} </p>
                @enderror

                <input type="submit" value="Enregistrer" class="btn btn-primary" style="margin-top: 15px; width: 100%">
            </form>
        @endif
    </div>

@endsection