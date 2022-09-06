@extends('dashboard.layouts.main')

@section('container')

    <div class="row mt-5" style="color: #99A799">
        <div class="col">
            <h1 class="fw-bold">Add New Material</h1>
        </div>
    </div>
        {{-- action akan otomatis ke /dashboard/materials digabung dengan POST akan otomatis menjalankan store() di Resource Controller --}}
        {{-- Form Add Material --}}
        <form action="/dashboard/materials" method="POST" class="mb-5" enctype="multipart/form-data">
            @csrf
            <div class="row justify-content-center my-5">
                <div class="col-8">

                    {{-- Title --}}
                    <div class="mb-3">
                        <label for="title" class="form-label">Title</label>
                        <input type="text" name="title" class="form-control @error('title')
                            is-invalid
                        @enderror" id="title" autofocus required value="{{ old('title') }}">
                        @error('title')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    {{-- Category --}}
                    <div class="mb-3">
                        <label for="category_id" class="form-label">Category</label>
                        <select class="form-select @error('category_id')
                        is-invalid
                    @enderror" name="category_id" required>
                    @error('category_id')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                    @enderror
                    
                            {{-- Looping Semua Kategori --}}
                            @foreach ($categories as $category)

                            {{-- Kondisi untuk SELECT OPTION jika salah, dan otomatis terisi ke value sebelumnya --}}
                            @if (old('category_id') == $category->id)

                                <option value="{{ $category->id }}" selected>{{ $category->name }}</option>

                            @else

                                <option value="{{ $category->id }}">{{ $category->name }}</option>

                            @endif
                            
                            @endforeach
                        </select>
                    </div>

                    {{-- File --}}
                    <div class="mb-3">
                        <label for="filename" class="form-label">File</label>
                        <input type="file" accept="application/pdf" name="filename" class="form-control @error('filename')
                            is-invalid
                        @enderror" required>
                        @error('filename')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    {{-- Description --}}
                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        @error('description')
                            <div class="text-danger">
                                {{ $message }}
                            </div>
                        @enderror
                        <input id="description" type="hidden" name="description" required value="{{ old('description') }}">
                        <trix-editor input="description"></trix-editor>
                    </div>
                </div>
            </div>
            <div class="row text-center">
                <div class="col">
                    {{-- Button Create --}}
                    <button type="submit" class="btn btn-primary border-0" style="background-color: #99A799; border-color: #FEF5ED">Add Material</button>
                </div>
            </div>
        </form>
    </div>

@endsection