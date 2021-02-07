<?php

namespace App\Http\Controllers;

use App\Animal;
use App\Animal_type;
use App\Proprietaire;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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

        // recuperer l'utilisateur
        $user = Auth::user();
        //recuperer les enregistrement depuis le model 
        //eagger loading sur la classe Proprietaire et animal selon utilisateur
        $patients = Animal::with(['proprietaire', 'animal_type'])->where('user_id', '=', $user->id)->get();
        $proprietaires = Proprietaire::where('user_id', '=', $user->id)->get();
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
            'age'     => 'string',
            'race'    => 'string',
            'visuel'  => 'sometimes|image|nullable|max:1999',
            'discipline' => 'string'

        ];

        $user = Auth::user();
        $this->validate($request, $rules);
        // creation du patient animal
        $patient = new Animal;
        $patient->nom = $request->input('nom');
        $patient->sexe = $request->input('animal-sexe');
        $patient->age = $request->input('animal-age');
        #si on a pas choisi
        if (!is_numeric($request->input('animal-type'))) {
            # code...
            // dd(typeof($request->input('animal-type')));
            return redirect('/patients')->with('error', "Vous devez choisir un type animal");
        } else {
            $patient->animal_types_id = $request->input('animal-type');
        }
        $patient->proprietaire_id = $request->input('animal-proprietaire');
        $patient->race = $request->input('animal-race');
        $patient->discipline = $request->input('animal-discipline');
        $patient->user_id = $user->id;
        $patient->save();
        $id_patient = $patient->id;
        // dd($id_patient);
        //verifions si une image est présente 
        if ($request->hasFile('animal-photo')) {
            #recuperer le nom de l'image 
            //  $fileNameWithExt = $request->file('animal-photo')->getClientOriginalName();
            // $filename = pathinfo($fileNameWithExt, PATHINFO_EXTENSION);
            $extension = $request->file('animal-photo')->getClientOriginalExtension();
            $fileNameToStore = 'photo-p-' . $id_patient . '_user_' . $user->id . '.' . $extension;
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
        $this->authorize('view', $patient);

        $animal_types = Animal_type::all();
        $proprietaires = Proprietaire::all();
        return view('pages.patients.patient-single', [
            "patient" => $patient,
            "proprietaires" => $proprietaires,
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
        !is_null($patient->visuel) ? $current_photo = $patient->visuel : $current_photo  = "no-image.jpg";
        $patient->nom = $request->input('nom');
        $patient->sexe = $request->input('animal-sexe');
        $patient->age = $request->input('animal-age');
        $patient->animal_types_id = $request->input('animal-type');
        // il faut s'assurer d'avoir un numero dans le type de d'animal 
        if (is_numeric($patient->animal_types_id) ? $patient->animal_types_id : $patient->animal_types_id = 0);
        $patient->proprietaire_id = $request->input('animal-proprietaire');
        $patient->race = $request->input('race');
        $patient->discipline = $request->input('animal-discipline');
        $patient->updated_at = date(now());
        // dans le cas ou on séléctionne une autre image 
        //  dd($request->file('animal-photo')->getSize());
        $this->updateAvatarPhoto($request, $patient, $current_photo); // cette partie est légué à cette fonction uploadAvatarPhoto
        //dd(date(now()));
        $patient->update($request->all());
        return redirect()->back()->with('success', 'Les informations du patient ' . $patient->nom . ' ont été mise à jour');
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

    /**
     * @param string champ de l'image
     * @param int $patient un identifiant 
     * @param string le nom de l'image actuelle 
     */
    public function updateAvatarPhoto(Request $request, $patient, $actuellImage)
    {
        if ($request->hasFile('animal-photo')) {
            if ($request->file('animal-photo')->getSize() < 200000) {
                $newpatienPhoto = $request->file('animal-photo')->getClientOriginalName();
                $pathToImage = public_path('storage/uploads/');
                // les deux images sont différente
                if ($actuellImage && $actuellImage !== $newpatienPhoto) {
                    // recuperer les l'extension de l'image actuellement chargée 
                    $extension = $request->file('animal-photo')->getClientOriginalExtension();
                    // renommer l'image selon le nomage suivant
                    $fileNameToStore = 'photo-p-' . $patient->id . '.' . $extension;
                    // mettre à jour le nom de l'image en base 
                    $patient->visuel = $fileNameToStore;
                    # l'image uploadé devient $actuellImage...
                    if (file_exists($pathToImage . $actuellImage)) {
                        #faut donc supprimé l'ancien image
                        unlink($pathToImage . $actuellImage);
                        // enregister l'image dans le bon répertoir
                        $request->file('animal-photo')->storeAs('public/uploads', $fileNameToStore);
                        #création d'une image plus petite à partir de l'image par défaut
                        $photoPatient = Image::make(public_path('storage/uploads/' . $fileNameToStore))->fit(400, 400);
                        $photoPatient->save();
                    } else {
                        $request->file('animal-photo')->storeAs('public/uploads', $fileNameToStore);
                        #création d'une image plus petite à partir de l'image par défaut
                        $photoPatient = Image::make(public_path('storage/uploads/' . $fileNameToStore))->fit(400, 400);
                        $photoPatient->save();
                    }
                }
            } else {

                return back()->with('error', "Taille de l'image trop gros");
            }
            //dd($request->file('animal-photo')->getClientOriginalName());
        }
    }
}