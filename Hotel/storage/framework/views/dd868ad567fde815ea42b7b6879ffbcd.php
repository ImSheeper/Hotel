<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

  <title>Personel</title>
  <?php echo app('Illuminate\Foundation\Vite')('resources/css/app.css'); ?>
  <?php echo app('Illuminate\Foundation\Vite')('resources/js/styles.js'); ?>
  
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

        
        <?php echo $__env->make('\Templates\sidebarTemplate', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

        
        <div class="flex flex-col h-full w-full ml-1 md:w-10/12 md:ml-0 overflow-hidden">
            
            <?php echo $__env->make('Templates\topMenuTemplate', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

            
            <div class="flex flex-col bg-white grow mx-1 my-1 mr-2 mb-2 min-w-fit rounded-md overflow-auto items-center">
                <div class="font-bold text-center mt-10 text-3xl">Wybierz grafik do edycji</div>
                <div class="flex h-2/6 w-full justify-center animate-fade-down animate-delay-[1s] animate-ease-out">

                    <div class="flex flex-col cursor-default mt-10 w-4/6 h-full bg-gray-200 rounded-2xl pl-10 pr-10 pt-5 pb-5 overflow-auto shadow-lg">
                        <div class="font-bold text-3xl mb-5">Personel</div>
                        <div class="grid grid-cols-4 font-bold px-2 py-1">
                            <div class="name">Imię i nazwisko</div>
                            <div class="name">Stanowisko</div>
                            <div class="name">Status</div>
                            <div class="name">Czas pracy</div>
                        </div>
                        <?php
                         $i = 0;
                        ?>

                        <?php $__currentLoopData = $personels; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $personel): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <a href='<?php echo e(route('personelParameterRoute', $personel->login)); ?>' class="tableClass cursor-pointer grid grid-cols-4 transition-all duration-300 hover:bg-gray-300 px-2 py-1 rounded-md">
                                <div class="className"> <?php echo e($personel->login); ?> </div>
                                <div class="class"> <?php echo e($personel->stanowisko); ?> </div>
                                <div class="class"> <?php echo e($personel->status); ?> </div>
                                <div class="class"> <?php echo e($timeOfWork[$i]); ?>h </div>
                            </a>
                            <?php
                                $i++;
                            ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>
                <div class="contextMenu hidden z-10 absolute bg-white px-2 py-2 shadow-md rounded-md opacity-0">
                    <a href='<?php echo e(route('personelParameterRoute', $personel->login)); ?>' class="menuRoute">
                        <div class="menuElement hover:bg-gray-100 transition-all duration-200 px-1 rounded-md cursor-pointer py-1">Zmień grafik</div>
                    </a>
                    <div class="menuElement hover:bg-gray-100 transition-all duration-200 px-1 rounded-md cursor-pointer py-1">Edytuj Użytkownika</div>
                    <div class="menuElement hover:bg-gray-100 transition-all duration-200 px-1 rounded-md cursor-pointer py-1">Usuń użytkownika</div>
                </div>
            </div>
            
        </div>
    </div>
</body>
</html>
<?php /**PATH C:\Users\patry\Desktop\Inzynier\Hotel\resources\views/personel.blade.php ENDPATH**/ ?>