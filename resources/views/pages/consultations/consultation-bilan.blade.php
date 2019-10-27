<div class="page_content">

    <div class="cell">
    <div class="toolbar">
        <div class="toolbar_left">
        <div class="toolbar_btn btn_grey" id="add_pos_marker">Ajouter une note positve</div>
        <div class="toolbar_btn btn_grey" id="add_neg_marker">Ajouter une note négative</div>
        <div class="toolbar_btn btn_grey" id="save">Sauver le bilan</div>
        <div class="toolbar_btn btn_grey" id="bilan-refresh-btn">Recuperer un ancien bilan</div>
        </div>
    </div>
    <div id="element"></div>
    </div>
</div>
{{--Permet, Si on dans une consultation d'un patient de recupèrer le blian via la bdd etl'afficher''--}}
@if (isset($consultation->id) and !empty($consultation->id))

<input type="hidden" name="input-consultation-id" id="input-consultation-id" value="{{$consultation->bilan}}">

@else
{{--Permet de gardertemporairement le bilan lors de la création d'une consulation avantde le sauveren bdd'--}}
<input type="hidden" class="form-control" id="input-consultation-bilan" name="consultation-bilan">

@endif
