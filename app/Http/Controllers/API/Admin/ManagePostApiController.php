<?php

namespace App\Http\Controllers\API\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePostRequest;
use App\Models\Post;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ManagePostApiController extends Controller
{
    public function index()
    {
        $posts = Post::orderBy('id', 'DESC')->get();

        return response()->json([
            'success' => true,
            'data' => $posts
        ], 200);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'description' => 'required',
            'images' => 'required',
            'status' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => $validator
            ]);
        }

        $validated = $validator->validated();

        $validated = $validator->safe()->except(['title', 'title']);
        $validated = $validator->safe()->except(['description', 'description']);
        $validated = $validator->safe()->except(['images', 'images']);
        $validated = $validator->safe()->except(['status', 'status']);

        $input = $request->all();
        // dd($postimg = $request->file('images'));

        if ($postimg = $request->file('images')) {
            $imagepath = public_path('storage/post');
            $postname = date('YmdHis') . '.' . $postimg->getClientOriginalExtension();
            $postimg->move($imagepath, $postname);
            $input['images'] = 'storage/post/' . $postname;
        }

        // dd($input['images']);

        Post::create([
            'title' => $input['title'],
            'description' => $input['description'],
            'images' => $input['images'],
            'status' => $input['status']
        ]);

        // dd($input);

        return response()->json([
            'status' => true,
            'message' => 'Post created Successfully!',
            'data' => $input
        ]);
    }

    public function update($id, StorePostRequest $request): JsonResponse
    {

        // dd($request->hasFile('images'));     //false
        $validated = $request->validated();

        $validated = $request->safe()->except(['title', 'description', 'images', 'status']);
    
        $updateInput = $request->all();
        // dd($request->file('images'));

        if ($updatePostImg = $request->file('images')) {
            $updatedPath = public_path('storage/post/updatedimg');
            $postName = 'updateimg' . date('YmdHis') . '.' . $updatePostImg->getClientOriginalExtension();
            $updatePostImg->move($updatedPath, $postName);
            $updateInput['images'] = 'storage/post/updatedimg/' . $postName;
        }
        // dd($updatePostImg = $request->file('images'));

        $updatePost = Post::findOrFail($id);
        // dd($updatePost);
        $updatePost->update($updateInput);
        // dd($updatePost->update($updateInput));

        return response()->json([
            'success' => true,
            'message' => 'Post Updated Successfully!',
            'data' => $updatePost,
        ], 200);
    }

    public function show($id)
    {
        $findpost = Post::find($id);
        if(!$findpost)
        {
            return response()->json([
                'status' => false,
                'message' => 'Post Not Found'
            ]);
        }

        $findpost->first();

        return response()->json([
            'status' => true,
            'message' => 'Post founded successfully!',
            'data' => $findpost
        ]);
    }

    public function delete($id)
    {
        $finddelete = Post::find($id);

        if(!$finddelete)
        {
            return response()->json([
                'status' => false,
                'message' => 'Post Not found!'
            ]);
        }

        $finddelete->delete();

        return response()->json([
            'status' => true,
            'message' => 'Post Deleted Successfully!'
        ]);
    }
}
