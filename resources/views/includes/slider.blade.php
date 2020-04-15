
<div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
    <div class="carousel-inner">

        <?php $int = 0 ?> 
        @foreach($sliders as $image)
        <div class="carousel-item slider {{ $int == 0 ? 'active' : ''}}">
            <img class="d-block" src=" http://localhost/Delivery/storage/app/{{ $image->image_path}} " >
            <div class="carousel-caption d-none d-md-block {{$image->color}}">
                <h1>{{ $image->title }}</h1>
                <h6>{{ $image->text }}</h6>
            </div>
        </div>
        <?php $int = 1 ?> 
        @endforeach
    </div>
    <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
    </a>
</div>
