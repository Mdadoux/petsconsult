$(document).ready(function () {
    //proprietaires
    $('.proprietaires-details-inner').find('.spinner-border').hide();
    $('.add-new-owner').on('click', function (evt) {
        evt.preventDefault();
        var $container = $('.proprietaires-details-inner');
        var tpl_to_add = 'add-proprietaires-form'; // l'url de template 
        var tpl_to_details = '';
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
        $('.update-owner-details').on('click', function (evt) {
            proprietaire_id = $(this).data('propid');
            open_proprietaire_side_bar(proprietaire_id, true);
        })
    });

    $(document).on('click', '.prop-cta-actions .update-owner-details', function (evt) {
        proprietaire_id = $(this).data('propid');
        open_proprietaire_side_bar(proprietaire_id, true);
    });

    $('.show-owner-details').on('click', function () {
        proprietaire_id = $(this).data('propid');
        open_proprietaire_side_bar(proprietaire_id, false);
    });

    set_couleur_to_proprietaire();

});

/**
 * 
 * @param {*identifiant du proprietaire} idProprietaire 
 * @param {* Si true en mode edition sinon affichage} eddite 
 */
function open_proprietaire_side_bar(idProprietaire, eddite = true) {
    var $container = $('.proprietaires-details-inner');
    // si la sidebare n'est pas déjà deployée 
    if ($('.proprietaire-details-container').not('.open')) {
        $('.proprietaire-details-container').addClass('open');
    }
    $container.find('.spinner-border').fadeIn();
    // si eddite est renseigné ajouter le template d'édition 
    if (eddite == true) {
        var tpl_to_add = 'proprietaires/' + idProprietaire + '/edit';
    } else {
        var tpl_to_add = 'proprietaires/' + idProprietaire;
    }
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
}

/**
 * Attribuer une couleur à un proprietaire 
 */
function set_couleur_to_proprietaire() {
    var ownersColors = {};
    window.localStorage.setItem('owners', JSON.stringify(ownersColors));
    console.log(ownersColors);

    var $listeProp = $('.prop-item');

    $listeProp.each(function (i) {
        var name = $(this).find('.prop-initials-container').text(),
            id = $(this).find('.show-owner-details').data('propid');
        var randomColor = Math.floor(Math.random() * 16777215).toString(16);
        var item = {
            id: id,
            letter: name,
            color: "#" + randomColor
        }
        ownersColors[i] = item;

    })
    console.log(ownersColors);
    $listeProp.each(function (i) {
        var randomColor = Math.floor(Math.random() * 16777215).toString(16);
        $(this).find('.prop-initials-container').css({
            background: "#" + randomColor
        });
    })

}
