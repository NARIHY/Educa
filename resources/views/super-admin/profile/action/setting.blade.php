@extends('super-admin')

@section('title', 'Super Admin')

@section('pagetitle')
    <div class="pagetitle">
        <h1>Mon profile</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('Connected.SuperAdmin.index')}}">Tableau de bord</a> </li>
                <li class="breadcrumb-item">Gestion de compte</li>
                <li class="breadcrumb-item active">Parametre de compte</li>
            </ol>
        </nav>
    </div>
@endsection

@section('content')
    <div class="container">
        <h2>Paramètre du compte</h2>  
        <ul> 
            <li class="nav-link"><a href="{{route('Connected.SuperAdmin.Profile.SuperAdmin.editInformation')}}"> <h5>Information personnelles</h5> </a></li>
            <li class="nav-link"><a href="{{route('Connected.SuperAdmin.Profile.SuperAdmin.passwordUpdate')}}"> <h5>Modifier vos information personnelles</h5> </a></li>
            <li class="nav-link"><a href=""> <h5>Authentification à deux facteur</h5> </a></li>
            <!-- Supression du compte -->
            <div class="modal fade" id="exampleModalToggle" aria-hidden="true" aria-labelledby="exampleModalToggleLabel" tabindex="-1">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalToggleLabel">Suppression de votre compte</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <p>
                                Une fois que vous avez supprimer votre compte, toutes les informations qui vous concerne seras suprimer,
                                seule quelques information sur vous qui est relier directement à notre entités ne seras pas suprimer.
                                Pour pouvoir supprimer votre compte, veuillez entrer votre mots de passe. 
                                
                            </p>
                            <p style="color:red">
                                Nb: cette action est irréversible, faite attention. Soyez sur avant de le faire.
                            </p>
                            <form action="{{route('Connected.SuperAdmin.Profile.SuperAdmin.destroy')}}" method="post" enctype="multipart/form-data">
                                @csrf
                                @method('delete')
                                <label for="password">Mots de passe</label>
                                <input type="password" name="password" id="password" class="form-control"/>
                                <!-- Divisons par deux ces bouton -->
                                <div class="row mb-3">
                                    <div class="col md-6">
                                        <button type="button" class="btn btn-secondary" style="width: 100%; margin-top: 15px" data-bs-dismiss="modal" aria-label="Close">Annuler</button>
                                    </div>
                                    <div class="col md-6">
                                        <input type="submit" class="btn btn-danger" style="width: 100%; margin-top: 15px" value="Suprimer"/>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <p>NARIHY</p>
                        </div>
                    </div>
                </div>
            </div>
            <li class="nav-link"><a data-bs-toggle="modal" href="#exampleModalToggle" role="button"> <h5>Supprimer votre compte</h5> </a></li>    
        </ul>  
    </div>  
        
@endsection