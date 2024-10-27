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
    // Do zminimalizowania poniższe dwie funkcje
    $(".tableClass").bind("contextmenu", function (event) {
        event.preventDefault();

        var currentDate = new Date();
        var year = currentDate.getFullYear();
        var month = currentDate.getMonth() + 1;
        
        switch(event.which) {
            case 3:
                var name = $(this).find('.className').text().trim();
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

                $('.popText').text(`Edytuj użytkownika ${name}`);
                $('.popTextDelete').text(`Czy na pewno chcesz zablokować użytkownika ${user.imie} ${user.nazwisko} (${name})?`);

                $(".menuRoute").attr("href", 'personel/' + name + '/' + month + '/' + year);

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

    // Wypełnianie danych do edycji - można było zrobić lepiej
    $(".tableClassBlocked").bind("contextmenu", function (event) {
        event.preventDefault();

        var currentDate = new Date();
        var year = currentDate.getFullYear();
        var month = currentDate.getMonth() + 1;
        
        switch(event.which) {
            case 3:
                var name = $(this).find('.className').text().trim();
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

                $('.popText').text(`Edytuj użytkownika ${name}`);
                $('.popTextDelete').text(`Czy na pewno chcesz odblokować użytkownika ${user.imie} ${user.nazwisko} (${name})?`);

                $(".menuRoute").attr("href", 'personel/' + name + '/' + month + '/' + year);
                // Tabela zablokowanego personelu
                $(".contextMenuBlocked").removeClass('hidden').addClass('visible').finish().css({
                    top: event.pageY + "px",
                    left: event.pageX + "px"
                })
                animate(
                    $('.contextMenuBlocked'),
                    { opacity: 1},
                    { duration: 0.2 }
                )
        }
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

    // Wyślij ajax z edycją pracownika
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
                window.location.replace('/personel');
            },
            error: function(xhr, status, error) {
                console.error("Wystąpił błąd:");
                console.error("Status: ", status);
                console.error("Błąd: ", error);
                console.error("Odpowiedź serwera: ", xhr.responseText);
            }
        });
    });

    // Obsługa usuwania pracownika
    $('.butYes').on('click', function() {
        var name = $('.popTextDelete').text().split(" ").pop();
        name = name.split("(").pop();
        name = name.slice(0, -2);

        // Obsługa AJAX - TODO: dodać obsługę w kontrolerze i routingu
        var data = {
            'login' : name
        };

        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url : "/personelDelete",
            data : {
                data
            },
            method : 'POST',
            success : function(result){
                console.log("Sukces: ", result);
                window.location.replace('/personel');
            },
            error: function(xhr, status, error) {
                console.error("Wystąpił błąd:");
                console.error("Status: ", status);
                console.error("Błąd: ", error);
                console.error("Odpowiedź serwera: ", xhr.responseText);
            }
        });
    });

    // Użytkownik zablokowany - style
    $('.zablokowany').each(function() {
        if($(this).text().trim() === "Tak") {
            $(this).addClass('text-red-500');
            $(this).parent().find('.class').addClass('text-red-500');
        }
    });

    // PopUp na dodawanie użytkownika
    $('.addUser').on('click', function() {
        $('.popText').text(`Dodaj nowego użytkownika`);
        $('.data').eq(5).prop('disabled', false).addClass('bg-white');

        // Wyczyść dane z poprzednich formularzy
        $('.data').eq(0).val('');
        $('.data').eq(1).val('');
        $('.data').eq(2).val('');
        $('.data').eq(3).val('');
        $('.data').eq(4).val('');
        $('.data').eq(5).val('');
        $('.data').eq(6).val('');

        $('.popPersonel').removeClass('invisible').addClass('visible');
        animate(
            $('.popPersonel'),
            { opacity: 1 },
            { duration: 0.2, easing: "ease-out" }
        );

        // Znowu buguje - do poprawy
        $(document).on('click', function(event) {
            if(!$(event.target).closest('.pop2Personel').length && !$(event.target).is('.addUser')
                && !$(event.target).closest('.pop2Personel').length && !$(event.target).is('.menuElement')
                && !$(event.target).closest('.pop2Personel').length && !$(event.target).is('.menuElementBlocked')
                || $(event.target).is('.close') && !$(event.target).is('.but')) {
                animate(
                    $('.popPersonel'),
                    { opacity: 0 },
                    { duration: 0.2, easing: "ease-out" }
                );
                
                setTimeout(function() {
                    $('.popPersonel').removeClass('visible').addClass('invisible');

                    // Ponownie zrób login disabled
                    $('.data').eq(5).prop('disabled', true).removeClass('bg-white');
                }, 200);
            }
        });
    });
});


// Customowe menu popUp
// Animate popUp - otwieranie popup
$(document).ready(function() {
    $('.menuElement').eq(1).on('click', function() {
        manageCustomMenu('.popPersonel', '.pop2Personel', '.menuElement', '.menuElementBlocked');
    });

    $('.menuElement').eq(2).on('click', function() {
        manageCustomMenu('.popDelete', '.pop2Delete', '.menuElement', '.menuElementBlocked');
    });

    $('.menuElementBlocked').eq(0).on('click', function() {
        manageCustomMenu('.popPersonel', '.pop2Personel', '.menuElementBlocked', '.menuElement');
    });

    $('.menuElementBlocked').eq(1).on('click', function() {
        manageCustomMenu('.popDelete', '.pop2Delete', '.menuElementBlocked', '.menuElement');    
    });
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