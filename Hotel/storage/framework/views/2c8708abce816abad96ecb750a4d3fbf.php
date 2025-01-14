<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

  <title>Grafik użytkownika <?php echo e($login); ?></title>
    <?php echo app('Illuminate\Foundation\Vite')('resources/css/app.css'); ?>

    <?php if($userStanowisko === 'Właściciel Hotelu' || $userStanowisko === 'Menedżer Hotelu'): ?>
        <?php echo app('Illuminate\Foundation\Vite')('resources/js/animations.js'); ?>
        <?php echo app('Illuminate\Foundation\Vite')('resources/js/afterClickArrow.js'); ?> 
    <?php endif; ?>

    <?php echo app('Illuminate\Foundation\Vite')('resources/js/dates.js'); ?>
  
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/plugins/monthSelect/style.css">
  <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
  <script src="https://cdn.jsdelivr.net/npm/flatpickr/dist/plugins/monthSelect/index.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/flatpickr/dist/l10n/pl.js"></script>

  <script src="https://cdn.jsdelivr.net/npm/@simondmc/popup-js@1.4.3/popup.min.js"></script>
  
    <style>
        body, html {
            color: rgb(31 41 55);
        }

        .background {
            background-image: url('/images/Background.png');
            background-size: cover;
            background-color: black;
        }
        
        .svg-icon {
            filter: invert(20%) sepia(10%) saturate(500%) hue-rotate(260deg) brightness(90%) contrast(90%);
        }
    </style>
</head>
<body>
    <div class="background flex h-screen overflow-hidden">

        
        <?php echo $__env->make('Templates.sidebarTemplate', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

        
        <div class="flex flex-col h-full w-full ml-1 md:ml-0 overflow-hidden">
            
            <?php echo $__env->make('Templates.topMenuTemplate', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

            
            <div class="flex flex-col bg-white grow mx-1 my-1 mr-2 mb-2 min-w-fit rounded-md overflow-auto items-center w-min-max">
                <div class="flex h-min-max w-full justify-center animate-fade-down animate-delay-[1s] animate-ease-out mt-10 flex-wrap">
                    
                    <?php if($userStanowisko === 'Właściciel Hotelu' || $userStanowisko === 'Menedżer Hotelu'): ?>
                        <div class="flex absolute h-full w-full items-center z-0">
                            <div class="flex relative w-full justify-start items-center">
                                <div class="svg-flex flex ml-16 px-6 select-none cursor-pointer">
                                    <img src=<?php echo e(url('icons/leftArrow.svg')); ?> class='svg-icon h-14'>
                                </div>
                                <div class="previousMonth text-4xl font-bold invisible opacity-0 pointer-events-none select-none"><?php echo e(Str::title($datePrevious)); ?></div>
                            </div>
                            <div class="flex relative w-full justify-end items-center">
                                <div class="nextMonth text-4xl font-bold opacity-0 invisible pointer-events-none select-none"><?php echo e(Str::title($dateNext)); ?></div>
                                <div class="svg-flex flex mr-14 px-6 select-none cursor-pointer">
                                    <img src=<?php echo e(url('icons/rightArrow.svg')); ?> class='svg-icon h-14'>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>

                    <div class="grid grid-cols-7 z-10">
                        <div class="flex w-min-max col-span-7 items-center group max-w-[50%]">
                            <img src=<?php echo e(url('icons/calendar.svg')); ?> class="h-12 ml-2">
                            <input value="<?php echo e($year); ?>-<?php echo e($month); ?>" class="date text-5xl h-24 font-bold ml-2 leading-loose capitalize group border-none outline-none"></input>
                        </div>

                        <?php if(isset($grafik)): ?>
                            <?php 
                                $file = $grafik['data'][0]['nazwa dnia'];
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
                            <div class="document-animation font-bold mx-2 my-2 text-center text-xl select-none"><?php echo e($dzien); ?></div>
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
                                <div class="json flex flex-col bg-gray-300 h-32 shadow-md w-32 rounded-3xl mx-2 my-2 pointer-events-none">
                                    <div class="document-animation font-bold"></div>
                                </div>                           
                                <?php endfor; ?>

                            <?php endif; ?>

                        <?php if(isset($grafik)): ?>
                            <?php $__currentLoopData = $grafik['data']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $graf): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php if($graf["status"] === "1. zmiana" || $graf["status"] === "2. zmiana"): ?>
                                        <div class="json overflow-hidden select-none flex flex-col bg-red-400 h-32 shadow-md w-32 rounded-full mx-2 my-2 justify-center items-center">
                                            <div class="document font-bold hidden"><?php echo e($graf["rok"]); ?></div>
                                            <div class="document font-bold hidden"><?php echo e($graf["numer dni"]); ?></div>
                                            <div class="document font-bold hidden"><?php echo e($graf["miesiąc"]); ?></div>
                                            <div class="document text-3xl"><?php echo e($graf["dzisiejszy dzien"]); ?></div>
                                            <div class="document font-bold hidden"><?php echo e($graf["nazwa dnia"]); ?></div>
                                            <div class="document font-bold hidden"><?php echo e($graf["stanowisko"]); ?></div>
                                            <div class="document font-bold hidden"><?php echo e($graf["login"]); ?></div>
                                            <div class="flex overflow-hidden">
                                                <div class="document"><?php echo e($graf["status"]); ?></div>
                                            </div>                                            
                                        </div>
                                    <?php elseif($graf["status"] === "Wolne"): ?>
                                        <div class="json overflow-hidden select-none flex flex-col bg-green-400 h-32 shadow-md w-32 rounded-full mx-2 my-2 justify-center items-center">
                                            <div class="document font-bold hidden"><?php echo e($graf["rok"]); ?></div>
                                            <div class="document font-bold hidden"><?php echo e($graf["numer dni"]); ?></div>
                                            <div class="document font-bold hidden"><?php echo e($graf["miesiąc"]); ?></div>
                                            <div class="document text-3xl"><?php echo e($graf["dzisiejszy dzien"]); ?></div>
                                            <div class="document font-bold hidden"><?php echo e($graf["nazwa dnia"]); ?></div>
                                            <div class="document font-bold hidden"><?php echo e($graf["stanowisko"]); ?></div>
                                            <div class="document font-bold hidden"><?php echo e($graf["login"]); ?></div>
                                            <div class="flex-col overflow-hidden">
                                                <div class="document"><?php echo e($graf["status"]); ?></div>
                                            </div>
                                        </div>
                                    <?php endif; ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                        <?php else: ?>
                            <?php for($i = 1; $i <= $days; $i++): ?>
                                <div class="json overflow-hidden select-none flex flex-col bg-gray-200 h-32 shadow-md w-32 rounded-full mx-2 my-2 justify-center items-center">
                                    <div class="document font-bold hidden"><?php echo e($year); ?></div>
                                    <div class="document font-bold hidden"><?php echo e($days); ?></div>
                                    <div class="document font-bold hidden"><?php echo e($month); ?></div>

                                    <div class="document text-3xl"><?php echo e($i); ?></div>
                                    <div class="document font-bold hidden"><?php echo e($dayNames[$i]); ?></div>
                                    <div class="document font-bold hidden"><?php echo e($userStanowisko); ?></div>
                                    <div class="document font-bold hidden"><?php echo e($login); ?></div>
                                    <div class="flex-col overflow-hidden">
                                        <div class="document visible">Status</div>
                                    </div>
                                </div>
                            <?php endfor; ?>
                        <?php endif; ?>
                    </div>
                </div>

                <?php if($userStanowisko === 'Właściciel Hotelu' || $userStanowisko === 'Menedżer Hotelu'): ?>

                    <div class="flex flex-col items-center justify-center w-full">
                        <div class="flex relative group rounded-2xl mb-10 mt-10">
                            <div class="flex relative group h-12">
                                <button class="but bg-[#F4F2FF] w-36 h-12 min-w-max rounded-2xl text-lg opcaity-100 transition-all duration-200 group-hover:opacity-0">pisz</button>
                                <button class="but absolute bg-gradient-to-r from-cyan-400 to-fuchsia-400 w-36 h-12 min-w-max rounded-2xl text-lg transition-all duration-200 opacity-0 group-hover:opacity-100 text-white">Zapisz</button>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
        <div class="pop bg-black bg-opacity-20 backdrop-blur-sm flex absolute invisible h-full w-full justify-center items-center opacity-0">
            <div class="pop2 flex flex-col bg-white w-[500px] min-h-max rounded-lg items-center justify-center p-5">
                <div class="text-2xl mb-5">Grafik został zaktualizowany.</div>
                <div class="flex relative group h-12">
                    <button class="close bg-[#F4F2FF] w-36 h-10 min-w-max rounded-2xl text-lg opcaity-100 transition-all duration-200 group-hover:opacity-0 shadow-lg">Zamknij</button>
                    <button class="close absolute bg-gradient-to-r from-cyan-400 to-fuchsia-400 w-36 h-10 min-w-max rounded-2xl text-lg transition-all duration-200 opacity-0 group-hover:opacity-100 text-white">Zamknij</button>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
<?php /**PATH C:\Users\patry\Desktop\Inzynier\Hotel\resources\views/grafik.blade.php ENDPATH**/ ?>