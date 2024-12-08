<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Strona główna</title>
  <?php echo app('Illuminate\Foundation\Vite')('resources/css/app.css'); ?>
  <?php echo app('Illuminate\Foundation\Vite')('resources/js/animations.js'); ?>
  
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

        
        <div class="flex flex-col h-full w-full ml-1 md:ml-0 overflow-hidden">
            
            <?php echo $__env->make('Templates.topMenuTemplate', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

            
            <div class="flex flex-col bg-white grow mx-1 my-1 mr-2 mb-2 min-w-fit rounded-md overflow-auto">
                
                
                <div class="flex flex-col grow h-1/2 max-h-1/2 max-w-1/2">
                    <div class="flex w-full h-full">
                        
                        <div class="flex flex-col w-1/3 h-full p-5 min-w-[200px] max-w-[200px]">
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
                        
                        <div class="flex flex-col w-2/3 h-full pr-5 pt-5 pb-5">
                            <div class="bg-[#F4F2FF] rounded-md shadow-lg overflow-auto p-5 h-full min-w-max">
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
                                        <a href='' class="tableClass cursor-pointer grid grid-cols-2 transition-all duration-300 hover:bg-gray-300 px-2 py-1 rounded-md text-sm">
                                            <div class="className hidden"> <?php echo e($personel->login); ?> </div>
                                            <div class="class"> <?php echo e($personel->imie); ?>  <?php echo e($personel->nazwisko); ?> </div>
                                            <div class="class"> <?php echo e($personel->stanowiska->stanowisko); ?> </div>
                                        </a>
                                    <?php endif; ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                        </div>

                        
                        <div class="flex flex-col w-1/3 h-full p-5 pl-0 min-w-max">
                            <div class="flex flex-col bg-[#F4F2FF] shadow-lg rounded-md grow p-5 overflow-auto">
                                <div class="flex items-center mb-5">
                                    <img src=<?php echo e(url('/icons/Account.svg')); ?> class="z-10 transition duration-500 opacity-100 group-hover:opacity-0 h-6">
                                    <div class="font-bold text-2xl px-2">Moje konto</div>
                                </div>
                                <hr class="border-t border-gray-600 mb-5 h-1">

                                <img src=<?php echo e(url('/icons/Account.svg')); ?> class="z-10 transition duration-500 opacity-100 group-hover:opacity-0 h-20 mb-5">
                                <div class="span"><b>Imię:</b> <?php echo e($currentUser->imie); ?></div>
                                <div class="span"><b>Nazwisko:</b> <?php echo e($currentUser->nazwisko); ?></div>
                                <div class="span"><b>Login:</b> <?php echo e($login); ?></div>
                                <div class="span"><b>Numer telefonu:</b> <?php echo e($currentUser->nrTel); ?></div>
                                <div class="span"><b>E-mail:</b> <?php echo e($currentUser->email); ?></div>
                                <div class="span"><b>Stanowisko:</b> <?php echo e($currentUser->stanowiska->stanowisko); ?></div>                      
                            </div>
                        </div>

                        <div class="flex flex-col w-2/3 h-full pr-5 pt-5 pb-5">
                            <div class="bg-[#F4F2FF] rounded-md shadow-lg overflow-auto p-5 h-full min-w-[300px]">
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
                                    <div class="tableClass cursor-pointer grid grid-cols-3 transition-all duration-300 hover:bg-gray-300 px-2 py-1 rounded-md text-sm gap-x-px">
                                        <div class="magazyn"><?php echo e($item->produkt->nazwa); ?> </div>
                                        <div class="magazyn"><?php echo e($item->ilosc); ?> </div>
                                        <div class="magazyn"><?php echo e($item->data_waznosci); ?> </div>
                                    </div>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                
                
                <div class="flex flex-col grow h-1/2 max-h-1/2 max-w-1/2">
                    <div class="flex w-full h-full">
                               
                        <div class="flex flex-col w-full h-full pr-5 pb-5 pl-5">
                            <div class="bg-[#F4F2FF] rounded-md shadow-lg overflow-auto p-5 h-full min-w-max">
                                <div class="flex items-center mb-5">
                                    <img src=<?php echo e(url('/icons/Pokoje.svg')); ?> class="z-10 transition duration-500 opacity-100 group-hover:opacity-0 h-6">
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
                                <div class="roomsContainerBlocked">
                                    <?php $__currentLoopData = $rooms; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $room): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php if($room->wykluczone === 0): ?>
                                            <a class="tableClassBlocked cursor-pointer grid grid-cols-5 transition-all duration-300 hover:bg-gray-300 px-2 py-1 rounded-md text-sm">
                                            <div class="pokoje"> <?php echo e($room->id); ?> </div>
                                            <div class="pokoje"> <?php echo e($room->pietro); ?> </div>
                                            <div class="pokoje"> <?php echo e($room->status ? 'Zajęte' : 'Wolne'); ?> </div>
                                            <div class="pokoje"> <?php echo e($room->czyste ? 'Czysty' : 'Brudny'); ?> </div>
                                            <div class="pokoje"> <?php echo e($room->wykluczone ? 'Wykluczony' : 'Aktywny'); ?> </div>
                                            </a>
                                        <?php endif; ?>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </div>
                            </div>
                        </div>

                        
                        <div class="flex flex-col w-full h-full pr-5 pb-5">
                            <div class="bg-[#F4F2FF] rounded-md shadow-lg overflow-auto p-5 h-full min-w-[300px]">
                                <div class="flex items-center mb-5">
                                    <img src=<?php echo e(url('/icons/Magazyn.svg')); ?> class="z-10 transition duration-500 opacity-100 group-hover:opacity-0 h-5">
                                    <div class="font-bold text-2xl px-2">Grafik</div>
                                </div>
                                
                                <hr class="border-t border-gray-600 mb-5">

                                <span>Prace trwają!</span>
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