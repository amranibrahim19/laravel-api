<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:sanctum')->except(['index']);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $data = User::where('id', '=', auth()->id())
                ->with(['tasks', 'blogs'])
                ->first();


            return response()->json([
                'data' => $data,
                'message' => 'User data retrieved successfully'
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'User data not found'
            ], 404);
        }
    }
}
