@vite('resources/js/topbarStyle.js')

<div class="flex w-full h-20">
    <div class="burgerMenu flex lg:hidden flex-col grow lg: bg-white ml-2 mr-1 my-1 mt-2 rounded-md items-center justify-center overflow-hidden min-w-16">
        <img src={{ url('/icons/BurgerMenu.svg') }} class="h-8 bg-white rounded-md mx-2 animate-fade-right animate-delay-[0.1s] animate-ease-out">
    </div>
    {{-- @foreach ($hotelInfos as $info) --}}
    <div class="flex flex-col w-full lg:grow bg-white mx-1 my-1 mt-2 rounded-md items-center justify-center overflow-hidden min-w-max">
        <div class="nameTopbar font-bold text-3xl mx-2 animate-fade-right animate-delay-[0.5s] animate-ease-out">  </div>
        <div class="stanowiskoTopbar text-gray-500 mx-2 animate-fade-right animate-delay-[0.5s] animate-ease-out"> {{ $userStanowisko }} </div>
    </div>
    {{-- @endforeach --}}
    <div class="animParent relative group overflow-visible flex flex-col grow bg-white hover:rounded-b-none mx-1 my-1 mt-2 mr-2 rounded-md justify-center items-center min-w-max max-w-max">
        <button class="flex flex-col items-center">
            <img src={{ url('/icons/Account.svg') }} class="h-8 mt-2 mx-2 animate-fade-right animate-delay-[0.8s] animate-ease-out">
            <div class="font-bold mx-2 mb-2 animate-fade-right animate-delay-[0.8s] animate-ease-out"> {{ $login }} </div>
        </button>

        <div class="anim transition-all opacity-0 group-hover:opacity-100 invisible group-hover:visible duration-300 absolute z-10 end-0 top-full block w-auto min-w-max text-end py-2 px-4 shadow-lg bg-white rounded-b-md">
            <div class="logOut hover:bg-[#dbd5ff] px-2 py-1 rounded-md cursor-pointer transition-all">Wyloguj się</div>
        </div>
    </div>
</div>

<div class="menuClass absolute hidden lg:hidden max-w-[300px] h-full"> 
    <div class="menu flex flex-col bg-white h-full max-w-[300px]">
        <div class="flex h-20 shrink-0">
            <div class="flex bg-white grow ml-2 mt-2 m-1 mb-0 rounded-t-md items-center justify-center overflow-hidden">
                <img src={{ url('/icons/Logo.svg') }} class="h-10 mt-2 animate-fade-right animate-delay-[0.1s] animate-ease-out">
            </div>
        </div>
        <a href='{{ route('homeRoute', ['month' => $month, 'year' => $year]) }}' class="flex w-full h-10 mb-2">
            <button class="relative w-full flex h-10 mx-2 my-1 px-4 items-center p-2 text-start group animate-fade-right animate-delay-[0.2s] animate-ease-out" value="home">
                <div class="absolute rounded-md inset-0 z-0 bg-gradient-to-r opacity-0 transition-opacity duration-500 group-hover:opacity-100 from-cyan-400 to-fuchsia-400"></div>
                <img src={{ url('/icons/StronaGlowna.svg') }} class="z-10 transition duration-500 opacity-100 group-hover:opacity-0 h-6">
                <img src={{ url('/icons/StronaGlowna-white.svg') }} class="z-10 transition duration-500 absolute opacity-0 group-hover:opacity-100 h-6">
                <div class="p-2 z-10 transition duration-500 group-hover:text-white">Strona główna</div>
            </button>
        </a>
            
        @if ($userStanowisko === 'Właściciel Hotelu' || $userStanowisko === 'Menedżer Hotelu' || $userStanowisko === 'Pokojówka' || $userStanowisko === 'Recepcjonista')
            <a href='{{ route('pokojeRoute') }}' class="flex w-full h-10 mb-2">
                <button class="relative w-full flex h-10 mx-2 my-1 px-4 items-center p-2 text-start hover:text-white group animate-fade-right animate-delay-[0.3s] animate-ease-out" value="pokoje">
                    <div class="absolute rounded-md inset-0 z-0 bg-gradient-to-r opacity-0 transition duration-500 group-hover:opacity-100 from-cyan-400 to-fuchsia-400"></div>
                    <img src={{ url('/icons/Pokoje.svg') }} class="z-10 transition duration-500 opacity-100 group-hover:opacity-0 h-6">
                    <img src={{ url('/icons/Pokoje-white.svg') }} class="z-10 transition duration-500 absolute opacity-0 group-hover:opacity-100 h-6">    
                    <div class="p-2 z-10 transition duration-500 group-hover:text-white">Zarządzaj pokojami</div>
                </button>
            </a>
        @endif

        @if ($userStanowisko === 'Właściciel Hotelu' || $userStanowisko === 'Menedżer Hotelu')
            <a href='{{ route('personelRoute') }}' class="flex w-full h-10 mb-2">
                <button class="relative w-full flex h-10 mx-2 my-1 px-4 items-center p-2 text-start hover:text-white group animate-fade-right animate-delay-[0.4s] animate-ease-out" value="grafik">
                    <div class="absolute rounded-md inset-0 z-0 bg-gradient-to-r opacity-0 transition duration-500 group-hover:opacity-100 from-cyan-400 to-fuchsia-400"></div>
                    <img src={{ url('/icons/Personel.svg') }} class="z-10 transition duration-500 opacity-100 group-hover:opacity-0 h-6">
                    <img src={{ url('/icons/Personel-white.svg') }} class="z-10 transition duration-500 absolute opacity-0 group-hover:opacity-100 h-6">     
                    <div class="p-2 z-10 transition duration-500 group-hover:text-white">Zarządzaj personelem</div>
                </button>
            </a>
        @endif

        @if (str_contains($userStanowisko, 'Menedżer') || $userStanowisko === 'Właściciel Hotelu')
            <a href='{{ route('magazynRoute') }}' class="flex w-full h-10 mb-2">
                <button class="relative w-full flex h-10 mx-2 my-1 px-4 items-center p-2 text-start hover:text-white group animate-fade-right animate-delay-[0.6s] animate-ease-out" value="magazyn">
                    <div class="absolute rounded-md inset-0 z-0 bg-gradient-to-r opacity-0 transition duration-500 group-hover:opacity-100 from-cyan-400 to-fuchsia-400"></div>
                    <img src={{ url('/icons/Magazyn.svg') }} class="z-10 transition duration-500 opacity-100 group-hover:opacity-0 h-6">
                    <img src={{ url('/icons/Magazyn-white.svg') }} class="z-10 transition duration-500 absolute opacity-0 group-hover:opacity-100 h-6">
                    <div class="p-2 z-10 transition duration-500 group-hover:text-white">Magazyn</div>
                </button>
            </a>
        @endif

        @if ($userStanowisko === 'Właściciel Hotelu' || $userStanowisko === 'Menedżer Hotelu')
            <a href='{{ route('grafikRoute', ['month' => $month, 'year' => $year]) }}' class="flex w-full h-10 mb-2">
        @else
            <a href='{{ route('personelParameterRoute', ['login' => $login, 'month' => $month, 'year' => $year]) }}' class="flex w-full h-10 mb-2">
        @endif
        <button class="relative w-full flex h-10 mx-2 my-1 px-4 items-center p-2 text-start hover:text-white group animate-fade-right animate-delay-[0.6s] animate-ease-out" value="grafikWhole">
                <div class="absolute rounded-md inset-0 z-0 bg-gradient-to-r opacity-0 transition duration-500 group-hover:opacity-100 from-cyan-400 to-fuchsia-400"></div>
                <img src={{ url('/icons/calendar.svg') }} class="z-10 transition duration-500 opacity-100 group-hover:opacity-0 h-6">
                <img src={{ url('/icons/calendar-white.svg') }} class="z-10 transition duration-500 absolute opacity-0 group-hover:opacity-100 h-6">
                <div class="p-2 z-10 transition duration-500 group-hover:text-white">Grafik</div>
            </button>
        </a>
    </div>
</div>
