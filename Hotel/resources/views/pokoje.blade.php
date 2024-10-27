<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>Personel</title>
  @vite('resources/css/app.css')
  @vite('resources/js/styles.js')
  @vite('resource/js/animations.js')
  @vite('resource/js/pokojeStyles.js')
  
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
                <div class="font-bold text-center mt-10 text-3xl">Zarządzaj pokojami</div>

                <div class="flex min-h-max w-full justify-center animate-fade-down animate-delay-[1s] animate-ease-out my-5">
                    <div class="flex flex-col cursor-default min-w-max max-w-[1000px] grow max-h-96 bg-gray-200 rounded-2xl pl-10 pr-10 pt-5 pb-5 overflow-auto shadow-lg">
                        <div class="font-bold text-3xl mb-5">Aktywne pokoje</div>
                        <div class="grid grid-cols-5 font-bold px-2 py-1">
                            <div class="name">Pokój</div>
                            <div class="name">Piętro</div>
                            <div class="name">Status</div>
                            <div class="name">Czysty</div>
                            <div class="name">Wykluczony</div>
                        </div>
                        <div class="grid grid-cols-5 px-2 py-1">
                            @foreach ($rooms as $room)
                                @if($room->wykluczone === 0)
                                    {{-- <a href='{{ route('personelParameterRoute', ['login' => $personel->login, 'month' => $month, 'year' => $year]) }}' class="tableClass cursor-pointer grid grid-cols-5 transition-all duration-300 hover:bg-gray-300 px-2 py-1 rounded-md"> --}}
                                    <div class="pokoje"> {{ $room->id_numer_pokoju }} </div>
                                    <div class="pokoje"> {{ $room->pietro }} </div>
                                    <div class="pokoje"> {{ $room->status ? 'Zajęte' : 'Wolne' }} </div>
                                    <div class="pokoje"> {{ $room->czyste ? 'Czysty' : 'Brudny' }} </div>
                                    <div class="pokoje"> {{ $room->wykluczone ? 'Wykluczony' : 'Aktywny' }} </div>
                                    {{-- </a> --}}
                                @endif
                            @endforeach
                        </div>
                    </div>
                </div>

                <div class="flex min-h-max w-full justify-center animate-fade-down animate-delay-[1s] animate-ease-out my-5">
                    <div class="flex flex-col cursor-default min-w-max max-w-[1000px] grow max-h-96 bg-gray-200 rounded-2xl pl-10 pr-10 pt-5 pb-5 overflow-auto shadow-lg">
                        <div class="font-bold text-3xl mb-5">Wykluczone pokoje</div>
                        <div class="grid grid-cols-5 font-bold px-2 py-1">
                            <div class="name">Pokój</div>
                            <div class="name">Piętro</div>
                            <div class="name">Status</div>
                            <div class="name">Czysty</div>
                            <div class="name">Wykluczony</div>
                        </div>
                        <div class="grid grid-cols-5 px-2 py-1">
                            @foreach ($rooms as $room)
                                @if($room->wykluczone === 1)
                                    {{-- <a href='{{ route('personelParameterRoute', ['login' => $personel->login, 'month' => $month, 'year' => $year]) }}' class="tableClass cursor-pointer grid grid-cols-5 transition-all duration-300 hover:bg-gray-300 px-2 py-1 rounded-md"> --}}
                                    <div class="pokoje"> {{ $room->id_numer_pokoju }} </div>
                                    <div class="pokoje"> {{ $room->pietro }} </div>
                                    <div class="pokoje"> {{ $room->status ? 'Zajęte' : 'Wolne' }} </div>
                                    <div class="pokoje"> {{ $room->czyste ? 'Czysty' : 'Brudny' }} </div>
                                    <div class="pokoje"> {{ $room->wykluczone ? 'Wykluczony' : 'Aktywny' }} </div>
                                    {{-- </a> --}}
                                @endif
                            @endforeach
                        </div>
                    </div>
                </div>

                <div class="contextMenu hidden z-10 absolute bg-white px-2 py-2 shadow-md rounded-md opacity-0">
                    {{-- <a href='{{ route('personelParameterRoute', ['login' => $personel->login, 'month' => $month, 'year' => $year]) }}' class="menuRoute"> --}}
                        <div class="menuElement hover:bg-gray-100 transition-all duration-200 px-1 rounded-md cursor-pointer py-1">Zmień grafik</div>
                    {{-- </a> --}}
                    <div class="menuElement hover:bg-gray-100 transition-all duration-200 px-1 rounded-md cursor-pointer py-1">Edytuj Użytkownika</div>
                    <div class="menuElement hover:bg-gray-100 transition-all duration-200 px-1 rounded-md cursor-pointer py-1">Zablokuj użytkownika</div>
                </div>

                <div class="contextMenuBlocked hidden z-10 absolute bg-white px-2 py-2 shadow-md rounded-md opacity-0">
                    <div class="menuElementBlocked hover:bg-gray-100 transition-all duration-200 px-1 rounded-md cursor-pointer py-1">Edytuj Użytkownika</div>
                    <div class="menuElementBlocked hover:bg-gray-100 transition-all duration-200 px-1 rounded-md cursor-pointer py-1">Odblokuj użytkownika</div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
