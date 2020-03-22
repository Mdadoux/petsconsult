
@section('title','Aperçu consultation-'.$consultation->id."-".$consultation->animal->nom)
@include('includes.header')
<main class="apercu-body" style="background:#ccc;">
    <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
        <div class="apercu-topbar-inner d-flex w-100">
            <div class="col">
                <a class="navbar-brand" href="/consultations/{{$consultation->id}}">Retour à la consultation</a>
            </div>
            <div class="apercu-topbar-title col-6"> Consultation C-00-{{$consultation->id}} : {{$consultation->animal->nom}}</div>
            <div class="apercu-topbar-actionscontainer col">
                <a href="javascript:window.print()" class="btn btn-success">Experoter en PdF</a>
                {{-- <a href="{{URL::to('consultations/pdf/'.$consultation->id)}}" class="btn btn-success">Experoter en PdF</a> --}}
                <a href="/consultations/{{$consultation->id}}" class="btn btn-default">Annuler</a>
            </div>     
        </div>
    </nav>
    <section id="apercu-container" style="padding:80px">
        <div class="container" style="padding:30px;background:white;">
            <section class="apercu-section-primary">
                <header class="d-flex justify-content-between"> 
                    <div class="date">
                        <span>Date</span> : {{$consultation->created_at->format('j M Y')}}
                    </div>                   
                    <div class="doc-coordonee">
                        <srong>Jhon Doea</srong>
                        <dl>Ostéopathe animalier</dl>
                        <dl>06602248750 | jhone.doe@oste.com</dl>
                    </div>
                </header>
                <hr>
               
                <div class="d-flex justify-content-between">
                    <div class="patient-infos">
                        <h5>Patient</h5>
                    @if ($consultation->animal)
                        <dl>N° patient : P-00-{{$consultation->animal->id}}</dl>
                    @endif
                   <p>
                    Nom : {{$consultation->animal->nom}} :
                    </p>
                    @if($consultation->animal->animal_type->designation)                                       
                        Type :<span>{{$consultation->animal->animal_type->designation}}</span>
                    @endif 

                    @if ($consultation->animal->age)
                         <p>Age :{{$consultation->animal->age}} {{intval($consultation->animal->age) > 1  ? 'ans' : 'an'}} </p>
                   
                     @endif 

                     @if ($consultation->animal->race)
                        <p>Race : {{$consultation->animal->race}}</p>                       
                     @endif
                     @if ($consultation->animal->sexe)
                        <p> {{$consultation->animal->sexe}}</p>                     
                    @endif 

                    @if ($consultation->animal->race)
                     <p>Discipline : {{$consultation->animal->discipline}}</p>                   
                    @endif 
                </div>
                <div class="pro-infos">
                    <h5>Proprietaire</h5>
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
            </section>
            <hr>
            <section class="apercu-section-secondary">
                <h5>Details de la consultation</h5>
                <ul>
                @if($consultation->motif_consultation)                         
                    <li>Motif de la consultation : <span>{{$consultation->motif_consultation}}</span></li>
                    @endif
                    @if($consultation->antecedents)
                    <li>  Antécedents : <span>{{$consultation->antecedents}}</span> </li>
                    @endif
                    
                </ul>
            </section>
            <hr>
            <section class="apercu-section-thrid">
                <h5>Bilan</h5>
                @if($consultation->bilan)
                         @include('pages/consultations/consultation-bilan')
                         @else
                            <h5 class="mt-3 text-center">Aucun bilan n'a encore été fait</h5>
                        @endif    
            </section>
            <hr>
            <section class="apercu-section-forth">
                <h5>Conseil</h5>
                @if($consultation->conseils)
                    <p>Conseils <span>{{$consultation->conseils}}</span></p>
                    @endif
            </section>
        </div>
    </section>
</main>

@include('includes.footer')  