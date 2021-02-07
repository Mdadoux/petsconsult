<div class="modal fade modal-danger" id="delete-modal" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalCenterTitle" aria-hidden="true">

    {{-- <form action="{{route('patients.destroy',1,'patient')}}" method="POST"> --}}
    <form action="" method="POST">
        @method('DELETE')
        @csrf
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">{{__('Suppression')}}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <h6 class="text-center">{{__('Vous voulez vraiment supprimer ')}} <span id="element-titre"></span>
                        de la liste ?</h6>
                    <input type="hidden" id="element-a-suppr" name="element-a-suppr-id" value="">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                    <button type="submit" class="btn btn-danger">{{__('Confirmer la suppression')}}</button>
                </div>
            </div>
        </div>
    </form>
</div>