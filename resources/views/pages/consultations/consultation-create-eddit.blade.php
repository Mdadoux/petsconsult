@extends('layouts.template')

@section('title','Création consultation')

@section('content')
<div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">{{__('Nouvelle consultation')}}</h1>
        <p class="mb-4">DataTables is a third party plugin that is used to generate the demo table below. For more information about DataTables, please visit the <a target="_blank" href="https://datatables.net">official DataTables documentation</a>.</p>

        <div class="ml-auto w-25 text-right mb-3">
            <a href="" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
              <i class="fas fa-plus fa-sm text-white"></i>
              <span>Nouveau patient ?</span> 
            </a>
        </div>
</div>
<div class="consultation-container" style="width:80%;">
    <ul class="nav nav-tabs" id="myTab" role="tablist">
        <li class="nav-item">
            <a class="nav-link active" id="consultation-resume-tab" data-toggle="tab" href="#consultation-summary" role="tab" aria-controls="home" aria-selected="true">Resume</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="consulation-details-tab" data-toggle="tab" href="#consultation-details" role="tab" aria-controls="contact" aria-selected="false">Détails</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="consultation-bilan-tab" data-toggle="tab" href="#consultation-bilan" role="tab" aria-controls="profile" aria-selected="false">Bilan</a>
        </li>
    </ul>   

<form action="{{route('consultations.store')}}" method="POST">
        @csrf
    <div class="tab-content" id="myTabContent">
            
        <div class="tab-pane fade show active" id="consultation-summary" role="tabpanel" aria-labelledby="home-tab">
           
           <div class="row">
               <div class="col-sm-12">
                   <div class="form-grou my-5">
                       <label for="consultation-titre">Titre</label>
                       <input type="texte" name="consultation-titre" id="consultation-titre"
                       class="form-control"
                       required
                       placeholder="Donner un titre à laconsultation">
                    </div>
               </div>
           </div>
           
            <div class="row patient-row" id="patient-row">
                <div class="col-sm-12">
                    <h3>Patient</h3><span>Si le patient existe, selectionnez le sur le champs de recherche sinon remplissez le formulaire</span>
                    <hr>

                    <div class="search-patient-container d-flex align-items-center mb-5">
                         <button type="button" class="btn btn-success btn-show-create-patient-form">
                            Ajouter un nouveau patient     
                        </button>   
                        <div class="search-patient-form d-flex ml-auto w-50 justify-content-end">
                            <p><strong>Ou choisir un dans la liste</strong></p>
                            <div class="ml-3 spin-input-container">
                                <div class="spin-input-group">
                                    <div class="spinner-border text-primary spinner-border-sm" role="status" id="search-spinner">
                                        <span class="sr-only">Loading...</span>
                                    </div>
                                    <input type="text"  class="form-control" placeholder="choisir un patient parmis la liste" id="input-search-animal">
                                </div>
                                
                                <div class="dropdown-list dropdown-menu-right shadow animated--grow-in" id="animal-search-result">                                       
                                                                              
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="patient-row-form-wrapper">
                        <input type="hidden" name="patient-id" id=patient-id>
                        <div class="form-row">
                            <div class="col-md-4 mb-3">
                              <label for="nom">Nom</label>
                              <input type="text" class="form-control" name="nom" id="nom" placeholder="Entrez un nom">
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="race">Type</label>
                                <select class="form-control" id="animal-type" name="animal-type">
                                  <option value="0">Selectionner un type</option>
                                  @if(!empty($types_animaux))
                                      @foreach($types_animaux as $type_animal)
                                         <option value="{{$type_animal->id}}">{{ucfirst($type_animal->designation)}}</option>
                                      @endforeach
                                   @endif
                                </select>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label  for="race">Sexe</label>
                                <select class="form-control" id="animal-sexe" name="animal-sexe">
                                    <option value="0">Selectionner</option>
                                    <option value="1">Mâl</option>
                                    <option value="2">Femelle</option>
                                   </select>
                            </div>
                        </div>
                          <div class="form-row">
                              <div class="col-md-4 mb-3">
                                  <label for="discipline">Discipline</label>                  
                                    <input type="text" class="form-control" id="discipline" name="animal-discipline" placeholder="Discipline">
                                </div>
                             
                                <div class="col-md-2 mb-3">
                                    <label  for="race">Age</label>
                                    <input type="number" min="0" class="form-control" id="age" name="animal-age" placeholder="0">
                                </div>
                                <div class="col-md-2 mb-3">
                                  <label  for="race">Race</label>
                                  <input type="text" class="form-control" id="animal-race" name="animal-race" placeholder="Race">
                              </div>
                              <div class="col-md-4 mb-3">
                                  <label  for="race">Propriétaire</label>
                                  <select class="form-control" id="proprietaire" name="animal-proprietaire">
                                      <option value="0">Selectionner</option>
                                      @if(!empty($proprietaires))
                                        @foreach($proprietaires as $proprietaire)                             
                                          <option value="{{$proprietaire->id}}">{{$proprietaire->nom}} - {{$proprietaire->prenom}}</option>                                 
                                        @endforeach
                                      @endif
                                  </select>
                              </div>
                          </div>
                    </div>
                </div>
            </div>
          
            <div class="row">
                <div class="col-sm-12">
                    <h3>Propriétaire</h3><span>Si le prépiéatire existe, selectionnez le sur le champs de recherche sinon remplissez le formulaire</span>    
                    <hr>
                </div>    
            </div>
        </div>
        <div class="tab-pane fade" id="consultation-details" role="tabpanel" aria-labelledby="consultation-details-tab">
            <h2>Détails</h2>

            <div class="form-row">
                    <div class="form-group col-md-6">
                      <label for="input-motif-consultation">Motif de la consultation</label>
                      <input type="text" class="form-control" id="input-motif-consultation" name="input-motif-consultation" placeholder="Motifs de la consultation">
                    </div>
                    <div class="form-group col-md-6">
                      <label for="input-antecedant-consultation">Antécédents</label>
                      <input type="text" class="form-control" id="input-antecedent-consultation" name="input-antecedent-consultation" placeholder="Marquez les antécédents">
                    </div>                   
                  </div>
                  <div class="form-group">
                    <label for="consultation-conseils">Conseils et repos remise au travail </label>
                    <textarea class="form-control" id="consultation-conseils" name="consultation-conseils" rows="8"></textarea>
            </div>
        </div>
        <div class="tab-pane fade" id="consultation-bilan" role="tabpanel" aria-labelledby="consultation-bilan-tab">
                <h2>Bilan</h2>
                <label for="consultation-conseils">Bilan de consultation</label>
                <textarea class="form-control" id="consultation-bilan" name="consultation-bilan" style="display:none" ></textarea>
        </div>
    </div>
    
    <p><button  type="submit" class="btn btn-primary ml-auto">Enregistrer</button></p>
</form>
</div>



@endsection