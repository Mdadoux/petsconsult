// Call the dataTables jQuery plugin
$(document).ready(function () {
  $('#dataTable').DataTable(
    {
      "order": [[0, "desc"]]
    }
  );

  //gestion du modal de suppression d'un patien 
  $('#delete-modal').on('show.bs.modal', function (e) {
    const $elem = $(e.relatedTarget);
    const elem_id = $elem.attr('id');
    const elem_titre = $elem.data('titre');
    const formRouteAction = $elem.data('form-route');
    const content = $(this);
    content.find(".modal-body #element-a-suppr").val(elem_id);
    content.find("#element-titre").text(elem_titre);
    content.find("#formRoute").val();

    if (formRouteAction !== "undefined") {
      content.find("form").prop('action', formRouteAction);
      //console.log(formRouteAction);
    }

  })

  // Gestion mise à jours patient 
  /*$(document).on('click', '.patient-edit', function () {
  
    console.log("zombi");
  })
  */

  $('#add-Modal').on('show.bs.modal', function (e) {
    const $elem = $(e.relatedTarget);
    const $modalContent = $(this);
    //valuer d'un champs chaché dans le formulaire avec la bonne url de submission
    const $updateFormAction = $modalContent.find('#form-update-action').val();
    const $methodField = '<input type="hidden" name="_method" value="patch">';

    if ($elem.hasClass('patient-edit')) {
      const elem_id = $elem.data('idpatient');
      const $updateForm = $modalContent.find('form');
      $updateForm.prop('action', $updateFormAction);
      // console.log($updateForm);
      $updateForm.prepend($methodField);

      $.ajax({
        url: "/patients/" + elem_id + "/edit",
        dataType: "json",
        success: function (datas) {
          if (datas.proprietaire === null) {
            var nomProprietairePatient = "",
              prenomProprietairePatient = "",
              proprietaireLibelle = 'Selectionner';
          } else {
            var nomProprietairePatient = datas.proprietaire.nom,
              prenomProprietairePatient = datas.proprietaire.prenom,
              proprietaireLibelle = nomProprietairePatient + " - " + prenomProprietairePatient;
          }
          if (datas.race === null) {
            var racePatient = "Non communiqué";
          } else {
            var racePatient = datas.race;
          }

          const nomPatient = datas.nom,
            idPatient = datas.id,
            typePatient = datas.animal_type.designation,
            sexePatient = datas.sexe,
            disciplinePatient = datas.discipline,
            agePatient = datas.age;
          // racePatient = datas.race;
          $modalContent.find('#nom').val(nomPatient);
          $modalContent.find('#animal-id').val(idPatient);
          const animalType = $modalContent.find('#animal-type option');
          animalType.each(function (index, item) {
            if ($(item).text().toLocaleLowerCase() === typePatient.toLocaleLowerCase()) {
              $(this).val(index).attr("selected", "selected");
            }
          })
          // Séléctionner les le sexe directement
          const $animalSexeType = $modalContent.find('#animal-sexe option');
          $animalSexeType.each(function (index, elem) {
            if ($(elem).text().toLocaleLowerCase() === sexePatient.toLocaleLowerCase()) {
              $(this).val(index).attr("selected", "selected");
            }
          })
          // console.log(datas);

          $modalContent.find('#discipline').val(disciplinePatient);
          $modalContent.find('#animal-race').val(racePatient);
          $modalContent.find('#age').val(agePatient);
          //seléctionner directement le nom du propirétaire 
          const $animalProprietaire = $modalContent.find('#proprietaire option');
          $animalProprietaire.each(function (index, elem) {
            if ($(elem).text().toLocaleLowerCase() === proprietaireLibelle.toLocaleLowerCase()) {
              $(this).val(index).attr("selected", "selected");
            }
          })
          //  $modalContent.find('img').attr('src', 'https://images.unsplash.com/photo-1450052590821-8bf91254a353?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=1489&q=80')
          // console.log(datas, animalType);
        }
      })

      const $actionBtn = $modalContent.find(".modal-footer button[type='submit']");
      $actionBtn.text('Enregistrer').addClass('btn-update');

    } else {
      const $actionBtn = $modalContent.find(".modal-footer button[type='submit']");
      $actionBtn.text('Valider').addClass('btn-add');


      $(document).on('change', '#add-Modal form select', function () {
        let selectedOption = $(this).val();
        //let option = $(this).find('option[value="' + value + '"]').prop('selected', true);
        var option = $(this).children();
        option.each(function (index, option) {

          if (selectedOption === option.value) {
            console.log($(this));
            $(this).prop('selected', true);
          }
        })

        // console.log(option);
      })
    }

  })


  // console.log($modalContent.find('form select'));
  jQuery('#input-search-animal').on('keyup', function () {
    const terme = $(this).val();
    const $resultcontainer = $('#animal-search-result');
    if (terme.length > 2) {
      $.ajax({
        type: 'GET',
        url: "search",
        data: { 'q': terme },
        beforeSend: () => {
          $(".spin-input-group #search-spinner").show();
        },
        success: (data) => {
          $(".spin-input-group #search-spinner").hide();
          console.log(data);

          if (Array.isArray(data)) {
            data.map((element, i) => {
              // const element = data[index];
              data_animal = JSON.stringify(element);
              // console.log(data_animal);   
              if ($("#" + element.id).length == 0) {
                $resultcontainer.append(`<a class="dropdown-item d-flex align-items-center animal-search-result-item" href="#" 
                id="${element.id}"
                data-animal='${data_animal}'>
                <div class="dropdown-list-image mr-3">
                  <img class="rounded-circle" src="https://source.unsplash.com/fn_BT9fwg_E/60x60" alt="">
                  <div class="status-indicator bg-success"></div>
                </div>
                <div class="font-weight-bold">
                  <div class="text-truncate">${element.nom}</div>
                  <div class="small text-gray-500">${element.sexe} - ${element.designation}</div>
                </div>
              </a> `);
              }
            })
          } else {
            if ($('#no-item-found').length == 0) {
              $resultcontainer.empty();
              $resultcontainer.append(`<p class="p-2" id="no-item-found">${data}</p>`);
            }
          }
        }
      })
      //console.log($(this).val());

    } else {
      $resultcontainer.empty();
    }

  })

  //cliker sur le bouton ajouter un patien fait afficher le formuliare es6 syntax
  $('.btn-show-create-patient-form').on('click', (evt) => {
    evt.preventDefault;
    $('#patient-row').toggleClass('show-patient-form');

  });
  // au click sur un item de la liste,   
  $(document).on('click', '.animal-search-result-item', function (evt) {
    const patient_data = $(this).data('animal');
    const $patient_container_form = $('#patient-row');

    if (patient_data.prop_name === null) {
      var nomprop_patient = "",
        prenomprop_patient = "",
        prop_libelle = 'Selectionner';
    } else {
      var nomprop_patient = patient_data.prop_nom,
        prenomprop_patient = patient_data.prop_prenom,
        prop_libelle = nomprop_patient + " - " + prenomprop_patient;
    }
    if (patient_data.race === null) {
      var race_patient = "Non communiqué";
    } else {
      var race_patient = patient_data.race;
    }
    $('#patient-id').val(patient_data.id);
    //selectionner le nom et remplir le champs de recherche
    $('#input-search-animal').val($(this).find('.text-truncate').text());
    // et vider la liste
    $('#animal-search-result').empty();
    $patient_container_form.addClass('show-patient-form');
    // les champs de patient rempli avec les données recu 
    $patient_container_form.find('input#nom').val(patient_data.nom);
    $patient_container_form.find('input#discipline').val(patient_data.discipline);
    $patient_container_form.find('input#age').val(patient_data.age);
    $patient_container_form.find('input#animal-race').val(race_patient);

    // cibler les liste fes types d'animaux
    const $animaltypes = $patient_container_form.find('#animal-type option');
    $animaltypes.each(function (index, elem) {
      if ($(elem).text().toLocaleLowerCase() === patient_data.designation.toLocaleLowerCase()) {
        $(this).val(index).attr("selected", "selected");
      }
    })

    //lister les types de sexe 
    const $animalsexe = $patient_container_form.find('#animal-sexe option');
    $animalsexe.each(function (index, item) {
      if ($(item).text().toLocaleLowerCase() === patient_data.sexe.toLocaleLowerCase()) {
        $(this).val(index).attr("selected", "selected");
      }
    })

    const $animalproprietaire = $patient_container_form.find('#proprietaire option');
    $animalproprietaire.each(function (index, elem) {
      if ($(elem).text().toLocaleLowerCase() === prop_libelle.toLocaleLowerCase()) {
        $(this).val(index).attr("selected", "selected");
      }
    })

    $('.patient-row-form-wrapper').find('.form-control').attr('readonly', true);
  })





});
