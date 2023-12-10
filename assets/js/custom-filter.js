// Les filtres

jQuery(document).ready(function($) {
    // Gestion du clic sur les filtres
    $('.filter-category, .filter-format, .filter-sort').on('click', function() {
        $(this).toggleClass('active'); // Bascule la classe 'active'
        $(this).find('.filter-list').toggle(); // Affiche/cache la liste
    });

    // Gestion de la sélection des filtres
    $('.filter-list li').on('click', function() {
        var filterType = $(this).closest('.filter-list').attr('id').split('-')[0]; // category, format, sort
        var selectedValue = $(this).data(filterType);
        $(this).closest('.filter-category, .filter-format, .filter-sort').find('input').val($(this).text()).data(filterType, selectedValue);
        $('.filter-list').hide();
        $('.filter-category, .filter-format, .filter-sort').removeClass('active'); // Retire la classe 'active' des filtres
    });



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
                console.error(res);
            }
        });
    }
});
