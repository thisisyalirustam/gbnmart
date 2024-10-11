@extends('admin.layout.content')
@section('content')
    <div class="pagetitle">
        <h1>Users</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                <li class="breadcrumb-item">Product Brands</li>
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
                        <button type="button" class="btn mt-2" data-bs-toggle="modal" data-bs-target="#add">
                            <i class="bi bi-plus-lg txt-primary"></i> Add New Category
                        </button>
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
                  <h5 class="modal-title">Add Product Category</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                
                  <form id="addform">
                      @csrf
                      <input type="hidden" id="csrf_token" name="_token" value="{{ csrf_token() }}">
                      <div class="row mb-3">
                          <label for="inputText" class="col-sm-2 col-form-label">Name</label>
                          <div class="col-sm-10">
                              <input type="text" name="name" id="name" class="form-control">
                          </div>
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
   
<!-- Update Modal -->
<div class="modal fade" id="update" tabindex="-1" aria-hidden="true" style="display: none;">
  <div class="modal-dialog modal-xl modal-dialog-centered">
      <div class="modal-content">
          <div class="modal-header">
              <h5 class="modal-title">Update Product Category</h5>
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
                      <label class="col-sm-2 col-form-label">Submit Button</label>
                      <div class="col-sm-10">
                          <button type="submit" class="btn btn-primary">Update Record</button>
                      </div>
                  </div>

              </form>
          </div>
      </div>
  </div>
</div>
  
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

  
@endsection
@section('tabledev')
<script src="{{ asset('admin/ajax_crud/brand.js') }}"></script>
@endsection