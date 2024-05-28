@extends('super-admin')

@section('title', 'Gestion des comptes')


@section('pagetitle')
    <div class="pagetitle">
        <h1>Gestion de compte</h1>
        <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('Connected.SuperAdmin.index')}}">Tableau de bord</a> </li>
            <li class="breadcrumb-item"><a href="{{route('Connected.SuperAdmin.CompteManagement.Compte.listing')}}">Gestion de compte</a> </li>
            <li class="breadcrumb-item active">Liste des comptes</li>
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
                <th scope="col">Nom</th>
                <th scope="col">Prénon</th>
                <th scope="col">Username</th>
                <th scope="col">Rôle</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($user as $users)
                    @php 
                        $roles = App\Models\Role::findOrFail($users->role);
                    @endphp
                <tr>
                    <th scope="row"> {{$users->id}} </th>
                    <td> {{$users->name}} </td>
                    <td>{{$users->last_name}}</td>
                    <td>{{$users->username}}</td>
                    <td>{{$roles->title}}</td>
                    <td>
                        <div class="row mb-3">
                            <div class="col md-6">
                                <a href="{{route('Connected.SuperAdmin.CompteManagement.Compte.edit', ['userId' => $users->id])}}" class="btn btn-primary">Editer</a>
                            </div>
                            <div class="col md-6">
                                <form action="{{route('Connected.SuperAdmin.CompteManagement.Compte.delete', ['userId' => $users->id])}}" method="post">
                                    @csrf 
                                    @method('DELETE')
                                    <input type="submit" class="btn btn-danger" value="Suprimer">
                                </form>
                            </div>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <th scope="row"></th>
                    <td></td>
                    <td></td>
                    <td> Aucun utilisateur pour le moment</td>
                    <td></td>
                    <td></td>
                </tr>
            @endforelse
            
        </tbody>
    </table>
@endsection