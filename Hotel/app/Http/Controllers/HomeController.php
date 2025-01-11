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
use DateTime;


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

        if($month[0] === '0') $month = $month[1];

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


        // pobranie nazwy aktualnego miesiąca
        $date = Carbon::createFromFormat('m', $month)->locale('pl');
        $date = $date->translatedFormat('F');

        // pobranie pliku grafiku
        $jsonData = Storage::disk('public')->allFiles();
        $urlData = $month . '.' . $year;
        $isFile = false;

        if($month[0] === '0') {            
            $month = substr($month, 1);
            $urlData = $month . '.' . $year;
        }

        foreach($jsonData as $file) {
            if (preg_match('/\b' . preg_quote($urlData, '/') . '\b/', $file)) {
                $filteredFiles[] = $file;
                $isFile = true;
            }
        }

        if ($isFile) {
            foreach ($filteredFiles as $file) {
                $content = Storage::disk('public')->get($file);
                $json[] = json_decode($content, true);
            }
            
            for($i = 0; $i < count($json) - 1; $i++) {
                foreach ($json[$i]['data'] as $graf) {
                    if ($graf["status"] === "Pracuje") {
                        $data[] = $graf['dzisiejszy dzien'];
                    }
                }
            }
            $uniqueData = array_unique($data);
            sort($uniqueData);
        } else {
            $json = null;
            $uniqueData = null;
        }

        $days = cal_days_in_month(CAL_GREGORIAN, $month, $year);
        $dateNamesPolish = [
            "Poniedziałek",
            "Wtorek",
            "Środa",
            "Czwartek",
            "Piątek",
            "Sobota",
            "Niedziela"
        ];

        //Angielskie nazwy dni
        $dateNamesEnglish = [
            "Monday",
            "Tuesday",
            "Wednesday",
            "Thursday",
            "Friday",
            "Saturday",
            "Sunday"
        ];
        
        //Tworzenie formatu - nie pamiętam już po co
        $j = 0;
        for($i = 1; $i <= $days; $i++) {
            $dateForDiv = new DateTime("$year-$month-$i");
            $dayNames[$i] = $dateForDiv->format('l');
        }

        //tłumaczenie na polski
        foreach($dayNames as $index => $day) {
            if(($key = array_search($day, $dateNamesEnglish)) !== false) {
                //Staurday
                $dayNames[$index] = $dateNamesPolish[$key];
            }
        }
        
        $userStanowisko = app('App\Http\Controllers\GetUserRoles')->select($request);

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
            'month' => $month,
            'year' => $year,
            'grafik' => $json,
            'uniqueData' => $uniqueData,
            'currentMonth' => $date,
            'dayNames' => $dayNames,
            'days' => $days,
            'userStanowisko' => $userStanowisko
        ]);
    }
}
