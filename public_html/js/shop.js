$(document).ready(function () {

    $('.city').slideUp(0);
    $('.select_city').change(function () {
        if ($(this).val() == 2) {
            $('.city').slideDown(100);
        } else {
            $('.city').slideUp(100);
        }
    });

    $('.login_modal').submit(function (e) {
        e.preventDefault();
        let _token = $('input[name="_token"]').val();
        let data = new FormData($(this)[0]);
        $('.error').empty();
        $.ajax({
            url: '/login',
            type: 'POST',
            data: data,
            contentType: false,
            processData: false,
            headers: {
                'X-CSRF-TOKEN': _token
            },
            success: function (response) {
                location.reload();
            }, error: function (response) {
                $('.show-error').empty();
                $('.show-error').append([
                    '<div class="alert alert-danger col-md-10 mx-auto text-center pb-0 pt-2">' +
                    '<p class="login-error small">اطلاعات وارد شده صحیح نمیباشد</p>' +
                    '</div>'
                ]);
            }
        })
    });

    $('.province').change(function () {
        let prov_id = $(this).val();
        console.log(prov_id);
        $.ajax({
            method: 'GET',
            url: '/ajaxProvince/' + prov_id,
            success: function (response) {
                $('.myCity').empty();
                $.each(response, function (index, key) {
                    $('.myCity').append(
                        '<option value="' + key.id + '">' + key.name + '</option>'
                    );
                });
            },
            error: function () {

            }
        });

    });

    $('#small_image li img').click(function () {
        let src = $(this).attr('src');
        let fade = $('#change_image');
        fade.fadeOut('fast', function () {
            fade.attr('src', src);
            fade.fadeIn('fast');
        });
    });

    // $(".add_cart").click(function () {
    //     setTimeout(function () {
    //         $('#exampleModalCenter1').modal('hide');
    //     }, 1500);
    //     let id = $(this).data('id');
    //     $.ajax({
    //         type: 'GET',
    //         url: '/user/cart/' + id,
    //         contentType: false,
    //         processData: false,
    //         success: function (response) {
    //             console.log(response);
    //             // let cart_count = response['cart'].length;
    //             // $('.cart_count').html(cart_count);
    //             // $('.total_cart').html(FormatNumberBy3(response['total_cart'] + ' تومان'));
    //             // $('.total_weight').html(response['total_weight']);
    //             //
    //             // $('.modal_cart').empty();
    //             // $.each(response['cart'], function (key, val) {
    //             //     $('.modal_cart').append(
    //             //         '<div class="row img-modal mt-3 mt-5 parent">' +
    //             //         '<img src=" ' + val.image + ' " width="100" height="90" class="col-4 p-1">' +
    //             //         '<div class="col-8 m-0 ">' +
    //             //
    //             //         '<div class="d-flex justify-content-between">' +
    //             //         '<p>' + val.name + '</p>' +
    //             //         '<a href="" class="btn btn-outline-secondary btn-sm fa fa-times rounded h-75 delete" data-id=" ' + val.id + ' "></a>' +
    //             //         '</div>' +
    //             //
    //             //         '<label class="pb-3 m-0 small"> قیمت : </label>' +
    //             //         '<span class="pb-3 m-0 small">' + FormatNumberBy3(val.price) + ' تومان</span>' +
    //             //         '<br>' +
    //             //         '<label class="pb-3 m-0 small text-success"> قیمت کل : </label>' +
    //             //         '<span class="pb-3 m-0 small text-success total_price">' + FormatNumberBy3(val.price * val.count) + ' تومان</span>' +
    //             //
    //             //         '<div class="d-flex m-0 align-items-center text-size pb-3 dd">' +
    //             //         '<label> تعداد : </label>' +
    //             //         '<button class="btn btn-outline-dark fa fa-plus border-0 mx-0 p"></button>' +
    //             //         '<input class="text1 input_count form-control mx-0 col-3 rounded-circle text-center border-0 count" data-id=" ' + val.id + ' " data-title=" ' + val.limit_count + ' " value=" ' + val.count + ' ">' +
    //             //         '<button class="fa fa-minus btn btn-outline-dark border-0 mx-0 m"></button>' +
    //             //         '</div>' +
    //             //         '</div>' +
    //             //         '</div>'
    //             //     );
    //             // });
    //             //
    //             // $('.delete').click(function (e) {
    //             //     e.preventDefault();
    //             //     let delete_id = $(this).data('id');
    //             //     $(this).parents('.parent').empty();
    //             //
    //             //     $.ajax({
    //             //         type: 'GET',
    //             //         url: '/user/cart/destroy/' + delete_id,
    //             //         contentType: false,
    //             //         processData: false,
    //             //         success: function (response) {
    //             //             let cart_count = response['cart'].length;
    //             //             $('.cart_count').html(cart_count);
    //             //
    //             //             if (response['total_cart'] === 0) {
    //             //                 $('.modal_cart').append([
    //             //                     '<div class="p-3 text-center">' +
    //             //                     '<img src="/image/empty-cart.png" width="100%">' +
    //             //                     '<h6 class="my-3 text-muted">هیچ کالایی در سبد خرید وجود ندارد!</h6>' +
    //             //                     '</div>'
    //             //                 ]);
    //             //             }
    //             //
    //             //             $('.total_cart').html(FormatNumberBy3(response['total_cart'] + ' تومان'));
    //             //             $('.total_weight').html(response['total_weight']);
    //             //         }
    //             //     });
    //             // });
    //             //
    //             // $('.m').click(function () {
    //             //     let this_m = $(this);
    //             //     $(this).prev('input').val(function (i, oldval) {
    //             //         if (oldval > 1) {
    //             //             return --oldval;
    //             //         } else {
    //             //             return 1;
    //             //         }
    //             //     });
    //             //     let count = $(this).prev('input').val();
    //             //     let cart_id = $(this).prev('input').data('id');
    //             //     $.ajax({
    //             //         type: 'GET',
    //             //         url: '/user/cart/count/' + cart_id + '/' + count,
    //             //         contentType: false,
    //             //         processData: false,
    //             //         success: function (response) {
    //             //             let total_price = response['cart']['price'] * response['cart']['count'];
    //             //             this_m.closest('.dd').prev('.total_price').html(FormatNumberBy3(total_price) + ' تومان');
    //             //
    //             //             $('.total_cart').html(FormatNumberBy3(response['total_cart'] + ' تومان'));
    //             //             $('.total_weight').html(response['total_weight']);
    //             //         }
    //             //     });
    //             //
    //             // });
    //             //
    //             // $('.p').click(function () {
    //             //
    //             //     let c = parseInt($(this).next('input').data('title'));
    //             //
    //             //     let this_p = $(this);
    //             //     $(this).next('input').val(function (i, oldval) {
    //             //         if (oldval < c) {
    //             //             return ++oldval;
    //             //         } else {
    //             //             return c;
    //             //         }
    //             //     });
    //             //     let count = $(this).next('input').val();
    //             //     let cart_id = $(this).next('input').data('id');
    //             //     $.ajax({
    //             //         type: 'GET',
    //             //         url: '/user/cart/count/' + cart_id + '/' + count,
    //             //         contentType: false,
    //             //         processData: false,
    //             //         success: function (response) {
    //             //             console.log(response);
    //             //             let total_price = response['cart']['count'] * response['cart']['price'];
    //             //             this_p.closest('.dd').prev('.total_price').html(FormatNumberBy3(total_price) + ' تومان');
    //             //
    //             //             $('.total_cart').html(FormatNumberBy3(response['total_cart'] + ' تومان'));
    //             //             $('.total_weight').html(response['total_weight']);
    //             //         }
    //             //     });
    //             //
    //             //
    //             // });
    //         }, error: function (response) {
    //
    //         }
    //     });
    //
    // });

    $('.delete').click(function (e) {
        e.preventDefault();
        let delete_id = $(this).data('id');
        $(this).parents('.parent').empty();
        $.ajax({
            type: 'GET',
            url: '/user/cart/destroy/' + delete_id,
            contentType: false,
            processData: false,
            success: function (response) {
                let cart_count = response['cart'].length;
                $('.cart_count').html(cart_count);

                if (response['total_cart'] === 0) {
                    $('.modal_cart').append([
                        '<div class="p-3 text-center">' +
                        '<img src="/image/empty-cart.png" width="100%">' +
                        '<h6 class="my-3 text-muted">هیچ کالایی در سبد خرید وجود ندارد!</h6>' +
                        '</div>'
                    ]);
                }

                $('.total_cart').html(FormatNumberBy3(response['total_cart'] + ' تومان'));
                $('.total_weight').html(response['total_weight']);
            }
        });
    });

    $('.m').click(function () {
        let this_m = $(this);
        $(this).prev('input').val(function (i, oldval) {
            if (oldval > 1) {
                return --oldval;
            } else {
                return 1;
            }
        });
        let count = $(this).prev('input').val();
        let cart_id = $(this).prev('input').data('id');
        $.ajax({
            type: 'GET',
            url: '/user/cart/count/' + cart_id + '/' + count,
            contentType: false,
            processData: false,
            success: function (response) {
                let total_price = response['cart']['qty'] * (response['cart']['product']['discount'] - response['cart']['product']['commission']);
                this_m.closest('.dd').prev('.total_price').html(FormatNumberBy3(total_price) + ' تومان');

                $('.total_cart').html(FormatNumberBy3(response['total_cart'] + ' تومان'));
                $('.total_weight').html(response['total_weight']);
            }
        });
    });

    $('.p').click(function () {
        let c = parseInt($(this).next('input').data('title'));

        let this_p = $(this);
        $(this).next('input').val(function (i, oldval) {
            if (oldval < c) {
                return ++oldval;
            } else {
                return c;
            }
        });
        let count = $(this).next('input').val();
        let cart_id = $(this).next('input').data('id');
        $.ajax({
            type: 'GET',
            url: '/user/cart/count/' + cart_id + '/' + count,
            contentType: false,
            processData: false,
            success: function (response) {
                let total_price = response['cart']['qty'] * (response['cart']['product']['discount'] - response['cart']['product']['commission']);
                this_p.closest('.dd').prev('.total_price').html(FormatNumberBy3(total_price) + ' تومان');

                $('.total_cart').html(FormatNumberBy3(response['total_cart'] + ' تومان'));
                $('.total_weight').html(response['total_weight']);
            }
        });

    });

    let headerSlider = $('.headerSlider.owl-carousel');
    let categoriesOwl = $('.categoriesOwl.owl-carousel');
    headerSlider.owlCarousel({
        rtl: true,
        dots: false,
        autoplay: true,
        autoplayTimeout: 6000,
        autoplayHoverPause: true,
        loop: true,
        responsive: {
            0: {
                items: 1
            },
            600: {
                items: 1
            },
            1000: {
                items: 1
            },
            1200: {
                items: 1
            }
        }
    });
    categoriesOwl.owlCarousel({
        rtl: true,
        dots: false,
        margin: 20,
        autoplay: true,
        autoplayTimeout: 6000,
        autoplayHoverPause: true,
        loop: true,
        responsive: {
            0: {
                items: 4
            },
            600: {
                items: 4
            },
            1000: {
                items: 8
            },
            1200: {
                items: 8
            }
        }
    });

    let setting = {
        rtl: true,
        dots: false,
        margin: 20,
        autoplay: true,
        autoplayTimeout: 6000,
        autoplayHoverPause: true,
        loop: true,
        responsive: {
            0: {
                items: 1
            },
            600: {
                items: 3
            },
            1000: {
                items: 4
            },
            1200: {
                items: 5
            }
        }
    };

    let bestSellersOwl = $('.bestSellersOwl.owl-carousel');
    bestSellersOwl.owlCarousel(setting);
    $('#best-sellers__next').click(function (e) {
        bestSellersOwl.trigger('next.owl.carousel');
    });

    $('#best-sellers__prev').click(function () {
        bestSellersOwl.trigger('prev.owl.carousel');
    });

    let similar_product = $('.similar_product.owl-carousel');
    similar_product.owlCarousel(setting);
    $('#similar_product_next').click(function (e) {
        similar_product.trigger('next.owl.carousel');
    });

    $('#similar_product_prev').click(function () {
        similar_product.trigger('prev.owl.carousel');
    });


    let newProductOwl = $('.newProductOwl.owl-carousel');
    newProductOwl.owlCarousel(setting);
    $('#best-sellers__next_new').click(function (e) {
        newProductOwl.trigger('next.owl.carousel');
    });

    $('#best-sellers__prev_new').click(function () {
        newProductOwl.trigger('prev.owl.carousel');
    });


    let specialProductOwl = $('.specialProductOwl.owl-carousel');
    specialProductOwl.owlCarousel(setting);
    $('#best-sellers__next_special').click(function (e) {
        specialProductOwl.trigger('next.owl.carousel');
    });

    $('#best-sellers__prev_special').click(function () {
        specialProductOwl.trigger('prev.owl.carousel');
    });


    let owls = $('.owl-carousel');
    owls.owlCarousel(setting);
    $('.btn_next_owl').click(function (e) {
        owls.trigger('next.owl.carousel');
    });

    $('.btn_prev_owl').click(function () {
        owls.trigger('prev.owl.carousel');
    });
});


$(".Major_order").click(function () {
    $('.modal').modal('show');
});


$('#show').ready(function () {
    $('h2').animate(
        {deg: "360"}, {
            duration: 1000,
            step: function (now) {
                $(this).css({
                    transform: 'rotate(' + now + 'deg)',
                });
            }
        }
    );
});

// $('#show').ready(function () {
//     $('h2').animate({fontSize: "60px"}, 500);
// });
//
// $('#show').ready(function () {
//     $('h2').animate(
//         {deg: "360"}, {
//             duration: 500,
//             step: function (now) {
//                 $(this).css({
//                     color: 'gold',
//                     textShadow: 'black 2px 2px 2px'
//                 });
//             }
//         }
//     );
// });

$(document).ready(function () {
    "use strict";
    var myNav = {
        init: function () {
            this.cacheDOM();
            this.browserWidth();
            this.bindEvents();
        },
        cacheDOM: function () {
            this.navBars = $(".navBars");
            this.toggle = $("#toggle");
            this.navMenu = $("#menu");
        },
        browserWidth: function () {
            $(window).resize(this.bindEvents.bind(this));
        },
        bindEvents: function () {
            var width = window.innerWidth;

            if (width < 600) {
                this.navBars.click(this.animate.bind(this));
                this.navMenu.hide();
                this.toggle[0].checked = false;
            } else {
                this.resetNav();
            }
        },
        animate: function (e) {
            var checkbox = this.toggle[0];

            if (!checkbox.checked) {
                this.navMenu.slideDown();
            } else {
                this.navMenu.slideUp();
            }

        },
        resetNav: function () {
            this.navMenu.show();
        }
    };
    myNav.init();
});

(function () {
    'use strict';
    (function ($) {
        $.fn.extend({
            mgPgnation: function (options) {
                /* func :: calculate width of each page num */
                /* func :: draw magic line */
                /* func :: update prev text */
                var $curNav, $magicLine, $magicNav, $mainNav, $nextNav, $pgnNav, $prevNav, $prevNavText, $this,
                    calPgnWidth, magicDraw, prevNavWidth, prevText, showPrevNext, updatePrevText;
                $this = $(this);
                if ($this.length) {
                    $mainNav = this.children();
                    $pgnNav = $this.find('.pgn__item');
                    $curNav = $this.find('.current');
                    $magicNav = $this.find('a');
                    $prevNav = $this.find('.prev');
                    $nextNav = $this.find('.next');
                    $prevNavText = $prevNav.find('.pgn__prev-txt');
                    updatePrevText = function () {
                        $prevNavText = $prevNav.find('.pgn__prev-txt');
                        return $prevNavText.html('قبلی');
                    };
                    calPgnWidth = function () {
                        var pgnWidth, prevWidth, vsbNav, vsbNavs;
                        // number of visible <a> plus <strong class="current">
                        vsbNav = $this.find('.pgn__item a:visible').length + 1;
                        vsbNavs = vsbNav + 2;
                        prevWidth = 100 / vsbNavs;
                        pgnWidth = 100 - prevWidth * 2;
                        $prevNav.css('width', prevWidth + '%');
                        $nextNav.css('width', prevWidth + '%');
                        $pgnNav.css('width', pgnWidth + '%');
                        // <a> and <strong>
                        return $pgnNav.find('a, strong').css('width', 100 / vsbNav + '%');
                    };
                    /* func :: calculate and display prev/next */
                    // 85px - display full text
                    showPrevNext = function () {
                        var prevNavWidth;
                        prevNavWidth = $prevNav.innerWidth();
                        if (prevNavWidth > 100) {
                            $this.addClass('fullprevnext');
                            // display Previous
                            return $prevNavText.html('Previous');
                        } else if (prevNavWidth < 101 && prevNavWidth > 60) {
                            $this.addClass('fullprevnext');
                            // display Prev
                            return $prevNavText.html('قبلی');
                        } else {
                            return $this.removeClass('fullprevnext');
                        }
                    };
                    magicDraw = function () {
                        // draw init magic line
                        $magicLine.width($curNav.width());
                        if ($curNav.position() !== void 0) {
                            $magicLine.css('left', $curNav.position().left);
                        }

                        // assign orig values
                        $magicLine.data('origLeft', $magicLine.position().left);
                        return $magicLine.data('origWidth', $magicLine.width());
                    };
                    // END funcs

                    // create magic line
                    $mainNav.append('<li class="pgn__magic-line">');

                    // declare magic line
                    $magicLine = $this.find('.pgn__magic-line');
                    // add extra class & element if no prev or next
                    prevNavWidth = $prevNav.innerWidth();
                    if (prevNavWidth > 100) {
                        prevText = 'Previous';
                    } else {
                        prevText = 'Prev';
                    }
                    if (!$prevNav.children().length) {
                        $prevNav.addClass('disabled');
                        $prevNav.append('<a rel="prev"><i class="pgn__prev-icon icon-angle-left"></i><span class="pgn__prev-txt">قبلی</span></a>');
                    }
                    if (!$nextNav.children().length) {
                        $nextNav.addClass('disabled');
                        $nextNav.append('<a rel="next"><i class="pgn__next-icon icon-angle-right"></i><span class="pgn__next-txt">بعدی</span></a>');
                    }
                    // calculate pgn width
                    calPgnWidth();
                    // show prev/next
                    showPrevNext();
                    // draw magic line
                    magicDraw();

                    // when hover
                    $magicNav.hover((function () {
                        var $el, leftPos, newWidth;
                        $el = $(this);
                        leftPos = $el.position().left;
                        newWidth = $el.width();

                        // animate magic line
                        return $magicLine.stop().animate({
                            left: leftPos,
                            width: newWidth
                        });
                    }), function () {
                        return $magicLine.stop().animate({
                            left: $magicLine.data('origLeft'),
                            width: $magicLine.data('origWidth')
                        });
                    });
                    /* Window Resize Changes */
                    return window.addEventListener('resize', function () {
                        updatePrevText();
                        calPgnWidth();
                        showPrevNext();
                        return magicDraw();
                    });
                }
            }
        });
        // END mgPgnation()

        // call function here
        return $('.pgn').mgPgnation();
    })(jQuery);

}).call(this);

/* 1. Visualizing things on Hover - See next part for action on click */
$('#stars li').on('mouseover', function () {
    var onStar = parseInt($(this).data('value'), 10); // The star currently mouse on

    // Now highlight all the stars that's not after the current hovered star
    $(this).parent().children('li.star').each(function (e) {
        if (e < onStar) {
            $(this).addClass('hover');
        } else {
            $(this).removeClass('hover');
        }
    });

}).on('mouseout', function () {
    $(this).parent().children('li.star').each(function (e) {
        $(this).removeClass('hover');
    });
});

function FormatNumberBy3(num, decpoint, sep) {
    // check for missing parameters and use defaults if so
    if (arguments.length === 2) {
        sep = ",";
    }
    if (arguments.length === 1) {
        sep = ",";
        decpoint = ".";
    }
    // need a string for operations
    num = num.toString();
    // separate the whole number and the fraction if possible
    a = num.split(decpoint);
    x = a[0]; // decimal
    y = a[1]; // fraction
    z = "";

    if (typeof (x) != "undefined") {
        // reverse the digits. regexp works from left to right.
        for (i = x.length - 1; i >= 0; i--)
            z += x.charAt(i);
        // add seperators. but undo the trailing one, if there
        z = z.replace(/(\d{3})/g, "$1" + sep);
        if (z.slice(-sep.length) == sep)
            z = z.slice(0, -sep.length);
        x = "";
        // reverse again to get back the number
        for (i = z.length - 1; i >= 0; i--)
            x += z.charAt(i);
        // add the fraction back in, if it was there
        if (typeof (y) != "undefined" && y.length > 0)
            x += decpoint + y;
    }
    return x;
}