<?php

namespace App\Http\Controllers;

use DateTime;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Hotel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class GrafikController extends Controller
{
    public function select(Request $request, string $login) {
        $hotelInfos = Hotel::get();
        $userFullName = User::where('login', $login)->first();
        
        $loginData = $request->session()->get('login');

        $personelData = User::get();

        if($loginData == null) {
            return back()->withErrors([
                'error' => 'Proszę się zalogować!'
            ]);
        }

        //Select w ramach otwarcia poprawnego pliku na podstawie loginu
        //Testowa wersja wybiera tylko mnie jako usera, a nie wybranego przez menedżera
        //$login = User::where('login', 'Patryk')->first('login');
        date_default_timezone_set('UTC');
        \Carbon\Carbon::setLocale('pl');
        
        $url = url()->current();
        $string = explode('/', $url); 
        $month = $string[count($string) - 2];
        $year = $string[count($string) - 1];
        $days = cal_days_in_month(CAL_GREGORIAN, $month, $year);
        
        $date = Carbon::createFromFormat('m', $month);
        $date = $date->translatedFormat('F');

        $datePrevious = Carbon::createFromFormat('m', $month - 1);
        $datePrevious = $datePrevious->translatedFormat('F');
        $dateNext = Carbon::createFromFormat('m', $month + 1);
        $dateNext = $dateNext->translatedFormat('F');

        //Antyk, jeszcze zanim znałem Carbon. Już tego nie poprawiam
        //Polskie nazwy dni
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

        //pobieranie grafiku z JSONa
        $jsonData = Storage::disk('public')->get('grafik/'.$login.'/'.'-'.$login.'-'.$month.'.'.$year.'.json'); // Zakładamy, że plik jest w storage/app/public
        $json = json_decode(json: $jsonData, associative: true);

        $userStanowisko = app('App\Http\Controllers\GetUserRoles')->select($request);
        $grafStanowisko = app('App\Http\Controllers\GetUserRoles')->selectUserLogin($login);
        $login = $userFullName['imie'] . ' ' . $userFullName['nazwisko'];
        
        return view('grafik', [
            'hotelInfos' => $hotelInfos,
            'loginData' => $loginData,
            'personels' => $personelData,
            'grafik' => $json,
            'days' => $days,
            'month' => $month,
            'year' => $year,
            'dayNames' => $dayNames,
            'login' => $login,
            'date' => $date,
            'datePrevious' => $datePrevious,
            'dateNext' => $dateNext,
            'userStanowisko' => $userStanowisko,
            'grafStanowisko' => $grafStanowisko
        ]);
    }

    public function store(Request $request, string $login, string $month, string $year) {
        $data = $request->all();

        //Testowa wersja wybiera tylko mnie jako usera, a nie wybranego przez menedżera
        //$login = User::where('login', 'Patryk')->first('login');
        date_default_timezone_set('UTC');
        $date = date('m.y');
        //Tworzenie pliku grafik dla konkretnej osoby wybranej z bazy danych
        Storage::disk('public')->put('grafik/'.$login.'/'.'-'.$login.'-'.$month.'.'.$year.'.json', json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));

        return response()->json([
            'message' => 'Dane przetworzone poprawnie!',
            'data' => $request->all(),
            'date' => $date,
            'login' => $login
        ]);
    }
}
