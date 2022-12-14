<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostFilter;
use App\Http\Requests\PostRequest;
use App\Models\Post;
use Illuminate\Database\Query\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Inertia\Inertia;

class PostController extends Controller
{
    protected function getPosts(Request $query){
        $filter = $query->validate([
            'search'=> 'string',
            'order'=>   Rule::in(['ASC', 'DESC']),
            'orderBy'=> Rule::in(['id', 'title', 'slug']),
            'perPage' => 'numeric',
        ]);
        $posts = Post::query();
        foreach($filter as $key=>$value){
            switch($key){
            case 'orderBy': 
                $posts->orderBy($value, $filter['order'] ?? 'DESC');
            break;
            case 'search':
                $posts->where(function(Builder $query) use ($value){
                    $query->where('title', 'like', '%'.$value.'%')->orWhere('slug', 'like', '%'.mb_strtolower($value).'%');
                });
            break;
            }
        }
        if(!empty($filter['perPage'])){
            return $posts->paginate($filter['perPage']);
        }
        return $posts->paginate(12);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $query)
    {
        return Inertia::render('admin/list-posts', ['posts'=>$this->getPosts($query)] );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return Inertia::render('admin/post-form');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostRequest $request)
    {
        $post = new Post;
        $post->fill($request->all());
        $post->user_id = Auth::user()->id;
        $post->save();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        //return Inertia::render();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        return Inertia::render('admin/post-form', [ 'post' =>$post ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PostRequest $request, Post $post)
    {
        $post->fill($request->all());
        $post->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $post->delete();
    }
}
