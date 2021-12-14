<?php

namespace App\Http\Controllers;

use Response;
use Auth;

use App\Models\Group;
use App\Models\User;

use Illuminate\Support\Facades\Mail;
use App\Mail\SendMail;

use Illuminate\Http\Request;

class ProfileController extends Controller
{
    // index, returns index
    public function profile()
    {
        //Log example
        $profile = Auth::user();
        $profile->group = Group::find($profile->group_id)->name;
        return view('admin.profile.index', ['profile' => $profile]);
    }

    public function change_password(){
        if (Auth::user()->role == "admin" || Auth::user()->role == "super_admin") {
            return redirect()->route('admin.change-password')
                ->with('status', 'Please enter a new password with min 16 characters, including at least one: number, symbol, upper and lowercase characters.');
        } else {
            return redirect()->route('admin.change-password')
                ->with('status', 'Please enter a new password with min 8 characters, including at least one: number, symbol, upper and lowercase characters.');
        }
    }

    public function download()
    {
        $profile = Auth::user();
        $data = json_encode($profile);

        $headers = [
            'Content-type'        => 'application/json',
            'Content-Disposition' => 'attachment; filename="' . $profile->name . '_userdata.json"',
        ];
    
        return Response::make($data, 200, $headers);
    }

    public function delete()
    {
        $user = Auth::user();
        if ($user->role != "admin" && $user->role != "super_admin") {
            $MailReceivers = User::where('role', 'admin')->get();
        } elseif ($user->role != "super_admin") {
            $MailReceivers = User::where('role', 'super_admin')->get();

        } else {
            return redirect()->route('admin.profile')
            ->with('error', "Please contact the database admin to delete your account.");
        }

        $data = (object) [
            'name' => $user->name,
            'email' => $user->email,
            'type' => "deleteprofile",
        ];

        try {
            foreach ($MailReceivers as  $MailReceiver){
                //error_log($MailReceiver->email);
                Mail::to($MailReceiver->email)->send(new SendMail('better.ge.tracker@gmail.com', $data));
            }
        }
        catch(\Exception $e){ // Error if mail isn't send
            return redirect()->route('admin.profile')
            ->with('error', $e->getMessage());
        }

        return redirect()->route('admin.profile')
        ->with('status', 'Succesfully send account deletion request.');
    }
}