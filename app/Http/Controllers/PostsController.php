<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use Illuminate\Support\Facades\Storage;
class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

     /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth',['except'=>['index','show']]);
    }


    public function index()
    {
        $posts = Post::orderBy('created_at','desc')->paginate(10);
        return view('posts.index')->with('posts',$posts);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
                'title' => 'required',
                'body' => 'required',
                'cover_image'=> 'image|nullable|max:1999'
        ]);

        //handle file upload

        if($request->hasFile('cover_image')){
                $filenamewithExt = $request->file('cover_image')->getClientOriginalName();
                $filename = pathinfo($filenamewithExt,PATHINFO_FILENAME);
                $extension = $request->file('cover_image')->guessClientExtension();
                $fileNameToStore = time().'.'.$extension;
                
                //Upload slike
                $path = $request->file('cover_image')->storeAs('public/cover_images/',$fileNameToStore);
        }else{
            $fileNameToStore = 'noimage.jpg';
        }

        $post = new Post;
        $post->title = $request->input('title');
        $post->body = $request->input('body');
        $post->user_id = auth()->user()->id;
        $post->cover_image = $fileNameToStore;
        $post->save();

        return redirect('/posts')->with('success','Plan Kreiran');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::find($id);
        return view('posts.show')->with('post',$post);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::find($id);
        //provjerava se pravilan korisnik
        if(auth()->user()->id !==$post->user_id){
            return redirect('/posts')->with('error','Nedozvoljen pristup!');
        }
        
        return view('posts.edit')->with('post',$post);
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
        $post = Post::find($id);
        //provjerava se pravilan korisnik
        if(auth()->user()->id !==$post->user_id){
            return redirect('/posts')->with('error','Nedozvoljen pristup!');
        }
        $this->validate($request, [
            'title' => 'required',
            'body' => 'required'
    ]);

    if($request->hasFile('cover_image')){
        $filenamewithExt = $request->file('cover_image')->getClientOriginalName();
        $filename = pathinfo($filenamewithExt,PATHINFO_FILENAME);
        $extension = $request->file('cover_image')->guessClientExtension();
        $fileNameToStore = time().'.'.$extension;
        
        //Upload slike
        $path = $request->file('cover_image')->storeAs('public/cover_images/',$fileNameToStore);
}
    $post = Post::find($id);
    $post->title = $request->input('title');
    if($request->hasFile('cover_image')){
        $post->cover_image = $fileNameToStore;
    }

    $post->save();

    return redirect('/posts')->with('success','Plan Izmjenjen!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::find($id);
        //provjerava se pravilan korisnik
        if(auth()->user()->id !==$post->user_id){
            return redirect('/posts')->with('error','Nedozvoljen pristup!');
        }

        if($post->cover_image !='noimage.jpg'){
            Storage::delete('public/cover_images/'.$post->cover_image);
        }

        $post->delete();
        return redirect('posts')->with('success','Post Removed');
    }
}
