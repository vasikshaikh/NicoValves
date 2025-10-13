@extends('Admin.Layouts.main')

@section('main-container')
    <style>
        .dashboard-card {
            background: rgba(255, 255, 255, 0.95);
            border: 1px solid #e0e0e0;
            border-radius: 1rem;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
            transition: all 0.3s ease-in-out;
        }

        .dashboard-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        }

        .dashboard-card .icon-wrapper {
            width: 50px;
            height: 50px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #f0f4ff;
            border-radius: 50%;
        }

        .dashboard-card h5 {
            font-weight: 600;
            color: #6c757d;
            margin-bottom: 0;
        }

        .dashboard-card h3 {
            font-weight: 700;
            color: #6da09c;
        }

        .dashboard-card i {
            color: #6da09c;
        }
    </style>
    <!-- ============================================================== -->



    <!-- Start Page Content here -->
    <!-- ============================================================== -->

    <div class="content-page">
        <div class="content">

            <!-- Start Content-->
            <div class="container-fluid">
                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show mb-3" role="alert" data-auto-dismiss="3000">
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
                            <img src="{{ asset('images/valve_1.png') }}" alt="Flower Image 3">
                        </div>

                        <div class="bg-flower-2">
                            <img src="{{ asset('images/valve_2.png') }}" alt="Flower Image 1">
                        </div>

                    </div>
                </div>

                <div class="row g-4 mt-2">
                   <!-- Total Users -->
                    <div class="col-md-4">
                        {{-- <a href="{{ route('userList') }}" class="text-decoration-none"> --}}
                            <div
                                class="card p-4 h-100 shadow-sm d-flex justify-content-between align-items-center flex-row">
                                <!-- Icon Left -->
                                <div>
                                    <i class="fas fa-layer-group fa-3x" style="color: #6da09c;"></i>
                                </div>
                                <!-- Text Right -->
                                <div class="text-end">
                                    <h5 class="fw-bold text-dark mb-2">Total Categories</h5>
                                    <h2 class="fw-bolder mb-0" style="color: #6da09c; text-align: center">
                                        {{ $category_count }}</h2>
                                </div>
                            </div>
                        </a>
                    </div>

                    <style>
                        .hover-effect:hover {
                            transform: translateY(-5px);
                            box-shadow: 0 10px 25px rgba(102, 126, 234, 0.3);
                        }
                    </style>

                    <!-- Total Plans -->
                    <div class="col-md-4">
                        <a href="{{ route('listProduct') }}" class="text-decoration-none">
                        <div class="card p-4 h-100 shadow-sm d-flex justify-content-between align-items-center flex-row">
                            <div>
                                <i class="fas fa-cube fa-3x" style="color: #6da09c;"></i>
                            </div>
                            <div class="text-end">
                                <h5 class="fw-bold text-dark mb-2">Total Products</h5>
                                <h2 class="fw-bolder mb-0" style="color: #6da09c; text-align: center">
                                        {{ $product_count }}</h2>
                            </div>
                        </div>
                        </a>
                    </div>

                    <!-- Total Subscriptions -->
                    <div class="col-md-4">
                        <a href="{{ route('listEnquiry') }}" class="text-decoration-none">
                        <div class="card p-4 h-100 shadow-sm d-flex justify-content-between align-items-center flex-row">
                            <div>
                                <i class="fas fa-comments fa-3x" style="color: #6da09c;"></i>
                            </div>
                            <div class="text-end">
                                <h5 class="fw-bold text-dark mb-2">Total Enquiries</h5>
                                <h2 class="fw-bolder mb-0" style="color: #6da09c; text-align: center">
                                        {{ $enquiry_count }}</h2>
                            </div>
                        </div>
                        </a>
                    </div>
                </div>

                <!-- end row -->

                <!-- end row -->

            </div>
            <!-- container -->

        </div>
        <!-- content -->

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                // Auto-dismiss alerts after specified time
                const alerts = document.querySelectorAll('[data-auto-dismiss]');

                alerts.forEach(alert => {
                    const delay = parseInt(alert.getAttribute('data-auto-dismiss'));

                    setTimeout(() => {
                        const bsAlert = new bootstrap.Alert(alert);
                        bsAlert.close();
                    }, delay);
                });

                // Manual dismiss
                document.querySelectorAll('.btn-close').forEach(button => {
                    button.addEventListener('click', function() {
                        const alert = this.closest('.alert');
                        const bsAlert = bootstrap.Alert.getOrCreateInstance(alert);
                        bsAlert.close();
                    });
                });
            });
        </script>




        <!-- ============================================================== -->
        <!-- End Page content -->
        <!-- ============================================================== -->
    @endsection
