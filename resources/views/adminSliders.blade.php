@extends('layouts.app')

@section('content')
<div id="adminSliders">
    <div class="container-fluid my-5" >
        <h2>Administration of sliders</h2>
        <div class="row">
            <div class="col-12">
                <button type="button" class="btn btn-success my-3 " data-toggle="modal" data-target="#created" v-on:click="restarThumb()">New Image</button>
            </div>
        </div>
        <div class="row d-flex justify-content-around">
            <div class="slider-admin col-5 p-0" v-for=" slider in sliders ">
                <img v-bind:src="getImage(slider.image_path)" alt="" class="my-3">
                <h4 class="w-100 text-center title " v-bind:class="slider.color">@{{slider.title }}</h4>
                <p class="w-100 text-center text m-0" v-bind:class="slider.color"> @{{slider.text }}</p>
                <a href="#" v-on:click.prevent="editSlider(slider)" class="btn btn-info btn-sm option"><i class="fas fa-edit"></i></a>
                <a href="#" v-on:click.prevent='deleteSlider(slider.id)' class="btn btn-danger btn-sm option2" > <i class="fas fa-trash"></i></a>
            </div>
        </div>



    </div>
    @include('includes.createSlider');
    @include('includes.updateSlider');
</div>


@endsection
@section('script')
<script src="{{ asset('js/app-vue-sliders.js') }}"></script>
@endsection
