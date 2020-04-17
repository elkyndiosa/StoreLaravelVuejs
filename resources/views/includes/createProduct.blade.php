<div class="modal fade" id="created">

    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Create product</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form  v-on:submit.prevent="createProduct" enctype="multipart/form-data">
                    @csrf
                   
                    <div class="form-group">
                        <label for="category">Select category</label>
                        <select class="form-control" id="category" name="category" v-model="newProduct.category">   
                            <option class="" selected disabled="">Selected...</option>
                            <option v-for='cat in category' v-bind:value='cat.id'> @{{ cat.name }} </option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" name="name" id="name" class="form-control" v-model="newProduct.name" required>
                    </div>
                    <p class="bg-danger text-light text-center  mb-3 p-1 rounded-pill" role="alert" v-if="errors.name ">
                        <strong class="w-100">@{{errors.name[0]}}</strong>
                    </p>
                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea name="description" id="description" class="form-control" v-model="newProduct.description" required></textarea>
                    </div>
                    <p class="bg-danger text-light text-center  mb-3 p-1 rounded-pill" role="alert" v-if="errors.description">
                        <strong class="w-100">@{{errors.description[0]}}</strong>
                    </p>
                    <div class="form-group">
                        <label for="stock">Stock</label>
                        <input type="number" name="stock" class="form-control" v-model="newProduct.stock" required>
                    </div>
                    <p class="bg-danger text-light text-center  mb-3 p-1 rounded-pill" role="alert" v-if="errors.stock">
                        <strong class="w-100">@{{errors.stock[0]}}</strong>
                    </p>
                    <div class="form-group">
                        <label for="price">Price</label>
                        <input type="number" name="price"  class="form-control" v-model="newProduct.price" required>
                    </div>
                    <p class="bg-danger text-light text-center  mb-3 p-1 rounded-pill" role="alert" v-if="errors.price">
                        <strong class="w-100">@{{errors.price[0]}}</strong>
                    </p>
                    <div class="form-group">
                        <label for="image">Add image</label>
                        <input type="file" class="form-control-file" v-on:change="getImage" name="image" required>
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
