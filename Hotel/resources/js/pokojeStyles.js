import { animate, glide } from "motion"

$(document).ready(function() {
    // Show contextMenu
    $(".tableClass").bind("contextmenu", function (event) {
        event.preventDefault();
        
        switch(event.which) {
            case 3:
                var data = $(this).find('.pokoje').text().split(' ').filter(Boolean);
                data.forEach(function(index) {
                    $('.data').eq(index).val(data[index]);
                });
                
                $('.popText').text(`Edytuj pokój ${data[0]}`);
                $('.popTextDelete').text(`Wykluczyć pokój ${data[0]}?`);

                // Tabela aktywnego personelu
                $(".contextMenu").removeClass('hidden').addClass('visible').finish().css({
                    top: event.pageY + "px",
                    left: event.pageX + "px"
                })
                animate(
                    $('.contextMenu'),
                    { opacity: 1},
                    { duration: 0.2 }
                )
                break;
        }
    });
});


// Zamykanie menu aktywnych i zablokowanych
$(document).bind("mousedown", function (e) {
    if (!$(e.target).parents(".contextMenu").length > 0) {
        //Ukryj menu
        animate(
            $('.contextMenu'),
            { opacity: 0, duration: 0.2 }
        )
        animate(
            $('.contextMenuBlocked'),
            { opacity: 0, duration: 0.2 }
        )

        //Zbugowane! Wykonuje się za każdym razem!!! Trzeba wymyśleć jakiś warunek
        //-> naprawiło się
        $('.contextMenu').removeClass('visible').delay(200).queue(function() {
            $(this).addClass('hidden');
        });
        $('.contextMenuBlocked').removeClass('visible').delay(200).queue(function() {
            $(this).addClass('hidden');
        });
    }
});

// Customowe menu popUp
// Animate popUp - otwieranie popup
$(document).ready(function() {
    $('.menuElement').eq(0).on('click', function() {
        manageCustomMenu('.popPersonel', '.pop2Personel', '.menuElement', '.menuElementBlocked');
    });

    $('.menuElement').eq(1).on('click', function() {
        manageCustomMenu('.popDelete', '.pop2Delete', '.menuElement', '.menuElementBlocked');
    });

    // $('.menuElementBlocked').eq(0).on('click', function() {
    //     manageCustomMenu('.popPersonel', '.pop2Personel', '.menuElementBlocked', '.menuElement');
    // });

    // $('.menuElementBlocked').eq(1).on('click', function() {
    //     manageCustomMenu('.popDelete', '.pop2Delete', '.menuElementBlocked', '.menuElement');    
    // });
})

// Animacje zamykania i otwierania customowego menu
function manageCustomMenu(pop1, pop2, menuElement, menuElementBlocked) {
    // Ukryj custom menu
    animate(
        $('.contextMenu'),
        { opacity: 0, duration: 0.2 }
    )
    setTimeout(function() {
        $('.contextMenu').removeClass('visible')
        $('.contextMenu').addClass('hidden');
    }, 200);

    // Pokaż popPersonelup
    $(pop1).removeClass('invisible').addClass('visible');
    animate(
        $(pop1),
        { opacity: 1 },
        { duration: 0.2, easing: "ease-out" }
    );

    $(document).on('click', function(event) {
        if(!$(event.target).closest(pop2).length && !$(event.target).is(menuElementBlocked) 
            && !$(event.target).closest(pop2).length && !$(event.target).is(menuElement)
            && !$(event.target).closest('.pop2Personel').length && !$(event.target).is('.addUser')
            || $(event.target).is('.close') && !$(event.target).is('.but')) {
            animate(
                $(pop1),
                { opacity: 0 },
                { duration: 0.2, easing: "ease-out" }
            );
            
            setTimeout(function() {
                $(pop1).removeClass('visible').addClass('invisible');
            }, 200);
        }

        //Chowanie popup po kliknięciu NIE
        $('.butNo').on('click', function() {
            animate(
                $(pop1),
                { opacity: 0 },
                { duration: 0.2, easing: "ease-out" }
            );
            
            setTimeout(function() {
                $(pop1).removeClass('visible').addClass('invisible');
            }, 200);
        })
    });
}

