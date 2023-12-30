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
                                            <h5 class="card-title fw-semibold mb-4">Bagian Conveying Equipment</h5>
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
                                                            <th class="border-bottom-0" style="width: 80%">
                                                                <h6 class="fw-semibold mb-0">Detail Order</h6>
                                                            </th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ( $billets as $billet )
                                                            {{-- <input type="hidden" name="material_id" value={{ $material->id }}> --}}
                                                            <tr>
                                                                <td class="border-bottom-0">
                                                                    <h6 class="fw-semibold mb-0">{{ $loop->iteration }}</h6>
                                                                </td>
                                                                <td class="border-bottom-0">
                                                                    <h6 class="fw-semibold mb-1">{{ $billet->material->nama_material }}</h6>
                                                                </td>
                                                                <td class="border-bottom-0">
                                                                    <p class="mb-0 fw-normal badge bg-primary rounded-3 fw-semibold">{{ $billet->order_billet->diameter_billet }} m</p>
                                                                </td>
                                                                <td class="border-bottom-0">
                                                                    <p class="mb-0 fw-normal badge bg-primary rounded-3 fw-semibold">{{ $billet->order_billet->panjang }} m</p>
                                                                </td>
                                                                <td class="border-bottom-0">
                                                                    <p class="mb-0 fw-normal badge bg-primary rounded-3 fw-semibold">{{ $billet->order_billet->quantity }}</p>
                                                                </td>
                                                                <td class="border-bottom-0">
                                                                    <div class="d-flex align-items-center gap-2">
                                                                        <span class="p-1 bg-primary rounded-4 fw-semibold">
                                                                            <img src="/assets/images/{{ $billet->material->gambar_material }}" width="130" alt="" class="rounded-3">
                                                                        </span>
                                                                    </div>
                                                                </td>
                                                                <td class="border-bottom-0">
                                                                    <p class="mb-0 fw-semibold">{{ $billet->material->created_at->format('d F Y') }}</p>
                                                                </td>
                                                                <td class="border-bottom-0">
                                                                    <a href="/detail/conveying/{{ $billet->id }}" class="btn btn-primary rounded-3 mt-3">Detail billet</a>
                                                                </td>
                                                            </tr>
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
