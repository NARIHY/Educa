@extends('admin')

@section('title', 'Administration')

@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Tableau de bord</h1>
    </div>

    <!-- Content Row header pour les globalité-->
    <div class="row">

        <!--nombre de cours creer -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Nombre de cour</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">0</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-calendar fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Nombre de leçon publier -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Leçon publier</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">0</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
         <!-- Soldes du proffesseur -->
         <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Solde</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">0 MGA</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        

        <!-- Nombre de personne qui Suit le cours -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Suivi</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">0</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-comments fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Cours en vedette limite 2 -->
    <div class="container">
        <h2>Vos cours en vedette:</h2>
        <div class="row mb-3">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-title">
                        <img src="{{asset('public/assets/img/course-1.jpg')}}" class="img-fluid" alt="...">
                    </div>
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h4>Web Development</h4>
                            <p class="price" style="color: green">0 MGA</p>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <p>Nombre de j'aime</p> <br>
                                <p>Nombre de suivi</p>
                            </div>
                            <div class="col-md-6" style="text-align: right">
                                <p>0</p> <br>
                                <p>0</p>
                            </div>
                        </div>
                    </div>
                </div>        
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-title">
                        <img src="{{asset('public/assets/img/course-1.jpg')}}" class="img-fluid" alt="...">
                    </div>
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h4>Web Development</h4>
                            <p class="price" style="color: green">0 MGA</p>
                        </div>

                        <div class="row">
                            <div class="col-md-6" style="text-align: right">
                                <p>Nombre de j'aime</p> <br>
                                <p>Nombre de suivi</p>
                            </div>
                            <div class="col-md-6">
                                <p>0</p> <br>
                                <p>0</p>
                            </div>
                        </div>
                    </div>
                </div>        
            </div>
        </div>
        
    </div>
@endsection