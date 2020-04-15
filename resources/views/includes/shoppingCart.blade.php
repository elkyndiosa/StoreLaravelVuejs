<div class="modal fade" id="shoppingCart">

    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="title">Products in shoping cart</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body py-0" v-if='cantCart != 0'>
                <div class="row my-1 py-1 border-bottom font-weight-bold text-center "  >
                    <div class="col-4 "> <p class="m-0">Name</p></div>
                    <div class="d-none d-md-block col-lg-2"> <p class="m-0">Image</p></div>
                    <div class="col-1"> <p class="m-0">Qty</p></div>
                    <div class="col-2"> <p class="m-0">Price</p></div>
                    <div class="col-2"> <p class="m-0">Cost</p></div>
                    <div class="col-1"></div>
                </div>
                <div class="row my-1 py-3 border-bottom" v-for='prod in cartProducts' v-if='cartProducts'>
                    <div class="col-4 d-flex align-items-center">@{{prod.name }} <p></p></div>
                    <div class="d-none d-md-block col-2"> <img class="w-100 " :src="getImage(prod.image_path)"></div>
                    <div class="col-1 ">
                        <button class="d-block text-center btn p-0 mx-auto" 
                                v-on:click="increase(prod.id)">
                            <i class="fas fa-caret-up mx-auto"></i>
                        </button>
                        <p class="text-center m-0">@{{prod.quantity }}</p>
                        <button class="d-block text-center btn p-0 mx-auto"
                                v-on:click="decrease(prod.id)">
                            <i class="fas fa-caret-down mx-auto"></i>
                        </button>
                    </div>
                    <div class="col-2 d-flex align-items-center justify-content-center">
                        <p class="text-center m-0">$ @{{prod.price }}.00</p>
                    </div>
                    <div class="col-2 d-flex align-items-center justify-content-center">
                        <p class="text-center m-0">$ @{{prod.price * prod.quantity}}.00</p>
                    </div>
                    <div class="col-1 d-flex justify-content-center align-items-center">
                        <a href="#" class="btn" v-on:click.prevent="deleteOfCart(prod.id)"><i class="fas fa-trash"></i></a>
                    </div>
                </div>
                <div class="row my-1 py-1 font-weight-bold text-right"  >
                    <div class="col-6"></div>
                    <div class="col-3"> <p class="m-0 ">IVA: </p></div>
                    <div class="col-3"> <p class="m-0"> $ @{{iva}}</p></div>
                </div>
                <div class="row my-1 py-1 font-weight-bold text-right"  >
                    <div class="col-6"></div>
                    <div class="col-3"> <p class="m-0">Total: </p></div>
                    <div class="col-3"> <p class="m-0">$ @{{total}}</p></div>
                </div>
            </div>
            <h4 v-if='cantCart == 0' class="p-5 text-center">Cart is empty</h4>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <a type="button" class="btn btn-primary " role="button" 
                   :class="cantCart < 1 ? 'disabled' : ''"
                   v-on:click='makePurchase'>
                   Make a purchase
            </a>
        </div>

    </div>
</div>
</div>
