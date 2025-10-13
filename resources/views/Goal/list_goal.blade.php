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
                            <h4 class="mb-0">Goal List</h4>

                            <!-- Show X entries -->
                            <form id="lengthForm" method="GET" action="{{ route('listGoal') }}"
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

                        <!-- Live search + Add Goal -->
                        <div class="d-flex align-items-center gap-2">
                            <form id="searchForm" method="GET" action="{{ route('listGoal') }}" class="d-flex">
                                <input type="hidden" name="length" value="{{ request('length', 10) }}">
                                <input type="text" name="q" value="{{ request('q') }}"
                                    class="form-control form-control-sm" placeholder="Type to search title..."
                                    id="liveSearchInput">
                            </form>

                            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#goalModal"
                                data-mode="add">
                                Add Goal
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
                                    @forelse ($goal_data as $index => $goal)
                                        <tr>
                                            <td>{{ $goal_data->firstItem() + $index }}</td>

                                            {{-- Title --}}
                                            <td style="max-width:250px; word-break: break-word;">
                                                @php
                                                    $titleWords = explode(' ', strip_tags($goal->title));
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
                                                    $descWords = explode(' ', strip_tags($goal->description));
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
                                                @if ($goal->image)
                                                    <img src="{{ asset('GoalImage/' . $goal->image) }}" width="120"
                                                        alt="Goal Image">
                                                @else
                                                    No Image
                                                @endif
                                            </td>

                                            <td style="white-space: nowrap; vertical-align: middle;">
                                                <button class="btn btn-sm btn-primary editBtn" data-bs-toggle="modal"
                                                    data-bs-target="#goalModal" data-mode="edit"
                                                    data-id="{{ $goal->id }}" data-title="{{ $goal->title }}">
                                                    ✏️ Edit
                                                </button>
                                                <a href="{{ route('deleteGoal', $goal->id) }}"
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
                                @if ($goal_data->total() > 0)
                                    Showing {{ $goal_data->firstItem() }} to {{ $goal_data->lastItem() }} of
                                    {{ $goal_data->total() }} entries
                                @else
                                    Showing 0 to 0 of 0 entries
                                @endif
                            </div>
                            <div>
                                <nav>
                                    <ul class="pagination mb-0 justify-content-center">
                                        @for ($i = 1; $i <= $goal_data->lastPage(); $i++)
                                            <li class="page-item {{ $goal_data->currentPage() == $i ? 'active' : '' }}">
                                                <a class="page-link"
                                                    href="{{ $goal_data->url($i) }}">{{ $i }}</a>
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

        <!-- Add/Edit Goal Modal -->
        <div class="modal fade" id="goalModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <form id="goalForm" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="goal_id" id="goal_id">

                        <div class="modal-header">
                            <h5 class="modal-title" id="goalModalTitle">Add Goal</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>

                        <div class="modal-body">
                            <div class="mb-3">
                                <label class="form-label">Title</label>
                                <input type="text" name="title" id="title" class="form-control" required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Description</label>
                                <textarea name="description" id="goal_description" class="form-control"></textarea>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Goal Image (optional)</label>
                                <input type="file" name="image" id="goal_image" class="form-control">
                                <div class="mt-2">
                                    <img id="current_image" src="" width="140" class="d-none"
                                        alt="Current Image">
                                </div>
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary" id="goalFormSubmitBtn">Add Goal</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <script>
            document.addEventListener('DOMContentLoaded', function() {

                var goalModal = document.getElementById('goalModal');
                var goalForm = document.getElementById('goalForm');

                goalModal.addEventListener('show.bs.modal', function(event) {
                    var button = event.relatedTarget;
                    var mode = button.getAttribute('data-mode');

                    var modalTitle = goalModal.querySelector('#goalModalTitle');
                    var submitBtn = goalModal.querySelector('#goalFormSubmitBtn');
                    var titleInput = goalModal.querySelector('#title');
                    var goalIdInput = goalModal.querySelector('#goal_id');
                    var currentImage = goalModal.querySelector('#current_image');
                    var goalImageInput = goalModal.querySelector('#goal_image');

                    // Reset
                    titleInput.value = '';
                    goalIdInput.value = '';
                    currentImage.src = '';
                    currentImage.classList.add('d-none');
                    goalImageInput.value = '';
                    goalForm.querySelector('#goal_description').value = '';

                    if (mode === 'add') {
                        modalTitle.textContent = 'Add Goal';
                        submitBtn.textContent = 'Add Goal';
                        goalForm.action = "{{ route('saveGoal') }}";
                    } else if (mode === 'edit') {
                        modalTitle.textContent = 'Edit Goal';
                        submitBtn.textContent = 'Update Goal';
                        var goalId = button.getAttribute('data-id');
                        goalIdInput.value = goalId;
                        titleInput.value = button.getAttribute('data-title');
                        goalForm.action = "{{ route('updateGoal', ['id' => ':id']) }}".replace(':id', goalId);

                        fetch("{{ route('editGoal', ['id' => ':id']) }}".replace(':id', goalId))
                            .then(res => res.json())
                            .then(data => {
                                goalForm.querySelector('#goal_description').value = data.description || '';
                                if (data.image) {
                                    currentImage.src = "{{ asset('GoalImage') }}/" + data.image;
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
