<?php

namespace App\Http\Controllers;

use App\Models\Status;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class StatusController extends Controller
{


    public function postStatus(Request $request){
        $this->validate($request, [
            'status' => 'required|max:250',
        ]);

        Auth::user()->statuses()->create([
            'body' => $request->input('status'),
        ]);
        return redirect()->route('home')->with('info','Запись успешно опубликована');
    }

    public function removeStatus(Request $request, $id){
        $status = Auth::user()->statuses()->findOrFail($id);
        $status->delete();
        return redirect()->route('home')->with('info', 'Статус успешно удален');
    }
}
