jQuery(document).ready(function($) {
    $(document).foundation();
    $(document)
        .on("opened.zf.offCanvas", function() {
            $(".hamburger").addClass("is-active");
        })
        .on("closed.zf.offCanvas", function() {
            $(".hamburger").removeClass("is-active");
        });
});

jQuery(document).ready(function($) {
    $('.hamburger--elastic').on('click', function() {
        const isExpanded = $(this).attr('aria-expanded') === 'true';
        $(this).attr('aria-expanded', !isExpanded);
        $('#off-canvas').attr('aria-hidden', isExpanded);
    });
    $('.close-button').on('click', function() {
        $('.hamburger--elastic').attr('aria-expanded', 'false');
        $('#off-canvas').attr('aria-hidden', 'true');
    });
});

document.addEventListener('DOMContentLoaded', function () {
    new Swiper('.testimonial-slider', {
        slidesPerView: 1,
        spaceBetween: 20,
        loop: true,
        pagination: {
            el: '.swiper-pagination',
            clickable: true,
        },
        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
        },
        autoplay: {
            delay: 5000,
            disableOnInteraction: false,
        },
        breakpoints: {
            640: {
                slidesPerView: 1,
            },
            1024: {
                slidesPerView: 2,
            },
        },
    });
});