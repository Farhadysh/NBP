$(document).ready(function () {

    let setting = {
        rtl: true,
        dots: false,
        margin: 20,
        autoplay: false,
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
    };

    let headerOwl = $('.headerOwl.owl-carousel');
    if (headerOwl.length > 0)
        headerOwl.owlCarousel(setting);

    let categoryOwl = $('.categoryOwl.owl-carousel');
    if (categoryOwl.length > 0)
        categoryOwl.owlCarousel({
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

    let mainOwl = $('.mainOwl.owl-carousel');
    if (mainOwl.length > 0)
        mainOwl.owlCarousel(setting);

    $('.province').change(function () {
        let prov_id = $(this).val();
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

    $('.login_modal').submit(function (e) {
        e.preventDefault();
        let _token = $('input [name="_token"]').val();
        let data = new FormData($(this)[0]);

        $('.show-error').empty();

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
                window.location.reload();
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

    let totalPoints = 0;

    $("input:radio").change(function () {
        let id = $(this).data('id');
        $.ajax({
            type: 'GET',
            url: '/user/packageCart/' + id,
            contentType: false,
            processData: false,
            success: function (response) {
                let cart_count = response['packageCart'].length;
                $('.cart_count').html(cart_count);

                let total_points = 0;
                $.each(response['packageCart'], function (key, val) {
                    total_points += val.total_points * val.count;
                });

                $('.total_points').html(total_points);

                if (total_points == score) {

                    $('.payment_btn').prop('disabled', false);
                } else {

                    $('.payment_btn').prop('disabled', true);
                }

                $('.modal_cart').empty();
                $.each(response['packageCart'], function (key, val) {
                    $('.modal_cart').append(
                        '<div class="row img-modal mt-3 mt-5 parent">' +
                        '<img src=" ' + val.image + ' " width="100" height="90" class="col-4 p-1">' +
                        '<div class="col-8 m-0 ">' +
                        '<p>' + val.name + '</p>' +
                        '<label class="pb-3 m-0 small"> امتیاز : </label>' +
                        '<span class="pb-3 m-0 small">' + val.total_points + '</span>' +
                        '<div class="d-flex m-0 align-items-center text-size pb-3">' +
                        '<label> تعداد : </label>' +
                        (val.package_id !== 1 && val.package_id !== 2 && val.package_id !== 3 ? '' : '<button class="btn btn-outline-dark fa fa-plus border-0 mx-0 p"></button>') +
                        '<input class="text1 input_count form-control mx-0 col-3 rounded-circle text-center border-0 count" data-id=" ' + val.id + ' " value=" ' + val.count + ' ">' +
                        (val.package_id !== 1 && val.package_id !== 2 && val.package_id !== 3 ? '' : '<button class="fa fa-minus btn btn-outline-dark border-0 mx-0 m"></button>') +
                        '</div>' +
                        '<div class=" d-flex text-danger align-items-center text-size">' +
                        '<label> حذف : </label>' +
                        '<a class="btn btn-outline-danger btn-sm fa fa-trash py-1 px-2 delete" data-id=" ' + val.id + ' " data-title=" ' + val.package_id + ' "></a>' +
                        '</div>' +
                        '</div>' +
                        '</div>'
                    );
                });

                $('.delete').click(function () {
                    let delete_id = $(this).data('id');
                    let package_id = $(this).data('title');
                    $(this).parents('.parent').empty();
                    let d = $.trim(package_id);
                    $('input[data-id="' + d + '"]').prop('checked', false);

                    $.ajax({
                        type: 'GET',
                        url: '/user/packageCart/destroy/' + delete_id,
                        contentType: false,
                        processData: false,
                        success: function (response) {
                            let cart_count = response['packageCart'].length;
                            $('.cart_count').html(cart_count);

                            let total_points = 0;
                            $.each(response['packageCart'], function (key, val) {
                                total_points += val.total_points * val.count;
                            });

                            $('.total_points').html(total_points);

                            if (total_points == score) {
                                $('.payment_btn').prop('disabled', false);
                            } else {
                                $('.payment_btn').prop('disabled', true);
                            }
                        }
                    });
                });

                $('.m').click(function () {
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
                        url: '/user/packageCart/count/' + cart_id + '/' + count,
                        contentType: false,
                        processData: false,
                        success: function (response) {
                            let total_points = 0;
                            $.each(response['packageCart'], function (key, val) {
                                total_points += val.total_points * val.count;
                            });
                            $('.total_points').html(total_points);

                            if (total_points == score) {
                                $('.payment_btn').prop('disabled', false);
                            } else {
                                $('.payment_btn').prop('disabled', true);
                            }
                        }
                    });
                });

                $('.p').click(function () {
                    $(this).next('input').val(function (i, oldval) {
                        // if (oldval < 8) {
                        return ++oldval;
                        // } else {
                        //     return 8;
                        // }
                    });
                    let count = $(this).next('input').val();
                    let cart_id = $(this).next('input').data('id');
                    $.ajax({
                        type: 'GET',
                        url: '/user/packageCart/count/' + cart_id + '/' + count,
                        contentType: false,
                        processData: false,
                        success: function (response) {
                            let total_points = 0;
                            $.each(response['packageCart'], function (key, val) {
                                total_points += val.total_points * val.count;
                            });
                            $('.total_points').html(total_points);

                            if (total_points == score) {
                                $('.payment_btn').prop('disabled', false);
                            } else {
                                $('.payment_btn').prop('disabled', true);
                            }
                        }
                    });

                });

            }, error: function (response) {

            }
        });
        /*$('.totalPoint').html(totalPoints);
        $('.points').val(totalPoints);*/

    });

    $('.delete').click(function () {
        let delete_id = $(this).data('id');
        let package_id = $(this).data('title');
        $(this).parents('.parent').empty();
        let d = $.trim(package_id);
        $('input[data-id="' + d + '"]').prop('checked', false);
        $.ajax({
            type: 'GET',
            url: '/user/packageCart/destroy/' + delete_id,
            contentType: false,
            processData: false,
            success: function (response) {
                let cart_count = response['packageCart'].length;
                $('.cart_count').html(cart_count);

                let total_points = 0;
                $.each(response['packageCart'], function (key, val) {
                    total_points += val.total_points * val.count;
                });

                $('.total_points').html(total_points);

                if (total_points == score) {
                    $('.payment_btn').prop('disabled', false);
                } else {
                    $('.payment_btn').prop('disabled', true);
                }
            }
        });
    });

    $('.m').click(function () {
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
            url: '/user/packageCart/count/' + cart_id + '/' + count,
            contentType: false,
            processData: false,
            success: function (response) {
                let total_points = 0;
                $.each(response['packageCart'], function (key, val) {
                    total_points += val.total_points * val.count;
                });
                $('.total_points').html(total_points);

                if (total_points === score) {
                    $('.payment_btn').prop('disabled', false);
                } else {
                    $('.payment_btn').prop('disabled', true);
                }
            }
        });
    });

    $('.buy_package').click(function () {
        $('.em').empty();
    });

    $('.p').click(function () {
        $(this).next('input').val(function (i, oldval) {
            // if (oldval < 8) {
            return ++oldval;
            // } else {
            //     return 8;
            // }
        });
        let count = $(this).next('input').val();
        let cart_id = $(this).next('input').data('id');
        $.ajax({
            type: 'GET',
            url: '/user/packageCart/count/' + cart_id + '/' + count,
            contentType: false,
            processData: false,
            success: function (response) {
                let total_points = 0;
                $.each(response['packageCart'], function (key, val) {
                    total_points += val.total_points * val.count;
                });
                $('.total_points').html(total_points);

                if (total_points == score) {
                    $('.payment_btn').prop('disabled', false);
                } else {
                    $('.payment_btn').prop('disabled', true);
                }
            }
        });

    });

    $('.payment_btn').click(function () {
        location.href = "packageCart/final/sendPayment";
    });

    function readURL(input) {

        if (input.files && input.files[0]) {
            let reader = new FileReader();

            reader.onload = function (e) {
                $('#' + input['id'] + 'Image').attr('src', e.target.result);
            };
            reader.readAsDataURL(input.files[0]);
        }
    }

    $("#image1").change(function () {
        readURL(this);
    });

    $("#profile").change(function () {
        readURL(this);
    });


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

function myfunction() {
    $('#a').removeClass('hidden-library');
    $('#a').addClass('hidden-library1');
}
