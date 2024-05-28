@extends('super-admin')

@section('title', 'Gestion des rôle')


@section('pagetitle')
    <div class="pagetitle">
        <a href="{{route('Connected.SuperAdmin.CompteManagement.Role.create')}}" style="float: right" class="btn btn-success">Ajouter</a>
        <h1>Gestion de compte</h1>
        <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('Connected.SuperAdmin.index')}}">Tableau de bord</a> </li>
            <li class="breadcrumb-item"><a href="{{route('Connected.SuperAdmin.CompteManagement.Role.listing')}}">Gestion des rôle</a> </li>
            <li class="breadcrumb-item active">Liste des rôle</li>
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


    <table class="table table-striped datatable">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Titre</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($role as $roles)
                <tr>
                    <th scope="row"> {{$roles->id}} </th>
                    <td> {{$roles->title}} </td>
                    
                    <td>
                        <a href="{{route('Connected.SuperAdmin.CompteManagement.Role.edit', ['roleId' => $roles->id])}}" class="btn btn-primary">Editer</a>
                    </td>
                </tr>
            @empty
                <tr>
                    <th scope="row"></th>
                    <td>Aucun rôle pour le moment</td>
                    <td></td>
                </tr>
            @endforelse
            
        </tbody>
    </table>
@endsection