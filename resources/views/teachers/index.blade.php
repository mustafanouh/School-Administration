@extends('layouts.app')

@section('title', 'Instructors')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 fw-bold">Teachers</h1>
            <p class="text-muted">List of all teachers</p>
        </div>
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createModal">
            <i class="fas fa-plus me-2"></i>Create New Teacher
        </button>
    </div>

    <div class="card">
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead class="table-light">
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>specialization</th>
                        <th class="text-end">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $dummyInstructors = [
                            [
                                'id' => 1,
                                'name' => 'Dr. John Smith',
                                'email' => 'john.smith@university.edu',
                                'phone' => '+1234567800',
                                'department' => 'Computer Science',
                            ],
                            [
                                'id' => 2,
                                'name' => 'Prof. Emily Johnson',
                                'email' => 'emily.johnson@university.edu',
                                'phone' => '+1234567801',
                                'department' => 'Computer Science',
                            ],
                            [
                                'id' => 3,
                                'name' => 'Dr. Michael Brown',
                                'email' => 'michael.brown@university.edu',
                                'phone' => '+1234567802',
                                'department' => 'Business Administration',
                            ],
                            [
                                'id' => 4,
                                'name' => 'Prof. Sarah Davis',
                                'email' => 'sarah.davis@university.edu',
                                'phone' => '+1234567803',
                                'department' => 'Engineering',
                            ],
                        ];
                    @endphp
                    @foreach ($dummyInstructors as $instructor)
                        <tr>
                            <td>{{ $instructor['id'] }}</td>
                            <td><strong>{{ $instructor['name'] }}</strong></td>
                            <td>{{ $instructor['email'] }}</td>
                            <td>{{ $instructor['phone'] }}</td>
                            <td>{{ $instructor['department'] }}</td>
                            <td class="text-end">
                                <button class="btn btn-sm btn-info" data-bs-toggle="modal"
                                    data-bs-target="#viewModal{{ $instructor['id'] }}">
                                    <i class="fas fa-eye"></i> View
                                </button>
                                <button class="btn btn-sm btn-success" data-bs-toggle="modal"
                                    data-bs-target="#editModal{{ $instructor['id'] }}">
                                    <i class="fas fa-edit"></i> Edit
                                </button>
                                <button class="btn btn-sm btn-danger" data-bs-toggle="modal"
                                    data-bs-target="#deleteModal{{ $instructor['id'] }}">
                                    <i class="fas fa-trash"></i> Delete
                                </button>
                            </td>
                        </tr>

                        <!-- View Modal -->
                        <div class="modal fade" id="viewModal{{ $instructor['id'] }}" tabindex="-1">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Instructor Details</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                    </div>
                                    <div class="modal-body">
                                        <dl class="row">
                                            <dt class="col-sm-3">ID</dt>
                                            <dd class="col-sm-9">{{ $instructor['id'] }}</dd>
                                            <dt class="col-sm-3">Name</dt>
                                            <dd class="col-sm-9">{{ $instructor['name'] }}</dd>
                                            <dt class="col-sm-3">Email</dt>
                                            <dd class="col-sm-9">{{ $instructor['email'] }}</dd>
                                            <dt class="col-sm-3">Phone</dt>
                                            <dd class="col-sm-9">{{ $instructor['phone'] }}</dd>
                                            <dt class="col-sm-3">Department</dt>
                                            <dd class="col-sm-9">{{ $instructor['department'] }}</dd>
                                        </dl>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Close</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Edit Modal -->
                        <div class="modal fade" id="editModal{{ $instructor['id'] }}" tabindex="-1">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <form method="POST" action="#">
                                        @csrf
                                        @method('PUT')
                                        <div class="modal-header">
                                            <h5 class="modal-title">Edit Instructor</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="mb-3">
                                                <label class="form-label">Name</label>
                                                <input type="text" name="name" class="form-control"
                                                    value="{{ $instructor['name'] }}" required>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">Email</label>
                                                <input type="email" name="email" class="form-control"
                                                    value="{{ $instructor['email'] }}" required>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">Phone</label>
                                                <input type="tel" name="phone" class="form-control"
                                                    value="{{ $instructor['phone'] }}" required>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">Department</label>
                                                <select name="department_id" class="form-select" required>
                                                    <option>Computer Science</option>
                                                    <option>Engineering</option>
                                                    <option>Business Administration</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">Cancel</button>
                                            <button type="submit" class="btn btn-success">Update</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <!-- Delete Modal -->
                        <div class="modal fade" id="deleteModal{{ $instructor['id'] }}" tabindex="-1">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <form method="POST" action="#">
                                        @csrf
                                        @method('DELETE')
                                        <div class="modal-header">
                                            <h5 class="modal-title">Delete Instructor</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                        </div>
                                        <div class="modal-body">
                                            <p>Are you sure you want to delete <strong>{{ $instructor['name'] }}</strong>?
                                            </p>
                                            <p class="text-danger small">This action cannot be undone.</p>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">Cancel</button>
                                            <button type="submit" class="btn btn-danger">Delete</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="card-footer d-flex justify-content-between align-items-center">
            <small class="text-muted">Showing 1 to 4 of 4 results</small>
            <nav>
                <ul class="pagination pagination-sm mb-0">
                    <li class="page-item disabled"><a class="page-link" href="#">Previous</a></li>
                    <li class="page-item active"><a class="page-link" href="#">1</a></li>
                    <li class="page-item disabled"><a class="page-link" href="#">Next</a></li>
                </ul>
            </nav>
        </div>
    </div>

    <!-- Create Modal -->
    <div class="modal fade" id="createModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <form method="POST" action="#">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title">Create New Instructor</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">Name</label>
                            <input type="text" name="name" class="form-control"
                                placeholder="Enter instructor name" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input type="email" name="email" class="form-control" placeholder="Enter email"
                                required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Phone</label>
                            <input type="tel" name="phone" class="form-control" placeholder="Enter phone number"
                                required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Department</label>
                            <select name="department_id" class="form-select" required>
                                <option value="">-- Select Department --</option>
                                <option>Computer Science</option>
                                <option>Engineering</option>
                                <option>Business Administration</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Create</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
