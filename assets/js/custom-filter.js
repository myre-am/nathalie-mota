jQuery(document).ready(function($) {
    // Gestion du clic sur les filtres
    $('#category-input, #format-input, #sort-input').on('click', function() {
        $(this).next('.filter-list').toggle();
    });

    // Gestion de la sélection des filtres
    $('.filter-list li').on('click', function() {
        var filterType = $(this).closest('.filter-list').attr('id').split('-')[0]; // category, format, sort
        var selectedValue = $(this).data(filterType);
        $('#' + filterType + '-input').val($(this).text()).data(filterType, selectedValue);
        $(this).parent().hide();
        sendAjaxRequest();
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
