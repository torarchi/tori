<?php

namespace App\Http\Controllers;

use App\Models\Group;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class SearchController extends Controller
{
    public function getResults(Request $request){
        $query = $request->input('query');

        // Search for users and groups where the name or username contains the query
        $users = User::where(DB::raw("CONCAT(first_name, ' ', last_name)"), 'LIKE', "%{$query}%")
            ->orWhere('username', 'LIKE', "%{$query}%")
            ->get();
        $groups = Group::where('name', 'like', '%' . $query . '%')
            ->get();

        // Return the search results view with the users and groups
        return view('search.results', compact('users', 'groups'));
    }
}

