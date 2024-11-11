<?php

namespace App\Http\Controllers;

use App\Models\Hotel;
use App\Models\Magazyn;
use App\Models\Produkt;
use Illuminate\Http\Request;

class MagazynController extends Controller
{
    public function select(Request $request) {
        $hotelInfos = Hotel::get();
        $magazyn = Magazyn::get();

        $loginData = $request->session()->get('login');
        if($loginData == null) {
            return back()->withErrors([
                'error' => 'Proszę się zalogować!'
            ]);
        }

        return view('magazyn', [
            'hotelInfos' => $hotelInfos,
            'login' => $loginData,
            'magazyn' => $magazyn
        ]);
    }
}
