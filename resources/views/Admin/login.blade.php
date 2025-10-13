<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <title>Log In |Nico Valves</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
    <meta content="Coderthemes" name="author" />

    <!-- App favicon -->
   <link rel="shortcut icon" href="{{ asset('images/valve.png') }}">

    <!-- Theme Config Js -->
      <script src="{{ asset('admin_assets/assets/js/config.js') }}"></script>

    <!-- App css -->
      <link href="{{ asset('admin_assets/assets/css/app.min.css') }}" rel="stylesheet" type="text/css" id="app-style" />

    <!-- Icons css -->
     <link href="{{ asset('admin_assets/assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
    <style>
        .auth-brand img {
            height: 60px;
        }
        /* Prevent scrolling */
        body {
            margin: 0;
            padding: 0;
            height: 100vh;
            overflow: hidden; /* Disable scrolling */
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }
        .account-pages {
            padding: 0; /* Remove padding that causes scrolling */
            width: 100%;
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .card {
            margin: 0;
            width: 100%;
            max-width: 500px; /* Adjust as needed */
            box-sizing: border-box;
        }
        .footer {
            position: absolute;
            bottom: 0;
            width: 100%;
            text-align: center;
        }
    </style>
</head>

<body class="authentication-bg">
    <div class="account-pages">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xxl-6 col-lg-5">
                    <div class="position-relative rounded-3 overflow-hidden"
                        style="background-image: url(images/valves-bg.png); background-position: top right; background-repeat: no-repeat;    background-size: 60%;">
                        <div class="card bg-transparent mb-0">
                            <!-- Logo-->
                            <div class="auth-brand">
                                <a href="{{ route('admin') }}" class="logo-light">
                                    <img src="{{ asset('images/valve_logo_bg.png') }}" alt="logo" height="22">
                                </a>
                                <a href="{{ route('admin') }}" class="logo-dark">
                                    <img src="{{ asset('images/valve_logo_bg.png') }}" alt="dark logo" height="22">
                                </a>
                            </div>

                            <div class="card-body p-4">
                                <div class="w-50">
                                    <h4 class="pb-0 fw-bold">Sign In</h4>
                                    <p class="fw-semibold mb-4">Enter your email address and password to access admin panel.</p>
                                </div>

                                <form action="{{ route('login') }}" method="POST">
                                    @csrf

                                    <!-- Display success/error messages -->
                                    @if (session('success'))
                                        <div class="alert alert-success alert-dismissible fade show" role="alert" id="flash-message">
                                            {{ session('success') }}
                                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                        </div>
                                    @endif
                                    @if (session('error'))
                                        <div class="alert alert-danger alert-dismissible fade show" role="alert" id="flash-message">
                                            {{ session('error') }}
                                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                        </div>
                                    @endif

                                    <div class="mb-3">
                                        <label for="emailaddress" class="form-label">Email address</label>
                                        <input class="form-control @error('email') is-invalid @enderror" type="email"
                                            id="emailaddress" name="email" value="{{ old('email') }}" required
                                            placeholder="Enter your email">
                                        @error('email')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="password" class="form-label">Password</label>
                                        <div class="input-group input-group-merge">
                                            <input type="password" id="password" name="password"
                                                class="form-control @error('password') is-invalid @enderror" required
                                                placeholder="Enter your password">
                                            <div class="input-group-text" data-password="false">
                                                <span class="password-eye"></span>
                                            </div>
                                            @error('password')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="mb-3 mb-0 text-center">
                                        <button class="btn btn-primary w-100" type="submit">Log In</button>
                                    </div>
                                </form>
                            </div> <!-- end card-body -->
                        </div>
                        <!-- end card -->
                    </div>

                    <div class="row mt-3">
                        <!-- Removed Sign Up link -->
                    </div>
                    <!-- end row -->

                </div> <!-- end col -->
            </div>
            <!-- end row -->
        </div>
        <!-- end container -->
    </div>
    <!-- end page -->

    <footer class="footer footer-alt fw-medium">
        <div class="bg-body text-center">
            <div>© {{ date('Y') }} SNM TechCraft Innovation</div>
            <div>Developed by SNM TechCraft Innovation</div>
        </div>
    </footer>
    <!-- Vendor js -->
    <script src="admin_assets/assets/js/vendor.min.js"></script>

    <!-- App js -->
    <script src="admin_assets/assets/js/app.min.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Auto-dismiss alerts after 3 seconds
            const alert = document.getElementById('flash-message');
            if (alert) {
                setTimeout(() => {
                    alert.classList.add('fade');
                    setTimeout(() => {
                        alert.remove();
                    }, 150); // Match with CSS transition time
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
</body>
</html>
