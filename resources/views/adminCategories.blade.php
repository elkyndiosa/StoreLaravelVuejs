@extends('layouts.app')

@section('content')
<div id="adminCategories">
    <div class="container-fluid my-5" >
        <h2>Categories</h2>
        <button type="button" class="btn btn-success my-3" data-toggle="modal" data-target="#created">New category</button>
        <input type="text" placeholder="Buscar" class="form-control" >
        <table class="table table-striped table-dark table-hover">
            <thead>
                <tr>
                    <th scope="col">Name</th>
                    <th scope="col">Image</th>
                    <th scope="col" colspan="1">
                        &nbsp;
                    </th>
                </tr>
            </thead>
            <tbody >
                <tr v-for='category in categories'>
                    <td> @{{ category.name }} </td>
                    <td >
                        <div class="img-categories1">
                            <img v-bind:src="getImage(category.image_path)" alt="">
                        </div>
                    </td>

                    <td width="15%"> 
                        <a href="#" v-on:click.prevent="editCategory(category)" class="btn btn-info btn-sm"><i class="fas fa-edit"></i></a>
                        <a href="#" v-on:click.prevent="deleteCategory(category.id)" class="btn btn-danger btn-sm" > <i class="fas fa-trash"></i></a>

                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    @include('includes.updateCategory')
    @include('includes.createCategory')
</div>


@endsection
@section('script')
    <script src="{{ asset('js/app-vue-categories.js') }}"></script>
@endsection
