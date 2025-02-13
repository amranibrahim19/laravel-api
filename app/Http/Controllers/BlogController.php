<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Carbon\Carbon;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data =  Blog::with('user')->orderBy('created_at', 'desc')->get();

        foreach ($data as $value) {
            $blogs[] = [
                'id' => $value->id,
                'title' => $value->title,
                'slug' => $value->slug,
                'content' => $value->content,
                'image' => $value->image,
                'user' => [
                    'id' => $value->user->id,
                    'name' => $value->user->name,
                    'email' => $value->user->email,
                ],
                'created_at' => Carbon::parse($value->created_at)->format('d-m-Y H:i:s'),
                'updated_at' => Carbon::parse($value->updated_at)->format('d-m-Y H:i:s')
            ];
        }

        return response()->json([
            'data' => $blogs
        ], 200, [], JSON_UNESCAPED_UNICODE);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show($slug)
    {
        $data =  Blog::where('slug', $slug)->with('user')->firstOrFail();

        $blog = [
            'id' => $data->id,
            'title' => $data->title,
            'slug' => $data->slug,
            'content' => $data->content,
            'image' => $data->image,
            'user' => [
                'id' => $data->user->id,
                'name' => $data->user->name,
                'email' => $data->user->email,
            ],
            'created_at' => Carbon::parse($data->created_at)->format('d-m-Y H:i:s'),
            'updated_at' => Carbon::parse($data->updated_at)->format('d-m-Y H:i:s')
        ];

        return response()->json([
            'data' => $blog
        ], 200, [], JSON_UNESCAPED_UNICODE);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Blog $blog)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Blog $blog)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Blog $blog)
    {
        //
    }
}
