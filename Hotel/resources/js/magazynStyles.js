import { animate, glide } from "motion"

$(document).ready(function() {
    // Delegacja zdarzenia contextmenu na dynamicznie dodane elementy .tableClass
    $(".magazynContainer").on("contextmenu", ".tableClass", function(event) {
        event.preventDefault();
        
        var data = $(this).find('.magazyn').text().split(' ').filter(Boolean);
        console.log(data); // Sprawdź, czy dane są prawidłowo pobierane
        
        // Wypełnianie danych w polach
        $('.data').eq(0).val(data[0]);
        $('.data').eq(1).val(data[1]);

        $('.popText').text(`Edytuj produkt ${data[0]}`);
        // $('.popTextDelete').text(`Wykluczyć pokój ${data[0]}?`);
        // $('.popTextDeleteRoom').text(`Czy na pewno usunąć pokój ${data[0]}?`);
        // console.log('event', $(this).text());

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

// Customowe menu popUp
// Animate popUp - otwieranie popup
$(document).ready(function() {
    $('.menuElement').eq(0).on('click', function() {
        manageCustomMenu('.popMagazyn', '.pop2Magazyn', '.menuElement', '.menuElementBlocked');
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
            && !$(event.target).is(menuElement)
            && !$(event.target).is('.addZapas')
            || $(event.target).is('.close') && !$(event.target).is('.but')) {
                console.log('test');
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

$('.addZapas').on('click', function() {
    manageCustomMenu('.popUzupelnij', '.pop2Uzupelnij', '.menuElement', '.menuElementBlocked');
});

// Wyślij ajax z edycją pokoju
$('.sendAjax').on('click', function() {

    var data = {
        'nazwa' : $('.data').eq(0).val(),
        'akcja' : $('.data').eq(1).val(),
        'ilosc' : $('.data').eq(2).val()
    };
    
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url : "/magazynPost",
        data : {
            data
        },
        method : 'POST',
        success : function(result){
            console.log("Sukces: ", result);
            console.log(result.pokoje);
            // window.location.replace('/pokoje');

            refresh(result);
        },
        error: function(xhr, status, error) {
            console.error("Wystąpił błąd:");
            console.error("Status: ", status);
            console.error("Błąd: ", error);
            console.error("Odpowiedź serwera: ", xhr.responseText);
        }
    });
});

$(document).ready(function() {
    $('.dataProdukt').eq(0).on('change', function() {
        var action = parseInt($('.dataProdukt').eq(0).val());
        switch(action) {
            case 0:
                $('.dataProdukt').eq(2).addClass('flex').removeClass('hidden');
                $('.dataProdukt').eq(1).addClass('hidden').removeClass('flex');
                break;
            case 1:
                $('.dataProdukt').eq(1).addClass('flex').removeClass('hidden');
                $('.dataProdukt').eq(2).addClass('hidden').removeClass('flex');
                break;
        }
    });
});

$('.sendAjaxProdukt').on('click', function() {

    var data = {
        'nazwaAdd' : $('.dataProdukt').eq(1).val(),
        'nazwaDelete' : $('.dataProdukt').eq(2).val(),
        'akcja' : $('.dataProdukt').eq(0).val(),
    };
    
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url : "/magazynPostProdukt",
        data : {
            data
        },
        method : 'POST',
        success : function(result){
            console.log("Sukces: ", result);
            console.log(result.pokoje);
            // window.location.replace('/pokoje');

            refresh(result);

            // console.log('magazyn', magazyn);
            // let selectElement = $('#Produkt');
            // produkt.forEach(item => {
            //     selectElement.append(`<option value="${item.nazwa}">${item.nazwa}</option>`);
            // });
        },
        error: function(xhr, status, error) {
            console.error("Wystąpił błąd:");
            console.error("Status: ", status);
            console.error("Błąd: ", error);
            console.error("Odpowiedź serwera: ", xhr.responseText);
        }
    });
});

function refresh(result) {
    const magazynContainer = $('.magazynContainer');
    const produktContainer = $('#Produkt');
    const produktContainer2 = $('#Produkt2');
    
    $('.tableClass').remove();
    //$('.produktItem').remove();
    produktContainer.empty();
    produktContainer2.empty();

    // edit
    animate(
        $('.popMagazyn'),
        { opacity: 0 },
        { duration: 0.2, easing: "ease-out" }
    );
    
    setTimeout(function() {
        $('.popMagazyn').removeClass('visible').addClass('invisible');
    }, 200);


        // edit
    animate(
        $('.popUzupelnij'),
        { opacity: 0 },
        { duration: 0.2, easing: "ease-out" }
    );

    setTimeout(function() {
        $('.popUzupelnij').removeClass('visible').addClass('invisible');
    }, 200);

    result.produkt.forEach(prod => {
        const prodHTML = `
            <option value=${prod.nazwa}> ${prod.nazwa} </option>
        `;
        
        produktContainer.append(prodHTML);
        produktContainer2.append(prodHTML);
    });

    result.produkt.forEach((prod, index) => {
        const magHTML = `
            <div class="tableClass cursor-pointer grid grid-cols-2 transition-all duration-300 hover:bg-gray-300 px-2 py-1 rounded-md">
                <div class="magazyn">${prod.nazwa} </div>
                <div class="magazyn">${result.magazyn[index].ilosc} </div>
            </div>
        `;
        magazynContainer.append(magHTML);
    });
}