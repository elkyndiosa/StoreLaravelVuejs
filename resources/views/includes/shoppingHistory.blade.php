<div class="modal fade" id="historyShopping">

    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="title">My shopping history</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body py-0" v-if="shoppingHistory.length != 0">
                <div class="row text-center font-weight-bold border-bottom py-1" >
                    <div class="col-1"> <p class="m-0">ID</p></div>
                    <div class="col-2"> <p class="m-0">Cost</p></div>
                    <div class="col-4"> <p class="m-0">Status</p></div>
                    <div class="col-3"> <p class="m-0">Date</p></div>
                    <div class="col-1"></div>                   
                </div>
                <div class="row text-center py-1 border-bottom" v-for="shopping in shoppingHistory">
                    <div class="col-1"> <p class="m-0">@{{shopping.id}}</p></div>
                    <div class="col-2"> <p class="m-0">@{{shopping.cost}}</p></div>

                    <div class="col-4" v-if="optionStatus == false"> 
                        <p class="m-0">@{{shopping.status}}</p>
                    </div>

                    <div class="col-4" v-if="optionStatus == true"> 
                        <select class="form-control select" v-on:change='changeStatus(shopping.id)'>
                            <option 
                                v-bind:selected="shopping.status == 'verifying' ? 'selected' : ''" 
                                value="verifying">Verifying
                            </option>
                            <option 
                                v-bind:selected="shopping.status == 'in process'  ? 'selected' : ''"
                                value="in process">In process
                            </option>
                            <option 
                                v-bind:selected="shopping.status == 'sending'  ? 'selected' : ''"
                                value="sending">Sending
                            </option>
                            <option 
                                v-bind:selected="shopping.status == 'deliverid'  ? 'selected' : ''"
                                value="deliverid">Deliverid
                            </option>

                        </select>
                    </div>

                    <div class="col-3"> <p class="m-0">@{{shopping.newDate}}</p></div>
                    <div class="col-1 d-flex justify-content-center"> 
                        <a href="#" class="btn" style="font-size: 28px;" v-on:click.prevent="showDetailsOrder(shopping)">
                            <i class="fas fa-info-circle"></i> 
                        </a>
                    </div>                   
                </div>

            </div>
            <h4 v-if="shoppingHistory.length == 0" class="text-center p-5">You have not placed any previous order</h4>
        </div>
    </div>
</div>
