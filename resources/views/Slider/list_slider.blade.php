@extends('Admin.Layouts.main')

@section('main-container')
    <div class="content-page">
        <div class="content">
            <div class="container-fluid">

                <!-- Full-width flash messages -->
                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show w-100" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                @if (session('error'))
                    <div class="alert alert-danger alert-dismissible fade show w-100" role="alert">
                        {{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
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

                <div class="card mt-3">
                    <div class="card-header">
                        <div class="d-flex align-items-center justify-content-between flex-wrap gap-2">
                            <div class="d-flex align-items-center gap-3">
                                <!-- Title -->
                                <h4 class="mb-0">Slider List</h4>

                                <!-- Show (per-page) moved next to title -->
                                <form id="lengthForm" method="GET" action="{{ route('listSlider') }}"
                                    class="d-flex align-items-center gap-2">
                                    <input type="hidden" name="q" value="{{ request('q') }}">
                                    <label class="mb-0" style="display:flex;align-items:center">Show
                                        <select name="length" onchange="document.getElementById('lengthForm').submit()"
                                            class="form-select form-select-sm ms-1" style="width:80px;">
                                            <option value="10" {{ request('length', 10) == 10 ? 'selected' : '' }}>10
                                            </option>
                                            <option value="25" {{ request('length') == 25 ? 'selected' : '' }}>25
                                            </option>
                                            <option value="50" {{ request('length') == 50 ? 'selected' : '' }}>50
                                            </option>
                                            <option value="100" {{ request('length') == 100 ? 'selected' : '' }}>100
                                            </option>
                                        </select>
                                    </label>
                                </form>
                            </div>

                            <!-- Live Search (no button) + Add Button -->
                            <div class="d-flex align-items-center gap-2">
                                <form id="searchForm" method="GET" action="{{ route('listSlider') }}" class="d-flex">
                                    <input type="hidden" name="length" value="{{ request('length', 10) }}">
                                    <input id="liveSearchInput" type="text" name="q" value="{{ request('q') }}"
                                        class="form-control form-control-sm" placeholder="Type to search title...">
                                </form>

                                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#sliderModal"
                                    data-mode="add" data-route="{{ route('saveSlider') }}">
                                    Add Slider
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        <!-- Table -->
                        <div class="table-responsive">
                            <table class="table table-striped text-center align-middle">
                                <thead class="table-dark">
                                    <tr>
                                        <th>Sr.No</th>
                                        <th>Title</th>
                                        <th>Image</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($slider_data as $index => $slider)
                                        <tr id="slider-row-{{ $slider->id }}">
                                            <td>{{ $slider_data->firstItem() + $index }}</td>
                                            <td>{{ $slider->title }}</td>
                                            <td>
                                                @if ($slider->slider_image)
                                                    <img src="{{ asset('SliderImage/' . $slider->slider_image) }}"
                                                        width="120" alt="Slider Image">
                                                @else
                                                    No Image
                                                @endif
                                            </td>
                                            <td>
                                                <button class="btn btn-sm btn-primary editBtn" data-bs-toggle="modal"
                                                    data-bs-target="#sliderModal" data-mode="edit"
                                                    data-id="{{ $slider->id }}" data-title="{{ $slider->title }}">
                                                    ✏️ Edit
                                                </button>

                                                <a href="{{ route('deleteSlider', $slider->id) }}"
                                                    onclick="return confirm('Are you sure you want to delete this slider?')"
                                                    class="btn btn-sm btn-danger">🗑️ Delete</a>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="4">No sliders found.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>

                        <!-- Showing X to Y of Z entries AND numeric pagination (centered) -->
                        <div class="d-flex flex-column flex-md-row justify-content-between align-items-center mt-3 gap-2">
                            <div class="text-muted">
                                @if ($slider_data->total() > 0)
                                    Showing {{ $slider_data->firstItem() }} to {{ $slider_data->lastItem() }} of
                                    {{ $slider_data->total() }} entries
                                @else
                                    Showing 0 to 0 of 0 entries
                                @endif
                            </div>

                            <div>
                                <nav>
                                    <ul class="pagination mb-0 justify-content-center">
                                        {{-- Simple numeric pagination --}}
                                        @for ($i = 1; $i <= $slider_data->lastPage(); $i++)
                                            <li class="page-item {{ $slider_data->currentPage() == $i ? 'active' : '' }}">
                                                <a class="page-link"
                                                    href="{{ $slider_data->url($i) }}">{{ $i }}</a>
                                            </li>
                                        @endfor
                                    </ul>
                                </nav>
                            </div>
                        </div>

                    </div>
                </div>

            </div>
        </div>


        <!-- Add/Edit Slider Modal (same as before) -->
        <div class="modal fade" id="sliderModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-lg"> <!-- wider modal -->
                <div class="modal-content">
                    <form id="sliderForm" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="modal-header">
                            <h5 class="modal-title" id="sliderModalTitle">Add Slider</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>

                        <div class="modal-body">
                            <input type="hidden" name="slider_id" id="slider_id">

                            <div class="mb-3">
                                <label class="form-label">Title</label>
                                <input type="text" name="title" id="title" class="form-control" required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Slider Image</label>
                                <input type="file" name="slider_image" id="slider_image" class="form-control">
                                <div class="mt-2">
                                    <img id="current_image" src="" width="140" class="d-none"
                                        alt="Current Image">
                                </div>
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary" id="sliderFormSubmitBtn">Add Slider</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                var sliderModal = document.getElementById('sliderModal');

                sliderModal.addEventListener('show.bs.modal', function(event) {
                    var button = event.relatedTarget;
                    var mode = button.getAttribute('data-mode');

                    var modalTitle = sliderModal.querySelector('#sliderModalTitle');
                    var submitBtn = sliderModal.querySelector('#sliderFormSubmitBtn');
                    var form = sliderModal.querySelector('#sliderForm');
                    var titleInput = sliderModal.querySelector('#title');
                    var sliderIdInput = sliderModal.querySelector('#slider_id');
                    var currentImage = sliderModal.querySelector('#current_image');

                    // Reset
                    titleInput.value = '';
                    sliderIdInput.value = '';
                    currentImage.src = '';
                    currentImage.classList.add('d-none');

                    if (mode === 'add') {
                        modalTitle.textContent = 'Add Slider';
                        submitBtn.textContent = 'Add Slider';
                        form.action = "{{ route('saveSlider') }}";
                        sliderModal.querySelector('#slider_image').required = true;
                    } else if (mode === 'edit') {
                        modalTitle.textContent = 'Edit Slider';
                        submitBtn.textContent = 'Update Slider';
                        var sliderId = button.getAttribute('data-id');
                        var sliderTitle = button.getAttribute('data-title');

                        sliderIdInput.value = sliderId;
                        titleInput.value = sliderTitle;
                        form.action = "{{ url('slider/update') }}/" + sliderId;
                        sliderModal.querySelector('#slider_image').required = false;

                        // load current image via AJAX (optional)
                        fetch("{{ url('slider/edit') }}/" + sliderId)
                            .then(res => res.json())
                            .then(data => {
                                if (data.slider_image) {
                                    currentImage.src = "{{ asset('SliderImage') }}/" + data.slider_image;
                                    currentImage.classList.remove('d-none');
                                }
                            }).catch(() => {
                                /* ignore */
                            });
                    }
                });

                // --- Live search: submit form on input with debounce ---
                const searchInput = document.getElementById('liveSearchInput');
                let debounceTimer = null;
                if (searchInput) {
                    searchInput.addEventListener('input', function() {
                        clearTimeout(debounceTimer);
                        debounceTimer = setTimeout(function() {
                            // submit search form; preserves length hidden input
                            document.getElementById('searchForm').submit();
                        }, 400); // 400ms debounce
                    });
                }
            });

            document.addEventListener('DOMContentLoaded', function() {
                // Auto-dismiss success alert after 3 seconds
                const successAlert = document.getElementById('successAlert');
                if (successAlert) {
                    setTimeout(function() {
                        const alert = new bootstrap.Alert(successAlert);
                        alert.close();
                    }, 3000);
                }

                // Auto-dismiss error alert after 3 seconds
                const errorAlert = document.getElementById('errorAlert');
                if (errorAlert) {
                    setTimeout(function() {
                        const alert = new bootstrap.Alert(errorAlert);
                        alert.close();
                    }, 3000);
                }
            });
        </script>
    @endsection
