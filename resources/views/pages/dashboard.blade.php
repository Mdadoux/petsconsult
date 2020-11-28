@extends('layouts.template')

@section('title','Dashboard')
    
@section('content')

<div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
        <a href="{{route('consultations.create')}}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"> <i class="fas fa-plus fa-sm text-white"></i> Nouvelle consultation</a>
</div>

<div class="dashboard-content fluid-container">

        <div class="row">
                <div class="col-md-4 card">
                        <h4>Consultations</h4>
                        <a href="{{url('consultations')}}">Voir toute les consultations</a>
                </div>
                <div class="col-md-4">
                        <h4>Patiens</h4> 
                        <a href="{{url('patients')}}">Voir toute les consultations</a>      
                       
                </div>
                <div class="col-md-4">
                     <h4>Proprietaires</h4> 
                     <a href="{{url('proprietaires')}}">Voir toute les consultations</a>
                        
                </div>
                <div class="col-md-4"></div>
        </div>
</div>

@endsection