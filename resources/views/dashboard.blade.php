@extends('layouts.setup')

@section('content')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <!--  Body Wrapper -->
    <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
        data-sidebar-position="fixed" data-header-position="fixed">
        <!-- Sidebar Start -->
        @include('layouts.sidebar')
        <!--  Sidebar End -->

        <!--  Main wrapper -->
        <div class="body-wrapper">
            <!--  Header Start -->
            @include('layouts.header')
            <!--  Header End -->
            <div class="container-fluid">
                <!--  Row 1 -->
                <div class="row">
                    <div class="col-lg-8 d-flex align-items-strech">
                        <div class="card w-100">
                            <div class="card-body">
                                <div class="d-sm-flex d-block align-items-center justify-content-between mb-9">
                                    <div class="mb-3 mb-sm-0">
                                        <h5 class="card-title fw-semibold">Sales Overview</h5>
                                    </div>
                                    <div>
                                        <select class="form-select">
                                            <option value="1">March 2023</option>
                                            <option value="2">April 2023</option>
                                            <option value="3">May 2023</option>
                                            <option value="4">June 2023</option>
                                        </select>
                                    </div>
                                </div>
                                <div id="chart"></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="row">
                            <div class="col-lg-12">
                                <!-- Yearly Material -->
                                <div class="card overflow-hidden">
                                    <div class="card-body p-4">
                                        <h5 class="card-title mb-9 fw-semibold">Yearly Material</h5>
                                        <div class="row align-items-center">
                                            <div class="col-8">
                                                <h4 class="fw-semibold mb-3">Total: {{ $countMaterial }}</h4>
                                                <div class="d-flex align-items-center mb-3">
                                                    <span
                                                        class="me-1 rounded-circle bg-light-success round-20 d-flex align-items-center justify-content-center">
                                                        <i class="ti ti-arrow-up-left text-success"></i>
                                                    </span>
                                                    <p class="text-dark me-1 fs-3 mb-0">+9%</p>
                                                    <p class="fs-3 mb-0">last year</p>
                                                </div>
                                                <div class="d-flex align-items-center">
                                                    <div class="me-4">
                                                        <span
                                                            class="round-8 bg-primary rounded-circle me-2 d-inline-block"></span>
                                                        <span class="fs-2">2023</span>
                                                    </div>
                                                    <div>
                                                        <span
                                                            class="round-8 bg-light-primary rounded-circle me-2 d-inline-block"></span>
                                                        <span class="fs-2">2023</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-4">
                                                <div class="d-flex justify-content-center">
                                                    <div id="breakup"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <!-- Monthly Earnings -->
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row alig n-items-start">
                                            <div class="col-8">
                                                <h5 class="card-title mb-9 fw-semibold"> Monthly Earnings </h5>
                                                <h4 class="fw-semibold mb-3">$6,820</h4>
                                                <div class="d-flex align-items-center pb-1">
                                                    <span
                                                        class="me-2 rounded-circle bg-light-danger round-20 d-flex align-items-center justify-content-center">
                                                        <i class="ti ti-arrow-down-right text-danger"></i>
                                                    </span>
                                                    <p class="text-dark me-1 fs-3 mb-0">+9%</p>
                                                    <p class="fs-3 mb-0">last year</p>
                                                </div>
                                            </div>
                                            <div class="col-4">
                                                <div class="d-flex justify-content-end">
                                                    <div
                                                        class="text-white bg-secondary rounded-circle p-6 d-flex align-items-center justify-content-center">
                                                        <i class="ti ti-currency-dollar fs-6"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="earning"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="mb-4">
                        <h5 class="card-title fw-semibold">Order billet status recently</h5>
                    </div>
                    @foreach ($recentOrderBillet as $recentOrder)
                    <div class="col-lg-4 d-flex align-items-stretch">
                        <div class="card w-100">
                            <div class="card-body p-4">
                                    <h5>Billet {{ $recentOrder->material->nama_material }}</h5>
                                    <ul class="timeline-widget mb-0 position-relative mb-n5">
                                        <li class="timeline-item d-flex position-relative overflow-hidden">
                                            <div class="timeline-time text-dark flex-shrink-0 text-end"><span class="badge bg-primary rounded-3 fw-semibold">Sudah</span></div>
                                            <div class="timeline-badge-wrap d-flex flex-column align-items-center">
                                                <span
                                                    class="timeline-badge border-2 border border-primary flex-shrink-0 my-8"></span>
                                                <span class="timeline-badge-border d-block flex-shrink-0"></span>
                                            </div>
                                            <div class="timeline-desc fs-3 text-dark mt-n1 fw-semibold">Billet teroder</div>
                                        </li>
                                        <li class="timeline-item d-flex position-relative overflow-hidden">
                                            @if ($recentOrder->status === "pemotongan panjang" || $recentOrder->status === "pemotongan diameter")
                                                <div class="timeline-time text-dark flex-shrink-0 text-end"><span class="badge bg-primary rounded-3 fw-semibold">Sudah</span></div>
                                            @else
                                            <div class="timeline-time text-dark flex-shrink-0 text-end"><span class="badge bg-warning rounded-3 fw-semibold">Belum</span></div>
                                            @endif
                                            <div class="timeline-badge-wrap d-flex flex-column align-items-center">
                                                <span
                                                    class="timeline-badge border-2 border border-info flex-shrink-0 my-8"></span>
                                                <span class="timeline-badge-border d-block flex-shrink-0"></span>
                                            </div>
                                            <div class="timeline-desc fs-3 text-dark mt-n1
                                                {{ $recentOrder->status === "pemotongan panjang" || $recentOrder->status === "pemotongan diameter"
                                                    ?  'fw-semibold' : 'fw-normal'
                                                }} ">Pemotongan panjang (X)
                                            </div>
                                        </li>
                                        <li class="timeline-item d-flex position-relative overflow-hidden">
                                            @if ($recentOrder->status === "pemotongan diameter")
                                                <div class="timeline-time text-dark flex-shrink-0 text-end"><span class="badge bg-primary rounded-3 fw-semibold">Sudah</span></div>
                                            @else
                                                <div class="timeline-time text-dark flex-shrink-0 text-end"><span class="badge bg-warning rounded-3 fw-semibold">Belum</span></div>
                                            @endif
                                            <div class="timeline-badge-wrap d-flex flex-column align-items-center">
                                                <span
                                                    class="timeline-badge border-2 border border-success flex-shrink-0 my-8"></span>
                                                <span class="timeline-badge-border d-block flex-shrink-0"></span>
                                            </div>

                                            <div class="timeline-desc fs-3 text-dark mt-n1
                                                {{ $recentOrder->status === "pemotongan diameter"
                                                    ?  'fw-semibold' : 'fw-normal'
                                                }} ">Pemotongan diameter (y)
                                            </div>
                                        </li>
                                        <li class="timeline-item d-flex position-relative overflow-hidden">
                                            @if ($recentOrder->status === "pemotongan panjang" || $recentOrder->status === "pemotongan diameter")
                                                <div class="timeline-time text-dark flex-shrink-0 text-end"><span class="badge bg-primary rounded-3 fw-semibold">Sudah</span></div>
                                            @else
                                            <div class="timeline-time text-dark flex-shrink-0 text-end"><span class="badge bg-warning rounded-3 fw-semibold">Belum</span></div>
                                            @endif
                                            <div class="timeline-badge-wrap d-flex flex-column align-items-center">
                                                <span
                                                    class="timeline-badge border-2 border border-warning flex-shrink-0 my-8"></span>
                                                <span class="timeline-badge-border d-block flex-shrink-0"></span>
                                            </div>
                                            <div class="timeline-desc fs-3 text-dark mt-n1 mb-3
                                                {{ $recentOrder->status === "pemotongan panjang" || $recentOrder->status === "pemotongan diameter"
                                                    ?  'fw-semibold' : 'fw-normal'
                                                }} ">Pemotongan {{ $recentOrder->material->nama_material }} selesai
                                            </div>
                                        </li>
                                        <li class="timeline-item d-flex position-relative overflow-hidden mb-5">
                                            <div class="timeline-time text-dark flex-shrink-0 text-end"><span class="badge bg-success rounded-3 fw-semibold">Siap <br> diantar</span></div>
                                            <div class="timeline-badge-wrap d-flex flex-column align-items-center">
                                                <span
                                                    class="timeline-badge border-2 border border-success flex-shrink-0 my-8"></span>
                                                <span class="timeline-badge-border d-block flex-shrink-0"></span>
                                            </div>
                                            <div class="timeline-desc fs-3 text-dark mt-n1
                                                {{ $recentOrder->status === "pemotongan panjang" || $recentOrder->status === "pemotongan diameter"
                                                    ?  'fw-semibold' : 'fw-normal'
                                                }} ">Billet siap diangkut
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    <div class="col-lg-8 d-flex align-items-stretch">
                        <div class="card w-100">
                            <div class="card-body p-4">
                                <h5 class="card-title fw-semibold mb-4">Recent Member</h5>
                                <div class="table-responsive">
                                    <table class="table text-nowrap mb-0 align-middle">
                                        <thead class="text-dark fs-4">
                                            <tr>
                                                <th class="border-bottom-0">
                                                    <h6 class="fw-semibold mb-0">No</h6>
                                                </th>
                                                <th class="border-bottom-0">
                                                    <h6 class="fw-semibold mb-0">Nama member</h6>
                                                </th>
                                                <th class="border-bottom-0">
                                                    <h6 class="fw-semibold mb-0">Email</h6>
                                                </th>
                                                <th class="border-bottom-0">
                                                    <h6 class="fw-semibold mb-0">Role</h6>
                                                </th>
                                                {{-- <th class="border-bottom-0">
                                                    <h6 class="fw-semibold mb-0">Budget</h6>
                                                </th> --}}
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($allUsers as $user )
                                                <tr>
                                                    <td class="border-bottom-0">
                                                        <h6 class="fw-semibold mb-0">{{ $loop->iteration }}</h6>
                                                    </td>
                                                    <td class="border-bottom-0">
                                                        <h6 class="fw-semibold mb-1">{{ $user->name }}</h6>
                                                        <span class="fw-normal">Web Designer</span>
                                                    </td>
                                                    <td class="border-bottom-0">
                                                        <p class="mb-0 fw-normal">{{ $user->email }}</p>
                                                    </td>
                                                    <td class="border-bottom-0">
                                                        <div class="d-flex align-items-center gap-2">
                                                            <span class="badge bg-primary rounded-3 fw-semibold">Admin</span>
                                                        </div>
                                                    </td>
                                                    {{-- <td class="border-bottom-0">
                                                        <h6 class="fw-semibold mb-0 fs-4">$3.9</h6>
                                                    </td> --}}
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    @foreach ($materialItems as $materialItem)
                        <div class="col-sm-6 col-xl-3">
                            <div class="card overflow-hidden rounded-2">
                                <div class="position-relative">
                                    <a href="/edit-material/{{ $materialItem->id }}"><img
                                            src="../assets/images/{{ $materialItem->gambar_material }}"
                                            class="card-img-top rounded-3" alt="..."></a>
                                    <a href="/delete-material/{{ $materialItem->id }}"
                                        class="bg-primary rounded-circle p-2 text-white d-inline-flex position-absolute bottom-0 end-0 mb-n3 me-3"
                                        data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Add To Cart"><i class="ti ti-trash fs-4"></i>
                                    </a>
                                </div>
                                <div class="card-body pt-3 p-4">
                                    <h6 class="fw-semibold fs-4">
                                        <a href="/edit-material/{{ $materialItem->id }}">{{ $materialItem->nama_material }}</a>
                                    </h6>
                                    <div class="d-flex align-items-center justify-content-between">
                                        <h6 class="fw-semibold fs-4 mb-0">{{ $materialItem->kualitas_material }}
                                            <span
                                                class="ms-2 fw-normal text-muted fs-3">
                                            </span>
                                        </h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="py-6 px-6 text-center">
                    <p class="mb-0 fs-4">Design and Developed by Kelompok 4 Integrasi Aplikasi Perusahaan</p>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script>
        @if (Session::has('berhasilLogin'))
            toastr.success("Selamat Datang Di Inalum pemotong billet🧢🧢")
        @endif
    </script>
@endsection
