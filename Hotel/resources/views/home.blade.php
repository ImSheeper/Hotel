<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Strona główna</title>
  @vite('resources/css/app.css')
  @vite('resources/js/home.js')
  
    <style>
        body, html {
            color: rgb(31 41 55);
        }

        .background {
            background-image: url('/images/Background.png');
            background-size: cover;
            background-color: black;
        }
    </style>
</head>
<body>
    <div class="background flex h-screen overflow-hidden">

        {{-- include left menu from templates --}}
        @include('Templates.sidebarTemplate')

        {{-- Right flex --}}
        <div class="flex flex-col h-full w-full ml-0 overflow-hidden">
            {{-- Top menu --}}
            @include('Templates.topMenuTemplate')

            {{-- Main screen --}}
            <div class="flex flex-col bg-white grow mx-1 my-1 mr-2 mb-2 min-w-fit rounded-md overflow-auto">
                
                {{-- Top --}}
                <div class="flex flex-col grow h-full w-full">
                    <div class="flex w-full h-1/2 flex-wrap p-5 gap-5">
                        {{-- Left --}}
                        <div class="flex flex-col w-1/6 h-full  basis-[200px] grow">
                            <div class="flex flex-col bg-[#FFCACA] shadow-lg h-1/3 min-h-[100px] mb-5 rounded-md justify-center items-center">
                                <div class="text-5xl font-bold">{{ $roomsDirty }}</div>
                                <div class="text-md mt-2">Brudne pokoje</div>
                            </div>
                            <div class="flex flex-col bg-[#FFDCB5] shadow-lg h-1/3 min-h-[100px] mb-5 rounded-md justify-center items-center">
                                <div class="text-5xl font-bold">{{ $magazynMissing }}</div>
                                <div class="text-md mt-2">Deficyt produktów</div>
                            </div>
                            <div class="flex flex-col bg-[#C0D4FF] shadow-lg h-1/3 min-h-[100px] rounded-md justify-center items-center">
                                <div class="text-5xl font-bold">{{ $roomsTaken }}</div>
                                <div class="text-md mt-2">Zajęte pokoje</div>
                            </div>
                        </div>
                        
                        <div class="flex flex-col w-2/6 h-full  basis-[400px] grow">
                            <div class="bg-[#F4F2FF] rounded-md shadow-lg overflow-auto p-5 h-full">
                                <div class="flex items-center mb-5">
                                    <img src={{ url('/icons/Personel.svg') }} class="z-10 transition duration-500 opacity-100 group-hover:opacity-0 h-6">
                                    <div class="font-bold text-2xl px-2">Pracowników dzisiaj ({{ $statusesCount }})</div>
                                </div>
                                
                                <hr class="border-t border-gray-600 mb-5">
                                <div class="grid grid-cols-2 font-bold px-2 py-1 text-sm">
                                    <div class="name">Imię i nazwisko</div>
                                    <div class="name">Stanowisko</div>
                                </div>
                                @foreach ($personels as $personel)
                                    @if ($statuses[$personel->imie] === 'Pracuje')
                                        <div class="tableClass grid grid-cols-2 transition-all duration-300 px-2 py-1 rounded-md text-sm">
                                            <div class="className hidden"> {{ $personel->login }} </div>
                                            <div class="class"> {{ $personel->imie }}  {{ $personel->nazwisko }} </div>
                                            <div class="class"> {{ $personel->stanowiska->stanowisko }} </div>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                        </div>

                        {{-- Right --}}
                        <div class="flex flex-col w-1/6 h-full  basis-[200px] grow">
                            <div class="flex flex-col bg-[#F4F2FF] shadow-lg rounded-md grow p-5 overflow-auto">
                                <div class="flex items-center mb-5">
                                    <img src={{ url('/icons/Account.svg') }} class="z-10 transition duration-500 opacity-100 group-hover:opacity-0 h-6">
                                    <div class="font-bold text-2xl px-2">Moje konto</div>
                                </div>
                                <hr class="border-t border-gray-600 mb-5 h-1">

                                <img src={{ url('/icons/Account.svg') }} class="z-10 transition duration-500 opacity-100 group-hover:opacity-0 h-20 mb-5">
                                <div class="span text-sm"><b>Imię:</b> {{ $currentUser->imie }}</div>
                                <div class="span text-sm"><b>Nazwisko:</b> {{ $currentUser->nazwisko }}</div>
                                <div class="span text-sm"><b>Login:</b> {{ $login }}</div>
                                <div class="span text-sm"><b>Numer telefonu:</b> {{ $currentUser->nrTel }}</div>
                                <div class="span text-sm"><b>E-mail:</b> {{ $currentUser->email }}</div>
                                <div class="span text-sm"><b>Stanowisko:</b> {{ $currentUser->stanowiska->stanowisko }}</div>                      
                            </div>
                        </div>

                        <div class="flex flex-col w-2/6 h-full  basis-[300px] grow">
                            <div class="bg-[#F4F2FF] rounded-md shadow-lg overflow-auto p-5 h-full">
                                <div class="flex items-center mb-5">
                                    <img src={{ url('/icons/Magazyn.svg') }} class="z-10 transition duration-500 opacity-100 group-hover:opacity-0 h-5">
                                    <div class="font-bold text-2xl px-2">Magazyn</div>
                                </div>
                                
                                <hr class="border-t border-gray-600 mb-5">
                                <div class="grid grid-cols-3 font-bold px-2 py-1 gap-x-px">
                                    <div class="name">Nazwa</div>
                                    <div class="name">Ilość</div>
                                    <div class="name">Data ważności</div>
                                </div>
                                <div class="magazynContainer">
                                    @foreach ($magazyn as $item)
                                    <div class="tableClass grid grid-cols-3 transition-all duration-300 px-2 py-1 rounded-md text-sm gap-x-px">
                                        <div class="magazyn">{{ $item->produkt->nazwa }} </div>
                                        <div class="magazyn">{{ $item->ilosc }} </div>
                                        <div class="magazyn">{{ $item->data_waznosci }} </div>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                
                {{-- Sub --}}
                        {{-- Left --}}       
                        <div class="flex flex-col h-full  w-1/2 basis-[600px] grow">
                            <div class="bg-[#F4F2FF] rounded-md shadow-lg overflow-auto p-5 h-full">
                                <div class="flex items-center mb-5">
                                    <img src={{ url('/icons/Pokoje.svg') }} class="z-10 transition duration-500 opacity-100 group-hover:opacity-0 h-6">
                                    <div class="font-bold text-2xl px-2">Pokoje</div>
                                </div>
                                
                                <hr class="border-t border-gray-600 mb-5">
                                <div class="grid grid-cols-5 font-bold px-2 py-1 text-sm">
                                    <div class="name">Pokój</div>
                                    <div class="name">Piętro</div>
                                    <div class="name">Status</div>
                                    <div class="name">Czysty</div>
                                    <div class="name">Wykluczony</div>
                                </div>
                                <div class="roomsContainer">
                                    @foreach ($rooms as $room)
                                        @if($room->wykluczone === 0)
                                            <a class="tableClass grid grid-cols-5 transition-all duration-300 px-2 py-1 rounded-md text-sm">
                                            <div class="pokoje"> {{ $room->id }} </div>
                                            <div class="pokoje"> {{ $room->pietro }} </div>
                                            <div class="pokoje"> {{ $room->status ? 'Zajęte' : 'Wolne' }} </div>
                                            <div class="pokoje"> {{ $room->czyste ? 'Czysty' : 'Brudny' }} </div>
                                            <div class="pokoje"> {{ $room->wykluczone ? 'Wykluczony' : 'Aktywny' }} </div>
                                            </a>
                                        @endif
                                    @endforeach
                                </div>
                            </div>
                        </div>

                        {{-- Right --}}
                        <div class="flex flex-col w-1/2 h-full  basis-[600px] grow">
                            <div class="bg-[#F4F2FF] rounded-md shadow-lg overflow-auto p-5 h-full">
                                <div class="flex items-center mb-5">
                                    <img src={{ url('/icons/calendar.svg') }} class="z-10 transition duration-500 opacity-100 group-hover:opacity-0 h-5">
                                    <div class="font-bold text-2xl px-2">Grafik na {{ $currentMonth }} {{ $year }}</div>
                                </div>
                                
                                <hr class="border-t border-gray-600 mb-5">

                                <div class="grid grid-cols-7 z-10">
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
                                        <div class="document-animation font-bold mx-2 my-2 text-center text-sm select-none">{{ $dzien }}</div>
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
                                        <div class="json flex flex-col bg-gray-300 h-20 shadow-md w-20 rounded-3xl mx-2 my-2 pointer-events-none">
                                            <div class="document-animation font-bold"></div>
                                        </div>                           
                                        @endfor
            
                                    @endif
            
                                    @isset($grafik)
                                        @foreach ($grafik[0]['data'] as $graf)
                                                @if (in_array($graf['dzisiejszy dzien'], $uniqueData))
                                                <div class="json overflow-hidden select-none flex flex-col bg-red-400 h-20 shadow-md w-20 rounded-full mx-2 my-2 justify-center items-center">
                                                    <div class="document font-bold hidden">{{ $graf["rok"] }}</div>
                                                        <div class="document font-bold hidden">{{ $graf["numer dni"] }}</div>
                                                        <div class="document font-bold hidden">{{ $graf["miesiąc"] }}</div>
                                                        <div class="document text-xl">{{ $graf["dzisiejszy dzien"] }}</div>
                                                        <div class="document font-bold hidden">{{ $graf["nazwa dnia"] }}</div>
                                                        <div class="flex overflow-hidden">
                                                            <div class="document text-sm">{{ $graf["status"] }}</div>
                                                        </div>                                            </div>
                                                @else
                                                <div class="json overflow-hidden select-none flex flex-col bg-green-400 h-20 shadow-md w-20 rounded-full mx-2 my-2 justify-center items-center">
                                                    <div class="document font-bold hidden">{{ $graf["rok"] }}</div>
                                                        <div class="document font-bold hidden">{{ $graf["numer dni"] }}</div>
                                                        <div class="document font-bold hidden">{{ $graf["miesiąc"] }}</div>
                                                        <div class="document text-xl">{{ $graf["dzisiejszy dzien"] }}</div>
                                                        <div class="document font-bold hidden">{{ $graf["nazwa dnia"] }}</div>
                                                        <div class="flex overflow-hidden">
                                                            <div class="document text-sm">{{ $graf["status"] }}</div>
                                                        </div>
                                                    </div>
                                                @endif
                                        @endforeach
                                
                                        @else
                                        @for ($i = 1; $i <= $days; $i++)
                                            <div class="json overflow-hidden select-none flex flex-col bg-gray-200 h-2 shadow-md w-200 rounded-full mx-2 my-2 justify-center items-center">
                                                <div class="document font-bold hidden">{{ $year }}</div>
                                                <div class="document font-bold hidden">{{ $days }}</div>
                                                <div class="document font-bold hidden">{{ $month }}</div>
            
                                                <div class="document text-xl">{{ $i }}</div>
                                                <div class="document font-bold hidden">{{ $dayNames[$i] }}</div>
                                                <div class="flex overflow-hidden">
                                                    <div class="document visible text-sm">Status</div>
                                                </div>
                                            </div>
                                        @endfor
                                    @endisset
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

            </div>

        </div>
    </div>
</body>
</html>
