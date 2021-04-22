<?php

namespace App\Http\Controllers;

use App\Models\User;

class ExampleController extends Controller
{
    public function __construct()
    {
        //
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
