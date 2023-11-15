
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


// Affichage de la miniature 
document.querySelectorAll('.thumbnail-nav').forEach(function(nav) {
    nav.addEventListener('mouseenter', function() {
      this.querySelector('.miniature').style.display = 'block';
    });
    nav.addEventListener('mouseleave', function() {
      this.querySelector('.miniature').style.display = 'none';
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

    




