(function ($) {
    "use strict"; // Start of use strict

    // jQuery for page scrolling feature - requires jQuery Easing plugin
    $('a.page-scroll, .menu-item a').bind('click', function (event) {
        var $anchor = $(this);
        var href = $anchor.attr('href');
        var $link = $(href);

        if (!$link.offset()) {
            window.location.href = '/' + href;
        } else {
            $('html, body').stop().animate({
                scrollTop: ($link.offset().top - 50)
            }, 1250, 'easeInOutExpo');
        }
        event.preventDefault();
    });

    // Highlight the top nav as scrolling occurs
    $('body').scrollspy({
        target: '.navbar-fixed-top',
        offset: 51
    }).on('touchmove', function(e){
        if($('.scroll-disable').has($(e.target)).length) e.preventDefault();
    });

    // Closes the Responsive Menu on Menu Item Click
    $('.navbar-collapse ul li a').click(function () {
        $('.navbar-toggle:visible').click();
    });

    // Offset for Main Navigation
    $('#mainNav').affix({
        offset: {
            top: 100
        }
    });

    // Disable Google Maps scrolling
    // See http://stackoverflow.com/a/25904582/1607849
    // Disable scroll zooming and bind back the click event
    var onMapMouseleaveHandler = function (event) {
        var that = $(this);
        that.on('click', onMapClickHandler);
        that.off('mouseleave', onMapMouseleaveHandler);
        that.find('iframe').css("pointer-events", "none");
    }
    var onMapClickHandler = function (event) {
        var that = $(this);
        // Disable the click handler until the user leaves the map area
        that.off('click', onMapClickHandler);
        // Enable scrolling zoom
        that.find('iframe').css("pointer-events", "auto");
        // Handle the mouse leave event
        that.on('mouseleave', onMapMouseleaveHandler);
    }
    // Enable map zooming with mouse scroll when the user clicks the map
    $('.map').on('click', onMapClickHandler);

    $("body").on("click", ".info-link", function (e) {
        e.preventDefault();
        var post_link = $(this).attr("href");
        var $modal = $('#modal-content').modal('show');
        $modal.find("div#the_content").html("<h2>Loading...</h2><br>").load(post_link + (post_link.indexOf('?') >= 0 ? '&' : '?') + 'modal=1');
        return false;
    });

    if( /Android|webOS|iPhone|iPad|iPod|BlackBerry/i.test(navigator.userAgent) ) {
        $('.selectpicker').selectpicker('mobile');
    }
})(jQuery); // End of use strict
