<?php

namespace App\Http\Controllers;

use App\Animal;
use App\Animal_type;
use App\Proprietaire;
use Illuminate\Http\Request;

class AnimalsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //recuperer les enregistrement depuis le model 
        //eagger loading sur la classe Proprietaire
        $patients = Animal::with(['proprietaire', 'animal_type'])->get();
        $proprietaires = Proprietaire::all();
        $animal_types = Animal_type::all();


        return view('pages.patients.liste-patients', [
            "patients_list" => $patients,
            "proprietaires" => $proprietaires,
            "types_animaux"  => $animal_types
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $rules =  [
            'nom'     => 'string',
            'sexe'    => 'string',
            'age'     => 'string',
            'race'    => 'string',
            'discipline' => 'string'

        ];

        // dd($request->all());
        $this->validate($request, $rules);

        // creation du patient animal
        $patient = new Animal;
        $patient->nom = $request->input('nom');
        $patient->sexe = $request->input('animal-sexe');
        $patient->age = $request->input('animal-age');
        $patient->animal_types_id = $request->input('animal-type');
        $patient->proprietaire_id = $request->input('animal-proprietaire');
        $patient->race = $request->input('race');
        $patient->discipline = $request->input('animal-discipline');
        $patient->save();


        return redirect('/patients')->with('success', 'Le patient ' . $patient->nom . ' a été ajouté dans la liste des patients');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $patient = Animal::with(['proprietaire', 'animal_type'])->find($id);
        return view('pages.patients.patient-single', [
            "patient" => $patient
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $id_patient = $request->patient_id;
        //d'abbord selectionner lelement parmi les patients

        $patient = Animal::findOrFail($id_patient);
        $patient->delete();

        return redirect('/patients')->with('success', 'Le patient ' . $patient->nom . ' a été supprimé de la liste des patients');
    }
}
