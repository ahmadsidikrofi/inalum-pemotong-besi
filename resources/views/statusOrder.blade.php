<?php
use Carbon\Carbon;
?>
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
                                        <h5 class="card-title fw-semibold mb-4">Status Order Billet</h5>
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
                                                            <h6 class="fw-semibold mb-0">Status Pesanan</h6>
                                                        </th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @php $x = 1 @endphp
                                                    @foreach ( $billetOrderGroups as $billetOrderGroup )
                                                    <tr>
                                                        <td>
                                                            <h6 class="fw-semibold">Batch {{ $billetOrderGroup->batch }}</h6>
                                                        </td>
                                                        <td>
                                                            <p class="mb-0 fw-normal badge bg-primary rounded-3">Total : {{ $billetOrderGroup->totalQuantity }}</p>
                                                        </td>
                                                    </tr>
                                                        @foreach ( $billetOrders as $billetOrder )
                                                            @if ( $billetOrderGroup->batch === $billetOrder->batch )
                                                            {{-- <input type="hidden" name="material_id" value={{ $material->id }}> --}}
                                                            <tr>
                                                                <td class="border-bottom-0">
                                                                    <h6 class="fw-semibold mb-0">{{ $x++ }}</h6>
                                                                </td>
                                                                <td class="border-bottom-0">
                                                                    <h6 class="fw-semibold mb-1">{{ $billetOrder->material->nama_material }}</h6>
                                                                </td>
                                                                <td class="border-bottom-0">
                                                                    <p class="mb-0 fw-normal badge bg-primary rounded-3 fw-semibold">{{ $billetOrder->diameter_billet }} m</p>
                                                                </td>
                                                                <td class="border-bottom-0">
                                                                    <p class="mb-0 fw-normal badge bg-primary rounded-3 fw-semibold">{{ $billetOrder->panjang }} m</p>
                                                                </td>
                                                                <td class="border-bottom-0">
                                                                    <p class="mb-0 fw-normal badge bg-primary rounded-3 fw-semibold">{{ $billetOrder->quantity }}</p>
                                                                </td>
                                                                <td class="border-bottom-0">
                                                                    <div class="d-flex align-items-center gap-2">
                                                                        <span class="p-1 bg-primary rounded-4 fw-semibold">
                                                                            <img src="/assets/images/{{ $billetOrder->material->gambar_material }}" width="130" alt="" class="rounded-3">
                                                                        </span>
                                                                    </div>
                                                                </td>
                                                                <td class="border-bottom-0">
                                                                    <p class="mb-0 fw-semibold">{{ $billetOrder->created_at->diffForHumans() }}</p>
                                                                </td>
                                                                <form method="post" action="/confirm-sawing-billet/{{ $billetOrder->id }}" >
                                                                    @method('put')
                                                                    @csrf
                                                                    <td class="border-bottom-0">
                                                                        <select style="width: 160px" name="status" id="status" class="form-control rounded-3 text-center p-2">
                                                                            <option @if ($billetOrder->status === "menunggu konfirmasi") selected @endif value="menunggu konfirmasi">Menunggu Konfirmasi</option>
                                                                            <option id="panjang" @if ($billetOrder->status === "pemotongan panjang") selected @endif
                                                                                value="pemotongan panjang"
                                                                                {{ $billetOrder->isTimeExpired() ? '' : 'disabled' }}>Pemotongan Panjang
                                                                            </option>
                                                                            <option id="diameter" @if ($billetOrder->status === "pemotongan diameter") selected @endif
                                                                                value="pemotongan diameter"
                                                                                {{ $billetOrder->isTimeExpired() ? '' : 'disabled' }}>Pemotongan Diameter
                                                                            </option>
                                                                            <option @if ($billetOrder->status === "selesai") selected @endif value="selesai">Selesai</option>
                                                                        </select>
                                                                        <button type="submit" class="btn btn-primary rounded-3 mt-3">Konfirmasi!</button>
                                                                    </td>
                                                                </form>
                                                                <form action="/conveying-equipment/{{ $billetOrder->id }}" method="post" enctype="multipart/form-data">
                                                                    @csrf
                                                                    <input type="hidden" name="order_id" value="{{ $billetOrder->id }}">
                                                                    <input type="hidden" name="material_id" value="{{ $billetOrder->material_id }}">
                                                                    <td class="border-bottom-0">
                                                                        <button type="submit" class="btn btn-danger rounded-3 mt-3" {{ $billetOrder->status !== "selesai" ? "disabled" : "" }}>Billet Stacker!</button>
                                                                    </td>
                                                                </form>

                                                                    @if ($billetOrder->status === "pemotongan panjang")
                                                                        <?php
                                                                            if ($billetOrder->isTimeExpired()) {
                                                                                echo '<p class="p-3 bg-success rounded-3 text-white fw-light">';
                                                                                echo 'Pemotongan panjang <strong>' . $billetOrder->material->nama_material . '</strong> telah selesai';
                                                                                echo '</p>';
                                                                            } else {
                                                                                echo '<p class="p-3 bg-danger rounded-3 text-white fw-light">';
                                                                                echo 'Sisa waktu pemotongan panjang <strong>' . $billetOrder->material->nama_material . '</strong> adalah ';
                                                                                echo '<strong id="countdown-timer">' . $billetOrder->calculateRemainingTime() . '</strong>';
                                                                                echo '</p>';
                                                                            }
                                                                        ?>
                                                                    @elseif ($billetOrder->status === "pemotongan diameter")
                                                                        <?php
                                                                            if ($billetOrder->isTimeExpired()) {
                                                                                echo '<p class="p-3 bg-success rounded-3 text-white fw-light">';
                                                                                echo 'Pemotongan diameter <strong>' . $billetOrder->material->nama_material . '</strong> telah selesai';
                                                                                echo '</p>';
                                                                            } else {
                                                                                echo '<p class="p-3 bg-danger rounded-3 text-white fw-light">';
                                                                                echo 'Sisa waktu pemotongan diameter <strong>' . $billetOrder->material->nama_material . '</strong> adalah ';
                                                                                echo '<strong id="countdown-timer">' . $billetOrder->calculateRemainingTime() . '</strong>';
                                                                                echo '</p>';
                                                                            }
                                                                        ?>
                                                                    @endif
                                                                </tr>
                                                            @endif
                                                        @endforeach
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
<script>
    let panjang = document.getElementById("panjang")
    let diameter = document.getElementById('diameter')
    if (panjang.disabled === true && diameter.disabled === true) {
        panjang.style.backgroundColor = "#65737e"
        panjang.style.color = "white"
        diameter.style.backgroundColor = "#65737e"
        diameter.style.color = "white"
    }
</script>
@endsection
