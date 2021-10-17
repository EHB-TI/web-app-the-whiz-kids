<?php

namespace App\Traits;

use App\Models\User;

trait FindUserTrait{
    public function find_user($id){
        return User::find($id);
    }
}