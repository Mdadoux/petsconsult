@extends('layouts.template')

@section('title','Liste des propriétaires')
    
@section('content')

<div class="container-fluid">
    <h1>Proprietaires</h1>
    <header class="d-flex">
        <a href="#" class="add-new-owner btn btn-success"><i class="fas fa-plus"></i></a>
    </header>
    <div class="proprietaires-container">        
        <div class="liste-proprietaires">
            <div class="card-deck d-flex">
                @foreach ($listeProprietaires as $proprietaire)                    
                <div class="card prop-item">
                        <header class="d-flex">
                            <div class="prop-initials-container text-center" style="width: 50px;">
                                {{substr($proprietaire->nom,0,1)}}{{substr($proprietaire->prenom,0,1)}}
                            </div>
                            <div class="btn-group ml-auto">
                                 <button href="#" class="btn prop-btn-details" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                     <i class="fas fa-ellipsis-h"></i>                                
                                 </button>
                                 <div class="dropdown-menu dropdown-menu-right" id="mydrop">

                                    <button class="dropdown-item update-owner-details" data-propid="{{$proprietaire->id}}">Modifier</button>
                                    <a class="dropdown-item"
                                            id="{{$proprietaire->id}}" href="#"
                                            data-titre="{{$proprietaire->nom}} {{$proprietaire->prenom}}"
                                            data-toggle="modal" 
                                            data-target="#delete-modal"
                                            data-form-route="{{route('proprietaires.destroy','proprietaire')}}">Supprimer
                                    </a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="#">Envoyer un email</a>
                                </div>
                            </span>
                        </header>
                        <div class="card-body">
                            <h5 class="card-title">
                                <span class="proprietaire-nom">{{$proprietaire->nom}}</span>
                                <span class="proprietaire-prenom">{{$proprietaire->prenom}}</span>
                            </h5>
                            <div class="card-content">
                                <ul>
                                    @if($proprietaire->telephone)
                                    <li>{{$proprietaire->telephone}}</li>
                                    @endif
                                    @if($proprietaire->email)
                                    <li>{{$proprietaire->email}}</li>
                                    @endif
                                    @if($proprietaire->ville)
                                    <li>{{$proprietaire->ville}}</li>
                                    @endif
                                </ul>
                                <button class="show-owner-details btn btn-primary" data-propid="{{$proprietaire->id}}">Détails</button>
                            </div>
                        </div>
                        <div class="card-footer">
                            <small class="text-muted">{{$proprietaire->created_at}}</small>
                        </div>
                </div>                
                @endforeach
            </div>
        </div>

        <aside class="proprietaire-details-container">
            <button class="add-prop-action-close btn ml-auto d-flex">
                <i class="fas fa-times"></i>
            </button>
            
            <div class="proprietaires-details-inner">            
                    <div class="spinner-border text-primary spinner-border-md" role="status">
                        <span class="sr-only">Loading...</span>
                    </div>    
            </div>
        </aside>


    </div>
</div>
@endsection