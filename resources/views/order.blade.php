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
                            <div class="d-flex align-items-stretch">
                                <div class="card w-100">
                                    <div class="card-body p-4">
                                        <h5 class="card-title fw-semibold mb-4">Order Billet</h5>
                                        <div class="table-responsive">
                                            <table class="table text-nowrap mb-0 align-middle">
                                                <thead class="text-dark fs-4">
                                                    <tr>
                                                        <th class="border-bottom-0">
                                                            <h6 class="fw-semibold mb-0">No</h6>
                                                        </th>
                                                        <th class="border-bottom-0">
                                                            <h6 class="fw-semibold mb-0">Nama Material</h6>
                                                        </th>
                                                        <th class="border-bottom-0">
                                                            <h6 class="fw-semibold mb-0">Diameter Billet</h6>
                                                        </th>
                                                        <th class="border-bottom-0">
                                                            <h6 class="fw-semibold mb-0">Panjang Billet</h6>
                                                        </th>
                                                        <th class="border-bottom-0">
                                                            <h6 class="fw-semibold mb-0">Jumlah Billet</h6>
                                                        </th>
                                                        <th class="border-bottom-0">
                                                            <h6 class="fw-semibold mb-0">Gambar Material</h6>
                                                        </th>
                                                        <th class="border-bottom-0">
                                                            <h6 class="fw-semibold mb-0">Tanggal Order</h6>
                                                        </th>
                                                        {{-- <th class="border-bottom-0">
                                                            <h6 class="fw-semibold mb-0">Pesan Material</h6>
                                                        </th> --}}
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @php $x = 1 @endphp
                                                    @foreach ( $materials as $material )
                                                        <form action="/order-billet/{{ $material->id }}" method="post" enctype="multipart/form-data">
                                                            @csrf
                                                            <input type="hidden" name="material_id" value={{ $material->id }}>
                                                            <tr>
                                                                <td class="border-bottom-0">
                                                                    <h6 class="fw-semibold mb-0">{{ $x++ }}</h6>
                                                                </td>
                                                                <td class="border-bottom-0">
                                                                    <h6 class="fw-semibold mb-1">{{ $material->nama_material }}</h6>
                                                                </td>
                                                                <td class="border-bottom-0">
                                                                    <div class="input-group input-group-sm has-validation">
                                                                        <input type="number" name="diameter_billet" class="form-control rounded-1">
                                                                        <span class="btn btn-sm btn-primary pt-2 fw-bold">m</span>
                                                                        {{-- <span class="input-group-text rounded-1" id="inputGroupPrepend">m</span> --}}
                                                                    </div>
                                                                </td>
                                                                <td class="border-bottom-0">
                                                                    <div class="input-group input-group-sm has-validation">
                                                                        <input type="number" name="panjang" class="form-control rounded-1">
                                                                        <span class="btn btn-sm btn-primary pt-2 fw-bold">m</span>
                                                                        {{-- <span class="input-group-text rounded-1" id="inputGroupPrepend">m</span> --}}
                                                                    </div>
                                                                </td>
                                                                <td class="border-bottom-0">
                                                                    <div class="input-group input-group-sm has-validation">
                                                                        <input type="number" name="quantity" class="form-control rounded-1">
                                                                        <span class="btn btn-sm btn-primary pt-2 fw-bold">m</span>
                                                                        {{-- <span class="input-group-text rounded-1" id="inputGroupPrepend">m</span> --}}
                                                                    </div>
                                                                </td>
                                                                <td class="border-bottom-0">
                                                                    <div class="d-flex align-items-center gap-2">
                                                                        <span class="p-1 bg-primary rounded-4 fw-semibold">
                                                                            <img src="/assets/images/{{ $material->gambar_material }}" width="130" alt="" class="rounded-3">
                                                                        </span>
                                                                    </div>
                                                                </td>
                                                                {{-- <td class="border-bottom-0">
                                                                    <input type="date" name="tanggal_order" class="form-control" >
                                                                </td> --}}
                                                                <td class="border-bottom-0">
                                                                    <button type="submit" class="btn btn-primary rounded-3">Pesan sekarang!</button>
                                                                </td>
                                                            </tr>
                                                        </form>
                                                    @endforeach
                                                </tbody>
                                            </table>
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
