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
                        <h4 class="mb-0">Category List</h4>

                        <!-- Show X entries -->
                        <form id="lengthForm" method="GET" action="{{ route('listCategory') }}" class="d-flex align-items-center gap-2">
                            <input type="hidden" name="q" value="{{ request('q') }}">
                            <label class="mb-0" style="display:flex;align-items:center">
                                Show
                                <select name="length" onchange="document.getElementById('lengthForm').submit()" class="form-select form-select-sm ms-1" style="width:80px;">
                                    <option value="10" {{ request('length', 10) == 10 ? 'selected' : '' }}>10</option>
                                    <option value="25" {{ request('length') == 25 ? 'selected' : '' }}>25</option>
                                    <option value="50" {{ request('length') == 50 ? 'selected' : '' }}>50</option>
                                    <option value="100" {{ request('length') == 100 ? 'selected' : '' }}>100</option>
                                </select>
                            </label>
                        </form>
                    </div>

                    <!-- Live search + Add Category -->
                    <div class="d-flex align-items-center gap-2">
                        <form id="searchForm" method="GET" action="{{ route('listCategory') }}" class="d-flex">
                            <input type="hidden" name="length" value="{{ request('length', 10) }}">
                            <input type="text" name="q" value="{{ request('q') }}" class="form-control form-control-sm" placeholder="Type to search name..." id="liveSearchInput">
                        </form>

                        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#categoryModal" data-mode="add">
                            Add Category
                        </button>
                    </div>
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped text-center align-middle">
                            <thead class="table-dark">
                                <tr>
                                    <th>Sr.No</th>
                                    <th>Name</th>
                                    <th>Image</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($category_data as $index => $category)
                                    <tr>
                                        <td>{{ $category_data->firstItem() + $index }}</td>

                                        {{-- Name --}}
                                        <td style="max-width:250px; word-break: break-word;">
                                            {{ $category->name ?? '-' }}
                                        </td>

                                        {{-- Image --}}
                                        <td>
                                            @if($category->image)
                                                <img src="{{ asset('CategoryImage/' . $category->image) }}" width="120" alt="Category Image">
                                            @else
                                                No Image
                                            @endif
                                        </td>

                                        <td style="white-space: nowrap; vertical-align: middle;">
                                            <button class="btn btn-sm btn-primary editBtn" data-bs-toggle="modal"
                                                data-bs-target="#categoryModal" data-mode="edit" data-id="{{ $category->id }}"
                                                data-name="{{ $category->name }}">
                                                ✏️ Edit
                                            </button>
                                            <a href="{{ route('deleteCategory', $category->id) }}" class="btn btn-sm btn-danger"
                                                onclick="return confirm('Are you sure you want to delete this record?')">🗑️ Delete</a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr><td colspan="4">No records found.</td></tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    <div class="d-flex flex-column flex-md-row justify-content-between align-items-center mt-3 gap-2">
                        <div class="text-muted">
                            @if ($category_data->total() > 0)
                                Showing {{ $category_data->firstItem() }} to {{ $category_data->lastItem() }} of {{ $category_data->total() }} entries
                            @else
                                Showing 0 to 0 of 0 entries
                            @endif
                        </div>
                        <div>
                            <nav>
                                <ul class="pagination mb-0 justify-content-center">
                                    @for ($i = 1; $i <= $category_data->lastPage(); $i++)
                                        <li class="page-item {{ $category_data->currentPage() == $i ? 'active' : '' }}">
                                            <a class="page-link" href="{{ $category_data->url($i) }}">{{ $i }}</a>
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

<!-- Add/Edit Category Modal -->
<div class="modal fade" id="categoryModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form id="categoryForm" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="category_id" id="category_id">

                <div class="modal-header">
                    <h5 class="modal-title" id="categoryModalTitle">Add Category</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Name (optional)</label>
                        <input type="text" name="name" id="name" class="form-control">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Category Image (optional)</label>
                        <input type="file" name="image" id="category_image" class="form-control">
                        <div class="mt-2">
                            <img id="current_image" src="" width="140" class="d-none" alt="Current Image">
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" id="categoryFormSubmitBtn">Add Category</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {

    var categoryModal = document.getElementById('categoryModal');
    var categoryForm = document.getElementById('categoryForm');

    categoryModal.addEventListener('show.bs.modal', function(event) {
        var button = event.relatedTarget;
        var mode = button.getAttribute('data-mode');

        var modalTitle = categoryModal.querySelector('#categoryModalTitle');
        var submitBtn = categoryModal.querySelector('#categoryFormSubmitBtn');
        var nameInput = categoryModal.querySelector('#name');
        var categoryIdInput = categoryModal.querySelector('#category_id');
        var currentImage = categoryModal.querySelector('#current_image');
        var categoryImageInput = categoryModal.querySelector('#category_image');

        // Reset
        nameInput.value = '';
        categoryIdInput.value = '';
        currentImage.src = '';
        currentImage.classList.add('d-none');
        categoryImageInput.value = '';

        if(mode === 'add') {
            modalTitle.textContent = 'Add Category';
            submitBtn.textContent = 'Add Category';
            categoryForm.action = "{{ route('saveCategory') }}";
        } else if(mode === 'edit') {
            modalTitle.textContent = 'Edit Category';
            submitBtn.textContent = 'Update Category';
            var categoryId = button.getAttribute('data-id');
            categoryIdInput.value = categoryId;
            nameInput.value = button.getAttribute('data-name');
            categoryForm.action = "{{ route('updateCategory', ['id' => ':id']) }}".replace(':id', categoryId);

            fetch("{{ route('editCategory', ['id' => ':id']) }}".replace(':id', categoryId))
                .then(res => res.json())
                .then(data => {
                    if(data.image){
                        currentImage.src = "{{ asset('CategoryImage') }}/" + data.image;
                        currentImage.classList.remove('d-none');
                    }
                }).catch(()=>{});
        }
    });

    // Auto-dismiss alerts after 3 seconds
    ['successAlert', 'errorAlert'].forEach(function(id){
        var alert = document.getElementById(id);
        if(alert){
            setTimeout(function(){
                var bsAlert = new bootstrap.Alert(alert);
                bsAlert.close();
            }, 3000);
        }
    });

    // Live search with debounce
    const searchInput = document.getElementById('liveSearchInput');
    let debounceTimer = null;
    if(searchInput){
        searchInput.addEventListener('input', function(){
            clearTimeout(debounceTimer);
            debounceTimer = setTimeout(function(){
                document.getElementById('searchForm').submit();
            }, 400);
        });
    }

});
</script>
@endsection
