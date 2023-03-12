<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FriendController extends Controller
{
    public function getIndex()
    {
        $friends = Auth::user()->friends();
        $frequests = Auth::user()->friendRequest();

        return view('friends.index')
            ->with('friends', $friends)
            ->with('frequests', $frequests);
    }

    public function getAdd($username)
    {
        $user = User::where('username', $username)->first();

        if (!$user) {
            return redirect()->route('home')->with('info', 'Пользователь не найден');
        }

        if (Auth::user()->hasFriendRequestPending($user) || $user->hasFriendRequestPending(Auth::user())) {
            return redirect()->route('profile.index', ['username' => $username])->with('info', 'Запрос уже был отправлен');
        }

        if (Auth::user()==$user){
            return redirect()
                ->route('profile.index', ['username'=> $user->username])
                    ->with('info', 'Вы не можете добавить себя в друзья.');
        }

        if(Auth::user()->isFriendWith($user)){
            return redirect()->route('profile.index', ['username' => $user->username])->with('info', 'Данный пользователь уже есть у вас в друзьях');
        }

        Auth::user()->addFriend($user);

        return redirect()->route('profile.index', ['username' => $username])->with('info', 'Запрос был успешно отправлен');
    }

    public function getAccept($username){
        $user = User::where('username', $username)->first();

        if (!$user) {
            return redirect()->route('home')->with('info', 'Пользователь не найден');
        }

        if(!Auth::user()->hasFriendRequestReceived($user)){
            return redirect()->route('home');
        }

        Auth::user()->acceptFriendRequest($user);

        return redirect()->route('profile.index', ['username' => $username])->with('info', 'Запрос в друзья был принят');

    }

    public function postDelete($username){
        $user=User::where('username', $username)->first();

        if(!Auth::user()->isFriendWith($user)){
            return redirect()->back();
        }

        Auth::user()->deleteFriend($user);

        return redirect()->back();
    }

}
