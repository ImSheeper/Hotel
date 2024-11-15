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

    public function update(Request $request) {
        $produkt = Produkt::where('nazwa', $request->data['nazwa'])->first();
        $magazyn = Magazyn::where('id', $produkt->id)->first();

        if($magazyn) {
            $magazyn->ilosc = (int) $request->data['ilosc'];

            $magazyn->save();
         }

        $magazyn = Magazyn::get();
        $produkt = Produkt::get();

        return response()->json([
            'message' => 'Dane przetworzone poprawnie!',
            'data' => $request->all(),
            'magazyn' => $magazyn,
            'produkt' => $produkt
        ]);
    }
}
