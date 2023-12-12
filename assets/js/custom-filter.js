// Les filtres

jQuery(document).ready(function($) {
    // Gestion du clic sur les filtres
    $('.filter-category, .filter-format, .filter-sort').on('click', function() {
        // Ferme tous les autres filtres avant d'ouvrir le filtre actuel
        $('.filter-category, .filter-format, .filter-sort').not(this).removeClass('active').find('.filter-list').hide();

        $(this).toggleClass('active'); 
        $(this).find('.filter-list').toggle(); 
    });

    // Gestion de la sélection des filtres
    $('.filter-list li').on('click', function() {
        var filterType = $(this).closest('.filter-list').attr('id').split('-')[0]; // category, format, sort
        var selectedValue = $(this).data(filterType); // Récupère la valeur sélectionnée
        $('#' + filterType + '-input').val($(this).text()).data(filterType, selectedValue);
        $('.filter-list').hide();
        $('.filter-category, .filter-format, .filter-sort').removeClass('active'); // Retire la classe 'active' des filtres
        sendAjaxRequest();
    });

    // Fonction pour envoyer une requête AJAX
    function sendAjaxRequest() {
        var selectedCategory = $('#category-input').data('category') || 'all';
        var selectedFormat = $('#format-input').data('format') || 'all';
        var sortOrder = $('#sort-input').data('sort') || 'DESC';

        $.ajax({
            url: ajax_object.ajaxurl,
            method: 'POST',
            data: {
                action: 'filters_images',
                selectedCategory: selectedCategory,
                selectedFormat: selectedFormat,
                sortOrder: sortOrder
            },
            success: function(res) {
                $('.photos-grid').html(res);
            },
            error: function(res) {
                console.error("Erreur AJAX: ", res);
            }
        });
    }
});
