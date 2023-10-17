<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Roles; 
use Spatie\Permission\Models\Permission; 

class CustomAuthController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('auth.index'); 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('auth.create'); 
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = new User; 
        $user->fill($request->all()); 
        $user->password = Hash::make($request->password); 
        $user->save(); 
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    }

    /**
     * Connecte un utilisateur à son compte.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function authentication(Request $request) {
        $request->validate([
            'email' => 'required|email|exists:users', 
            'password' => 'required|min:6|max:20'
        ]);

        $credentials = $request->only('email', 'password'); 
        if (!Auth::validate($credentials)) : return redirect('login')->withErrors(trans('auth.failed')); 
        endif; 
        $user = Auth::getProvider()->retrieveByCredentials($credentials); 
        Auth::login($user, $request->get('remember')); 
        //$user->assignRole('Admin'); 
        //$user->removeRole('Admin'); 
        return redirect()->intended('/')->withSuccess('Signed in'); 
    }

    /**
     * Déconnecter un utilisateur
     */
    public function logout() {
        Session::flush(); 
        Auth::logout(); 

        return redirect(route('login'));
    }
}
