<div class="modal fade" id="adress">

    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">My adress</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
<!--                <p class="bg-danger text-light p-2 text-center" v-if='error'> 
                    @{{ error }}
                </p>-->
                <form method="POST" action="{{route('adress.create')}}">
                    @csrf
                    <div class="form-group row">
                        <label for="municipality" class="col-md-4 col-form-label text-md-right" >Municipality</label>
                        <div class="col-md-6">
                            <input id="municipality" type="text" class="form-control" name="municipality" required autocomplete="municipality" autofocus required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="neighborhood" class="col-md-4 col-form-label text-md-right">Neighborhood</label>

                        <div class="col-md-6">
                            <input id="neighborhood" type="text" class="form-control" name="neighborhood" required >
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="adress" class="col-md-4 col-form-label text-md-right">Adress</label>

                        <div class="col-md-6">
                            <input id="adress" type="text" class="form-control" name="adress" required >
                        </div>
                    </div>
                    <div class="form-group row mb-0">
                        <div class="col-md-6 offset-md-4">
                            <button type="submit" class="btn btn-primary">
                                Add
                            </button>
                        </div>
                    </div>
                </form>

            </div>

        </div>
    </div>
</div>