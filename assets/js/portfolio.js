jQuery(document).ready(function($) {
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
        function() { // mouseenter
            const fullImage = $(this).data("full");
            if (currentImage && currentImage.src === fullImage) return;


            // Create new image
            loadingImage = createNewImage(fullImage);

            $(loadingImage).on('load', function() {
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

    $(".portfolio-item").click(function() {
        const link = $(this).data("link");
        window.location.href = link;
    });
});

window.navigation.addEventListener('navigate', function(navigateEvent) {
    const nextUrl = new URL(navigateEvent.destination.url);
    const currentUrl = new URL(navigation?.currentEntry.url || '');

    navigateEvent.intercept({
        async handler() {
            const contennt = await getNewContent(nextUrl);

            document.startViewTransition(() => {

            const main = document.querySelector('main');
                if(main) main.innerHTML = contennt || ''; 
            })
        }
    });

})

const getNewContent = async(url) => {
    const page = await fetch(url);
    const data = await page.text();
    const mainTagContent = data.match(/<main>([\s\S]*?)<\/main>/)[1];

    return mainTagContent
}