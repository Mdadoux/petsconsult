<?php

namespace App\Http\Controllers;

use App\Animal;
use App\Proprietaire;
use App\Animal_type;
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


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $consultations_list = Consultation::all();
        //rechercher les proprietaire
        $prop = Proprietaire::all();
        //afficher les types d'animaux
        $animals_type = Animal_type::all();
        //  dd($prop);
        return view(
            'pages.consultations.consultation-create-eddit',
            [
                "consultations_list"     => $consultations_list,
                "proprietaires"          => $prop,
                "types_animaux"          => $animals_type

            ]
        );
    }


    //
    public function index()
    {


        $consultations_list = Consultation::all();
        $consultations_list->load('animal');
        // dd($this->get_animalby_name('ch'));
        return view('pages.consultations.consultations', [
            "consultations_list" => $consultations_list
        ]);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        Consultation::create();

        $rules =  [
            'titre'                 => 'string',
            'motif_consultation'    => 'string',
            'antecedants'           => 'string',
            'conseils'              => 'string',
            'bilan'                 => 'string'

        ];

        //dd($request->all());
        $this->validate($request, $rules);

        $consultation = new Consultation;
        $consultation->titre = $request->input('consultation-titre');
        $consultation->motif_consultation = $request->input('input-motif-consultation');
        $consultation->antecedents = $request->input('input-antecedent-consultation');
        $consultation->conseils = $request->input('consultation-conseils');
        $consultation->bilan = $request->input('consultation-bilan');
        if (empty($request->input('patient-id'))) {
            # si le nom du cheval est renseigné
            $rules_patient =  [
                'nom'     => 'string|required',
                'sexe'    => 'string',
                'age'     => 'string',
                'race'    => 'string',
                'discipline' => 'string'

            ];

            // dd($request->all());
            $this->validate($request, $rules_patient);
            // creer un nouveau patien dans la table 
            $patient = new Animal;
            $patient->nom = $request->input('nom');
            $patient->sexe = $request->input('animal-sexe');
            $patient->age = $request->input('animal-age');
            $patient->animal_types_id = $request->input('animal-type');
            $patient->proprietaire_id = $request->input('animal-proprietaire');
            $patient->race = $request->input('animal-race');
            $patient->discipline = $request->input('animal-discipline');
            #enregister le nouveau cheval dans la table animal
            $patient->save();
            // dd($patient->id);
            session()->now('success', 'Nouveau patient ajouté.');
            #Puis selectionner l'identifiant du dernier aniaml inseré 
            $consultation->animal_id = $patient->id;
            #affecter l'identifant séléctionné pour l'affecter à au champs animal_id de la consultation
        } else {
            #avec un champs de recherche, selectioonner l'id de l'animal correspondant à la recherche
            $consultation->animal_id = $request->input('patient-id');
            #recuperer l'id pour l'afftecter au champ animal_id de la consultation

        }
        // enregister la consultation
        $consultation->save();
        return redirect('/consultations')->with('success', 'La consultation n° ' . $consultation->id . ' vient d\'être créer !');

        // dd($request->all());
    }


    public function show(Consultation $consultation)
    {

        // eager loading thanks to with methode
        $consultation = Consultation::with(['animal'])->find($consultation->id);
        return view('pages.consultations.consultation-single', [
            "consultation" => $consultation
        ]);
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $id_consultation = $request->input('element-a-suppr-id');

        // dd($id_consultation);
        //d'abbord selectionner lelement parmi les patients
        $consultation = Consultation::findOrFail($id_consultation);
        $consultation->delete();
        return redirect('/consultations')->with('success', 'La consultation n° ' . $id_consultation . ' a été supprimé de la liste des consultations');
    }

    public function searchAnimal(Request $request)

    {
        $name = $request->q;
        //dd($request->all());
        if ($name) {
            $query = DB::table('animals')
                ->leftjoin('animal_types', 'animal_types_id', '=', 'animal_types.id')
                ->leftjoin('proprietaires', 'animals.proprietaire_id', '=', 'proprietaires.id')
                ->select('animals.id', 'animals.nom', 'sexe', 'designation', 'discipline', 'age', 'race', 'proprietaires.nom as prop_nom', 'proprietaires.prenom as prop_prenom', 'proprietaires.id as ownner_id')
                ->where('animals.nom', 'LIKE', "%{$name}%")
                ->orWhere('designation', 'like', "%{$name}%")
                ->get();
            if (count($query) > 0) {
                return $query;
            } else {
                return "Aucune donnée trouvé";
            }
        } else {
            return "erreur";
        }
    }


    /**
     * 
       dd($name->all());
        $query = DB::table('animals')
            ->leftjoin('animal_types', 'animal_types_id', '=', 'animal_types.id')
            ->select('animals.id', 'nom', 'sexe', 'designation')
            ->where('nom', 'LIKE', "%{$name}%")
            ->orWhere('designation', 'like', "%{$name}%")
            ->get();
        return $query;
     */
}
