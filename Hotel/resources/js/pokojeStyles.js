import { animate, glide } from "motion"

$(document).ready(function() {
    // Delegacja zdarzenia contextmenu na dynamicznie dodane elementy .tableClass
    $(".roomsContainer").on("contextmenu", ".tableClass", function(event) {
        event.preventDefault();
        
        var data = $(this).find('.pokoje').text().split(' ').filter(Boolean);
        console.log(data); // Sprawdź, czy dane są prawidłowo pobierane
        
        // Wypełnianie danych w polach
        $('.data').eq(0).val(data[0]);
        $('.data').eq(1).val(data[1]);
        data[2] === "Wolne" ? $('.data').eq(2).val(0) : $('.data').eq(2).val(1);
        data[3] === "Brudny" ? $('.data').eq(3).val(0) : $('.data').eq(3).val(1);
        data[4] === "Aktywny" ? $('.data').eq(4).val(0) : $('.data').eq(4).val(1);
        $('.data').eq(0).prop('disabled', true).addClass('bg-gray-200');
        
        $('.popText').text(`Edytuj pokój ${data[0]}`);
        $('.popTextDelete').text(`Wykluczyć pokój ${data[0]}?`);
        $('.popTextDeleteRoom').text(`Czy na pewno usunąć pokój ${data[0]}?`);
        console.log('event', $(this).text());

        // Wyświetlanie customowego menu kontekstowego
        $(".contextMenu").removeClass('hidden').css({
            top: event.pageY + "px",
            left: event.pageX + "px"
        });

        animate(
            $('.contextMenu'),
            { opacity: 100, duration: 0.2 }
        )
    });

    // Ukrycie menu po kliknięciu poza nim
    $(document).on("click", function() {
        //Ukryj menu
        animate(
            $('.contextMenu'),
            { opacity: 0, duration: 0.2 }
        )

        setTimeout(function() {
            $('.contextMenu').removeClass('visible').addClass('hidden');
        }, 200);
    });
});

$(document).ready(function() {
    // Delegacja zdarzenia contextmenu na dynamicznie dodane elementy .tableClass
    $(".roomsContainerBlocked").on("contextmenu", ".tableClassBlocked", function(event) {
        event.preventDefault();
        
        var data = $(this).find('.pokoje').text().split(' ').filter(Boolean);
        console.log($(this).find('.pokoje').text());
        console.log(data); // Sprawdź, czy dane są prawidłowo pobierane
        
        // Wypełnianie danych w polach
        $('.data').eq(0).val(data[0]);
        $('.data').eq(1).val(data[1]);
        data[2] === "Wolne" ? $('.data').eq(2).val(0) : $('.data').eq(2).val(1);
        data[3] === "Brudny" ? $('.data').eq(3).val(0) : $('.data').eq(3).val(1);
        data[4] === "Aktywny" ? $('.data').eq(4).val(0) : $('.data').eq(4).val(1);
        $('.data').eq(0).prop('disabled', true).addClass('bg-gray-200');
        
        $('.popText').text(`Edytuj pokój ${data[0]}`);
        $('.popTextDelete').text(`Wykluczyć pokój ${data[0]}?`);
        $('.popTextDeleteRoom').text(`Czy na pewno usunąć pokój ${data[0]}?`);

        // Wyświetlanie customowego menu kontekstowego
        $(".contextMenuBlocked").removeClass('hidden').css({
            top: event.pageY + "px",
            left: event.pageX + "px"
        });

        animate(
            $('.contextMenuBlocked'),
            { opacity: 100, duration: 0.2 }
        )
    });

    // Ukrycie menu po kliknięciu poza nim
    $(document).on("click", function() {
        //Ukryj menu
        animate(
            $('.contextMenuBlocked'),
            { opacity: 0, duration: 0.2 }
        )

        setTimeout(function() {
            $('.contextMenuBlocked').removeClass('visible').addClass('hidden');
        }, 200);
    });
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

    $('.menuElement').eq(2).on('click', function() {
        manageCustomMenu('.popDeleteRoom', '.pop2DeleteRoom', '.menuElement', '.menuElementBlocked');
    });

    $('.menuElementBlocked').eq(0).on('click', function() {
        manageCustomMenu('.popPersonel', '.pop2Personel', '.menuElementBlocked', '.menuElement');
    });

    $('.menuElementBlocked').eq(1).on('click', function() {
        manageCustomMenu('.popDelete', '.pop2Delete', '.menuElementBlocked', '.menuElement');    
    });

    $('.menuElementBlocked').eq(2).on('click', function() {
        manageCustomMenu('.popDeleteRoom', '.pop2DeleteRoom', '.menuElementBlocked', '.menuElement');
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
        if(!$(event.target).closest(pop2).length 
            && !$(event.target).is(menuElementBlocked) 
            && !$(event.target).is(menuElement)
            && !$(event.target).is('.addPokoj')
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

$('.addPokoj').on('click', function() {
    manageCustomMenu('.popPersonel', '.pop2Personel', '.menuElement', '.menuElementBlocked');

    $('.data').eq(0).prop('disabled', false).addClass('bg-white');

    $('.data').eq(0).val('');
    $('.data').eq(1).val('');
    $('.data').eq(2).val('');
    $('.data').eq(3).val('');

    $('.popPersonel').removeClass('invisible').addClass('visible');
    animate(
        $('.popPersonel'),
        { opacity: 1 },
        { duration: 0.2, easing: "ease-out" }
    );
});

// Wyślij ajax z edycją pokoju
$('.sendAjax').on('click', function() {

    var data = {
        'id' : $('.data').eq(0).val(),
        'pietro' : $('.data').eq(1).val(),
        'status' : $('.data').eq(2).val(),
        'czysty' : $('.data').eq(3).val(),
        'wykluczony' : $('.data').eq(4).val()
    };
    
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url : "/pokojePost",
        data : {
            data
        },
        method : 'POST',
        success : function(result){
            console.log("Sukces: ", result);
            console.log(result.pokoje);
            // window.location.replace('/pokoje');

            refreshPokoje(result);
        },
        error: function(xhr, status, error) {
            console.error("Wystąpił błąd:");
            console.error("Status: ", status);
            console.error("Błąd: ", error);
            console.error("Odpowiedź serwera: ", xhr.responseText);
        }
    });
});

// Wyślij ajax z wykluczeniem/przywróceniem pokoju
$('.butYes').on('click', function() {

    var data = {
        'id' : $('.data').eq(0).val()
    };
    
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url : "/pokojePostDeactivate",
        data : {
            data
        },
        method : 'POST',
        success : function(result){
            console.log("Sukces: ", result);
            //window.location.replace('/pokoje');

            refreshPokoje(result);
        },
        error: function(xhr, status, error) {
            console.error("Wystąpił błąd:");
            console.error("Status: ", status);
            console.error("Błąd: ", error);
            console.error("Odpowiedź serwera: ", xhr.responseText);
        }
    });
});

$('.butYesDelete').on('click', function() {

    var data = {
        'id' : $('.data').eq(0).val()
    };
    
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url : "/pokojePostDelete",
        data : {
            data
        },
        method : 'POST',
        success : function(result){
            console.log("Sukces: ", result);
            //window.location.replace('/pokoje');

            refreshPokoje(result);
        },
        error: function(xhr, status, error) {
            console.error("Wystąpił błąd:");
            console.error("Status: ", status);
            console.error("Błąd: ", error);
            console.error("Odpowiedź serwera: ", xhr.responseText);
        }
    });
});

function refreshPokoje(result) {
    const roomsContainer = $('.roomsContainer');
    const roomsContainerBlocked = $('.roomsContainerBlocked');

    $('.tableClass').remove();
    $('.tableClassBlocked').remove();

    result.pokoje.forEach(room => {
        if (room.wykluczone === 0) { // Tylko aktywne pokoje
            const roomHTML = `
                <a class="tableClass cursor-pointer grid grid-cols-5 transition-all duration-300 hover:bg-gray-300 px-2 py-1 rounded-md">
                    <div class="pokoje">${room.id} </div>
                    <div class="pokoje">${room.pietro} </div>
                    <div class="pokoje">${room.status ? 'Zajęte' : 'Wolne'} </div>
                    <div class="pokoje">${room.czyste ? 'Czysty' : 'Brudny'} </div>
                    <div class="pokoje">${room.wykluczone ? 'Wykluczony' : 'Aktywny'} </div>
                </a>
            `;
            roomsContainer.append(roomHTML); // Dodaj pokój do kontenera
        } else {
            const roomHTML = `
                <a class="tableClassBlocked cursor-pointer grid grid-cols-5 transition-all duration-300 hover:bg-gray-300 px-2 py-1 rounded-md">
                    <div class="pokoje">${room.id} </div>
                    <div class="pokoje">${room.pietro} </div>
                    <div class="pokoje">${room.status ? 'Zajęte' : 'Wolne'} </div>
                    <div class="pokoje">${room.czyste ? 'Czysty' : 'Brudny'} </div>
                    <div class="pokoje">${room.wykluczone ? 'Wykluczony' : 'Aktywny'} </div>
                </a>
            `;
            roomsContainerBlocked.append(roomHTML); // Dodaj pokój do kontenera
        }
    });

    // edit
    animate(
        $('.popPersonel'),
        { opacity: 0 },
        { duration: 0.2, easing: "ease-out" }
    );
    
    setTimeout(function() {
        $('.popPersonel').removeClass('visible').addClass('invisible');
    }, 200);

    // delete
    animate(
        $('.popDelete'),
        { opacity: 0 },
        { duration: 0.2, easing: "ease-out" }
    );
    
    setTimeout(function() {
        $('.popDelete').removeClass('visible').addClass('invisible');
    }, 200);

    // Delete
    animate(
        $('.popDeleteRoom'),
        { opacity: 0 },
        { duration: 0.2, easing: "ease-out" }
    );
    
    setTimeout(function() {
        $('.popDeleteRoom').removeClass('visible').addClass('invisible');
    }, 200);
}