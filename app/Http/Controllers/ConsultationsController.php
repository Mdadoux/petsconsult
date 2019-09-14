<?php

namespace App\Http\Controllers;

use App\Consultation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ConsultationsController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    //
    public function index()
    {

        $consultations_list = Consultation::all();
        $consultations_list->load('animal');
        // $result = DB::table('parietaire')

        return view('pages.consultations.consultations', [
            "consultations_list" => $consultations_list
        ]);
    }


    public function show(Consultation $consultation)
    {

        // eager loading thanks to with methode
        $consultation = Consultation::with(['animal'])->find($consultation->id);

        return view('pages.consultations.consultation-single', [
            "consultation" => $consultation
        ]);
    }
}
