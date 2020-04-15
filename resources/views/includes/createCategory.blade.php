<div class="modal fade" id="created">

    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Create Category</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p class="bg-danger text-light p-2 text-center" v-if='errors.p && errors.s' > 
                    @{{ errors.p }}
                    <span> @{{ errors.s }} </span>
                </p>
                <form method="post" v-on:submit.prevent='createCategory' enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" name="name" id="name" class="form-control" v-model='nameCategory' required>
                    </div>

                    <div class="form-group">
                        <label for="image">Add image</label>
                        <input type="file" v-on:change='getImageForShow' class="form-control-file"  name="image" required>
                    </div>
                    <div class="cont-img-update my-2 rounded" v-if="thumbImage">
                        <img :src="image" alt="" >
                    </div>
                    <button type="submit" class="btn btn-primary" >Save</button>
                </form>

            </div>

        </div>
    </div>
</div>
