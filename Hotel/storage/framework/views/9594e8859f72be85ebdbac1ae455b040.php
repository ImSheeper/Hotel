<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

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

            
            <div class="flex flex-col bg-white grow lg:ml-1 ml-2 my-1 mr-2 mb-2 min-w-fit rounded-md overflow-auto">
                
                
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
                                    <img src=<?php echo e(url('/icons/Personel.svg')); ?> class="transition duration-500 opacity-100 group-hover:opacity-0 h-6">
                                    <div class="font-bold text-2xl px-2">Pracowników dzisiaj (<?php echo e($statusesCount); ?>)</div>
                                </div>
                                
                                <hr class="border-t border-gray-600 mb-5">
                                <div class="grid grid-cols-3 font-bold px-2 py-1 text-sm">
                                    <div class="name">Imię i nazwisko</div>
                                    <div class="name">Stanowisko</div>
                                    <div class="name">Zmiana</div>
                                </div>
                                <?php $__currentLoopData = $personels; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $personel): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php if($statuses[$personel->imie] === '1. zmiana' || $statuses[$personel->imie] === '2. zmiana'): ?>
                                        <div class="tableClass grid grid-cols-3 transition-all duration-300 px-2 py-1 rounded-md text-sm">
                                            <div class="className hidden"> <?php echo e($personel->login); ?> </div>
                                            <div class="class"> <?php echo e($personel->imie); ?>  <?php echo e($personel->nazwisko); ?> </div>
                                            <div class="class"> <?php echo e($personel->stanowiska->stanowisko); ?> </div>
                                            <div class="class"> <?php echo e($statuses[$personel->imie]); ?> </div>
                                        </div>
                                    <?php endif; ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                        </div>

                        
                        <div class="flex flex-col w-1/6 h-full basis-[200px] grow">
                            <div class="flex flex-col bg-[#F4F2FF] shadow-lg rounded-md grow p-5 overflow-auto">
                                <div class="flex items-center mb-5">
                                    <img src=<?php echo e(url('/icons/Account.svg')); ?> class="transition duration-500 opacity-100 group-hover:opacity-0 h-6">
                                    <div class="font-bold text-2xl px-2">Moje konto</div>
                                </div>
                                <hr class="border-t border-gray-600 mb-5 h-1">

                                <img src=<?php echo e(url('/icons/Account.svg')); ?> class="transition duration-500 opacity-100 group-hover:opacity-0 h-20 mb-5">
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
                                        <img src=<?php echo e(url('/icons/Magazyn.svg')); ?> class="transition duration-500 opacity-100 group-hover:opacity-0 h-5">
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
                                        <img src=<?php echo e(url('/icons/Pokoje.svg')); ?> class="transition duration-500 opacity-100 group-hover:opacity-0 h-6">
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
                                    <img src=<?php echo e(url('/icons/calendar.svg')); ?> class="transition duration-500 opacity-100 group-hover:opacity-0 h-5">
                                    <div class="font-bold text-2xl px-2">Grafik na <?php echo e($currentMonth); ?> <?php echo e($year); ?></div>
                                </div>
                                
                                <div class="flex group mb-5">
                                    <select class='select border-2 rounded-lg p-1 text-sm'> 
                                        <?php $__currentLoopData = $stanowiska; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $stanowisko): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option> <?php echo e($stanowisko->stanowisko); ?> </option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </div>

                                <hr class="border-t border-gray-600 mb-5">

                                <div id="grafik" class="grid grid-cols-7 z-10 place-items-center">
                                    <?php echo $__env->make('Templates.grafikTemplateHome', ['grafik' => $grafik], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
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
<?php /**PATH C:\Users\patry\Desktop\Inzynier\Hotel\resources\views/home.blade.php ENDPATH**/ ?>