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
        $produkt = Produkt::get();

        $loginData = $request->session()->get('login');
        if($loginData == null) {
            return back()->withErrors([
                'error' => 'Proszę się zalogować!'
            ]);
        }

        return view('magazyn', [
            'hotelInfos' => $hotelInfos,
            'login' => $loginData,
            'magazyn' => $magazyn,
            'produkt' => $produkt
        ]);
    }

    public function update(Request $request) {
        $produkt = Produkt::where('nazwa', $request->data['nazwa'])->first();
        $magazyn = Magazyn::where('id', $produkt->id)->first();

        $action = (int) $request->data['akcja'];
        $ilosc = (int) $request->data['ilosc'];

        if($magazyn) {
            switch($action) {
                case 0:
                    $magazyn->ilosc -= $ilosc;
                    break;
                case 1:
                    $magazyn->ilosc += $ilosc;
                    break;
                case 2:
                    $magazyn->ilosc = $ilosc;
                    break;
            }
            $magazyn->save();
         } else {
            // Tutaj dodawanie nowego elementu do bazy?
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

    public function updateProdukt(Request $request) {
        $produkt = Produkt::get();

        $action = (int) $request->data['akcja'];
        $nazwaAdd = $request->data['nazwaAdd'];
        $nazwaDelete = $request->data['nazwaDelete'];

        switch($action) {
            case 0:
                $produkt = Produkt::where('nazwa', $nazwaDelete)->delete();
                break;
            case 1:
                $produkt = new Produkt();
                $produkt->nazwa = $nazwaAdd;
                $produkt->save();
                break;
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
