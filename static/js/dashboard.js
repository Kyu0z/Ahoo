!function($, w, d, undefined) {
    'use strict';
    $('.video-request-wrapper').on('click', '.open-video-room', function(e) {
        var $link = $(this);
        var url = $link.attr("href");
        window.open(url);
        return false;
    });
}(jQuery, window, document);