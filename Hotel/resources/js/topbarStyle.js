import { animate, glide } from "motion"

$(document).ready(function() {
    var path = location.pathname;
    var name = '';

    if(path.includes('personel')) name = 'Zarządzaj personelem';
    if(path.includes('home')) name = 'Strona główna';
    if(path.includes('magazyn')) name = 'Magazyn';
    if(path.includes('pokoje')) name = 'Zarządzaj pokojami';

    if(path.includes('grafikWhole')) {
        if($('.stanowiskoTopbar').text().trim() === 'Właściciel Hotelu' || $('.stanowiskoTopbar').text().trim() === 'Menedżer Hotelu') {
            name = 'Grafik pracowników';
        } else {
            name = 'Twój grafik';
        }
    }


    $('.nameTopbar').text(name);

    $('.logOut').on('click', function() {
        location.href = '/';
    });
});

$(document).on('click', function( event ) {
    var target = $(event.target);

    if (target.is('.burgerMenu') || target.closest('.burgerMenu').length) {

        $('.menuClass').removeClass('hidden');

        animate(
            $('.menuClass'),
            { x: [-400, 0] },
            { easing: "ease-out", duration: 0.3 }
        );
    } else if (target.is('.menuClass') || target.closest('.menuClass').length) {
        return;
    }
    else {
        animate(
            $('.menuClass'),
            { x: [0, -400] },
            { easing: "ease-out", duration: 0.3 },
            function() {
                $('.menuClass').addClass('hidden');
            }
        );
    }
});