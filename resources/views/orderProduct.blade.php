@extends('website.layout.content')
@section('webcontent')

<style rel="stylesheet" href="{{asset('admin/assets/vendor/simple-datatables/style.css')}}"></style>
    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-md-5">
                <div class="blog__sidebar">
                    <div class="blog__sidebar__item">
                        <h4>Categories</h4>
                        <ul>
                            <li><a href="#">All</a></li>
                            <li><a href="#">Order Product({{$ordercount}})</a></li>
                            <li><a href="#">Food (5)</a></li>
                            <li><a href="#">Life Style (9)</a></li>
                            <li><a href="#">Travel (10)</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-lg-8 col-md-7">
                <div class="container my-4">
                    <div class="col-12">
                        <div class="card top-selling overflow-auto">

                          <div class="filter">
                            <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                            <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                              <li class="dropdown-header text-start">
                                <h6>Filter</h6>
                              </li>

                              <li><a class="dropdown-item" href="#">Today</a></li>
                              <li><a class="dropdown-item" href="#">This Month</a></li>
                              <li><a class="dropdown-item" href="#">This Year</a></li>
                            </ul>
                          </div>

                          <div class="card-body pb-0">
                            <h5 class="card-title">Top Selling <span>| Today</span></h5>

                            <table class="table table-borderless">
                              <thead>
                                <tr>
                                  <th scope="col">Preview</th>
                                  <th scope="col">Product</th>
                                  <th scope="col">Price</th>
                                  <th scope="col">status</th>
                                  <th scope="col">Action</th>
                                </tr>
                              </thead>
                              <tbody>

                                @foreach ($order as $item )
                                <tr>
                                    <th scope="row"><a href="#"><img src="assets/img/product-1.jpg" alt=""></a></th>
                                    <td><a href="#" class="text-primary fw-bold">{{$item->item->product->name}}</a></td>
                                    <td>{{$item->grand_total}}</td>
                                    <td class="fw-bold">124</td>
                                    <td>$5,828</td>
                                  </tr>
                                @endforeach
                              </tbody>
                            </table>

                          </div>

                        </div>
                      </div>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('admin/assets/vendor/simple-datatables/simple-datatables.js') }}"></script>
<script src="{{asset('admin/assets/js/datatable.js')}}"></script>
@endsection
