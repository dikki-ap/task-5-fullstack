@extends('dashboard.layouts.main')

@section('container')

    <div class="row mt-5" style="color: #99A799">
        <div class="col">
            <h1 class="fw-bold">Add New Category</h1>
        </div>
    </div>
        {{-- action akan otomatis ke /dashboard/categories digabung dengan POST akan otomatis menjalankan store() di Resource Controller --}}
        <form action="/dashboard/categories" method="POST" class="mb-5">
            @csrf
            <div class="row my-5">
                <div class="col-4">
                    {{-- Name --}}
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" name="name" class="form-control @error('name')
                            is-invalid
                        @enderror" id="name" autofocus required value="{{ old('name') }}">
                        @error('name')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
            <div class="row">
                <div class="col">
                    {{-- Button Create --}}
                    <button type="submit" class="btn btn-primary border-0" style="background-color: #99A799; border-color: #FEF5ED">Add Category</button>
                </div>
            </div>
        </form>

@endsection