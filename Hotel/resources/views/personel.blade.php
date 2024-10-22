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
        @include('\Templates\sidebarTemplate')

        {{-- Right flex --}}
        <div class="flex flex-col h-full w-full ml-1 md:ml-0 overflow-hidden">
            {{-- Top menu --}}
            @include('Templates\topMenuTemplate')

            {{-- Main screen --}}
            <div class="flex flex-col bg-white grow mx-1 my-1 mr-2 mb-2 min-w-fit rounded-md overflow-auto items-center">
                <div class="font-bold text-center mt-10 text-3xl">Wybierz grafik do edycji</div>
                <div class="flex h-2/6 w-full justify-center animate-fade-down animate-delay-[1s] animate-ease-out">

                    <div class="flex flex-col cursor-default mt-10 min-w-max max-w-[1000px] grow mx-10 h-full bg-gray-200 rounded-2xl pl-10 pr-10 pt-5 pb-5 overflow-auto shadow-lg">
                        <div class="font-bold text-3xl mb-5">Personel</div>
                        <div class="grid grid-cols-4 font-bold px-2 py-1">
                            <div class="name">Imię i nazwisko</div>
                            <div class="name">Stanowisko</div>
                            <div class="name">Status</div>
                            <div class="name">Czas pracy</div>
                        </div>
                        @php
                         $i = 0;
                        @endphp

                        @foreach ($personels as $personel)
                            <a href='{{ route('personelParameterRoute', ['login' => $personel->login, 'month' => $month, 'year' => $year]) }}' class="tableClass cursor-pointer grid grid-cols-4 transition-all duration-300 hover:bg-gray-300 px-2 py-1 rounded-md">
                                <div class="className hidden"> {{ $personel->login }} </div>
                                <div class="class"> {{ $personel->imie }}  {{ $personel->nazwisko }} </div>
                                <div class="class"> {{ $personel->stanowiska->stanowisko }} </div>
                                <div class="class"> {{ $statuses[$i] }} </div>
                                <div class="class"> {{ $timeOfWork[$i] }}h </div>
                            </a>
                            @php
                                $i++;
                            @endphp
                        @endforeach
                    </div>
                </div>
                <div class="contextMenu hidden z-10 absolute bg-white px-2 py-2 shadow-md rounded-md opacity-0">
                    <a href='{{ route('personelParameterRoute', ['login' => $personel->login, 'month' => $month, 'year' => $year]) }}' class="menuRoute">
                        <div class="menuElement hover:bg-gray-100 transition-all duration-200 px-1 rounded-md cursor-pointer py-1">Zmień grafik</div>
                    </a>
                    <div class="menuElement hover:bg-gray-100 transition-all duration-200 px-1 rounded-md cursor-pointer py-1">Edytuj Użytkownika</div>
                    <div class="menuElement hover:bg-gray-100 transition-all duration-200 px-1 rounded-md cursor-pointer py-1">Usuń użytkownika</div>
                </div>
            </div>
        </div>

        {{-- popUp edit --}}
        <div class="popPersonel bg-black bg-opacity-20 backdrop-blur-sm flex absolute invisible h-full w-full justify-center items-center opacity-100">
            <div class="pop2Personel flex flex-col bg-white w-[500px] min-h-max rounded-lg justify-center p-5">
                <script>
                    let personels = @json($personels);
                </script>
            
                <div class="popText text-2xl font-bold text-center">Edytuj użytkownika [nazwa]</div>

                <img src={{ url('/icons/Account.svg') }} class="h-24 mt-2 p-2">

                <div class="flex justify-between w-full mt-2">
                    <div class="flex justify-center flex-col w-[50%] p-2">
                        <div class="mb-1 text-gray-700">Imię</div>
                        <input type="text" placeholder="Imię" class="data border-2 rounded-lg p-1">
                    </div>
                    <div class="flex justify-center flex-col w-[50%] p-2">
                        <div class="mb-1 text-gray-700">Nazwisko</div>
                        <input type="text" placeholder="Nazwisko" class="data border-2 rounded-lg p-1">
                    </div>
                </div>

                <div class="flex justify-around w-full mt-2">
                    <div class="flex justify-center flex-col w-full p-2">
                        <div class="mb-1 text-gray-700">Email</div>
                        <input type="text" placeholder="Email" class="data border-2 rounded-lg p-1 w-full">
                    </div>
                </div>

                <div class="flex justify-around w-full mt-2">
                    <div class="flex justify-center flex-col w-full p-2">
                        <div class="mb-1 text-gray-700">Numer telefonu</div>
                        <input type="text" placeholder="Numer telefonu" class="data border-2 rounded-lg p-1 w-full">
                    </div>
                </div>

                <div class="flex justify-around w-full mt-2">
                    <div class="flex justify-center flex-col w-full p-2">
                        <div class="mb-1 text-gray-700">Stanowisko</div>
                        {{-- <input type="text" placeholder="Stanowisko" class="data border-2 rounded-lg p-1 w-full"> --}}
                        <select name="stanowisko" id="stanowisko" class="data border-2 rounded-lg p-1 w-full">
                            @foreach ($stanowiska as $stanowisko)
                                <option value={{ $stanowisko->stanowisko }}>{{ $stanowisko->stanowisko }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="flex justify-between w-full mt-2">
                    <div class="flex justify-center flex-col w-[50%] p-2">
                        <div class="mb-1 text-gray-700">Nazwa użytkownika</div>
                        <input type="text" placeholder="Nazwa użytkownika" class="data border-2 rounded-lg p-1 bg-gray-200" disabled>
                    </div>
                    <div class="flex justify-center flex-col w-[50%] p-2">
                        <div class="mb-1 text-gray-700">Hasło</div>
                        <input type="password" placeholder="Hasło" class="data border-2 rounded-lg p-1">
                    </div>
                </div>

                <div class="flex flex-col items-center justify-center w-full">
                    <div class="flex relative group rounded-2xl mb-4 mt-6">
                        <div class="flex relative group h-12">
                            <button class="sendAjax bg-gray-200 w-36 h-12 min-w-max rounded-2xl text-lg opcaity-100 transition-all duration-200 group-hover:opacity-0">Zapisz</button>
                            <button class="sendAjax absolute bg-gradient-to-r from-cyan-400 to-fuchsia-400 w-36 h-12 min-w-max rounded-2xl text-lg transition-all duration-200 opacity-0 group-hover:opacity-100 text-white">Zapisz</button>
                        </div>
                    </div>
                </div>

            </div>
        </div>

        {{-- popup Delete --}}
        <div class="popDelete bg-black bg-opacity-20 backdrop-blur-sm flex absolute invisible h-full w-full justify-center items-center opacity-100">
            <div class="pop2Delete flex flex-col bg-white w-[500px] min-h-max rounded-lg justify-center p-5">
                <script>
                    let personels = @json($personels);
                </script>

            <div class="popTextDelete text-2xl font-bold text-center">Usuń użytkownika [nazwa]</div>

            <div class="flex items-center justify-evenly px-10 w-full">
                <div class="flex relative group rounded-2xl mb-4 mt-6">
                    <div class="flex relative group h-12 mx-5">
                        <button class="butYes bg-gray-200 w-36 h-12 min-w-max rounded-2xl text-lg opcaity-100 transition-all duration-200 group-hover:opacity-0">Tak</button>
                        <button class="butYes absolute bg-gradient-to-r from-red-400 to-orange-400 w-36 h-12 min-w-max rounded-2xl text-lg transition-all duration-200 opacity-0 group-hover:opacity-100 text-white">Tak</button>
                    </div>
                </div>
                <div class="flex relative group rounded-2xl mb-4 mt-6">
                    <div class="flex relative group h-12 mx-5">
                        <button class="butNo bg-gray-200 w-36 h-12 min-w-max rounded-2xl text-lg opcaity-100 transition-all duration-200 group-hover:opacity-0">Nie</button>
                        <button class="butNo absolute bg-gradient-to-r from-cyan-400 to-fuchsia-400 w-36 h-12 min-w-max rounded-2xl text-lg transition-all duration-200 opacity-0 group-hover:opacity-100 text-white">Nie   </button>
                    </div>
                </div>
            </div>
            </div>
        </div>

    </div>
</body>
</html>
