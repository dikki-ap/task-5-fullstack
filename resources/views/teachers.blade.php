{{-- Relative dari folder views, lalu ketikkan layouts.main atau bisa juga layouts/main --}}
@extends('layouts.main')

{{-- Mengambil dari sectiont 'container' di layouts/home.blade.php --}}
@section('container')

    <div class="container">
        <h1 class="my-5" style="color: #99A799">Teacher List</h1>
    </div>
    
    <div class="container">
        <div class="row">
            @foreach ($teachers as $teacher)
            <div class="col-md-6 d-flex justify-content-center my-3">
                <div class="card rounded-5 p-5 mb-3" style="max-width: 540px; border: 2px solid; border-color: #D3E4CD">
                    <div class="row g-0">
                      <div class="col-md-4">

                        {{-- Jika Teacher punya Profile Picture --}}
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
                      <div class="col-md-8 d-flex align-items-center">
                        <div class="card-body">
                          <h3 class="card-title text-center"><a href="/teachers/{{ $teacher->username }}" class="text-decoration-none fw-bold" style="color: #99A799">{{ $teacher->name }}</a></h3>
                          @if ($teacher->gender === "Male")
                            <h4 class="text-center" style="color: #ADC2A9"><i class="bi bi-gender-male"></i> &nbsp; {{ $teacher->gender }}</h4>
                          @else
                            <h4 class="text-center" style="color: #ADC2A9"><i class="bi bi-gender-female"></i> &nbsp; {{ $teacher->gender }}</h4>
                          @endif
                          
                        </div>
                      </div>
                    </div>
                  </div>
            </div>
            @endforeach
        </div>
    </div>

@endsection
