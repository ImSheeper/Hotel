<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Hotel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;

class HomeController extends Controller
{
    public function select(Request $request) {
        $hotelInfos = Hotel::get();

        $loginData = $request->session()->get('login');

        $personelData = User::get();

        if($loginData == null) {
            return back()->withErrors([
                'error' => 'Proszę się zalogować!'
            ]);
        }

        // $jsonData = File::get(base_path('resources/jsons/grafik-09-2024.json'));
        // $json = json_decode(json: $jsonData, associative: true);

        return view('home', [
            'hotelInfos' => $hotelInfos,
            'login' => $loginData,
            'personels' => $personelData,
            // 'grafik' => $json
        ]);
    }
}
