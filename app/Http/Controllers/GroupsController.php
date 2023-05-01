<?php

namespace App\Http\Controllers;

use App\Models\Group;
use App\Models\GroupStatus;
use App\Models\Status;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GroupsController extends Controller
{
    public function index()
    {
        $groups = Group::paginate(10);

        return view('groups.index', compact('groups'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:10',
        ]);

        $group = new Group;
        $group->name = $request->name;
        $group->creator_id = auth()->id();
        $group->save();

        $group->users()->attach(auth()->id());

        return redirect()->route('groups.index');
    }

    public function stores(Request $request, Group $group)
    {
        $request->validate([
            'body' => 'required|max:255',
        ]);

        $group_status = new GroupStatus();
        $group_status->body = $request->body;
        $group_status->user_id = auth()->user()->id;
        $group_status->group_id = $group->id;
        $group_status->save();

        return redirect()->route('groups.show', $group)->with('success', 'Group status created successfully.');
    }

    public function join(Group $group)
    {
        $user = Auth::user();
        if ($group->members && $group->members->contains($user)) {
            return redirect()->route('groups.show', $group)->with('error', 'You are already a member of this group.');
        }

        $group->members()->attach($user);

        return redirect()->route('groups.show', $group)->with('success', 'You have joined the group!');
    }

    public function leave(Group $group)
    {
        $group->users()->detach(auth()->id());

        return redirect()->route('groups.index');
    }

    public function destroy(Group $group)
    {
        $group->delete();

        return redirect()->route('groups.index');
    }

    public function create()
    {
        return view('groups.create');
    }

    public function show(Group $group)
    {
        $user = auth()->user();

        if (!$user || !$group->users->contains($user)) {
            return redirect()->route('groups.index')->with('error', 'You do not have permission to view this group.');
        }

        $statuses = $group->statuses()->latest()->paginate(10);

        return view('groups.show', compact('group', 'statuses'));
    }


    public function update(Request $request, Group $group)
    {
        $request->validate([
            'name' => 'required|max:25',
            'description' => 'required',
        ]);

        $group->update([
            'name' => $request->name,
            'description' => $request->description,
        ]);

        return redirect()->route('groups.show', $group)->with('success', 'Group updated successfully');
    }
}
