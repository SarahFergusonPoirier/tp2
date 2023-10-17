<?php

namespace App\Http\Controllers;

use App\Models\File;
use Illuminate\Http\Request;
use App\Models\User; 
use Illuminate\Support\Str; 
use PDF; 
use Illuminate\Support\Facades\Storage; 

class FileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all(); 

        if (session()->get('locale') == "en" || session()->get('locale') == "fr") {
            $files = File::Select()->where('langue', session()->get('locale'))->paginate(15); 
        }
        else {
            $files = File::Select()->where('langue', 'en')->paginate(10);
        }
        
        $user = User::find(Auth()->user()->id); 
        $user->removeRole('Editor'); 
        return view('file.index', ['files' => $files, 'users' => $users]); 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('file.create');
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
            'name' => 'required|min:6|max:200'
        ]); 

        File::create([
            'name' => $request->name, 
            'langue' => $request->langue, 
            'user_id' => $request->user_id
        ]);

        return redirect(route('file.index')); 
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\File  $file
     * @return \Illuminate\Http\Response
     */
    public function show(File $file)
    {
        $users = User::all(); 
        $user = $users->where('id', $file->user_id);  
        foreach ($user as $u) {
            $nomUser = $u->name; 
        } 
        
        $user = User::find(Auth()->user()->id); 
        if($user->id === $file->user_id) {
            $user->assignRole('Editor'); 
        }
        else {
            $user->removeRole('Editor'); 
        }

        return view('file.show', ['file' => $file, 'nomUser' => $nomUser]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\File  $file
     * @return \Illuminate\Http\Response
     */
    public function edit(File $file)
    {
        return view('file.edit', ['file' => $file]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\File  $file
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, File $file)
    {
        
        $request->validate([
            'name' => 'required|min:6|max:200'
        ]); 
        
        $file->update([
            'name' => $request->name, 
            'langue' => $request->langue
        ]);

        return redirect(route('file.show', $file->id));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\File  $file
     * @return \Illuminate\Http\Response
     */
    public function destroy(File $file)
    {
        $user = User::find(Auth()->user()->id); 
        if($user->id === $file->user_id) {
            $user->assignRole('Editor'); 
        }
        else {
            $user->removeRole('Editor'); 
        }

        $file->delete(); 

        return redirect(route('file.index'));
    }

    /**
     * Télécharger un document 
     */
    public function showPDF(File $file) {
        $users = User::all(); 
        $user = $users->where('id', $file->user_id);  
        foreach ($user as $u) {
            $nomUser = $u->name; 
        }
        $pdf = PDF::loadView('file.show-pdf', ['file' => $file, 'nomUser' => $nomUser]);
        return $pdf->download($file->name);
    }
}
