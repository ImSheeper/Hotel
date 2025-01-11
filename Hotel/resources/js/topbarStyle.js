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
});