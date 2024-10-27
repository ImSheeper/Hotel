<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

  <title>Personel</title>
  <?php echo app('Illuminate\Foundation\Vite')('resources/css/app.css'); ?>
  <?php echo app('Illuminate\Foundation\Vite')('resources/js/styles.js'); ?>
  <?php echo app('Illuminate\Foundation\Vite')('resource/js/animations.js'); ?>
  <?php echo app('Illuminate\Foundation\Vite')('resource/js/pokojeStyles.js'); ?>
  
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

            
            <div class="flex flex-col bg-white grow mx-1 my-1 mr-2 mb-2 min-w-fit rounded-md overflow-auto items-center">
                <div class="font-bold text-center mt-10 text-3xl">Zarządzaj pokojami</div>

                <div class="flex min-h-max w-full justify-center animate-fade-down animate-delay-[1s] animate-ease-out my-5">
                    <div class="flex flex-col cursor-default min-w-max max-w-[1000px] grow max-h-96 bg-gray-200 rounded-2xl pl-10 pr-10 pt-5 pb-5 overflow-auto shadow-lg">
                        <div class="font-bold text-3xl mb-5">Aktywne pokoje</div>
                        <div class="grid grid-cols-5 font-bold px-2 py-1">
                            <div class="name">Pokój</div>
                            <div class="name">Piętro</div>
                            <div class="name">Status</div>
                            <div class="name">Czysty</div>
                            <div class="name">Wykluczony</div>
                        </div>
                        <div class="grid grid-cols-5 px-2 py-1">
                            <?php $__currentLoopData = $rooms; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $room): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php if($room->wykluczone === 0): ?>
                                    
                                    <div class="pokoje"> <?php echo e($room->id_numer_pokoju); ?> </div>
                                    <div class="pokoje"> <?php echo e($room->pietro); ?> </div>
                                    <div class="pokoje"> <?php echo e($room->status ? 'Zajęte' : 'Wolne'); ?> </div>
                                    <div class="pokoje"> <?php echo e($room->czyste ? 'Czysty' : 'Brudny'); ?> </div>
                                    <div class="pokoje"> <?php echo e($room->wykluczone ? 'Wykluczony' : 'Aktywny'); ?> </div>
                                    
                                <?php endif; ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    </div>
                </div>

                <div class="flex min-h-max w-full justify-center animate-fade-down animate-delay-[1s] animate-ease-out my-5">
                    <div class="flex flex-col cursor-default min-w-max max-w-[1000px] grow max-h-96 bg-gray-200 rounded-2xl pl-10 pr-10 pt-5 pb-5 overflow-auto shadow-lg">
                        <div class="font-bold text-3xl mb-5">Wykluczone pokoje</div>
                        <div class="grid grid-cols-5 font-bold px-2 py-1">
                            <div class="name">Pokój</div>
                            <div class="name">Piętro</div>
                            <div class="name">Status</div>
                            <div class="name">Czysty</div>
                            <div class="name">Wykluczony</div>
                        </div>
                        <div class="grid grid-cols-5 px-2 py-1">
                            <?php $__currentLoopData = $rooms; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $room): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php if($room->wykluczone === 1): ?>
                                    
                                    <div class="pokoje"> <?php echo e($room->id_numer_pokoju); ?> </div>
                                    <div class="pokoje"> <?php echo e($room->pietro); ?> </div>
                                    <div class="pokoje"> <?php echo e($room->status ? 'Zajęte' : 'Wolne'); ?> </div>
                                    <div class="pokoje"> <?php echo e($room->czyste ? 'Czysty' : 'Brudny'); ?> </div>
                                    <div class="pokoje"> <?php echo e($room->wykluczone ? 'Wykluczony' : 'Aktywny'); ?> </div>
                                    
                                <?php endif; ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    </div>
                </div>

                <div class="contextMenu hidden z-10 absolute bg-white px-2 py-2 shadow-md rounded-md opacity-0">
                    
                        <div class="menuElement hover:bg-gray-100 transition-all duration-200 px-1 rounded-md cursor-pointer py-1">Zmień grafik</div>
                    
                    <div class="menuElement hover:bg-gray-100 transition-all duration-200 px-1 rounded-md cursor-pointer py-1">Edytuj Użytkownika</div>
                    <div class="menuElement hover:bg-gray-100 transition-all duration-200 px-1 rounded-md cursor-pointer py-1">Zablokuj użytkownika</div>
                </div>

                <div class="contextMenuBlocked hidden z-10 absolute bg-white px-2 py-2 shadow-md rounded-md opacity-0">
                    <div class="menuElementBlocked hover:bg-gray-100 transition-all duration-200 px-1 rounded-md cursor-pointer py-1">Edytuj Użytkownika</div>
                    <div class="menuElementBlocked hover:bg-gray-100 transition-all duration-200 px-1 rounded-md cursor-pointer py-1">Odblokuj użytkownika</div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
<?php /**PATH /home/sheeper/Desktop/Hotel/Hotel/resources/views/pokoje.blade.php ENDPATH**/ ?>