<?php

namespace App\Http\Controllers;

use App\Models\Hotel;
use App\Models\Pokoje;
use Illuminate\Http\Request;

class PokojeController extends Controller
{
    public function select(Request $request) {
        $rooms = Pokoje::get();
        $hotelInfos = Hotel::get();
        $login = $request->session()->get('login');

        return view('pokoje', [
            'rooms' => $rooms,
            'hotelInfos' => $hotelInfos,
            'login' => $login
        ]);
    }
}
