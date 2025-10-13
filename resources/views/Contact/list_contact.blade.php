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
                            <h4 class="mb-0">Contact List</h4>
                        </div>

                        <div class="d-flex align-items-center gap-2">
                            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#contactModal"
                                data-mode="add">
                                Add Contact
                            </button>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped text-center align-middle">
                                <thead class="table-dark">
                                    <tr>
                                        <th>Sr.No</th>
                                        <th>Address</th>
                                        <th>Address Image</th>
                                        <th>Phone</th>
                                        <th>Phone Image</th>
                                        <th>Email</th>
                                        <th>Email Image</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($contact_data as $index => $contact)
                                        <tr>
                                            <td>{{ $contact_data->firstItem() + $index }}</td>

                                            {{-- ADDRESS --}}
                                            @php
                                                $fullAddress = $contact->address ?? '';
                                                $plainAddress = strip_tags($fullAddress);
                                                $shortAddress = \Illuminate\Support\Str::words(
                                                    $plainAddress,
                                                    20,
                                                    '...',
                                                );
                                                $isLong = mb_strlen($plainAddress) > mb_strlen($shortAddress);
                                            @endphp
                                            <td style="text-align:left; max-width:250px;">
                                                <div class="contact-desc" data-id="contact-{{ $contact->id }}">
                                                    <div class="short-text">
                                                        {!! nl2br(e($shortAddress)) !!}
                                                        @if ($isLong)
                                                            <a href="#" class="toggle-desc ms-2"
                                                                data-action="expand">See more</a>
                                                        @endif
                                                    </div>
                                                    <div class="full-text d-none">
                                                        {!! $fullAddress !!}
                                                        @if ($isLong)
                                                            <div><a href="#" class="toggle-desc"
                                                                    data-action="collapse">See less</a></div>
                                                        @endif
                                                    </div>
                                                </div>
                                            </td>

                                            {{-- ADDRESS IMAGE --}}
                                            <td>
                                                @if ($contact->address_image)
                                                    <img src="{{ asset('ContactImage/' . $contact->address_image) }}"
                                                        width="80">
                                                @else
                                                    -
                                                @endif
                                            </td>

                                            {{-- PHONE --}}
                                            <td style="text-align:left;">
                                                @if (is_array($contact->phone))
                                                    <div class="d-flex flex-wrap gap-2">
                                                        @foreach ($contact->phone as $p)
                                                            <span class="badge bg-secondary">- {{ $p }}</span>
                                                        @endforeach
                                                    </div>
                                                @endif
                                            </td>
                                            <td>
                                                @if ($contact->phone_image)
                                                    <img src="{{ asset('ContactImage/' . $contact->phone_image) }}"
                                                        width="80">
                                                @else
                                                    -
                                                @endif
                                            </td>

                                            {{-- EMAIL --}}
                                            <td style="text-align:left;">
                                                @if (is_array($contact->email))
                                                    <div class="d-flex flex-wrap gap-2">
                                                        @foreach ($contact->email as $e)
                                                            <span class="badge bg-info text-dark">-
                                                                {{ $e }}</span>
                                                        @endforeach
                                                    </div>
                                                @endif
                                            </td>
                                            <td>
                                                @if ($contact->email_image)
                                                    <img src="{{ asset('ContactImage/' . $contact->email_image) }}"
                                                        width="80">
                                                @else
                                                    -
                                                @endif
                                            </td>

                                            {{-- ACTIONS --}}
                                            <td style="white-space: nowrap;">
                                                <div class="d-flex gap-2 justify-content-center">
                                                    <button class="btn btn-sm btn-primary action-btn" data-bs-toggle="modal"
                                                        data-bs-target="#contactModal" data-mode="edit"
                                                        data-id="{{ $contact->id }}">
                                                        ✏️ Edit
                                                    </button>
                                                    <a href="{{ route('deleteContact', $contact->id) }}"
                                                        class="btn btn-sm btn-danger action-btn"
                                                        onclick="return confirm('Are you sure?')">🗑️ Delete</a>
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="8">No records found.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>

                        {{-- Pagination --}}
                        <div class="mt-3 d-flex justify-content-between align-items-center">
                            <div class="text-muted">
                                Showing {{ $contact_data->firstItem() ?? 0 }} to {{ $contact_data->lastItem() ?? 0 }} of
                                {{ $contact_data->total() ?? 0 }} entries
                            </div>
                            <div>{{ $contact_data->links() }}</div>
                        </div>
                    </div>
                </div>

            </div>
        </div>


    <!-- Add/Edit Contact Modal -->
    <div class="modal fade" id="contactModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form id="contactForm" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="contact_id" id="contact_id">

                    <div class="modal-header">
                        <h5 class="modal-title" id="contactModalTitle">Add Contact</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>

                    <div class="modal-body">

                        <!-- Address -->
                        <div class="mb-3">
                            <label class="form-label">Address</label>
                            <textarea name="address" id="contact_address" class="form-control" required></textarea>
                        </div>

                        <!-- Address Image -->
                        <div class="mb-3">
                            <label class="form-label">Address Image (Optional)</label>
                            <input type="file" name="address_image" class="form-control form-control-sm"
                                accept="image/*">
                            <div id="current_address_image" class="mt-2"></div>
                        </div>

                        <!-- Phone -->
                        <div class="mb-3">
                            <label class="form-label">Phone</label>
                            <div id="phone_wrapper">
                                <div class="d-flex mb-2 align-items-center gap-2">
                                    <input type="text" name="phone[]" class="form-control"
                                        placeholder="Enter phone number" required>
                                </div>
                            </div>
                            <button type="button" id="addPhoneBtn" class="btn btn-sm btn-secondary">Add Phone</button>
                        </div>

                        <!-- Phone Image -->
                        <div class="mb-3">
                            <label class="form-label">Phone Image (Optional)</label>
                            <input type="file" name="phone_image" class="form-control form-control-sm"
                                accept="image/*">
                            <div id="current_phone_image" class="mt-2"></div>
                        </div>

                        <!-- Email -->
                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <div id="email_wrapper">
                                <div class="d-flex mb-2 align-items-center gap-2">
                                    <input type="email" name="email[]" class="form-control" placeholder="Enter email"
                                        required>
                                </div>
                            </div>
                            <button type="button" id="addEmailBtn" class="btn btn-sm btn-secondary">Add Email</button>
                        </div>

                        <!-- Email Image -->
                        <div class="mb-3">
                            <label class="form-label">Email Image (Optional)</label>
                            <input type="file" name="email_image" class="form-control form-control-sm"
                                accept="image/*">
                            <div id="current_email_image" class="mt-2"></div>
                        </div>

                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" id="contactFormSubmitBtn">Save</button>
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

        .contact-desc .toggle-desc {
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
            $('#contact_address').summernote({
                placeholder: 'Enter address here...',
                tabsize: 2,
                height: 120,
                toolbar: [
                    ['style', ['bold', 'italic', 'underline', 'clear']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['insert', ['link', 'picture']]
                ]
            });

            const contactModalEl = document.getElementById('contactModal');
            const contactForm = document.getElementById('contactForm');

            const phoneWrapper = document.getElementById('phone_wrapper');
            const emailWrapper = document.getElementById('email_wrapper');

            // Add Phone
            document.getElementById('addPhoneBtn').addEventListener('click', function() {
                const div = document.createElement('div');
                div.className = 'd-flex mb-2 align-items-center gap-2';

                const input = document.createElement('input');
                input.type = 'text';
                input.name = 'phone[]';
                input.className = 'form-control';
                input.placeholder = 'Enter phone number';
                input.required = true;

                const removeBtn = document.createElement('button');
                removeBtn.type = 'button';
                removeBtn.className = 'btn btn-sm btn-danger';
                removeBtn.innerHTML = '&times;';
                removeBtn.addEventListener('click', () => div.remove());

                div.appendChild(input);
                div.appendChild(removeBtn);
                phoneWrapper.appendChild(div);
            });

            // Add Email
            document.getElementById('addEmailBtn').addEventListener('click', function() {
                const div = document.createElement('div');
                div.className = 'd-flex mb-2 align-items-center gap-2';

                const input = document.createElement('input');
                input.type = 'email';
                input.name = 'email[]';
                input.className = 'form-control';
                input.placeholder = 'Enter email';
                input.required = true;

                const removeBtn = document.createElement('button');
                removeBtn.type = 'button';
                removeBtn.className = 'btn btn-sm btn-danger';
                removeBtn.innerHTML = '&times;';
                removeBtn.addEventListener('click', () => div.remove());

                div.appendChild(input);
                div.appendChild(removeBtn);
                emailWrapper.appendChild(div);
            });

            contactModalEl.addEventListener('show.bs.modal', function(event) {
                const button = event.relatedTarget;
                const mode = button.getAttribute('data-mode');

                contactForm.reset();
                $('#contact_address').summernote('code', '');
                document.getElementById('contactModalTitle').textContent = 'Add Contact';
                contactForm.action = "{{ route('saveContact') }}";
                document.getElementById('contact_id').value = '';

                ['current_address_image', 'current_phone_image', 'current_email_image'].forEach(id =>
                    document.getElementById(id).innerHTML = '');
                phoneWrapper.innerHTML = `<div class="d-flex mb-2 align-items-center gap-2">
                                    <input type="text" name="phone[]" class="form-control" placeholder="Enter phone number" required>
                                </div>`;
                emailWrapper.innerHTML = `<div class="d-flex mb-2 align-items-center gap-2">
                                    <input type="email" name="email[]" class="form-control" placeholder="Enter email" required>
                                </div>`;

                if (mode === 'edit') {
                    const id = button.getAttribute('data-id');
                    document.getElementById('contactModalTitle').textContent = 'Edit Contact';
                    contactForm.action = "{{ route('updateContact', ['id' => ':id']) }}".replace(':id',
                    id);
                    document.getElementById('contact_id').value = id;

                    // change submit button text to "Update" for edit mode
                    document.getElementById('contactFormSubmitBtn').textContent = 'Update';

                    fetch("{{ route('editContact', ['id' => ':id']) }}".replace(':id', id))
                        .then(res => res.json())
                        .then(data => {
                            $('#contact_address').summernote('code', data.address || '');
                            // Phone
                            phoneWrapper.innerHTML = '';
                            if (Array.isArray(data.phone) && data.phone.length) {
                                data.phone.forEach(p => {
                                    const div = document.createElement('div');
                                    div.className = 'd-flex mb-2 align-items-center gap-2';
                                    const input = document.createElement('input');
                                    input.type = 'text';
                                    input.name = 'phone[]';
                                    input.className = 'form-control';
                                    input.value = p;
                                    input.required = true;

                                    const removeBtn = document.createElement('button');
                                    removeBtn.type = 'button';
                                    removeBtn.className = 'btn btn-sm btn-danger';
                                    removeBtn.innerHTML = '&times;';
                                    removeBtn.addEventListener('click', () => div.remove());

                                    div.appendChild(input);
                                    div.appendChild(removeBtn);
                                    phoneWrapper.appendChild(div);
                                });
                            }
                            // Email
                            emailWrapper.innerHTML = '';
                            if (Array.isArray(data.email) && data.email.length) {
                                data.email.forEach(e => {
                                    const div = document.createElement('div');
                                    div.className = 'd-flex mb-2 align-items-center gap-2';
                                    const input = document.createElement('input');
                                    input.type = 'email';
                                    input.name = 'email[]';
                                    input.className = 'form-control';
                                    input.value = e;
                                    input.required = true;

                                    const removeBtn = document.createElement('button');
                                    removeBtn.type = 'button';
                                    removeBtn.className = 'btn btn-sm btn-danger';
                                    removeBtn.innerHTML = '&times;';
                                    removeBtn.addEventListener('click', () => div.remove());

                                    div.appendChild(input);
                                    div.appendChild(removeBtn);
                                    emailWrapper.appendChild(div);
                                });
                            }
                            // Existing images
                            if (data.address_image) document.getElementById('current_address_image')
                                .innerHTML =
                                `<img src="{{ asset('ContactImage') }}/${data.address_image}" width="120">`;
                            if (data.phone_image) document.getElementById('current_phone_image')
                                .innerHTML =
                                `<img src="{{ asset('ContactImage') }}/${data.phone_image}" width="120">`;
                            if (data.email_image) document.getElementById('current_email_image')
                                .innerHTML =
                                `<img src="{{ asset('ContactImage') }}/${data.email_image}" width="120">`;
                        });
                }
            });

            // See more / See less toggle
            document.body.addEventListener('click', function(e) {
                const t = e.target;
                if (t && t.classList && t.classList.contains('toggle-desc')) {
                    e.preventDefault();
                    const wrapper = t.closest('.contact-desc');
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

            // Auto-dismiss alerts
            ['successAlert', 'errorAlert'].forEach(function(id) {
                const el = document.getElementById(id);
                if (el) setTimeout(() => new bootstrap.Alert(el).close(), 3000);
            });
        });
    </script>

@endsection
