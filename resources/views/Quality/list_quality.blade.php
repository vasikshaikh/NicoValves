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
                            <h4 class="mb-0">Quality List</h4>

                            <!-- Show X entries -->
                            <form id="lengthForm" method="GET" action="{{ route('listQuality') }}"
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

                        <!-- Live search + Add Quality -->
                        <div class="d-flex align-items-center gap-2">
                            <form id="searchForm" method="GET" action="{{ route('listQuality') }}" class="d-flex">
                                <input type="hidden" name="length" value="{{ request('length', 10) }}">
                                <input type="text" name="q" value="{{ request('q') }}"
                                    class="form-control form-control-sm" placeholder="Search by title or description..."
                                    id="liveSearchInput">
                            </form>

                            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#qualityModal"
                                data-mode="add">
                                Add Quality
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
                                    @forelse($data as $index => $item)
                                        <tr>
                                            <td>{{ $data->firstItem() + $index }}</td>
                                            <td style="vertical-align: middle;">{{ $item->title }}</td>

                                            {{-- DESCRIPTION (See more/less) --}}
                                            @php
                                                $fullHtml = $item->description ?? '';
                                                $plain = strip_tags($fullHtml);
                                                $short = \Illuminate\Support\Str::words($plain, 30, '...');
                                                $isLong = mb_strlen($plain) > mb_strlen($short);
                                            @endphp
                                            <td style="max-width:420px; word-break:break-word; text-align:left;">
                                                <div class="about-desc" data-id="quality-{{ $item->id }}">
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

                                            {{-- IMAGES one-per-line, no filename --}}
                                            <td>
                                                @if (!empty($item->image) && is_array($item->image) && count($item->image))
                                                    <div class="d-flex flex-column align-items-start">
                                                        @foreach ($item->image as $img)
                                                            <div class="about-thumb"
                                                                style="background:#f5f7fa; padding:6px; border-radius:6px; margin:4px 0; width:120px;">
                                                                <img src="{{ asset('QualityImage/' . $img) }}"
                                                                    alt="quality image"
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
                                                        data-bs-target="#qualityModal" data-mode="edit"
                                                        data-id="{{ $item->id }}">
                                                        ✏️ Edit
                                                    </button>
                                                    <a href="{{ route('deleteQuality', $item->id) }}"
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
                                @if ($data->total() > 0)
                                    Showing {{ $data->firstItem() }} to {{ $data->lastItem() }} of {{ $data->total() }}
                                    entries
                                @else
                                    Showing 0 to 0 of 0 entries
                                @endif
                            </div>
                            <div>
                                <nav>
                                    <ul class="pagination mb-0 justify-content-center">
                                        @for ($i = 1; $i <= $data->lastPage(); $i++)
                                            <li class="page-item {{ $data->currentPage() == $i ? 'active' : '' }}">
                                                <a class="page-link" href="{{ $data->url($i) }}">{{ $i }}</a>
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

        <!-- Add/Edit Quality Modal -->
        <div class="modal fade" id="qualityModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <form id="qualityForm" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="quality_id" id="quality_id">

                        <div class="modal-header">
                            <h5 class="modal-title" id="qualityModalTitle">Add Quality</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>

                        <div class="modal-body">

                            <!-- Title -->
                            <div class="mb-3">
                                <label class="form-label">Title</label>
                                <input type="text" name="title" id="quality_title" class="form-control" required>
                            </div>

                            <!-- Description with Summernote -->
                            <div class="mb-3">
                                <label class="form-label">Description</label>
                                <textarea name="description" id="quality_description" class="form-control"></textarea>
                            </div>

                            <!-- Images -->
                            <div class="mb-3">
                                <label class="form-label">Images (Optional) (Max 5)</label>
                                <div id="quality_image_wrapper" class="d-flex flex-wrap gap-2">
                                    <div class="d-flex align-items-center gap-1 mb-2">
                                        <input type="file" name="images[]" class="form-control form-control-sm"
                                            accept="image/*">
                                        <button type="button" class="btn btn-danger btn-sm remove-quality-image-btn"
                                            title="Remove">&times;</button>
                                    </div>
                                </div>
                                <button type="button" id="addQualityImageBtn" class="btn btn-sm btn-secondary mt-2">Add
                                    Image</button>

                                <!-- Existing images preview with remove checkboxes -->
                                <div id="current_quality_images" class="mt-3 d-flex flex-wrap gap-2"></div>
                            </div>

                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary" id="qualityFormSubmitBtn">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

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

        <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.20/dist/summernote.min.js"></script>

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                // Summernote init
                $('#quality_description').summernote({
                    placeholder: 'Enter description here...',
                    tabsize: 2,
                    height: 150,
                    toolbar: [
                        ['style', ['bold', 'italic', 'underline', 'clear']],
                        ['para', ['ul', 'ol', 'paragraph']],
                        ['insert', ['link', 'picture']]
                    ]
                });

                const qualityModalEl = document.getElementById('qualityModal');
                const qualityForm = document.getElementById('qualityForm');
                const imageWrapper = document.getElementById('quality_image_wrapper');
                const addQualityImageBtn = document.getElementById('addQualityImageBtn');
                const currentImagesDiv = document.getElementById('current_quality_images');

                function clearRemoveInputs() {
                    qualityForm.querySelectorAll('input[name="remove_images[]"]').forEach(n => n.remove());
                }

                qualityModalEl.addEventListener('show.bs.modal', function(event) {
                    const button = event.relatedTarget;
                    const mode = button.getAttribute('data-mode');

                    // reset
                    qualityForm.reset();
                    clearRemoveInputs();
                    currentImagesDiv.innerHTML = '';
                    imageWrapper.innerHTML = `<div class="d-flex align-items-center gap-1 mb-2">
            <input type="file" name="images[]" class="form-control form-control-sm" accept="image/*">
            <button type="button" class="btn btn-danger btn-sm remove-quality-image-btn" title="Remove">&times;</button>
        </div>`;
                    $('#quality_description').summernote('code', '');
                    document.getElementById('qualityModalTitle').textContent = 'Add Quality';
                    qualityForm.action = "{{ route('saveQuality') }}";
                    document.getElementById('quality_id').value = '';

                    if (mode === 'edit') {
                        const id = button.getAttribute('data-id');
                        document.getElementById('qualityModalTitle').textContent = 'Edit Quality';
                        qualityForm.action = "{{ route('updateQuality', ['id' => ':id']) }}".replace(':id',
                        id);
                        document.getElementById('quality_id').value = id;

                        fetch("{{ route('editQuality', ['id' => ':id']) }}".replace(':id', id))
                            .then(res => {
                                if (!res.ok) throw new Error('Network response was not ok');
                                return res.json();
                            })
                            .then(data => {
                                document.getElementById('quality_title').value = data.title || '';
                                $('#quality_description').summernote('code', data.description || '');

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
                                    <img src="{{ asset('QualityImage') }}/${fname}" width="120" style="object-fit:cover; display:block; margin-bottom:6px;">
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
                addQualityImageBtn.addEventListener('click', function() {
                    if (imageWrapper.querySelectorAll('input[name="images[]"]').length >= 5) {
                        alert('Maximum 5 images allowed.');
                        return;
                    }
                    const div = document.createElement('div');
                    div.classList.add('d-flex', 'align-items-center', 'gap-1', 'mb-2');
                    div.innerHTML =
                        `<input type="file" name="images[]" class="form-control form-control-sm" accept="image/*">
                        <button type="button" class="btn btn-danger btn-sm remove-quality-image-btn" title="Remove">&times;</button>`;
                    imageWrapper.appendChild(div);
                    div.querySelector('.remove-quality-image-btn').addEventListener('click', function() {
                        div.remove();
                    });
                });

                // delegate remove buttons
                imageWrapper.addEventListener('click', function(e) {
                    if (e.target && e.target.classList.contains('remove-quality-image-btn')) {
                        e.target.parentElement.remove();
                    }
                });

                // existing images remove checkbox handling
                currentImagesDiv.addEventListener('change', function(e) {
                    if (e.target && e.target.classList.contains('remove-existing-image')) {
                        const fname = e.target.getAttribute('data-name');
                        qualityForm.querySelectorAll('input[name="remove_images[]"]').forEach(n => {
                            if (n.value === fname) n.remove();
                        });

                        if (e.target.checked) {
                            const h = document.createElement('input');
                            h.type = 'hidden';
                            h.name = 'remove_images[]';
                            h.value = fname;
                            qualityForm.appendChild(h);
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

                // Auto-dismiss alerts
                ['successAlert', 'errorAlert'].forEach(function(id) {
                    const el = document.getElementById(id);
                    if (el) setTimeout(() => new bootstrap.Alert(el).close(), 3000);
                });

                // See more / See less toggle
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
