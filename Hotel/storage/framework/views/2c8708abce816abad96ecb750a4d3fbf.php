<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

  <title>Grafik użytkownika <?php echo e($login); ?></title>
  <?php echo app('Illuminate\Foundation\Vite')('resources/css/app.css'); ?>
  <?php echo app('Illuminate\Foundation\Vite')('resources/js/animations.js'); ?>
  <?php echo app('Illuminate\Foundation\Vite')('resources/js/dates.js'); ?>
  
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
                <div class="font-bold text-center mt-10 text-3xl">Grafik użytkownika <?php echo e($login); ?></div>
                <div class="flex h-min-max w-full justify-center animate-fade-down animate-delay-[1s] animate-ease-out mt-10 flex-wrap">
                    <div class="grid grid-cols-7">
                        
                        
                            <?php if(isset($grafik)): ?>
                                <?php $__currentLoopData = $grafik['data']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $graf): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php if($graf["status"] === "Pracuje"): ?>
                                            <div class="json overflow-hidden select-none flex flex-col bg-red-400 h-32 shadow-md w-32 rounded-full mx-2 my-2 justify-center items-center">
                                                <div class="document font-bold hidden"><?php echo e($graf["rok"]); ?></div>
                                                <div class="document font-bold hidden"><?php echo e($graf["numer dni"]); ?></div>
                                                <div class="document font-bold hidden"><?php echo e($graf["miesiąc"]); ?></div>
                                                <div class="document font-bold text-3xl"><?php echo e($graf["dzisiejszy dzien"]); ?></div>
                                                <div class="document font-bold hidden"><?php echo e($graf["nazwa dnia"]); ?></div>
                                                <div class="flex overflow-hidden">
                                                    <div class="document"><?php echo e($graf["status"]); ?></div>
                                                </div>                                            </div>
                                        <?php else: ?>
                                            <div class="json overflow-hidden select-none flex flex-col bg-green-400 h-32 shadow-md w-32 rounded-full mx-2 my-2 justify-center items-center">
                                                <div class="document font-bold hidden"><?php echo e($graf["rok"]); ?></div>
                                                <div class="document font-bold hidden"><?php echo e($graf["numer dni"]); ?></div>
                                                <div class="document font-bold hidden"><?php echo e($graf["miesiąc"]); ?></div>
                                                <div class="document font-bold text-3xl"><?php echo e($graf["dzisiejszy dzien"]); ?></div>
                                                <div class="document font-bold hidden"><?php echo e($graf["nazwa dnia"]); ?></div>
                                                <div class="flex overflow-hidden">
                                                    <div class="document"><?php echo e($graf["status"]); ?></div>
                                                </div>
                                            </div>
                                        <?php endif; ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                            <?php else: ?>
                                <?php for($i = 1; $i <= $days; $i++): ?>
                                    <div class="json select-none flex flex-col bg-gray-200 h-32 shadow-md w-32 rounded-2xl mx-2 my-2">
                                        <div class="document font-bold hidden"><?php echo e($year); ?></div>
                                        <div class="document font-bold hidden"><?php echo e($days); ?></div>
                                        <div class="document font-bold hidden"><?php echo e($month); ?></div>

                                        <div class="document font-bold"><?php echo e($i); ?></div>
                                        <div class="document font-bold"><?php echo e($dayNames[$i]); ?></div>
                                        <div class="document font-bold"></div>
                                    </div>
                                <?php endfor; ?>
                            <?php endif; ?>
                    </div>
                </div>
                <div class="warnUser text-red-500 bold text-lg invisible mt-10 mb-10">Zaktualizowano grafik.</div>
                <div class="flex relative group rounded-2xl mb-10">
                    <div class="flex relative group h-12">
                        <button class="but bg-gray-200 w-36 h-12 min-w-max rounded-2xl text-lg opcaity-100 transition-all duration-200 group-hover:opacity-0">Zapisz</button>
                        <button class="but absolute bg-gradient-to-r from-cyan-400 to-fuchsia-400 w-36 h-12 min-w-max rounded-2xl text-lg transition-all duration-200 opacity-0 group-hover:opacity-100 text-white">Zapisz</button>
                    </div>
                </div>
            </div>
            
        </div>
    </div>
</body>
</html>
<?php /**PATH C:\Users\patry\Desktop\Inzynier\Hotel\resources\views/grafik.blade.php ENDPATH**/ ?>