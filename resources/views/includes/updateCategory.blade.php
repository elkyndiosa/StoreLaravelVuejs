<div class="modal fade" id="updateCategory">

    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Update categories</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <p class="bg-danger text-light p-2 text-center" v-if="errors.p && errors.s"> 
                    @{{ errors.p }}
                    <span> @{{ errors.s }} </span>
                </p>
                <form method="post" v-on:submit.prevent='update' enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" name="name" class="form-control" v-model="fillCategory.name" value="fillProduct.name" required>
                    </div>

                    <div class="form-group">
                        <label for="image">Change image</label>
                        <input type="file" v-on:change='getImageForShow' class="form-control-file" id="file" name="image" required>
                    </div>
                    <div class="cont-img-update my-2 rounded">
                        <img v-if='showImg' v-bind:src='getImage(fillCategory.image_path)' id="img-show" alt="" required>
                        
                        <img v-if='thumbImage' :src="image" alt="" >
                    </div>

                    <button type="submit" class="btn btn-primary" >Update </button>
                </form>

            </div>

        </div>
    </div>
</div>
