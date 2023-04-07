<?php

namespace App\Http\Controllers;

use App\Models\Status;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{

    public function index()
    {
        if (Auth::check()) {
            $statuses = Status::orderBy('created_at', 'desc')->paginate(10);
            return view('timeline.index')->with('statuses', $statuses);
        }
        return view('home');
    }



}
