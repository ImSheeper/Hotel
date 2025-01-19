<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

  <title>Grafik użytkownika <?php echo e($login); ?></title>
  <?php echo app('Illuminate\Foundation\Vite')('resources/css/app.css'); ?>
  <?php echo app('Illuminate\Foundation\Vite')('resources/js/animationsGrafik.js'); ?>
  <?php echo app('Illuminate\Foundation\Vite')('resources/js/dates.js'); ?>
  <?php echo app('Illuminate\Foundation\Vite')('resources/js/afterClickArrow.js'); ?>
  
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

                    <div class="flex flex-col z-10 w-full">
                        <div class="flex items-center group justify-start mx-[18%]">
                            <img src=<?php echo e(url('icons/calendar.svg')); ?> class="h-12 ml-2">
                            <input value="<?php echo e($year); ?>-<?php echo e($month); ?>" class="date text-5xl h-24 font-bold ml-2 leading-loose capitalize group border-none outline-none"></input>
                        </div>

                        <div class="flex items-center group justify-start mx-[19%]">
                            <select class='select border-2 rounded-lg p-1'> 
                                <?php $__currentLoopData = $stanowiska; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $stanowisko): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option> <?php echo e($stanowisko->stanowisko); ?> </option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>

                    </div>

                    <div id="grafik" class="grid grid-cols-7 z-10">
                        <?php echo $__env->make('Templates.grafikTemplate', ['grafik' => $grafik], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
<?php /**PATH C:\Users\patry\Desktop\Inzynier\Hotel\resources\views/grafikWhole.blade.php ENDPATH**/ ?>