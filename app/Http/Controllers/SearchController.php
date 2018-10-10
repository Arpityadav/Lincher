<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SearchController extends Controller
{
    public function show()
    {
        if ($query = request('query')) {
            $users = User::where('name', 'LIKE', $query)->orWhere('username', 'LIKE', $query)->get();
        }
        return view('search.show', compact('users'));
    }
}
