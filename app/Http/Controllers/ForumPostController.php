<?php

namespace App\Http\Controllers;

use App\Models\ForumPost;
use Illuminate\Http\Request;
use App\Models\User; 

class ForumPostController extends Controller
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
            $posts = ForumPost::Select()->where('langue', session()->get('locale'))->paginate(15); 
        }
        else {
            $posts = ForumPost::Select()->where('langue', 'en')->paginate(10);
        }
        
        $user = User::find(Auth()->user()->id); 
        $user->removeRole('Editor'); 
        return view('forum.index', ['posts' => $posts, 'users' => $users]); 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('forum.create');
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
            'titre' => 'required|min:6|max:400', 
            'corps' => 'required|min:20|max:2000'
        ]); 

        ForumPost::create([
            'titre' => $request->titre, 
            'corps' => $request->corps, 
            'langue' => $request->langue, 
            'user_id' => $request->user_id
        ]);

        return redirect(route('forum.index')); 
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ForumPost  $forumPost
     * @return \Illuminate\Http\Response
     */
    public function show(ForumPost $forumPost)
    {
        $users = User::all(); 
        $user = $users->where('id', $forumPost->user_id);  
        foreach ($user as $u) {
            $nomUser = $u->name; 
        } 
        
        $user = User::find(Auth()->user()->id); 
        if($user->id === $forumPost->user_id) {
            $user->assignRole('Editor'); 
        }
        else {
            $user->removeRole('Editor'); 
        }

        return view('forum.show', ['post' => $forumPost, 'nomUser' => $nomUser]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ForumPost  $forumPost
     * @return \Illuminate\Http\Response
     */
    public function edit(ForumPost $forumPost)
    {
        return view('forum.edit', ['post' => $forumPost]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ForumPost  $forumPost
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ForumPost $forumPost)
    {
        $request->validate([
            'titre' => 'required|min:6|max:400', 
            'corps' => 'required|min:20|max:2000'
        ]); 
        
        $forumPost->update([
            'titre' => $request->titre,
            'corps' => $request->corps,
            'langue' => $request->langue
        ]);

        return redirect(route('forum.show', $forumPost->id));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ForumPost  $forumPost
     * @return \Illuminate\Http\Response
     */
    public function destroy(ForumPost $forumPost)
    {
        $user = User::find(Auth()->user()->id); 
        if($user->id === $forumPost->user_id) {
            $user->assignRole('Editor'); 
        }
        else {
            $user->removeRole('Editor'); 
        }

        $forumPost->delete(); 

        return redirect(route('forum.index'));
    }
}
