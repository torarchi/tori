<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ProfileController extends Controller
{
    public function getProfile($username){
        $user = User::where('username', $username)->first();

        if (!$user) {
            abort(404);
        }

        $statuses = $user->statuses()->orderBy('created_at', 'desc')->paginate(5);
        $totalStatusesCount = $statuses->total();


        return view('profile.index')
            ->with('user', $user)
            ->with('statuses', $statuses)
            ->with('totalStatusesCount', $totalStatusesCount)
            ->with('authUserIsFriend', Auth::user()->isFriendWith($user));
    }

    public function getEdit(){
        return view('profile.edit');
    }

    public function postEdit(Request $request){
        $this->validate($request, [
            'username' => 'alpha|max:25|unique:users,username,' . Auth::id(),
            'first_name' => 'alpha|max:50',
            'last_name' => 'alpha|max:50',
            'location' => 'max:20',
            'image' =>'max:2048',
        ]);

        Auth::user()->update([
            'username' => $request->input('username'),
            'first_name' => $request->input('first_name'),
            'last_name' => $request->input('last_name'),
            'location' => $request->input('location'),
            'image' => $request->input('image'),
        ]);

        return redirect()->route('profile.edit')->with('info', 'Ваш профиль был обновлён');
    }
}
