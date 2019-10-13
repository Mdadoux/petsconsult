@extends('layouts.template')

@section('title','Consultation-'.$consultation->titre)

@section('content')

<div class="p-2 mb-3">
    <div class="page-title-heading d-flex ">
        <div class="page-title-icon mr-4"><i class="fas fa-heartbeat"></i></div>
        <div>
            <h3>
                Consultation
            </h3>
            <div class="page-title-subheading">{{$consultation->titre}}</div>
        </div>
    </div>
    <div class="page-btn-action mb-4 w-25 ml-auto text-right">
            <a href="#" class="btn btn-primary btn-icon-split">
                <span class="icon text-white-50">
                        <i class="fas fa-pen-square"></i>
                </span>
                <span class="text">Modifier</span>
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
          <div class="card shadow mb-4">
            <div class="card-header py-3 mb-5">
              <h6 class="m-0 font-weight-bold text-primary">Detail de la consultaion</h6>
            </div>
            <div class="consultation-detail-container p-3">                
                <nav>
                    <div class="nav nav-tabs" id="nav-tab" role="tablist">
                        <a class="nav-item nav-link active" id="nav-home-tab"
                         data-toggle="tab" href="#nav-home" role="tab"
                         aria-controls="nav-home" aria-selected="true">
                         Identité
                        </a>
                        <a class="nav-item nav-link" id="nav-profile-tab"
                         data-toggle="tab" href="#nav-profile" role="tab" 
                         aria-controls="nav-profile" aria-selected="false">
                         Bilan
                        </a>
                        <a class="nav-item nav-link" id="nav-contact-tab" data-toggle="tab" href="#nav-contact" role="tab" aria-controls="nav-contact" aria-selected="false">Contact</a>
                    </div>
                </nav>
                <div class="tab-content" id="nav-tabContent">
                    <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                        
                        <p>Nom : {{$consultation->animal['nom']}} </p>                  
                        @if ($consultation->animal['age'])
                            <p>Age : {{$consultation->animal['age']}}</p>  
                        @else
                            <p>Age : {{__('Non communiqué')}}</p>  
                         @endif
                        
                         
                        @if ($consultation->animal['race'])
                           <p>Race : {{$consultation->animal['age']}}</p>  
                        @else
                            <p>Race : {{__('Non communiqué')}}</p>  
                        @endif
                        
                    </div>
                    <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">

                        @if($consultation->animal['blian'])

                            {{$consultation->animal['blian']}}

                            @else
                            <h5 class="mt-3 text-center">Aucun bilan n'a encore été fait</h5>
                        @endif
                        

                    </div>
                    <div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">...</div>
                </div>
            </div>
            
          </div>     
         
        </div>
        <div class="col-3">
                <div class="card shadow">
                    <img class="card-img-top" src="https://images.unsplash.com/photo-1545791740-adcfb5f1575f?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80" alt="Card image cap">
                    <div class="card-body">
                            <h5>{{$consultation->animal['nom']}}</h5>
                        <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                       
                    </div>
                </div>
            
        </div>

        

</div>
    
@endsection