@extends('super-admin')

@section('title', $messageRecu->sujet)

@section('pagetitle')
    <div class="pagetitle">
        <h1>Service client</h1>
        <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('Connected.SuperAdmin.index')}}">Tableau de bord</a> </li>
            <li class="breadcrumb-item">Service client</li>
            <li class="breadcrumb-item">Liste des message reçu</li>
            <li class="breadcrumb-item active"> {{$messageRecu->sujet}}</li>
        </ol>
        </nav>
    </div>
@endsection

@section('content')
    <div class="container">
        <div class="card" style="padding: 10px">
            @php 
            $dates = Carbon\Carbon::parse($messageRecu->updated_at);
            $lu = $dates->format(' D d M Y');
            @endphp
            <h3 style="text-align: center; font-family:Verdana, Geneva, Tahoma, sans-serif">Message reçu et lù le {{$lu}}</h3>
            @php 
                $lecteur = App\Models\User::findOrFail($messageRecu->lecteur);
            @endphp
            <p>Ce message a été ouvert et lù par: {{$lecteur->last_name}} {{$lecteur->name}}, avec le nom d'identifiant {{$lecteur->username}}. </p>
            <div style="text-align: left; margin-left:15px">
                <p>{{$messageRecu->prenon}} {{$messageRecu->nom}}</p>
                <p style="color: blue">{{$messageRecu->email}}</p>
                @php
                $date = Carbon\Carbon::parse($messageRecu->created_at);
                $dateFormated = $date->format('D d M Y');
                @endphp
                <p>{{$dateFormated}}</p>
            </div>
            <div style="text-align: right; margin-right:15px">
                <p>Madame/Monsieur le responsable</p>
                <p style="color: blue">Educa</p>
                <p style="color: red">contact@educa.mg</p>
            </div>
            <div>
                <h6 style="margin-left: 80px"><b style="text-decoration: underline; color:black">Objet:</b> {{$messageRecu->sujet}} </h6 style="margin-left: 80px">
            </div>
            <div>
                <p style="margin-left: 30px">Madame, Monsieur,</p>

                <div class="container" style="padding: 15px">
                    <p style="text-align: justify; margin-bottom:5px">
                        {{$messageRecu->introduction}}
                    </p>
                    <p style="text-align: justify; margin-bottom:5px">
                        {{$messageRecu->contenu}}
                    </p>
                    <p style="text-align: justify; margin-bottom:5px">
                        {{$messageRecu->fin}}
                    </p>
                    <p style="text-align: justify; margin-bottom:5px">En attendant, je vous remercie de prendre le temps de lire ma lettre et j'espère que nous pourrons échanger plus en détail dans un proche avenir. Si vous avez des questions ou si vous souhaitez discuter de cette opportunité, vous pouvez me joindre  par e-mail à <b style="text-decoration: underline; color:blue;">{{$messageRecu->email}}</b>.</p>
                    <p style="text-align: justify">Je vous adresse, Cher(e) Madame/Monsieur le responsable de l'Educa, l'expression de mes salutations distinguées. <br> Cordialement,</p>
                    <h4 style="color: rgb(0, 0, 0); text-align:right; margin-left:15px">{{$messageRecu->prenon}} {{$messageRecu->nom}}</h4>
                </div>
                <div class="text-center">
                    <a href="">
                        <h3 style="color:blue"> <i class="bi bi-arrow-90deg-right"></i> Répondre </h3>
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection