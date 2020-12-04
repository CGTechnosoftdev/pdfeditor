/*************** Navbar JS **************/
(function ($) {
    "use strict";

    $(function () {
        var header = $(".start-style");
        $(window).scroll(function () {
            var scroll = $(window).scrollTop();

            if (scroll >= 10) {
                header.removeClass('start-style').addClass("scroll-on");
            } else {
                header.removeClass("scroll-on").addClass('start-style');
            }
        });
    });

    //Animation

    $(document).ready(function () {
        $('body.hero-anime').removeClass('hero-anime');
    });


})(jQuery);

// $("#menu-toggle").click(function(e) {
//     e.preventDefault();
//     $("#wrapper").toggleClass("active");
// });

$(document).ready(function () {
    $('#sidebarCollapse').on('click', function () {
        $('#sidebar').toggleClass('active');
    });
});

// number count for stats, using jQuery animate

$('.counting').each(function () {
    var $this = $(this),
        countTo = $this.attr('data-count');

    $({ countNum: $this.text() }).animate({
        countNum: countTo
    },

        {

            duration: 3000,
            easing: 'linear',
            step: function () {
                $this.text(Math.floor(this.countNum));
            },
            complete: function () {
                $this.text(this.countNum);
                //alert('finished');
            }

        });

});


/************************************ */

var divs = ["user_login_form_id", "user_registration_id", "forgotpasswordfrm_id", "re_send_verification_form_id"];
var visibleDivId = null;

function toggleVisibility(divId) {
    if (visibleDivId === divId) {
        //visibleDivId = null;
    } else {
        visibleDivId = divId;
    }

    hideNonVisibleDivs();
}

function hideNonVisibleDivs() {
    var i, divId, div;
    for (i = 0; i < divs.length; i++) {
        divId = divs[i];

        div = document.getElementById(divId);

        if (visibleDivId === divId) {

            div.style.display = "block";

        } else {

            div.style.display = "none";

        }
    }
}

/********** Match Height ***********/
$(function () {
    $('.pricing-plans .plan-ul').matchHeight();
    $('.pricing-plans .plan-price').matchHeight();
});


/****** Onlick add and remove class ******/

$('.pricing-plans .col-md-4').on('click', function () {
    $(this).addClass('active').siblings().removeClass('active');
});




/********* FAQ *********/

(function ($) {
    $('.faq-accordion > li:eq(0) a').addClass('active').next().slideDown();

    $('.faq-accordion a').click(function (j) {
        var dropDown = $(this).closest('li').find('p');

        $(this).closest('.faq-accordion').find('p').not(dropDown).slideUp();

        if ($(this).hasClass('active')) {
            $(this).removeClass('active');
        } else {
            $(this).closest('.faq-accordion').find('a.active').removeClass('active');
            $(this).addClass('active');
        }

        dropDown.stop(false, true).slideToggle();

        j.preventDefault();
    });
})(jQuery);