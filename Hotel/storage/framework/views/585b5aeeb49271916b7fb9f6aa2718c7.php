<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

  <title>Personel</title>
  <?php echo app('Illuminate\Foundation\Vite')('resources/css/app.css'); ?>
  <?php echo app('Illuminate\Foundation\Vite')('resources/js/magazynStyles.js'); ?>
  
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

                <div class="flex min-h-max w-full justify-center animate-fade-down animate-delay-[1s] animate-ease-out mt-5">
                    <div class="flex flex-col cursor-default min-w-max max-w-[1000px] grow max-h-[768px] bg-[#F4F2FF] rounded-2xl pl-10 pr-10 pt-5 pb-5 overflow-auto shadow-lg">
                        <div class="flex items-center mb-5">
                            <img src=<?php echo e(url('/icons/Magazyn.svg')); ?> class="z-10 transition duration-500 opacity-100 group-hover:opacity-0 h-5">
                            <div class="font-bold text-2xl px-2">Magazyn</div>
                        </div>

                        <hr class="border-t border-gray-600 mb-5">

                        <div class="grid grid-cols-4 font-bold px-2 py-1">
                            <div class="name">Nazwa</div>
                            <div class="name">Ilość</div>
                            <div class="name">Data ważności do</div>
                            <div class="name">Rodzaj</div>
                        </div>
                        <div class="magazynContainer">
                            <?php $__currentLoopData = $magazyn; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="tableClass cursor-pointer grid grid-cols-4 transition-all duration-300 hover:bg-[#dbd5ff] px-2 py-1 rounded-md">
                                <div class="magazyn"><?php echo e($item->produkt->nazwa); ?> </div>
                                <div class="magazyn"><?php echo e($item->ilosc); ?> </div>
                                <?php if($item->rodzaj === 'Kuchnia'): ?>
                                    <div class="magazyn"><?php echo e($item->data_waznosci); ?> </div>
                                <?php else: ?>
                                <div class="magazyn"></div>
                                <?php endif; ?>
                                <div class="magazyn"><?php echo e($item->rodzaj); ?> </div>
                                <div class="magazyn hidden"><?php echo e($item->produkt->ilosc_alert); ?> </div>
                            </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    </div>
                </div>

                <div class="Dodaj font-bold shadow-lg mx-10 bg-[#F4F2FF] h-16 w-48 rounded-2xl overflow-hidden content-center text-center my-5 animate-fade-down animate-delay-[0.2s] animate-ease-out">
                    <div class="dodajText text-xl select-none">Dodaj produkt</div>
                </div>
                
                <div class="addZapas font-bold shadow-lg mx-10 bg-[#F4F2FF] h-16 w-48 rounded-2xl overflow-hidden content-center text-center animate-fade-down animate-delay-[0.2s] animate-ease-out">
                    <div class="text-xl select-none">Edytuj produkty</div>
                </div>

                
                <div class="contextMenu hidden z-10 absolute bg-white px-2 py-2 shadow-md rounded-md opacity-0">
                    <div class="menuElement hover:bg-[#F4F2FF] transition-all duration-200 px-1 rounded-md cursor-pointer py-1">Edytuj produkt</div>
                    <div class="menuElement hover:bg-[#F4F2FF] transition-all duration-200 px-1 rounded-md cursor-pointer py-1">Usuń produkt</div>

                </div>
            </div>
        </div>

         
        <div class="popMagazyn bg-black bg-opacity-20 backdrop-blur-sm flex absolute invisible h-full w-full justify-center items-center opacity-0">
            <div class="pop2Magazyn flex flex-col bg-white w-[500px] min-h-max rounded-lg justify-center p-5">
                <div class="popText text-2xl font-bold text-center">Edytuj produkt [nazwa]</div>

                <div class="flex justify-between w-full mt-2">

                    <div class="flex justify-center flex-col w-[33%] p-2">
                        <div class="mb-1 text-gray-700">Produkt</div>
                        <select name="Produkt" id="Produkt" class="data border-2 rounded-lg p-1 w-full bg-white">
                            <?php $__currentLoopData = $produkt; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($item->nazwa); ?>"> <?php echo e($item->nazwa); ?> </option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>

                    <div class="flex justify-center flex-col w-[33%] p-2">
                        <div class="mb-1 text-gray-700">Akcja</div>
                        <select name="Status" id="Status" class="data border-2 rounded-lg p-1 w-full bg-white">
                            <option value="1"> Zwiększ o </option>
                            <option value="0"> Zmniejsz o </option>
                            <option value="2"> Dokładnie </option>
                        </select>
                    </div>

                    <div class="flex justify-center flex-col w-[33%] p-2">
                        <div class="mb-1 text-gray-700">Ilość</div>
                        <input type="number" placeholder="Ilość" class="data border-2 rounded-lg p-1">
                    </div>
                </div>

                <div class="flex flex-col items-center justify-center w-full">
                    <div class="flex relative group rounded-2xl mb-4 mt-6">
                        <div class="flex relative group h-12">
                            <button class="sendAjax bg-[#F4F2FF] w-36 h-12 min-w-max rounded-2xl text-lg opcaity-100 transition-all duration-200 group-hover:opacity-0">Zapisz</button>
                            <button class="sendAjax absolute bg-gradient-to-r from-cyan-400 to-fuchsia-400 w-36 h-12 min-w-max rounded-2xl text-lg transition-all duration-200 opacity-0 group-hover:opacity-100 text-white">Zapisz</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        
        <div class="popUzupelnij bg-black bg-opacity-20 backdrop-blur-sm flex absolute invisible h-full w-full justify-center items-center opacity-0">
            <div class="pop2Uzupelnij flex flex-col bg-white w-[500px] min-h-max rounded-lg justify-center p-5">
                <div class="popTextEdit text-2xl font-bold text-center">Edytuj produkty</div>

                <div class="flex justify-between w-full mt-2">

                    <div class="flex justify-center flex-col w-[33%] p-2">
                        <div class="mb-1 text-gray-700">Akcja</div>
                        <select name="Status" id="Status" class="dataProdukt border-2 rounded-lg p-1 w-full bg-white">
                            <option value="1"> Dodaj </option>
                            <option value="0"> Usuń </option>
                        </select>
                    </div>

                    
                    <div class="flex justify-center flex-col w-[33%] p-2">
                        <div class="mb-1 text-gray-700">Produkt</div>
                        <input type="text" placeholder="Nowy produkt" class="dataProdukt border-2 rounded-lg p-1">
                        <select name="Produkt2" id="Produkt2" class="dataProdukt hidden border-2 rounded-lg p-1 w-full bg-white">             
                            <?php $__currentLoopData = $produkt; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value=<?php echo e($item->nazwa); ?>> <?php echo e($item->nazwa); ?> </option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>
                    
                    <div class="flex justify-center flex-col w-[33%] p-2">
                        <div class="mb-1 text-gray-700">Magazyn</div>
                        <?php if(str_contains($userStanowisko, 'Menedżer')): ?>
                            <select name="Status" id="Status" class="dataProdukt border-2 rounded-lg p-1 w-full bg-gray-200" disabled>    
                        <?php else: ?>
                            <select name="Status" id="Status" class="dataProdukt border-2 rounded-lg p-1 w-full bg-white">
                        <?php endif; ?>

                        <?php if($userStanowisko === 'Menedżer Hotelu'): ?>
                            <option value="Hotel"> Hotel </option>
                        <?php elseif($userStanowisko === 'Menedżer Kuchni'): ?>
                            <option value="Kuchnia"> Kuchnia </option>
                        <?php else: ?>
                            <option value="Hotel"> Hotel </option>
                            <option value="Kuchnia"> Kuchnia </option>
                        <?php endif; ?>
                        
                        </select>
                    </div>
                </div>
                
                <div class="flex justify-between w-full mt-2">
                    <div class="flex justify-center flex-col w-[100%] p-2">
                        <div class="mb-1 text-gray-700">Alert ilości</div>
                        <input type="number" placeholder="Alert ilości" class="dataProdukt border-2 rounded-lg p-1" title="Liczba, po której przekroczeniu dojdzie do podkreślenia braku produktu">
                    </div>
                </div>

                <div class="flex flex-col items-center justify-center w-full">
                    <div class="flex relative group rounded-2xl mb-4 mt-6">
                        <div class="flex relative group h-12">
                            <button class="sendAjaxProdukt bg-[#F4F2FF] w-36 h-12 min-w-max rounded-2xl text-lg opcaity-100 transition-all duration-200 group-hover:opacity-0">Zapisz</button>
                            <button class="sendAjaxProdukt absolute bg-gradient-to-r from-cyan-400 to-fuchsia-400 w-36 h-12 min-w-max rounded-2xl text-lg transition-all duration-200 opacity-0 group-hover:opacity-100 text-white">Zapisz</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        
        <div class="popDodaj bg-black bg-opacity-20 backdrop-blur-sm flex absolute invisible h-full w-full justify-center items-center opacity-0">
            <div class="pop2Dodaj flex flex-col bg-white w-[500px] min-h-max rounded-lg justify-center p-5">
                <div class="popText text-2xl font-bold text-center">Dodaj produkt</div>

                <div class="flex justify-evenly w-full mt-2">

                    <div class="flex justify-center flex-col w-[50%] p-2">
                        <div class="mb-1 text-gray-700">Produkt</div>
                        <select name="Produkt3" id="Produkt3" class="dataDodaj border-2 rounded-lg p-1 w-full bg-white">
                            <?php $__currentLoopData = $produkt; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value=<?php echo e($item->nazwa); ?>> <?php echo e($item->nazwa); ?> </option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>

                    <div class="flex justify-center flex-col w-[50%] p-2">
                        <div class="mb-1 text-gray-700">Ilość</div>
                        <input type="number" placeholder="Ilość" class="dataDodaj border-2 rounded-lg p-1">
                    </div>
                </div>

                <div class="flex justify-evenly w-full mt-2">

                    <div class="flex justify-center flex-col w-[50%] p-2">
                        <div class="mb-1 text-gray-700">Data ważności do</div>
                        <input type="date" placeholder="Data ważności" class="dataDodaj border-2 rounded-lg p-1">
                    </div>

                    <div class="flex justify-center flex-col w-[50%] p-2">
                        <div class="mb-1 text-gray-700">Magazyn</div>
                        <?php if(str_contains($userStanowisko, 'Menedżer')): ?>
                            <select name="Status" id="Status" class="dataDodaj border-2 rounded-lg p-1 w-full bg-gray-200" disabled>    
                        <?php else: ?>
                            <select name="Status" id="Status" class="dataDodaj border-2 rounded-lg p-1 w-full bg-white">
                        <?php endif; ?>

                        <?php if($userStanowisko === 'Menedżer Hotelu'): ?>
                            <option value="Hotel"> Hotel </option>
                        <?php elseif($userStanowisko === 'Menedżer Kuchni'): ?>
                            <option value="Kuchnia"> Kuchnia </option>
                        <?php else: ?>
                            <option value="Hotel"> Hotel </option>
                            <option value="Kuchnia"> Kuchnia </option>
                        <?php endif; ?>
                        
                        </select>
                    </div>

                    
                </div>

                <div class="flex flex-col items-center justify-center w-full">
                    <div class="flex relative group rounded-2xl mb-4 mt-6">
                        <div class="flex relative group h-12">
                            <button class="AjaxDodaj bg-[#F4F2FF] w-36 h-12 min-w-max rounded-2xl text-lg opcaity-100 transition-all duration-200 group-hover:opacity-0">Dodaj</button>
                            <button class="AjaxDodaj absolute bg-gradient-to-r from-cyan-400 to-fuchsia-400 w-36 h-12 min-w-max rounded-2xl text-lg transition-all duration-200 opacity-0 group-hover:opacity-100 text-white">Dodaj</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

                
                <div class="popUsun bg-black bg-opacity-20 backdrop-blur-sm flex absolute invisible h-full w-full justify-center items-center opacity-0">
                    <div class="pop2Usun flex flex-col bg-white w-[500px] min-h-max rounded-lg justify-center p-5">
                        <div class="popTextUsun text-2xl font-bold text-center">Usuń produkt [nazwa]</div>
        
                        <div class="flex items-center justify-evenly px-10 w-full">
                            <div class="flex relative group rounded-2xl mb-4 mt-6">
                                <div class="flex relative group h-12 mx-5">
                                    <button class="butYes bg-[#F4F2FF] w-36 h-12 min-w-max rounded-2xl text-lg opcaity-100 transition-all duration-200 group-hover:opacity-0">Tak</button>
                                    <button class="butYes absolute bg-gradient-to-r from-red-400 to-orange-400 w-36 h-12 min-w-max rounded-2xl text-lg transition-all duration-200 opacity-0 group-hover:opacity-100 text-white">Tak</button>
                                </div>
                            </div>
                            <div class="flex relative group rounded-2xl mb-4 mt-6">
                                <div class="flex relative group h-12 mx-5">
                                    <button class="butNo bg-[#F4F2FF] w-36 h-12 min-w-max rounded-2xl text-lg opcaity-100 transition-all duration-200 group-hover:opacity-0">Nie</button>
                                    <button class="butNo absolute bg-gradient-to-r from-cyan-400 to-fuchsia-400 w-36 h-12 min-w-max rounded-2xl text-lg transition-all duration-200 opacity-0 group-hover:opacity-100 text-white">Nie   </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

        <script>
            let magazyn = <?php echo json_encode($magazyn, 15, 512) ?>;
        </script>
    </div>
</body>
</html>
<?php /**PATH C:\Users\patry\Desktop\Inzynier\Hotel\resources\views/magazyn.blade.php ENDPATH**/ ?>