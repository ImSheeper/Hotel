import { animate } from "motion"

$(document).ready(function() {
    //oznaczenie menu jako szare
    var path = location.pathname;
    var name = location.pathname.split('/').slice(-1)[0];

    if(path.includes('personel')) name = 'grafik';
    $('.menu').find('button').each(function() {
        if(name === $(this).val()) {
            $(this).addClass('bg-gray-200 rounded-md');
        }
    })

    //W dół jest obsługa customowego prawego kliknięcia na tabeli personel - laravel nie ogarniał co klikam, customowa obsługa była wymagana
    //Do poprawy są jeszcze style
    //right click menu na tabeli personel
    $(".tableClass").bind("contextmenu", function (event) {
        event.preventDefault();

        var currentDate = new Date();
        var year = currentDate.getFullYear();
        var month = currentDate.getMonth() + 1;
        
        switch(event.which) {
            case 3:
                var name = $(this).find('.className').text().trim();
                $('.popText').text(`Edytuj użytkownika ${name}`);

                // Wyszukiwanie użytkownika do wypełnienia danych sparsowanych z json'a
                let user = personels.find(function(e) {
                    return e.login === name;
                });
                console.log(user);

                if(user) {
                    $('.data').eq(0).val(user.imie);
                    $('.data').eq(1).val(user.nazwisko);
                    $('.data').eq(2).val(user.email);
                    $('.data').eq(3).val(user.nrTel);
                    $('.data').eq(4).val(user.stanowiska.stanowisko);
                    $('.data').eq(5).val(user.login);
                }

                $(".menuRoute").attr("href", 'personel/' + name + '/' + month + '/' + year);
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

    $(document).bind("mousedown", function (e) {
        if (!$(e.target).parents(".contextMenu").length > 0) {
            //Ukryj menu
            animate(
                $('.contextMenu'),
                { opacity: 0, duration: 0.2 }
            )

            //Zbugowane! Wykonuje się za każdym razem!!! Trzeba wymyśleć jakiś warunek
            //-> naprawiło się
            $('.contextMenu').removeClass('visible').delay(200).queue(function() {
                $(this).addClass('hidden');
            });
        }
    });

    $('.sendAjax').on('click', function() {
        var data = {
            'imie' : $('.data').eq(0).val(),
            'nazwisko' : $('.data').eq(1).val(),
            'email' : $('.data').eq(2).val(),
            'nrTel' : $('.data').eq(3).val(),
            'stanowisko' : $('.data').eq(4).val(),
            'login' : $('.data').eq(5).val(),
            'password' : $('.data').eq(6).val(),
        }

        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            //tutaj trzeba zrobic url dla uzytkownika - chyba teraz działa, ale zobaczymy podczas testów
            url : "/personel",
            data : {
                data
            },
            method : 'POST',
            success : function(result){
                console.log("Sukces: ", result);
            },
            error: function(xhr, status, error) {
                console.error("Wystąpił błąd:");
                console.error("Status: ", status);
                console.error("Błąd: ", error);
                console.error("Odpowiedź serwera: ", xhr.responseText);
            }
        });
    });
});


// Customowe menu popUp
// Animate popUp - otwieranie popup
$(document).ready(function() {
    $('.menuElement').eq(1).on('click', function() {
        closeCustomMenu('.popPersonel', '.pop2Personel');
    });

    $('.menuElement').eq(2).on('click', function() {
        closeCustomMenu('.popDelete', '.pop2Delete');
    });
})

function closeCustomMenu(pop1, pop2) {
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
        if(!$(event.target).closest(pop2).length && !$(event.target).is('.menuElement') || $(event.target).is('.close') && !$(event.target).is('.but')) {
            animate(
                $(pop1),
                { opacity: 0 },
                { duration: 0.2, easing: "ease-out" }
            );
            
            setTimeout(function() {
                $(pop1).removeClass('visible').addClass('fade-out invisible');
            }, 200);
        }
    });
}