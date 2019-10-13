@extends('layouts.template')

@section('title','Dashboard')
    
@section('content')
<div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">{{__('Toutes les consultations')}}</h1>
        <p class="mb-4">DataTables is a third party plugin that is used to generate the demo table below. For more information about DataTables, please visit the <a target="_blank" href="https://datatables.net">official DataTables documentation</a>.</p>

        <div class="ml-auto w-25 text-right mb-3">

            <a href="{{route('consultations.create')}}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
              <i class="fas fa-plus fa-sm text-white"></i> Nouvelle consultation
            </a>
        </div>

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
          <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">{{__('Liste des consultations')}}</h6>
          </div>
          <div class="card-body">
            <div class="{{--table-responsive--}}">
   
            @if(!empty($consultations_list))
              <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                  <tr>
                    <th>{{__('Intitule')}}</th>
                    <th>{{__('Propriétaire')}}</th>
                    <th>{{__('Patient')}}</th>
                    <th>{{__('Date')}}</th>
                    <th>Actions</th>
                        
                    {{--<th>Office</th>
                    <th>Salary</th>
                    --}}
                  </tr>
                </thead>
                <tfoot>
                  <tr>
                        <th>{{__('Intitule')}}</th>
                        <th>{{__('Propriétaire')}}</th>
                        <th>{{__('Patient')}}</th>
                        <th>{{__('Date')}}</th>
                        <th>Actions</th>
                        {{--
                        <th>Salary</th>
                        --}}
                  </tr>
                </tfoot>
                <tbody>
                  @foreach ($consultations_list as $consultation)                     
                  
                  <tr>
                      <td>
                        <a href="consultations/{{$consultation->id}}">
                        {{$consultation->titre}}</a>
                      </td>
                      <td>{{__('Nom du propriétaire inconnu')}}</td>
                      <td>{{$consultation->animal['nom']}}</td>
                      <td>{{$consultation->created_at}}</td>
                      <td>
                         <div class="action-wrapper">
                            <a href="{{route('consultations.show', $consultation->id)}}" class="btn btn-default btn-circle btn-sm">
                                    <i class="fas fa-eye"></i>
                            </a>
                            <a href="#" class="btn btn-danger btn-circle btn-sm delete-btn" 
                              data-titre="{{$consultation->titre}}"
                              id="{{$consultation->id}}"
                              data-toggle="modal" 
                              data-target="#delete-modal"
                              data-form-route="{{route('consultations.destroy','consultation')}}">
                                <i class="fas fa-trash"></i>
                            </a>
                      
                            <a href="" class="btn btn-primary btn-circle btn-sm">
                                    <i class="fas fa-edit"></i>
                            </a>

                         </div>

                      </td>
                      {{-- 
                        <td>$320,800</td>
                        --}}
                    </tr>
                    @endforeach
                  
                </tbody>
              </table>
            
              @else

              <h2>Pas de consultations pour le moment</h2>

              @endif
            </div>
          </div>
        </div>

      </div>
      <!-- /.container-fluid -->
  
@endsection