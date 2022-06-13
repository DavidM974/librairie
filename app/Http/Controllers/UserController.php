<?php

namespace App\Http\Controllers;

use App\Models\Roles;
use App\Models\RolesUser;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    function initUser() {
        User::insert([
            'name'=>'SuperAdmin',
            'email'=>'admin@email.com',
            'password'=>Hash::make('azerty')
        ]);

        RolesUser::insert([
            'role_id'=> 1,
            'user_id'=> User::where('email', 'admin@email.com')->first()->id
        ]);
        RolesUser::insert([
            'role_id'=> 2,
            'user_id'=> User::where('email', 'admin@email.com')->first()->id
        ]);
        return redirect()->route('login');
    }
}
