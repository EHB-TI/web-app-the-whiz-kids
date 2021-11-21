<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

use App\Models\User;
use App\Models\Group;

use Illuminate\Support\Facades\Mail;
use App\Mail\SendMail;

use App\Rules\MatchOldPassword;
use App\Rules\Role;

use Auth;

use App\Traits\FindUserTrait;

class UserController extends Controller
{
    // returns all users
    public function users()
    {
        $users = User::all();
        foreach ($users as  $user){
            $user->group_name = Group::find($user->group_id)->name;
        }

        return view('admin.user.users', ['users' => $users]);
    }

    use FindUserTrait;

    // loads add user page
    public function add_user_load(){
        $groups = Group::all();
        return view('admin.user.add_user', ['groups' => $groups]);
    }

    // manages request to add user
    public function add_user(Request $request)
    {
        // validates request
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'role' => ['required', new Role],
            'group' => ['required', 'exists:groups,id']
        ]);

        if ($validator->fails()) {
            return redirect()->route('admin.add-user')
                ->withErrors($validator)
                ->withInput();
        }

        // Generate random password for user
        $password = Str::random(16);

        // create new user
        User::create([
            'group_id' => $request['group'],
            'name' => $request['name'],
            'email' => $request['email'],
            'password' => Hash::make($password),
            'role' => $request['role'],
        ]);

        // Send mail to new user
        $data = (object) [
            'name' => $request->name,
            'type' => "usercreate",
            'password' => $password
        ];

        try {
            Mail::to($request->email)->send(new SendMail('better.ge.tracker@gmail.com', $data));
        }
        catch(\Exception $e){ // Error if mail isn't send & delete created user
            $user = User::where('email', $request['email'])->first();
            $user->delete();
            return redirect()->route('admin.add-user')
            ->withErrors(['emailService' => [$e->getMessage()]])
            ->withInput();
        }

        return redirect()->route('admin.users')
            ->with('status', 'User succesfully added!');
    }

    // deletes user
    public function delete($id)
    {
        $user = User::find($id);
        if (Auth::user() == $user) {
            return redirect()->route('admin.users')
                ->with('error', 'Cannot delete self');
        } else {
            // Change all events created by and updated by id to admin? Delete all events of this user? Make button to delete all events of this user?

            $user->delete();

            return redirect()->route('admin.users')
                ->with('status', 'User succesfully deleted!');
        }
    }

    // change password form
    public function change_password()
    {
        return view('auth.passwords.change');
    }

    // request handler for password form
    public function change_password_submit(Request $request)
    {
        $request->validate([
            'current_password' => ['required', new MatchOldPassword],
            'password' => ['required', 'string', 'min:16', 'regex:/^.*(?=.{3,})(?=.*[a-zA-Z])(?=.*[0-9])(?=.*[\d\x])(?=.*[!$#%]).*$/'],
            'confirm_password' => ['same:password'],
        ]);

        User::find(auth()->user()->id)->update(['password' => Hash::make($request->password)]);

        return redirect()->route('admin.index');
    }

    // loads edit user page
    public function edit_user_load($id){
        $user = User::find($id);
        $groups = Group::all();
        return view('admin.user.edit_user', ['user' => $user, 'groups' => $groups]);
    }

    // handles edit user form 
    public function edit_user(Request $request, $id){
        
        $request->validate([
            'id' => ['required', 'exists:users,id'],
            'role' => ['required', new Role],
            'group' => ['required', 'exists:groups,id'],
        ]);

        User::find($request->id)->update(['role' => $request->role, 'group_id' => $request->group]);

        return redirect()->route('admin.users');
    }
}
