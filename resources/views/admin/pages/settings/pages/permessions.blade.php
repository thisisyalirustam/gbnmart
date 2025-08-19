@extends('admin.layout.content')
@section('content')
    <div class="pagetitle">
        <h1>Permissions</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                <li class="breadcrumb-item">Settings</li>
                <li class="breadcrumb-item active">Permissions</li>
            </ol>
        </nav>
    </div>

    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <button type="button" class="btn mt-2" data-bs-toggle="modal" data-bs-target="#addPermission">
                            <i class="bi bi-plus-lg txt-primary"></i> Add New Permission
                        </button>
                        <hr>
                        <div id="permissionsGrid"></div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Add Permission Modal -->
    <div class="modal fade" id="addPermission" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add New Permission</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="permissionForm">
                        @csrf
                        <div class="mb-3">
                            <label for="permissionName" class="form-label">Name</label>
                            <input type="text" class="form-control" id="permissionName" name="name" required>
                        </div>
                        <div class="mb-3">
                            <label for="guardName" class="form-label">Guard Name</label>
                            <input type="text" class="form-control" id="guardName" name="guard_name" value="web" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Permission Modal -->
    <div class="modal fade" id="editPermission" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Permission</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="editPermissionForm">
                        @csrf
                        @method('PUT')
                        <input type="hidden" id="editPermissionId" name="id">
                        <div class="mb-3">
                            <label for="editPermissionName" class="form-label">Name</label>
                            <input type="text" class="form-control" id="editPermissionName" name="name" required>
                        </div>
                        <div class="mb-3">
                            <label for="editGuardName" class="form-label">Guard Name</label>
                            <input type="text" class="form-control" id="editGuardName" name="guard_name" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Delete Confirmation Modal -->
    <div class="modal fade" id="deletePermission" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Confirm Delete</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to delete this permission?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-danger" id="confirmDelete">Delete</button>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('tabledev')
<script src="{{ asset('admin/ajax_crud/permessions.js') }}"></script>
@endsection