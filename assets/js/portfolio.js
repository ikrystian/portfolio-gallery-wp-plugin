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


            // Create new image
            loadingImage = createNewImage(fullImage);

            $(loadingImage).on('load', function () {
                spinner.show();
                // Add new image to container
                previewContainer.append(loadingImage);
                // Trigger reflow
                loadingImage.offsetHeight;
                // Start fade in
                $(loadingImage).addClass('loaded');
                currentImage = loadingImage;
                spinner.hide();
            });
        },
    );

});

window.navigation.addEventListener('navigate', function (navigateEvent) {
    const nextUrl = new URL(navigateEvent.destination.url);
    const currentUrl = new URL(navigation?.currentEntry.url || '');

    navigateEvent.intercept({
        async handler() {
            const content = await getNewContent(nextUrl);



            const main = document.querySelector('body');
            if (main) main.innerHTML = contennt || '';

            const clickedImage = document.querySelector('.portfolio-item[data-full="' + nextUrl.pathname + '"]');

            if (!main || !clickedImage) return;

            const image = clickedImage.querySelector('img');
            if (image) image.style.viewTransitionName = 'portfolio-image';
            document.startViewTransition(() => {
                main.innerHTML = content;
                document.documentElement.scrollTop = 0;
            })


        }
    });

})



const shouldNotIntercept = (navigateEvent) => {
    const nextUrl = new URL(navigateEvent.destination.url);

    // Don't animate anything if we're leaving to another domain.
    if (location.origin !== nextUrl.origin) return true;

    // If we're going to the same page, this could be hot reloading on localhost,
    // we don't intercept there.
    if (nextUrl.pathname === window.location.pathname || !nextUrl.pathname) {
        return true;
    }

    if (
        !navigateEvent.canIntercept ||
        navigateEvent.hashChange ||
        navigateEvent.formData ||
        navigateEvent.downloadRequest
    ) {
        return true;
    }
    return false;
};

const getNewContent = async (url) => {
    const page = await fetch(url);
    const data = await page.text();
    const mainTagContent = data.match(/<body>(.*?)<\/body>/s)?.[1];

    return mainTagContent;
};