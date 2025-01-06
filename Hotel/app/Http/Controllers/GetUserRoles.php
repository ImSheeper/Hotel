<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Stanowiska;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class GetUserRoles extends Controller
{
    public function select(Request $request) {
        $login = $request->session()->get('login');
        $user = User::where('login', $login)->first();

        return $user->stanowiska->stanowisko;
    }
}
