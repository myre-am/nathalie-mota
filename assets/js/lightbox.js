document.addEventListener('DOMContentLoaded', function() {
    const lightbox = document.getElementById("lightbox");
    const lightboxImage = lightbox.querySelector(".lightbox-image");
    const lightboxRef = lightbox.querySelector(".lightbox-ref");
    const lightboxCat = lightbox.querySelector(".lightbox-cat");
    const closeBtn = lightbox.querySelector(".close-lightbox");
    const prevArrow = lightbox.querySelector(".prev-arrow");
    const nextArrow = lightbox.querySelector(".next-arrow");

    // Cibler les deux conteneurs
    const galleryContainer = document.querySelector('.photos-grid') || document.querySelector('.related-photos');
    let photos = [];
    let currentIndex = 0;

    // Mise à jour de la liste des photos
    function updatePhotos() {
        if (!galleryContainer) return; // S'assurer que le conteneur existe

        photos = Array.from(galleryContainer.querySelectorAll('.bloc-photo')).map(photoBlock => {
            return {
                imgSrc: photoBlock.querySelector('.gallery-photo').getAttribute('src'),
                ref: photoBlock.querySelector('.photo-ref').textContent,
                cat: photoBlock.querySelector('.photo-cat').textContent
            };
        });
    }

    // Ajout d'écouteurs d'événements sur les icônes de lightbox
    function attachEventListeners() {
        galleryContainer.addEventListener('click', function(event) {
            if (event.target.closest('.lightbox-icon')) {
                const photoBlock = event.target.closest('.bloc-photo');
                const index = photos.findIndex(photo => photo.imgSrc === photoBlock.querySelector('.gallery-photo').getAttribute('src'));
                if (index !== -1) {
                    openLightbox(index);
                }
            }
        });
    }

    // Fonction pour ouvrir la lightbox
    function openLightbox(index) {
        const photo = photos[index];
        lightboxImage.src = photo.imgSrc;
        lightboxRef.textContent = photo.ref;
        lightboxCat.textContent = photo.cat;
        lightbox.style.display = 'flex';
        currentIndex = index;
        // Bloquer le défilement de la page en arrière-plan
        document.body.style.overflow = 'hidden';
        document.documentElement.style.overflow = 'hidden';
    }

    // Fermeture de la lightbox
    closeBtn.addEventListener('click', closeLightbox);
    lightbox.addEventListener('click', function(event) {
        if (event.target === lightbox) {
            closeLightbox();
        }
    });

    function closeLightbox() {
        lightbox.style.display = 'none';
        document.body.style.overflow = '';
        document.documentElement.style.overflow = '';
    }

    // Navigation entre les images
    prevArrow.addEventListener('click', () => currentIndex > 0 && openLightbox(currentIndex - 1));
    nextArrow.addEventListener('click', () => currentIndex < photos.length - 1 && openLightbox(currentIndex + 1));

    // Mise à jour initiale et attachement des écouteurs d'événements
    updatePhotos();
    attachEventListeners();

    // Gestion du bouton "Charger plus" pour les nouvelles images
    const loadMoreButton = document.getElementById('load-more');
    if (loadMoreButton) {
        loadMoreButton.addEventListener('click', function() {
            setTimeout(() => {
                updatePhotos();
                attachEventListeners();
            }, 1000);
        });
    }
});

