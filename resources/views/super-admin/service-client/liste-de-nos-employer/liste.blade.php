@extends('super-admin')

@section('title', 'Liste de nos employer')

@section('pagetitle')
    <div class="pagetitle">
        <h1>Service Client</h1>
        <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('Connected.SuperAdmin.index')}}">Tableau de bord</a> </li>
            <li class="breadcrumb-item active">liste de nos employer</li>
        </ol>
        </nav>
    </div>
@endsection

@section('content')
    <div class="container">
        <table class="table table-striped datatable">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nom</th>
                    <th scope="col">Prénon</th>
                    <th scope="col">Employe</th>
                    <th scope="col">Contacte</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($employer as $users)
                        @php 
                            $roles = App\Models\Role::findOrFail($users->role);
                        @endphp
                    <tr>
                        <th scope="row"> {{$users->id}} </th>
                        <td> {{$users->name}} </td>
                        <td>{{$users->last_name}}</td>
                        <td>{{$roles->title}}</td>
                        <td>
                            {{$users->email}}
                        </td>
                    </tr>
                @empty
                    <tr>
                        <th scope="row"></th>
                        <td></td>
                        <td> Aucun employer pour le moment</td>
                        <td></td>
                        <td></td>
                    </tr>
                @endforelse
                
            </tbody>
        </table>
    </div>
@endsection