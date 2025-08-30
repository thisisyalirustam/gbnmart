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

                        <!-- Role Selector -->
                        <div class="btn-group mt-2 mr-2">
                            <button type="button" class="btn btn-light dropdown-toggle" data-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false">
                                <i class="bi bi-folder-plus"></i> Select Roles
                            </button>

                            <div class="dropdown-menu p-3 shadow-sm" style="min-width: 250px;">
                                <h6 class="text-muted mb-2">Select Roles</h6>
                                <form id="roleAssignmentForm">
                                    <div class="collection-scroll" style="max-height: 200px; overflow-y: auto;">
                                        @foreach ($roles as $role)
                                            <div class="form-check mb-2">
                                                <input class="form-check-input collection-checkbox" type="checkbox"
                                                    id="role{{ $role->id }}" value="{{ $role->id }}">
                                                <label class="form-check-label"
                                                    for="role{{ $role->id }}">{{ $role->name }}</label>
                                            </div>
                                        @endforeach
                                    </div>
                                    <hr class="my-2">
                                    <button type="submit" class="btn btn-sm btn-secondary btn-block">Assign Roles</button>
                                </form>
                            </div>
                        </div>

                        <hr>

                        <!-- Roles Grid -->
                        <div id="rolesGrid"></div>

                        <!-- Assign Permissions Modal -->
                        <div class="modal fade" id="assignPermissionsModal" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Edit Role Permissions</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                    </div>
                                    <div class="modal-body"></div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('tabledev')
    <script>
        const rolesData = @json($roles); // inject roles with permissions
    </script>
    <script src="{{ asset('admin/ajax_crud/allrolePermession.js') }}"></script>
@endsection
