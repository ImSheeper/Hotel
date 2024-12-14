<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function selectuser() {
        $returnValue = User::orderBy('id', 'asc')->get();

        return view('login', [
            'values' => $returnValue
        ]);
    }

    public function store(Request $request) {
        $credentials = $request->validate([
            'login' => ['required'],
            'password' => ['required']
        ]);

        $isBlocked = User::where('login', $credentials['login'])->first();

        if($isBlocked->zablokowany === 1) {
            return back()->withErrors([
                'error' => 'Użytkownik jest zablokowany.'
            ]);
        }

        if(Auth::attempt($credentials)) {
            $request->session()->regenerate();
            $request->session()->put('login', $credentials['login']);
            
            date_default_timezone_set('UTC');
            $year = date('Y');
            $month = date('m');

            return redirect(route('homeRoute', ['month' => $month, 'year' => $year]));
        }

        return back()->withErrors([
            'error' => 'Wprowadzone dane są niepoprawne.'
        ]);
    }
}

//first() - zwraca pierwszy wynik, inaczej nie uzyskamy dostępu do danych wewnątrz kolekcji
//get()
//update()
//destroy()