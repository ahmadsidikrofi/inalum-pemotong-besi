@extends('layouts.setup')

@section('content')

@include('layouts.sidebar')
<div class="body-wrapper">
    @include('layouts.header')
    <div class="container-fluid">
        <div class="container-fluid">
            <div class="row">
                <div class="col">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title fw-semibold mb-4">Tambah Material</h5>
                            <div class="card">
                                <div class="card-body">
                                    <form method="post" action="/create-material-store" enctype="multipart/form-data">
                                        @csrf
                                        <div class="mb-3">
                                            <label for="nama_material" class="form-label">Nama Material</label>
                                            <input type="text" name="nama_material" class="form-control" id="nama_material">
                                        </div>
                                        <div class="mb-3">
                                            <label for="gambar_material" class="form-label">Gambar Material</label>
                                            <input type="file" name="gambar_material" class="form-control" id="gambar_material">
                                        </div>
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
