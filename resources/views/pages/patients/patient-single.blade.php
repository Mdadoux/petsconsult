@extends('layouts.template')
@section('title','Patient-'.$patient->nom)

@section('content')

<div class="p-2 mb-3">
        <div class="page-title-heading d-flex ">
            <div class="page-title-icon mr-4"><i class="fas fa-heartbeat"></i></div>          
                <div class="page-title-subheading">
                     <h3>Patient</h3>                
                    {{$patient->nom}}
                </div>
                <div class="page-btn-action mb-4 w-25 ml-auto text-right">
                    <a href="#" class="btn btn-primary btn-icon-split">
                        <span class="icon text-white-50">
                                <i class="fas fa-pen-square"></i>
                        </span>
                        <span class="text">Modifier</span>
                    </a>
    
                    <a href="#" class="btn btn-danger btn-icon-split delete-btn" data-titre="{{$patient->nom}}" id="{{$patient->id}}" data-toggle="modal" data-target="#delete-modal">
                        <span class="icon text-white-50">
                         <i class="fas fa-trash"></i>
                        </span>
                        <span class="text">Supprimer</span>
                    </a>
            </div>
            
        </div>
        
    
    </div>

    <section class="patient-header card">
        <div class="container-fluid">
            <div class="panel m-3">
            <div class="row">
                <div class="col-sm-3">
                        <div class="patient-img-container">
                            <img class="card-img-top img-fluid" 
                                 src="https://images.unsplash.com/photo-1545791740-adcfb5f1575f?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80" 
                                 alt="Card image cap">                           
                        </div>
                </div>
                <div class="col-sm-6">
                        <div class="profile-contact">
                            <div class="profile-main-top">
                                <h1 class="name">{{$patient->nom}}</h1>
                                @if($patient->animal_type['designation'])
                                <span>{{__('Famille : ')}}</span>
                                <span>{{$patient->animal_type['designation']}}</span>
                                @endif                               
                            </div>
                            <div class="speciality">Translator. Event Planner. Writer. Composer. Voice actor.</div>

                            <div class="d-flex flex-column mt-5">
                                <div class="profile-button-actions my-7">
                                        <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-success shadow-sm">
                                            <i class="fas fa-plus fa-sm text-white"></i>
                                            <span>Nouvelle consultation</span> 
                                        </a>
                                </div>
                                <div class="profile-link-actions"></div>
                            </div>
                        </div>                       
                </div>
                <div class="col-sm-3">
                   
                        <div class="profile-info-row">
                            @if($patient->age)
                            <span> {{__('Age : ')}}</span>
                                <span>
                                    {{$patient->age}} {{ ($patient->age > 1) ? 'ans' : 'an'}}
                                </span>
                            @endif
                           
                            <dl class="profile-info-row">
                                <dt>{{__('Race : ')}}</dt>
                                @if(isset($patient->race) && !empty($patient->race))
                                    <dd>{{$patient->race}}</dd>
                                @else
                                <dd>
                                    <span class="badge badge-warning">Non communiqué</span>
                                </dd>
                                @endif
                            </dl>
                          
                            @if($patient->sexe)
                            <dl class="profile-info-row">
                                <dt>{{__('Sexe : ')}}</dt>
                                <dd>{{$patient->sexe}}</dd>
                            </dl>
                            @endif
                            
                            <dl class="profile-info-row">
                                <dt>{{__('Enregistré le ')}}:</dt>
                                <dd>{{$patient->created_at->format('j F , Y')}}</dd>
                            </dl>
                        </div>
                    </div>
            </div>
            </div>
        </div>
    </section>
    <section>
            <div class="row margin-bottom-20">
                    <ul class="nav nav-tabs">
                            <li class="nav-item">
                              <a class="nav-link active" href="#">Active</a>
                            </li>
                            <li class="nav-item">
                              <a class="nav-link" href="#">Link</a>
                            </li>
                            <li class="nav-item">
                              <a class="nav-link" href="#">Link</a>
                            </li>
                            <li class="nav-item">
                              <a class="nav-link disabled" href="#">Disabled</a>
                            </li>
                          </ul>
            </div>
    </section>
    <section class="patient-content card mt-3">
        <div class="row">
            <div class="col-sm-8">
                <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. 
                    Aperiam maxime expedita et corrupti reiciendis, cumque fugit voluptatum voluptate,
                     quas eos minima deleniti iure! Illo consectetur, et numquam repellat quis molestiae
                      nihil quia eligendi quibusdam ad nulla laborum consequatur pariatur facere? Veniam minus,
                       eaque aliquam porro recusandae enim distinctio, culpa asperiores dicta necessitatibus 
                       suscipit doloribus nesciunt blanditiis totam eligendi corporis officia odio ea eveniet
                        laborum. Fugit error consequuntur voluptatibus sapiente mollitia nulla pariatur!
                         Quae eius repellendus quaerat numquam alias,
                     nemo magnam laborum a voluptatem commodi saepe nobis fuga blanditiis corporis ea id 
                     temporibus hic quis! Aut dolorum nobis veniam repellat dolorem.</p>
            </div>
           <div class="col-sm-4">
               <h3>Consultations</h3>
                <ul class="list-group list-group-flush">
                        <li class="list-group-item">Cras justo odio</li>
                        <li class="list-group-item">Dapibus ac facilisis in</li>
                        <li class="list-group-item">Morbi leo risus</li>
                        <li class="list-group-item">Porta ac consectetur ac</li>
                        <li class="list-group-item">Vestibulum at eros</li>
                      </ul
           </div>

    </section>



@endsection