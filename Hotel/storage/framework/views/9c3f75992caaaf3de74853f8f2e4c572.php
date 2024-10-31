<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Zaloguj się</title>
  <?php echo app('Illuminate\Foundation\Vite')('resources/css/app.css'); ?>

    <style>
        body, html {
            color: rgb(31 41 55);;
        }

        .filterGray {
            filter: invert(58%) sepia(0%) saturate(0%) hue-rotate(36deg) brightness(92%) contrast(92%);
        }

        .background {
            background-image: url('/images/Background.png');
            background-size: cover;
        }
    </style>

</head>
<body>
    <div class="background flex h-screen justify-center items-center">
        <div class="flex bg-white h-auto w-3/4 md:w-84 rounded-lg justify-center">
            <form method="POST" action="<?php echo e(route('loginStore')); ?>" class="flex flex-col w-3/4 overflow overflow-auto">
            <?php echo csrf_field(); ?>

                <div class="text-3xl font-bold my-10 text-center">Zaloguj się</div>

                <div class="text-sm">Login</div>
                <div class="flex border-b-2 border-solid items-center">
                    <img src="<?php echo e(url('/icons/User.svg')); ?>" alt="Image" class="filterGray size-4 ml-2">
                    <input type="text" placeholder="Wpisz swój login" class="pl-2 pb-2 pt-2 text-sm w-full focus:outline-none" name="login">
                </div>
                
                <div class="text-sm mt-6">Hasło</div>
                <div class="flex border-b-2 border-solid items-center">
                    <img src="<?php echo e(url('/icons/Password.svg')); ?>" alt="Image" class="filterGray size-4 ml-2">
                    <input type="password" placeholder="Wpisz swoje hasło" class="pl-2 pb-2 pt-2 text-sm w-full focus:outline-none" name="password">
                </div>

                <div class="font-bold text-xs ml-auto text-gray-400 mt-2">Zapomniałeś hasła?</div>

                <button class='h-10 my-10 bg-gradient-to-r from-cyan-400 to-fuchsia-400 text-white font-bold rounded-full onclick:shadow-xl shrink-0'>ZALOGUJ SIĘ</button>
                <?php if($errors->any()): ?>
                    <div class="text-red-500 text-center font-bold mb-10">
                        <?php echo e($errors->first()); ?>

                    </div>
                <?php endif; ?>
            </form>
        </div>
    </div>
</body>
</html>
<?php /**PATH /home/sheeper/Desktop/Hotel/Hotel/resources/views/login.blade.php ENDPATH**/ ?>