@extends('super-admin')

@section('title', 'Interface visuel')

@section('pagetitle')
    <div class="pagetitle">
        <a href="{{route('Connected.GestionDuSite.InterfaceVisuel.Acceuil.create')}}" class="btn btn-success" style="float: right">Créer</a>
        <h1>Interface visuel</h1>
        <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('Connected.SuperAdmin.index')}}">Tableau de bord</a> </li>
            <li class="breadcrumb-item active">Acceuil</li>
        </ol>
        </nav>
    </div>
@endsection

@section('content')
    <div class="container">
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
        <!-- Liste des message -->
        <table class="table table-striped datatable">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">titre</th>
                    <th scope="col">Status</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($acceuilInterface as $acceuil)
                    <tr>
                        <th scope="row"> {{$acceuil->id}} </th>
                        <td> {{$acceuil->titre}}  </td>
                        <td>
                            @if($acceuil->status === '0')
                                Non publié
                            @else
                                Publié
                            @endif
                        </td>
                        <td>
                            <div class="row mb-3">
                                <div class="col md-6">
                                    <a href="{{route('Connected.GestionDuSite.InterfaceVisuel.Acceuil.edit',['acceuilId' => $acceuil->id])}}" class="btn btn-primary">Editer</a>
                                </div>
                                <div class="col md-6">
                                    <form action="{{route('Connected.GestionDuSite.InterfaceVisuel.Acceuil.destroy', ['acceuilId' => $acceuil->id])}}" method="post">
                                        @csrf 
                                        @method('DELETE')
                                        <input type="submit" value="Suprimer" class="btn btn-danger">
                                    </form>
                                </div>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <th scope="row"></th>
                        <td> Aucune publication pour le moment</td>
                        <td></td>
                        <td></td>
                    </tr>
                @endforelse
                
            </tbody>
        </table>
    </div>
@endsection