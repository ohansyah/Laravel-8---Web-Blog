<?php

namespace App\Http\Controllers;

use App\Exceptions\PostNotFoundException;
use App\Models\Post;
use App\Services\PostService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{

    private $postService;
    public function __construct(PostService $postService)
    {
        $this->postService = $postService;
        $this->middleware('auth', ['except' => ['index', 'show']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $posts = Post::orderBy('created_at', 'desc')->get();

        $posts = Post::orderBy('id', 'desc')->paginate(6);
        return view('posts.index')->with('posts', $posts);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = 'Create a Post';
        return view('posts.create')->with('title', $title);
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
            'category' => 'required',
            'image' => 'image|nullable|max:4000',
        ]);

        // handling file upload
        $path = null;
        if ($request->hasFile('image')) {
            $file_name_with_ext = $request->file('image')->getClientOriginalName();
            $file_name = pathinfo($file_name_with_ext, PATHINFO_FILENAME);
            $file_ext = $request->file('image')->getClientOriginalExtension();
            $file_name_to_store = $file_name . '_' . time() . '.' . $file_ext;
            $path = $request->file('image')->storeAs('public/cover_images', $file_name_to_store);
        }

        $post = new Post();
        $post->title = $request->input('title');
        $post->body = $request->input('body');
        $post->category = $request->input('category');
        $post->image = $file_name_to_store;
        $post->user_id = Auth::id();
        $post->save();

        return redirect('/dashboard')->with('success', 'Post Created');
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
        $post['is_owner'] = $this->postService->isOwner($post->user_id);
        return view('posts.show')->with('post', $post);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        try {
            $post = $this->postService->validateUserPost($id);
        } catch (PostNotFoundException $exception) {
            return back()->withError($exception->getMessage())->withInput();
        }

        return view('posts.edit')->with('post', $post);
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
        $this->validate($request, [
            'title' => 'required',
            'body' => 'required',
            'category' => 'required',
        ]);

        try {
            $post = $this->postService->validateUserPost($id);
        } catch (PostNotFoundException $exception) {
            return back()->withError($exception->getMessage())->withInput();
        }

        $post->title = $request->input('title');
        $post->body = $request->input('body');
        $post->category = $request->input('category');
        $post->save();

        return redirect('/dashboard')->with('success', 'Post Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $post = $this->postService->validateUserPost($id);
        } catch (PostNotFoundException $exception) {
            return back()->withError($exception->getMessage())->withInput();
        }

        $post->delete();
        return redirect('/posts')->with('success', 'Post Deleted');

    }
}
