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
        $pokoje = Pokoje::get();

        date_default_timezone_set('UTC');
        $year = date('Y');
        $month = date('m');

        return view('pokoje', [
            'rooms' => $rooms,
            'hotelInfos' => $hotelInfos,
            'login' => $login,
            'pokoje' => $pokoje,
            'month' => $month,
            'year' => $year
        ]);
    }

    public function store(Request $request) {
        $pokoj = Pokoje::where('id', $request->data['id'])->first();

        if($pokoj) {
            $pokoj->pietro = (int) $request->data['pietro'];
            $pokoj->status = (int) $request->data['status'];
            $pokoj->czyste = (int) $request->data['czysty'];

            $pokoj->save();
        } else {
            $pokoj = new pokoje;

            $pokoj->id = (int) $request->data['id'];
            $pokoj->pietro = (int) $request->data['pietro'];
            $pokoj->status = (int) $request->data['status'];
            $pokoj->czyste = (int) $request->data['czysty'];
            $pokoj->wykluczone = 0;

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

    public function deactivate(Request $request) {
        $pokoj = Pokoje::where('id', $request->data['id'])->first();
        $pokoje = Pokoje::get();

        if($pokoj) {
            $pokoj->wykluczone ? $pokoj->wykluczone = 0 : $pokoj->wykluczone = 1;
            
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
