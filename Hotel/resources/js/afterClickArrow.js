$('.svg-flex').first().click(() => {
    var url = $(location).attr('href');
    var string = url.split('/');
    var currentMonth = string[string.length - 2];
    var currentYear = string[string.length - 1];

    currentMonth--;

    if(currentMonth < 1) {
        currentMonth = 12;
        currentYear--;
    }

    string[string.length - 1] = currentYear;
    string[string.length - 2] = currentMonth;

    window.location.replace(string.join('/'));
});

$('.svg-flex').last().click(() => {
    var url = $(location).attr('href');
    var string = url.split('/');
    var currentMonth = string[string.length - 2];
    var currentYear = string[string.length - 1];

    currentMonth++;

    if(currentMonth > 12) {
        currentMonth = 1;
        currentYear++;
    }

    string[string.length - 1] = currentYear;
    string[string.length - 2] = currentMonth;

    window.location.replace(string.join('/'));
});