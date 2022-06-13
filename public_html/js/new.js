var support = $('#brand');
support.owlCarousel({
    items: 8,
    rtl: true,
    center: true,
    dots: false,
    width: 20,
    autoplay: true,
    autoplaySpeed: 1000,
    autoplayTimeout: 2000,

    loop: true,
    margin: 10,
    responsive: {
        0: {
            items: 3
        },
        400: {
            items: 4
        },
        1000: {
            items: 7
        },
        1280: {
            items: 8
        },
    },
});


jQuery(document).ready(function ($) {
    $(".regular").slick({
        dots: true,
        autoplay: true,
        autoplaySpeed: 9000,
        speed: 700,
        mobileFirst: true,
        slidesToShow: 1,
        slidesToScroll: 1,
        pauseOnHover: false,
        respondTo: 'min',
        cssEase: 'linear',
        prevArrow: '<span class="icon-angle-left"></span>',
        nextArrow: '<span class="icon-angle-right"></span>'
    });

    $('.slider-for').slick({
        slidesToShow: 1,
        slidesToScroll: 1,
        arrows: false,
        draggable: false,
        fade: true,
        autoplay: true,
        asNavFor: '.slider-nav'
    });

    $('.slider-nav').slick({
        slidesToShow: 3,
        slidesToScroll: 1,
        asNavFor: '.slider-for',
        dots: false,
        arrows: true,
        autoplay: true,
        centerMode: true,
        focusOnSelect: true,
        centerPadding: '10px',
        prevArrow: '<span class="icon-angle-left"></span>',
        nextArrow: '<span class="icon-angle-right"></span>',
        responsive: [
            {
                breakpoint: 849,
                settings: {
                    dots: false,
                    slidesToShow: 3,
                    centerPadding: '0px',
                }
            },
            {
                breakpoint: 768,
                settings: {
                    dots: false,
                    slidesToShow: 1,
                    centerPadding: '0px',
                }
            },
            {
                breakpoint: 420,
                settings: {
                    autoplay: true,
                    dots: false,
                    slidesToShow: 1,
                    centerMode: false,
                }
            }
        ]
    });


    var progressStep = document.querySelectorAll('.progress-step')[0];
    var progres = document.querySelectorAll('.progres');
    var progressComplited = document.querySelectorAll('.progress-complited')[0];
    var tab = document.querySelectorAll('.tab');

    tab[0].classList.add('active');
    progres[0].classList.add('active');

    for (i = 0; i < progres.length; i++) {

        progres[i].setAttribute('value', i);

        progres[i].addEventListener('click', function (e) {

            var counter = e.target.getAttribute('value');

            for (i = 0; i <= counter; i++) {
                progres[i].classList.add('active');

                progressComplited.style.width = (20 * counter) + '%';
            }

            for (i = progres.length - 1; i > counter; i--) {
                progres[i].classList.remove('active');
            }

            for (i = 0; i < progres.length; i++) {
                tab[i].classList.remove('active');
                tab[counter].classList.add('active');
            }

        });
    }


    $(".scroll").click(function (event) {
        event.preventDefault();
        $("html,body").animate({scrollTop: $(this.hash).offset().top}, 1000)
    })
});

$(function () {
    $(".typed").typed({
        strings: ["به سبک پی زندگی کن", "با ما وارد دنیای دیجیتال شوید", "تفاوت را با ما تجربه کنید"],
        // Optionally use an HTML element to grab strings from (must wrap each string in a <p>)
        stringsElement: null,
        // typing speed
        typeSpeed: 30,
        // time before typing starts
        startDelay: 1200,
        // backspacing speed
        backSpeed: 20,
        // time before backspacing
        backDelay: 500,
        // loop
        loop: true,
        // false = infinite
        loopCount: true,
        // show cursor
        showCursor: false,
        // character for cursor
        cursorChar: "|",
        // attribute to type (null == text)
        attr: null,
        // either html or text
        contentType: 'html',
        // call when done callback function
        callback: function () {
        },
        // starting callback function before each string
        preStringTyped: function () {
        },
        //callback for every typed string
        onStringTyped: function () {
        },
        // callback for reset
        resetCallback: function () {
        }
    });
});

$(window).scroll(function () {
    if ($('.header-nav-item').offset().top > 20) {
        $('.header-nav-item').addClass('header-nav-item-fix');
    } else {
        $('.header-nav-item').removeClass('header-nav-item-fix');
    }
});

let tab = $('#tab');
tab.owlCarousel({
    rtl: true,
    dots: false,
    margin: 20,
    autoplay: true,
    autoplayTimeout: 2500,
    autoplayHoverPause: true,
    loop: true,
    responsive: {
        0: {
            items: 2
        },
        600: {
            items: 4
        },
        1000: {
            items: 5
        },
        1200: {
            items: 6
        }
    }
});

function DropDown(el) {
    this.dd = el;
    this.placeholder = this.dd.children('span');
    this.opts = this.dd.find('ul.dropdown > li');
    this.val = '';
    this.index = -1;
    this.initEvents();
}

DropDown.prototype = {
    initEvents: function () {
        var obj = this;

        // obj.dd.on('click', function (event) {
        //     $(this).toggleClass('active');
        //     return false;
        // });

        // obj.opts.on('click', function () {
        //     var opt = $(this);
        //     obj.val = opt.text();
        //     obj.index = opt.index();
        //     obj.placeholder.text(obj.val);
        // });
    },
    getValue: function () {
        return this.val;
    },
    getIndex: function () {
        return this.index;
    }
};

$(function () {
    var dd = new DropDown($('#user'));
    $(document).click(function () {
        // all dropdowns
        $('.wrapper-dropdown-3').removeClass('active');
    });
});

