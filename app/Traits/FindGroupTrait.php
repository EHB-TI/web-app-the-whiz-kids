<?php

namespace App\Traits;

use App\Models\Group;

trait FindGroupTrait{
    public function find_group($id){
        return Group::find($id);
    }
}