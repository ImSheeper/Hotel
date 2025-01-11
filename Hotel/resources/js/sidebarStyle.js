$(document).ready(function() {
    //oznaczenie menu jako szare
    var path = location.pathname;
    var name = location.pathname.split('/').slice(-1)[0];

    if(path.includes('personel')) name = 'grafik';
    if(path.includes('grafikWhole')) name = 'grafikWhole';
    if(path.includes('home')) name = 'home';
    
    $('.menu').find('button').each(function() {
        if(name === $(this).val()) {
            $(this).addClass('bg-gray-200 rounded-md');
        }
    })
});