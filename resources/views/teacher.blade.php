{{-- Relative dari folder views, lalu ketikkan layouts.main atau bisa juga layouts/main --}}
@extends('layouts.main')

{{-- Mengambil dari section 'container' di layouts/main.blade.php --}}
@section('container')

    {{-- Teacher Profile --}}
    <div class="row border border-3 p-3" style="background-color: #F8F8F8">
        <div class="col-7 d-flex justify-content-center align-items-center">
            <div class="row align-items-center">
                <div class="col">
                    {{-- Jika teacher punya Profile Picture --}}
                    @if($teacher->image)
                          <img src="{{ asset('storage/' . $teacher->image) }}" class="img-fluid rounded-circle" alt="{{ $teacher->name }}" width="300">
                        @else
                        {{-- Jika tidak, sesuaikan dengan Gender Teacher --}}
                          @if ($teacher->gender === "Male")
                              <img src="/img/male_icon.png" class="img-fluid rounded-circle" alt="{{ $teacher->name }}" width="300">
                          @else
                              <img src="/img/female_icon.png" class="img-fluid rounded-circle" alt="{{ $teacher->name }}" width="300">
                          @endif
                        @endif
                </div>
                <div class="col">
                    <h2>{{ $teacher->name }}</h2>
                    <h5><i class="bi bi-person-circle"></i> &nbsp; {{ $teacher->username }}</h4>
                    @if ($teacher->gender === "Male")
                        <h5><i class="bi bi-gender-male"></i> &nbsp; {{ $teacher->gender }}</h4>
                    @else
                        <h5><i class="bi bi-gender-female"></i> &nbsp; {{ $teacher->gender }}</h5>
                    @endif
                    <h5><i class="bi bi-filetype-pdf"></i></i> &nbsp; {{ $count }} 
                        @if($count > 1)
                            Materials
                        @else
                            Material
                        @endif
                    </h5>
                </div>
            </div>
        </div>
    </div>
    {{-- End of Teacher Profile --}}


    {{-- All Materials by Teacher --}}
    <div class="container mt-5">
        <h2 class="fw-bold" style="color: #99A799">Materials</h2>
        <hr>
        @if ($count < 1)
            <p class="text-center fs-4" style="color: #99A799">No material found.</p>
        @endif
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
                            <h5><i class="bi bi-person-circle"></i> &nbsp; <a href="/teachers/{{ $material->teacher->username }}" class="text-decoration-none" style="color: #ADC2A9">{{ $teacher->name }}</a></h5>
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
    {{-- End of All Materials by Teacher --}}

@endsection