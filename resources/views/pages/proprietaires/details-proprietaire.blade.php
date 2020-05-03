<section class="details-proprietaire-container">
<header class="proprietaire-header">
   <div class="prop-details-header-top">
       <div class="prop-initials-container">
           {{substr($proprietaire->nom,0,1)}}{{substr($proprietaire->prenom,0,1)}}
        </div>
        <div class="prop-name-container">
            <span>{{$proprietaire->nom}} {{$proprietaire->prenom}}</span>
        </div>
    </div>
    <div class="prop-header-right">       
        <div class="prop-cta-container">
            <div class="send-email">
                <a href="mailto:{{$proprietaire->email}}"> <i class="fas fa-paper-plane"></i>{{('Ecrire')}}</a>
            </div>
            <div class="prop-cta-actions"> 
                <button class="btn update-owner-details" data-propid="{{$proprietaire->id}}"> <i class="fas fa-user-edit"></i>Editer</button>
                <button class="btn delete-owner-details" id="propriet_{{$proprietaire->id}}" href="#"
                    data-titre="{{$proprietaire->nom}} {{$proprietaire->prenom}}"
                    data-toggle="modal" 
                    data-target="#delete-modal"
                    data-form-route="{{route('proprietaires.destroy','proprietaire')}}"> <i class="fas fa-user-times"></i>Supprimer</button>            
            </div>       
        </div>
    </div>



</header>

<main class="details-proprietaire-body">
        <section class="details-proprietaire-section">
            <article id="section-coordonees">
                <header class="section-head"><h5 class="section-caption">Coordonnées</h5></header>
                <ul class="coord-list">
                    @if($proprietaire->telephone)
                    <li><i class="fas fa-phone-alt"></i>{{$proprietaire->telephone}}</li>
                    @endif
                    @if($proprietaire->email)
                    <li><i class="fas fa-envelope"></i>{{$proprietaire->email}}</li>
                    @endif
                    @if($proprietaire->adresse)                        
                    <li><i class="fas fa-map-marker-alt"></i>{{$proprietaire->adresse, $proprietaire->code_postal, $proprietaire->ville}}</li>
                    @endif  
                </ul>               
            </article>
        </section>
      
        @if(!empty($proprietaire->animals))
        <section class="details-proprietaire-section">
                <article  id="section-animal">
                    <header class="section-head"><h5 class="section-caption">@if(count($proprietaire->animals) > 1) {{('Animaux')}} @elseif(count($proprietaire->animals) ==0)
                         {{'Animal'}} : <span>0</span>@else {{'Animal'}}@endif</h5>
                    </header>
    
                    <ul class="animals-list">
                        @foreach ($proprietaire->animals as $animal)                            
                        <li class="animal-item">
                            <span class="animal-picture">
                                <img src="@if($animal->visuel){{Storage::url('uploads')}}/{{$animal->visuel}} @else {{asset('imgs/avatar-image.png')}} @endif">
                            </span> {{$animal->nom}}
                        </li>
                        @endforeach                       
                    </ul> 
                </article>
            </section>

        @endif

</main>



</section>
