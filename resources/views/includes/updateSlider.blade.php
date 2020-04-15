<div class="modal fade" id="update">

    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Create slider</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p class="bg-danger text-light p-2 text-center" v-if='errors.p && errors.s' > 
                    @{{errors.p}}
                    <span> @{{ errors.s }} </span>
                </p>
                <form method="post" v-on:submit.prevent='uploadSlider' enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="name">Title</label>
                        <input type="text" name="title" id="title" class="form-control" v-model='fillSlider.title'>
                    </div>
                    <div class="form-group">
                        <label for="text">Text</label>
                        <input type="text" name="text" id="text" class="form-control" v-model='fillSlider.text'>
                    </div>
                    <div class="form-group">
                        <label for="text">Select color of text: </label>
                        <select id="color" v-model='fillSlider.color'>
                            <option value="text-dark" class="bg-dark">Dark</option>
                            <option value="text-primary" class="bg-primary p-2">Blue</option>
                            <option value="text-secondary" class="bg-secondary p-2">Gray</option>
                            <option value="text-white" class="bg-white p-2">white</option>
                            <option value="text-danger" class="bg-danger p-2">Red</option>
                            <option value="text-warning" class="bg-warning p-2">Yellow</option>
                            <option value="text-info" class="bg-info p-2">Light blue</option>

                        </select>
                    </div>
                    <div class="form-group">
                        <label for="image">Add image</label>
                        <input type="file" v-on:change='getImageForShow' class="form-control-file"  name="image" id="inputImageUpdate">
                    </div>
                    <div class="cont-img-update my-2 rounded" >
                       
                        <img v-if='fillSlider.image_path' v-bind:src='getImage(fillSlider.image_path)' alt="" id='img-show'>
                        <img :src="image" alt="" id="image-update">
                    </div>
                    <button type="submit" class="btn btn-primary" >Save</button>
                </form>

            </div>

        </div>
    </div>
</div>
