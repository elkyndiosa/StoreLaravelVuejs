@extends('layouts.app')
@extends('includes.slider')

@section('content')


<div class="container-fluid  mb-5" id="user">

    <div class="row justify-content-center mt-1" style="">
        <div class="col-12">
            <h3 class="my-5 text-center">My data and address</h3>
            <a href="#" data-toggle="modal" data-target="#updateUser" class="btn btn-outline-info btn-sm option"><i class="fas fa-edit"></i></a>
        </div>

        <hr>
        <div class="col-8 text-center">
            <h5 class="text-center">Personal information</h5>
            <hr>
            <p> <span class="font-weight-bold w-100">Name: </span>{{$currentUser->name}}</p>
            <p> <span class="font-weight-bold w-100">Email: </span>{{$currentUser->email}}</p>
            <p> <span class="font-weight-bold w-100">Phone: </span>{{$currentUser->phone}}</p>
            <p> <span class="font-weight-bold w-100">Registration date: </span>{{$currentUser->created_at}}</p>
            <h5 class="text-center mt-5">Adress</h5>
            <hr>
            @if($adress)
                <p> <span class="font-weight-bold w-100">Municipality: </span>{{$adress->municipality}}</p>
                <p> <span class="font-weight-bold w-100">Neighborhood: </span>{{$adress->neighborhood}}</p>
                <p> <span class="font-weight-bold w-100">Adress: </span>{{$adress->address}}</p>
            @else
                <p>
                    You have not entered your address. You must enter it to be able to make purchases.
                    <a href="#" data-toggle="modal" data-target="#adress">click here to register address</a>
                </p>
            @endif
        </div>
    </div>

    @include('includes.updateUser')
    @include('includes.adress')

</div>
@endsection
