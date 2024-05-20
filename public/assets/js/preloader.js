(function ($) {
    "use strict";
    $(window).on("load", function () {
        setTimeout(function () {
            $("#preloader").fadeOut(500, function () {
                $(this).remove();
            });
        }, 500);
    });
})(jQuery);
