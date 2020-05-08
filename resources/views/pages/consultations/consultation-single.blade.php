@extends('layouts.template')

@section('title','Consultation-'.$consultation->titre)

@section('content')

<div class="p-2 mb-3">
    <div class="page-title-heading d-flex ">
        <div class="page-title-icon mr-4"><i class="fas fa-heartbeat"></i></div>
        <div>
            <h3> Consultations</h3>                      
            <div>Consultation n° : <strong>C-00-{{$consultation->id}}</strong>  </div>        
            <div class="page-title-subheading">{{$consultation->titre}}</div>
            @if ($consultation->animal)             
                <div>Paient n° : <strong>P-00-{{$consultation->animal->id}}</strong> </div>
            @endif
            </div>
    </div>
    <div class="page-btn-action w-50 ml-auto text-right">
            <a href="{{route('consultations.edit',$consultation->id)}}" class="btn btn-primary btn-icon-split"><span class="icon text-white-50"> <i class="fas fa-pen-square"></i> </span>
                <span class="text">Modifier</span>
            </a>
            <a href="/consultations/viewer/{{$consultation->id}}" class="btn btn-danger btn-icon-split">
                    <span class="icon text-white-50">
                            <i class="far fa-eye"></i>
                    </span>
                    <span class="text">Aperçu</span>
            </a>
            <a href="#" class="btn btn-danger btn-icon-split">
                <span class="icon text-white-50">
                    <i class="fas fa-trash"></i>
                </span>
                <span class="text">Supprimer</span>
        </a>
    </div>
<a href="{{route('consultations.index')}}">Retour</a>
</div>

<div class="row">

        <div class="col-9">

          <!-- Circle Buttons -->
          <div class="card mb-4">
            <div class="card-header py-3 mb-5">
              <h6 class="m-0 font-weight-bold text-primary">Detail de la consultaion</h6>
            </div>
            <div class="consultation-detail-container p-3">                
                <nav>
                    <div class="nav nav-tabs" id="nav-tab" role="tablist">
                        <a class="nav-item nav-link active" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">Bilan</a>  
                        <a class="nav-item nav-link" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true"> Infos</a>                        
                        <a class="nav-item nav-link" id="nav-contact-tab" data-toggle="tab" href="#nav-contact" role="tab" aria-controls="nav-contact" aria-selected="false">Contact</a>
                    </div>
                </nav>
                <div class="tab-content" id="nav-tabContent">
                    <div class="tab-pane fade" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">                        
                        <ul class="liste-consultation-details">
                            <li>
                                <h5>Consultation réalisé le</h5>
                                <span>{{$consultation->created_at->format('j M ,Y')}}</span>
                            </li>       
                            @if($consultation->motif_consultation)                         
                            <li>
                                <h5>Motif de la Consultation </h5>
                                <span>{{$consultation->motif_consultation}}</span>
                            </li>
                            @endif
                            @if($consultation->antecedents)
                            <li>
                                <h5>Antécedents</h5>
                                <span>{{$consultation->antecedents}}</span>                                
                            </li>
                            @endif
                            @if($consultation->conseils)
                            <li>Conseils
                                <span>{{$consultation->conseils}}</span>
                            </li>
                            @endif
                        </ul>                        
                    </div>
                    <div class="tab-pane fade show active" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">                       
                        @if($consultation->bilan)
                         @include('pages/consultations/consultation-bilan')
                         @else
                            <h5 class="mt-3 text-center">Aucun bilan n'a encore été fait</h5>
                        @endif                     

                    </div>
                    <div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">
                        <h4>Coordonée</h4>

                        @if(is_object($proprietaire) && !empty($proprietaire))
                           <p>{{$proprietaire->nom}} {{$proprietaire->prenom}}</p> 
                            @if($proprietaire->telephone)
                                <p> Tel : {{$proprietaire->telephone}}</p>
                            @endif
                            @if($proprietaire->email)
                                <p> Email : {{$proprietaire->email}}</p>
                            @endif
                            @if($proprietaire->adresse)
                                    <span>{{$proprietaire->adresse}}</span>
                            @endif
                            @if($proprietaire->code_postal)
                                    <span>{{$proprietaire->code_postal}}</span>
                            @endif
                            @if($proprietaire->ville)
                                    <span>{{$proprietaire->ville}}</span>
                            @endif
                            
                       
                           @else
                           <p>{{$proprietaire}}</p>
                        @endif
                    </div>
                </div>
            </div>
            
          </div>     
         
        </div>
        <div class="col-3">          
                <div class="card widget-patient-profile-card">
                    @include('pages/patients/patient-image')
                    <div class="card-body">
                            <h5>{{$consultation->animal->nom}}</h5>                               
                        <div class="card-text">                            
                            <div class="row">
                                <div class="col-7">
                                        @if($consultation->animal->animal_type["designation"])                                       
                                        <span>{{$consultation->animal->animal_type["designation"]}}</span>
                                        @endif  
                                </div>
                                <div class="col-5">
                                    @if ($consultation->animal->age)
                                        <p>{{$consultation->animal->age}} {{intval($consultation->animal->age) > 1  ? 'ans' : 'an'}} </p>
                                    @else
                                        <p>Age : {{__('Non communiqué')}}</p>  
                                    @endif    
                                </div>

                            </div>
                            <div class="row">
                                <div class="col-7">
                                    @if ($consultation->animal->race)
                                        <p>Race : {{$consultation->animal->race}}</p>  
                                    @else
                                        <p>Race : {{__('Non communiqué')}}</p>  
                                    @endif
                                </div>
                                <div class="col-5">
                                    @if ($consultation->animal->sexe)
                                        <p> {{$consultation->animal->sexe}}</p>  
                                    @else
                                        <p>Sexe : {{__('Non communiqué')}}</p>  
                                    @endif 
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-7">
                                   @if ($consultation->animal->race)
                                        <p>Discipline : {{$consultation->animal->discipline}}</p>  
                                   @else
                                       <p>Discipline : {{__('Non communiqué')}}</p>  
                                   @endif 
                                </div>
                                <div class="col-5"></div>
                            </div>
                                                      
                        </div>                       
                    </div>
                </div>
            
        </div>

        

</div>
    
@endsection