<?php

namespace App\Http\Controllers\API\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePostRequest;
use App\Models\Post;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ManagePostApiController extends Controller
{
    public function index(): JsonResponse
    {
        $posts = Post::orderBy('id', 'DESC')->get();

        return response()->json([
            'success' => true,
            'data' => $posts
        ]);
    }

    public function store(StorePostRequest $request): JsonResponse
    {
        $input = $request->validated();

        if ($postimg = $request->file('images')) {
            $imagePath = public_path('storage/post');
            $postName = date('YmdHis') . '.' . $postimg->getClientOriginalExtension();
            $postimg->move($imagePath, $postName);
            $input['images'] = 'storage/post/' . $postName;
        }

        $post = Post::create($input);

        return response()->json([
            'status' => true,
            'message' => 'Post created successfully!',
            'data' => $post
        ]);
    }

    public function update($id, StorePostRequest $request)
    {
        $updatePost = Post::findOrFail($id);
        $input = $request->except('_method');

        if ($request->hasFile('images')) {
            $imagePath = public_path('storage/post/updatedimg');
            $imageName = 'updateimg' . date('YmdHis') . '.' . $request->file('images')->getClientOriginalExtension();
            $request->file('images')->move($imagePath, $imageName);
            $input['images'] = 'storage/post/updatedimg/' . $imageName;
        } else {
            $input['images'] = $updatePost->images;
        }

        $updatePost->update($input);

        return response()->json([
            'status'  => true,
            'message' => 'Post updated successfully!',
            'data'    => $updatePost,
        ], 200);
    }


    public function show($id): JsonResponse
    {
        $post = Post::find($id);

        if (!$post) {
            return response()->json([
                'status' => false,
                'message' => 'Post not found!'
            ]);
        }

        return response()->json([
            'status' => true,
            'message' => 'Post found successfully!',
            'data' => $post
        ]);
    }

    public function delete($id): JsonResponse
    {
        $post = Post::find($id);

        if (!$post) {
            return response()->json([
                'status' => false,
                'message' => 'Post not found!'
            ]);
        }

        $post->delete();

        return response()->json([
            'status' => true,
            'message' => 'Post deleted successfully!'
        ]);
    }
}
