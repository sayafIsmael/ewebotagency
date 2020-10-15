/*----------------------------------------------
*
* [Main Scripts]
*
* Theme    : Leverage - Creative Agency, Corporate and Portfolio. Multipurpose Theme.
* Version  : 1.1.0
* Author   : Codings
* Support  : adm.codings@gmail.com
* 
----------------------------------------------*/

/*----------------------------------------------

[ALL CONTENTS]

1. Responsive Menu
2. Navigation 
3. Slides 
4. Sign and Register Form
5. Multi-Step Form 
6. Submission Parameters 

----------------------------------------------*/

/*----------------------------------------------
1. Responsive Menu
----------------------------------------------*/

jQuery(function ($) {

    'use strict';

    function navResponsive() {

        let navbar = $('.navbar .items');
        let menu = $('#menu .items');

        menu.html('');
        navbar.clone().appendTo(menu);

        $('.menu .icon-arrow-right').removeClass('icon-arrow-right').addClass('icon-arrow-down');
    }

    navResponsive();

    $(window).on('resize', function () {
        navResponsive();
    })

    $('.menu .dropdown-menu').each(function() {

        var children = $(this).children('.dropdown').length;
        $(this).addClass('children-'+children);
    })

    
    $('.menu .nav-item.dropdown').each(function() {

        var children = $(this).children('.nav-link');
        children.addClass('prevent');
    })

    $(document).on('click', '#menu .nav-item .nav-link', function (event) {

        if($(this).hasClass('prevent')) {
            event.preventDefault();
        }

        var nav_link = $(this);

        nav_link.next().toggleClass('show');

        if(nav_link.hasClass('smooth-anchor')) {
            $('#menu').modal('hide');
        }
    })
})

/*----------------------------------------------
2. Navigation
----------------------------------------------*/

jQuery(function ($) {

    'use strict';

    var position = $(window).scrollTop();
    var toTop = $('#scroll-to-top');

    toTop.hide();

    $(window).scroll(function () {

        let scroll = $(window).scrollTop();
        let navbar = $('.navbar');

        if (!navbar.hasClass('relative')) {

            if (scroll > position) {

                if (window.screen.width >= 767) {

                    navbar.fadeOut('fast');

                } else {

                    navbar.addClass('navbar-sticky');
                }

                toTop.fadeOut('fast');

            } else {

                if (position < 76) {

                    navbar.slideDown('fast').removeClass('navbar-sticky');

                } else {

                    navbar.slideDown('fast').addClass('navbar-sticky');
                }


                if (position > 1023) {

                    if (window.screen.width >= 767) {

                        toTop.fadeIn('fast');
                    }

                } else {

                    toTop.fadeOut('fast');

                }

            }

            position = scroll;

        }
    })

    $(document).on('click', '.smooth-anchor', function (event) {

        event.preventDefault();

        $('html, body').animate({

            scrollTop: $($.attr(this, 'href')).offset().top

        }, 500);
    })

    $('.dropdown-menu').each(function () {

        let dropdown = $(this);

        dropdown.hover(function () {

            dropdown.parent().find('.nav-link').first().addClass('active');

        }, function () {

            dropdown.parent().find('.nav-link').first().removeClass('active');

        })
    })
})

/*----------------------------------------------
3. Slides
----------------------------------------------*/

jQuery(function ($) {

    'use strict';

    setTimeout(() => {

        $('.no-slider .left').addClass('init');

    }, 1200)

    var animation = (slider) => {

        let image = $(slider + ' .swiper-slide-active img');
        let title = $(slider + ' .title');
        let description = $(slider + ' .description');
        let btn = $(slider + ' .btn');
        let nav = $(slider + ' nav');

        image.toggleClass('aos-animate');
        title.toggleClass('aos-animate');
        description.toggleClass('aos-animate');
        btn.toggleClass('aos-animate');
        nav.toggleClass('aos-animate');

        setTimeout(() => {

            image.toggleClass('aos-animate');
            title.toggleClass('aos-animate');
            description.toggleClass('aos-animate');
            btn.toggleClass('aos-animate');
            nav.toggleClass('aos-animate');

            AOS.refresh();

        }, 100)

        if ($('.full-slider').hasClass('animation')) {

            $('.full-slider .left').addClass('off');
            $('.full-slider .left').removeClass('init');

            setTimeout(() => {

                $('.full-slider .left').removeClass('off');

            }, 200)

            setTimeout(() => {

                $('.full-slider .left').addClass('init');

            }, 1000)

        } else {

            $('.full-slider .left').addClass('init');
        }
    }

    var fullSlider = new Swiper('.full-slider', {

        autoplay: {
            delay: 10000,
        },
        loop: true,
        slidesPerView: 1,
        spaceBetween: 0,
        pagination: {
            el: '.swiper-pagination'
        },
        navigation: false,
        pagination: {
            el: '.swiper-pagination',
            clickable: true
        },
        keyboard: {
            enabled: true,
            onlyInViewport: false
        },
        on: {
            init: () => {

                animation('.full-slider')

                let pagination = $('.full-slider .swiper-pagination');

                pagination.hide();

                setTimeout(() => {

                    pagination.show();

                }, 2000)

            },
            slideChange: () => {

                animation('.full-slider')
            }
        }
    })

    var midSlider = new Swiper('.slider-mid', {

        autoplay: false,
        loop: true,
        slidesPerView: 1,
        spaceBetween: 30,
        breakpoints: {
            767: {
                slidesPerView: 2,
                spaceBetween: 30
            },
            1023: {
                slidesPerView: 3,
                spaceBetween: 30
            }
        },
        pagination: {
            el: '.swiper-pagination',
            clickable: true
        }
    })

    var minSlider = new Swiper('.slider-min', {

        autoplay: {
            delay: 5000,
        },
        loop: true,
        slidesPerView: 2,
        spaceBetween: 15,
        breakpoints: {
            424: {
                slidesPerView: 2,
                spaceBetween: 15
            },
            767: {
                slidesPerView: 3,
                spaceBetween: 15
            },
            1023: {
                slidesPerView: 4,
                spaceBetween: 15
            },
            1199: {
                slidesPerView: 5,
                spaceBetween: 15
            }
        },
        pagination: false,
    })

    var sliderDisabled = new Swiper('.no-slider', {

        autoplay: false,
        loop: false,
        keyboard: false,
        grabCursor: false,
        allowTouchMove: false,
        on: {
            init: () => {
                animation('.no-slider')
            }
        }
    })
})


/*----------------------------------------------
4. Sign and Register Form
----------------------------------------------*/

jQuery(function ($) {

    $(document).on('click', 'a[data-target="#register"]', function() { 

        $('#sign').modal('hide');
    })

    $(document).on('click', 'a[data-target="#sign"]', function() { 

        $('#register').modal('hide');
    })

})

/*----------------------------------------------
5. Multi-Step Form
----------------------------------------------*/

jQuery(function ($) {

    'use strict';

    var current_fs, next_fs, previous_fs;
    var left, opacity, scale;
    var animating;

    function next(button, group, show, hide) {

        $(document).on('click', button, function () {

            $(group + ' .form-control').each(function () {

                var minlength = $(this).data('minlength');

                if ($(this).val() == null || $(this).val() == '') {

                    var value = 0;

                } else {

                    var value = $(this).val().length;
                }

                if (Number(minlength) <= Number(value)) {

                    $(this).removeClass('invalid').addClass('valid');

                } else {

                    $(this).removeClass('valid').addClass('invalid');
                }
            })

            let field = $(group).find('.form-control').length;
            let valid = $(group).find('.valid').length;

            if (field == valid) {

                if (animating) return false;
                animating = true;

                current_fs = $(this).parents().eq(1);
                next_fs = $(this).parents().eq(1).next();

                $('.progressbar li').eq($('fieldset').index(next_fs)).addClass('active');

                next_fs.show();

                current_fs.animate({

                    opacity: 0

                }, {
                    step: function (now, mx) {

                        scale = 1 - (1 - now) * 0.2;
                        left = (now * 50) + '%';
                        opacity = 1 - now;

                        current_fs.css({
                            'transform': 'scale(' + scale + ')',
                            'position': 'absolute'
                        })

                        next_fs.css({
                            'left': left,
                            'opacity': opacity
                        })
                    },
                    duration: 800,
                    complete: function () {
                        current_fs.hide();
                        animating = false;
                    },
                    easing: 'easeInOutBack'
                })

                $(hide).hide();
                $(show).show();

                if($('.multi-step-form').data('steps') == 1) {
                    var sendButton = '#step-next-1';

                } else if($('.multi-step-form').data('steps') == 2) {
                    var sendButton = '#step-next-2';

                } else {
                    var sendButton = '#step-next-3';
                }

                if (button == sendButton) {
                    $('.progressbar').addClass('complete');
                }

                if (button == sendButton) {

                    $('.form .intro').css('opacity', '0');
                    
                    let height = $(button).parents().eq(6).height();
                    let message = $(button).parents().eq(5).find('.message');
                    
                    message.css('height', height);
                    message.addClass('active');

                    // Here the form is sent.
                    $('.multi-step-form').submit();
                }
            }
        })

    }

    // Progressbar
    $('.progressbar li').first().addClass('active');

    $('.progressbar li').each(function(index) {
        $('.multi-step-form').attr('data-steps', (index+1));
    })

    // Step Image [ID]
    $('.step-image').each(function(index) {
        $(this).attr('id', 'step-image-'+(index+1));

        if(index) {
            $('#step-image-2, #step-image-3, #step-image-4').hide(); 
        }
    })

    // Step Title [ID]
    $('.step-title').each(function(index) {
        $(this).attr('id', 'step-title-'+(index+1));

        if(index) {
            $('#step-title-2, #step-title-3').hide(); 
        }
    })

    // Step Group [ID]
    $('.step-group').each(function(index) {
        $(this).attr('id', 'step-group-'+(index+1));
    })

    // Step Next [ID]
    $('.step-next').each(function(index) {
        $(this).attr('id', 'step-next-'+(index+1));
    })
    
    // Step Prev [ID]
    $('.step-prev').each(function(index) {
        $(this).attr('id', 'step-prev-'+(index+2));
    })

    next('#step-next-1', '#step-group-1', '#step-image-2, #step-title-2', '#step-image-1, #step-title-1');
    next('#step-next-2', '#step-group-2', '#step-image-3, #step-title-3', '#step-image-2, #step-title-2');
    next('#step-next-3', '#step-group-3', '#step-image-4', '#step-image-3');

    function prev(button, show, hide) {

        $(document).on('click', button, function () {

            if (animating) return false;
            animating = true;

            current_fs = $(this).parents().eq(1);
            previous_fs = $(this).parents().eq(1).prev();

            $('.progressbar li').eq($('fieldset').index(current_fs)).removeClass('active');

            previous_fs.show();
            current_fs.animate({

                opacity: 0

            }, {
                step: function (now, mx) {

                    scale = 0.8 + (1 - now) * 0.2;
                    left = ((1 - now) * 50) + '%';
                    opacity = 1 - now;

                    current_fs.css({

                        'left': left
                    })

                    previous_fs.css({

                        'transform': 'scale(' + scale + ')',
                        'opacity': opacity
                    })
                },
                duration: 800,
                complete: function () {

                    current_fs.hide();
                    animating = false;
                },
                easing: 'easeInOutBack'
            })

            $(hide).hide();
            $(show).show();

            if (button == '#step-prev-3') {
                $('.progressbar').removeClass('complete');
            }
        })
    }

    prev('#step-prev-2', '#step-image-1, #step-title-1', '#step-image-2, #step-title-2');
    prev('#step-prev-3', '#step-image-2, #step-title-2', '#step-image-3, #step-title-3');
})

/*----------------------------------------------
6. Submission Parameters
----------------------------------------------*/
jQuery(function ($) {

    'use strict';

    // Variable to hold request
    var request;

    // Bind to the submit event of our form
    $('form').each(function() {

        var form = $(this);

        if(form.attr('id') == 'leverage-form' || form.attr('id') == 'leverage-subscribe') {

            form.submit(function (event) {

                // Prevent default posting of form - put here to work in case of errors
                event.preventDefault();

                // Prevent
                setTimeout(function() {

                    let input = form.find('.form-control');
                    let button = form.find('button');

                    input.attr('disabled', 'disabled');
                    button.attr('disabled', 'disabled').html('<i class="icon-check"></i>'+button.data('success'));

                }, 1500)

                // Abort any pending request
                if (request) {
                    request.abort();
                }

                // setup some local variables
                var $form = $(this);

                // Let's select and cache all the fields
                var $inputs = $form.find('input, select, button, textarea');

                // Serialize the data in the form
                var serializedData = $form.serialize();

                // Let's disable the inputs for the duration of the Ajax request
                // Note: we disable elements AFTER the form data has been serialized
                // Disabled form elements will not be serialized
                $inputs.prop('disabled', true);

                // Fire off the request
                request = $.ajax({
                    url: $form.attr('action'), // Enter your back-end URL here
                    type: 'post',
                    data: serializedData
                })

                // Callback handler that will be called on success
                request.done(function (response, textStatus, jqXHR) {

                    // Log a message to the console
                })

                // Callback handler that will be called on failure
                request.fail(function (jqXHR, textStatus, errorThrown) {

                    // Log the error to the console
                    console.error(textStatus, errorThrown);
                })

                // Callback handler that will be called regardless
                // if the request failed or succeeded
                request.always(function () {

                    // Reenable the inputs
                    $inputs.prop('disabled', false);
                })
            })
        }
    })
})