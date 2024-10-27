<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>    
@vite('resources/js/styles.js')
    
<div class="hidden flex-col h-full w-[300px] md:flex overflow-hidden min-w-max">
    <div class="flex h-20 shrink-0">
        <div class="flex bg-white grow ml-2 mt-2 m-1 mb-0 rounded-t-md items-center justify-center overflow-hidden">
            <img src={{ url('/icons/Logo.svg') }} class="h-10 mt-2 animate-fade-right animate-delay-[0.1s] animate-ease-out">
        </div>
    </div>
    <div class="flex grow over overflow-auto">
        <div class="bg-white grow m-1 ml-2 mb-2 mt-0 rounded-b-md overflow-auto">
            <div class="menu flex flex-col mt-2">

                <a href='{{ route('homeRoute') }}' class="flex w-full h-10 mb-2">
                    <button class="relative w-full flex h-10 mx-2 my-1 px-4 items-center p-2 text-start group animate-fade-right animate-delay-[0.2s] animate-ease-out" value="home">
                        <div class="absolute rounded-md inset-0 z-0 bg-gradient-to-r opacity-0 transition-opacity duration-500 group-hover:opacity-100 from-cyan-400 to-fuchsia-400"></div>
                        <img src={{ url('/icons/StronaGlowna.svg') }} class="z-10 transition duration-500 opacity-100 group-hover:opacity-0 h-6">
                        <img src={{ url('/icons/StronaGlowna-white.svg') }} class="z-10 transition duration-500 absolute opacity-0 group-hover:opacity-100 h-6">
                        <div class="p-2 z-10 transition duration-500 group-hover:text-white">Strona Główna</div>
                    </button>
                </a>

                <a href='{{ route('pokojeRoute') }}' class="flex w-full h-10 mb-2">
                    <button class="relative w-full flex h-10 mx-2 my-1 px-4 items-center p-2 text-start hover:text-white group animate-fade-right animate-delay-[0.3s] animate-ease-out" value="pokoje">
                        <div class="absolute rounded-md inset-0 z-0 bg-gradient-to-r opacity-0 transition duration-500 group-hover:opacity-100 from-cyan-400 to-fuchsia-400"></div>
                        <img src={{ url('/icons/Pokoje.svg') }} class="z-10 transition duration-500 opacity-100 group-hover:opacity-0 h-6">
                        <img src={{ url('/icons/Pokoje-white.svg') }} class="z-10 transition duration-500 absolute opacity-0 group-hover:opacity-100 h-6">    
                        <div class="p-2 z-10 transition duration-500 group-hover:text-white">Zarządzaj pokojami</div>
                    </button>
                </a>

                <a href='{{ route('personelRoute') }}' class="flex w-full h-10 mb-2">
                    <button class="relative w-full flex h-10 mx-2 my-1 px-4 items-center p-2 text-start hover:text-white group animate-fade-right animate-delay-[0.4s] animate-ease-out" value="grafik">
                        <div class="absolute rounded-md inset-0 z-0 bg-gradient-to-r opacity-0 transition duration-500 group-hover:opacity-100 from-cyan-400 to-fuchsia-400"></div>
                        <img src={{ url('/icons/Personel.svg') }} class="z-10 transition duration-500 opacity-100 group-hover:opacity-0 h-6">
                        <img src={{ url('/icons/Personel-white.svg') }} class="z-10 transition duration-500 absolute opacity-0 group-hover:opacity-100 h-6">     
                        <div class="p-2 z-10 transition duration-500 group-hover:text-white">Zarządzaj personelem</div>
                    </button>
                </a>

                <a href='{{ route('homeRoute') }}' class="flex w-full h-10 mb-2">
                    <button class="relative w-full flex h-10 mx-2 my-1 px-4 items-center p-2 text-start hover:text-white group animate-fade-right animate-delay-[0.5s] animate-ease-out" value="analiza">
                        <div class="absolute rounded-md inset-0 z-0 bg-gradient-to-r opacity-0 transition duration-500 group-hover:opacity-100 from-cyan-400 to-fuchsia-400"></div>
                        <img src={{ url('/icons/Analiza.svg') }} class="z-10 transition duration-500 opacity-100 group-hover:opacity-0 h-6">
                        <img src={{ url('/icons/Analiza-white.svg') }} class="z-10 transition duration-500 absolute opacity-0 group-hover:opacity-100 h-6"> 
                        <div class="p-2 z-10 transition duration-500 group-hover:text-white">Analiza</div>
                    </button>
                </a>

                <a href='{{ route('homeRoute') }}' class="flex w-full h-10 mb-2">
                    <button class="relative w-full flex h-10 mx-2 my-1 px-4 items-center p-2 text-start hover:text-white group animate-fade-right animate-delay-[0.6s] animate-ease-out" value="magazyn">
                        <div class="absolute rounded-md inset-0 z-0 bg-gradient-to-r opacity-0 transition duration-500 group-hover:opacity-100 from-cyan-400 to-fuchsia-400"></div>
                        <img src={{ url('/icons/Magazyn.svg') }} class="z-10 transition duration-500 opacity-100 group-hover:opacity-0 h-6">
                        <img src={{ url('/icons/Magazyn-white.svg') }} class="z-10 transition duration-500 absolute opacity-0 group-hover:opacity-100 h-6">
                        <div class="p-2 z-10 transition duration-500 group-hover:text-white">Magazyn</div>
                    </button>
                </a>

                <a href='{{ route('homeRoute') }}' class="flex w-full h-10 mb-2">
                    <button class="relative w-full flex h-10 mx-2 my-1 px-4 items-center p-2 text-start hover:text-white group animate-fade-right animate-delay-[0.7s] animate-ease-out" value="konfiguracja">
                        <div class="absolute rounded-md inset-0 z-0 bg-gradient-to-r opacity-0 transition duration-500 group-hover:opacity-100 from-cyan-400 to-fuchsia-400"></div>
                        <img src={{ url('/icons/Settings.svg') }} class="z-10 transition duration-500 opacity-100 group-hover:opacity-0 h-6">
                        <img src={{ url('/icons/Settings-white.svg') }} class="z-10 transition duration-500 absolute opacity-0 group-hover:opacity-100 h-6">
                        <div class="p-2 z-10 transition duration-500 group-hover:text-white">Konfiguracja</div>
                    </button>
                </a>

            </div>
        </div>
    </div>
</div>