<?php

namespace App\Http\Controllers;

use App\Models\Etudiant;
use Illuminate\Http\Request;
use App\Models\Ville; 
use App\Models\User; 
use Illuminate\Support\Facades\Hash; 
use Illuminate\Support\Facades\Auth; 

class EtudiantController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $etudiants = Etudiant::Select()->paginate(15); 
        return view('etudiant.index', ['etudiants' => $etudiants]); 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    { 
        $villes = Ville::all();  
        return view('etudiant.create', ['villes' => $villes]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'nomEtudiant' => 'required|min:5|max:100', 
            'naissance' => 'required|date_format:Y-m-d',
            'phone' => 'required|min:10',
            'adresse' => 'required|min:5',
            'ville_id' => 'required',
            'email' => 'required|email|unique:users',
        ]);

        $newUser = User::create([
            'name' => $request->nomEtudiant, 
            'email' => $request->email, 
            'password' => Hash::make($request->naissance)
        ]);
        
        $newEtudiant = Etudiant::create([
            'nomEtudiant' => $request->nomEtudiant,
            'naissance' => $request->naissance,
            'phone' => $request->phone,
            'email' => $request->email,
            'adresse' => $request->adresse,
            'ville_id' => $request->ville_id,
            'user_id' => $newUser->id
        ]);

        return redirect(route('etudiant.index')); 
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Etudiant  $etudiant
     * @return \Illuminate\Http\Response
     */
    public function show(Etudiant $etudiant)
    {
        $ville = Ville::all()->where('id', $etudiant->ville_id); 
        foreach ($ville as $v) {
            $nomVille = $v->nomVille; 
        } 
        return view('etudiant.show', ['etudiant' => $etudiant, 'ville' => $nomVille]); 
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Etudiant  $etudiant
     * @return \Illuminate\Http\Response
     */
    public function edit(Etudiant $etudiant)
    {
        $villes = Ville::all(); 
        $ville = $villes->where('id', $etudiant->ville_id);  
        foreach ($ville as $v) {
            $nomVille = $v->nomVille; 
        } 
        return view('etudiant.edit', ['etudiant' => $etudiant, 'villes' => $villes, 'ville' => $nomVille]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Etudiant  $etudiant
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Etudiant $etudiant)
    {
        $request->validate([
            'nomEtudiant' => 'required|min:5|max:100', 
            'naissance' => 'required',
            'phone' => 'required|min:10',
            'adresse' => 'required|min:5',
            'ville_id' => 'required',
            'email' => 'required|email|unique:etudiants,email,'.$etudiant->id
        ]);
        
        $etudiant->update([
            'nomEtudiant' => $request->nomEtudiant,
            'naissance' => $request->naissance,
            'phone' => $request->phone,
            'email' => $request->email,
            'adresse' => $request->adresse,
            'ville_id' => $request->ville_id
        ]);

        $users = User::all(); 
        $user = $users->where('id', $etudiant->user_id)->first(); 
        $user->name = $etudiant->nomEtudiant;
        $user->email = $etudiant->email;

        $user->save(); 
        return redirect(route('etudiant.show', $etudiant->id));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Etudiant  $etudiant
     * @return \Illuminate\Http\Response
     */
    public function destroy(Etudiant $etudiant)
    {
        Etudiant::select()->leftJoin('users', 'user_id', '=', 'users.id')->where('etudiants.id', $etudiant->id)->delete(); 
        return redirect(route('etudiant.index'));
    }
}
