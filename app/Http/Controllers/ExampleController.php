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

    public function search(Request $req)
    {
        $q = $req->q;

        return response()->json([
            'query' => $q,
            'url' => $req->url(),
            'method' => $req->method()
        ]);
    }

    public function index(Request $req)
    {
        $role = $req->role;
        $search = $req->search;
        $page = $req->page ?? 1;

        $models = new User;

        if ($role) {
            $models = $models->where('role', $role);
        }

        if ($search) {
            $search = addslashes($search);
            $models = $models->orWhere('name', 'ILIKE', '%'.$search.'%')
            ->orWhere('email', 'ILIKE', '%'.$search.'%')
            ->orWhere('username', 'ILIKE', '%'.$search.'%');
        }

        $count = $models->count();
        $perpage = $req->perpage == 'all' ? $count : $req->perpage ?? 10;
        $last_page = $perpage > 0 ? ceil($count / $perpage) : 0;

        $models = $models->skip(($page - 1) * $perpage)->take($perpage);
        $models = $models->orderBy('name', 'ASC')->get();

        foreach ($models as &$model) {}

        $pagination = [
            'total' => $count,
            'per_page' => (int) $perpage,
            'current_page' => (int) $page,
            'last_page' => $last_page,
            'first_item' => ($page - 1) * $perpage + 1,
            'last_item' => min(($page) * $perpage, $count),
            'pages' => getPaginationArray($page, $last_page),
        ];

        return response()->json([
            'data' => $models,
            'pagination' => $pagination
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
