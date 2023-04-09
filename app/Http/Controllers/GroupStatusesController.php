<?php

namespace App\Http\Controllers;

use App\Models\Group;
use App\Models\GroupStatus;
use App\Models\Status;
use Illuminate\Http\Request;

class GroupStatusesController extends Controller
{
    public function stores(Request $request, Group $group)
    {

        $this->validate($request, [
            'body' => 'required',
        ]);

        $status = new GroupStatus;
        $status->body = $request->body;
        $status->user_id = auth()->id();
        $status->group_id = $group->id;

        $group->statuses()->save($status);

        return redirect()->route('group_statuses.stores', $group);
    }
}
