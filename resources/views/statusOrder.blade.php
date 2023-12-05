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
                                                            <h6 class="fw-semibold mb-0">Panjang Material</h6>
                                                        </th>
                                                        <th class="border-bottom-0">
                                                            <h6 class="fw-semibold mb-0">Lebar Material</h6>
                                                        </th>
                                                        <th class="border-bottom-0">
                                                            <h6 class="fw-semibold mb-0">Gambar Material</h6>
                                                        </th>
                                                        <th class="border-bottom-0">
                                                            <h6 class="fw-semibold mb-0">Tanggal Order</h6>
                                                        </th>
                                                        <th class="border-bottom-0">
                                                            <h6 class="fw-semibold mb-0">Status Pesanan</h6>
                                                        </th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @php $x = 1 @endphp
                                                    @foreach ( $billetOrders as $billetOrder )
                                                        {{-- <input type="hidden" name="material_id" value={{ $material->id }}> --}}
                                                        <tr>
                                                            <td class="border-bottom-0">
                                                                <h6 class="fw-semibold mb-0">{{ $x++ }}</h6>
                                                            </td>
                                                            <td class="border-bottom-0">
                                                                <h6 class="fw-semibold mb-1">{{ $billetOrder->material->nama_material }}</h6>
                                                            </td>
                                                            <td class="border-bottom-0">
                                                                <p class="mb-0 fw-normal badge bg-primary rounded-3 fw-semibold">{{ $billetOrder->material->panjang }} m</p>
                                                            </td>
                                                            <td class="border-bottom-0">
                                                                <p class="mb-0 fw-normal badge bg-primary rounded-3 fw-semibold">{{ $billetOrder->material->lebar }} m</p>
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
                                                                <p>{{ $billetOrder->order_id }}</p>
                                                                @method('put')
                                                                @csrf
                                                                <td class="border-bottom-0">
                                                                    <select name="status" id="status" class="form-control rounded-3 text-center p-2">
                                                                        <option @if ($billetOrder->status === "waiting") selected @endif value="waiting">Waiting</option>
                                                                        <option @if ($billetOrder->status === "in action") selected @endif value="in action">In action</option>
                                                                        <option @if ($billetOrder->status === "completed") selected @endif  value="completed">Completed</option>
                                                                    </select>
                                                                    <button type="submit" class="btn btn-primary rounded-3 mt-3">Konfirmasi!</button>
                                                                </td>
                                                            </form>
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

{{-- <script>
    let statusSelect = document.getElementById("status");
    let selectedStatus = statusSelect.value;
    let statusBg = document.getElementById("statusBg");
    statusBg.classList.remove("bg-warning", "bg-danger", "bg-primary");

    if (selectedStatus === "waiting") {
        statusBg.classList.add("bg-warning");
    } else if (selectedStatus === "in action") {
        statusBg.classList.add("bg-danger");
    } else if (selectedStatus === "completed") {
        statusBg.classList.add("bg-primary");
    }
</script> --}}
@endsection
