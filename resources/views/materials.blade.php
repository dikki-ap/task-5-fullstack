{{-- Relative dari folder views, lalu ketikkan layouts.main atau bisa juga layouts/main --}}
@extends('layouts.main')

{{-- Mengambil dari section 'container' di layouts/main.blade.php --}}
@section('container')
    <h1 class="my-3 text-center" style="color: #99A799">All Materials</h1>

    {{-- Searching --}}
    {{-- <div class="container">
        <div class="row justify-content-center my-4">
            <div class="col-md-6"> --}}

                {{-- Method Default adalah GET --}}
                {{-- Form untuk Searching Keyword --}}
                {{-- <form action="/materials"> --}}
    
                    {{-- @if (request('category'))
                    <input type="hidden" name="category" value="{{ request('category') }}">
                    @endif
    
                    @if (request('teacher'))
                    <input type="hidden" name="teacher" value="{{ request('teacher') }}">
                    @endif --}}
                    
                    {{-- <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="Search.." name="keyword" value="{{ request('keyword') }}" autocomplete="off">
                        <button class="btn btn-success" type="submit" style="background-color: #99A799; border-color: #FEF5ED">Search</button>
                      </div>
                </form> --}}
                {{-- End of Form --}}
            {{-- </div>
        </div>
    </div> --}}
    {{-- End of Searching --}}

    {{-- Pagination --}}
    <div class="container">
        <div class="d-flex justify-content-start">
            {{ $materials->links( ) }}
        </div>
    </div>
    {{-- End of Pagination --}}

    {{-- Kondisi jika Jumlah Materials lebih dari 0 --}}
    @if($materials->count())
        {{-- Header Material --}}
        <div class="container">
            <div class="card text-center p-3 mb-5">
                {{-- Category Label --}}
                <div class="position-absolute px-3 py-2 text-white rounded-3" style="background-color: rgba(0, 0, 0, 0.5)"><a href="/categories/{{ $materials[0]->category->id }}" class="text-decoration-none text-white"><i class="bi bi-tag"></i> &nbsp; {{ $materials[0]->category->name }}</a></div>
                
                <img src="/img/pdf_img.jpg" class="img-fluid" alt="#">
                <div class="card-body">
                    <h4 class="card-title fw-bold" style="color: #99A799">{{ $materials[0]->title }}</h4>
                    <small class="text-muted">
                        <h5><i class="bi bi-person-circle"></i> &nbsp; <a href="/teachers/{{ $materials[0]->teacher->username }}" class="text-decoration-none" style="color: #ADC2A9">{{ $materials[0]->teacher->name }}</a></h5>
                        <p class="card-text"><i class="bi bi-clock"></i> &nbsp; Published at {{ $materials[0]->created_at->diffForHumans() }}</small></p>
                        </small>
                    <p class="card-text">{{ $materials[0]->excerpt }}</p>
                    <a href="/materials/{{ $materials[0]->id }}" class="btn btn-primary" style="background-color: #99A799; border-color: #FEF5ED">Read More</a>
                </div>
            </div>
        </div>
        {{-- End of Header Material --}}
        

    {{-- All Materials --}}
    <div class="container">
        <div class="row">
            {{-- Skip 1 Material dikarenakan digunakan untuk Header Material --}}
            @foreach ($materials->skip(1) as $material)
            <div class="col-md-4 my-3">
                <div class="card">
                    {{-- Category Label --}}
                    <div class="position-absolute px-3 py-2 text-white rounded-3" style="background-color: rgba(0, 0, 0, 0.5)"><a href="/categories/{{ $material->category->id }}" class="text-decoration-none text-white"><i class="bi bi-tag"></i> &nbsp; {{ $material->category->name }}</a></div>
                    
                    <img src="/img/pdf_img.jpg" class="img-fluid" alt="#">
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
    {{-- End of Materials --}}

    {{-- Kondisi jika Jumlah Material kurang dari 1 atau sama dengan 0 --}}
    @else
        <p class="text-center fs-4" style="color: #99A799">No material found.</p>
    @endif

@endsection