@extends('dashboard.layouts.main')

@section('container')

    <div class="row" style="color: #15adcc">
        <div class="col">
            <h1>Edit Gallery for
                @foreach ($material_name as $name)
                    {{ $name }}
                @endforeach
            </h1>
        </div>
    </div>

    <div class="row text-center mt-3">
        <div class="col">
            <!-- Slider main container -->
            <div class="swiper">
                <!-- Additional required wrapper -->
                <div class="swiper-wrapper">
                <!-- Slides -->
                {{-- Looping Semua Gallleries --}}
                @foreach ($images as $image)
                <div class="swiper-slide">
                    <img src="{{ asset('storage/' . $image->url) }}" alt="{{ $image->url }}" class="img-fluid rounded-3" width="700">

                    <div class="row">
                        <div class="col">

                            {{-- Otomatis menjalankan method update() di DashboardGalleriesController dikarenakan menggunakan method('put') --}}
                            <form action="/dashboard/galleries/{{ $image->id }}" method="POST" class="mb-5" enctype="multipart/form-data">
                                @method('put')
                                @csrf
                                
                                <div class="row mt-5">
                                    <div class="col">
                                        {{-- Image --}}
                                        <div class="mb-3">
                                            <input type="hidden" name="oldImage" value="{{ $image->url }}">
                                            <input type="hidden" name="image_id" value="{{ $image->id }}">
                                            
                                            <input class="form-control @error('url')
                                                is-invalid
                                            @enderror" type="file" id="url" name="url" required>
                                            @error('url')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col">
                                        {{-- Button Edit --}}
                                        <button type="submit" class="btn btn-primary border-0" style="background-color: #15adcc"><span data-feather="edit"></span>&nbsp; Edit Image</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                @endforeach
                
                </div>
                <!-- If we need pagination -->
                <div class="swiper-pagination"></div>
            
                <!-- If we need navigation buttons -->
                <div class="swiper-button-prev" style="color: #15adcc"></div>
                <div class="swiper-button-next" style="color: #15adcc"></div>
            </div>
        </div>
    </div>

@endsection