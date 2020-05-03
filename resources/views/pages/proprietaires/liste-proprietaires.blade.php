@extends('layouts.template')

@section('title','Liste des propriétaires')
    
@section('content')

<section class="page-container --page-proprietaire">
    <h1 class="page-title">Proprietaires <span>{{count($listeProprietaires)}}</span></h1>
    <header class="d-flex">
        <a href="#" class="add-new-owner btn btn-success"><i class="fas fa-plus"></i></a>
    </header>
    <div class="proprietaires-container">        
        <div class="liste-proprietaires">         
            @foreach ($listeProprietaires as $proprietaire)                    
            <div class="card prop-item">
                <header class="d-flex card-header">
                    <div class="prop-initials-container">{{substr($proprietaire->nom,0,1)}}{{substr($proprietaire->prenom,0,1)}}</div>
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
                    </div>                       
                </header>
                    <div class="card-body">
                        <h5 class="card-title">
                            <span class="proprietaire-nom">{{$proprietaire->nom}}</span>
                            <span class="proprietaire-prenom">{{$proprietaire->prenom}}</span>
                        </h5>
                        <div class="card-content">
                            <ul class="coord-list">
                                @if($proprietaire->telephone)
                                <li><i class="fas fa-phone-alt"></i>{{$proprietaire->telephone}}</li>
                                @endif
                                @if($proprietaire->email)
                                <li><i class="fas fa-envelope"></i>{{$proprietaire->email}}</li>
                                @endif
                                @if($proprietaire->ville)
                                <li><i class="fas fa-map-marker-alt"></i>{{$proprietaire->ville}}</li>
                                @endif
                            </ul>
                            
                        </div>
                    </div>
                    <button class="show-owner-details btn" data-propid="{{$proprietaire->id}}">Détails</button>
                    <div class="card-footer">
                        <small class="text-muted">{{$proprietaire->created_at}}</small>
                    </div>
            </div>                
            @endforeach
        </div> 
        <div class="proprietaires-pagination-container"> {{$listeProprietaires->links()}}</div>
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
</section>
@endsection