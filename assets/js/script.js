// Modale

const modal = document.getElementById('myModal');
const span = document.getElementById("close");
const modalContent = document.getElementsByClassName("modal-content")[0];
const refPhoto = document.getElementById("reference-photo");

// Fonction pour ouvrir la modale avec ou sans référence
function openModalWithRef(reference) {
    if (reference && refPhoto) {
        refPhoto.value = reference;
    } else if (refPhoto) {
        refPhoto.value = "";
    }
    modal.style.display = "block";
}

document.addEventListener("click", function(event) {
    let targetElement = event.target;

    if (targetElement.closest('.open-modale')) {
        const reference = targetElement.closest('.open-modale').getAttribute('data-reference');
        openModalWithRef(reference);
    }
});

span.addEventListener("click", function() {
    modal.style.display = "none";
});

modal.addEventListener("click", function() {
    modal.style.display = "none";
});

modalContent.addEventListener("click", function(e) {
    e.stopPropagation();
});


// Miniatures 
document.querySelectorAll('.thumbnail-nav').forEach(nav => {
    nav.addEventListener('mouseenter', () => {
        // Affiche la miniature correspondante
        nav.querySelectorAll('.miniature1, .miniature2').forEach(miniature => {
            miniature.style.display = 'block';
        });
    });
    nav.addEventListener('mouseleave', () => {
        // Cache la miniature correspondante
        nav.querySelectorAll('.miniature1, .miniature2').forEach(miniature => {
            miniature.style.display = 'none';
        });
    });
});

  

  // Le bouton 'Charger plus' 

  jQuery(document).ready(function($) {
    var paged = 1;

    $('#load-more').on('click', function() {
        paged++;

        $.ajax({
            type: 'POST',
            url: '/nathalie-mota/wp-admin/admin-ajax.php',
            dataType: 'json',
            data: {
                action: 'load_more_photos',
                paged: paged,
            },
            success: function(res) {
                if (paged >= res.max) {
                    $('#load-more').hide();
                }
                $('.photos-grid').append(res.html);
            }
        });
    });
});

// Menu Burger

document.addEventListener('DOMContentLoaded', function() {
    const burgerButton = document.querySelector('.burger-menu-button');
    const navigation = document.querySelector('header nav');
    const body = document.body;

    burgerButton.addEventListener('click', function() {
        // Bascule les classes pour ouvrir/fermer le menu
        this.classList.toggle('open-nav');
        navigation.classList.toggle('open');

        // Vérifie si le menu est ouvert
        if (navigation.classList.contains('open')) {
            // Bloque le défilement de la page
            body.style.overflow = 'hidden';
            document.documentElement.style.overflow = 'hidden';
        } else {
            // Réactive le défilement de la page
            body.style.overflow = '';
            document.documentElement.style.overflow = '';
        }
    });
});


