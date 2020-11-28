<form action="{{route('patients.store')}}" method="POST" enctype="multipart/form-data">
  
    @csrf
    <ul class="nav nav-tabs" id="myTab" role="tablist">
      {{--  le'url de modification de formulaire si pour une modification' --}}
        <input type="hidden" value="{{route('patients.update','test')}}" name="form-update-action" id="form-update-action">
        <li class="nav-item">
          <a class="nav-link active" id="modal-home-tab" data-toggle="tab" href="#modal-home" role="tab" aria-controls="modal-home" aria-selected="true">Infos</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Photo</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" id="modal-contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false">Contact</a>
        </li>
    </ul>      
    <div class="tab-content" id="myTabContent">        
            <div class="tab-pane fade show active" id="modal-home" role="tabpanel" aria-labelledby="modal-home-tab">
              <input type="hidden" id="animal-id" value="" name="animal-id">
                <div class="tab-content-inner py-4">
                <div class="form-row">
                    <div class="col-md-4 mb-3">
                      <label for="nom">Nom</label>
                      <input type="text" class="form-control" name="nom" id="nom" placeholder="Entrez un nom" required>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="race">Type</label>
                        <select class="form-control" id="animal-type" name="animal-type">
                          <option>Selectionner un type</option>
                          @if(!empty($types_animaux))
                              @foreach($types_animaux as $type_animal)
                                 <option value="{{$type_animal->id}}">{{ucfirst($type_animal->designation)}}</option>
                              @endforeach
                           @endif
                        </select>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label  for="race">Sexe</label>
                        <select class="form-control" id="animal-sexe" name="animal-sexe">                           
                            <option>Mâl</option>
                            <option>Femelle</option>
                           </select>
                    </div>
                </div>
                  <div class="form-row">
                      <div class="col-md-3 mb-3">
                          <label for="discipline">Discipline</label>                  
                            <input type="text" class="form-control" id="discipline" name="animal-discipline" placeholder="Discipline">
                        </div>
                     
                      <div class="col-md-2 mb-3">
                          <label  for="race">Age</label>
                          <input type="number" min="0" class="form-control" id="age" name="animal-age" placeholder="0">
                      </div>
                      <div class="col-md-3 mb-3">
                        <label  for="race">Race</label>
                        <input type="text" class="form-control" id="animal-race" name="animal-race" placeholder="Race">
                    </div>
                      <div class="col-md-4 mb-3">
                          <label  for="race">Propriétaire</label>
                          <select class="form-control" id="proprietaire" name="animal-proprietaire">
                              <option value="0">Selectionner</option>
                              @if(!empty($proprietaires))
                                @foreach($proprietaires as $proprietaire)                             
                                  <option value="{{$proprietaire->id}}">{{$proprietaire->nom}} - {{$proprietaire->prenom}}</option>                                 
                                @endforeach
                              @endif
                          </select>
                      </div>
                  </div>
                </div>
            </div>
        
    
        <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
            <div class="tab-content-inner py-4">
              <div class="row">
                <div class="col-sm-7">
                  
                <div class="form-group">
                    <label class="custom-file-label" for="animal-photo">Ajouter une photo</label>
                    <input type="file" class="" id="animal-photo" name="animal-photo">
                  </div>
                </div>
                <div class="col-sm-5">
                  <div id="form-modal-preview-image-container" class="text-center">
                      <img src="{{asset('imgs/avatar-image.png')}}" alt="" class="img-fluid">                   
                  </div>

                </div>
              </div>
            </div>
        </div>
        <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="modal-contact-tab">...</div>
      </div>

      <button type="submit" name="addpatient" id="addpatient" style="display:none">Ajouter</button>


    </div>{{-- fermeture de modal body--}}
    <div class="modal-footer">
      <button class="btn btn-secondary" type="button" data-dismiss="modal">{{__('Annuler')}}</button>
      <button type="submit" class="btn btn-primary">{{ __('Ajouter') }}</button>              
    
    </div>

</form>