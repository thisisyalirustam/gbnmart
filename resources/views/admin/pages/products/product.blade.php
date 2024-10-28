@extends('admin.layout.content')
@section('content')
    <div class="pagetitle">
        <h1>Product</h1>
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
                        <a type="button" class="btn mt-2" href="{{ route('product_create') }}">
                            <i class="bi bi-plus-lg txt-primary"></i> Add New
                        </a>
                        <hr>
                        <div id="gridContainer"></div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    {{-- create model --}}
    <div class="modal fade" id="add" tabindex="-1" aria-hidden="true" style="display: none;">
      <div class="modal-dialog modal-xl modal-dialog-centered">
          <div class="modal-content">
              <div class="modal-header">
                <div id="successAlert" class="alert alert-success d-none" role="alert">
                  User created successfully!
                </div>
                  <h5 class="modal-title">Add New Product</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">

                  <form id="addform">
                      @csrf
                      <input type="hidden" id="csrf_token" name="_token" value="{{ csrf_token() }}">
                      <div class="row">
                        <div class="col-md-6">
                            <div class="row mb-3">
                                <div class="col-sm-12">
                                    <label for="comments" class="form-label">Name</label>
                                    <input type="text" name="name" id="name" class="form-control">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-sm-12">
                                    <label for="comments" class="form-label">Product Category</label>
                                    <select id="p_sub_cat" name="user_type" class="form-select">
                                        <option selected="">Select User Type</option>
                                        <option value="buyer">buyer</option>
                                        <option value="supplier">Supplier</option>
                                        <option value="admin">Admin</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-sm-12">
                                    <label for="comments" class="form-label">Sub Category</label>
                                    <select id="p_sub_cat" name="user_type" class="form-select">
                                        <option selected="">Select User Type</option>
                                        <option value="buyer">buyer</option>
                                        <option value="supplier">Supplier</option>
                                        <option value="admin">Admin</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-3">
                                    <label for="imageUpload1" class="form-label">Upload Image</label>
                                    <div id="dropArea1" class="border border-primary rounded p-3 text-center drop-area">
                                        <p><i class="bi bi-upload" style="font-size: 2rem; color: #6c757d;"></i></p>
                                        <p>Select Product Image</p>
                                        <input type="file" id="imageUpload1" class="form-control d-none" accept="image/*">
                                        <div id="preview1" class="mt-3 preview-container"></div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <label for="imageUpload2" class="form-label">Upload Image</label>
                                    <div id="dropArea2" class="border border-primary rounded p-3 text-center drop-area">
                                        <p><i class="bi bi-upload" style="font-size: 2rem; color: #6c757d;"></i></p>
                                        <p>Select Product Image</p>
                                        <input type="file" id="imageUpload2" class="form-control d-none" accept="image/*">
                                        <div id="preview2" class="mt-3 preview-container"></div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <label for="imageUpload3" class="form-label">Upload Image</label>
                                    <div id="dropArea3" class="border border-primary rounded p-3 text-center drop-area">
                                        <p><i class="bi bi-upload" style="font-size: 2rem; color: #6c757d;"></i></p>
                                        <p>Select Product Image</p>
                                        <input type="file" id="imageUpload3" class="form-control d-none" accept="image/*">
                                        <div id="preview3" class="mt-3 preview-container"></div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <label for="imageUpload3" class="form-label">Upload Image</label>
                                    <div id="dropArea3" class="border border-primary rounded p-3 text-center drop-area">
                                        <p><i class="bi bi-upload" style="font-size: 2rem; color: #6c757d;"></i></p>
                                       <p>Select Product Image</p>
                                        <input type="file" id="imageUpload3" class="form-control d-none" accept="image/*">
                                        <div id="preview3" class="mt-3 preview-container"></div>
                                    </div>
                                </div>
                            </div>



                        </div>

                        <div class="col-md-6">
                            <div class="row mb-3">
                                <div class="col-sm-12">
                                    <label for="comments" class="form-label">Price</label>
                                    <input type="number" name="name" id="name" class="form-control">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-sm-12">
                                    <label for="comments" class="form-label">Quantity</label>
                                    <input type="number" name="name" id="name" class="form-control">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-sm-12 mb-3">
                                    <label for="comments" class="form-label">Comments</label>
                                    <textarea class="form-control" id="comments" name="comments" rows="7" maxlength="1000" placeholder="Enter your comments here..."></textarea>
                                    <small id="commentsHelp" class="form-text text-muted">1000 characters left</small>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-12">
                                    <button type="submit" class="btn  btn-primary">Save</button>
                                </div>
                            </div>
                        </div>
                      </div>
                  </form>
              </div>
          </div>
      </div>
  </div>

<!-- Update Modal -->
<div class="modal fade" id="update" tabindex="-1" aria-hidden="true" style="display: none;">
  <div class="modal-dialog modal-xl modal-dialog-centered">
      <div class="modal-content">
          <div class="modal-header">
              <h5 class="modal-title">Update User</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">

              <form id="updateform">

                @csrf
                <input type="hidden" name="_method" value="PUT"> <!-- Method override for PUT -->
                <input type="hidden" id="updateid" name="id" value="">
                  <div class="row mb-3">
                      <label for="inputText" class="col-sm-2 col-form-label">Name</label>
                      <div class="col-sm-10">
                          <input type="text" name="name" id="updatename" class="form-control">
                      </div>
                  </div>
                  <div class="row mb-3">
                      <label for="inputEmail" class="col-sm-2 col-form-label">Email</label>
                      <div class="col-sm-10">
                          <input type="email" name="email" id="updateemail" class="form-control">
                      </div>
                  </div>

                  <div class="row mb-3">
                      <label for="inputNumber" class="col-sm-2 col-form-label">User Type</label>
                      <div class="col-sm-10">
                          <select id="updateuser_type" name="user_type" class="form-select">
                              <option value="buyer">buyer</option>
                              <option value="supplier">Supplier</option>
                              <option value="admin">Admin</option>
                          </select>
                      </div>
                  </div>

                  <div class="row mb-3">
                      <label for="inputNumber" class="col-sm-2 col-form-label">Profile Upload</label>
                      <div class="col-sm-10">
                          <input class="form-control" name="image" type="file" id="updateimage">
                      </div>
                  </div>
                 <div class="row mb-3">
                      <label for="inputNumber" class="col-sm-2 col-form-label">Profile</label>

                      <label for="inputNumber" class="col-sm-3 col-form-label">
                        <img src="" id="imageshow" height="200"  width="150" alt="" >
                      </label>
                  </div>

                  <div class="row mb-3">
                      <label class="col-sm-2 col-form-label">Submit Button</label>
                      <div class="col-sm-10">
                          <button type="submit" class="btn btn-primary">Submit Form</button>
                      </div>
                  </div>

              </form>
          </div>
      </div>
  </div>
</div>

{{-- user show model --}}
<div class="modal fade" id="show" tabindex="-1"
  aria-hidden="true" style="display: none;">
  <div class="modal-dialog modal-xl modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-body">
        </div>
          <div class="modal-footer">
              <button type="button" class="btn btn-secondary"
                  data-bs-dismiss="modal">Close</button>
              <button type="button" class="btn btn-primary">Save changes</button>
          </div>
      </div>
  </div>
</div>
{{-- edn of user show model --}}

{{-- user delete modal --}}
<div class="modal fade" id="delete" tabindex="-1" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-sm modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body text-center">
                <i class="bi bi-exclamation-triangle-fill text-danger" style="font-size: 3rem;"></i>
                <h5 class="card-title text-danger mt-3">Are You Sure?</h5>
                <p class="text-muted">This action cannot be undone.</p>
            </div>
            <form id="deleteForm" class="delete-form">
                @csrf
                <input type="hidden" name="_method" value="DELETE"> <!-- Method override for DELETE -->
                <input type="hidden" id="deleteid" name="id" value="">
                <div class="modal-footer justify-content-center">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-danger delete-btn">Delete</button>
                </div>
            </form>
        </div>
    </div>
</div>


<div class="modal fade" id="statusModal" tabindex="-1" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-sm modal-dialog-centered">
        <div class="modal-content">
            <form id="statusForm">
                <div class="modal-body text-center">
                    <i class="bi bi-shuffle" style="font-size: 3rem; color: #0d6efd;"></i>
                    <h5 class="modal-title mt-3" style="color: #0d6efd;">Change Status</h5>
                    <p class="text-muted">Are you sure you want to update the status?</p>
                </div>
                <div class="modal-body">
                    <select id="newStatus" class="form-control" name="status">
                        <option value="active">Active</option>
                        <option value="pending">Pending</option>
                        <option value="suspend">Suspend</option>
                        <option value="blocked">Block</option>
                    </select>
                    <!-- CSRF Token -->
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                </div>
                <div class="modal-footer justify-content-center">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Confirm</button>
                </div>
            </form>
        </div>
    </div>
</div>



<!-- SOF Change Modal -->
<div id="sofModal" class="modal fade" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-sm modal-dialog-centered">
        <div class="modal-content">
            <form id="sofForm">
                <div class="modal-body text-center">
                    <i class="bi bi-eye-fill" style="font-size: 3rem; color: #ffc107;"></i>
                    <p class="text-muted">Are you sure you want to change the visibility on the front page?</p>
                    <select id="newSOF" class="form-control mt-2" name="sof">
                        <option value="1">Yes - Show on Front</option>
                        <option value="0">No - Do Not Show on Front</option>
                    </select>
                    <!-- CSRF Token -->
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                </div>
                <div class="modal-footer justify-content-center">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-warning">Confirm Change</button>
                </div>
            </form>
        </div>
    </div>
</div>




@endsection
@section('tabledev')
<link rel="stylesheet" href="{{ asset('admin/custom_css/product.css') }}">
<script src="{{ asset('admin/customJs/product.js') }}"></script>
<script src="{{ asset('admin/ajax_crud/product.js') }}"></script>
@endsection
