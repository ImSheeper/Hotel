<?php

namespace App\Http\Controllers;

use DateTime;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Hotel;
use App\Models\Stanowiska;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GrafikWholeController extends Controller
{
    public function select(Request $request) {
        $hotelInfos = Hotel::get();

        $login = $request->session()->get('login');

        $personelData = User::get();

        if($login == null) {
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
        //$jsonData = Storage::disk('public')->get('grafik/'.$login.'/'.'-'.$login.'-'.$month.'.'.$year.'.json'); // Zakładamy, że plik jest w storage/app/public
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
        
        $data = [];
        $status = [];
        $stanowisko = 'Pokojówka';

        if ($isFile) {
            foreach ($filteredFiles as $file) {
                $content = Storage::disk('public')->get($file);
                $json[] = json_decode($content, true);
            }
            for($i = 0; $i < count($json); $i++) {
                foreach ($json[$i]['data'] as $graf) {
                    if ( ($graf["status"] === "1. zmiana" || $graf["status"] === "2. zmiana") && $graf['stanowisko'] === $stanowisko) {
                        $data[] = $graf['dzisiejszy dzien'];
                        $status[] = [
                            'status' => $graf['status'],
                            'dzien' => $graf['dzisiejszy dzien'],
                            'login' => $graf['login'],
                            'stanowisko' => $graf['stanowisko']
                        ];
                    }
                }
            }
            $uniqueData = array_unique($data);
            sort($uniqueData);
        } else {
            $json = null;
            $uniqueData = null;
        }

        $userStanowisko = app('App\Http\Controllers\GetUserRoles')->select($request);

        $stanowiska = Stanowiska::get();

        return view('grafikWhole', [
            'hotelInfos' => $hotelInfos,
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
            'uniqueData' => $uniqueData,
            'userStanowisko' => $userStanowisko,
            'status' => $status,
            'stanowiska' => $stanowiska
        ]);
    }

    public function selectGrafik(Request $request) {
        $stanowisko = $request->data['stanowisko'];

        $hotelInfos = Hotel::get();

        $login = $request->session()->get('login');

        $personelData = User::get();

        if($login == null) {
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
        //$jsonData = Storage::disk('public')->get('grafik/'.$login.'/'.'-'.$login.'-'.$month.'.'.$year.'.json'); // Zakładamy, że plik jest w storage/app/public
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
        
        $data = [];
        $status = [];

        if ($isFile) {
            foreach ($filteredFiles as $file) {
                $content = Storage::disk('public')->get($file);
                $json[] = json_decode($content, true);
            }
            for($i = 0; $i < count($json); $i++) {
                foreach ($json[$i]['data'] as $graf) {
                    if ( ($graf["status"] === "1. zmiana" || $graf["status"] === "2. zmiana") && $graf['stanowisko'] === $stanowisko) {
                        $data[] = $graf['dzisiejszy dzien'];
                        $status[] = [
                            'status' => $graf['status'],
                            'dzien' => $graf['dzisiejszy dzien'],
                            'login' => $graf['login'],
                            'stanowisko' => $graf['stanowisko']
                        ];
                    }
                }
            }
            $uniqueData = array_unique($data);
            sort($uniqueData);
        } else {
            $json = null;
            $uniqueData = null;
        }

        $userStanowisko = app('App\Http\Controllers\GetUserRoles')->select($request);

        $stanowiska = Stanowiska::get();
        $grafik = $json;
    
        $html = view('Templates.grafikTemplate', compact(
            'grafik',
            'dayNames',
            'personelData',
            'days',
            'month',
            'year',
            'login',
            'date',
            'datePrevious',
            'dateNext',
            'uniqueData',
            'userStanowisko',
            'status',
            'stanowiska'
            ))->render();
    
        return response()->json([
            'html' => $html
        ]);
    }
}
