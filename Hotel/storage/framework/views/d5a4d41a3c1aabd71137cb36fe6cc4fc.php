<?php echo app('Illuminate\Foundation\Vite')('resources/js/topbarStyle.js'); ?>

<div class="flex w-full h-20">
    <div class="flex lg:hidden flex-col grow lg: bg-white mx-1 my-1 mt-2 rounded-md items-center justify-center overflow-hidden min-w-16">
        <img src=<?php echo e(url('/icons/BurgerMenu.svg')); ?> class="h-8 bg-white rounded-md mx-2 animate-fade-right animate-delay-[0.1s] animate-ease-out">
    </div>
    
    <div class="flex flex-col w-full lg:grow bg-white mx-1 my-1 mt-2 rounded-md items-center justify-center overflow-hidden min-w-max">
        <div class="nameTopbar font-bold text-3xl mx-2 animate-fade-right animate-delay-[0.5s] animate-ease-out">  </div>
        <div class="stanowiskoTopbar text-gray-500 mx-2 animate-fade-right animate-delay-[0.5s] animate-ease-out"> <?php echo e($userStanowisko); ?> </div>
    </div>
    
    <div class="animParent relative group overflow-visible flex flex-col grow bg-white hover:rounded-b-none mx-1 my-1 mt-2 mr-2 rounded-md justify-center items-center min-w-max max-w-max">
        <button class="flex flex-col items-center">
            <img src=<?php echo e(url('/icons/Account.svg')); ?> class="h-8 mt-2 mx-2 animate-fade-right animate-delay-[0.8s] animate-ease-out">
            <div class="font-bold mx-2 mb-2 animate-fade-right animate-delay-[0.8s] animate-ease-out"> <?php echo e($login); ?> </div>
        </button>

        <div class="anim transition-all opacity-0 group-hover:opacity-100 invisible group-hover:visible duration-300 absolute z-10 end-0 top-full block w-auto min-w-max text-end py-2 px-4  shadow-lg bg-white rounded-b-md">
            <div class="">Ustawienia konta</div>
            <div class="">Informacje o systemie</div>
            <div class="">Wyloguj się</div>
        </div>
    </div>
</div><?php /**PATH C:\Users\patry\Desktop\Hotel\Hotel\resources\views/Templates/topMenuTemplate.blade.php ENDPATH**/ ?>