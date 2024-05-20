<div id="carouselExampleAutoplaying" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-indicators">
      <button type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
      <button type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide-to="1" aria-label="Slide 2"></button>
      {{-- <button type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide-to="2" aria-label="Slide 3"></button> --}}
    </div>
    <div class="carousel-inner">
      <div class="carousel-item active" data-bs-interval="3000">
        <img src="{{ URL::asset('image/banner-1.jpg') }}" class="d-block w-100 carousel-image" alt="...">
      </div>
      <div class="carousel-item" data-bs-interval="3000">
        <img src="{{ URL::asset('image/banner-2.jpg') }}" class="d-block w-100 carousel-image" alt="...">
      </div>
    </div>
    <button class="carousel-control-prev custom_prev" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="prev">
      <span><i class="fa-solid fa-chevron-left"></i></span>
      <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next custom_next" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="next">
      <span><i class="fa-solid fa-chevron-right"></i></span>
      <span class="visually-hidden">Next</span>
    </button>
  </div>