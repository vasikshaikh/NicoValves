@extends('Admin.Layouts.main')

@section('main-container')
<div class="content-page">
    <div class="content">
        <div class="container-fluid">

            <!-- Flash messages -->
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show w-100" role="alert" id="successAlert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif
            @if(session('error'))
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
                        <h4 class="mb-0">Product List</h4>

                        <!-- Show X entries -->
                        <form id="lengthForm" method="GET" action="{{ route('listProduct') }}" class="d-flex align-items-center gap-2">
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

                    <!-- Live search + Add Product -->
                    <div class="d-flex align-items-center gap-2">
                        <form id="searchForm" method="GET" action="{{ route('listProduct') }}" class="d-flex">
                            <input type="hidden" name="length" value="{{ request('length', 10) }}">
                            <input type="text" name="q" value="{{ request('q') }}" class="form-control form-control-sm" placeholder="Search by title or category..." id="liveSearchInput">
                        </form>

                        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#productModal" data-mode="add">
                            Add Product
                        </button>
                    </div>
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped text-center align-middle">
                            <thead class="table-dark">
                                <tr>
                                    <th>Sr.No</th>
                                    <th>Category</th>
                                    <th>Title</th>
                                    <th>Description</th>
                                    <th>Images</th>
                                    <th>Document</th>
                                    <th style="width:160px">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($product_data as $index => $product)
                                    <tr>
                                        <td style="vertical-align: middle;">{{ $product_data->firstItem() + $index }}</td>
                                        <td style="vertical-align: middle;">{{ $product->category?->name ?? 'N/A' }}</td>
                                        <td style="vertical-align: middle;">{{ $product->title }}</td>

                                        {{-- Description with See More / See Less --}}
                                        <td style="max-width:420px; word-break:break-word; vertical-align: middle; text-align:left;">
                                            @php
                                                $descText = strip_tags($product->description ?? '');
                                                $descText = trim($descText);
                                                $descWords = $descText === '' ? [] : preg_split('/\s+/', $descText);
                                                $previewCount = 20; // show 20 words
                                                $shortDesc = implode(' ', array_slice($descWords, 0, $previewCount));
                                                $fullDesc = $descText;
                                            @endphp

                                            @if(count($descWords) > $previewCount)
                                                <span class="short-text">{{ $shortDesc }}&hellip;</span>
                                                <span class="full-text d-none">{!! nl2br(e($fullDesc)) !!}</span>
                                                <a href="javascript:void(0);" class="toggle-text" style="color:black; cursor:pointer; font-weight:500; text-decoration:underline;">See More</a>
                                            @else
                                                {!! nl2br(e($fullDesc)) !!}
                                            @endif
                                        </td>

                                        <td style="vertical-align: middle;">
                                            @if($product->image)
                                                @foreach(json_decode($product->image) as $img)
                                                    <img src="{{ asset('productImage/' . $img) }}" width="80" class="me-1 mb-1" />
                                                @endforeach
                                            @else
                                                No Image
                                            @endif
                                        </td>
                                        <td style="vertical-align: middle;">
                                            @if($product->document)
                                                <a href="{{ asset('ProductDocument/' . $product->document) }}" target="_blank">View PDF</a>
                                            @else
                                                N/A
                                            @endif
                                        </td>

                                        <!-- Actions: fixed width so buttons won't shift -->
                                        <td style="white-space: nowrap; vertical-align: middle; width:160px;">
                                            <div style="display:flex; gap:6px; justify-content:center; align-items:center;">
                                                <button class="btn btn-sm btn-primary action-btn" style="min-width:72px;" data-bs-toggle="modal"
                                                    data-bs-target="#productModal" data-mode="edit" data-id="{{ $product->id }}">
                                                    ✏️ Edit
                                                </button>
                                                <a href="{{ route('deleteProduct', $product->id) }}" class="btn btn-sm btn-danger action-btn" style="min-width:72px;"
                                                   onclick="return confirm('Are you sure?')">🗑️ Delete</a>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr><td colspan="7">No records found.</td></tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination + showing X to Y of Z -->
                    <div class="d-flex flex-column flex-md-row justify-content-between align-items-center mt-3 gap-2">
                        <div class="text-muted">
                            @if ($product_data->total() > 0)
                                Showing {{ $product_data->firstItem() }} to {{ $product_data->lastItem() }} of {{ $product_data->total() }} entries
                            @else
                                Showing 0 to 0 of 0 entries
                            @endif
                        </div>
                        <div>
                            <nav>
                                <ul class="pagination mb-0 justify-content-center">
                                    @for ($i = 1; $i <= $product_data->lastPage(); $i++)
                                        <li class="page-item {{ $product_data->currentPage() == $i ? 'active' : '' }}">
                                            <a class="page-link" href="{{ $product_data->url($i) }}">{{ $i }}</a>
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

<!-- Add/Edit Product Modal -->
<div class="modal fade" id="productModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form id="productForm" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="product_id" id="product_id">
                <input type="hidden" name="category_id" id="category_id" value="0">
                <!-- Hidden field for removed images -->
                <input type="hidden" name="remove_images" id="remove_images" value="">

                <div class="modal-header">
                    <h5 class="modal-title" id="productModalTitle">Add Product</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">

                    <!-- Category search -->
                    <div class="mb-3 position-relative">
                        <label class="form-label">Search Category</label>
                        <input type="text" id="category_search" class="form-control" placeholder="Type category name...">
                        <div id="category_list" class="border rounded position-absolute w-100" style="max-height:180px; overflow-y:auto; z-index:1000;"></div>
                    </div>

                    <!-- Title -->
                    <div class="mb-3">
                        <label class="form-label">Title</label>
                        <input type="text" name="title" id="title" class="form-control" required>
                    </div>

                    <!-- Description with Summernote -->
                    <div class="mb-3">
                        <label class="form-label">Description</label>
                        <textarea name="description" id="description" class="form-control"></textarea>
                    </div>

                    <!-- Product Images -->
                    <div class="mb-3">
                        <label class="form-label">Product Images (Max 5)</label>
                        <div id="image_wrapper" class="d-flex flex-wrap gap-2">
                            <!-- New image upload fields will be added here -->
                        </div>
                        <button type="button" id="addImageBtn" class="btn btn-sm btn-secondary mt-2">Add New Image</button>

                        <!-- Current Images with Remove Option -->
                        <div id="current_images" class="mt-3">
                            <label class="form-label text-muted">Current Images (Click × to remove)</label>
                            <div id="current_images_container" class="d-flex flex-wrap gap-2"></div>
                        </div>
                    </div>

                    <!-- PDF Document -->
                    <div class="mb-3">
                        <label class="form-label">Product Document (PDF)</label>
                        <input type="file" name="document" id="document" class="form-control">
                        <div id="current_document" class="mt-2"></div>
                    </div>

                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" id="productFormSubmitBtn">Add Product</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Inline style for toggle link (user requested inline CSS) -->
<style>
.toggle-text {
    color: black;
    cursor: pointer;
    font-weight: 500;
    text-decoration: underline;
}
.current-image-item {
    position: relative;
    display: inline-block;
    margin: 5px;
}
.remove-current-image {
    position: absolute;
    top: -8px;
    right: -8px;
    background: #dc3545;
    color: white;
    border: none;
    border-radius: 50%;
    width: 24px;
    height: 24px;
    font-size: 14px;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
}
</style>

<!-- Summernote CSS & JS -->
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.20/dist/summernote.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.20/dist/summernote.min.js"></script>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Summernote init
    $('#description').summernote({
        placeholder: 'Enter product description here...',
        tabsize: 2,
        height: 150,
        toolbar: [
          ['style', ['bold', 'italic', 'underline', 'clear']],
          ['font', ['strikethrough', 'superscript', 'subscript']],
          ['fontsize', ['fontsize']],
          ['color', ['color']],
          ['para', ['ul', 'ol', 'paragraph']],
          ['insert', ['link', 'picture', 'video']],
          ['view', ['fullscreen', 'codeview', 'help']]
        ]
    });

    // Modal show logic (Add/Edit)
    var productModal = document.getElementById('productModal');
    var productForm = document.getElementById('productForm');
    var imageWrapper = document.getElementById('image_wrapper');
    var removeImagesInput = document.getElementById('remove_images');
    var currentImagesContainer = document.getElementById('current_images_container');

    productModal.addEventListener('show.bs.modal', function(event){
        var button = event.relatedTarget;
        var mode = button.getAttribute('data-mode');

        var modalTitle = productModal.querySelector('#productModalTitle');
        var submitBtn = productModal.querySelector('#productFormSubmitBtn');
        var titleInput = productModal.querySelector('#title');
        var productIdInput = productModal.querySelector('#product_id');
        var catIdInput = productModal.querySelector('#category_id');
        var currentImagesDiv = productModal.querySelector('#current_images');
        var currentDocDiv = productModal.querySelector('#current_document');

        // Reset everything
        titleInput.value = '';
        productIdInput.value = '';
        catIdInput.value = 0;
        removeImagesInput.value = '';
        currentImagesContainer.innerHTML = '';
        imageWrapper.innerHTML = '';
        $('#description').summernote('code', '');

        // Show/hide current images section based on mode
        if(mode === 'add') {
            currentImagesDiv.style.display = 'none';
        } else {
            currentImagesDiv.style.display = 'block';
        }

        if(mode === 'add'){
            modalTitle.textContent = 'Add Product';
            submitBtn.textContent = 'Add Product';
            productForm.action = "{{ route('saveProduct') }}";

            // Add one empty image field for add mode
            addNewImageField();
        } else if(mode === 'edit'){
            modalTitle.textContent = 'Edit Product';
            submitBtn.textContent = 'Update Product';
            var productId = button.getAttribute('data-id');
            productIdInput.value = productId;
            productForm.action = "{{ route('updateProduct', ['id' => ':id']) }}".replace(':id', productId);

            // Fetch product data
            fetch("{{ route('editProduct', ['id' => ':id']) }}".replace(':id', productId))
                .then(res => res.json())
                .then(data => {
                    var product = data.product ?? data;
                    titleInput.value = product.title;
                    catIdInput.value = product.category_id || 0;
                    $('#description').summernote('code', product.description || '');

                    // Display current images with remove buttons
                    if(product.image){
                        try {
                            const images = JSON.parse(product.image);
                            currentImagesContainer.innerHTML = '';
                            images.forEach(img => {
                                const imageItem = document.createElement('div');
                                imageItem.className = 'current-image-item';
                                imageItem.innerHTML = `
                                    <img src="{{ asset('productImage') }}/${img}" width="80" height="80" style="object-fit: cover;">
                                    <button type="button" class="remove-current-image" data-image="${img}">&times;</button>
                                `;
                                currentImagesContainer.appendChild(imageItem);
                            });

                            // Add event listeners to remove buttons
                            document.querySelectorAll('.remove-current-image').forEach(btn => {
                                btn.addEventListener('click', function() {
                                    const imageName = this.getAttribute('data-image');
                                    // Add to remove_images hidden field
                                    let removedImages = removeImagesInput.value ? removeImagesInput.value.split(',') : [];
                                    if (!removedImages.includes(imageName)) {
                                        removedImages.push(imageName);
                                        removeImagesInput.value = removedImages.join(',');
                                    }
                                    // Remove from display
                                    this.parentElement.remove();
                                });
                            });
                        } catch(e) {
                            console.error('Error parsing images:', e);
                        }
                    }

                    // Current document
                    if(product.document){
                        currentDocDiv.innerHTML = `
                            <div class="alert alert-info p-2">
                                <i class="fas fa-file-pdf"></i>
                                <a href='{{ asset('ProductDocument') }}/${product.document}' target='_blank'>${product.document}</a>
                            </div>`;
                    }
                }).catch(err => {
                    console.error('Error fetching product:', err);
                });
        }
    });

    // Add new image field function
    function addNewImageField() {
        if(imageWrapper.querySelectorAll('input[name="image[]"]').length >= 5){
            alert('You can upload max 5 images.');
            return;
        }
        const div = document.createElement('div');
        div.classList.add('d-flex','align-items-center','gap-1','mb-2');
        div.innerHTML = `
            <input type="file" name="image[]" class="form-control form-control-sm" accept="image/*">
            <button type="button" class="btn btn-danger btn-sm remove-image-btn" title="Remove">&times;</button>
        `;
        imageWrapper.appendChild(div);

        // Add remove event
        div.querySelector('.remove-image-btn').addEventListener('click', function(){
            div.remove();
        });
    }

    // Category autocomplete
    const catSearch = document.getElementById('category_search');
    const catList = document.getElementById('category_list');
    const catIdInput = document.getElementById('category_id');
    if(catSearch){
        catSearch.addEventListener('input', function(){
            let query = this.value;
            if(query.length < 2){
                catList.innerHTML = '';
                catIdInput.value = 0;
                return;
            }
            fetch("{{ route('searchCategory') }}?q=" + encodeURIComponent(query))
                .then(res => res.json())
                .then(data => {
                    catList.innerHTML = '';
                    data.forEach(cat => {
                        let div = document.createElement('div');
                        div.textContent = cat.name;
                        div.classList.add('p-1','border-bottom');
                        div.style.cursor = 'pointer';
                        div.addEventListener('click', function(){
                            catSearch.value = cat.name;
                            catIdInput.value = cat.id;
                            catList.innerHTML = '';
                        });
                        catList.appendChild(div);
                    });
                }).catch(()=>{ catList.innerHTML = ''; });
        });

        // Click outside to close suggestion list
        document.addEventListener('click', function(e){
            if(!catSearch.contains(e.target) && !catList.contains(e.target)){
                catList.innerHTML = '';
            }
        });
    }

    // Dynamic add new images
    const addBtn = document.getElementById('addImageBtn');
    addBtn.addEventListener('click', addNewImageField);

    // Live search for list (debounce)
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

    // See More / See Less toggle
    function initToggleLinks(){
        document.querySelectorAll('.toggle-text').forEach(function(link){
            link.removeEventListener('click', toggleHandler);
            link.addEventListener('click', toggleHandler);
        });
    }
    function toggleHandler(e){
        var link = e.currentTarget;
        var td = link.closest('td');
        var shortEl = td.querySelector('.short-text');
        var fullEl = td.querySelector('.full-text');
        if(!shortEl || !fullEl) return;
        if (shortEl.classList.contains('d-none')) {
            shortEl.classList.remove('d-none');
            fullEl.classList.add('d-none');
            link.textContent = 'See More';
        } else {
            shortEl.classList.add('d-none');
            fullEl.classList.remove('d-none');
            link.textContent = 'See Less';
        }
    }
    initToggleLinks();

    // Auto-dismiss alerts after 3s
    ['successAlert','errorAlert'].forEach(function(id){
        const el = document.getElementById(id);
        if(el) setTimeout(() => {
            if (bootstrap.Alert) {
                new bootstrap.Alert(el).close();
            }
        }, 3000);
    });

});
</script>
@endsection
