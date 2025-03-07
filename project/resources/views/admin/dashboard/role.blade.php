@extends('admin.layouts.app')

@section('content')
    <div class="container py-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="mb-0">Roles</h2>
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addRolerModal">
                <i class="fas fa-plus-circle me-2"></i> Add Role
            </button>
        </div>
        <div class="card shadow-sm">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover text-center">
                        <thead class="table-light">
                            <tr>
                                <th>Id</th>
                                <th>name</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($roles as $role)
                                <tr>
                                    <td>{{ $role->id }}</td>
                                    <td>{{ $role->name }}</td>
        
                                    <td>
                                        <div class="btn-group">
                                            <button class="btn btn-sm btn-outline-primary" data-bs-toggle="modal"
                                                data-bs-target="#editRoleModal{{ $role->id }}">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                            <button class="btn btn-sm btn-outline-danger" data-bs-toggle="modal"
                                                data-bs-target="#deleteOfferModal{{ $role->id }}">
                                                <i class="fas fa-trash"></i>
                                            </button>
    
                                        </div>
                                    </td>
                                </tr>

                               {{-- Modal for Editing Role --}}
                                <div class="modal fade" id="editRoleModal{{ $role->id }}" tabindex="-1"
    aria-labelledby="editRoleModal{{ $role->id }}" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title">
                    {{ $role->name }}
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('role.update', $role->id) }}" method="POST" id="editRoleForm{{ $role->id }}">
                    @csrf
                    @method('PUT')

                    <div class="form-group">
                        <label for="permissions">Permissions</label>
                        <div class="row">
                            @foreach ($permissions as $permission)
                                <!-- Every 3 checkboxes, open a new row -->
                                @if ($loop->index % 3 == 0 && $loop->index != 0)
                                    </div><div class="row">
                                @endif
                                <div class="col-md-4 mb-3">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="{{ $permission->id }}"
                                            name="permissions[]" id="permission{{ $permission->id }}"
                                            @if ($role->permissions->contains($permission->id)) checked @endif>
                                        <label class="form-check-label" for="permission{{ $permission->id }}">
                                            {{ $permission->name }}
                                        </label>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                </form>
            </div>
            <div class="modal-footer bg-light">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                    <i class="fas fa-times me-1"></i> Cancel
                </button>
                <button type="submit" form="editRoleForm{{ $role->id }}" class="btn btn-primary">
                    <i class="fas fa-save me-1"></i> Save
                </button>
            </div>
        </div>
    </div>
</div>

                                {{-- End Modal for Editing Role --}}

                                

                                {{-- Modal for Deleting Offer --}}
                                <div class="modal fade" id="deleteOfferModal{{ $role->id }}" tabindex="-1"
                                    aria-labelledby="deleteOfferModalLabel{{ $role->id }}" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="deleteOfferModalLabel{{ $role->id }}">Delete role
                                                </h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <p>Are you sure you want to delete this role? This action cannot be undone.</p>
                                            </div>
                                            <div class="modal-footer">
                                                <form action="{{ route('role.destroy', $role->id) }}" method="POST">
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
                  
                </div>
            </div>
        </div>
    </div>

    <!-- Modal for Adding Offer -->
    <div class="modal fade" id="addRolerModal" tabindex="-1" aria-labelledby="addRoleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title" id="addRoleModalLabel">
                        <i class="fas fa-gift me-2"></i>Add New role
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('role.store') }}" method="POST" id="addOfferForm">
                        @csrf
                            <div class=" mb-3 ">
                                <label class="form-label fw-bold">Name</label>
                                <input type="text" name="name" class="form-control">
                            </div>
                    </form>
                </div>
                <div class="modal-footer bg-light">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                        <i class="fas fa-times me-1"></i> Cancel
                    </button>
                    <button type="submit" form="addOfferForm" class="btn btn-primary">
                        <i class="fas fa-save me-1"></i> Save Role
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