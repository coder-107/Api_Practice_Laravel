<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePostRequest;
use App\Models\Post;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PostController extends Controller
{
    public function index(): View
    {
        $posts = Post::latest()->get();
        return view('admin.blog.index', compact('posts'));
    }

    public function create(): View
    {
        return view('admin.blog.create');
    }

    // public function store(Request $request): RedirectResponse
    // {
    //     $request->validate([
    //         // 'title' => 'bail|required|max:191',
    //         'title' => 'required',
    //         'description' => 'required',
    //         'images' => 'required',
    //         'status' => 'required'
    //     ]);

    //     $input = $request->all();

    //     if ($postimg = $request->file('images')) {
    //         $imagepath = public_path('storage/post');
    //         $postimgname = date('YmdHis') . '.' . $postimg->getClientOriginalExtension();
    //         $postimg->move($imagepath, $postimgname);
    //         $input['images'] = 'storage/post/' . $postimgname;
    //     }

    //     // if ($input['status'] == 'Active')
    //     // {
    //     //     Post::create([
    //     //         'title' => $input['title'],
    //     //         'description' => $input['description'],
    //     //         'images' => $input['images'],
    //     //         'status' => $input['status']
    //     //     ]);
    //     // }
    //     Post::create([
    //         'title' => $input['title'],
    //         'description' => $input['description'],
    //         'images' => $input['images'],
    //         'status' => $input['status']
    //     ]);
    //     // dd($input);

    //     return redirect()->route('blog.home')->with('success', 'Post Created Successfully!');
    // }

    // Using Form Request class:
    public function store(StorePostRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        $validated = $request->safe()->except(['title','title']);
        $validated = $request->safe()->except(['description','description']);
        $validated = $request->safe()->except(['images','images']);
        $validated = $request->safe()->except(['status','status']);

        $input = $request->all();
        // dd($postimg = $request->file('images'));

        if($postimg = $request->file('images'))
        {
            $imagepath = public_path('storage/post');
            $postname = date('YmdHis').'.'.$postimg->getClientOriginalExtension();
            $postimg->move($imagepath, $postname);
            $input['images'] = 'storage/post/'.$postname;
        }

        // dd($input['images']);

        Post::create([
            'title' => $input['title'],
            'description' => $input['description'],
            'images' => $input['images'],
            'status' => $input['status']
        ]);

        // dd($input);

        return redirect()->route('blog.home')->with('success', 'Post Created Successfully!');
    }

    public function edit($id)
    {
        $posts = Post::find($id);
        return view('admin.blog.edit', compact('posts'));
    }
}
