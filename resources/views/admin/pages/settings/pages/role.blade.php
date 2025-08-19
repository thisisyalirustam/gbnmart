@extends('admin.layout.content')
@section('content')
    <div class="pagetitle">
        <h1>Roles</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                <li class="breadcrumb-item">Settings</li>
                <li class="breadcrumb-item active">Roles</li>
            </ol>
        </nav>
    </div>

    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <button type="button" class="btn mt-2" data-bs-toggle="modal" data-bs-target="#addRole">
                            <i class="bi bi-plus-lg txt-primary"></i> Add New Role
                        </button>
                        <hr>
                        <div id="rolesGrid"></div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Add Role Modal -->
    <div class="modal fade" id="addRole" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add New Role</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                   <form id="roleForm">
    @csrf
    <div class="mb-3">
        <label for="roleName" class="form-label">Name</label>
        <input type="text" class="form-control" id="roleName" name="name" required>
    </div>
    <button type="submit" class="btn btn-primary">Save</button>
</form>

                </div>
            </div>
        </div>
    </div>

    <!-- Edit Role Modal -->
    <div class="modal fade" id="editRole" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Role</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="editRoleForm">
    @csrf
    <input type="hidden" id="editRoleId" name="id">
    <div class="mb-3">
        <label for="editRoleName" class="form-label">Name</label>
        <input type="text" class="form-control" id="editRoleName" name="name" required>
    </div>
    <button type="submit" class="btn btn-primary">Update</button>
</form>

                </div>
            </div>
        </div>
    </div>

    <!-- Delete Confirmation Modal -->
    <div class="modal fade" id="deleteRole" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Confirm Delete</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to delete this role?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-danger" id="confirmDeleteRole">Delete</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('tabledev')
<script src="{{ asset('admin/ajax_crud/role.js') }}"></script>
@endsection
