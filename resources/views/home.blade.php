@extends('layouts.app')
@extends('includes.slider')

@section('content')

<div class="container-fluid  mb-5" id="">


    <div class="row justify-content-center my-3">
        <div class="col-12 d-flex justify-content-center flex-wrap bg-light p-4">
            <input type="text" placeholder="Buscar" class="form-control col-8 col-md-4" v-model="search" v-on:keyup="searchGet">
            <a href="#" class="btn btn-primary ml-1 col-8 col-sm-3 mt-1 mt-sm-0"  v-on:click.prevent="getProducts"  v-if="current_category">See all products</a>
        </div>
        <div class="d-flex justify-content-center flex-wrap mt-3">
            <div class="col-5 col-sm-3 mt-1 d-flex align-content-center justify-content-center btn badge-info mx-1" style="height: 60px; width: 60px;"  v-for="cat in category" v-on:click.prevent="getProductsByCategory(cat, 1)">
                <p class="font-weight-bold " style="margin: auto;">@{{cat.name}}</p>
            </div>
        </div>
        <h3 class="my-2 text-center w-100" ref="titleHome">Products</h3>
        <hr >
        <div class="p-5" style="height: 350px;" v-if="products.length == 0">
            <h5>There are no products in this search</h5>
        </div>
        <div class=" col-12 col-sm-6 col-md-4 col-lg-3 mt-5" style="min-height: 250px;" v-for='product in products' >
            <div class="card col-12 p-0" >
                <div class="cont-img-card">
                    <img class="card-img-top" v-bind:src='getImage(product.image_path)' alt="Card image">   
                </div>

                <div class="card-body text-center">
                    <h5 class="card-title col-12">@{{ product.name }} </h5>
                    <p class="card-text col-12">@{{ product.description }} </p>
                    <p class="card-text col-12">Stock: @{{ product.stock }} </p>
                    <p class="card-text col-12">$ @{{ product.price }} </p>
                    <a href="#" v-on:click.prevent="getDataProduct(product)" data-toggle="modal" data-target="#seeProduct" v-bind:data-name="product.name" v-bind:data-price="product.price" v-bind:data-description="product.description" class="btn btn-primary col-12" >See article </a>
                </div>
            </div>

        </div>
    </div>
    @include('includes.pagination')
    @include('includes.seeProduct')
    @include('includes.shoppingCart')
    @include('includes.shoppingHistory')
    @include('includes.orderDetails')


</div>
@section('script')
<script src="{{ asset('js/app-vue-home.js') }}"></script>

@endsection

@endsection
