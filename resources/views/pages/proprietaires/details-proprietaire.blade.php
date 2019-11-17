<section class="details-proprietaire-container">
<header class="proprietaire-header">
    <div class="prop-initials-container">
        {{substr($proprietaire->nom,0,1)}}{{substr($proprietaire->prenom,0,1)}}
    </div>
    <div class="prop-header-right">
        <div class="prop-name-container">
            <span>{{$proprietaire->nom}} {{$proprietaire->prenom}}</span>
        </div>
        <div class="prop-cta-container">
            <a href="#" class="btn btn-primary">{{('Ecrire')}}</a>     
            <span class="prop-cta-actions"> 
                <button class="btn" id="btn-delete-prop">Edite</button>
                <button class="btn">Supp</button>            
            </span>       
        </div>
    </div>



</header>

<main class="details-proprietaire-body">
        <section class="list-group">
            <article href="#" class="">
                <div class="">
                <h5 class="mb-1">Coordonnées</h5>

                <ul class="list-group">
                    <li>
                        <span> Tel :</span> {{$proprietaire->telephone}}
                    </li>
                    <li>
                        <span> E-mail :</span> {{$proprietaire->telephone}}
                    </li>
                    <li>
                        <span>Adress :</span> {{$proprietaire->adresse, $proprietaire->code_postal, $proprietaire->ville}}
                    </li>
                   
                   
                </ul>
                
                </div>
               
            </article>
        </section>
      
        @if(!empty($proprietaire->animals))
        <section class="">
                <article href="#" class="">
                    <div class="">
                    <h5 class="mb-1">
                        @if(count($proprietaire->animals) > 1)
                         Animaux

                         @elseif(count($proprietaire->animals) ==0)
                         Animal : <span>0</span>
                        @else
                         Animal 
                         @endif
                    </h5>
    
                    <ul class="">
                        @foreach ($proprietaire->animals as $animal)                            
                        <li class="">
                            <span>
                                <img src="@if($animal->visuel){{Storage::url('uploads')}}/{{$animal->visuel}} @else {{asset('imgs/avatar-image.png')}} @endif" width="35">
                            </span> {{$animal->nom}}
                        </li>
                        @endforeach
                       
                    </ul>
                    
                    </div>
                    
                </article>
            </section>

        @endif

</main>



</section>
