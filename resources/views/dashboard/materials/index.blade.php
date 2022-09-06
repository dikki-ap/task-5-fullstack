@extends('dashboard.layouts.main')

@section('container')

    <div class="row mt-5" style="color: #99A799">
        <div class="col">
            <h1 class="fw-bold">Material List</h1>
        </div>
    </div>

    <div class="table-responsive col-lg-12">

        {{-- Flash Message Post Added Success --}}
        @if (session()->has('success'))
        <div class="alert alert-success text-center" role="alert">
            {{ session('success') }}
        </div>
        @endif

        <a href="/dashboard/materials/create" class="btn btn-primary border-0 my-3" style="background-color: #99A799; border-color: #FEF5ED"><span data-feather="file-plus"></span>&nbsp; Add New Material</a>

        <table class="table table-striped table-sm">
            <thead>
                <tr>
                <th scope="col">No</th>
                <th scope="col">Title</th>
                <th scope="col">Category</th>
                <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($materials as $material)
                    <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $material->title }}</td>
                    <td>{{ $material->category->name }}</td>
                    <td>
                        <a href="/dashboard/materials/{{ $material->id }}" class="badge bg-primary">
                            <span data-feather="eye"></span>
                        </a>
                        <a href="/dashboard/materials/{{ $material->id }}/edit" class="badge bg-success">
                            <span data-feather="edit"></span>
                        </a>
                        <form action="/dashboard/materials/{{ $material->id }}" method="POST" class="d-inline">
                            @method('delete')
                            @csrf

                            <button class="badge bg-danger border-0" onclick="return confirm('Apakah kamu yakin ingin menghapus data ini?')"><span data-feather="x-circle"></span></button>
                        </form>
                    </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

@endsection