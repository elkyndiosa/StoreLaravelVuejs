<div class="modal fade" id="update">

    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Update product</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <p class="bg-danger text-light p-2 text-center" v-if="errors.p && errors.s"> 
                    @{{ errors.p }}
                    <span> @{{ errors.s }} </span>
                </p>
                <form  v-on:submit.prevent="updateProduct()" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" name="name" class="form-control" v-model="fillProduct.name" value="fillProduct.name" required>
                    </div>
                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea name="description" class="form-control" v-model="fillProduct.description" required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="price">Price</label>
                        <input type="number" name="price" class="form-control" v-model="fillProduct.price" required>
                    </div>
                    <div class="form-group">
                        <label for="image">Change image</label>
                        <input type="file" class="form-control-file" v-on:change="getImage" id="file" name="image">
                    </div>
                    <div class="cont-img-update my-2 rounded">
                        <img v-bind:src='image_path' id="img-show" alt="" >
                        <img :src="image" alt="" >
                    </div>

                    <button type="submit" class="btn btn-primary" >Update </button>
                </form>

            </div>

        </div>
    </div>
</div>
