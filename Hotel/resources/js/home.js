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

    $('.select').change(function() {
        var url = $(location).attr('href');
        var string = url.split('/');
        var currentMonth = string[string.length - 2];
        var currentYear = string[string.length - 1];

        console.log(currentMonth);
        console.log(currentYear);

        var stanowisko = $('.select').val();

        const grafikContainer = document.getElementById('grafik');
        grafikContainer.innerHTML = ''
        
        var data = {
            'stanowisko' : stanowisko
        };

        console.log(data);

        // Dynamiczny grafik
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url : "/homePost" + "/" + currentMonth + '/' + currentYear,
            data : {
                data
            },
            method : 'POST',
            success : function(result){
                console.log("Sukces: ", result);
                $('#grafik').html(result.html);
            },
            error: function(xhr, status, error) {
                console.error("Wystąpił błąd:");
                console.error("Status: ", status);
                console.error("Błąd: ", error);
                console.error("Odpowiedź serwera: ", xhr.responseText);
            }
        });
    })
});