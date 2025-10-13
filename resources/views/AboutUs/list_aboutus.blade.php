@extends('Admin.Layouts.main')

@section('main-container')
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.20/dist/summernote.min.css" rel="stylesheet">

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
                        <div class="d-flex align-items-center gap-2">
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
                                    class="form-control form-control-sm" placeholder="Search by title or description..."
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
                                        <th>Images</th>
                                        <th style="width:160px">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($about_data as $index => $about)
                                        <tr>
                                            <td>{{ $about_data->firstItem() + $index }}</td>
                                            <td style="vertical-align: middle;">{{ $about->title }}</td>

                                            {{-- DESCRIPTION with See more / See less (approx 25-30 words) --}}
                                            @php
                                                $fullHtml = $about->description ?? '';
                                                $plain = strip_tags($fullHtml);
                                                $short = \Illuminate\Support\Str::words($plain, 30, '...');
                                                $isLong = mb_strlen($plain) > mb_strlen($short);
                                            @endphp
                                            <td style="max-width:420px; word-break:break-word; text-align:left;">
                                                <div class="about-desc" data-id="about-{{ $about->id }}">
                                                    <div class="short-text">
                                                        {!! nl2br(e($short)) !!}
                                                        @if ($isLong)
                                                            <a href="#" class="toggle-desc ms-2"
                                                                data-action="expand">See more</a>
                                                        @endif
                                                    </div>

                                                    <div class="full-text d-none">
                                                        {!! $fullHtml !!}
                                                        @if ($isLong)
                                                            <div><a href="#" class="toggle-desc"
                                                                    data-action="collapse">See less</a></div>
                                                        @endif
                                                    </div>
                                                </div>
                                            </td>

                                            {{-- IMAGES: one per line, no filename --}}
                                            <td>
                                                @if (!empty($about->image) && is_array($about->image) && count($about->image))
                                                    <div class="d-flex flex-column align-items-start">
                                                        @foreach ($about->image as $img)
                                                            <div class="about-thumb"
                                                                style="background:#f5f7fa; padding:6px; border-radius:6px; margin:4px 0; width:120px;">
                                                                <img src="{{ asset('AboutImage/' . $img) }}"
                                                                    alt="about image"
                                                                    style="width:100%; height:auto; object-fit:cover; display:block;">
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                @else
                                                    -
                                                @endif
                                            </td>

                                            <td style="white-space: nowrap;">
                                                <div
                                                    style="display:flex; gap:6px; justify-content:center; align-items:center;">
                                                    <button class="btn btn-sm btn-primary action-btn" data-bs-toggle="modal"
                                                        data-bs-target="#aboutModal" data-mode="edit"
                                                        data-id="{{ $about->id }}">
                                                        ✏️ Edit
                                                    </button>
                                                    <a href="{{ route('deleteAbout', $about->id) }}"
                                                        class="btn btn-sm btn-danger action-btn"
                                                        onclick="return confirm('Are you sure?')">🗑️ Delete</a>
                                                </div>
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

                        <!-- Pagination + showing X to Y of Z -->
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
                {{-- Note: form action set dynamically in JS. For new -> route('saveAboutUs'), for edit -> route('updateAboutUs', id) --}}
                <form id="aboutForm" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="about_id" id="about_id">
                    {{-- dynamic remove_images[] inputs will be appended to this form by JS when user checks remove --}}
                    <div class="modal-header">
                        <h5 class="modal-title" id="aboutModalTitle">Add About Us</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>

                    <div class="modal-body">

                        <!-- Title -->
                        <div class="mb-3">
                            <label class="form-label">Title</label>
                            <input type="text" name="title" id="about_title" class="form-control" required>
                        </div>

                        <!-- Description with Summernote -->
                        <div class="mb-3">
                            <label class="form-label">Description</label>
                            <textarea name="description" id="about_description" class="form-control"></textarea>
                        </div>

                        <!-- Images -->
                        <div class="mb-3">
                            <label class="form-label">Images (Optional) (Max 5)</label>
                            <div id="about_image_wrapper" class="d-flex flex-wrap gap-2">
                                <div class="d-flex align-items-center gap-1 mb-2">
                                    <input type="file" name="images[]" class="form-control form-control-sm"
                                        accept="image/*">
                                    <button type="button" class="btn btn-danger btn-sm remove-about-image-btn"
                                        title="Remove">&times;</button>
                                </div>
                            </div>
                            <button type="button" id="addAboutImageBtn" class="btn btn-sm btn-secondary mt-2">Add
                                Image</button>

                            <!-- Existing images preview with remove checkboxes (populated on edit) -->
                            <div id="current_about_images" class="mt-3 d-flex flex-wrap gap-2"></div>
                            {{-- <small class="form-text text-muted">If you remove images they will be deleted from server on update.</small> --}}
                        </div>

                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" id="aboutFormSubmitBtn">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- inline CSS -->
    <style>
        .toggle-text {
            color: black;
            cursor: pointer;
            font-weight: 500;
            text-decoration: underline;
        }

        .action-btn {
            white-space: nowrap;
        }

        .about-desc .toggle-desc {
            font-weight: 600;
            text-decoration: underline;
            cursor: pointer;
            color: inherit;
            font-size: .9rem;
        }

        .d-none {
            display: none !important;
        }
    </style>

    <!-- Summernote -->
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.20/dist/summernote.min.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Summernote init
            $('#about_description').summernote({
                placeholder: 'Enter description here...',
                tabsize: 2,
                height: 150,
                toolbar: [
                    ['style', ['bold', 'italic', 'underline', 'clear']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['insert', ['link', 'picture']]
                ]
            });

            const aboutModalEl = document.getElementById('aboutModal');
            const aboutForm = document.getElementById('aboutForm');
            const imageWrapper = document.getElementById('about_image_wrapper');
            const addAboutImageBtn = document.getElementById('addAboutImageBtn');
            const currentImagesDiv = document.getElementById('current_about_images');

            // Helper to clear dynamic remove inputs
            function clearRemoveInputs() {
                aboutForm.querySelectorAll('input[name="remove_images[]"]').forEach(n => n.remove());
            }

            // Modal show handler (add / edit)
            aboutModalEl.addEventListener('show.bs.modal', function(event) {
                const button = event.relatedTarget;
                const mode = button.getAttribute('data-mode');

                // reset form state
                aboutForm.reset();
                clearRemoveInputs();
                currentImagesDiv.innerHTML = '';
                imageWrapper.innerHTML = `<div class="d-flex align-items-center gap-1 mb-2">
            <input type="file" name="images[]" class="form-control form-control-sm" accept="image/*">
            <button type="button" class="btn btn-danger btn-sm remove-about-image-btn" title="Remove">&times;</button>
        </div>`;
                $('#about_description').summernote('code', '');
                document.getElementById('aboutModalTitle').textContent = 'Add About Us';
                aboutForm.action = "{{ route('saveAboutUs') }}";
                document.getElementById('about_id').value = '';

                if (mode === 'edit') {
                    const id = button.getAttribute('data-id');
                    document.getElementById('aboutModalTitle').textContent = 'Edit About Us';
                    aboutForm.action = "{{ route('updateAboutUs', ['id' => ':id']) }}".replace(':id', id);
                    document.getElementById('about_id').value = id;

                    // fetch existing data
                    fetch("{{ route('editAboutUs', ['id' => ':id']) }}".replace(':id', id))
                        .then(res => {
                            if (!res.ok) throw new Error('Network response was not ok');
                            return res.json();
                        })
                        .then(data => {
                            document.getElementById('about_title').value = data.title || '';
                            $('#about_description').summernote('code', data.description || '');

                            // show existing images (without filename text) and provide Remove checkbox
                            currentImagesDiv.innerHTML = '';
                            if (Array.isArray(data.image) && data.image.length) {
                                data.image.forEach(function(fname, idx) {
                                    const wrapper = document.createElement('div');
                                    wrapper.style.display = 'inline-block';
                                    wrapper.style.background = '#f5f7fa';
                                    wrapper.style.padding = '6px';
                                    wrapper.style.borderRadius = '6px';
                                    wrapper.style.margin = '4px';
                                    wrapper.style.textAlign = 'center';
                                    wrapper.innerHTML = `
                                <div style="width:120px;">
                                    <img src="{{ asset('AboutImage') }}/${fname}" width="120" style="object-fit:cover; display:block; margin-bottom:6px;">
                                    <div style="display:flex; gap:6px; align-items:center; justify-content:center;">
                                        <label style="font-size:13px; margin:0;">
                                            <input type="checkbox" class="remove-existing-image" data-name="${fname}"> Remove
                                        </label>
                                    </div>
                                </div>
                            `;
                                    currentImagesDiv.appendChild(wrapper);
                                });
                            }
                        })
                        .catch(err => {
                            console.error('Edit fetch error', err);
                        });
                }
            });

            // Add image input
            addAboutImageBtn.addEventListener('click', function() {
                if (imageWrapper.querySelectorAll('input[name="images[]"]').length >= 5) {
                    alert('Maximum 5 images allowed.');
                    return;
                }
                const div = document.createElement('div');
                div.classList.add('d-flex', 'align-items-center', 'gap-1', 'mb-2');
                div.innerHTML =
                    `<input type="file" name="images[]" class="form-control form-control-sm" accept="image/*">
                        <button type="button" class="btn btn-danger btn-sm remove-about-image-btn" title="Remove">&times;</button>`;
                imageWrapper.appendChild(div);
                div.querySelector('.remove-about-image-btn').addEventListener('click', function() {
                    div.remove();
                });
            });

            // delegate remove image inputs in the wrapper
            imageWrapper.addEventListener('click', function(e) {
                if (e.target && e.target.classList.contains('remove-about-image-btn')) {
                    e.target.parentElement.remove();
                }
            });

            // handle remove-existing-image checkbox changes -> create/remove hidden inputs remove_images[]
            currentImagesDiv.addEventListener('change', function(e) {
                if (e.target && e.target.classList.contains('remove-existing-image')) {
                    const fname = e.target.getAttribute('data-name');
                    // remove any existing hidden for same name
                    aboutForm.querySelectorAll('input[name="remove_images[]"]').forEach(n => {
                        if (n.value === fname) n.remove();
                    });

                    if (e.target.checked) {
                        const h = document.createElement('input');
                        h.type = 'hidden';
                        h.name = 'remove_images[]';
                        h.value = fname;
                        aboutForm.appendChild(h);
                    }
                }
            });

            // Live search debounce
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

            // Auto-dismiss alerts after 3s
            ['successAlert', 'errorAlert'].forEach(function(id) {
                const el = document.getElementById(id);
                if (el) setTimeout(() => new bootstrap.Alert(el).close(), 3000);
            });

            // description toggle (See more / See less)
            document.body.addEventListener('click', function(e) {
                const t = e.target;
                if (t && t.classList && t.classList.contains('toggle-desc')) {
                    e.preventDefault();
                    const wrapper = t.closest('.about-desc');
                    if (!wrapper) return;

                    const shortDiv = wrapper.querySelector('.short-text');
                    const fullDiv = wrapper.querySelector('.full-text');

                    if (t.getAttribute('data-action') === 'expand') {
                        shortDiv.classList.add('d-none');
                        fullDiv.classList.remove('d-none');
                    } else {
                        fullDiv.classList.add('d-none');
                        shortDiv.classList.remove('d-none');
                    }
                }
            });

        });
    </script>
@endsection
