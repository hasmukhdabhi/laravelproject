<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Facades\Validator;

class PostController extends Controller
{

    /**
     * Write code on Method
     * 
     * @return response()
     */

    public function index(Request $request)
    {
        $posts = Post::paginate(5);

        return response()->json([
            "status" => 1,
            "message" => "Post fetched",
            "data" => $posts
        ]);
    }

    /**
     * Write code on Method
     * 
     * @return response()
     * 
     */
    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            "title" => "required",
            "body" => "required"
        ]);

        if ($validator->fails()) {
            return response()->json([
                "status" => 0,
                "message" => "Validation Error.",
                "data" => $validator->errors()->all()
            ]);
        }

        $post = Post::create([
            "title" => $request->title,
            "body" => $request->body,
        ]);

        return response()->json([
            "status" => 1,
            "message" => "Post created.",
            "data" => $post
        ]);
    }

    /**
     * Write code on Method
     * 
     * @return response()
     * 
     */


    public function show(Request $request, $id)
    {
        $post = Post::find($id);

        return response()->json([
            "status" => 1,
            "message" => "Post return.",
            "data" => $post
        ]);
    }

    /**
     * Write code on Method
     * 
     * @return response()
     * 
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            "title" => "required",
            "body" => "required"
        ]);
        if ($validator->fails()) {
            return response()->json([
                "status" => 0,
                "message" => "Validation Error.",
                "data" => $validator->errors()->all()
            ]);
        }
        $post = Post::find($id);
        $post->title = $request->title;
        $post->body = $request->body;
        $post->save();

        return response()->json([
            "status" => 1,
            "message" => "Post updated.",
            "data" => $post
        ]);
    }

    // Delete Post
    public function destroy(Request $request, $id)
    {

        $validator = Validator::make($request->all(), [
            "title" => "required",
            "body" => "required"
        ]);
        if ($validator->fails()) {
            return response()->json([
                "status" => 0,
                "message" => "Validation Error.",
                "data" => $validator->errors()->all()
            ]);
        }
        $post = Post::find($id);
        if (!$post) {
            return response()->json([
                "status" => 0,
                "message" => "Post not found.",
                "data" => null
            ]);
        }

        $post->delete();
        return response()->json([
            "status" => 1,
            "message" => "Post deleted.",
            "data" => null
        ]);
    }
}
