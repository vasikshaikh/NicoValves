@extends('Admin.Layouts.main')

@section('main-container')
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.20/dist/summernote-lite.min.css" rel="stylesheet">

    <div class="content-page">
        <div class="content">
            <div class="container-fluid">

                <!-- Flash Messages -->
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

                <!-- Choose List Card -->
                <div class="card mt-3">
                    <div class="card-header">
                        <div class="d-flex align-items-center justify-content-between flex-wrap gap-2">

                            <!-- Left: Title + Show dropdown -->
                            <div class="d-flex align-items-center gap-3">
                                <h4 class="mb-0">Choose List</h4>

                                <form id="lengthForm" method="GET" action="{{ route('listChoose') }}"
                                    class="d-flex align-items-center gap-2">
                                    <input type="hidden" name="q" value="{{ request('q') }}">
                                    <label class="mb-0" style="display:flex;align-items:center">Show
                                        <select name="length" class="form-select form-select-sm ms-1" style="width:80px;"
                                            onchange="this.form.submit()">
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

                            <!-- Right: Search + Add Choose button -->
                            <div class="d-flex align-items-center gap-2">
                                <form id="searchForm" method="GET" action="{{ route('listChoose') }}" class="d-flex">
                                    <input type="hidden" name="length" value="{{ request('length', 10) }}">
                                    <input type="text" name="q" value="{{ request('q') }}"
                                        class="form-control form-control-sm" placeholder="Search title...">
                                </form>

                                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#chooseModal"
                                    data-mode="add">Add Choose</button>
                            </div>

                        </div>
                    </div>

                    <!-- Table -->
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped text-center align-middle">
                                <thead class="table-dark">
                                    <tr>
                                        <th>Sr.No</th>
                                        <th>Title</th>
                                        <th>Description</th>
                                        <th>Points</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($choose_data as $index => $row)
                                        <tr>
                                            <td>{{ $choose_data->firstItem() + $index }}</td>
                                            <td>{{ $row->title }}</td>
                                            <td>{!! \Illuminate\Support\Str::limit(strip_tags($row->description), 80) !!}</td>
                                            <td style="min-width:220px; text-align:left;">
                                                @if (is_array($row->points_title) && count($row->points_title) > 0)
                                                    @foreach ($row->points_title as $i => $pt)
                                                        <div
                                                            style="display:flex; align-items:center; gap:10px; margin-bottom:5px;">
                                                            <span style="font-weight:500;">{{ $pt }}</span>
                                                            @if (isset($row->points_image[$i]) && $row->points_image[$i])
                                                                <img src="{{ asset('chooseImage/' . $row->points_image[$i]) }}"
                                                                    style="width:40px; height:40px; object-fit:cover; border-radius:4px;">
                                                            @endif
                                                        </div>
                                                    @endforeach
                                                @else
                                                    -
                                                @endif
                                            </td>
                                            <td>
                                                <button class="btn btn-sm btn-primary editBtn" data-bs-toggle="modal"
                                                    data-bs-target="#chooseModal" data-mode="edit"
                                                    data-id="{{ $row->id }}" style="width:50px;">✏️</button>
                                                <a href="{{ route('deleteChoose', $row->id) }}"
                                                    class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')"
                                                    style="width:50px;">🗑️</a>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="5">No records found</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>

                        <!-- Total Records + Pagination -->
                        <div class="d-flex flex-column flex-md-row justify-content-between align-items-center mt-3 gap-2">
                            <div class="text-muted">
                                @if ($choose_data->total() > 0)
                                    Showing {{ $choose_data->firstItem() }} to {{ $choose_data->lastItem() }} of
                                    {{ $choose_data->total() }} entries
                                @else
                                    Showing 0 to 0 of 0 entries
                                @endif
                            </div>

                            <div>
                                <nav>
                                    <ul class="pagination mb-0 justify-content-center">
                                        @for ($i = 1; $i <= $choose_data->lastPage(); $i++)
                                            <li class="page-item {{ $choose_data->currentPage() == $i ? 'active' : '' }}">
                                                <a class="page-link"
                                                    href="{{ $choose_data->url($i) }}">{{ $i }}</a>
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

        <!-- Choose Modal -->
        <div class="modal fade" id="chooseModal" tabindex="-1">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <form id="chooseForm" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="choose_id" id="choose_id">
                        <input type="hidden" name="points_title_input" id="points_title_input">

                        <div class="modal-header">
                            <h5 id="chooseModalTitle">Add Choose</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>

                        <div class="modal-body">
                            <div class="mb-3">
                                <label>Title</label>
                                <input type="text" id="choose_title" name="title" class="form-control" required>
                            </div>

                            <div class="mb-3">
                                <label>Description</label>
                                <textarea id="choose_description" name="description" class="form-control"></textarea>
                            </div>

                            <div class="mb-3">
                                <label>Points (title + image)</label>
                                <div id="points_wrapper"></div>
                                <button type="button" class="btn btn-sm btn-success mt-2" id="add_point_btn">Add
                                    Point</button>
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" id="chooseFormSubmitBtn" class="btn btn-primary">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.20/dist/summernote-lite.min.js"></script>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                $('#choose_description').summernote({
                    height: 160
                });

                const pointsWrapper = document.getElementById('points_wrapper');
                const addPointBtn = document.getElementById('add_point_btn');
                const pointsTitleInput = document.getElementById('points_title_input');
                let pointsTitle = [];
                let oldImages = [];

                function renderPoints() {
                    pointsWrapper.innerHTML = '';
                    pointsTitle.forEach((title, idx) => {
                        const div = document.createElement('div');
                        div.className = 'd-flex gap-2 mb-2 align-items-center';
                        const oldImg = oldImages[idx] ?
                            `<img src="{{ asset('chooseImage') }}/${oldImages[idx]}" width="40" style="object-fit:cover;border-radius:4px;">` :
                            '';
                        div.innerHTML = `
                <input type="text" class="form-control form-control-sm point-title" data-idx="${idx}" placeholder="Point title" value="${title}">
                ${oldImg}
                <input type="file" name="points_image[]" class="form-control form-control-sm">
                <button type="button" class="btn btn-sm btn-danger remove-point" data-idx="${idx}" style="width:40px;">&times;</button>
            `;
                        pointsWrapper.appendChild(div);
                    });
                    pointsTitleInput.value = JSON.stringify(pointsTitle);
                }

                addPointBtn.addEventListener('click', () => {
                    pointsTitle.push('');
                    oldImages.push('');
                    renderPoints();
                });

                pointsWrapper.addEventListener('input', e => {
                    const idx = Number(e.target.dataset.idx);
                    if (e.target.classList.contains('point-title')) {
                        pointsTitle[idx] = e.target.value;
                        pointsTitleInput.value = JSON.stringify(pointsTitle);
                    }
                });

                pointsWrapper.addEventListener('click', e => {
                    if (e.target.classList.contains('remove-point')) {
                        const idx = Number(e.target.dataset.idx);
                        pointsTitle.splice(idx, 1);
                        oldImages.splice(idx, 1);
                        renderPoints();
                    }
                });

                const chooseModal = document.getElementById('chooseModal');
                const chooseForm = document.getElementById('chooseForm');
                const chooseTitle = document.getElementById('choose_title');
                const chooseId = document.getElementById('choose_id');

                chooseModal.addEventListener('show.bs.modal', function(event) {
                    const button = event.relatedTarget;
                    const mode = button.getAttribute('data-mode');

                    chooseForm.reset();
                    pointsTitle = [];
                    oldImages = [];
                    renderPoints();
                    $('#choose_description').summernote('code', '');
                    chooseForm.action = "{{ route('saveChoose') }}";
                    document.getElementById('chooseModalTitle').textContent = 'Add Choose';

                    if (mode === 'edit') {
                        const id = button.dataset.id;
                        chooseId.value = id;
                        chooseForm.action = "{{ route('updateChoose', ['id' => ':id']) }}".replace(':id', id);
                        document.getElementById('chooseModalTitle').textContent = 'Edit Choose';

                        fetch("{{ route('editChoose', ['id' => ':id']) }}".replace(':id', id))
                            .then(res => res.json())
                            .then(data => {
                                chooseTitle.value = data.title;
                                $('#choose_description').summernote('code', data.description || '');
                                pointsTitle = data.points_title || [];
                                oldImages = data.points_image || [];
                                renderPoints();
                            });
                    }
                });

                chooseForm.addEventListener('submit', () => {
                    pointsTitleInput.value = JSON.stringify(pointsTitle);
                });

                // Live search
                const searchForm = document.getElementById('searchForm');
                const searchInput = searchForm.querySelector('input[name="q"]');
                let debounceTimer;
                searchInput.addEventListener('input', function() {
                    clearTimeout(debounceTimer);
                    debounceTimer = setTimeout(() => searchForm.submit(), 400);
                });

            });
        </script>
    @endsection
