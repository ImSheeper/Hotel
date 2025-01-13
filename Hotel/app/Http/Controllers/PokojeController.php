<?php

namespace App\Http\Controllers;

use App\Models\Hotel;
use App\Models\Pokoje;
use Illuminate\Http\Request;
use App\Models\Pokoje_rodzaj;
use App\Http\Controllers\Controller;

class PokojeController extends Controller
{
    public function select(Request $request) {
        $rooms = Pokoje::get();
        $hotelInfos = Hotel::get();
        $login = $request->session()->get('login');
        $pokoje = Pokoje::with('rodzaj')->get();
        $rodzaj_pokoj = Pokoje_rodzaj::get();

        date_default_timezone_set('UTC');
        $year = date('Y');
        $month = date('m');
        
        $userStanowisko = app('App\Http\Controllers\GetUserRoles')->select($request);

        return view('pokoje', [
            'rooms' => $rooms,
            'hotelInfos' => $hotelInfos,
            'login' => $login,
            'pokoje' => $pokoje,
            'month' => $month,
            'year' => $year,
            'userStanowisko' => $userStanowisko,
            'rodzaj_pokoj' => $rodzaj_pokoj
        ]);
    }

    public function store(Request $request) {
        $pokoj = Pokoje::where('id', $request->data['id'])->first();

        if($pokoj) {
            $pokoj->pietro = (int) $request->data['pietro'];
            $pokoj->rodzaj_id = $request->data['rodzaj'];
            $pokoj->status = (int) $request->data['status'];
            $pokoj->czyste = (int) $request->data['czysty'];

            $pokoj->save();
        } else {
            $pokoj = new pokoje;

            $pokoj->id = (int) $request->data['id'];
            $pokoj->pietro = (int) $request->data['pietro'];
            $pokoj->rodzaj_id = $request->data['rodzaj'];
            $pokoj->status = (int) $request->data['status'];
            $pokoj->czyste = (int) $request->data['czysty'];
            $pokoj->wykluczone = 0;

            $pokoj->save();
        }

        $pokoje = Pokoje::get();
        $rodzaj_pokoj = Pokoje_rodzaj::get();

        return response()->json([
            'message' => 'Dane przetworzone poprawnie!',
            'data' => $request->all(),
            'pokoj' => $pokoj,
            'pokoje' => $pokoje,
            'rodzaj_pokoj' => $rodzaj_pokoj
        ]);
    }

    public function deactivate(Request $request) {
        $pokoj = Pokoje::where('id', $request->data['id'])->first();
        $pokoje = Pokoje::get();
        $powod = $request->data['powod'];

        if($pokoj) {
            $pokoj->wykluczone ? $pokoj->wykluczone = 0 : $pokoj->wykluczone = 1;
            $pokoj->powod_wykluczenia = $powod;
            
            $pokoj->save();
        }

        $pokoje = Pokoje::get();

        return response()->json([
            'message' => 'Dane przetworzone poprawnie!',
            'data' => $request->all(),
            'pokoj' => $pokoj,
            'pokoje' => $pokoje
        ]);
    }

    public function delete(Request $request) {
        $pokoj = Pokoje::where('id', $request->data['id'])->first();
        $pokoje = Pokoje::get();

        if($pokoj) {            
            $pokoj->delete();
        }

        $pokoje = Pokoje::get();

        return response()->json([
            'message' => 'Dane przetworzone poprawnie!',
            'data' => $request->all(),
            'pokoj' => $pokoj,
            'pokoje' => $pokoje
        ]);
    }
}
