jQuery(document).ready(function ($) {
    const previewContainer = $(".portfolio-preview");
    const spinner = $(".loading-spinner");
    let currentImage = null;
    let loadingImage = null;

    function createNewImage(src) {
        const img = new Image();
        img.className = 'preview-image';
        img.src = src;
        return img;
    }

    $('.preview-image').attr('src', $('.portfolio-item:first-child').data("full")).addClass('loaded')
    spinner.hide();

    $(".portfolio-item").hover(
        function () { // mouseenter

            const fullImage = $(this).data("full");
            if (currentImage && currentImage.src === fullImage) return;
                spinner.show();


            loadingImage = createNewImage(fullImage);

            $(loadingImage).on('load', function () {
                previewContainer.append(loadingImage);
                loadingImage.offsetHeight;
                $(loadingImage).addClass('loaded');
                currentImage = loadingImage;
                spinner.hide();
            });
        },
    );

});
