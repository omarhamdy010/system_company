$(document).ready(function () {
        $('.presence').on('click', function (e) {
        e.preventDefault();
        $(this).removeClass('btn-success');
        $(this).addClass('btn-secondary disabled');
        $('.absence').removeClass('btn-secondary disabled');
        $('.absence').addClass('btn-danger');
    });

    $('.absence').on('click', function (e) {
        e.preventDefault();
        $(this).removeClass('btn-danger');
        $(this).addClass('btn-secondary disabled');
        $('.presence').removeClass('btn-secondary disabled');
        $('.presence').addClass('btn-success');
    });

});
