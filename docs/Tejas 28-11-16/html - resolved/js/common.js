
        /*footer script*/
        var min_applicable_width = 767;

        $(document).ready(function() {
            applyResponsiveSlideUp($(this).width(), min_applicable_width);

        });



        function applyResponsiveSlideUp(current_width, min_applicable_width) {

            /* Set For Initial Screen */
            initResponsiveSlideUp(current_width, min_applicable_width);

            /* Listen Window Resize for further changes */
            $(window).bind('resize', function() {
                if ($(this).width() <= min_applicable_width) {
                    unbindResponsiveSlideup();
                    bindResponsiveSlideup();
                } else {
                    unbindResponsiveSlideup();
                }
            });
        }

        function initResponsiveSlideUp(current_width, min_applicable_width) {

            if (current_width <= min_applicable_width) {
                unbindResponsiveSlideup();
                bindResponsiveSlideup();
            } else {
                unbindResponsiveSlideup();
            }
        }

        function bindResponsiveSlideup() {
            $(".menu_name").hide();
            $(".ul-category h4").bind('click', function() {
                var $ans = $(this).parent().find(".menu_name");
                $ans.slideToggle();
                $(".menu_name").not($ans).slideUp();
                $('.menu_name').removeClass('active');

                $('.ul-category h4').not($(this)).removeClass('active');
                $(this).toggleClass('active');
                $(this).parent().find(".menu_name").toggleClass('active');
            });


        }

        function unbindResponsiveSlideup() {
            $(".ul-category h4").unbind('click');
            $(".menu_name").show();
        }
  

/* script for sticky header*/
// sticky menu
var stickyNavTop = $('.header').offset().top;
             var stickyNav = function() {
                 var scrollTop = $(window).scrollTop();
                 if (scrollTop > stickyNavTop) {
                     $('.header').addClass('sticky');
                 } else {
                     $('.header').removeClass('sticky');
                 }
             };
             stickyNav();
             $(window).scroll(function() {
                 stickyNav();
             });


/* end */
// script for dropdown
        $(function() {
            $(".dropdown").hover(
                function() {
                    $('.dropdown-menu', this).stop(true, true).fadeIn("fast");
                    $(this).toggleClass('open');
                    $('b', this).toggleClass("caret caret-up");
                },
                function() {
                    $('.dropdown-menu', this).stop(true, true).fadeOut("fast");
                    $(this).toggleClass('open');
                    $('b', this).toggleClass("caret caret-up");
                });
        });

//end