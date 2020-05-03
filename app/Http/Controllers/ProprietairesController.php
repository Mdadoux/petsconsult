<?php

namespace App\Http\Controllers;

use App\Animal;
use App\Proprietaire;
use Illuminate\Http\Request;

class ProprietairesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $req)
    {
        //lister les propriétaitres
        $proprietaires = Proprietaire::with(['animals'])->orderBy('id', 'DESC')->paginate(18);
        $totalProp = $this->get_proprietaire_total();
        // $proprietaires->load('animals');
        return view('pages.proprietaires.liste-proprietaires', [
            'listeProprietaires' => $proprietaires,
            'totalProp' => $totalProp
        ]);
    }

    public function get_proprietaire_total(){
        return count(Proprietaire::get());
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
        //
        $rules =  [
            'nom'     => 'string',
            'prenom'    => 'string',
            'telephone'     => 'string',
            'email' =>    'email',
            'adresse'    => 'string',
            'code_postal'  => 'string',
            'ville' => 'string'

        ];

        $this->validate($request, $rules);
        $proprietaire = new Proprietaire();
        $proprietaire->nom = $request->input('input-prop-nom');
        $proprietaire->prenom = $request->input('input-prop-prenom');
        $proprietaire->telephone = $request->input('input-prop-tel');
        $proprietaire->email = $request->input('input-prop-email');
        $proprietaire->adresse = $request->input('input-prop-adresse');
        $proprietaire->code_postal = $request->input('input-prop-codepostal');
        $proprietaire->ville = $request->input('input-prop-ville');
        $proprietaire->save();

        return redirect('/proprietaires')->with('success',  $proprietaire->nom . " " . $proprietaire->prenom . ' a été ajouté dans la liste des proprietaires');
        //  dd($request->all());
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
        $proprietaire = Proprietaire::with(['animals'])->find($id);
        //  dd($proprietaire);
        return view('pages.proprietaires.details-proprietaire', [
            'proprietaire' => $proprietaire
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
        $proprietaire = Proprietaire::findOrFail($id);

        return view('pages.proprietaires.add-prop-form', [
            'proprietaireId' => $proprietaire
        ]);
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

        $proprietaire = Proprietaire::findOrFail($id);
        $proprietaire->nom = $request->input('input-prop-nom');
        $proprietaire->prenom = $request->input('input-prop-prenom');
        $proprietaire->email = $request->input('input-prop-email');
        $proprietaire->telephone = $request->input('input-prop-tel');
        $proprietaire->adresse = $request->input('input-prop-adresse');
        $proprietaire->code_postal = $request->input('input-prop-codepostal');
        $proprietaire->ville = $request->input('input-prop-ville');
        $proprietaire->updated_at = date(now());

        $proprietaire->update($request->all());
        return redirect('/proprietaires')->with('success', 'Les informations de ' . $proprietaire->nom . ' ont été mise à jour');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $id_proprietaire = $request->input('element-a-suppr-id');

        // dd($id_consultation);
        //d'abbord selectionner lelement parmi les patients
        $proprietaire = Proprietaire::findOrFail($id_proprietaire);
        $proprietaire->delete();
        return redirect('/proprietaires')->with('success',  $proprietaire->nom . " " . $proprietaire->prenom . ': a été supprimé de la liste');
    }
}
