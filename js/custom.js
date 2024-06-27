const singleThumbnailGallery = () => {
    const thumbGallery = document.querySelector('#single-thumbnail');
    if (!thumbGallery) return;
    const thumbGalleryCount = thumbGallery.querySelectorAll('a').length;
    const itemCount = thumbGallery.querySelector('#gallery-item-count');
    const btn = thumbGallery.querySelector('#js-gallery-count');
    if (itemCount) {
        itemCount.innerHTML = thumbGalleryCount;
    }
    console.dir(thumbGalleryCount);
    const tg = lightGallery(thumbGallery, {
        selector: '.item',
        download: false,
    });

    if (btn) {
        btn.addEventListener('click', (e) => {
            tg.openGallery();
        });
    }
}
singleThumbnailGallery();
