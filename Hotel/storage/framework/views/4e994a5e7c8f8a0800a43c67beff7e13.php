<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Strona główna</title>
  <?php echo app('Illuminate\Foundation\Vite')('resources/css/app.css'); ?>
  <?php echo app('Illuminate\Foundation\Vite')('resources/js/home.js'); ?>
  
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

        
        <?php echo $__env->make('Templates.sidebarTemplate', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

        
        <div class="flex flex-col h-full w-full ml-0 overflow-hidden">
            
            <?php echo $__env->make('Templates.topMenuTemplate', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

            
            <div class="flex flex-col bg-white grow mx-1 my-1 mr-2 mb-2 min-w-fit rounded-md overflow-auto">
                
                
                <div class="flex flex-col grow h-full w-full">
                    <div class="flex w-full h-1/2 flex-wrap p-5 gap-5">
                        
                        <?php if($userStanowisko === 'Właściciel Hotelu' || $userStanowisko === 'Menedżer Hotelu'): ?>
                            <div class="flex flex-col w-1/6 h-full  basis-[200px] grow">
                                <div class="flex flex-col bg-[#FFCACA] shadow-lg h-1/3 min-h-[100px] mb-5 rounded-md justify-center items-center">
                                    <div class="text-5xl font-bold"><?php echo e($roomsDirty); ?></div>
                                    <div class="text-md mt-2">Brudne pokoje</div>
                                </div>
                                <div class="flex flex-col bg-[#FFDCB5] shadow-lg h-1/3 min-h-[100px] mb-5 rounded-md justify-center items-center">
                                    <div class="text-5xl font-bold"><?php echo e($magazynMissing); ?></div>
                                    <div class="text-md mt-2">Deficyt produktów</div>
                                </div>
                                <div class="flex flex-col bg-[#C0D4FF] shadow-lg h-1/3 min-h-[100px] rounded-md justify-center items-center">
                                    <div class="text-5xl font-bold"><?php echo e($roomsTaken); ?></div>
                                    <div class="text-md mt-2">Zajęte pokoje</div>
                                </div>
                            </div>
                        <?php endif; ?>
                        
                        <div class="flex flex-col w-2/6 h-full basis-[400px] grow">
                            <div class="bg-[#F4F2FF] rounded-md shadow-lg overflow-auto p-5 h-full">
                                <div class="flex items-center mb-5">
                                    <img src=<?php echo e(url('/icons/Personel.svg')); ?> class="z-10 transition duration-500 opacity-100 group-hover:opacity-0 h-6">
                                    <div class="font-bold text-2xl px-2">Pracowników dzisiaj (<?php echo e($statusesCount); ?>)</div>
                                </div>
                                
                                <hr class="border-t border-gray-600 mb-5">
                                <div class="grid grid-cols-2 font-bold px-2 py-1 text-sm">
                                    <div class="name">Imię i nazwisko</div>
                                    <div class="name">Stanowisko</div>
                                </div>
                                <?php $__currentLoopData = $personels; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $personel): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php if($statuses[$personel->imie] === 'Pracuje'): ?>
                                        <div class="tableClass grid grid-cols-2 transition-all duration-300 px-2 py-1 rounded-md text-sm">
                                            <div class="className hidden"> <?php echo e($personel->login); ?> </div>
                                            <div class="class"> <?php echo e($personel->imie); ?>  <?php echo e($personel->nazwisko); ?> </div>
                                            <div class="class"> <?php echo e($personel->stanowiska->stanowisko); ?> </div>
                                        </div>
                                    <?php endif; ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                        </div>

                        
                        <div class="flex flex-col w-1/6 h-full basis-[200px] grow">
                            <div class="flex flex-col bg-[#F4F2FF] shadow-lg rounded-md grow p-5 overflow-auto">
                                <div class="flex items-center mb-5">
                                    <img src=<?php echo e(url('/icons/Account.svg')); ?> class="z-10 transition duration-500 opacity-100 group-hover:opacity-0 h-6">
                                    <div class="font-bold text-2xl px-2">Moje konto</div>
                                </div>
                                <hr class="border-t border-gray-600 mb-5 h-1">

                                <img src=<?php echo e(url('/icons/Account.svg')); ?> class="z-10 transition duration-500 opacity-100 group-hover:opacity-0 h-20 mb-5">
                                <div class="span text-sm"><b>Imię:</b> <?php echo e($currentUser->imie); ?></div>
                                <div class="span text-sm"><b>Nazwisko:</b> <?php echo e($currentUser->nazwisko); ?></div>
                                <div class="span text-sm"><b>Login:</b> <?php echo e($login); ?></div>
                                <div class="span text-sm"><b>Numer telefonu:</b> <?php echo e($currentUser->nrTel); ?></div>
                                <div class="span text-sm"><b>E-mail:</b> <?php echo e($currentUser->email); ?></div>
                                <div class="span text-sm"><b>Stanowisko:</b> <?php echo e($currentUser->stanowiska->stanowisko); ?></div>                      
                            </div>
                        </div>

                        <?php if($userStanowisko === 'Właściciel Hotelu' || str_contains($userStanowisko, 'Menedżer')): ?>
                            <div class="flex flex-col w-2/6 h-full  basis-[300px] grow">
                                <div class="bg-[#F4F2FF] rounded-md shadow-lg overflow-auto p-5 h-full">
                                    <div class="flex items-center mb-5">
                                        <img src=<?php echo e(url('/icons/Magazyn.svg')); ?> class="z-10 transition duration-500 opacity-100 group-hover:opacity-0 h-5">
                                        <div class="font-bold text-2xl px-2">Magazyn</div>
                                    </div>
                                    
                                    <hr class="border-t border-gray-600 mb-5">
                                    
                                    <div class="grid grid-cols-3 font-bold px-2 py-1 gap-x-px">
                                        <div class="name">Nazwa</div>
                                        <div class="name">Ilość</div>
                                        <div class="name">Data ważności</div>
                                    </div>
                                    <div class="magazynContainer">
                                        <?php $__currentLoopData = $magazyn; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <div class="tableClass grid grid-cols-3 transition-all duration-300 px-2 py-1 rounded-md text-sm gap-x-px">
                                            <div class="magazyn"><?php echo e($item->produkt->nazwa); ?> </div>
                                            <div class="magazyn"><?php echo e($item->ilosc); ?> </div>
                                            <div class="magazyn"><?php echo e($item->data_waznosci); ?> </div>
                                        </div>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </div>
                                </div>
                            </div>
                        <?php endif; ?>
                
                
                               
                        <?php if($userStanowisko === 'Właściciel Hotelu' || $userStanowisko === 'Menedżer Hotelu' || $userStanowisko === 'Pokojówka'): ?>
                            <div class="flex flex-col h-full  w-1/2 basis-[600px] grow">
                                <div class="bg-[#F4F2FF] rounded-md shadow-lg overflow-auto p-5 h-full">
                                    <div class="flex items-center mb-5">
                                        <img src=<?php echo e(url('/icons/Pokoje.svg')); ?> class="z-10 transition duration-500 opacity-100 group-hover:opacity-0 h-6">
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
                                        <?php $__currentLoopData = $rooms; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $room): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <?php if($room->wykluczone === 0): ?>
                                                <a class="tableClass grid grid-cols-4 transition-all duration-300 px-2 py-1 rounded-md text-sm">
                                                <div class="pokoje"> <?php echo e($room->id); ?> </div>
                                                <div class="pokoje"> <?php echo e($room->pietro); ?> </div>
                                                <div class="pokoje"> <?php echo e($room->status ? 'Zajęte' : 'Wolne'); ?> </div>
                                                <div class="pokoje"> <?php echo e($room->czyste ? 'Czysty' : 'Brudny'); ?> </div>
                                                </a>
                                            <?php endif; ?>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </div>
                                </div>
                            </div>
                        <?php endif; ?>

                        
                        <div class="flex flex-col w-1/2 h-full  basis-[600px] grow">
                            <div class="bg-[#F4F2FF] rounded-md shadow-lg overflow-auto p-5 h-full">
                                <div class="flex items-center mb-5">
                                    <img src=<?php echo e(url('/icons/calendar.svg')); ?> class="z-10 transition duration-500 opacity-100 group-hover:opacity-0 h-5">
                                    <div class="font-bold text-2xl px-2">Grafik na <?php echo e($currentMonth); ?> <?php echo e($year); ?></div>
                                </div>
                                
                                <hr class="border-t border-gray-600 mb-5">

                                <div class="grid grid-cols-7 z-10 justify-items-center">
                                    <?php if(isset($grafik)): ?>
                                        <?php 
                                            $file = $grafik[0]['data'][0]['nazwa dnia'];
                                        ?>
                                    <?php else: ?>
                                        <?php
                                            $file = $dayNames[1];
                                        ?>
                                    <?php endif; ?>
            
                                    <?php
                                        $dni = array(
                                            1 => "Poniedziałek",
                                            2 => "Wtorek",
                                            3 => "Środa",
                                            4 => "Czwartek",
                                            5 => "Piątek",
                                            6 => "Sobota",
                                            7 => "Niedziela",
                                        );
                                    ?>
                                    
                                    <?php $__currentLoopData = $dni; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $dzien): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <div class="document-animation font-bold mx-2 my-2 text-center text-sm select-none"><?php echo e($dzien); ?></div>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            
                                    <?php if($file != "Poniedziałek"): ?>
                                        <?php
                                            foreach($dni as $klucz => $dzien) {
                                                if($file == $dzien) $currentDay = $klucz;
                                            }

                                            $fieldsToAdd = 0;
                                            for($currentDay; $currentDay > 1; $currentDay--) {
                                                $fieldsToAdd++;
                                            }
                                        ?>
            
                                        <?php for($i = 1; $i <= $fieldsToAdd; $i++): ?>
                                        <div class="json flex flex-col bg-gray-300 h-20 shadow-md w-20 rounded-3xl mx-2 my-2 pointer-events-none">
                                            <div class="document-animation font-bold"></div>
                                        </div>                           
                                        <?php endfor; ?>
            
                                    <?php endif; ?>
            
                                    <?php if(isset($grafik)): ?>
                                        <?php $__currentLoopData = $grafik[0]['data']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $graf): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php if(($userStanowisko === 'Właściciel Hotelu' && in_array($graf['dzisiejszy dzien'], $uniqueData)) || ($userStanowisko !== 'Właściciel Hotelu' && $graf["status"] === "Pracuje")): ?>
                                            <?php if(($userStanowisko === 'Właściciel Hotelu')): ?>     
                                                <div class="json overflow-hidden select-none flex flex-col bg-green-400 h-20 shadow-md w-20 rounded-full mx-2 my-2 justify-center items-center">
                                            <?php else: ?>
                                                <div class="json overflow-hidden select-none flex flex-col bg-red-400 h-20 shadow-md w-20 rounded-full mx-2 my-2 justify-center items-center">
                                            <?php endif; ?>
                                                <div class="document font-bold hidden"><?php echo e($graf["rok"]); ?></div>
                                                <div class="document font-bold hidden"><?php echo e($graf["numer dni"]); ?></div>
                                                <div class="document font-bold hidden"><?php echo e($graf["miesiąc"]); ?></div>
                                                <div class="document text-xl"><?php echo e($graf["dzisiejszy dzien"]); ?></div>
                                                <div class="document font-bold hidden"><?php echo e($graf["nazwa dnia"]); ?></div>
                                                <div class="flex overflow-hidden">
                                                    <div class="document text-sm">
                                                        <?php if($userStanowisko === 'Właściciel Hotelu'): ?>
                                                            Pracuje
                                                        <?php else: ?>
                                                            <?php echo e($graf["status"]); ?>

                                                        <?php endif; ?>
                                                    </div>
                                                </div>                                            
                                            </div>
                                                <?php else: ?>
                                                    <?php if(($userStanowisko === 'Właściciel Hotelu')): ?>     
                                                        <div class="json overflow-hidden select-none flex flex-col bg-red-400 h-20 shadow-md w-20 rounded-full mx-2 my-2 justify-center items-center">
                                                    <?php else: ?>
                                                        <div class="json overflow-hidden select-none flex flex-col bg-green-400 h-20 shadow-md w-20 rounded-full mx-2 my-2 justify-center items-center">
                                                    <?php endif; ?>                                                        
                                                            <div class="document font-bold hidden"><?php echo e($graf["rok"]); ?></div>
                                                            <div class="document font-bold hidden"><?php echo e($graf["numer dni"]); ?></div>
                                                            <div class="document font-bold hidden"><?php echo e($graf["miesiąc"]); ?></div>
                                                            <div class="document text-xl"><?php echo e($graf["dzisiejszy dzien"]); ?></div>
                                                            <div class="document font-bold hidden"><?php echo e($graf["nazwa dnia"]); ?></div>
                                                        <div class="flex overflow-hidden">
                                                            <div class="document text-sm">
                                                                <?php if($userStanowisko === 'Właściciel Hotelu'): ?>
                                                                    Brak
                                                                <?php else: ?>
                                                                    <?php echo e($graf["status"]); ?>

                                                                <?php endif; ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                <?php endif; ?>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                
                                        <?php else: ?>
                                        <?php for($i = 1; $i <= $days; $i++): ?>
                                            <div class="json overflow-hidden select-none flex flex-col bg-gray-200 h-2 shadow-md w-200 rounded-full mx-2 my-2 justify-center items-center">
                                                <div class="document font-bold hidden"><?php echo e($year); ?></div>
                                                <div class="document font-bold hidden"><?php echo e($days); ?></div>
                                                <div class="document font-bold hidden"><?php echo e($month); ?></div>
            
                                                <div class="document text-xl"><?php echo e($i); ?></div>
                                                <div class="document font-bold hidden"><?php echo e($dayNames[$i]); ?></div>
                                                <div class="flex overflow-hidden">
                                                    <div class="document visible text-sm">Status</div>
                                                </div>
                                            </div>
                                        <?php endfor; ?>
                                    <?php endif; ?>
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
<?php /**PATH C:\Users\patry\Desktop\Hotel\Hotel\resources\views/home.blade.php ENDPATH**/ ?>