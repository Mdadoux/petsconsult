@if(isset($consultation->animal->visuel) && !empty($consultation->animal->visuel))
<img class="card-img-top img-fluid" src="{{Storage::url('uploads')}}/{{$consultation->animal->visuel}}" alt="avatar">
@elseif(isset($patient->visuel) && !empty($patient->visuel))
<img class="card-img-top img-fluid" src="{{Storage::url('uploads')}}/{{$patient->visuel}}" alt="avatar">    
@else
<img class="card-img-top img-fluid" src="{{asset('imgs/avatar-image.png')}}" alt="avatar">
@endif

