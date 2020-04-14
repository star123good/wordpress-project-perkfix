$('.message a').click(function(){
    $('form').animate({height: "toggle", opacity: "toggle"}, "slow");
});


$("#pg_platform").on("click", function() {
    if($(this).hasClass("btn-on")) {
        $(this).removeClass("btn-on");
    } else {
        $(this).addClass("btn-on");
    }
});

var changeClass = true;
var animationDuraton = 200;
var scrollLoopIndex = 0;


var marginTop = 0;
var header_height = 68;

var html;
html = jQuery('html');

$(".perkfix-home9 .col").height($(".perkfix-home9 .col").width() * 0.8);

$(window).on('resize', function(){
    var win = $(this); //this = window
    $(".ps-mobile-icon-detail").width($(".ps-mobile-icon-container").width()-25).height("100vh");
    $(".item-list-container").width($(".perkfix-content-item").width()-10);
    $(".perkfix-home9 .col").height($(".perkfix-home9 .col").width() * 0.8);
});

//$("#perkstore_left").on("click", function() {
$(document).on("click", "#perkstore_left", function() {
    $(".item-content").animate({scrollLeft: "-=250px"}, 300);
});

//$("#perkstore_right").on("click", function() {
$(document).on("click", "#perkstore_right", function() {
    $(".item-content").animate({scrollLeft: "+=250px"}, 300);
});

//$("#item_left").on("click", function() {
$(document).on("click", "#item_left", function() {
    var width = $(".image-item").width()+20;
    var currentMarginLeft = parseInt($(".image-list").css("marginLeft").replace('px', ''));
    if (currentMarginLeft < 0)
        $(".image-list").animate({marginLeft: "+="+width+"px"}, 300);
});

//$("#item_right").on("click", function() {
$(document).on("click", "#item_right", function() {
    var width = $(".image-item").width()+20;
    var currentMarginLeft = parseInt($(".image-list").css("marginLeft").replace('px', ''));
    if (currentMarginLeft == 0)
        $(".image-list").animate({marginLeft: "-="+width+"px"}, 300);
});

$(document).mouseup(e => {
if (!$(".ps-mobile-icon-detail").is(e.target) // if the target of the click isn't the container...
&& $(".ps-mobile-icon-detail").has(e.target).length === 0) // ... nor a descendant of the container
{
    $(".ps-mobile-icon-detail").addClass('hidden');
}
});

//$(".mob-ico-item").on('click', function() {
$(document).on("click", ".mob-ico-item", function() {
    $(".ps-mobile-icon-detail").width($(".ps-mobile-icon-container").width()-25).height("0vh");
    $(".ps-mobile-icon-detail").removeClass('hidden');
    $(".ps-mobile-icon-detail").animate({
        height: '100vh',
        MarginTop: '-400px'
    });
});

//$(".ps-item").on('click', function() {
$(document).on("click", ".ps-item", function() {
    $(".menu-item-container").addClass("hidden");
    $(".hr-bar").addClass("hidden");
    var strTitle = $(this).html();
    $(".sub-menu-item-sel").html("&nbsp;|&nbsp;&nbsp;"+strTitle+"&nbsp;&nbsp;<i class='fa fa-caret-down'></i>");
    $(".sub-menu-item-sel").removeClass("hidden");
});

//$(".sub-menu-item-sel").on('click', function() {
$(document).on("click", ".sub-menu-item-sel", function() {
    $(".menu-item-container").removeClass("hidden");
    $(".hr-bar").removeClass("hidden");
    $(".sub-menu-item-sel").addClass("hidden");
});

//$("#pg_min").on("click", function() {
$(document).on("click", "#pg_min", function() {
    if ($(this).hasClass("on")) {
        $(this).removeClass("on");
        $(this).html("<i class='fa fa-equals'></i>");
        $(".sub-header").animate({ "opacity": "hide"}, 500, function() {
            $(".sub-header").addClass("hidden");
        });
    } else {
        $(this).addClass("on");
        $(this).html("<i class='fa fa-times'></i>");
        $(".sub-header").removeClass("hidden");
        $(".sub-header").animate({ "opacity": "show"}, 500, function() {
            
        });
    }
});

//$(".ico-item").on("click", function() {
$(document).on("click", ".ico-item", function() {
    $(".ico-content").animate({marginTop: 0}, 300);
    if ($(this).hasClass("active")) {
        $(this).removeClass("active");
        $(".ico-content").animate({width: "100%"}, 300);
        $(".ico-content").animate({height: "600px"}, 300);
        $(".popup-content").animate({width: "0%"}, 1000);
        $(".top-content").animate({width: "100%"}, 1000);
        $(".bottom-content").animate({width: "100%"}, 1000);
    } else {
        $(".ico-item").removeClass("active");
        $(this).addClass("active");
        $(".popup-content").animate({width: "50%"}, 1000);
        $(".ico-content").animate({width: "50%"}, 300);
        $(".ico-content").animate({height: "1200px"}, 300);
        $(".top-content").animate({width: "50%"}, 1000);
        $(".bottom-content").animate({width: "50%"}, 1000);
    }
});

//$(".ps-item").on("click", function() {
$(document).on("click", ".ps-item", function() {
    $(".ico-content").animate({marginTop: 0}, 300);
    if ($(this).children().hasClass("active")) {
        $(this).children().removeClass("active");
    } else {
        $(".ps-item").children().removeClass("active");
        $(this).children().addClass("active");
    }
});

function sub_arrow_up() {
    var prev_margin = parseInt($(".sub-ico-content").css('margin-top'));
    if (prev_margin < -80) {
        var current_margin = prev_margin + 80;
        $(".sub-ico-content").animate({marginTop: "+=80"}, 300);
    } else {
        var current_margin = 0;
        $(".sub-ico-content").animate({marginTop: current_margin}, 300);
    }
}

function sub_arrow_down() {
    var prev_margin = parseInt($(".sub-ico-content").css('margin-top'));
    var top_margin = parseInt($(".inner").css('height')) - parseInt($(".sub-ico-content").css('height'));
    if (prev_margin > top_margin+80) {
        var current_margin = prev_margin - 80;
        $(".sub-ico-content").animate({marginTop: "-=80"}, 300);
    } else {
        var current_margin = top_margin;
        $(".sub-ico-content").animate({marginTop: current_margin}, 300);
    }
}

function arrow_down() {
    
    var prev_margin = parseInt($(".ico-content").css('margin-top'));
    var top_margin = parseInt($(".inner-content").css('height')) - parseInt($(".ico-content").css('height'));
    if (prev_margin > top_margin+80) {
        var current_margin = prev_margin - 80;
        $(".ico-content").animate({marginTop: "-=80"}, 300);
    } else {
        var current_margin = top_margin;
        $(".ico-content").animate({marginTop: current_margin}, 300);
    }
}

function arrow_up() {
    var prev_margin = parseInt($(".ico-content").css('margin-top'));
    if (prev_margin < -80) {
        var current_margin = prev_margin + 80;
        $(".ico-content").animate({marginTop: "+=80"}, 300);
    } else {
        var current_margin = 0;
        $(".ico-content").animate({marginTop: current_margin}, 300);
    }
}

function wheel($div, deltaX) {
    var step = $div.width();
    var pos = $div.scrollLeft();
    var nextPos = pos + (step*(-deltaX));
    $div.scrollLeft(nextPos);
}


var last_offset = 0;
var clientX;

$( window ).on( "orientationchange", function( event ) {
    $(".perkfix-category .row").css('margin-left', '0px');
});

$(".perkfix-category").on("touchstart", function(e) {
    last_offset = parseInt($(this).children(".row").css('marginLeft'));
    clientX = e.touches[0].clientX;
});

$(".perkfix-category").on("touchend", function(e) {
    var deltaX;
    deltaX = e.changedTouches[0].clientX - clientX;

    var step = $(".pf-item").width();
    var limit = step * ($(this).children(".row").width()/$(this).children(".row").children(".pf-item").width() - 1);
    var current_offset = parseInt($(this).children(".row").css('marginLeft'));
    
    if ((deltaX < -20) && current_offset > -limit) {
        $(this).children(".row").animate({marginLeft: "-="+step}, 500);
    } else if ((deltaX > 20) && current_offset < 0) {
        var step1 = $(".pf-item").width();
        $(this).children(".row").animate({marginLeft: "+="+step}, 500);
    }
});

$(".item-list-container").width($(".perkfix-content-item").width()-10);

$(document).on("click", ".setting .switch", function() {
    if ($(this).find('input[type=checkbox]:checked').length == 1) {
        $(this).parent().parent().parent().addClass("checked");
    } else {
        $(this).parent().parent().parent().removeClass("checked");
    }
});
