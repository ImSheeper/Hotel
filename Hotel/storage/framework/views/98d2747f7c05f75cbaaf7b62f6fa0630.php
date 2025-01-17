<?php if(isset($grafik)): ?>
    <?php 
        $file = $grafik[0]['data'][0]['nazwa dnia'];
    ?>
<?php else: ?>
    <?php
        $file = $dayNames[1];
    ?>
<?php endif; ?>

<?php
    $dni = array(
        1 => "Poniedziałek",
        2 => "Wtorek",
        3 => "Środa",
        4 => "Czwartek",
        5 => "Piątek",
        6 => "Sobota",
        7 => "Niedziela",
    );
?>

<?php $__currentLoopData = $dni; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $dzien): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <div class="document-animation font-bold mx-2 my-2 text-center text-xl select-none"><?php echo e($dzien); ?></div>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

<?php if($file != "Poniedziałek"): ?>
    <?php
        foreach($dni as $klucz => $dzien) {
            if($file == $dzien) $currentDay = $klucz;
        }
        
        $fieldsToAdd = 0;
        for($currentDay; $currentDay > 1; $currentDay--) {
            $fieldsToAdd++;
        }
    ?>

    <?php for($i = 1; $i <= $fieldsToAdd; $i++): ?>
    <div class="json flex flex-col bg-gray-300 h-32 shadow-md w-32 rounded-3xl mx-2 my-2 pointer-events-none">
        <div class="document-animation font-bold"></div>
    </div>                           
    <?php endfor; ?>

<?php endif; ?>



<?php if(isset($grafik)): ?>
<?php $__currentLoopData = $grafik[0]['data']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $graf): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

<?php if(($userStanowisko === 'Właściciel Hotelu' && in_array($graf['dzisiejszy dzien'], $uniqueData)) || ($userStanowisko !== 'Właściciel Hotelu' && $graf["status"] === "1. zmiana" || ($userStanowisko !== 'Właściciel Hotelu' && $graf["status"] === "2. zmiana"))): ?>
    <?php if(($userStanowisko === 'Właściciel Hotelu')): ?>     
        <div class="json overflow-hidden select-none flex flex-col bg-green-400 h-32 shadow-md w-32 rounded-full mx-2 my-2 justify-center items-center">
    <?php else: ?>
        <div class="json overflow-hidden select-none flex flex-col bg-red-400 h-32 shadow-md w-32 rounded-full mx-2 my-2 justify-center items-center">
    <?php endif; ?>
        <div class="document font-bold hidden"><?php echo e($graf["rok"]); ?></div>
        <div class="document font-bold hidden"><?php echo e($graf["numer dni"]); ?></div>
        <div class="document font-bold hidden"><?php echo e($graf["miesiąc"]); ?></div>
        <div class="document text-3xl"><?php echo e($graf["dzisiejszy dzien"]); ?></div>
        <div class="document font-bold hidden"><?php echo e($graf["nazwa dnia"]); ?></div>
        <div class="flex flex-col overflow-hidden">
            <?php if(($userStanowisko === 'Właściciel Hotelu')): ?>  
                <?php $__currentLoopData = $status; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $stat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php if($graf['dzisiejszy dzien'] == $stat['dzien']): ?>
                        <div class="document" title="<?php echo e($stat["login"]); ?> : <?php echo e($stat["stanowisko"]); ?>"><?php echo e($stat["status"]); ?></div>
                    <?php endif; ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php else: ?>
                <?php echo e($graf["status"]); ?>

            <?php endif; ?>
        </div>                                               
    </div>
        <?php else: ?>
            <?php if(($userStanowisko === 'Właściciel Hotelu')): ?>     
                <div class="json overflow-hidden select-none flex flex-col bg-red-400 h-32 shadow-md w-32 rounded-full mx-2 my-2 justify-center items-center">
            <?php else: ?>
                <div class="json overflow-hidden select-none flex flex-col bg-green-400 h-32 shadow-md w-32 rounded-full mx-2 my-2 justify-center items-center">
            <?php endif; ?>                                                        
                    <div class="document font-bold hidden"><?php echo e($graf["rok"]); ?></div>
                    <div class="document font-bold hidden"><?php echo e($graf["numer dni"]); ?></div>
                    <div class="document font-bold hidden"><?php echo e($graf["miesiąc"]); ?></div>
                    <div class="document text-3xl"><?php echo e($graf["dzisiejszy dzien"]); ?></div>
                    <div class="document font-bold hidden"><?php echo e($graf["nazwa dnia"]); ?></div>
                <div class="flex overflow-hidden">
                    <div class="document">
                        <?php if($userStanowisko === 'Właściciel Hotelu'): ?>
                            Brak
                        <?php else: ?>
                            <?php echo e($graf["status"]); ?>

                        <?php endif; ?>
                    </div>
                </div>
            </div>
        <?php endif; ?>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

    <?php else: ?>
    <?php for($i = 1; $i <= $days; $i++): ?>
        <div class="json overflow-hidden select-none flex flex-col bg-gray-200 h-32 shadow-md w-32 rounded-full mx-2 my-2 justify-center items-center">
            <div class="document font-bold hidden"><?php echo e($year); ?></div>
            <div class="document font-bold hidden"><?php echo e($days); ?></div>
            <div class="document font-bold hidden"><?php echo e($month); ?></div>

            <div class="document text-3xl"><?php echo e($i); ?></div>
            <div class="document font-bold hidden"><?php echo e($dayNames[$i]); ?></div>
            <div class="flex overflow-hidden">
                <div class="document visible">Status</div>
            </div>
        </div>
    <?php endfor; ?>
<?php endif; ?><?php /**PATH C:\Users\patry\Desktop\Inzynier\Hotel\resources\views/Templates/grafikTemplate.blade.php ENDPATH**/ ?>