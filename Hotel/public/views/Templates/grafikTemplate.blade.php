@isset($grafik)
    @php 
        $file = $grafik[0]['data'][0]['nazwa dnia'];
    @endphp
@else
    @php
        $file = $dayNames[1];
    @endphp
@endisset

@php
    $dni = array(
        1 => "Poniedziałek",
        2 => "Wtorek",
        3 => "Środa",
        4 => "Czwartek",
        5 => "Piątek",
        6 => "Sobota",
        7 => "Niedziela",
    );
@endphp

@foreach ($dni as $dzien)
    <div class="document-animation font-bold mx-2 my-2 text-center text-xl select-none">{{ $dzien }}</div>
@endforeach

@if($file != "Poniedziałek")
    @php
        foreach($dni as $klucz => $dzien) {
            if($file == $dzien) $currentDay = $klucz;
        }
        
        $fieldsToAdd = 0;
        for($currentDay; $currentDay > 1; $currentDay--) {
            $fieldsToAdd++;
        }
    @endphp

    @for ($i = 1; $i <= $fieldsToAdd; $i++)
    <div class="json flex flex-col bg-gray-300 h-28 shadow-md w-28 rounded-full mx-2 my-2 pointer-events-none">
        <div class="document-animation font-bold"></div>
    </div>                           
    @endfor

@endif

{{-- Poniższy kod musi generować się po onchange --}}
{{-- AJAX musi wysłać zapytanie do PHP, które musi zwrócić grafik dla konkretnej jednostki --}}
@isset($grafik)
@foreach ($grafik[0]['data'] as $graf)

@if (($userStanowisko === 'Właściciel Hotelu' && in_array($graf['dzisiejszy dzien'], $uniqueData)) || ($userStanowisko !== 'Właściciel Hotelu' && $graf["status"] === "1. zmiana" || ($userStanowisko !== 'Właściciel Hotelu' && $graf["status"] === "2. zmiana")))
    @if (($userStanowisko === 'Właściciel Hotelu'))     
        <div class="json overflow-hidden select-none flex flex-col bg-green-400 h-28 shadow-md w-28 rounded-full mx-2 my-2 justify-center items-center">
    @else
        <div class="json overflow-hidden select-none flex flex-col bg-red-400 h-28 shadow-md w-28 rounded-full mx-2 my-2 justify-center items-center">
    @endif
        <div class="document font-bold hidden">{{ $graf["rok"] }}</div>
        <div class="document font-bold hidden">{{ $graf["numer dni"] }}</div>
        <div class="document font-bold hidden">{{ $graf["miesiąc"] }}</div>
        <div class="document text-3xl">{{ $graf["dzisiejszy dzien"] }}</div>
        <div class="document font-bold hidden">{{ $graf["nazwa dnia"] }}</div>
        <div class="flex flex-col overflow-hidden">
            @if (($userStanowisko === 'Właściciel Hotelu'))  
                @foreach ($status as $stat)
                    @if ($graf['dzisiejszy dzien'] == $stat['dzien'])
                        <div class="document" title="{{ $stat["login"] }} : {{ $stat["status"] }}">{{ $stat["status"] }}</div>
                    @endif
                @endforeach
            @else
                {{ $graf["status"] }}
            @endif
        </div>                                               
    </div>
        @else
            @if (($userStanowisko === 'Właściciel Hotelu'))     
                <div class="json overflow-hidden select-none flex flex-col bg-red-400 h-28 shadow-md w-28 rounded-full mx-2 my-2 justify-center items-center">
            @else
                <div class="json overflow-hidden select-none flex flex-col bg-green-400 h-28 shadow-md w-28 rounded-full mx-2 my-2 justify-center items-center">
            @endif                                                        
                    <div class="document font-bold hidden">{{ $graf["rok"] }}</div>
                    <div class="document font-bold hidden">{{ $graf["numer dni"] }}</div>
                    <div class="document font-bold hidden">{{ $graf["miesiąc"] }}</div>
                    <div class="document text-3xl">{{ $graf["dzisiejszy dzien"] }}</div>
                    <div class="document font-bold hidden">{{ $graf["nazwa dnia"] }}</div>
                <div class="flex overflow-hidden">
                    <div class="document">
                        @if ($userStanowisko === 'Właściciel Hotelu')
                            Brak
                        @else
                            {{ $graf["status"] }}
                        @endif
                    </div>
                </div>
            </div>
        @endif
@endforeach

    @else
    @for ($i = 1; $i <= $days; $i++)
        <div class="json overflow-hidden select-none flex flex-col bg-gray-200 h-28 shadow-md w-28 rounded-full mx-2 my-2 justify-center items-center">
            <div class="document font-bold hidden">{{ $year }}</div>
            <div class="document font-bold hidden">{{ $days }}</div>
            <div class="document font-bold hidden">{{ $month }}</div>

            <div class="document text-3xl">{{ $i }}</div>
            <div class="document font-bold hidden">{{ $dayNames[$i] }}</div>
            <div class="flex overflow-hidden">
                <div class="document visible">Status</div>
            </div>
        </div>
    @endfor
@endisset