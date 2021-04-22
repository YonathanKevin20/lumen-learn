<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class ExampleController extends Controller
{
    public function __construct()
    {
        //
    }

    public function index(Request $req)
    {
        $q = $req->q;

        return response()->json([
            'query' => $q,
            'url' => $req->url(),
            'method' => $req->method()
        ]);
    }

    public function show($id)
    {
        return User::findOrFail($id);
    }

    public function showProfile()
    {
        return response()->json(['url' => route('user', ['id' => 1])]);
    }
}
