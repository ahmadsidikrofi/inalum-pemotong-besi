@extends('layouts.setup')
@section('content')
@include('layouts.sidebar')
<div class="body-wrapper">
    @include('layouts.header')
    <div class="container-fluid">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <h5 class="card-title fw-semibold mb-4 text-warning">Detail dari {{ $detailConveyingBillet->material->nama_material }}</h5>
                                <a class="btn btn-info" href="/conveying-equipment">Kembali</a>
                            </div>
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-5 col-sm-5">
                                            <div class="card-header">
                                                <div class="img-wrapper">
                                                    <p class="text-dark p-1 px-3 m-2 text-white bg-primary rounded-3 fw-bold shadow-lg" style="position: absolute; ">
                                                        {{ $detailConveyingBillet->order_billet->batch }}
                                                    </p>
                                                    <img src="/assets/images/{{ $detailConveyingBillet->material->gambar_material }}" width="300" height="180" class="rounded-3" alt="">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-sm-7">
                                            <div class="mb-3">
                                                <div class="mb-3">
                                                    <label class="mb-3 text-primary">Lokasi</label>
                                                    <input type="text" class="form-control" name="location" value="{{ $detailConveyingBillet->location }}">
                                                </div>
                                                <div class="mb-3">
                                                    <label class="mb-3 text-primary">Kapasitas</label>
                                                    <input type="text" class="form-control" name="capacity" value="{{ $detailConveyingBillet->capacity }}">
                                                </div>
                                                <div class="mb-3">
                                                    <label class="mb-3 text-primary">Kondisi</label>
                                                    <input type="text" class="form-control" name="condition" value="{{ $detailConveyingBillet->condition }}">
                                                </div>
                                                <div class="mb-3">
                                                    <label class="mb-3 text-primary">Status Pengangkutan</label>
                                                    <select name="status_pengangkutan" class="form-control">
                                                        <option value="menunggu diangkut">Menunggu Diangkut</option>
                                                        <option value="selesai diangkut">Selesai Diangkut</option>
                                                    </select>
                                                </div>
                                                <div class="mb-3">
                                                    <button class="btn btn-lg btn-danger shadow rounded-4">Siap dikirim!!</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
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
