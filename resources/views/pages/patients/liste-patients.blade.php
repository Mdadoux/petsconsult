@extends('layouts.template')

@section('title','Liste des patients')
    
@section('content')
<div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">{{__('Liste des patients')}}</h1>
        <p class="mb-4">{{__("Liste de tous les patients")}} {{-- <a target="_blank" href="https://datatables.net">official DataTables documentation</a>--}}.</p>

        <div class="ml-auto w-25 text-right mb-3">

            <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"
            data-toggle="modal" data-target="#add-Modal">
                <i class="fas fa-plus fa-sm text-white"></i>
                 <span>Nouvau patient</span>
            </a>
        </div>

        <div class="card shadow mb-4">
                <div class="card-header py-3">
                  <h6 class="m-0 font-weight-bold text-primary">{{__('Liste des derniers patients')}} </h6>
                </div>
                <div class="card-body">
                  <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable-patients" width="100%" cellspacing="0">
                      <thead>
                        <tr>
                          <th>{{__('#')}}</th>
                          <th>{{__('Patient')}}</th>
                          <th>{{__('Contact')}}</th>
                          <th>{{__('Type')}}</th>
                          <th>{{__('Date')}}</th>
                          <th>{{__('Actions')}}</th>
                        </tr>
                      </thead>
                      <tfoot>
                        <tr>
                            <th>{{__('#')}}</th>
                            <th>{{__('Patient')}}</th>
                            <th>{{__('Contact')}}</th>
                            <th>{{__('Type')}}</th>
                            <th>{{__('Date')}}</th>
                            <th>{{__('Actions')}}</th>
                        </tr>
                      </tfoot>
                      <tbody>
                        @foreach ($patients_list as $patient)
                           
                        <tr>
                          <td>{{$patient->id}}</td>
                          <td><a href="patients/{{$patient->id}}">{{$patient->nom}}</a></td>
                          <td>
                            @if ($patient->proprietaire['nom'])
                            <a  href="#" class="patient-prop-container">
                              <span class="patient-proprietaire-nom">
                                {{$patient->proprietaire['nom']}}
                              </span>
                              <span class="patient-proprietaire-prenom">                              
                                {{$patient->proprietaire['prenom']}}
                            </span>
                            </a>
                            @else
                              <span class="badge badge-warning">
                                  {{__('Non communiqué')}}
                              </span>
                            @endif
                        </td>
                          <td>
                            
                            @if($patient->animal_type['designation'])
                                {{ucfirst($patient->animal_type['designation'])}}
                            @else
                              <span class="badge badge-warning">
                                {{__('Non renseigné')}}
                              </span>
                            @endif
                          </td>
                          <td>{{$patient->created_at}}</td>
                          <td>
                              <div class="action-wrapper">
                                  <a href="patients/{{$patient->id}}" class="btn btn-default btn-circle btn-sm">
                                          <i class="fas fa-eye"></i>
                                  </a>
                                  <a href="#" class="btn btn-danger btn-circle btn-sm delete-btn" data-titre="{{$patient->nom}}" id="{{$patient->id}}" data-toggle="modal" data-target="#delete-modal">
                                          <i class="fas fa-trash"></i>
                                  </a>
                                  <a href="#" class="btn btn-primary btn-circle btn-sm patient-edit" data-toggle="modal" data-idpatient="{{$patient->id}}" data-target="#add-Modal">
                                          <i class="fas fa-edit"></i>
                                  </a>
      
                               </div>
                          </td>
                        </tr>
                        @endforeach
                       
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
</div>
@include('pages.patients.modal-patient-add')
@endsection