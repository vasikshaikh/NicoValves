@extends('Admin.Layouts.main')

@section('main-container')
    <div class="content-page">
        <div class="content">
            <div class="container-fluid">

                <!-- Flash messages -->
                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show w-100" role="alert" id="successAlert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif
                @if (session('error'))
                    <div class="alert alert-danger alert-dismissible fade show w-100" role="alert" id="errorAlert">
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
                    <div class="card-header d-flex justify-content-between align-items-center flex-wrap gap-2">
                        <div class="d-flex align-items-center gap-3">
                            <h4 class="mb-0">About List</h4>

                            <!-- Show X entries -->
                            <form id="lengthForm" method="GET" action="{{ route('listAbout') }}"
                                class="d-flex align-items-center gap-2">
                                <input type="hidden" name="q" value="{{ request('q') }}">
                                <label class="mb-0" style="display:flex;align-items:center">
                                    Show
                                    <select name="length" onchange="document.getElementById('lengthForm').submit()"
                                        class="form-select form-select-sm ms-1" style="width:80px;">
                                        <option value="10" {{ request('length', 10) == 10 ? 'selected' : '' }}>10
                                        </option>
                                        <option value="25" {{ request('length') == 25 ? 'selected' : '' }}>25</option>
                                        <option value="50" {{ request('length') == 50 ? 'selected' : '' }}>50</option>
                                        <option value="100" {{ request('length') == 100 ? 'selected' : '' }}>100</option>
                                    </select>
                                </label>
                            </form>
                        </div>

                        <!-- Live search + Add About -->
                        <div class="d-flex align-items-center gap-2">
                            <form id="searchForm" method="GET" action="{{ route('listAbout') }}" class="d-flex">
                                <input type="hidden" name="length" value="{{ request('length', 10) }}">
                                <input type="text" name="q" value="{{ request('q') }}"
                                    class="form-control form-control-sm" placeholder="Type to search title..."
                                    id="liveSearchInput">
                            </form>

                            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#aboutModal"
                                data-mode="add">
                                Add About
                            </button>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped text-center align-middle">
                                <thead class="table-dark">
                                    <tr>
                                        <th>Sr.No</th>
                                        <th>Title</th>
                                        <th>Description</th>
                                        <th>Image</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($about_data as $index => $about)
                                        <tr>
                                            <td>{{ $about_data->firstItem() + $index }}</td>

                                            {{-- Title --}}
                                            <td style="max-width:250px; word-break: break-word;">
                                                @php
                                                    $titleWords = explode(' ', strip_tags($about->title));
                                                    $shortTitle = implode(' ', array_slice($titleWords, 0, 10));
                                                    $fullTitle = implode(' ', $titleWords);
                                                @endphp
                                                @if (count($titleWords) > 10)
                                                    <span class="short-text">{{ $shortTitle }}...</span>
                                                    <span class="full-text d-none">{{ $fullTitle }}</span>
                                                    <a href="javascript:void(0);" class="toggle-text"
                                                        style="color:black; cursor:pointer; font-weight:500; text-decoration:underline;">See
                                                        More</a>
                                                @else
                                                    {{ $shortTitle }}
                                                @endif
                                            </td>

                                            {{-- Description --}}
                                            <td style="max-width:400px; word-break: break-word;">
                                                @php
                                                    $descWords = explode(' ', strip_tags($about->description));
                                                    $shortDesc = implode(' ', array_slice($descWords, 0, 20));
                                                    $fullDesc = implode(' ', $descWords);
                                                @endphp
                                                @if (count($descWords) > 20)
                                                    <span class="short-text">{{ $shortDesc }}...</span>
                                                    <span class="full-text d-none">{{ $fullDesc }}</span>
                                                    <a href="javascript:void(0);" class="toggle-text"
                                                        style="color:black; cursor:pointer; font-weight:500; text-decoration:underline;">See
                                                        More</a>
                                                @else
                                                    {{ $shortDesc }}
                                                @endif
                                            </td>

                                            <td>
                                                @if ($about->image)
                                                    <img src="{{ asset('AboutImage/' . $about->image) }}" width="120"
                                                        alt="About Image">
                                                @else
                                                    No Image
                                                @endif
                                            </td>

                                            <td style="white-space: nowrap; vertical-align: middle;">
                                                <button class="btn btn-sm btn-primary editBtn" data-bs-toggle="modal"
                                                    data-bs-target="#aboutModal" data-mode="edit"
                                                    data-id="{{ $about->id }}" data-title="{{ $about->title }}">
                                                    ✏️ Edit
                                                </button>
                                                <a href="{{ route('deleteAbout', $about->id) }}"
                                                    class="btn btn-sm btn-danger"
                                                    onclick="return confirm('Are you sure you want to delete this record?')">🗑️
                                                    Delete</a>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="5">No records found.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>

                        <!-- Pagination -->
                        <div class="d-flex flex-column flex-md-row justify-content-between align-items-center mt-3 gap-2">
                            <div class="text-muted">
                                @if ($about_data->total() > 0)
                                    Showing {{ $about_data->firstItem() }} to {{ $about_data->lastItem() }} of
                                    {{ $about_data->total() }} entries
                                @else
                                    Showing 0 to 0 of 0 entries
                                @endif
                            </div>
                            <div>
                                <nav>
                                    <ul class="pagination mb-0 justify-content-center">
                                        @for ($i = 1; $i <= $about_data->lastPage(); $i++)
                                            <li class="page-item {{ $about_data->currentPage() == $i ? 'active' : '' }}">
                                                <a class="page-link"
                                                    href="{{ $about_data->url($i) }}">{{ $i }}</a>
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


        <!-- Add/Edit About Modal -->
        <div class="modal fade" id="aboutModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <form id="aboutForm" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="about_id" id="about_id">

                        <div class="modal-header">
                            <h5 class="modal-title" id="aboutModalTitle">Add About</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>

                        <div class="modal-body">
                            <div class="mb-3">
                                <label class="form-label">Title</label>
                                <input type="text" name="title" id="title" class="form-control" required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Description</label>
                                <textarea name="description" id="about_description" class="form-control"></textarea>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">About Image (optional)</label>
                                <input type="file" name="image" id="about_image" class="form-control">
                                <div class="mt-2">
                                    <img id="current_image" src="" width="140" class="d-none"
                                        alt="Current Image">
                                </div>
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary" id="aboutFormSubmitBtn">Add About</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Summernote -->
        <link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.20/summernote-lite.min.css" rel="stylesheet">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.20/summernote-lite.min.js"></script>

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                // Summernote
                $('#about_description').summernote({
                    height: 150
                });

                // Modal Add/Edit logic (same as your existing code)
                var aboutModal = document.getElementById('aboutModal');
                var aboutForm = document.getElementById('aboutForm');

                aboutModal.addEventListener('show.bs.modal', function(event) {
                    var button = event.relatedTarget;
                    var mode = button.getAttribute('data-mode');

                    var modalTitle = aboutModal.querySelector('#aboutModalTitle');
                    var submitBtn = aboutModal.querySelector('#aboutFormSubmitBtn');
                    var titleInput = aboutModal.querySelector('#title');
                    var aboutIdInput = aboutModal.querySelector('#about_id');
                    var currentImage = aboutModal.querySelector('#current_image');
                    var aboutImageInput = aboutModal.querySelector('#about_image');

                    // Reset
                    titleInput.value = '';
                    aboutIdInput.value = '';
                    currentImage.src = '';
                    currentImage.classList.add('d-none');
                    aboutImageInput.value = '';
                    $('#about_description').summernote('code', '');

                    if (mode === 'add') {
                        modalTitle.textContent = 'Add About';
                        submitBtn.textContent = 'Add About';
                        aboutForm.action = "{{ route('saveAbout') }}";
                    } else if (mode === 'edit') {
                        modalTitle.textContent = 'Edit About';
                        submitBtn.textContent = 'Update About';
                        var aboutId = button.getAttribute('data-id');
                        aboutIdInput.value = aboutId;
                        titleInput.value = button.getAttribute('data-title');
                        aboutForm.action = "{{ route('updateAbout', ['id' => ':id']) }}".replace(':id',
                            aboutId);

                        fetch("{{ route('editAbout', ['id' => ':id']) }}".replace(':id', aboutId))
                            .then(res => res.json())
                            .then(data => {
                                $('#about_description').summernote('code', data.description || '');
                                if (data.image) {
                                    currentImage.src = "{{ asset('AboutImage') }}/" + data.image;
                                    currentImage.classList.remove('d-none');
                                }
                            }).catch(() => {});
                    }
                });

                // See More / See Less toggle
                document.querySelectorAll('.toggle-text').forEach(function(link) {
                    link.addEventListener('click', function() {
                        var td = link.closest('td');
                        var shortText = td.querySelector('.short-text');
                        var fullText = td.querySelector('.full-text');

                        if (shortText.classList.contains('d-none')) {
                            shortText.classList.remove('d-none');
                            fullText.classList.add('d-none');
                            link.textContent = 'See More';
                        } else {
                            shortText.classList.add('d-none');
                            fullText.classList.remove('d-none');
                            link.textContent = 'See Less';
                        }
                    });
                });

                // Auto-dismiss alerts after 3 seconds
                ['successAlert', 'errorAlert'].forEach(function(id) {
                    var alert = document.getElementById(id);
                    if (alert) {
                        setTimeout(function() {
                            var bsAlert = new bootstrap.Alert(alert);
                            bsAlert.close();
                        }, 3000);
                    }
                });

                // Live search with debounce
                const searchInput = document.getElementById('liveSearchInput');
                let debounceTimer = null;
                if (searchInput) {
                    searchInput.addEventListener('input', function() {
                        clearTimeout(debounceTimer);
                        debounceTimer = setTimeout(function() {
                            document.getElementById('searchForm').submit();
                        }, 400);
                    });
                }
            });
        </script>
    @endsection
