<div class="modal fade" id="orderDetails">

    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="title">Details of order</h5>
                <button type="button"  v-on:click="prevModal" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body py-0">
                <div class="row my-1 py-1 border-bottom font-weight-bold text-center"  >
                    <div class="col-4"> <p class="m-0">Name</p></div>
                    <div class="col-2"> <p class="m-0">Image</p></div>
                    <div class="col-1"> <p class="m-0">Qty</p></div>
                    <div class="col-2"> <p class="m-0">Price</p></div>
                    <div class="col-2"> <p class="m-0">Cost</p></div>
                </div>
                <div class="row my-1 py-3 border-bottom" v-for='prod in orderDetails' v-if='orderDetails'>
                    <div class="col-4 d-flex align-items-center">@{{prod.name }} <p></p></div>
                    <div class="col-2"> <img class="w-100 " :src="getImage(prod.image_path)"></div>
                    <div class="col-1 ">
                        <p class="text-center m-0">@{{prod.quantity }}</p>

                    </div>
                    <div class="col-2 d-flex align-items-center justify-content-center">
                        <p class="text-center m-0">$ @{{prod.price }}.00</p>
                    </div>
                    <div class="col-2 d-flex align-items-center justify-content-center">
                        <p class="text-center m-0">$ @{{prod.price * prod.quantity}}.00</p>
                    </div>
                </div>
                <div class="row my-1 py-1 font-weight-bold text-right"  >
                    <div class="col-6"></div>
                    <div class="col-3"> <p class="m-0 ">IVA: </p></div>
                    <div class="col-3"> <p class="m-0"> $ @{{total * 0.19}}0</p></div>
                </div>
                <div class="row my-1 py-1 font-weight-bold text-right"  >
                    <div class="col-6"></div>
                    <div class="col-3"> <p class="m-0">Total: </p></div>
                    <div class="col-3"> <p class="m-0">$ @{{total}}.00</p></div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" v-on:click="prevModal" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>

    </div>
</div>
