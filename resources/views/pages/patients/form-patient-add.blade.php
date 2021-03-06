<form action="{{route('patients.store')}}" method="POST">
    @csrf
<ul class="nav nav-tabs" id="myTab" role="tablist">
        <li class="nav-item">
          <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Infos</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Photo</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false">Contact</a>
        </li>
      </ul>
      <div class="tab-content" id="myTabContent">        
            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
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
                        <select class="form-control" id="animal-sexe" name="animal-sexe" required>
                            <option>Selectionner</option>
                            <option>Mâl</option>
                            <option>Femelle</option>
                           </select>
                    </div>
                </div>
                  <div class="form-row">
                      <div class="col-md-4 mb-3">
                          <label for="discipline">Discipline</label>                  
                            <input type="text" class="form-control" id="discipline" name="animal-discipline" placeholder="Discipline">
                        </div>
                     
                      <div class="col-md-4 mb-3">
                          <label  for="race">Age</label>
                          <input type="number" min="0" class="form-control" id="age" name="annimal-age" placeholder="0">
                      </div>
                      <div class="col-md-4 mb-3">
                          <label  for="race">Propriétaire</label>
                          <select class="form-control" id="proprietaire" name="animal-proprietaire">
                              <option>Selectionner</option>
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
                <div class="col-sm-6">
                  
                <div class="form-group">
                    <label for="animal-photo">Photo</label>
                    <input type="file" class="form-control-file" id="animal-photo" name="animal-photo">
                  </div>
                </div>
                <div class="col-sm-6">
                    <img src="https://images.unsplash.com/photo-1517887121-557af22472e1?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=1350&q=80" alt="" class="img-fluid">

                </div>
              </div>
            </div>
        </div>
        <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">...</div>
      </div>

      <button type="submit" name="addpatient" id="addpatient" style="display:none">Ajouter</button>


    </div>{{-- fermeture de modal body--}}
    <div class="modal-footer">
      <button class="btn btn-secondary" type="button" data-dismiss="modal">{{__('Annuler')}}</button>
      <button type="submit" class="btn btn-primary">{{ __('Ajouter') }}</button>              
    
    </div>

</form>