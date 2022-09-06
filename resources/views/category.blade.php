{{-- Relative dari folder views, lalu ketikkan layouts.main atau bisa juga layouts/main --}}
@extends('layouts.main')

{{-- Mengambil dari section 'container' di layouts/main.blade.php --}}
@section('container')
    
    <div class="container">
        <h1 class="my-4" style="color: #99A799">Materials for: {{ $category }}</h1>
        <hr>
        {{-- Jika jumlah Material kurang dari 1, tampilkan pesan di bawah --}}
        @if ($count < 1)
            <p class="text-center fs-4" style="color: #99A799">No material found.</p>
        @endif
    </div>

    {{-- All Materials by Category --}}
    <div class="container">
        <div class="row">
            @foreach ($materials as $material)
            <div class="col-md-4 my-2">
                <div class="card">
                    {{-- Category Label --}}
                    <div class="position-absolute px-3 py-2 text-white rounded-3" style="background-color: rgba(0, 0, 0, 0.5)"><a href="/categories/{{ $material->category->id }}" class="text-decoration-none text-white"><i class="bi bi-tag"></i> &nbsp; {{ $material->category->name }}</a></div>
                    <img src="/img/pdf_img.jpg" class="card-img-top" alt="Alt Image">
                    <div class="card-body">
                        <h4 class="card-title fw-bold" style="color: #99A799">{{ $material->short_title }}</h4>
                        <small class="text-muted">
                            <h5><i class="bi bi-person-circle"></i> &nbsp; <a href="/teachers/{{ $material->teacher->username }}" class="text-decoration-none" style="color: #ADC2A9">{{ $material->teacher->name }}</a></h5>
                            <p class="card-text"><i class="bi bi-clock"></i> &nbsp; Published at {{ $material->created_at->diffForHumans() }}</small></p>
                            </small>
                        <p class="card-text">{{ $material->excerpt }}</p>
                        <a href="/materials/{{ $material->id }}" class="btn btn-primary" style="background-color: #99A799; border-color: #FEF5ED">Read More</a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    {{-- End of All Materials by Category --}}

@endsection