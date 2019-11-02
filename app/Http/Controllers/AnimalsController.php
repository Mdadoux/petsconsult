<?php

namespace App\Http\Controllers;

use App\Animal;
use App\Animal_type;
use App\Proprietaire;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

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
            'nom'     => 'string|required',
            'sexe'    => 'string',
            'animal_types_id' => 'required',
            'age'     => 'string',
            'race'    => 'string',
            'visuel'  => 'sometimes|image|nullable|max:1999',
            'discipline' => 'string'

        ];

        $this->validate($request, $rules);
        // creation du patient animal
        $patient = new Animal;
        $patient->nom = $request->input('nom');
        $patient->sexe = $request->input('animal-sexe');
        $patient->age = $request->input('animal-age');
        $patient->animal_types_id = $request->input('animal-type');
        $patient->proprietaire_id = $request->input('animal-proprietaire');
        $patient->race = $request->input('animal-race');
        $patient->discipline = $request->input('animal-discipline');
        $patient->save();
        $id_patient = $patient->id;
        // dd($id_patient);
        //verifions si une image est présente 
        if ($request->hasFile('animal-photo')) {
            #recuperer le nom de l'image 
            //  $fileNameWithExt = $request->file('animal-photo')->getClientOriginalName();
            // $filename = pathinfo($fileNameWithExt, PATHINFO_EXTENSION);
            $extension = $request->file('animal-photo')->getClientOriginalExtension();
            $fileNameToStore = 'photo-p-' . $id_patient . '.' . $extension;
            $patient->visuel = $fileNameToStore;
            $request->file('animal-photo')->storeAs('public/uploads', $fileNameToStore);
            //création d'une image plus petite à partir de l'image par défaut
            $photoPatient = Image::make(public_path('storage/uploads/' . $fileNameToStore))->fit(400, 400);
            $photoPatient->save(); //sauver l'image 
            $patient->save();
        }

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
        //afficher le details d'un patien (animal)
        $patient = Animal::with(['proprietaire', 'animal_type', 'consultations'])->find($id);
        $animal_types = Animal_type::all();
        return view('pages.patients.patient-single', [
            "patient" => $patient,
            "types_animaux"  => $animal_types
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
        $patient = Animal::with(['proprietaire', 'animal_type'])->find($id);
        return $patient;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {

        $patient = Animal::findOrFail($request->input('animal-id'));

        // recuperer la photo actuelle du patient
        $current_photo  = $patient->visuel;

        $patient->nom = $request->input('nom');
        $patient->sexe = $request->input('animal-sexe');
        $patient->age = $request->input('animal-age');
        $patient->animal_types_id = $request->input('animal-type');
        // il faut s'assurer d'avoir un numero dans le type de d'animal 
        if (is_numeric($patient->animal_types_id) ? $patient->animal_types_id : $patient->animal_types_id = 0);
        $patient->proprietaire_id = $request->input('animal-proprietaire');
        $patient->race = $request->input('race');
        $patient->discipline = $request->input('animal-discipline');
        // dans le cas ou on séléctionne une autre image 
        if ($request->hasFile('animal-photo')) {
            $newpatienPhoto = $request->file('animal-photo')->getClientOriginalName();
            $pathToImage = public_path('storage/uploads/');
            // les deux images sont différente
            if ($current_photo && $current_photo !== $newpatienPhoto) {
                // recuperer les l'extension de l'image actuellement chargée 
                $extension = $request->file('animal-photo')->getClientOriginalExtension();
                // renommer l'image selon le nomage suivant
                $fileNameToStore = 'photo-p-' . $patient->id . '.' . $extension;
                // mettre à jour le nom de l'image en base 
                $patient->visuel = $fileNameToStore;
                # l'image uploadé devient $current_photo...
                if (file_exists($pathToImage . $current_photo)) {
                    #faut donc supprimé l'ancien image
                    unlink($pathToImage . $current_photo);
                    // enregister l'image dans le bon répertoir
                    $request->file('animal-photo')->storeAs('public/uploads', $fileNameToStore);
                    #création d'une image plus petite à partir de l'image par défaut
                    $photoPatient = Image::make(public_path('storage/uploads/' . $fileNameToStore))->fit(400, 400);
                    # Sauver la photo 
                    $photoPatient->save();
                }
            }

            //dd($request->input('animal-id'));
            //dd(date(now()));
            $patient->update($request->all());

            return back()->with('success', 'Les informations du patient ' . $patient->nom . ' ont été mise à jour');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $id_patient = $request->input('element-a-suppr-id');
        //d'abbord selectionner lelement parmi les patients
        $patient = Animal::findOrFail($id_patient);
        !empty($patient->visuel) ? $photoPatient = $patient->visuel : $photoPatient = 'no-image.jpg';
        $photoPatient = $patient->visuel;
        $imagesFolder = public_path('storage/uploads/' . $photoPatient);
        // supprimer la photo du patient 
        if (file_exists($imagesFolder) && !is_dir($imagesFolder)) {
            unlink($imagesFolder);
        }
        $patient->delete();
        return redirect('/patients')->with('success', 'Le patient ' . $patient->nom . ' a été supprimé de la liste des patients');
    }
}
