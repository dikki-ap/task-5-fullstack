@extends('dashboard.layouts.main')

@section('container')

    <div class="row mt-5" style="color: #99A799">
        <div class="col">
            <h1 class="fw-bold">Gallery List</h1>
        </div>
    </div>

    <div class="table-responsive col-lg-12">

        {{-- Flash Message Gallery Added Success --}}
        @if (session()->has('success'))
        <div class="alert alert-success text-center" role="alert">
            {{ session('success') }}
        </div>
        @elseif (session()->has('failed'))
        <div class="alert alert-danger text-center" role="alert">
            {{ session('failed') }}
        </div>
        @endif

        <a href="/dashboard/materials/create" class="btn btn-primary border-0 my-3" style="background-color: #99A799; border-color: #FEF5ED"><span data-feather="file-plus"></span>&nbsp; Add New Material</a>

        <table class="table table-striped table-sm">
            <thead>
                <tr>
                <th scope="col">No</th>
                <th scope="col">Title</th>
                <th scope="col">Category</th>
                <th scope="col">Add Gallery</th>
                <th scope="col">Details</th>
                <th scope="col">Edit Gallery</th>
                <th scope="col">Delete Gallery</th>
                </tr>
            </thead>
            <tbody>

                {{-- Looping Semua Material --}}
                @foreach ($materials as $material)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $material->title }}</td>
                        <td>{{ $material->category->name }}</td>
                        <td>

                            <!-- Button Add Image Modal -->
                            <button type="button" class="badge border-0" data-bs-toggle="modal" data-bs-target="#addImage-{{ $material->id }}" style="background-color: #15adcc">
                                <span data-feather="file-plus"></span>
                            </button>

                            <!-- Add Image Modal -->
                            <div class="modal fade" id="addImage-{{ $material->id }}" tabindex="-1">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Add New Image to <span class="fw-bold" style="color: #99A799">{{ $material->title }}</span></h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="mb-3">
                                                <form action="/dashboard/galleries" method="POST" enctype="multipart/form-data" class="mb-5">
                                                    @csrf
                                                    <input type="hidden" name="material_id" id="material_id" value="{{ $material->id }}">

                                                    <div class="mb-3">
                                                        <label for="material_name" class="form-label">Title</label>
                                                        <input type="text" name="material_name" class="form-control" id="material_name" readonly value="{{ $material->title }}">
                                                    </div>
                                                    {{-- url --}}
                                                    <div class="mb-3">
                                                        <label for="url" class="form-label">Image</label>

                                                        {{-- Buat Tag Untuk Preview url --}}
                                                        <img class="img-preview img-fluid mb-3 col-sm-5">

                                                        <input class="form-control @error('url')
                                                            is-invalid
                                                        @enderror" type="file" id="url" name="url" required>
                                                        @error('url')
                                                            <div class="invalid-feedback">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                    </div>
                                                    <div class=" mt-3 text-center">
                                                        <button type="submit" class="btn btn-primary border-0" style="background-color: #99A799; border-color: #FEF5ED"><span data-feather="file-plus"></span>&nbsp; Add New Image</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            {{-- End of Add Image Modal --}}
                        </td>


                        {{-- Button Show Details --}}
                        <td>
                            <a href="/dashboard/materials/{{ $material->id }}" class="badge bg-primary">
                                <span data-feather="eye"></span>
                            </a>
                        </td>

                        {{-- Button Edit Gallery --}}
                        <td>
                            <form action="/dashboard/galleries/{{ $material->id }}/edit" method="GET">
                                @csrf

                                <input type="hidden" name="material_id" id="material_id" value="{{ $material->id }}">
                                <!-- Button Add Image Modal -->
                                <button type="submit" class="badge bg-success border-0">
                                    <span data-feather="edit"></span>
                                </button>
                            </form>
                        </td>

                        {{-- Button Delete Gallery --}}
                        <td>
                            <form action="/dashboard/galleries/create" method="GET">
                                @csrf

                                <input type="hidden" name="material_id" id="material_id" value="{{ $material->id }}">
                                <!-- Button Add Image Modal -->
                                <button type="submit" class="badge bg-danger border-0">
                                    <span data-feather="x-circle"></span>
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                
            </tbody>
        </table>
    </div>

@endsection