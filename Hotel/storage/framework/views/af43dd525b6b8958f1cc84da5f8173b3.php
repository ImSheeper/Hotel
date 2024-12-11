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

        
        <?php echo $__env->make('Templates.sidebarTemplate', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

        
        <div class="flex flex-col h-full w-full ml-1 md:ml-0 overflow-hidden">
            
            <?php echo $__env->make('Templates.topMenuTemplate', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

            
            <div class="flex flex-col bg-white grow mx-1 my-1 mr-2 mb-2 min-w-fit rounded-md overflow-auto items-center">
                <div class="font-bold text-center mt-10 text-3xl">Zarządzaj personelem</div>

                <div class="flex min-h-max w-full justify-center animate-fade-down animate-delay-[1s] animate-ease-out my-5">
                    <div class="flex flex-col cursor-default min-w-max max-w-[1000px] grow max-h-96 bg-gray-200 rounded-2xl pl-10 pr-10 pt-5 pb-5 overflow-auto shadow-lg">
                        <div class="font-bold text-3xl mb-5">Aktywny personel</div>
                        <div class="grid grid-cols-5 font-bold px-2 py-1">
                            <div class="name">Imię i nazwisko</div>
                            <div class="name">Stanowisko</div>
                            <div class="name">Status</div>
                            <div class="name">Czas pracy</div>
                            <div class="name">Zablokowany</div>
                        </div>
                        <?php
                         $i = 0;
                        ?>

                        <?php $__currentLoopData = $personels; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $personel): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php if($personel->zablokowany === 0): ?>
                                <a href='<?php echo e(route('personelParameterRoute', ['login' => $personel->login, 'month' => $month, 'year' => $year])); ?>' class="tableClass cursor-pointer grid grid-cols-5 transition-all duration-300 hover:bg-gray-300 px-2 py-1 rounded-md">
                                    <div class="className hidden"> <?php echo e($personel->login); ?> </div>
                                    <div class="class"> <?php echo e($personel->imie); ?>  <?php echo e($personel->nazwisko); ?> </div>
                                    <div class="class"> <?php echo e($personel->stanowiska->stanowisko); ?> </div>
                                    <div class="class"> <?php echo e($statuses[$personel->imie]); ?> </div>
                                    <div class="class"> <?php echo e($timeOfWork[$personel->imie]); ?>h </div>
                                    <div class="zablokowany"> <?php echo e($personel->zablokowany ? 'Tak' : 'Nie'); ?> </div>
                                </a>
                                <?php
                                    $i++;
                                ?> 
                            <?php endif; ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>

                <div class="flex min-h-max w-full justify-center animate-fade-down animate-delay-[1s] animate-ease-out items-center my-5">
                    <div class="addUser font-bold shadow-lg bg-gray-200 h-44 w-44 rounded-2xl overflow-hidden content-center text-center animate-fade-down animate-delay-[0.2s] animate-ease-out mx-5 cursor-pointer">
                        <div class="addUser text-xl select-none">Dodaj użytkownika</div>
                    </div>
                    <div class="flex flex-col cursor-default min-w-max max-w-[50%] grow max-h-96 bg-gray-200 rounded-2xl pl-10 pr-10 pt-5 pb-5 overflow-auto shadow-lg mx-5">
                        <div class="font-bold text-3xl mb-5">Zablokowani użytkownicy</div>
                        <div class="grid grid-cols-3 font-bold px-2 py-1">
                            <div class="name">Imię i nazwisko</div>
                            <div class="name">Stanowisko</div>
                            <div class="name">Zablokowany</div>
                        </div>
                        <?php
                         $i = 0;
                        ?>

                        <?php $__currentLoopData = $personels; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $personel): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php if($personel->zablokowany === 1): ?>
                                <a href='<?php echo e(route('personelParameterRoute', ['login' => $personel->login, 'month' => $month, 'year' => $year])); ?>' class="tableClassBlocked cursor-pointer grid grid-cols-3 transition-all duration-300 hover:bg-gray-300 px-2 py-1 rounded-md">
                                    <div class="className hidden"> <?php echo e($personel->login); ?> </div>
                                    <div class="class"> <?php echo e($personel->imie); ?>  <?php echo e($personel->nazwisko); ?> </div>
                                    <div class="class"> <?php echo e($personel->stanowiska->stanowisko); ?> </div>
                                    <div class="zablokowany"> <?php echo e($personel->zablokowany ? 'Tak' : 'Nie'); ?> </div>
                                </a>
                                <?php
                                    $i++;
                                ?>
                            <?php endif; ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>

                <div class="contextMenu hidden z-10 absolute bg-white px-2 py-2 shadow-md rounded-md opacity-0">
                    <a href='<?php echo e(route('personelParameterRoute', ['login' => $personel->login, 'month' => $month, 'year' => $year])); ?>' class="menuRoute">
                        <div class="menuElement hover:bg-gray-200 transition-all duration-200 px-1 rounded-md cursor-pointer py-1">Zmień grafik</div>
                    </a>
                    <div class="menuElement hover:bg-gray-200 transition-all duration-200 px-1 rounded-md cursor-pointer py-1">Edytuj Użytkownika</div>
                    <div class="menuElement hover:bg-gray-200 transition-all duration-200 px-1 rounded-md cursor-pointer py-1">Zablokuj użytkownika</div>
                </div>

                <div class="contextMenuBlocked hidden z-10 absolute bg-white px-2 py-2 shadow-md rounded-md opacity-0">
                    <div class="menuElementBlocked hover:bg-gray-200 transition-all duration-200 px-1 rounded-md cursor-pointer py-1">Edytuj Użytkownika</div>
                    <div class="menuElementBlocked hover:bg-gray-200 transition-all duration-200 px-1 rounded-md cursor-pointer py-1">Odblokuj użytkownika</div>
                </div>
            </div>
        </div>

        
        <div class="popPersonel bg-black bg-opacity-20 backdrop-blur-sm flex absolute invisible h-full w-full justify-center items-center opacity-0">
            <div class="pop2Personel flex flex-col bg-white w-[500px] min-h-max rounded-lg justify-center p-5">
                <script>
                    let personels = <?php echo json_encode($personels, 15, 512) ?>;
                </script>
            
                <div class="popText text-2xl font-bold text-center">Edytuj użytkownika [nazwa]</div>

                <img src=<?php echo e(url('/icons/Account.svg')); ?> class="h-24 mt-2 p-2">

                <div class="flex justify-between w-full mt-2">
                    <div class="flex justify-center flex-col w-[50%] p-2">
                        <div class="mb-1 text-gray-700">Imię</div>
                        <input type="text" placeholder="Imię" class="data border-2 rounded-lg p-1">
                    </div>
                    <div class="flex justify-center flex-col w-[50%] p-2">
                        <div class="mb-1 text-gray-700">Nazwisko</div>
                        <input type="text" placeholder="Nazwisko" class="data border-2 rounded-lg p-1">
                    </div>
                </div>

                <div class="flex justify-around w-full mt-2">
                    <div class="flex justify-center flex-col w-full p-2">
                        <div class="mb-1 text-gray-700">Email</div>
                        <input type="text" placeholder="Email" class="data border-2 rounded-lg p-1 w-full">
                    </div>
                </div>

                <div class="flex justify-around w-full mt-2">
                    <div class="flex justify-center flex-col w-full p-2">
                        <div class="mb-1 text-gray-700">Numer telefonu</div>
                        <input type="text" placeholder="Numer telefonu" class="data border-2 rounded-lg p-1 w-full">
                    </div>
                </div>

                <div class="flex justify-around w-full mt-2">
                    <div class="flex justify-center flex-col w-full p-2">
                        <div class="mb-1 text-gray-700">Stanowisko</div>
                        
                        <select name="stanowisko" id="stanowisko" class="data border-2 rounded-lg p-1 w-full">
                            <?php $__currentLoopData = $stanowiska; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $stanowisko): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value=<?php echo e($stanowisko->stanowisko); ?>><?php echo e($stanowisko->stanowisko); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>
                </div>

                <div class="flex justify-between w-full mt-2">
                    <div class="flex justify-center flex-col w-[50%] p-2">
                        <div class="mb-1 text-gray-700">Nazwa użytkownika</div>
                        <input type="text" placeholder="Nazwa użytkownika" class="data border-2 rounded-lg p-1 bg-gray-200" disabled>
                    </div>
                    <div class="flex justify-center flex-col w-[50%] p-2">
                        <div class="mb-1 text-gray-700">Hasło</div>
                        <input type="password" placeholder="Hasło" class="data border-2 rounded-lg p-1">
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
                <script>
                    let personels = <?php echo json_encode($personels, 15, 512) ?>;
                </script>

                <div class="popTextDelete text-2xl font-bold text-center">Zablokuj użytkownika [nazwa]</div>

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
<?php /**PATH C:\Users\patry\Desktop\Hotel inżynier\Hotel\Hotel\resources\views/personel.blade.php ENDPATH**/ ?>