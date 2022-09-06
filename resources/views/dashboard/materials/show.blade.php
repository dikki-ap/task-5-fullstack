@extends('dashboard.layouts.main')

@section('container')

    <div class="row my-5" style="color: #99A799">
        <div class="col">
            <h1 class="fw-bold">Material Details</h1>
        </div>
    </div>

    <div class="container">
        <div class="row justify-content-center mb-5">
            <div class="col">
                <h2 class="mb-3" style="color: #99A799">{{ $material->title }}</h2>
                <h5><i class="bi bi-person-circle"></i> &nbsp; <a href="/teachers/{{ $material->teacher->username }}" class="text-decoration-none" style="color: #ADC2A9">{{ $material->teacher->name }}</a></h5>
                <p><i class="bi bi-tag"></i> &nbsp; <a href="/categories/{{ $material->category->slug }}" class="text-decoration-none text-muted">{{ $material->category->name }}</a></p>
                <p class="text-muted"><i class="bi bi-clock"></i> &nbsp; Published at {{ $material->created_at->diffForHumans() }}</p>
                <hr>
    
                <div class="swiper text-center">
                    <!-- Additional required wrapper -->
                    <div class="swiper-wrapper">
                    <!-- Slides -->
                    @foreach ($images as $image)
                    <div class="swiper-slide">
                        <img src="{{ asset('storage/' . $image->url) }}" alt="{{ $image->url }}" class="img-fluid rounded-3 mb-5" width="700">
                    </div>
                    @endforeach
  
                    </div>
                    <!-- If we need pagination -->
                    <div class="swiper-pagination"></div>
                
                    <!-- If we need navigation buttons -->
                    <div class="swiper-button-prev" style="color: #99A799"></div>
                    <div class="swiper-button-next" style="color: #99A799"></div>
                </div>

                <hr>

                <h4 class="mb-3" style="color: #99A799">Description</h4>
    
                {{-- Menggunakan >> {!!  !!} Dikarenakan bisa saja di dalam artikel terdapat TAG HTML --}}
                {{-- Menggunakan >> {{  }} terdapat htmlspesialchars() untuk menghindari penggunaan TAG HTML di dalamnya --}}
                {{-- SESUAIKAN DENGAN KONDISI --}}
                <article class="my-3 fs-5">
                    <p>{!! $material->description !!}</p>
                </article>

                <hr>
                <h4 class="mb-3" style="color: #99A799">Display File</h4>
                <embed type="application/pdf" src="{{ asset('storage/' . $material->filename) }}" width="100%" height="600"></embed>

                <a href="/dashboard/materials" class="btn btn-primary border-0 mt-3" style="background-color: #99A799; border-color: #FEF5ED"><span data-feather="chevrons-left"></span>&nbsp; Back to Material List</a>
            </div>
        </div>
    </div>
@endsection