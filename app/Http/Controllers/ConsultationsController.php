<?php

namespace App\Http\Controllers;

use App\Consultation;
use Illuminate\Http\Request;

class ConsultationsController extends Controller
{
    //
    public function list_consultations()
    {

        $consultaions_list = Consultation::all();
        return view('pages.consultations', ["consultations_list" => $consultaions_list]);
    }
}
