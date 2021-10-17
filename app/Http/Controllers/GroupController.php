<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\User;
use App\Models\Group;
use Illuminate\Support\Facades\Validator;
use Laravel\Ui\Presets\React;

class GroupController extends Controller
{
    // returns all groups
    public function groups()
    {
        $groups = Group::all();
        foreach ($groups as  $group) {
            $members = array();
            $users = Group::find($group->id)->users;
            foreach ($users as $user) {
                array_push($members, $user->name." (".ucfirst($user->role).")");
            }
            $group->members = $members;
        }

        return view('admin.group.groups', ['groups' => $groups]);
    }

    // returns add groups
    public function add_group_load()
    {
        return view('admin.group.add_group');
    }

    // add groups to db from request
    public function add_group(Request $request)
    {
        // validates request
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255', 'unique:groups'],
        ]);

        if ($validator->fails()) {
            return redirect()->route('admin.add-group')
                ->withErrors($validator)
                ->withInput();
        }

        // adds group to db
        Group::create([
            'name' => $request['name'],
        ]);

        return redirect()->route('admin.groups')
            ->with('status', 'Group succesfully added!');
    }

    // deletes group and changes all members & events in it to unassigned group
    public function delete_group($id)
    {
        $group = Group::find($id);
        if (Auth::user()->group_id == $group->id) {
            return redirect()->route('admin.groups')
                ->with('error', 'Cannot delete own group');
        } else {
            // please note that group 1 -> Unassigned cannot be deleted due to db restrictions
            if ($id == 1) {
                return redirect()->route('admin.groups')
                    ->with('error', "Cannot delete group 'Unassigned'");
            }

            $users = Group::find($group->id)->users;
            foreach($users as $user){
                $user->update(['group_id' => 1]);
            }

            $events = Group::find($group->id)->events;
            foreach($events as $event){
                $event->groups()->detach($group->id);
            }

            $group->delete();

            return redirect()->route('admin.groups')
                ->with('status', 'Group succesfully deleted!');
        }
    }
}
