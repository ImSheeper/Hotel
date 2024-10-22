<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Hotel;
use App\Models\Stanowiska;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PersonelController extends Controller
{
    public function select(Request $request) {
        $hotelInfos = Hotel::get();
        $personel = User::get();
        $stanowiska = Stanowiska::get();
        
        $login = $request->session()->get('login');

        date_default_timezone_set('UTC');
        $date = date('m.y');
        $year = date('Y');
        $month = date('m');

        $timeOfWork = [];
        $zmiana = 12; //tutaj pobieraj dane z pliku konfiguracyjnego
        $statuses = [];

        $day = Carbon::now('Europe/Warsaw')->day;

        for($j = 0; $j < count($personel); $j++) {
            $jsonData = Storage::disk('public')->get('grafik/'.$personel[$j]->login.'/'.'-'.$personel[$j]->login.'-'.$month.'.'.$year.'.json'); // Zakładamy, że plik jest w storage/app/public
            $json = json_decode(json: $jsonData, associative: true);
            $statuses[$j] = $json["data"][$day - 1]["status"];

            $timeOfWork[$j] = 0;
            for($i = 0; $i < count($json["data"]); $i++) {
                if($json["data"][$i]["status"] === "Pracuje") $timeOfWork[$j] += $zmiana;
            }
        }
        
        return view('personel', [
            'hotelInfos' => $hotelInfos,
            'login' => $login,
            'personels' => $personel,
            'timeOfWork' => $timeOfWork,
            'month' => $month,
            'year' => $year,
            'statuses' => $statuses,
            'stanowiska' => $stanowiska
        ]);
    }

    public function update(Request $request) {
        $user = User::where('login', $request->data['login'])->firstOrFail();
        $stanowisko = Stanowiska::where('stanowisko', $request->data['stanowisko'])->firstOrFail();

        $user->imie = $request->data['imie'];
        $user->nazwisko = $request->data['nazwisko'];
        $user->email = $request->data['email'];
        $user->nrTel = $request->data['nrTel'];
        $user->stanowisko = $stanowisko->id;
        $user->login = $request->data['login'];
        if($request->data['password'] != null) $user->password = bcrypt($request->data['password']);

        $user->save();

        return response()->json([
            'message' => 'Dane przetworzone poprawnie!',
            'data' => $request->all(),
            'user' => $user
        ]);
    }
}
