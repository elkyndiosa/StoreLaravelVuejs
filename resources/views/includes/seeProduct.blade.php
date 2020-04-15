<div class="modal fade" id="seeProduct">

    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="title"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <img class="img-fluid" v-bind:src="getImage(fillModalProd.image_path)" alt="">
                <hr>
                <div>
                    <p id="description"></p>
                    <h5>$ <span id="price"></span>.00</h5>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" v-on:click="addCart(fillModalProd)">Add to cart</button>
            </div>

        </div>
    </div>
</div>
