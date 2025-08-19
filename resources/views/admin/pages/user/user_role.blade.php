@extends('admin.layout.content')
@section('content')
    <div class="pagetitle">
        <h1>Users</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                <li class="breadcrumb-item">Product Category</li>
                <li class="breadcrumb-item active">Data</li>
            </ol>
        </nav>
    </div>
    <style>
        .dx-datagrid .dx-data-row>td.bullet {
            padding-top: 0;
            padding-bottom: 0;
        }
    </style>
    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                    
                        <hr>
                        <div id="gridContainer"></div>
                    </div>
                </div>
            </div>
        </div>
    </section>


  

<!-- Assign Roles Modal -->
<div class="modal fade" id="assignRolesModal" tabindex="-1" aria-labelledby="assignRolesModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="assignRolesModalLabel">Assign Roles</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="text-center mb-3">
                    <img id="userImage" src="" alt="User Image" class="rounded-circle" width="80" height="80" style="display: none;">
                    <h5 id="userName" class="mt-2"></h5>
                </div>
                
                <form id="assignRolesForm">
                    @csrf
                    <div id="rolesContainer" class="mb-3">
                        <!-- Roles checkboxes will be inserted here by JavaScript -->
                    </div>
                    
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Assign Roles</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
@section('tabledev')
<script src="{{ asset('admin/ajax_crud/user_role_management.js') }}"></script>
@endsection
