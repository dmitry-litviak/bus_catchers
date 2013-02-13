$(document).ready(function () {
    $('iframe').each(function () {/*fix youtube z-index*/
        var ifr_source = $(this).attr('src') || "";
        if (ifr_source.length > 0) {
            var url = $(this).attr("src");
            if (url.indexOf("youtube.com") >= 0) {
                if (url.indexOf("?") >= 0) {
                    $(this).attr("src", url + "&wmode=transparent");
                } else {
                    $(this).attr("src", url + "?wmode=transparent");
                }
            }
        }
    });

    $('.ddmenu li.dropdown').hover(function () {
        var width = Math.max($(window).innerWidth(), window.innerWidth);
        if (width > 979) $(this).find('.dropdown-menu').stop(true, true).delay(200).fadeIn();        
    }, function () {
        var width = Math.max($(window).innerWidth(), window.innerWidth);
        if (width > 979) $(this).find('.dropdown-menu').stop(true, true).delay(200).fadeOut();
    });

    $('.ddmenu li.dropdown').click(function () {
        $('.dropdown-menu').stop(true, true).delay(200).fadeOut();
        var width = Math.max($(window).innerWidth(), window.innerWidth);
        if (width <= 979) {
            if ($(this).find('.dropdown-menu').css('display') == 'none') {
                $(this).find('.dropdown-menu').stop(true, true).delay(200).fadeIn();
                return false;
            } else {
                /*dropdown already opened. then goto parent link.*/
            }
        }
    });

});

