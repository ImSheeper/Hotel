$(document).ready(function() {
    $('.but').on('click', function() {
        var child = document.querySelectorAll('.json .document');
        var name = location.pathname.split('/').slice(-3)[0];

        //Manipulacja warningiem dla użytkownika - do poprawy, nie chce się wykonywać animacja drugi raz
        //$('.warnUser').removeClass('invisible').addClass("visible animate-jump");

        //Separator danych. Liczba 6 to liczba danych w JSON
        var dataSeparator = 8;

        //Rozpoczęcie pobierania danych do AJAX
        var data = [];

        //wpisz do data dane JSON
        var j = 0
        for (var i = 0; i <= child.length - dataSeparator; i += dataSeparator) { //podziel tablicę na obiekt, czyli przez 6
            data[j] = 
                {
                    "rok" : child[i].innerText,
                    "numer dni" : child[i + 1].innerText,
                    "miesiąc" : child[i + 2].innerText,
                    "dzisiejszy dzien" : child[i + 3].innerText,
                    "nazwa dnia" : child[i + 4].innerText,
                    "stanowisko" : child[i + 5].innerText,
                    "login" : child[i + 6].innerText,
                    "status" : child[i + 7].innerText,
                }
            if(child[i + 5].innerText == "") {
                alert("Proszę uzupełnić wszystkie pola!");
                return;
            }
            j++;
        }

        //pobieranie daty z url
        var url = $(location).attr('href');
        var string = url.split('/');
        var currentMonth = string[string.length - 2];
        var currentYear = string[string.length - 1];

        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            //tutaj trzeba zrobic url dla uzytkownika - chyba teraz działa, ale zobaczymy podczas testów
            url : "/personel" + "/" + name + '/' + currentMonth + '/' + currentYear,
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

    flatpickr(".date", {
        plugins: [
            new monthSelectPlugin({
                altInput: true,
                altFormat: "F Y",
                dateFormat: "Y-m"
            })
        ],
        locale: "pl",
        onChange: function() {
            var dateString = $('.date').val();
            var date = new Date(dateString);
            var options = { year: 'numeric', month: 'long' };
            var formattedDate = date.toLocaleDateString('pl-PL', options);
            $('.date').val(formattedDate);

            var redirectDate = dateString.split('-');

            var url = $(location).attr('href');
            var string = url.split('/');
            var currentMonth = parseInt(redirectDate[1]);
            var currentYear = redirectDate[0];

            string[string.length - 1] = currentYear;
            string[string.length - 2] = currentMonth;   

            window.location.replace(string.join('/'));
        }
    });

    var dateString = $('.date').val();
    var date = new Date(dateString);
    var options = { year: 'numeric', month: 'long' };
    var formattedDate = date.toLocaleDateString('pl-PL', options);
    $('.date').val(formattedDate);


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
            url : "/grafikWholePost" + "/" + currentMonth + '/' + currentYear,
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
