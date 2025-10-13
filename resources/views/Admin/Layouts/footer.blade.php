                <!-- Footer Start -->
                <footer class="footer">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-6">
                                <script>
                                    document.write(new Date().getFullYear())
                                </script>
                                © <a href="https://snmtc.in/" target="_blank" style="text-decoration: none;">SNMTC -
                                    snmtc.in</a>
                            </div>

                            <div class="col-md-6">
                                {{-- <div class="text-md-end footer-links d-none d-md-block">
                                    <a href="javascript: void(0);">About</a>
                                    <a href="javascript: void(0);">Support</a>
                                    <a href="javascript: void(0);">Contact Us</a>
                                </div> --}}
                            </div>
                        </div>
                    </div>
                </footer>
                <!-- end Footer -->

                </div>

                <!-- ============================================================== -->
                <!-- End Page content -->
                <!-- ============================================================== -->

                </div>
                <!-- END wrapper -->

                <!-- Theme Settings -->
                <div class="offcanvas offcanvas-end" tabindex="-1" id="theme-settings-offcanvas">
                    <div class="d-flex align-items-center bg-primary p-3 offcanvas-header">
                        <h5 class="text-white m-0">Theme Settings</h5>
                        <button type="button" class="btn-close btn-close-white ms-auto" data-bs-dismiss="offcanvas"
                            aria-label="Close"></button>
                    </div>

                    <div class="offcanvas-body p-0">
                        <div data-simplebar class="h-100">
                            <div class="card border-0 mb-0 p-3">
                                <div class="alert alert-warning" role="alert">
                                    <strong>Customize </strong> the overall color scheme, sidebar menu, etc.
                                </div>

                                <h5 class="my-3 fs-16 fw-bold">Color Scheme</h5>

                                <div class="d-flex flex-column gap-2">
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" name="data-bs-theme"
                                            id="layout-color-light" value="light">
                                        <label class="form-check-label" for="layout-color-light">Light</label>
                                    </div>

                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" name="data-bs-theme"
                                            id="layout-color-dark" value="dark">
                                        <label class="form-check-label" for="layout-color-dark">Dark</label>
                                    </div>
                                </div>

                                <div>
                                    <h5 class="my-3 fs-16 fw-bold">Menu Color</h5>

                                    <div class="d-flex flex-column gap-2">
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" type="checkbox" name="data-menu-color"
                                                id="leftbar-color-light" value="light">
                                            <label class="form-check-label" for="leftbar-color-light">Light</label>
                                        </div>

                                        <div class="form-check form-switch">
                                            <input class="form-check-input" type="checkbox" name="data-menu-color"
                                                id="leftbar-color-dark" value="dark">
                                            <label class="form-check-label" for="leftbar-color-dark">Dark</label>
                                        </div>
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" type="checkbox" name="data-menu-color"
                                                id="leftbar-color-brand" value="brand">
                                            <label class="form-check-label" for="leftbar-color-brand">Brand</label>
                                        </div>
                                    </div>
                                </div>

                                <div id="sidebar-size">
                                    <h5 class="my-3 fs-16 fw-bold">Sidebar Size</h5>

                                    <div class="d-flex flex-column gap-2">
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" type="checkbox" name="data-sidenav-size"
                                                id="leftbar-size-default" value="default">
                                            <label class="form-check-label" for="leftbar-size-default">Default</label>
                                        </div>

                                        <div class="form-check form-switch">
                                            <input class="form-check-input" type="checkbox" name="data-sidenav-size"
                                                id="leftbar-size-compact" value="compact">
                                            <label class="form-check-label" for="leftbar-size-compact">Compact</label>
                                        </div>

                                        <div class="form-check form-switch">
                                            <input class="form-check-input" type="checkbox" name="data-sidenav-size"
                                                id="leftbar-size-small" value="condensed">
                                            <label class="form-check-label" for="leftbar-size-small">Condensed</label>
                                        </div>

                                        <div class="form-check form-switch">
                                            <input class="form-check-input" type="checkbox" name="data-sidenav-size"
                                                id="leftbar-size-full" value="full">
                                            <label class="form-check-label" for="leftbar-size-full">Full
                                                Layout</label>
                                        </div>

                                        <div class="form-check form-switch">
                                            <input class="form-check-input" type="checkbox" name="data-sidenav-size"
                                                id="leftbar-size-fullscreen" value="fullscreen">
                                            <label class="form-check-label" for="leftbar-size-fullscreen">Fullscreen
                                                Layout</label>
                                        </div>
                                    </div>
                                </div>

                                <div id="layout-position">
                                    <h5 class="my-3 fs-16 fw-bold">Layout Position</h5>

                                    <div class="btn-group checkbox" role="group">
                                        <input type="radio" class="btn-check" name="data-layout-position"
                                            id="layout-position-fixed" value="fixed">
                                        <label class="btn btn-soft-primary w-sm"
                                            for="layout-position-fixed">Fixed</label>

                                        <input type="radio" class="btn-check" name="data-layout-position"
                                            id="layout-position-scrollable" value="scrollable">
                                        <label class="btn btn-soft-primary w-sm ms-0"
                                            for="layout-position-scrollable">Scrollable</label>
                                    </div>
                                </div>

                                <div id="sidebar-user">
                                    <div class="d-flex justify-content-between align-items-center mt-3">
                                        <label class="fs-16 fw-bold m-0" for="sidebaruser-check">Sidebar User
                                            Info</label>
                                        <div class="form-check form-switch">
                                            <input type="checkbox" class="form-check-input" name="sidebar-user"
                                                id="sidebaruser-check">
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>

                    </div>
                    <div class="offcanvas-footer border-top p-3 text-center">
                        <div class="row">
                            <div class="col-6">
                                <button type="button" class="btn btn-light w-100" id="reset-layout">Reset</button>
                            </div>
                            <div class="col-6">
                                <a href="#" role="button" class="btn btn-primary w-100">Buy Now</a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Vendor js -->
                <!-- Vendor JS -->
                <script src="{{ asset('admin_assets/assets/js/vendor.min.js') }}"></script>

                <!-- Daterangepicker JS -->
                <script src="{{ asset('admin_assets/assets/vendor/daterangepicker/moment.min.js') }}"></script>
                <script src="{{ asset('admin_assets/assets/vendor/daterangepicker/daterangepicker.js') }}"></script>

                <!-- Apex Charts JS -->
                <script src="{{ asset('admin_assets/assets/vendor/apexcharts/apexcharts.min.js') }}"></script>

                <!-- Vector Map JS -->
                <script src="{{ asset('admin_assets/assets/vendor/admin-resources/jquery.vectormap/jquery-jvectormap-1.2.2.min.js') }}">
                </script>
                <script
                    src="{{ asset('admin_assets/assets/vendor/admin-resources/jquery.vectormap/maps/jquery-jvectormap-world-mill-en.js') }}">
                </script>

                <!-- Dashboard App JS -->
                <script src="{{ asset('admin_assets/assets/js/pages/demo.dashboard.js') }}"></script>

                <!-- App JS -->
                <script src="{{ asset('admin_assets/assets/js/app.min.js') }}"></script>

                <!-- Summernote JS -->
                <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.20/dist/summernote-lite.min.js"></script>

                <!-- Summernote JS -->
                <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.20/dist/summernote-lite.min.js"></script>



                </body>

                <!-- Mirrored from coderthemes.com/powerx/layouts/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 27 May 2025 10:16:00 GMT -->

                </html>
