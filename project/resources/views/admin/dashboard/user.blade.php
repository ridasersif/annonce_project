@extends('admin.layouts.app')

@section('content')
    <div class="container py-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="mb-0">list Users</h2>
         
        </div>
        <div class="card shadow-sm">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover text-center">
                        <thead class="table-light">
                            <tr>
                                <th>Id</th>
                                <th>name</th>
                               
                                <th>role</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                                <tr>
                                    <td>{{ $user->id }}</td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->role->name ?? 'null' }}</td>
                                
                                    <td>
                                        <div class="btn-group">

                                          

                                            <button class="btn btn-sm btn-outline-danger" data-bs-toggle="modal"
                                                data-bs-target="#deleteOfferModal{{ $user->id }}">
                                                <i class="fas fa-trash"></i>
                                            </button>

                                            <button class="btn btn-sm btn-outline-info" data-bs-toggle="modal"
                                                data-bs-target="#showUserModal{{ $user->id }}">
                                               show <i class="fas fa-eye"></i>
                                            </button>

                                        </div>
                                    </td>
                                </tr>

                                {{-- Modal for Editing Offer --}}
                                {{-- <div class="modal fade" id="editOfferModal{{ $offer->id }}" tabindex="-1"
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
                                </div> --}}
                                {{-- End Modal for Editing Offer --}}

                                {{-- Modal for Showing Offer --}}
                               <!-- User Details Modal -->
                                    <!-- User Details Modal -->
                                <div class="modal fade" id="showUserModal{{ $user->id }}" tabindex="-1"
                                    aria-labelledby="showUserModalLabel{{ $user->id }}" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header bg-primary text-white">
                                                <h5 class="modal-title" id="showUserModalLabel{{ $user->id }}">
                                                    User Details
                                                </h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body text-start">
                                                <p><strong>Name:</strong> {{ $user->name }}</p>
                                                <p><strong>Email:</strong> {{ $user->email }}</p>

                                                <!-- Form to update user role -->
                                                <form action="{{ route('users.updateRole') }}" method="POST">
                                                    @csrf
                                                    <input type="hidden" name="user_id" value="{{ $user->id }}">

                                                    <label for="roleSelect{{ $user->id }}" class="form-label mt-2">Select Role:</label>
                                                    <select class="form-select" name="role_id" id="roleSelect{{ $user->id }}">
                                                        @foreach ($roles as $role)
                                                            <option value="{{ $role->id }}" {{ $user->role_id == $role->id ? 'selected' : '' }}>
                                                                {{ $role->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>

                                                    <div class="modal-footer mt-3">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-success">Save</button>
                                                    </div>
                                                </form>

                                            </div>
                                        </div>
                                    </div>
                                </div>


                                {{--And Modal for Showing Offer --}}

                                {{-- Modal for Deleting Offer --}}
                                <div class="modal fade" id="deleteOfferModal{{ $user->id }}" tabindex="-1"
                                    aria-labelledby="deleteOfferModalLabel{{ $user->id }}" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="deleteOfferModalLabel{{ $user->id }}">Delete Offer
                                                </h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <p>Are you sure you want to delete this user? This action cannot be undone.</p>
                                            </div>
                                            <div class="modal-footer">
                                               <form action="{{ route('user.destroy', $user->id) }}" method="POST"> 
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
                        {{ $users->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>

  

@endsection

@section('scripts')
    <!-- FontAwesome -->

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    {{-- <script>
        function deleteUser(event){
            let id = event.target.getAttribute('data-id');
            let url= "{{route('user.destroy', ':id')}}";
           
        
        }

    </script> --}}

@endsection