{{-- <x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{ __("You're logged in!") }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout> --}}
 <!-- Blog Section Begin -->

    {{-- <div class="container">
        <div class="row">
            <div class="col-lg-4 col-md-5">
                <div class="blog__sidebar">
                    <div class="blog__sidebar__item">
                        <h4>Categories</h4>
                        <ul>
                            <li><a href="#">All</a></li>
                            <li><a href="{{route('website.orderproduct')}}">Order Product({{$ordercount}})</a></li>
                            <li><a href="#">Food (5)</a></li>
                            <li><a href="#">Life Style (9)</a></li>
                            <li><a href="#">Travel (10)</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-lg-8 col-md-7">
                <div class="container my-4">
                    <a href="">
                    <div class="row text-center">
                        <div class="col-md-3 mb-4">
                            <div class="card shadow-sm custom-dashboard-card" style="border-left: 5px solid #007bff;">
                                <div class="custom-card-body">

                                    <div>
                                        <h5 class="custom-card-title text-primary">Total Order</h5>
                                        <p id="todaysSales" class="custom-card-text">{{$ordercount}}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 mb-4">
                            <div class="card shadow-sm custom-dashboard-card" style="border-left: 5px solid #28a745;">
                                <div class="custom-card-body">
                                    <i class="fas fa-dollar-sign custom-card-icon text-success"></i>
                                    <div>
                                        <h5 class="custom-card-title text-success">Total Sales</h5>
                                        <p id="totalSales" class="custom-card-text">24</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-3 mb-4">
                            <div class="card shadow-sm custom-dashboard-card" style="border-left: 5px solid #ffc107;">
                                <div class="custom-card-body">
                                    <i class="fas fa-money-bill-wave custom-card-icon text-warning"></i>
                                    <div>
                                        <h5 class="custom-card-title text-warning">Total Income</h5>
                                        <p id="totalIncome" class="custom-card-text">34</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-3 mb-4">
                            <div class="card shadow-sm custom-dashboard-card" style="border-left: 5px solid #dc3545;">
                                <div class="custom-card-body">
                                    <i class="fas fa-clock custom-card-icon text-danger"></i>
                                    <div>
                                        <h5 class="custom-card-title text-danger">Pending Orders</h5>
                                        <p id="pendingOrders" class="custom-card-text">34</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row text-center">
                        <div class="col-md-3 mb-4">
                            <div class="card shadow-sm custom-dashboard-card" style="border-left: 5px solid #007bff;">
                                <div class="custom-card-body">
                                    <i class="fas fa-calendar-alt custom-card-icon text-primary"></i>
                                    <div>
                                       <a href="#table"><h5 class="custom-card-title text-primary">Monthly Sales</h5></a>
                                        <p id="monthlySales" class="custom-card-text">34</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 mb-4">
                            <div class="card shadow-sm custom-dashboard-card" style="border-left: 5px solid #28a745;">
                                <div class="custom-card-body">
                                    <i class="fas fa-calendar-dollar custom-card-icon text-success"></i>
                                    <div>
                                        <h5 class="custom-card-title text-success">Monthly Income</h5>
                                        <p id="monthlyIncome" class="custom-card-text">34</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 mb-4">
                            <div class="card shadow-sm custom-dashboard-card" style="border-left: 5px solid #ffc107;">
                                <div class="custom-card-body">
                                    <i class="fas fa-calendar-check custom-card-icon text-warning"></i>
                                    <div>
                                        <h5 class="custom-card-title text-warning">Today's Sales</h5>
                                        <p id="todaysIncome" class="custom-card-text">44</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}
    @extends('layouts.main')
   @section('user-content')




   <h1 class="app-page-title">Overview</h1>



   <div class="row g-4 mb-4">
       <div class="col-6 col-lg-3">
           <div class="app-card app-card-stat shadow-sm h-100">
               <div class="app-card-body p-3 p-lg-4">
                   <h4 class="stats-type mb-1">My Orders</h4>
                   <div class="stats-figure">{{$ordercount}}</div>
                   <div class="stats-meta text-success">Your All Orders</div>
               </div><!--//app-card-body-->
               <a class="app-card-link-mask" href="#"></a>
           </div><!--//app-card-->
       </div><!--//col-->
       <div class="col-6 col-lg-3">
           <div class="app-card app-card-stat shadow-sm h-100">
               <div class="app-card-body p-3 p-lg-4">
                   <h4 class="stats-type mb-1">My Cart</h4>
                   <div class="stats-figure">{{$cartcount}}</div>
                   <div class="stats-meta text-success">Your All Orders</div>
               </div><!--//app-card-body-->
               <a class="app-card-link-mask" href="#"></a>
           </div><!--//app-card-->
       </div><!--//col-->


       <div class="col-6 col-lg-3">
           <div class="app-card app-card-stat shadow-sm h-100">
               <div class="app-card-body p-3 p-lg-4">
                   <h4 class="stats-type mb-1">Return Orders</h4>
                   <div class="stats-figure">{{$returnCount}}</div>
                   <div class="stats-meta">
                       Open</div>
               </div><!--//app-card-body-->
               <a class="app-card-link-mask" href="#"></a>
           </div><!--//app-card-->
       </div><!--//col-->
       <div class="col-6 col-lg-3">
           <div class="app-card app-card-stat shadow-sm h-100">
               <div class="app-card-body p-3 p-lg-4">
                   <h4 class="stats-type mb-1">Pending Orders</h4>
                   <div class="stats-figure">{{$processCount}}</div>
                   <div class="stats-meta">New</div>
               </div><!--//app-card-body-->
               <a class="app-card-link-mask" href="#"></a>
           </div><!--//app-card-->
       </div><!--//col-->
   </div><!--//row-->


        <div class="row g-3 mb-4 align-items-center justify-content-between">
            <div class="col-auto">
                <h1 class="app-page-title mb-0">Orders</h1>
            </div>
            <div class="col-auto">
                 <div class="page-utilities">
                    <div class="row g-2 justify-content-start justify-content-md-end align-items-center">
                        <div class="col-auto">
                            <form class="table-search-form row gx-1 align-items-center">
                                <div class="col-auto">
                                    <input type="text" id="search-orders" name="searchorders" class="form-control search-orders" placeholder="Search">
                                </div>
                                <div class="col-auto">
                                    <button type="submit" class="btn app-btn-secondary">Search</button>
                                </div>
                            </form>

                        </div><!--//col-->
                        <div class="col-auto">

                            <select class="form-select w-auto">
                                  <option selected="" value="option-1">All</option>
                                  <option value="option-2">This week</option>
                                  <option value="option-3">This month</option>
                                  <option value="option-4">Last 3 months</option>

                            </select>
                        </div>
                        <div class="col-auto">
                            <a class="btn app-btn-secondary" href="#">
                                <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-download me-1" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
  <path fill-rule="evenodd" d="M.5 9.9a.5.5 0 0 1 .5.5v2.5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2.5a.5.5 0 0 1 1 0v2.5a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2v-2.5a.5.5 0 0 1 .5-.5z"></path>
  <path fill-rule="evenodd" d="M7.646 11.854a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 10.293V1.5a.5.5 0 0 0-1 0v8.793L5.354 8.146a.5.5 0 1 0-.708.708l3 3z"></path>
</svg>
                                Download CSV
                            </a>
                        </div>
                    </div><!--//row-->
                </div><!--//table-utilities-->
            </div><!--//col-auto-->
        </div><!--//row-->


        <nav id="orders-table-tab" class="orders-table-tab app-nav-tabs nav shadow-sm flex-column flex-sm-row mb-4" role="tablist">
            <a class="flex-sm-fill text-sm-center nav-link active" id="orders-all-tab" data-bs-toggle="tab" href="#orders-all" role="tab" aria-controls="orders-all" aria-selected="true">All</a>
            <a class="flex-sm-fill text-sm-center nav-link" id="orders-paid-tab" data-bs-toggle="tab" href="#orders-paid" role="tab" aria-controls="orders-paid" aria-selected="false" tabindex="-1">Process</a>
            <a class="flex-sm-fill text-sm-center nav-link" id="orders-pending-tab" data-bs-toggle="tab" href="#orders-pending" role="tab" aria-controls="orders-pending" aria-selected="false" tabindex="-1">Pending</a>
            <a class="flex-sm-fill text-sm-center nav-link" id="orders-cancelled-tab" data-bs-toggle="tab" href="#orders-cancelled" role="tab" aria-controls="orders-cancelled" aria-selected="false" tabindex="-1">Compelte</a>
        </nav>


        <div class="tab-content" id="orders-table-tab-content">
            <div class="tab-pane fade show active" id="orders-all" role="tabpanel" aria-labelledby="orders-all-tab">
                <div class="app-card app-card-orders-table shadow-sm mb-5">
                    <div class="app-card-body">
                        <div class="table-responsive">
                            <table class="table app-table-hover mb-0 text-left">
                                <thead>
                                    <tr>
                                        <th class="cell">Order</th>
                                        <th class="cell">Date</th>
                                        <th class="cell">Status</th>
                                        <th class="cell">Total</th>
                                        <th class="cell"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($order as $item)
                                    <tr>
                                        <td class="cell">#{{$item->id}}</td>
                                        <td class="cell">
                                            <span>{{ \Carbon\Carbon::parse($item->created_at)->format('d M') }}</span>
                                            <span class="note">{{ \Carbon\Carbon::parse($item->created_at)->format('h:i A') }}</span>
                                        </td>
                                        <td class="cell">
                                            @php
                                                $statusClass = '';
                                                switch ($item->shipping_status) {
                                                    case 'Pending':
                                                        $statusClass = 'bg-warning';
                                                        break;
                                                    case 'Process':
                                                        $statusClass = 'bg-primary';
                                                        break;
                                                    case 'Delivered':
                                                        $statusClass = 'bg-success';
                                                        break;
                                                    case 'Return':
                                                        $statusClass = 'bg-danger';
                                                        break;
                                                    case 'Complete':
                                                        $statusClass = 'bg-secondary';
                                                        break;
                                                }
                                            @endphp
                                            <span class="badge {{$statusClass}}">{{$item->shipping_status}}</span>
                                        </td>
                                        <td class="cell">{{$item->grand_total}}</td>
                                        <td class="cell"><a class="btn-sm app-btn-secondary" href="#">View</a></td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>

                        </div><!--//table-responsive-->

                    </div><!--//app-card-body-->
                </div><!--//app-card-->
                <nav class="app-pagination">
                    <ul class="pagination justify-content-center">
                        <li class="page-item disabled">
                            <a class="page-link" href="#" tabindex="-1" aria-disabled="true">Previous</a>
                        </li>
                        <li class="page-item active"><a class="page-link" href="#">1</a></li>
                        <li class="page-item"><a class="page-link" href="#">2</a></li>
                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                        <li class="page-item">
                            <a class="page-link" href="#">Next</a>
                        </li>
                    </ul>
                </nav><!--//app-pagination-->

            </div><!--//tab-pane-->

            <div class="tab-pane fade" id="orders-paid" role="tabpanel" aria-labelledby="orders-paid-tab">
                <div class="app-card app-card-orders-table mb-5">
                    <div class="app-card-body">
                        <div class="table-responsive">

                            <table class="table mb-0 text-left">
                                <thead>
                                    <tr>
                                        <th class="cell">Order</th>

                                        <th class="cell">Date</th>
                                        <th class="cell">Status</th>
                                        <th class="cell">Total</th>
                                        <th class="cell"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($orderprocess as $process)
                                    <tr>
                                        <td class="cell">#{{$process->id}}</td>
                                        <td class="cell">
                                            <span>{{ \Carbon\Carbon::parse($process->created_at)->format('d M') }}</span>
                                            <span class="note">{{ \Carbon\Carbon::parse($process->created_at)->format('h:i A') }}</span>
                                        </td>
                                        <td class="cell">
                                            @php
                                                $statusClass = '';
                                                switch ($process->shipping_status) {
                                                    case 'Pending':
                                                        $statusClass = 'bg-warning';
                                                        break;
                                                    case 'Process':
                                                        $statusClass = 'bg-primary';
                                                        break;
                                                    case 'Delivered':
                                                        $statusClass = 'bg-success';
                                                        break;
                                                    case 'Return':
                                                        $statusClass = 'bg-danger';
                                                        break;
                                                    case 'Complete':
                                                        $statusClass = 'bg-secondary';
                                                        break;
                                                }
                                            @endphp
                                            <span class="badge {{$statusClass}}">{{$process->shipping_status}}</span>
                                        </td>
                                        <td class="cell">{{$process->grand_total}}</td>
                                        <td class="cell"><a class="btn-sm app-btn-secondary" href="#">View</a></td>
                                    </tr>
                                    @endforeach


                                </tbody>
                            </table>
                        </div><!--//table-responsive-->
                    </div><!--//app-card-body-->
                </div><!--//app-card-->
            </div><!--//tab-pane-->

            <div class="tab-pane fade" id="orders-pending" role="tabpanel" aria-labelledby="orders-pending-tab">
                <div class="app-card app-card-orders-table mb-5">
                    <div class="app-card-body">
                        <div class="table-responsive">
                            <table class="table mb-0 text-left">
                                <thead>
                                    <tr>
                                        <th class="cell">Order</th>
                                        <th class="cell">Date</th>
                                        <th class="cell">Status</th>
                                        <th class="cell">Total</th>
                                        <th class="cell"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($orderpending as $pending)
                                    <tr>
                                        <td class="cell">#{{$pending->id}}</td>
                                        <td class="cell">
                                            <span>{{ \Carbon\Carbon::parse($pending->created_at)->format('d M') }}</span>
                                            <span class="note">{{ \Carbon\Carbon::parse($pending->created_at)->format('h:i A') }}</span>
                                        </td>
                                        <td class="cell">
                                            @php
                                                $statusClass = '';
                                                switch ($pending->shipping_status) {
                                                    case 'Pending':
                                                        $statusClass = 'bg-warning';
                                                        break;
                                                    case 'Process':
                                                        $statusClass = 'bg-primary';
                                                        break;
                                                    case 'Delivered':
                                                        $statusClass = 'bg-success';
                                                        break;
                                                    case 'Return':
                                                        $statusClass = 'bg-danger';
                                                        break;
                                                    case 'Complete':
                                                        $statusClass = 'bg-secondary';
                                                        break;
                                                }
                                            @endphp
                                            <span class="badge {{$statusClass}}">{{$pending->shipping_status}}</span>
                                        </td>
                                        <td class="cell">{{$pending->grand_total}}</td>
                                        <td class="cell"><a class="btn-sm app-btn-secondary" href="#">View</a></td>
                                    </tr>
                                    @endforeach

                                </tbody>
                            </table>
                        </div><!--//table-responsive-->
                    </div><!--//app-card-body-->
                </div><!--//app-card-->
            </div><!--//tab-pane-->
            <div class="tab-pane fade" id="orders-cancelled" role="tabpanel" aria-labelledby="orders-cancelled-tab">
                <div class="app-card app-card-orders-table mb-5">
                    <div class="app-card-body">
                        <div class="table-responsive">
                            <table class="table mb-0 text-left">
                                <thead>
                                    <tr>
                                        <th class="cell">Order</th>
                                        <th class="cell">Date</th>
                                        <th class="cell">Status</th>
                                        <th class="cell">Total</th>
                                        <th class="cell"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($ordercompelte as $compelte)
                                    <tr>
                                        <td class="cell">#{{$compelte->id}}</td>
                                        <td class="cell">
                                            <span>{{ \Carbon\Carbon::parse($compelte->created_at)->format('d M') }}</span>
                                            <span class="note">{{ \Carbon\Carbon::parse($pending->created_at)->format('h:i A') }}</span>
                                        </td>
                                        <td class="cell">
                                            @php
                                                $statusClass = '';
                                                switch ($compelte->shipping_status) {
                                                    case 'Pending':
                                                        $statusClass = 'bg-warning';
                                                        break;
                                                    case 'Process':
                                                        $statusClass = 'bg-primary';
                                                        break;
                                                    case 'Delivered':
                                                        $statusClass = 'bg-success';
                                                        break;
                                                    case 'Return':
                                                        $statusClass = 'bg-danger';
                                                        break;
                                                    case 'Complete':
                                                        $statusClass = 'bg-secondary';
                                                        break;
                                                }
                                            @endphp
                                            <span class="badge {{$statusClass}}">{{$compelte->shipping_status}}</span>
                                        </td>
                                        <td class="cell">{{$compelte->grand_total}}</td>
                                        <td class="cell"><a class="btn-sm app-btn-secondary" href="#">View</a></td>
                                    </tr>
                                    @endforeach


                                </tbody>
                            </table>
                        </div><!--//table-responsive-->
                    </div><!--//app-card-body-->
                </div><!--//app-card-->
            </div><!--//tab-pane-->

   </div><!--//row-->


   @endsection


  <!-- Blog Section Begin -->


