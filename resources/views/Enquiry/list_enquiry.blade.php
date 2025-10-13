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
                        <div class="d-flex align-items-center gap-2">
                            <h4 class="mb-0">Enquiry List</h4>

                            <!-- Show X entries -->
                            <form id="lengthForm" method="GET" action="{{ route('listEnquiry') }}"
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

                        <!-- Live search -->
                        <div class="d-flex align-items-center gap-2">
                            <form id="searchForm" method="GET" action="{{ route('listEnquiry') }}" class="d-flex">
                                <input type="hidden" name="length" value="{{ request('length', 10) }}">
                                <input type="text" name="q" value="{{ request('q') }}"
                                    class="form-control form-control-sm"
                                    placeholder="Search by name, company, or address..." id="liveSearchInput">
                            </form>
                        </div>
                    </div>

                    <div class="card-body table-responsive">
                        <table class="table table-striped align-middle text-center">
                            <thead class="table-dark">
                                <tr>
                                    <th>Sr.No</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Address</th>
                                    <th>Company</th>
                                    <th>Message</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($enquiry_data as $index => $item)
                                    <tr>
                                        <td>{{ $enquiry_data->firstItem() + $index }}</td>
                                        <td>{{ $item->name }}</td>
                                        <td>{{ $item->email }}</td>
                                        <td style="white-space: pre-line;">{{ $item->address }}</td>
                                        <td>{{ $item->company }}</td>
                                        <td style="max-width:400px; text-align:left;">
                                            @php
                                                $plainMessage = strip_tags($item->message);
                                                $shortMessage = \Illuminate\Support\Str::words(
                                                    $plainMessage,
                                                    15,
                                                    '...',
                                                );
                                                $isLong = mb_strlen($plainMessage) > mb_strlen($shortMessage);
                                            @endphp
                                            <div class="about-desc" data-id="enquiry-{{ $item->id }}">
                                                <div class="short-text">
                                                    {!! nl2br(e($shortMessage)) !!}
                                                    @if ($isLong)
                                                        <a href="#" class="toggle-desc ms-2" data-action="expand">See
                                                            more</a>
                                                    @endif
                                                </div>
                                                @if ($isLong)
                                                    <div class="full-text d-none">
                                                        {!! $item->message !!}
                                                        <div><a href="#" class="toggle-desc"
                                                                data-action="collapse">See less</a></div>
                                                    </div>
                                                @endif
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center py-4">
                                            <div class="text-muted">
                                                <i class="fas fa-inbox fa-2x mb-2 d-block"></i>
                                                No enquiries found.
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>

                        <!-- Pagination + showing X to Y of Z -->
                        <div class="d-flex justify-content-between align-items-center mt-3">
                            <div class="text-muted">
                                @if ($enquiry_data->total() > 0)
                                    Showing {{ $enquiry_data->firstItem() }} to {{ $enquiry_data->lastItem() }} of
                                    {{ $enquiry_data->total() }} entries
                                @else
                                    Showing 0 to 0 of 0 entries
                                @endif
                            </div>
                            <div>
                                <nav>
                                    <ul class="pagination mb-0 justify-content-center">
                                        @for ($i = 1; $i <= $enquiry_data->lastPage(); $i++)
                                            <li class="page-item {{ $enquiry_data->currentPage() == $i ? 'active' : '' }}">
                                                <a class="page-link"
                                                    href="{{ $enquiry_data->url($i) }}">{{ $i }}</a>
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

        <style>
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

        <script>
            document.addEventListener('DOMContentLoaded', function() {

                // Toggle message See more / See less
                document.body.addEventListener('click', function(e) {
                    const t = e.target;
                    if (t && t.classList.contains('toggle-desc')) {
                        e.preventDefault();
                        const wrapper = t.closest('.about-desc');
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

                // Auto-dismiss flash messages
                ['successAlert', 'errorAlert'].forEach(function(id) {
                    const el = document.getElementById(id);
                    if (el) setTimeout(() => new bootstrap.Alert(el).close(), 3000);
                });

            });
        </script>
    @endsection
