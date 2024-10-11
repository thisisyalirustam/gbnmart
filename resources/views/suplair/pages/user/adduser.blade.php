@extends('admin.layout.content')
@section('content')
    <div class="page-header">
        <h3 class="page-title"> Basic Tables </h3>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Tables</a></li>
                <li class="breadcrumb-item active" aria-current="page">Basic tables</li>
            </ol>
        </nav>
    </div>
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                {{-- data table  --}}
                <div class="dx-viewport demo-container">
                    <div class="row">
                        <div class="col-12 d-flex justify-content-end mb-2">
                            <button type="button" class="btn btn-outline-secondary btn-icon-text" data-bs-toggle="modal"
                                data-bs-target="#staticBackdrop">
                                <i class="mdi mdi-plus btn-icon-prepend"></i> Add User </button>
                        </div>
                    </div mt-4>
                    <div id="gridContainer"></div>
                </div>
                {{-- end of data table  --}}
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Modal -->
    <div class="modal fade custom-modal" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false"
        tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Add New User</h1>
                <button type="button" class="btn btn-inverse-danger btn-icon" data-bs-dismiss="modal"
                        aria-label="Close">
                    <i class="mdi mdi-close"></i>
                </button>
            </div>
            <div class="modal-body">
                <form id="addUserForm" enctype="multipart/form-data">
                    
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" class="form-control" id="name" placeholder="Enter name" name="name">
                            </div>
                            <div class="mb-3">
                                <label for="user_type" class="form-label">User Type</label>
                                <select class="form-control" id="user_type" name="user_type">
                                    <option>Select User Type</option>
                                    <option value="user">Buyer</option>
                                    <option value="supplier">Supplier</option>
                                    <option value="admin">Admin</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" placeholder="Enter Email" name="email">
                            </div>
                            <div class="mb-3">
                                <label for="address" class="form-label">Address</label>
                                <input type="text" class="form-control" id="address" placeholder="Enter address" name="address">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" class="form-control" id="password" placeholder="Password" name="password">
                            </div>
                            <div class="mb-3">
                                <label for="image" class="form-label">Profile</label>
                                <div class="input-group col-xs-12">
                                    <input type="file" class="form-control file-upload-info" id="image" name="image" placeholder="Upload Image">
                                    <span class="input-group-append">
                                        <button type="button" class="file-upload-browse btn btn-outline-primary btn-icon-text">
                                            <i class="mdi mdi-upload btn-icon-prepend"></i> Upload
                                        </button>
                                    </span>
                                </div>
                            </div>
                            <button id="save" type="submit" class="btn btn-outline-primary btn-icon-text">
                                <i class="mdi mdi-file-check btn-icon-prepend"></i> Submit
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
     </div>

     
     <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="{{ asset('admin/assets/ajaxcode.js') }}"></script>

@endsection
