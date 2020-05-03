@if(isset($consultation->animal->visuel) && $consultation->animal->visuel)
    <img class="card-img-top img-fluid" src="@if(!empty($consultation->animal->visuel)){{Storage::url('uploads')}}/{{$consultation->animal->visuel}}@else {{asset('imgs/avatar-image.png')}} @endif" alt="avatar">
@endif
@if(isset($patient->visuel) && $patient->visuel)
<img class="card-img-top img-fluid" src="@if(!empty($patient->visuel)){{Storage::url('uploads')}}/{{$patient->visuel}}@else {{asset('imgs/avatar-image.png')}} @endif" alt="avatar">    
@endif