<div id="add-prop-contaier">
        <h2 class="add-prop-title">@if(isset($proprietaireId) && !empty($proprietaireId)) {{__('Modifier les informaions')}} @else Ajouter un propriétaires @endif</h2>   
        
        <form action="@if(isset($proprietaireId) && !empty($proprietaireId)){{route('proprietaires.update',$proprietaireId->id)}}@else {{route('proprietaires.store')}}@endif"  method="post">
            @if(isset($proprietaireId) && !empty($proprietaireId))
            @method('PUT')
            @endif
                @csrf
                <section class="form-row">
                    <div class="form-group">
                        <label for="input-prop-name">Nom *</label>
                        <input type="text" class="form-control" id="input-prop-nom" name="input-prop-nom" placeholder="Ex:Doe"
                         value="{{old('input-prop-nom')}} @if(isset($proprietaireId) && !empty($proprietaireId)) {{$proprietaireId->nom}}@endif" required="required">
                    </div>
                    <div class="form-group">
                        <label for="input-prop-prenom">Prénom</label>
                        <input type="text" class="form-control" name="input-prop-prenom" value="{{old('input-prop-prenom')}} @if(isset($proprietaireId) && !empty($proprietaireId)) {{$proprietaireId->prenom}}@endif" placeholder="Ex:Jhon">
                    </div>
                </section>
                <section class="form-row">
                    <div class="form-group">
                        <label for="input-prop-email">Email</label>
                        <input type="email" class="form-control" name="input-prop-email" id="input-prop-email" value="{{old('input-prop-email')}} @if(isset($proprietaireId) && !empty($proprietaireId)) {{$proprietaireId->email}}@endif" placeholder="Ex:booboolover@ls.com">
                    </div>
                    <div class="form-group">
                        <label for="input-prop-tel">Télephone *</label>
                        <input type="tel" class="form-control" name="input-prop-tel" id="input-prop-tel" value="{{old('input-prop-tel')}} @if(isset($proprietaireId) && !empty($proprietaireId)) {{$proprietaireId->telephone}}@endif" placeholder="Un numero" required="required">
                    </div>
                </section>
                <div class="form-group">
                    <label for="input-prop-adresse">Adresse</label>
                    <input type="text" class="form-control" name="input-prop-adresse" value="{{old('input-prop-adresse')}} @if(isset($proprietaireId) && !empty($proprietaireId)) {{$proprietaireId->adresse}}@endif" placeholder="Adresse">
                </div>   
                <section class="form-row">
                    <div class="form-group">
                        <label for="input-prop-codepostal">Code postal</label>
                        <input type="text" class="form-control" name="input-prop-codepostal" value="{{old('input-prop-codepostal')}} @if(isset($proprietaireId) && !empty($proprietaireId)) {{$proprietaireId->code_postal}}@endif" placeholder="Code postal">
                    </div>
                    <div class="form-group">
                        <label for="input-prop-ville">Ville</label>
                        <input type="text" class="form-control" name="input-prop-ville" value="{{old('input-prop-ville')}} @if(isset($proprietaireId) && !empty($proprietaireId)) {{$proprietaireId->ville}}@endif" placeholder="Ville">
                    </div>
                </section>
                <button type="submit" class="btn btn-primary btn-sm">@if(isset($proprietaireId) && !empty($proprietaireId)) Enregister @else Ajouter @endif</button>
</form>
</div>