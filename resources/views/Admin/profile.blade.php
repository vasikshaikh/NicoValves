{{-- <body class="authentication-bg position-relative"> --}}
{{-- <div class="account-pages pt-2 pt-sm-5 pb-4 pb-sm-5 position-relative"> --}}

@extends('Admin.Layouts.main')

<head>
    {{-- <meta charset="utf-8" /> --}}
    <title>Profile | Angreji Grammer</title>
    {{-- <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
    <meta content="Coderthemes" name="author" /> --}}

    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ asset('admin_assets/assets/images/favicon.ico') }}">

    <!-- Theme Config Js -->
    <script src="{{ asset('admin_assets/assets/js/config.js') }}"></script>

    <!-- App css -->
    <link href="{{ asset('admin_assets/assets/css/app.min.css') }}" rel="stylesheet" type="text/css" id="app-style" />

    <!-- Icons css -->
    <link href="{{ asset('admin_assets/assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
</head>
@section('main-container')
    <div class="content-page">
        <div class="content">
            <!-- Start Content-->
            <div class="container-fluid">
                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show mb-3" role="alert"
                        data-auto-dismiss="3000">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                @if (session('error'))
                    <div class="alert alert-danger alert-dismissible fade show mb-3" role="alert"
                        data-auto-dismiss="3000">
                        {{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                <div class="row">
                    <div class="col-12">
                        <div class="bg-flower">
                            <img src="{{ asset('admin_assets/assets/images/flowers/img-3.png') }}" alt="Flower Image 3">
                        </div>

                        <div class="bg-flower-2">
                            <img src="{{ asset('admin_assets/assets/images/flowers/img-1.png') }}" alt="Flower Image 1">
                        </div>

                    </div>
                </div>
                <div class="container-fluid">

                    <div class="row">
                        <div class="col-xxl-12 col-lg-12">
                            <div class="position-relative rounded-3 overflow-hidden"
                                style="background-image: url(admin_assets/assets/images/flowers/img-3.png); background-position: top right; background-repeat: no-repeat;">
                                <div class="card bg-transparent mb-0">
                                    <div class="card-body p-4">
                                        <form action="{{ route('admin.profile.update', $admin->id) }}" method="POST"
                                            enctype="multipart/form-data">
                                            @csrf
                                            <div class="row justify-content-center mb-4">
                                                <div class="col-auto text-center">
                                                    <img src="{{ asset('admin_assets/assets/images/users/avatar-1.jpg') }}"
                                                        alt="{{ Auth::user()->name ?? 'User' }} Profile Image"
                                                        class="img-fluid rounded-circle border border-3 border-primary mb-2"
                                                        width="150" height="150" style="object-fit: cover;"
                                                        loading="lazy">
                                                    {{-- <div class="mt-2">
                                                                <input type="file" class="form-control" name="image"
                                                                    id="image">
                                                            </div> --}}
                                                </div>
                                            </div>

                                            <div class="row mb-3">
                                                <div class="col-md-6">
                                                    <div class="row mb-3">
                                                        <label for="name" class="col-4 col-form-label">Name</label>
                                                        <div class="col-8">
                                                            <input type="text" class="form-control" id="name"
                                                                name="name" value="{{ old('name', $admin->name) }}"
                                                                placeholder="Enter name">
                                                            @error('name')
                                                                <span class="text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="row mb-3">
                                                        <label for="role" class="col-4 col-form-label">Role</label>
                                                        <div class="col-8">
                                                            <input type="text" class="form-control" id="role"
                                                                value="{{ $admin->role }}" placeholder="Role" readonly>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row mb-3">
                                                <div class="col-md-6">
                                                    <div class="row mb-3">
                                                        <label for="phone" class="col-4 col-form-label">Contact</label>
                                                        <div class="col-8">
                                                            <input type="text" class="form-control" id="phone"
                                                                name="phone" value="{{ old('phone', $admin->phone) }}"
                                                                placeholder="Enter contact number">
                                                            @error('phone')
                                                                <span class="text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="row mb-3">
                                                        <label for="email" class="col-4 col-form-label">Email</label>
                                                        <div class="col-8">
                                                            <input type="email" class="form-control" id="email"
                                                                name="email" value="{{ old('email', $admin->email) }}"
                                                                placeholder="Enter Email">
                                                            @error('email')
                                                                <span class="text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row mb-3">
                                                <div class="col-md-6">
                                                    <div class="row mb-3">
                                                        <label for="password"
                                                            class="col-4 col-form-label">Password</label>
                                                        <div class="col-8">
                                                            <input type="password" class="form-control" id="password"
                                                                name="password" placeholder="Leave blank to keep current">
                                                            @error('password')
                                                                <span class="text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="row mb-3">
                                                        <label for="password_confirmation"
                                                            class="col-4 col-form-label">Confirm Password</label>
                                                        <div class="col-8">
                                                            <input type="password" class="form-control"
                                                                id="password_confirmation" name="password_confirmation"
                                                                placeholder="Enter Confirm Password">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row mt-4 justify-content-center">
                                                <div class="col-md-6 text-center">
                                                    <button type="submit" class="btn btn-primary me-2">Update</button>
                                                    <button type="button" class="btn btn-secondary"
                                                        onclick="window.history.back()">Cancel</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end row -->
                </div>
                <!-- end container -->
            </div>
        </div>
        <!-- end page -->
        {{--
                <footer class="footer footer-alt fw-medium">
                    <span class="bg-body">
                        <script>
                            document.write(new Date().getFullYear())
                        </script>Developed © SNM TechCraft Innovation - snmtc.in
                    </span>
                </footer> --}}
        <!-- Vendor js -->
        <script src="{{ asset('admin_assets/assets/js/vendor.min.js') }}"></script>

        <!-- App js -->
        <script src="{{ asset('admin_assets/assets/js/app.min.js') }}"></script>

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                // Auto-dismiss alerts after 3 seconds
                const alert = document.getElementById('flash-message');
                if (alert) {
                    setTimeout(() => {
                        alert.classList.add('fade');
                        setTimeout(() => {
                            alert.remove();
                        }, 150); // Match this with your CSS transition time
                    }, 3000); // 3 seconds
                }

                // Manual dismiss
                document.querySelectorAll('.btn-close').forEach(button => {
                    button.addEventListener('click', function() {
                        this.closest('.alert').remove();
                    });
                });
            });
        </script>
    @endsection
