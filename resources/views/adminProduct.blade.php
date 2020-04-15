@extends('layouts.app')

@section('content')
<div id="adminProduct" >
    <div class="container-fluid my-5" >
        <h2>Products</h2>
        <button type="button" class="btn btn-success my-3" data-toggle="modal" data-target="#created" v-on:click="restartThumb">New product</button>
        <input type="text" placeholder="Buscar" class="form-control" >
        <table class="table table-striped table-dark table-hover">
            <thead>
                <tr>
                    <th scope="col">Name</th>
                    <th scope="col">Description</th>
                    <th scope="col" >Price</th>
                    <th scope="col">Status</th>

                    <th scope="col" colspan="1">
                        &nbsp;
                    </th>
                </tr>
            </thead>
            <tbody >
                <tr v-for="product in products">
                    <td> @{{ product.name }} </td>
                    <td> @{{ product.description }} </td>
                    <td> @{{ product.price }} </td>
                    <td > @{{ product.status }} </td>

                    <td width="15%"> 
                        <a href="#" v-on:click.prevent="editProduct(product)" class="btn btn-info btn-sm"><i class="fas fa-edit"></i></a>
                        <a href="#" v-on:click.prevent='deleteProduct(product.id)' class="btn btn-danger btn-sm" > <i class="fas fa-trash"></i></a>

                    </td>
                </tr>
            </tbody>
        </table>

        @include('includes.pagination')
        @include('includes.createProduct')
        @include('includes.updateProduct')

    </div>
</div>


@endsection
@section('script')
    <script src="{{ asset('js/app-vue-products.js') }}"></script>
@endsection
