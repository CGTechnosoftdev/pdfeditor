/*************** Navbar JS **************/
(function($) {
    "use strict";

    $(function() {
        var header = $(".start-style");
        $(window).scroll(function() {
            var scroll = $(window).scrollTop();

            if (scroll >= 10) {
                header.removeClass('start-style').addClass("scroll-on");
            } else {
                header.removeClass("scroll-on").addClass('start-style');
            }
        });
    });

    //Animation

    $(document).ready(function() {
        $('body.hero-anime').removeClass('hero-anime');
    });


})(jQuery);


// number count for stats, using jQuery animate

$('.counting').each(function() {
    var $this = $(this),
        countTo = $this.attr('data-count');

    $({ countNum: $this.text() }).animate({
            countNum: countTo
        },

        {

            duration: 3000,
            easing: 'linear',
            step: function() {
                $this.text(Math.floor(this.countNum));
            },
            complete: function() {
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