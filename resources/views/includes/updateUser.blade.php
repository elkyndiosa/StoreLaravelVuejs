<div class="modal fade" id="updateUser">

    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Update user</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
<!--                <p class="bg-danger text-light p-2 text-center" v-if='error'> 
                    @{{ error }}
                </p>-->
                <form method="post" action="{{ route('user.update') }}" >
                    @csrf
                    <input type="hidden" name="id" value="{{ $currentUser->id }}">
                    <div class="form-group row">
                        <label for="name" class="col-md-4 col-form-label text-md-right" >Name</label>
                        <div class="col-md-6">
                            <input id="name" type="text" class="form-control" name="name" required autocomplete="name" autofocus value="{{$currentUser->name}}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="phone" class="col-md-4 col-form-label text-md-right" >Phone</label>

                        <div class="col-md-6">
                            <input id="phone" type="text" class="form-control" name="phone" required autocomplete="phone" value="{{$currentUser->phone}}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                        <div class="col-md-6">
                            <input id="email" type="email" class="form-control" name="email" required autocomplete="email" value="{{$currentUser->email}}">
                        </div>
                    </div>
                    @if($adress)
                    <hr>
                    
                    <div class="form-group row">
                        <label for="municipality" class="col-md-4 col-form-label text-md-right" >Municipality</label>
                        <div class="col-md-6">
                            <input id="municipality" type="text" class="form-control" name="municipality" required autocomplete="municipality" autofocus value="{{$adress->municipality}}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="neighborhood" class="col-md-4 col-form-label text-md-right">Neighborhood</label>

                        <div class="col-md-6">
                            <input id="neighborhood" type="text" class="form-control" name="neighborhood" required value="{{$adress->neighborhood}}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="adress" class="col-md-4 col-form-label text-md-right">Adress</label>

                        <div class="col-md-6">
                            <input id="adress" type="text" class="form-control" name="adress" required value="{{$adress->address}}">
                        </div>
                    </div>
                    @endif
                    <div class="form-group row mb-0">
                        <div class="col-md-6 offset-md-4">
                            <button type="submit" class="btn btn-primary">
                                Update
                            </button>
                        </div>
                    </div>
                </form>

            </div>

        </div>
    </div>
</div>