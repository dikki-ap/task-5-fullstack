{{-- Relative dari folder views, lalu ketikkan layouts.main atau bisa juga layouts/main --}}
@extends('layouts.main')

{{-- Mengambil dari sectiont 'container' di layouts/home.blade.php --}}
@section('container')

<div class="container">
    <div class="row justify-content-center mb-5">
        <div class="col-md-8">
            <h2 class="mb-3" style="color: #99A799">{{ $material->title }}</h2>
            <h5><i class="bi bi-person-circle"></i> &nbsp; <a href="/teachers/{{ $material->teacher->username }}" class="text-decoration-none" style="color: #ADC2A9">{{ $material->teacher->name }}</a></h5>
            <p><i class="bi bi-tag"></i> &nbsp; <a href="/categories/{{ $material->category->id }}" class="text-decoration-none text-muted">{{ $material->category->name }}</a></p>
            <p class="text-muted"><i class="bi bi-clock"></i> &nbsp; Published at {{ $material->created_at->diffForHumans() }}</p>
            <hr>

            {{-- Swiper Galleries --}}
            <div class="swiper text-center">
                <!-- Additional required wrapper -->
                <div class="swiper-wrapper">
                <!-- Slides -->
                @foreach ($images as $image)
                <div class="swiper-slide">
                    <img src="{{ asset('storage/' . $image->url) }}" alt="{{ $image->url }}" alt="{{ $image->url }}" class="img-fluid rounded-3 mb-5" width="700">
                </div>
                @endforeach
                

                </div>
                <!-- If we need pagination -->
                <div class="swiper-pagination"></div>
            
                <!-- If we need navigation buttons -->
                <div class="swiper-button-prev" style="color: #99A799"></div>
                <div class="swiper-button-next" style="color: #99A799"></div>
            </div>
            {{-- End of Swiper Galleries --}}

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
            {{-- Cek jika user sudah login atau tidak, jika sudah tampilkan file PDF --}}
            @if (Auth::guard('admin')->check() || Auth::guard('teacher')->check() || Auth::guard('student')->check())
                <embed type="application/pdf" src="{{ asset('storage/' . $material->filename) }}" width="100%" height="600"></embed>
            {{-- Jika user belum login, tampilkan pesan di bawah --}}
            @else
                <p>File can be displayed if already logged in.</p>
            @endif

            <a href="/dashboard/materials" class="btn btn-primary border-0" style="background-color: #99A799; border-color: #FEF5ED"><span data-feather="chevrons-left"></span>&nbsp; Back to Material List</a>
        </div>
    </div>
</div>

@endsection