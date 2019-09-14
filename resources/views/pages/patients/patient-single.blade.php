@extends('layouts.template')
@section('title','Patient-'.$patient->nom)

@section('content')

<div class="p-2 mb-3">
        <div class="page-title-heading d-flex ">
            <div class="page-title-icon mr-4"><i class="fas fa-heartbeat"></i></div>
            <div>
                <h3>
                    Patient
                </h3>
                <div class="page-title-subheading">{{$patient->nom}}</div>
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
    
    </div>

    <section class="patient-header card">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-2">
                        <div class="patient-img-container">

                            <img class="card-img-top" src="https://images.unsplash.com/photo-1545791740-adcfb5f1575f?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80" alt="Card image cap">
                            <div class="card-body">
                                <h5>{{$patient->animal['nom']}}</h5>
                                <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.
                                  
                                </p>
                                
                            </div>
                        </div>
                </div>
                <div class="col-sm-7">
                    <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Eum, libero. Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>
                </div>
                <div class="col-sm-3">
                        <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Eum, libero.</p>
                    </div>
            </div>

        </div>
    </section>
    <section class="patient-content card mt-3">
        <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Quod in, corrupti hic ad optio fuga 
            ipsam nulla, harum reprehenderit voluptas, exercitationem eum. Ipsa temporibus, reprehenderit necessitatibus quidem ipsam,
             et voluptas labore quod illum, itaque mollitia magnam.
             At similique dolore adipisci error. Dolorem eligendi ipsam necessitatibus libero, voluptate ab ratione dignissimos?</p>


    </section>



@endsection