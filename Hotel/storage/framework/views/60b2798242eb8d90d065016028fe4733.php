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
                <div class="flex flex-wrap justify-center my-5 md:my-10">
                    <div class="font-bold shadow-lg mx-10 bg-gray-200 h-44 w-44 rounded-2xl overflow-hidden content-center text-center my-5 md:my-10 animate-fade-down animate-delay-[0.2s] animate-ease-out">
                        <div class="text-6xl">35</div>
                        <div class="text-xl">Brudne pokoje</div>
                    </div>
                    <div class="font-bold shadow-lg mx-10 bg-gray-200 h-44 w-44 rounded-2xl overflow-hidden content-center text-center my-5 md:my-10 animate-fade-down animate-delay-[0.4s] animate-ease-out">
                        <div class="text-6xl">21</div>
                        <div class="text-xl">Czyste pokoje</div>
                    </div>
                    <div class="font-bold shadow-lg mx-10 bg-gray-200 h-44 w-44 rounded-2xl overflow-hidden content-center text-center my-5 md:my-10 animate-fade-down animate-delay-[0.6s] animate-ease-out">
                        <div class="text-6xl">12</div>
                        <div class="text-xl">Ilość w magazynie</div>
                    </div>
                    <div class="font-bold shadow-lg mx-10 bg-gray-200 h-44 w-44 rounded-2xl overflow-hidden content-center text-center my-5 md:my-10 animate-fade-down animate-delay-[0.8s] animate-ease-out">
                        <div class="text-6xl">20</div>
                        <div class="text-xl">Pracowników</div>
                    </div>
                </div>
                <div class="flex h-2/6 w-full justify-center animate-fade-down animate-delay-[1s] animate-ease-out">
                    <div class="flex flex-col min-w-max max-w-[1000px] grow mx-10 h-full bg-gray-200 rounded-2xl pl-10 pp-10 pt-5 pb-5 overflow-auto shadow-lg">
                        <div class="font-bold text-3xl mb-5">Personel</div>
                        <div class="grid grid-cols-3 font-bold">
                            <div class="class">Imię i nazwisko</div>
                            <div class="class">Stanowisko</div>
                            <div class="class">Status</div>
                        </div>
                        <?php $__currentLoopData = $personels; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $personel): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="grid grid-cols-3">
                            <div class="class"> <?php echo e($personel->login); ?> </div>
                            <div class="class"> <?php echo e($personel->stanowisko); ?> </div>
                            <div class="class"> <?php echo e($personel->status); ?> </div>
                        </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
<?php /**PATH /home/sheeper/Desktop/Hotel/Hotel/resources/views/home.blade.php ENDPATH**/ ?>