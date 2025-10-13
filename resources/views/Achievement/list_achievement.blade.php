@extends('Admin.Layouts.main')

@section('main-container')
<div class="content-page">
    <div class="content">
        <div class="container-fluid">

            <!-- Flash Messages -->
            @if (session('success'))
                <div id="successAlert" class="alert alert-success alert-dismissible fade show w-100" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif
            @if (session('error'))
                <div id="errorAlert" class="alert alert-danger alert-dismissible fade show w-100" role="alert">
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

            <!-- Achievement List Card -->
            <div class="card mt-3">
                <div class="card-header">
                    <div class="d-flex align-items-center justify-content-between flex-wrap gap-2">

                        <!-- Left: Title + Show dropdown -->
                        <div class="d-flex align-items-center gap-3">
                            <h4 class="mb-0">Achievement List</h4>

                            <form id="lengthForm" method="GET" action="{{ route('listAchievement') }}" class="d-flex align-items-center gap-2">
                                <input type="hidden" name="q" value="{{ request('q') }}">
                                <label class="mb-0" style="display:flex;align-items:center">Show
                                    <select name="length" class="form-select form-select-sm ms-1" style="width:80px;" onchange="this.form.submit()">
                                        <option value="10" {{ request('length',10)==10?'selected':'' }}>10</option>
                                        <option value="25" {{ request('length')==25?'selected':'' }}>25</option>
                                        <option value="50" {{ request('length')==50?'selected':'' }}>50</option>
                                        <option value="100" {{ request('length')==100?'selected':'' }}>100</option>
                                    </select>
                                </label>
                            </form>
                        </div>

                        <!-- Right: Search + Add Button -->
                        <div class="d-flex align-items-center gap-2">
                            <form id="searchForm" method="GET" action="{{ route('listAchievement') }}" class="d-flex">
                                <input type="hidden" name="length" value="{{ request('length',10) }}">
                                <input type="text" name="q" value="{{ request('q') }}" class="form-control form-control-sm" placeholder="Search title...">
                            </form>

                            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#achievementModal" data-mode="add">Add Achievement</button>
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
                                    <th>Image</th>
                                    <th>Count</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($achievements as $index => $achievement)
                                    <tr>
                                        <td>{{ $achievements->firstItem() + $index }}</td>
                                        <td>{{ $achievement->title }}</td>
                                        <td>
                                            @if($achievement->image)
                                                <img src="{{ asset('achievementImage/'.$achievement->image) }}" width="50" style="object-fit:cover;border-radius:4px;background-color:#f2f2f2;padding:5px;">
                                            @else
                                                -
                                            @endif
                                        </td>
                                        <td>{{ $achievement->count }}</td>
                                        <td>
                                            <button class="btn btn-sm btn-primary editBtn" data-bs-toggle="modal"
                                                data-bs-target="#achievementModal" data-mode="edit"
                                                data-id="{{ $achievement->id }}"
                                                data-title="{{ $achievement->title }}"
                                                data-count="{{ $achievement->count }}">
                                                ✏️
                                            </button>
                                            <a href="{{ route('deleteAchievement', $achievement->id) }}" class="btn btn-sm btn-danger"
                                                onclick="return confirm('Are you sure?')">🗑️</a>
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
                            @if($achievements->total() > 0)
                                Showing {{ $achievements->firstItem() }} to {{ $achievements->lastItem() }} of {{ $achievements->total() }} entries
                            @else
                                Showing 0 to 0 of 0 entries
                            @endif
                        </div>

                        <div>
                            <nav>
                                <ul class="pagination mb-0 justify-content-center">
                                    @for ($i = 1; $i <= $achievements->lastPage(); $i++)
                                        <li class="page-item {{ $achievements->currentPage()==$i?'active':'' }}">
                                            <a class="page-link" href="{{ $achievements->appends(['q'=>request('q'),'length'=>request('length')])->url($i) }}">{{ $i }}</a>
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

<!-- Achievement Modal -->
<div class="modal fade" id="achievementModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form id="achievementForm" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="achievement_id" id="achievement_id">

                <div class="modal-header">
                    <h5 id="achievementModalTitle">Add Achievement</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">
                    <div class="mb-3">
                        <label>Title</label>
                        <input type="text" id="achievement_title" name="title" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label>Count</label>
                        <input type="number" id="achievement_count" name="count" class="form-control" value="0" min="0">
                    </div>

                    <div class="mb-3">
                        <label>Image</label>
                        <input type="file" name="image" id="achievement_image" class="form-control">
                        <div class="mt-2">
                            <img id="current_image" src="" width="140" class="d-none" alt="Current Image" style="background-color:#f2f2f2;padding:5px;border-radius:4px;">
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" id="achievementFormSubmitBtn">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const achievementModal = document.getElementById('achievementModal');
    const achievementForm = document.getElementById('achievementForm');

    achievementModal.addEventListener('show.bs.modal', function(event) {
        const button = event.relatedTarget;
        const mode = button.getAttribute('data-mode');

        const modalTitle = achievementModal.querySelector('#achievementModalTitle');
        const submitBtn = achievementModal.querySelector('#achievementFormSubmitBtn');
        const achievementId = achievementModal.querySelector('#achievement_id');
        const titleInput = achievementModal.querySelector('#achievement_title');
        const countInput = achievementModal.querySelector('#achievement_count');
        const currentImage = achievementModal.querySelector('#current_image');
        const imageInput = achievementModal.querySelector('#achievement_image');

        // Reset modal
        achievementForm.reset();
        achievementId.value = '';
        currentImage.src = '';
        currentImage.classList.add('d-none');
        imageInput.required = true;

        if(mode==='add'){
            modalTitle.textContent='Add Achievement';
            submitBtn.textContent='Add';
            achievementForm.action="{{ route('saveAchievement') }}";
        }
        else if(mode==='edit'){
            modalTitle.textContent='Edit Achievement';
            submitBtn.textContent='Update';
            const id = button.getAttribute('data-id');
            achievementId.value = id;
            titleInput.value = button.getAttribute('data-title');
            countInput.value = button.getAttribute('data-count');
            imageInput.required = false;
            achievementForm.action="{{ route('updateAchievement',['id'=>':id']) }}".replace(':id',id);

            fetch("{{ route('editAchievement',['id'=>':id']) }}".replace(':id',id))
            .then(res=>res.json())
            .then(data=>{
                if(data.image){
                    currentImage.src="{{ asset('achievementImage') }}/"+data.image;
                    currentImage.classList.remove('d-none');
                }
            }).catch(()=>{});
        }
    });

    // Live search debounce
    const searchForm=document.getElementById('searchForm');
    const searchInput=searchForm.querySelector('input[name="q"]');
    let debounceTimer;
    searchInput.addEventListener('input', function(){
        clearTimeout(debounceTimer);
        debounceTimer=setTimeout(()=>searchForm.submit(),400);
    });

    // Auto-dismiss flash messages after 3 seconds
    setTimeout(() => {
        const successAlert = document.getElementById('successAlert');
        const errorAlert = document.getElementById('errorAlert');
        if(successAlert) successAlert.remove();
        if(errorAlert) errorAlert.remove();
    }, 3000);
});
</script>
@endsection
