function blockUI() {
    $.blockUI({
        baseZ: 99999
    });
}

function unblockUI() {
    $.unblockUI();
}
// Copy
var clipboardDemos = new Clipboard('[data-clipboard-demo]');

clipboardDemos.on('success', function (e) {
    e.clearSelection();

    console.info('Action:', e.action);
    console.info('Text:', e.text);
    console.info('Trigger:', e.trigger);

    showTooltip(e.trigger, 'Copied!');
});

clipboardDemos.on('error', function (e) {
    console.error('Action:', e.action);
    console.error('Trigger:', e.trigger);

    showTooltip(e.trigger, fallbackMessage(e.action));
});

// tooltips.js

// var btns = document.querySelectorAll('.btn');

// for (var i = 0; i < btns.length; i++) {
//     btns[i].addEventListener('mouseleave', clearTooltip);
//     btns[i].addEventListener('blur', clearTooltip);
// }

// function clearTooltip(e) {
//     e.currentTarget.setAttribute('class', 'btn');
//     e.currentTarget.removeAttribute('aria-label');
// }

// function showTooltip(elem, msg) {
//     elem.setAttribute('class', 'btn tooltipped tooltipped-s');
//     elem.setAttribute('aria-label', msg);
// }

function delayTyping(callback, ms) {
    var timer = 0;
    return function () {
        var context = this,
            args = arguments;
        clearTimeout(timer);
        timer = setTimeout(function () {
            callback.apply(context, args);
        }, ms || 0);
    };
}

function selectAllCheckbox(parent_element, child_element) {
    if ($(parent_element).is(':checked')) {
        $(child_element).each(function () {
            this.checked = true;
        });
    } else {
        $(child_element).each(function () {
            this.checked = false;
        });
    }
}

function isEmail(email) {
    var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
    return regex.test(email);
}
function isName(email) {
    var regex = /(^([a-zA-Z ]+)(\d+)?$)/u;
    return regex.test(email);
}

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

/************* General Settings Tabs *********/
$('.general-settings-tabs h4').click(function (event) {
    event.preventDefault();
    $(this).addClass('active');
    $(this).siblings().removeClass('active');

    var ph = $(this).parent().height();
    var ch = $(this).next().height();

    if (ch > ph) {
        $(this).parent().css({
            'min-height': ch + 'px'
        });
    } else {
        $(this).parent().css({
            'height': 'auto'
        });
    }
});

function tabParentHeight() {
    var ph = $('.general-settings-tabs').height();
    var ch = $('.general-settings-tabs .setting-tab-content').height();
    if (ch > ph) {
        $('.general-settings-tabs').css({
            'height': ch + 'px'
        });
    } else {
        $(this).parent().css({
            'height': 'auto'
        });
    }
}

$(window).resize(function () {
    tabParentHeight();
});

$(document).resize(function () {
    tabParentHeight();
});
tabParentHeight();

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



$('.template-types li').on('click', function () {
    $(this).toggleClass('active').siblings().removeClass('active');
});


///////////// Image Upload and Preview /////////////

function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {
            $('#imagePreview').css('background-image', 'url(' + e.target.result + ')');
            $('#imagePreview').hide();
            $('#imagePreview').fadeIn(650);
        }
        reader.readAsDataURL(input.files[0]);
    }
}
$("#imageUpload").change(function () {
    readURL(this);
});


/*************** Timeframe ************/
$('.timeformate ul li').on('click', function () {
    $(this).addClass('active').siblings().removeClass('active');
});


/******* ToolTip ********/
$(function () {
    $('[data-toggle="tooltip"]').tooltip()
})


$('.addnew-btn').click(function () {
    $(".addnew-dropdown").slideToggle("slow");
});

$(document).mouseup(function (e) {
    var popup = $(".addnew-dropdown");
    if (!$('.addnew-btn').is(e.target) && !popup.is(e.target) && popup.has(e.target).length == 0) {
        popup.hide(500);
    }
});

$(function () {
    //toggle two classes on button element
    $(document).on('click', '.treeview a', function () {
        // $('.treeview a').on('click', function() {
        $('.dashboard3').toggleClass('sidebar-collapse sticky');
    });
});