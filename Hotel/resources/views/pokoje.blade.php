<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>Personel</title>
  @vite('resources/css/app.css')
  @vite('resources/js/pokojeStyles.js')
  
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
        <div class="flex flex-col h-full w-full ml-1 md:ml-0 overflow-hidden">
            {{-- Top menu --}}
            @include('Templates.topMenuTemplate')

            {{-- Main screen --}}
            <div class="flex flex-col bg-white grow mx-1 my-1 mr-2 mb-2 min-w-fit rounded-md overflow-auto items-center">
                {{-- <div class="font-bold text-center mt-10 text-3xl">Zarządzaj pokojami</div> --}}

                <div class="flex min-h-max w-full justify-center animate-fade-down animate-delay-[1s] animate-ease-out my-5">
                    <div class="flex flex-col cursor-default min-w-max max-w-[1000px] grow max-h-96 bg-[#F4F2FF] rounded-2xl pl-10 pr-10 pt-5 pb-5 overflow-auto shadow-lg">
                        <div class="flex items-center mb-5">
                            <img src={{ url('/icons/Pokoje.svg') }} class="z-10 transition duration-500 opacity-100 group-hover:opacity-0 h-6">
                            <div class="font-bold text-2xl px-2">Pokoje</div>
                        </div>
                        <hr class="border-t border-gray-600 mb-5">
                        <div class="grid grid-cols-6 font-bold px-2 py-1">
                            <div class="name">Pokój</div>
                            <div class="name">Piętro</div>
                            <div class="name">Rodzaj</div>
                            <div class="name">Status</div>
                            <div class="name">Czysty</div>
                            <div class="name">Wykluczony</div>
                        </div>
                        <div class="roomsContainer">
                            @foreach ($rooms as $room)
                                @if($room->wykluczone === 0)
                                    <a class="tableClass cursor-pointer grid grid-cols-6 transition-all duration-300 hover:bg-[#dbd5ff] px-2 py-1 rounded-md">
                                    <div class="pokoje"> {{ $room->id }} </div>
                                    <div class="pokoje"> {{ $room->pietro }} </div>
                                    <div class="pokoje"> {{ $room->rodzaj->rodzaj }} </div>
                                    <div class="pokoje"> {{ $room->status ? 'Zajęte' : 'Wolne' }} </div>
                                    <div class="pokoje"> {{ $room->czyste ? 'Czysty' : 'Brudny' }} </div>
                                    <div class="pokoje"> {{ $room->wykluczone ? 'Wykluczony' : 'Aktywny' }} </div>
                                    </a>
                                @endif
                            @endforeach
                        </div>
                    </div>
                </div>

                @if ($userStanowisko === 'Właściciel Hotelu' || $userStanowisko === 'Menedżer Hotelu')
                    <div class="flex min-h-max w-full justify-center animate-fade-down animate-delay-[1s] animate-ease-out my-5">
                        <div class="flex flex-col cursor-default min-w-max max-w-[1000px] grow max-h-96 bg-[#F4F2FF] rounded-2xl pl-10 pr-10 pt-5 pb-5 overflow-auto shadow-lg">
                            <div class="flex items-center mb-5">
                                {{-- <img src={{ url('/icons/Pokoje.svg') }} class="z-10 transition duration-500 opacity-100 group-hover:opacity-0 h-6"> --}}
                                <div class="font-bold text-2xl px-2">Wykluczone pokoje</div>
                            </div>
                            <hr class="border-t border-gray-600 mb-5">
                            <div class="grid grid-cols-7 font-bold px-2 py-1">
                                <div class="name">Pokój</div>
                                <div class="name">Piętro</div>
                                <div class="name">Rodzaj</div>
                                <div class="name">Status</div>
                                <div class="name">Czysty</div>
                                <div class="name">Wykluczony</div>
                                <div class="name">Powód wykluczenia</div>
                            </div>
                            <div class="roomsContainerBlocked">
                                @foreach ($rooms as $room)
                                    @if($room->wykluczone === 1)
                                        <a class="tableClassBlocked cursor-pointer grid grid-cols-7 transition-all duration-300 hover:bg-[#dbd5ff] px-2 py-1 rounded-md" title="{{ $room->powod_wykluczenia }}">
                                        <div class="pokoje"> {{ $room->id }} </div>
                                        <div class="pokoje"> {{ $room->pietro }} </div>
                                        <div class="pokoje"> {{ $room->rodzaj->rodzaj }} </div>
                                        <div class="pokoje"> {{ $room->status ? 'Zajęte' : 'Wolne' }} </div>
                                        <div class="pokoje"> {{ $room->czyste ? 'Czysty' : 'Brudny' }} </div>
                                        <div class="pokoje"> {{ $room->wykluczone ? 'Wykluczony' : 'Aktywny' }} </div>
                                        <div class="pokoje w-36 overflow-hidden whitespace-nowrap text-ellipsis"> {{ $room->powod_wykluczenia }} </div>
                                        </a>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endif

                @if ($userStanowisko === 'Właściciel Hotelu' || $userStanowisko === 'Menedżer Hotelu')
                    <div class="flex min-h-max w-full justify-center animate-fade-down animate-delay-[1s] animate-ease-out items-center my-5">
                        <div class="addPokoj font-bold shadow-lg bg-[#F4F2FF] h-16 w-48 rounded-2xl overflow-hidden content-center text-center animate-fade-down animate-delay-[0.2s] animate-ease-out mx-5 cursor-pointer">
                            <div class="addPokoj text-xl select-none">Dodaj pokój</div>
                        </div>
                    </div>     
                @endif

                <div class="contextMenu hidden z-10 absolute bg-white px-2 py-2 shadow-md rounded-md opacity-0">
                    <div class="menuElement hover:bg-[#F4F2FF] transition-all duration-200 px-1 rounded-md cursor-pointer py-1">Edytuj Pokój</div>
                    @if ($userStanowisko === 'Właściciel Hotelu' || $userStanowisko === 'Menedżer Hotelu')
                        <div class="menuElement hover:bg-[#F4F2FF] transition-all duration-200 px-1 rounded-md cursor-pointer py-1">Wyklucz pokój</div>
                        <div class="menuElement hover:bg-[#F4F2FF] transition-all duration-200 px-1 rounded-md cursor-pointer py-1">Usuń pokój</div>
                    @endif
                </div>

                <div class="contextMenuBlocked hidden z-10 absolute bg-white px-2 py-2 shadow-md rounded-md opacity-0">
                    <div class="menuElementBlocked hover:bg-[#F4F2FF] transition-all duration-200 px-1 rounded-md cursor-pointer py-1">Edytuj Pokój</div>
                    <div class="menuElementBlocked hover:bg-[#F4F2FF] transition-all duration-200 px-1 rounded-md cursor-pointer py-1">Przywróć pokój</div>
                    <div class="menuElementBlocked hover:bg-[#F4F2FF] transition-all duration-200 px-1 rounded-md cursor-pointer py-1">Usuń pokój</div>
                </div>
            </div>
        </div>
        
         {{-- popUp edit --}}
        <div class="popPersonel bg-black bg-opacity-20 backdrop-blur-sm flex absolute invisible h-full w-full justify-center items-center opacity-0">
            <div class="pop2Personel flex flex-col bg-white w-[500px] min-h-max rounded-lg justify-center p-5">
                <div class="popText text-2xl font-bold text-center">Edytuj pokój [numer]</div>

                <img src={{ url('/icons/Account.svg') }} class="h-24 mt-2 p-2">

                <div class="flex justify-between w-full mt-2">
                    <div class="flex justify-center flex-col w-[50%] p-2">
                        <div class="mb-1 text-gray-700">Pokój</div>
                        <input type="text" placeholder="Pokój" class="data border-2 rounded-lg p-1 bg-gray-200" disabled>
                    </div>
                    <div class="flex justify-center flex-col w-[50%] p-2">
                        <div class="mb-1 text-gray-700">Piętro</div>
                        @if ($userStanowisko === 'Właściciel Hotelu' || $userStanowisko === 'Menedżer Hotelu')
                            <input type="text" placeholder="Piętro" class="data border-2 rounded-lg p-1">
                        @else
                            <input type="text" placeholder="Piętro" class="data border-2 rounded-lg p-1 bg-gray-200" disabled>
                        @endif
                    </div>
                </div>

                <div class="flex justify-around w-full mt-2">
                    <div class="flex justify-center flex-col w-[100%] p-2">
                        <div class="mb-1 text-gray-700">Rodzaj</div>
                        @if ($userStanowisko === 'Właściciel Hotelu' || $userStanowisko === 'Menedżer Hotelu')
                            <select name="Rodzaj" id="Rodzaj" class="data border-2 rounded-lg p-1 w-full bg-white">
                                @foreach ($rodzaj_pokoj as $pokoj)
                                    <option value="{{ $pokoj->id }}"> {{ $pokoj->rodzaj }} </option>
                                @endforeach
                            </select>      
                        @else
                            <select name="Rodzaj" id="Rodzaj" class="data border-2 rounded-lg p-1 w-full bg-white" disabled>
                                @foreach ($rodzaj_pokoj as $pokoj)
                                    <option value="{{ $pokoj->id }}"> {{ $pokoj->rodzaj }} </option>
                                @endforeach
                            </select>                        
                        @endif
                    </div>
                </div>
                
                <div class="flex justify-around w-full mt-2">
                    <div class="flex justify-center flex-col w-full p-2">
                        <div class="mb-1 text-gray-700">Status</div>
                        @if ($userStanowisko === 'Właściciel Hotelu' || $userStanowisko === 'Menedżer Hotelu' || $userStanowisko === 'Recepcjonista')
                            <select name="Status" id="Status" class="data border-2 rounded-lg p-1 w-full bg-white">
                                <option value="1"> Zajęte </option>
                                <option value="0"> Wolne </option>
                            </select>
                        @else
                            <select name="Status" id="Status" class="data border-2 rounded-lg p-1 w-full bg-gray-200" disabled>
                                <option value="1"> Zajęte </option>
                                <option value="0"> Wolne </option>
                            </select>
                        @endif
                    </div>
                </div>

                <div class="flex justify-around w-full mt-2">
                    <div class="flex justify-center flex-col w-full p-2">
                        <div class="mb-1 text-gray-700">Czysty</div>
                        {{-- <input type="text" placeholder="Czysty" class="data border-2 rounded-lg p-1 w-full"> --}}
                        <select name="Czysty" id="Czysty" class="data border-2 rounded-lg p-1 w-full bg-white">
                            <option value="0"> Brudny </option>
                            <option value="1"> Czysty </option>
                        </select>
                    </div>
                </div>

                <div class="flex flex-col items-center justify-center w-full">
                    <div class="flex relative group rounded-2xl mb-4 mt-6">
                        <div class="flex relative group h-12">
                            <button class="sendAjax bg-[#F4F2FF] w-36 h-12 min-w-max rounded-2xl text-lg opcaity-100 transition-all duration-200 group-hover:opacity-0">Zapisz</button>
                            <button class="sendAjax absolute bg-gradient-to-r from-cyan-400 to-fuchsia-400 w-36 h-12 min-w-max rounded-2xl text-lg transition-all duration-200 opacity-0 group-hover:opacity-100 text-white">Zapisz</button>
                        </div>
                    </div>
                </div>

            </div>
        </div>

        {{-- popup Delete --}}
        <div class="popDelete bg-black bg-opacity-20 backdrop-blur-sm flex absolute invisible h-full w-full justify-center items-center opacity-0">
            <div class="pop2Delete flex flex-col bg-white w-[500px] min-h-max rounded-lg justify-center p-5">

                <div class="popTextDelete text-2xl font-bold text-center">Wykluczyć pokój [nazwa]?</div>
                <textarea type="text" placeholder="Powód" class="dataWyklucz border-2 rounded-lg p-1 bg-white mt-5"> </textarea> 

                <div class="flex items-center justify-evenly px-10 w-full">
                    <div class="flex relative group rounded-2xl mb-4 mt-6">
                        <div class="flex relative group h-12 mx-5">
                            <button class="butYes bg-[#F4F2FF] w-36 h-12 min-w-max rounded-2xl text-lg opcaity-100 transition-all duration-200 group-hover:opacity-0">Tak</button>
                            <button class="butYes absolute bg-gradient-to-r from-red-400 to-orange-400 w-36 h-12 min-w-max rounded-2xl text-lg transition-all duration-200 opacity-0 group-hover:opacity-100 text-white">Tak</button>
                        </div>
                    </div>
                    <div class="flex relative group rounded-2xl mb-4 mt-6">
                        <div class="flex relative group h-12 mx-5">
                            <button class="butNo bg-[#F4F2FF] w-36 h-12 min-w-max rounded-2xl text-lg opcaity-100 transition-all duration-200 group-hover:opacity-0">Nie</button>
                            <button class="butNo absolute bg-gradient-to-r from-cyan-400 to-fuchsia-400 w-36 h-12 min-w-max rounded-2xl text-lg transition-all duration-200 opacity-0 group-hover:opacity-100 text-white">Nie   </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- popup Delete2 --}}
        <div class="popDeleteRoom bg-black bg-opacity-20 backdrop-blur-sm flex absolute invisible h-full w-full justify-center items-center opacity-0">
            <div class="pop2DeleteRoom flex flex-col bg-white w-[500px] min-h-max rounded-lg justify-center p-5">

                <div class="popTextDeleteRoom text-2xl font-bold text-center">Wykluczyć pokój [nazwa]?</div>

                <div class="flex items-center justify-evenly px-10 w-full">
                    <div class="flex relative group rounded-2xl mb-4 mt-6">
                        <div class="flex relative group h-12 mx-5">
                            <button class="butYesDelete bg-[#F4F2FF] w-36 h-12 min-w-max rounded-2xl text-lg opcaity-100 transition-all duration-200 group-hover:opacity-0">Tak</button>
                            <button class="butYesDelete absolute bg-gradient-to-r from-red-400 to-orange-400 w-36 h-12 min-w-max rounded-2xl text-lg transition-all duration-200 opacity-0 group-hover:opacity-100 text-white">Tak</button>
                        </div>
                    </div>
                    <div class="flex relative group rounded-2xl mb-4 mt-6">
                        <div class="flex relative group h-12 mx-5">
                            <button class="butNo bg-[#F4F2FF] w-36 h-12 min-w-max rounded-2xl text-lg opcaity-100 transition-all duration-200 group-hover:opacity-0">Nie</button>
                            <button class="butNo absolute bg-gradient-to-r from-cyan-400 to-fuchsia-400 w-36 h-12 min-w-max rounded-2xl text-lg transition-all duration-200 opacity-0 group-hover:opacity-100 text-white">Nie   </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <script>
            let pokoje = @json($pokoje);
            let rodzaj = @json($rodzaj_pokoj);
        </script>
    </div>
</body>
</html>
