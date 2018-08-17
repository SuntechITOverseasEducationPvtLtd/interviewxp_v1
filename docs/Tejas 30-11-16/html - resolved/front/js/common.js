
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



 //<!--file upload js script start-->  
         function browseImage() {
         
             $("#profile_image").trigger('click');
         }
         
         function removeBrowsedImage() {
             $('#profile_image_name').val("");
             $("#btn_remove_image").hide();
             $("#profile_image").val("");
         }
         
   
             // This is the simple bit of jquery to duplicate the hidden field to subfile
             $('#profile_image').change(function() {
                 if ($(this).val().length > 0) {
                     $("#btn_remove_image").show();
                 }
         
                 $('#profile_image_name').val($(this).val());
             });
              //<!--file upload js script end-->  





/*responsive tab*/
 
            $(document).on('responsive-tabs.initialised', function(event, el) {
                    console.log(el);
                });

            $(document).on('responsive-tabs.change', function(event, el, newPanel) {
                console.log(el);
                console.log(newPanel);
            });

            $('[data-responsive-tabs]').responsivetabs({
                initialised: function() {
                    console.log(this);
                },

                change: function(newPanel) {
                    console.log(newPanel);
                }
            });

// script for profile image uploading
 
 
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
    
            reader.onload = function (e) {
                $('#upload-f')
                    .attr('src', e.target.result)
                    .width(160)
                    .height(160);
            };
    
            reader.readAsDataURL(input.files[0]);
        }
    }
      

// end