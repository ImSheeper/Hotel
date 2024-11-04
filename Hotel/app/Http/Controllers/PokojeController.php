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

    public function store(Request $request) {
        $pokoj = Pokoje::where('id', $request->data['id'])->first();

        if($pokoj) {
            $pokoj->id = (int) $request->data['id'];
            $pokoj->pietro = (int) $request->data['pietro'];
            $pokoj->status = (int) $request->data['status'];
            $pokoj->czyste = (int) $request->data['czysty'];

            $pokoj->save();
        } else {
            return;
        }

        return response()->json([
            'message' => 'Dane przetworzone poprawnie!',
            'data' => $request->all(),
            'pokoj' => $pokoj
        ]);
    }

    public function deactivate(Request $request) {
        $pokoj = Pokoje::where('id', $request->data['id'])->first();

        if($pokoj) {
            $pokoj->wykluczone ? $pokoj->wykluczone = 0 : $pokoj->wykluczone = 1;
            
            $pokoj->save();
        }

        return response()->json([
            'message' => 'Dane przetworzone poprawnie!',
            'data' => $request->all(),
            'pokoj' => $pokoj
        ]);
    }
}
