$(document).ready(function () {
    //proprietaires
    $('.proprietaires-details-inner').find('.spinner-border').hide();
    $('.add-new-owner').on('click', function (evt) {
        evt.preventDefault();
        const $container = $('.proprietaires-details-inner');
        const tpl_to_add = 'add-proprietaires-form'; // l'url de template 
        const tpl_to_details = '';
        $container.find('.spinner-border').fadeIn();
        $container.load(tpl_to_add, function (_res, status, xhr) {
            if (status == 'success') {
                console.log(status);
                if ($container.children().length == 0) {
                    $container.find('.spinner-border').hide();
                }
            } else {
                if ($container.children().length) {
                    $container.find('.spinner-border').hide();
                    if ($container.children('.module-non-chargee').length == 0) {
                        $container.append('<h1 class="module-non-chargee">Module non chargé</h1>');
                    }
                }
            }
        })
        // console.log($container.children());
        $('.proprietaire-details-container').addClass('open');
    });

    $('.add-prop-action-close').on('click', function (evt) {
        evt.preventDefault();
        $('.proprietaire-details-container').removeClass('open');
    })

    //en cliquant sur détails pro
    $('.prop-item').on('shown.bs.dropdown', function (evt) {
        show_prop_for_update();
    });

    $('.show-owner-details').on('click', function () {
        idelemnt = $(this).data('propid');
        show_prop_details(idelemnt);
    })


});

// mettre à jour le proprietaire
function show_prop_for_update() {
    $('.update-owner-details').on('click', function () {
        const idProprietaire = $(this).data('propid');
        var $container = $('.proprietaires-details-inner');
        $('.proprietaire-details-container').addClass('open');
        $container.find('.spinner-border').fadeIn();
        const tpl_to_add = 'proprietaires/' + idProprietaire + '/edit';
        $container.load(tpl_to_add, function (res, status, xhr) {
            if (status === 'success') {
                return true;
            } else {
                if ($container.children().length) {
                    $container.find('.spinner-border').hide();
                    if ($container.children('.module-non-chargee').length == 0) {
                        $container.append('<h1 class="module-non-chargee">Module non chargé</h1>');
                    }
                }
            }
        });

    });

}

// afficher les détails du proprietaires
function show_prop_details(idProprietaire) {
    var $container = $('.proprietaires-details-inner');
    if ($('.proprietaire-details-container').not('.open')) {
        $('.proprietaire-details-container').addClass('open');
    }
    $container.find('.spinner-border').fadeIn();
    const tpl_to_add = 'proprietaires/' + idProprietaire;
    $container.load(tpl_to_add, function (res, status, xhr) {

        if (status === 'success') {
            console.log('pwuipwui');
        } else {
            if ($container.children().length) {
                $container.find('.spinner-border').hide();
                if ($container.children('.module-non-chargee').length == 0) {
                    $container.append('<h1 class="module-non-chargee">Module non chargé</h1>');
                }
            }
        }
    });
}