{{-- Relative dari folder views, lalu ketikkan layouts.main atau bisa juga layouts/main --}}
@extends('layouts.main')

{{-- Mengambil dari section 'container' di layouts/main.blade.php --}}
@section('container')

    <div class="container">
        <h1 class="my-5" style="color: #99A799">Category List</h1>
    </div>

    {{-- Cek apakah ada Category atau tidak --}}
    @if ($count > 0)
        <div class="container">
            <div class="row">
                @foreach ($categories as $category)
                <div class="col-md-6 my-5">
                    <a href="/categories/{{ $category->id }}">
                        <div class="card text-white">
                            <div class="card-img-overlay d-flex align-items-center p-0">
                                <h5 class="card-title text-center flex-fill rounded-5 p-4 fs-3" style="background-color: #D3E4CD; border: 2px solid ;border-color: #99A799">{{ $category->name }}</h5>
                            </div>
                        </div>
                    </a>
                </div>
                @endforeach
            </div>
        </div>
    @else
        <p class="text-center fs-4" style="color: #99A799">No category found.</p>
    @endif
    

    

@endsection
