@extends('layouts.template')

@section('title','Dashboard')
    
@section('content')
<div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">{{__('Toutes les consultaions')}}</h1>
        <p class="mb-4">DataTables is a third party plugin that is used to generate the demo table below. For more information about DataTables, please visit the <a target="_blank" href="https://datatables.net">official DataTables documentation</a>.</p>

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
          <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">{{__('Liste des consultaions')}}</h6>
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
                        {{--<th>Office</th>
                        <th>Salary</th>
                        --}}
                  </tr>
                </tfoot>
                <tbody>
                  @foreach ($consultations_list as $consultaion)                     
                  
                  <tr>
                      <td>{{$consultaion->titre}}</td>
                      <td>System Architect</td>
                      <td>{{__('Nom du propriétaire inconnu')}}</td>
                      <td>{{$consultaion->created_at}}</td>
                      {{-- <td>2011/04/25</td>
                        <td>$320,800</td>
                        --}}
                    </tr>
                    @endforeach
                  
                </tbody>
              </table>
            
              @else

              <h2>Pas de consultaions pour le moment</h2>

              @endif
            </div>
          </div>
        </div>

      </div>
      <!-- /.container-fluid -->
  
@endsection