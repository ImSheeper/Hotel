<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="csrf-token" content="{{ csrf_token() }}">

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
            <div class="flex flex-col bg-white grow lg:ml-1 ml-2 my-1 mr-2 mb-2 min-w-fit rounded-md overflow-auto">
                
                {{-- Top --}}
                <div class="flex flex-col grow h-full w-full">
                    <div class="flex w-full h-1/2 flex-wrap p-5 gap-5">
                        {{-- Left --}}
                        @if ($userStanowisko === 'Właściciel Hotelu' || $userStanowisko === 'Menedżer Hotelu')
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
                        @endif
                        
                        <div class="flex flex-col w-2/6 h-full basis-[400px] grow">
                            <div class="bg-[#F4F2FF] rounded-md shadow-lg overflow-auto p-5 h-full">
                                <div class="flex items-center mb-5">
                                    <img src={{ url('/icons/Personel.svg') }} class="transition duration-500 opacity-100 group-hover:opacity-0 h-6">
                                    <div class="font-bold text-2xl px-2">Pracowników dzisiaj ({{ $statusesCount }})</div>
                                </div>
                                
                                <hr class="border-t border-gray-600 mb-5">
                                <div class="grid grid-cols-3 font-bold px-2 py-1 text-sm">
                                    <div class="name">Imię i nazwisko</div>
                                    <div class="name">Stanowisko</div>
                                    <div class="name">Zmiana</div>
                                </div>
                                @foreach ($personels as $personel)
                                    @if ($statuses[$personel->imie] === '1. zmiana' || $statuses[$personel->imie] === '2. zmiana')
                                        <div class="tableClass grid grid-cols-3 transition-all duration-300 px-2 py-1 rounded-md text-sm">
                                            <div class="className hidden"> {{ $personel->login }} </div>
                                            <div class="class"> {{ $personel->imie }}  {{ $personel->nazwisko }} </div>
                                            <div class="class"> {{ $personel->stanowiska->stanowisko }} </div>
                                            <div class="class"> {{ $statuses[$personel->imie] }} </div>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                        </div>

                        {{-- Right --}}
                        <div class="flex flex-col w-1/6 h-full basis-[200px] grow">
                            <div class="flex flex-col bg-[#F4F2FF] shadow-lg rounded-md grow p-5 overflow-auto">
                                <div class="flex items-center mb-5">
                                    <img src={{ url('/icons/Account.svg') }} class="transition duration-500 opacity-100 group-hover:opacity-0 h-6">
                                    <div class="font-bold text-2xl px-2">Moje konto</div>
                                </div>
                                <hr class="border-t border-gray-600 mb-5 h-1">

                                <img src={{ url('/icons/Account.svg') }} class="transition duration-500 opacity-100 group-hover:opacity-0 h-20 mb-5">
                                <div class="span text-sm"><b>Imię:</b> {{ $currentUser->imie }}</div>
                                <div class="span text-sm"><b>Nazwisko:</b> {{ $currentUser->nazwisko }}</div>
                                <div class="span text-sm"><b>Login:</b> {{ $login }}</div>
                                <div class="span text-sm"><b>Numer telefonu:</b> {{ $currentUser->nrTel }}</div>
                                <div class="span text-sm"><b>E-mail:</b> {{ $currentUser->email }}</div>
                                <div class="span text-sm"><b>Stanowisko:</b> {{ $currentUser->stanowiska->stanowisko }}</div>                      
                            </div>
                        </div>

                        @if ($userStanowisko === 'Właściciel Hotelu' || str_contains($userStanowisko, 'Menedżer'))
                            <div class="flex flex-col w-2/6 h-full  basis-[300px] grow">
                                <div class="bg-[#F4F2FF] rounded-md shadow-lg overflow-auto p-5 h-full">
                                    <div class="flex items-center mb-5">
                                        <img src={{ url('/icons/Magazyn.svg') }} class="transition duration-500 opacity-100 group-hover:opacity-0 h-5">
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
                        @endif
                
                {{-- Sub --}}
                        {{-- Left --}}       
                        @if ($userStanowisko === 'Właściciel Hotelu' || $userStanowisko === 'Menedżer Hotelu' || $userStanowisko === 'Pokojówka')
                            <div class="flex flex-col h-full  w-1/2 basis-[600px] grow">
                                <div class="bg-[#F4F2FF] rounded-md shadow-lg overflow-auto p-5 h-full">
                                    <div class="flex items-center mb-5">
                                        <img src={{ url('/icons/Pokoje.svg') }} class="transition duration-500 opacity-100 group-hover:opacity-0 h-6">
                                        <div class="font-bold text-2xl px-2">Pokoje</div>
                                    </div>
                                    
                                    <hr class="border-t border-gray-600 mb-5">
                                    <div class="grid grid-cols-4 font-bold px-2 py-1 text-sm">
                                        <div class="name">Pokój</div>
                                        <div class="name">Piętro</div>
                                        <div class="name">Status</div>
                                        <div class="name">Czysty</div>
                                    </div>
                                    <div class="roomsContainer">
                                        @foreach ($rooms as $room)
                                            @if($room->wykluczone === 0)
                                                <a class="tableClass grid grid-cols-4 transition-all duration-300 px-2 py-1 rounded-md text-sm">
                                                <div class="pokoje"> {{ $room->id }} </div>
                                                <div class="pokoje"> {{ $room->pietro }} </div>
                                                <div class="pokoje"> {{ $room->status ? 'Zajęte' : 'Wolne' }} </div>
                                                <div class="pokoje"> {{ $room->czyste ? 'Czysty' : 'Brudny' }} </div>
                                                </a>
                                            @endif
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        @endif

                        {{-- Right --}}
                        <div class="flex flex-col w-1/2 h-full  basis-[600px] grow">
                            <div class="bg-[#F4F2FF] rounded-md shadow-lg overflow-auto p-5 h-full">
                                <div class="flex items-center mb-5">
                                    <img src={{ url('/icons/calendar.svg') }} class="transition duration-500 opacity-100 group-hover:opacity-0 h-5">
                                    <div class="font-bold text-2xl px-2">Grafik na {{ $currentMonth }} {{ $year }}</div>
                                </div>
                                
                                <div class="flex group mb-5">
                                    <select class='select border-2 rounded-lg p-1 text-sm'> 
                                        @foreach ($stanowiska as $stanowisko)
                                            <option> {{ $stanowisko->stanowisko }} </option>
                                        @endforeach
                                    </select>
                                </div>

                                <hr class="border-t border-gray-600 mb-5">

                                <div id="grafik" class="grid grid-cols-7 z-10 place-items-center">
                                    @include('Templates.grafikTemplateHome', ['grafik' => $grafik])
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
