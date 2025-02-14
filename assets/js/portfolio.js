jQuery(document).ready(function($) {
    const preview = $(".portfolio-preview img");
    const spinner = $(".loading-spinner");

    $(".portfolio-item").hover(function() {
        const fullImage = $(this).data("full");
        spinner.show();
        preview.removeClass("loaded");

        const img = new Image();
        img.onload = function() {
            spinner.hide();
            preview.attr("src", fullImage).addClass("loaded");
        };
        img.src = fullImage;
    });

    $(".portfolio-item").click(function() {
        const link = $(this).data("link");
        window.location.href = link;
    });
});
