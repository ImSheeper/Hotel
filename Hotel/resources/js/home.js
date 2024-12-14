$(document).ready(function() {
    $('.magazynContainer').find('.tableClass').each(function(index) {
        if ($(this).find('.magazyn').eq(1).text() <= 5) {
            $(this).addClass('font-bold text-red-500')
        }
    });

    $('.roomsContainer').find('.tableClass').each(function(index) {
        if ($(this).find('.pokoje').eq(2).text().trim() === 'Zajęte') {
            $(this).addClass('font-bold text-orange-500');
        }
        
        if ($(this).find('.pokoje').eq(3).text().trim() === 'Brudny') {
            $(this).addClass('font-bold text-red-500').removeClass('text-orange-500');
        }
    });
});