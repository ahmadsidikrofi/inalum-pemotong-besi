@extends('layouts.setup')
@section('content')
@include('layouts.sidebar')
<link href="https://cdn.jsdelivr.net/npm/@sweetalert2/theme-light@4/light.css" rel="stylesheet">
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
                                            <div class="card-header bg-success rounded-4">
                                                <p class="text-dark p-1 px-3 m-2 text-white bg-primary rounded-3 fw-bold shadow-lg" style="position: absolute; ">
                                                    {{ $detailConveyingBillet->order_billet->batch }}
                                                </p>
                                                <div class="img-wrapper">
                                                    <img id="getImageBillet" src="/assets/images/{{ $detailConveyingBillet->material->gambar_material }}" width="300" height="180" class="rounded-3" alt="">
                                                </div>
                                            </div>
                                            <div class="d-flex align-items-center gap-2">
                                                <p class="fw-bold p-2 bg-primary rounded-4 my-3 text-white w-25">Panjang</p>
                                                <p class="fw-bold p-2 bg-primary rounded-4 my-3 text-white">{{ $detailConveyingBillet->order_billet->panjang }} m</p>
                                            </div>
                                            <div class="d-flex align-items-center gap-2">
                                                <p class="fw-bold p-2 bg-primary rounded-4 my-3 text-white w-25">Diameter</p>
                                                <p class="fw-bold p-2 bg-primary rounded-4 my-3 text-white">{{ $detailConveyingBillet->order_billet->diameter_billet }} m</p>
                                            </div>
                                            <div class="d-flex align-items-center gap-2">
                                                <p class="fw-bold p-2 bg-primary rounded-4 my-3 text-white w-25">Jumlah</p>
                                                <p class="fw-bold p-2 bg-primary rounded-4 my-3 text-white">{{ $detailConveyingBillet->order_billet->quantity }} pcs</p>
                                            </div>
                                            <p class="fw-bold p-2 bg-primary rounded-4 my-3 text-white">Tanggal order: {{ $detailConveyingBillet->material->created_at->format('d F Y') }}</p>
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
                                                    <button onclick="handleAlertButton()" class="btn btn-lg btn-danger shadow rounded-4">Siap dikirim!!</button>
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
<script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.js"></script>
<script>
    const handleAlertButton = () => {
        const pathImage = document.getElementById('getImageBillet').getAttribute('src')
        Swal.fire({
            title: "Billet Terangkut!",
            text: "Conveyor siap angkut billet!",
            imageUrl: `${pathImage}`,
            imageWidth: 400,
            imageHeight: 200,
            icon: "success"
        });
    }
</script>

@endsection
