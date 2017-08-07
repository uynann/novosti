$(function() {
    $('.ui.dropdown').dropdown();

    $('.delete-category').click(function() {
        $('.small.modal.modal-delete-category').modal('show');
        $('.small.modal.modal-delete-category .ok-button').attr('href', 'index.php?delete=' + $(this).attr('data-id'));
    });

    $('.delete-post').click(function() {
        $('.small.modal.modal-delete-post').modal('show');
        $('.small.modal.modal-delete-post .ok-button').attr('href', $(this).attr('data-url'));
    });


    $('.nav-btn').click(function() {
        $('.nav-overlay').show();
        $('.nav-categories-mobile').animate({
            right: '0'
        }, 400, function() {
            // Animation complete.
        });
    });

    $('.nav-overlay').click(function() {
        $(this).hide();
        $('.nav-categories-mobile').animate({
            right: '-180px'
        }, 400, function() {
            // Animation complete.
        });
    });
});
