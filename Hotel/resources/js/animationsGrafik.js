import { animate, glide } from "motion"

//Animacja strzałek
//left arrow
$('.svg-flex').first().on('mouseenter', function() {
    animate(
        $('.svg-icon').first(),
        { x: -10 },
        { easing: "ease-out" },
    )

    //Gradient dla dni
    let gradient = 0.15;
    for(let i = 0; i < 7; i++) {
        animate(
            $('.document-animation').eq(i),
            { x: 30, opacity: gradient },
            { easing: "ease-out" },
        )  
        gradient += 0.15;
    }

    //Gradient na opacity dla json
    let j = 0;
    let opacity = 0.1;
    let length = $('.json').length;

    for(var i = 0; i < length; i++) {
        animate(
            $('.json').eq(i),
            { x: 30, opacity: opacity },
            { easing: "ease-out" },
        ) 
        j++ 
        if(j == 7) {
            opacity = 0;
            j = 0;
        }
        opacity += 0.15;
    }

    //Animacja na tekst
    $('.previousMonth').removeClass('invisible').addClass('visible');
    animate(
        $('.previousMonth'),
        { opacity: 1, x: [-100, 100]},
        { easing: glide({ velocity: 200 }) }
    )
});

//right arrow
$('.svg-flex').last().on('mouseenter', function() {
    animate(
        $('.svg-icon').last(),
        { x: 10 },
        { easing: "ease-out" },
    )

    //Gradient dla dni
    let gradient = 0.15;
    for(let i = 6; i >= 0; i--) {
        animate(
            $('.document-animation').eq(i),
            { x: -30, opacity: gradient },
            { easing: "ease-out" },
        )  
        gradient += 0.15;
    }

    //Gradient na opacity
    let j = 0;
    let opacity = 0.1;
    let length = $('.bg-gray-200').length - 2;
    var minus = 0;

    var cases = {
        28: 1,
        29: 2,
        30: 3,
        31: 4
    }

    var calendarLen = $('.document').eq(-3).text();
    let blockedLen = $('.bg-gray-300').length;
    console.log(length);    

    minus = cases[calendarLen];
    console.log(minus);

    for(var i = $('.json').length; i > 0; i--) {
        animate(
            //hardcode - do poprawy - hardcode poprawiony, do poprawek graficznych
            $('.json').eq(i - minus - blockedLen),
            { x: -30, opacity: opacity },
            { easing: "ease-out" },
        ) 
        j++;
        if(j == 7) {
            opacity = 0;
            j = 0;
        }
        opacity += 0.15;
    }

    //Animacja na tekst
    $('.nextMonth').removeClass('invisible').addClass('visible');
    animate(
        $('.nextMonth'),
        { opacity: 1, x: [100, -100]},
        { easing: glide({ velocity: -200 }) }
    )
});

//on leave arrow
$('.svg-flex').on('mouseleave', function() {
    animate(
        $('.svg-icon'),
        { x: 0 },
        { easing: "ease-out" }
    )

    animate(
        $('.json'),
        { x: 0, opacity: 1, duration: 10},
        { easing: "ease-out" }
    )

    //Gradient dla dni
    for(let i = 0; i < 7; i++) {
        animate(
            $('.document-animation').eq(i),
            { x: 0, opacity: 1 },
            { easing: "ease-out" },
        )  
    }

    //animacja na tekst;
    animate(
        $('.previousMonth'),
        { opacity: 0, x: [60, -40]},
        { easing: "ease-out", duration: 0.2 }
    )

    animate(
        $('.nextMonth'),
        { opacity: 0, x: [-60, 40]},
        { easing: "ease-out", duration: 0.2 }
    )
});
