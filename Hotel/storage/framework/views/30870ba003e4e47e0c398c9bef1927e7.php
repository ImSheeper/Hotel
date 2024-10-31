<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

  <title>Personel</title>
  <?php echo app('Illuminate\Foundation\Vite')('resources/css/app.css'); ?>
  <?php echo app('Illuminate\Foundation\Vite')('resources/js/pokojeStyles.js'); ?>
  
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
                            <?php $__currentLoopData = $rooms; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $room): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php if($room->wykluczone === 0): ?>
                                    <a class="tableClass cursor-pointer grid grid-cols-5 transition-all duration-300 hover:bg-gray-300 px-2 py-1 rounded-md">
                                    <div class="pokoje"> <?php echo e($room->id_numer_pokoju); ?> </div>
                                    <div class="pokoje"> <?php echo e($room->pietro); ?> </div>
                                    <div class="pokoje"> <?php echo e($room->status ? 'Zajęte' : 'Wolne'); ?> </div>
                                    <div class="pokoje"> <?php echo e($room->czyste ? 'Czysty' : 'Brudny'); ?> </div>
                                    <div class="pokoje"> <?php echo e($room->wykluczone ? 'Wykluczony' : 'Aktywny'); ?> </div>
                                    </a>
                                <?php endif; ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
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
                    <div class="menuElement hover:bg-gray-100 transition-all duration-200 px-1 rounded-md cursor-pointer py-1">Edytuj Pokój</div>
                    <div class="menuElement hover:bg-gray-100 transition-all duration-200 px-1 rounded-md cursor-pointer py-1">Wyklucz pokój</div>
                </div>

                <div class="contextMenuBlocked hidden z-10 absolute bg-white px-2 py-2 shadow-md rounded-md opacity-0">
                    <div class="menuElementBlocked hover:bg-gray-100 transition-all duration-200 px-1 rounded-md cursor-pointer py-1">Edytuj Pokój</div>
                    <div class="menuElementBlocked hover:bg-gray-100 transition-all duration-200 px-1 rounded-md cursor-pointer py-1">Przywróć pokój</div>
                </div>
            </div>

            
            <div class="popPersonel bg-black bg-opacity-20 backdrop-blur-sm flex absolute invisible h-full w-full justify-center items-center opacity-0">
                <div class="pop2Personel flex flex-col bg-white w-[500px] min-h-max rounded-lg justify-center p-5">
                    <script>
                    </script>
                
                    <div class="popText text-2xl font-bold text-center">Edytuj pokój [numer]</div>

                    <img src=<?php echo e(url('/icons/Account.svg')); ?> class="h-24 mt-2 p-2">

                    <div class="flex justify-between w-full mt-2">
                        <div class="flex justify-center flex-col w-[50%] p-2">
                            <div class="mb-1 text-gray-700">Pokój</div>
                            <input type="text" placeholder="Pokój" class="data border-2 rounded-lg p-1">
                        </div>
                        <div class="flex justify-center flex-col w-[50%] p-2">
                            <div class="mb-1 text-gray-700">Piętro</div>
                            <input type="text" placeholder="Piętro" class="data border-2 rounded-lg p-1">
                        </div>
                    </div>

                    <div class="flex justify-around w-full mt-2">
                        <div class="flex justify-center flex-col w-full p-2">
                            <div class="mb-1 text-gray-700">Status</div>
                            <input type="text" placeholder="Status" class="data border-2 rounded-lg p-1 w-full">
                        </div>
                    </div>

                    <div class="flex justify-around w-full mt-2">
                        <div class="flex justify-center flex-col w-full p-2">
                            <div class="mb-1 text-gray-700">Czysty</div>
                            <input type="text" placeholder="Czysty" class="data border-2 rounded-lg p-1 w-full">
                        </div>
                    </div>

                    <div class="flex justify-around w-full mt-2">
                        <div class="flex justify-center flex-col w-full p-2">
                            <div class="mb-1 text-gray-700">Wykluczony</div>
                            <input type="text" placeholder="Wykluczony" class="data border-2 rounded-lg p-1 w-full">
                            </select>
                        </div>
                    </div>

                    <div class="flex flex-col items-center justify-center w-full">
                        <div class="flex relative group rounded-2xl mb-4 mt-6">
                            <div class="flex relative group h-12">
                                <button class="sendAjax bg-gray-200 w-36 h-12 min-w-max rounded-2xl text-lg opcaity-100 transition-all duration-200 group-hover:opacity-0">Zapisz</button>
                                <button class="sendAjax absolute bg-gradient-to-r from-cyan-400 to-fuchsia-400 w-36 h-12 min-w-max rounded-2xl text-lg transition-all duration-200 opacity-0 group-hover:opacity-100 text-white">Zapisz</button>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

            
        <div class="popDelete bg-black bg-opacity-20 backdrop-blur-sm flex absolute invisible h-full w-full justify-center items-center opacity-0">
            <div class="pop2Delete flex flex-col bg-white w-[500px] min-h-max rounded-lg justify-center p-5">

            <div class="popTextDelete text-2xl font-bold text-center">Wykluczyć pokój [nazwa]?</div>

            <div class="flex items-center justify-evenly px-10 w-full">
                <div class="flex relative group rounded-2xl mb-4 mt-6">
                    <div class="flex relative group h-12 mx-5">
                        <button class="butYes bg-gray-200 w-36 h-12 min-w-max rounded-2xl text-lg opcaity-100 transition-all duration-200 group-hover:opacity-0">Tak</button>
                        <button class="butYes absolute bg-gradient-to-r from-red-400 to-orange-400 w-36 h-12 min-w-max rounded-2xl text-lg transition-all duration-200 opacity-0 group-hover:opacity-100 text-white">Tak</button>
                    </div>
                </div>
                <div class="flex relative group rounded-2xl mb-4 mt-6">
                    <div class="flex relative group h-12 mx-5">
                        <button class="butNo bg-gray-200 w-36 h-12 min-w-max rounded-2xl text-lg opcaity-100 transition-all duration-200 group-hover:opacity-0">Nie</button>
                        <button class="butNo absolute bg-gradient-to-r from-cyan-400 to-fuchsia-400 w-36 h-12 min-w-max rounded-2xl text-lg transition-all duration-200 opacity-0 group-hover:opacity-100 text-white">Nie   </button>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </div>
</body>
</html>
<?php /**PATH /home/sheeper/Desktop/Hotel/Hotel/resources/views/pokoje.blade.php ENDPATH**/ ?>