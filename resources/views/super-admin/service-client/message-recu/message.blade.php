@extends('super-admin')

@section('title', 'Listes des messages reçu')

@section('pagetitle')
    <div class="pagetitle">
        <h1>Service client</h1>
        <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('Connected.SuperAdmin.index')}}">Tableau de bord</a> </li>
            <li class="breadcrumb-item">Service client</li>
            <li class="breadcrumb-item active">Liste des message reçu</li>
        </ol>
        </nav>
    </div>
@endsection

@section('content')
    <!-- Liste des message -->
    <table class="table table-striped datatable">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Expéditeur</th>
                <th scope="col">Sujet</th>
                <th scope="col">Status</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($messageRecu as $message)
                <tr>
                    <th scope="row"> {{$message->id}} </th>
                    <td> {{$message->nom}} {{$message->prenon}} </td>
                    <td>{{$message->sujet}}</td>
                    <td>
                        <div class="text-center">
                            <!-- Si le message est à 0 alors personne ne la encore lù -->
                            @if ($message->status !== "0")
                                <i class="bi bi-chat-left-text-fill" style="color: green"></i>
                            @else
                            <i class="bi bi-chat-left-text-fill" style="color: red"></i> 
                            @endif
                        </div>
                    </td>
                    <td>
                        <a href="{{route('Connected.ServiceClient.MessageRecu.vueSurUneMessage', ['messageId' => $message->id])}}" class="btn btn-primary">Voir</a>
                    </td>
                </tr>
            @empty
                <tr>
                    <th scope="row"></th>
                    <td></td>
                    <td> Aucun message pour le moment</td>
                    <td></td>
                    <td></td>
                </tr>
            @endforelse
            
        </tbody>
    </table>
@endsection