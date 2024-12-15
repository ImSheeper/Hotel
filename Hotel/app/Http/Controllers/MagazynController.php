<?php

namespace App\Http\Controllers;

use App\Models\Hotel;
use App\Models\Magazyn;
use App\Models\Produkt;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MagazynController extends Controller
{
    public function select(Request $request) {
        $hotelInfos = Hotel::get();
        $magazyn = Magazyn::select('data_waznosci', DB::raw('nazwa_produktu, data_waznosci, SUM(ilosc) as ilosc'))
        ->groupBy('data_waznosci')
        ->groupBy('nazwa_produktu')
        ->get();
    

        $produkt = Produkt::get();

        $loginData = $request->session()->get('login');
        if($loginData == null) {
            return back()->withErrors([
                'error' => 'Proszę się zalogować!'
            ]);
        }

        date_default_timezone_set('UTC');
        $year = date('Y');
        $month = date('m');

        return view('magazyn', [
            'hotelInfos' => $hotelInfos,
            'login' => $loginData,
            'magazyn' => $magazyn,
            'produkt' => $produkt,
            'month' => $month,
            'year' => $year
        ]);
    }

    public function update(Request $request) {
        $produkt = Produkt::where('nazwa', $request->data['nazwa'])->first();
        $magazyn = Magazyn::where('nazwa_produktu', $produkt->id)->first();

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

         $magazyn = Magazyn::select('data_waznosci', DB::raw('nazwa_produktu, data_waznosci, SUM(ilosc) as ilosc'))
         ->groupBy('data_waznosci')
         ->groupBy('nazwa_produktu')
         ->get();
     
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
                $produktId = Produkt::where('nazwa', $nazwaDelete)->first();
                $magazyn = Magazyn::where('nazwa_produktu', $produktId['id'])->delete();
                $produkt = Produkt::where('nazwa', $nazwaDelete)->delete();
                break;
            case 1:
                $produkt = new Produkt();
                $produkt->nazwa = $nazwaAdd;
                $produkt->save();
                break;
        }

        $magazyn = Magazyn::select('data_waznosci', DB::raw('nazwa_produktu, data_waznosci, SUM(ilosc) as ilosc'))
        ->groupBy('data_waznosci')
        ->groupBy('nazwa_produktu')
        ->get();
    
        $produkt = Produkt::get();

        return response()->json([
            'message' => 'Dane przetworzone poprawnie!',
            'data' => $request->all(),
            'magazyn' => $magazyn,
            'produkt' => $produkt
        ]);
    }

    public function add(Request $request) {
        $produkt = Produkt::where('nazwa', $request->data['nazwa'])->first();
        $magazyn = Magazyn::where('nazwa_produktu', $produkt->id)->first();

        $nazwa = $produkt->id;
        $ilosc = (int) $request->data['ilosc'];
        $date = $request->data['date'];

        $magazyn = new Magazyn();
        $magazyn->nazwa_produktu = $nazwa;
        $magazyn->ilosc = $ilosc;
        $magazyn->data_waznosci = $date; 
        $magazyn->save();

        $magazyn = Magazyn::select('data_waznosci', DB::raw('nazwa_produktu, data_waznosci, SUM(ilosc) as ilosc'))
        ->groupBy('data_waznosci')
        ->groupBy('nazwa_produktu')
        ->get();
    
        $produkt = Produkt::get();

        return response()->json([
            'message' => 'Dane przetworzone poprawnie!',
            'data' => $request->all(),
            'magazyn' => $magazyn,
            'produkt' => $produkt
        ]);
    }

    public function delete(Request $request) {
        $produkt = Produkt::where('nazwa', $request->data['nazwa'])->first();
        $magazyn = Magazyn::
        where('nazwa_produktu', $produkt->id)
        ->where('data_waznosci', $request->data['date'])
        ->delete();

        $magazyn = Magazyn::select('data_waznosci', DB::raw('nazwa_produktu, data_waznosci, SUM(ilosc) as ilosc'))
        ->groupBy('data_waznosci')
        ->groupBy('nazwa_produktu')
        ->get();
    
        $produkt = Produkt::get();

        return response()->json([
            'message' => 'Dane przetworzone poprawnie!',
            'data' => $request->all(),
            'magazyn' => $magazyn,
            'produkt' => $produkt,
            'requestdata' => $request->data['date']
        ]);
    }
}
