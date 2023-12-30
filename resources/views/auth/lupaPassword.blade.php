@extends('layouts.setup')
@section('content')
    <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
        data-sidebar-position="fixed" data-header-position="fixed">
        <div
            class="position-relative overflow-hidden radial-gradient min-vh-100 d-flex align-items-center justify-content-center">
            <div class="d-flex align-items-center justify-content-center w-100">
                <div class="row justify-content-center w-100">
                    <div class="col-md-8 col-lg-6 col-xl-5 ">
                        <div class="card mb-0">
                            <div class="card-body">
                                <a href="#" class="text-nowrap logo-img text-center d-block py-3 w-100">
                                    <img src="../assets/images/logos/inalum-logo.png" width="180" alt="">
                                </a>
                                <p class="text-center">Pabrik pemotong besi (billet)</p>
                                <form action="/lupa-password/store" method="post">
                                    @method('put')
                                    @csrf
                                    <div class="mb-3">
                                        <label for="email" class="form-label">Email</label>
                                        <input type="email" name="email" class="form-control" id="email" >
                                        @if (session('error'))
                                            <small>
                                                <strong class="text-danger mb-5">{{ session('error') }}</strong>
                                                <br><br>
                                            </small>
                                        @endif
                                    </div>
                                    <div class="mb-3">
                                        <label for="password" class="form-label">Password Baru</label>
                                        <input type="password" name="password" class="form-control" id="password" >
                                    </div>

                                    <div class="mb-4">
                                        <label for="password_confirmation" class="form-label">Tulis ulang password</label>
                                        <input name="password_confirmation" type="password" class="form-control" id="password_confirmation">
                                        <i class="@error('password') is-invalid @enderror"></i>

                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <button type="submit" class="btn btn-primary w-100 py-8 fs-4 mb-4 rounded-2">Konfirmasi Ubah Password</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="../assets/libs/jquery/dist/jquery.min.js"></script>
    <script src="../assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
@endsection
