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
use App\Models\Event;
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

        $this->logger->info('User created, email: '.$request['email']);

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
            $eventsC = Event::select(['id'])->where('created_by_id', $id)->pluck('id');
            Event::where('created_by_id', $id)->update(["created_by_id" => Auth::user()->id]);
            foreach ($eventsC as  $eventId){
                $this->logger->info('Event updated created_by_id due to deletion of user id: '.$id.', event id: '.$eventId);
            }

            $eventsU = Event::select(['id'])->where('updated_by_id', $id)->pluck('id');
            Event::where('updated_by_id', $id)->update(["updated_by_id" => Auth::user()->id]);
            foreach ($eventsU as  $eventId){
                $this->logger->info('Event updated updated_by_id due to deletion of user id: '.$id.', event id: '.$eventId);
            }

            $userEmail = $user->email;
            $user->delete();

            $this->logger->info('User deleted, email: '.$userEmail.'id: '.$id);

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
        if (auth()->user()->role == "admin") {
            $validator = Validator::make($request->all(), [
                'current_password' => ['required', new MatchOldPassword],
                'password' => ['required', 'string', 'min:16', 'regex:/^.*(?=.{3,})(?=.*[a-zA-Z])(?=.*[0-9])(?=.*[\d\x])(?=.*[!?@€$#*%_&-]).*$/'],
                'confirm_password' => ['same:password'],
            ]);

            if ($validator->fails()) {
                return redirect()->route('admin.change-password')
                    ->withErrors($validator)
                    ->with('status', 'This is your first login, please enter a new password with min 16 characters, number, symbol, upper and lowercase characters.');
            }
        } else {
            $validator = Validator::make($request->all(), [
                'current_password' => ['required', new MatchOldPassword],
                'password' => ['required', 'string', 'min:8', 'regex:/^.*(?=.{3,})(?=.*[a-zA-Z])(?=.*[0-9])(?=.*[\d\x])(?=.*[!?@€$#*%_&-]).*$/'],
                'confirm_password' => ['same:password'],
            ]);

            if ($validator->fails()) {
                return redirect()->route('admin.change-password')
                    ->withErrors($validator)
                    ->with('status', 'This is your first login, please enter a new password with min 8 characters, number, symbol, upper and lowercase characters.');
            }
        }

        User::find(auth()->user()->id)->update(['password' => Hash::make($request->password)]);

        $this->logger->info('User updated password, self');

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

        $user = User::find($request->id);
        $user->update(['role' => $request->role, 'group_id' => $request->group]);

        $this->logger->info('User updated role: '.$request->role.' or group: '.$request->group.'from email: '.$user->email);
        return redirect()->route('admin.users');
    }
}
