<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Hotel;
use App\Models\Pokoje;
use App\Models\Magazyn;
use App\Models\Stanowiska;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class HomeController extends Controller
{
    public function select(Request $request) {
        $hotelInfos = Hotel::get();

        $loginData = $request->session()->get('login');

        $personel = User::get();

        if($loginData == null) {
            return back()->withErrors([
                'error' => 'Proszę się zalogować!'
            ]);
        }

        // Tabela personel
        date_default_timezone_set('UTC');
        $year = date('Y');
        $month = date('m');

        $timeOfWork = [];
        $zmiana = 12; //tutaj pobieraj dane z pliku konfiguracyjnego
        $statuses = [];

        $day = Carbon::now('Europe/Warsaw')->day;

        for($j = 0; $j < count($personel); $j++) {
            $jsonData = Storage::disk('public')->get('grafik/'.$personel[$j]->login.'/'.'-'.$personel[$j]->login.'-'.$month.'.'.$year.'.json'); // Zakładamy, że plik jest w storage/app/public
            $json = json_decode(json: $jsonData, associative: true);
            
            if($jsonData != null) {
                $statuses[$personel[$j]->imie] = $json["data"][$day - 1]["status"];

                $timeOfWork[$personel[$j]->imie] = 0;
                for($i = 0; $i < count($json["data"]); $i++) {
                    if($json["data"][$i]["status"] === "Pracuje") $timeOfWork[$personel[$j]->imie] += $zmiana;  //$timeOfWork[$j] += $zmiana;
                }
            } else {
                $statuses[$personel[$j]->imie] = 'Brak grafiku';
                $timeOfWork[$personel[$j]->imie] = 0;
            }
        }
        // Tabela personel

        // Liczenie na kafelkach
        $statusesCount = 0;
        foreach($statuses as $status) {
            if($status === 'Pracuje') $statusesCount++;
        }

        // Liczenie na pokojach
        $roomsTaken = Pokoje::
        where('status', 1)
        ->where('wykluczone', 0)
        ->count();

        $roomsDirty = Pokoje::
        where('czyste', 0)
        ->where('wykluczone', 0)
        ->count();

        // Pobranie pokoi
        $pokoje = Pokoje::get();

        // Liczenie na magazynie
        $magazynMissing = Magazyn::
        where('ilosc', '<', '5')
        ->count();

        // Kafelek konta
        $currentUser = User::
        where('login', $loginData)
        ->first();

        $stanowiska = Stanowiska::get();

        // MagazynSelect
        $magazyn = Magazyn::select('data_waznosci', DB::raw('nazwa_produktu, data_waznosci, SUM(ilosc) as ilosc'))
        ->groupBy('data_waznosci')
        ->groupBy('nazwa_produktu')
        ->get();

        // Najdłuższa sekcja do grafiku
        $grafikController = new GrafikWholeController();
        $response = $grafikController->select($request);
        $grafikViewData = $response->getData();

        return view('home', [
            'hotelInfos' => $hotelInfos,
            'login' => $loginData,
            'personels' => $personel,
            'statuses' => $statuses,
            'timeOfWork' => $timeOfWork,
            'statusesCount' => $statusesCount,
            'roomsTaken' => $roomsTaken,
            'roomsDirty' => $roomsDirty,
            'magazynMissing' => $magazynMissing,
            'currentUser' => $currentUser,
            'stanowiska' => $stanowiska,
            'magazyn' => $magazyn,
            'rooms' => $pokoje,
            'month' => $grafikViewData['month'],
            'year' => $grafikViewData['year'],
            'grafik' => $grafikViewData['grafik'],
            'uniqueData' => $grafikViewData['uniqueData'],
            'currentMonth' => $grafikViewData['date']
        ]);
    }
}
