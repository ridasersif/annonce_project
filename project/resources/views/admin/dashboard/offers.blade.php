@extends('society.layouts.app')

@section('content')
    <div class="container py-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="mb-0">Offers</h2>
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addOfferModal">
                <i class="fas fa-plus-circle me-2"></i> Add Offer
            </button>
        </div>
        <div class="card shadow-sm">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover text-center">
                        <thead class="table-light">
                            <tr>
                                <th>Id</th>
                                <th>Title</th>
                                <th>Price</th>
                                <th>Capacity</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($offers as $offer)
                                <tr>
                                    <td>{{ $offer->id }}</td>
                                    <td>{{ $offer->title }}</td>
                                    <td>${{ number_format($offer->price, 2) }}</td>
                                    <td>{{ $offer->capacity }}</td>
                                    <td>
                                        <span style="cursor: pointer" id="status-{{ $offer->id }}"
                                            class="badge bg-{{ $offer->status == 'active' ? 'success' : 'secondary' }} cursor-pointer"
                                            onclick="toggleStatus({{ $offer->id }})">
                                            {{ ucfirst($offer->status) }}
                                        </span>
                                    </td>
                                    <td>
                                        <div class="btn-group">

                                            <button class="btn btn-sm btn-outline-primary" data-bs-toggle="modal"
                                                data-bs-target="#editOfferModal{{ $offer->id }}">
                                                <i class="fas fa-edit"></i>
                                            </button>

                                            <button class="btn btn-sm btn-outline-danger" data-bs-toggle="modal"
                                                data-bs-target="#deleteOfferModal{{ $offer->id }}">
                                                <i class="fas fa-trash"></i>
                                            </button>

                                            <button class="btn btn-sm btn-outline-info" data-bs-toggle="modal"
                                                data-bs-target="#showOfferModal{{ $offer->id }}">
                                                <i class="fas fa-eye"></i>
                                            </button>

                                        </div>
                                    </td>
                                </tr>

                                {{-- Modal for Editing Offer --}}
                                <div class="modal fade" id="editOfferModal{{ $offer->id }}" tabindex="-1"
                                    aria-labelledby="editOfferModal{{ $offer->id }}" aria-hidden="true">
                                    <div class="modal-dialog modal-lg modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header bg-primary text-white">
                                                <h5 class="modal-title">
                                                    <i class="fas fa-gift me-2"></i> Update Offer
                                                </h5>
                                                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="{{ route('offer.update', $offer->id) }}" method="POST"
                                                    id="editOfferForm{{ $offer->id }}">
                                                    @csrf
                                                    @method('PUT')
                                                    <div class="col-md-6 mb-3">
                                                        <label class="form-label fw-bold">Title</label>
                                                        <input type="text" name="title" class="form-control"
                                                            value="{{ $offer->title }}">
                                                        @error('title')
                                                            <div class="text-danger">{{ $message }}</div>
                                                        @enderror
                                                    </div>

                                                    <div class="mb-3">
                                                        <label class="form-label fw-bold">Description</label>
                                                        <textarea name="description" class="form-control"
                                                            rows="3">{{ $offer->description }}</textarea>
                                                        @error('description')
                                                            <div class="text-danger">{{ $message }}</div>
                                                        @enderror
                                                    </div>

                                                    <div class="row">
                                                        <div class="col-md-6 mb-3">
                                                            <label class="form-label fw-bold">Start Date</label>
                                                            <input type="date" name="start_date" class="form-control"
                                                                value="{{ $offer->start_date }}">
                                                            @error('start_date')
                                                                <div class="text-danger">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                        <div class="col-md-6 mb-3">
                                                            <label class="form-label fw-bold">End Date</label>
                                                            <input type="date" name="end_date" class="form-control"
                                                                value="{{ $offer->end_date }}">
                                                            @error('end_date')
                                                                <div class="text-danger">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                    <div class="row">
                                                        <div class="col-md-6 mb-3">
                                                            <label class="form-label fw-bold">Price</label>
                                                            <div class="input-group">
                                                                <span class="input-group-text">$</span>
                                                                <input type="number" name="price" class="form-control"
                                                                    step="0.01" min="0" value="{{ $offer->price }}">
                                                            </div>
                                                            @error('price')
                                                                <div class="text-danger">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                        <div class="col-md-6 mb-3">
                                                            <label class="form-label fw-bold">Capacity</label>
                                                            <input type="number" name="capacity" class="form-control" min="1"
                                                                value="{{ $offer->capacity }}">
                                                            @error('capacity')
                                                                <div class="text-danger">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                            <div class="modal-footer bg-light">
                                                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                                                    <i class="fas fa-times me-1"></i> Cancel
                                                </button>
                                                <button type="submit" form="editOfferForm{{ $offer->id }}"
                                                    class="btn btn-primary">
                                                    <i class="fas fa-save me-1"></i> Update Offer
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {{-- End Modal for Editing Offer --}}

                                {{-- Modal for Showing Offer --}}
                                <div class="modal fade" id="showOfferModal{{ $offer->id }}" tabindex="-1"
                                    aria-labelledby="showOfferModalLabel{{ $offer->id }}" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="showOfferModalLabel{{ $offer->id }}">Offer Details
                                                </h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body text-start">
                                                <p><strong>Title:</strong> {{ $offer->title }}</p>
                                                <p><strong>Description:</strong> {{ $offer->description }}</p>
                                                <p><strong>Price:</strong> {{ number_format($offer->price, 2) }}$</p>
                                                <p><strong>Capacity:</strong> {{ $offer->capacity }}</p>
                                                <p><strong>Start Date:</strong> {{ $offer->start_date }}</p>
                                                <p><strong>End Date:</strong> {{ $offer->end_date }}</p>
                                                <p><strong>Status:</strong> <span
                                                        class="badge bg-{{ $offer->status == 'active' ? 'success' : 'secondary' }}">{{ ucfirst($offer->status) }}</span>
                                                </p>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">Close</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {{--And Modal for Showing Offer --}}

                                {{-- Modal for Deleting Offer --}}
                                <div class="modal fade" id="deleteOfferModal{{ $offer->id }}" tabindex="-1"
                                    aria-labelledby="deleteOfferModalLabel{{ $offer->id }}" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="deleteOfferModalLabel{{ $offer->id }}">Delete Offer
                                                </h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <p>Are you sure you want to delete this offer? This action cannot be undone.</p>
                                            </div>
                                            <div class="modal-footer">
                                                <form action="{{ route('offer.destroy', $offer->id) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-danger">Confirm Delete</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {{-- And Modal for Deleting Offer --}}

                            @endforeach
                        </tbody>
                    </table>
                    {{-- Pagination --}}
                    <div class="d-flex justify-content-center">
                        {{ $offers->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal for Adding Offer -->
    <div class="modal fade" id="addOfferModal" tabindex="-1" aria-labelledby="addOfferModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title" id="addOfferModalLabel">
                        <i class="fas fa-gift me-2"></i>Add New Offer
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('offer.store') }}" method="POST" id="addOfferForm">
                        @csrf

                        <!-- Display Global Errors -->
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">Title</label>
                                <input type="text" name="title" class="form-control" value="{{ old('title') }}" required>
                                @error('title')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">Status</label>
                                <select name="status" class="form-select">
                                    <option value="active" {{ old('status') == 'active' ? 'selected' : '' }}>Active</option>
                                    <option value="inactive" {{ old('status') == 'inactive' ? 'selected' : '' }}>Inactive
                                    </option>
                                </select>
                                @error('status')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">Description</label>
                            <textarea name="description" class="form-control" rows="3"
                                required>{{ old('description') }}</textarea>
                            @error('description')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">Start Date</label>
                                <input type="date" name="start_date" class="form-control" value="{{ old('start_date') }}"
                                    required>
                                @error('start_date')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">End Date</label>
                                <input type="date" name="end_date" class="form-control" value="{{ old('end_date') }}"
                                    required>
                                @error('end_date')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">Price</label>
                                <div class="input-group">
                                    <span class="input-group-text">$</span>
                                    <input type="number" name="price" class="form-control" step="0.01" min="0"
                                        value="{{ old('price') }}" required>
                                </div>
                                @error('price')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">Capacity</label>
                                <input type="number" name="capacity" class="form-control" min="1"
                                    value="{{ old('capacity') }}" required>
                                @error('capacity')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer bg-light">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                        <i class="fas fa-times me-1"></i> Cancel
                    </button>
                    <button type="submit" form="addOfferForm" class="btn btn-primary">
                        <i class="fas fa-save me-1"></i> Save Offer
                    </button>
                </div>
            </div>
        </div>
    </div>
    <!-- And Modal for Adding Offer -->

@endsection

@section('scripts')
    <!-- FontAwesome -->

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{asset('js/offer/offer.js')}}"></script>

@endsection