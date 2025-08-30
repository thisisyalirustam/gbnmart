
@extends('admin.layout.content')
@section('content')



  <div class="pagetitle">
    <h1>Dashboard</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.html">Home</a></li>
        <li class="breadcrumb-item active">Dashboard</li>
      </ol>
    </nav>
  </div><!-- End Page Title -->

  <section class="section dashboard">
    <div class="row">

      <!-- Left side columns -->
      <div class="col-lg-8">
        <div class="row">

          <!-- Sales Card -->
          <div class="col-xxl-4 col-md-6">
            <div class="card info-card sales-card">
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

                <div class="card-body">
                    <h5 class="card-title">Orders <span>| Today</span></h5>
                    <div class="d-flex align-items-center">
                        <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                            <i class="bi bi-cart"></i>
                        </div>
                        <div class="ps-3">
                            <h6 id="todaystotal">Loading...</h6>
                            <span id="orderPercentageIncrease" class="text-success small pt-1 fw-bold">5%</span>
                            <span class="text-muted small pt-2 ps-1">increase</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
          <!-- Revenue Card -->
          <div class="col-xxl-4 col-md-6">
            <div class="card info-card revenue-card">
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

                <div class="card-body">
                    <h5 class="card-title">Revenue <span>| This Month</span></h5>
                    <div class="d-flex align-items-center">
                        <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                            <i class="bi bi-currency-dollar"></i>
                        </div>
                        <div class="ps-3">
                            <h6 id="revenueAmount">Loading...</h6>
                            <span id="revenuePercentageChange" class="text-success small pt-1 fw-bold">0%</span>
                            <span class="text-muted small pt-2 ps-1">increase</span>
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- End Revenue Card -->

          <!-- Customers Card -->
          <div class="col-xxl-4 col-xl-12">
            <div class="card info-card customers-card">
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
                <div class="card-body">
                    <h5 class="card-title">Customers <span>| This Year</span></h5>
                    <div class="d-flex align-items-center">
                        <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                            <i class="bi bi-people"></i>
                        </div>
                        <div class="ps-3">
                            <h6 id="customersCount">Loading...</h6>
                            <span id="customersPercentageChange" class="text-success small pt-1 fw-bold">12%</span>
                            <span class="text-muted small pt-2 ps-1">increase</span>
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- End Customers Card -->

          <!-- Reports -->
          <div class="col-12">
            <div class="card">

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

              <div class="card-body">
                <h5 class="card-title">Reports <span>/Today</span></h5>

                <!-- Line Chart -->
                <div id="reportsChart"></div>

                <script>
                  document.addEventListener("DOMContentLoaded", () => {
    let chart;

    // Initialize the chart
    function initializeChart(series, categories) {
        chart = new ApexCharts(document.querySelector("#reportsChart"), {
            series: series,
            chart: {
                height: 350,
                type: 'area',
                toolbar: {
                    show: false
                },
            },
            markers: {
                size: 4
            },
            colors: ['#4154f1', '#2eca6a', '#ff771d'],
            fill: {
                type: "gradient",
                gradient: {
                    shadeIntensity: 1,
                    opacityFrom: 0.3,
                    opacityTo: 0.4,
                    stops: [0, 90, 100]
                }
            },
            dataLabels: {
                enabled: false
            },
            stroke: {
                curve: 'smooth',
                width: 2
            },
            xaxis: {
                type: 'datetime',
                categories: categories
            },
            tooltip: {
                x: {
                    format: 'dd/MM/yy HH:mm'
                },
            }
        });

        chart.render();
    }

    // Fetch data from the backend
    function fetchGraphData(filter = 'today') {
        $.ajax({
            url: '/admin-graph-data', // Your backend route
            method: 'GET',
            data: { filter: filter },
            success: function (response) {
                if (response.success) {
                    console.log('Graph Data:', response); // Debugging: Log the response
                    if (chart) {
                        // Update the chart with new data
                        chart.updateOptions({
                            series: response.series,
                            xaxis: {
                                categories: response.categories
                            }
                        });
                    } else {
                        // Initialize the chart if it doesn't exist
                        initializeChart(response.series, response.categories);
                    }
                } else {
                    console.error('Error fetching graph data');
                }
            },
            error: function (xhr, status, error) {
                console.error('AJAX request failed: ' + status + ', ' + error);
            }
        });
    }

    // Initially load the "Today" data when the page loads
    fetchGraphData('today');

    // Handle the dropdown filter click event
    $('.dropdown-item').click(function (e) {
        e.preventDefault(); // Prevent default link behavior

        const filter = $(this).text().toLowerCase(); // Get the filter text and convert to lowercase
        console.log('Selected Filter:', filter); // Debugging: Log the filter value

        // Fetch data based on the selected filter
        fetchGraphData(filter);

        // Update the card title based on the filter selected
        $('.card-title span').text(`| ${$(this).text()}`);
    });
});
                </script>
                <!-- End Line Chart -->

              </div>

            </div>
          </div><!-- End Reports -->

          <!-- Recent Sales -->

          @can('order.view')
            <div class="col-12">
            <div class="card recent-sales overflow-auto">

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

              <div class="card-body">
                <h5 class="card-title">Recent Sales <span>| Today</span></h5>

                <table class="table table-borderless datatable">
                  <thead>
                    <tr>
                      <th scope="col">#</th>
                      <th scope="col">Customer</th>
                      <th scope="col">Address</th>
                      <th scope="col">Price</th>
                      <th scope="col">Status</th>
                      <th scope="col">Action</th>
                    </tr>
                    </thead>
                    <tbody id="product-tbody">
                      @foreach ($orders as $order)
                      <tr>
                        <th scope="row"><a href="#">Order#{{$order->id}}</a></th>
                        <td>{{$order->name}}</td>
                        <td><a href="#" class="text-primary">{{$order->address}}</a></td>
                        <td>{{$order->grand_total}}</td>
                        <td>
                          <span class="badge" 
                                style="padding: 5px 10px; border-radius: 5px; font-size: 14px; color: white; 
                                       background-color: 
                                       @switch($order->shipping_status)
                                           @case('Pending') #ffc107 @break
                                           @case('Process') #007bff @break
                                           @case('Delivered') #28a745 @break
                                           @case('Return') #dc3545 @break
                                           @case('Complete') #17a2b8 @break
                                           @default #6c757d @break
                                       @endswitch;">
                            {{$order->shipping_status}}
                          </span>
                        </td>
                        
                        <td>
                          <a href="{{ route('coustomer-orders.show', $order->id) }}" class="btn btn-info btn-sm" style="text-decoration: none; display: inline-flex; justify-content: center; align-items: center; padding: 6px; border-radius: 50%; font-size: 18px; transition: background-color 0.3s; width: 36px; height: 36px;">
                            <i class="bi bi-eye" style="color: white;"></i>
                          </a>
                        </td>
                        
                        
                        

                        
                      </tr>
                      @endforeach
                    </tbody>
                  
                </table>

              </div>

            </div>
          </div><!-- End Recent Sales -->
          @endcan
          

          <!-- Top Selling -->
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
                            <th scope="col">Sold</th>
                            <th scope="col">Revenue</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($topRatedProduct as $product)
                            @php
                                // Get the first image from the JSON array of images
                                $productImages = json_decode($product->product_images, true); 
                                $firstImage = isset($productImages[0]) ? $productImages[0] : 'default-image.jpg'; // Default image if none available
                            @endphp
                            <tr>
                                <th scope="row">
                                    <a href="#">
                                        <img src="{{ asset('images/products/'.$firstImage) }}" alt="Product Image">
                                    </a>
                                </th>
                                <td>
                                    <a href="#" class="text-primary fw-bold">{{ $product->product_name }}</a>
                                </td>
                                <td>${{ number_format($product->product_price, 2) }}</td> <!-- Assuming rating can be translated to price -->
                                <td class="fw-bold">{{ $product->sold_quantity }}</td> <!-- Display sold quantity -->
                                <td>${{ number_format($product->revenue, 2) }}</td> <!-- Display revenue -->
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            
            

            </div>
          </div><!-- End Top Selling -->

        </div>
      </div><!-- End Left side columns -->

      <!-- Right side columns -->
      <div class="col-lg-4">

        <!-- Recent Activity -->
        <div class="card">
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

          <div class="card-body">
            <h5 class="card-title">Recent Activity <span>| Today</span></h5>

            <div class="activity">
              @foreach ($notifications as $notification)
                  @php
                      // Decode the JSON data column
                      $data = json_decode($notification->data, true);
          
                      // Extract individual values from the JSON
                      $orderId = $data['order_id'] ?? null;
                      $totalAmount = $data['amount'] ?? null;
                      $message = $data['message'] ?? 'No message';
                      $userId = $data['user_id'] ?? 'Unknown'; // Assuming user_id is inside the data
                  @endphp
          
          <div class="activity-item d-flex">
            <div class="activite-label">{{ \Carbon\Carbon::parse($notification->created_at)->diffForHumans() }}</div>
            <i class="bi bi-circle-fill activity-badge text-success align-self-start"></i>
            <div class="activity-content">
                <p><strong>Order #{{ $data['order_id'] }}</strong> - <strong>${{ number_format($data['amount'] / 100, 2) }}</strong><br>
                {{ $data['message'] }} </p>
            </div>
        </div>
        <!-- End activity item-->
              @endforeach
          </div>
          

          </div>
        </div><!-- End Recent Activity -->

        <!-- Budget Report -->
        {{-- <div class="card">
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
            <h5 class="card-title">Budget Report <span>| This Month</span></h5>

            <div id="budgetChart" style="min-height: 400px;" class="echart"></div>

            <script>
              document.addEventListener("DOMContentLoaded", () => {
                var budgetChart = echarts.init(document.querySelector("#budgetChart")).setOption({
                  legend: {
                    data: ['Allocated Budget', 'Actual Spending']
                  },
                  radar: {
                    // shape: 'circle',
                    indicator: [{
                        name: 'Sales',
                        max: 6500
                      },
                      {
                        name: 'Administration',
                        max: 16000
                      },
                      {
                        name: 'Information Technology',
                        max: 30000
                      },
                      {
                        name: 'Customer Support',
                        max: 38000
                      },
                      {
                        name: 'Development',
                        max: 52000
                      },
                      {
                        name: 'Marketing',
                        max: 25000
                      }
                    ]
                  },
                  series: [{
                    name: 'Budget vs spending',
                    type: 'radar',
                    data: [{
                        value: [4200, 3000, 20000, 35000, 50000, 18000],
                        name: 'Allocated Budget'
                      },
                      {
                        value: [5000, 14000, 28000, 26000, 42000, 21000],
                        name: 'Actual Spending'
                      }
                    ]
                  }]
                });
              });
            </script>

          </div>
        </div><!-- End Budget Report --> --}}

        <!-- Website Traffic -->
        <div class="card">
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
            <h5 class="card-title">Website Traffic <span>| Today</span></h5>

            <div id="trafficChart" style="min-height: 400px;" class="echart"></div>

            <script>
              document.addEventListener("DOMContentLoaded", () => {
                echarts.init(document.querySelector("#trafficChart")).setOption({
                  tooltip: {
                    trigger: 'item'
                  },
                  legend: {
                    top: '5%',
                    left: 'center'
                  },
                  series: [{
                    name: 'Access From',
                    type: 'pie',
                    radius: ['40%', '70%'],
                    avoidLabelOverlap: false,
                    label: {
                      show: false,
                      position: 'center'
                    },
                    emphasis: {
                      label: {
                        show: true,
                        fontSize: '18',
                        fontWeight: 'bold'
                      }
                    },
                    labelLine: {
                      show: false
                    },
                    data: [{
                        value: 1048,
                        name: 'Search Engine'
                      },
                      {
                        value: 735,
                        name: 'Direct'
                      },
                      {
                        value: 580,
                        name: 'Email'
                      },
                      {
                        value: 484,
                        name: 'Union Ads'
                      },
                      {
                        value: 300,
                        name: 'Video Ads'
                      }
                    ]
                  }]
                });
              });
            </script>

          </div>
        </div><!-- End Website Traffic -->

        <!-- News & Updates Traffic -->
        <div class="card">
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
            <h5 class="card-title">Latest &amp; Blogs <span>| Today</span></h5>

            <div class="news">
              @foreach ($blogs as $blog)
                <div class="post-item clearfix">
                <img src="{{$blog->image}}" alt="">
                <h4><a href="{{ route('blogs.show', $blog->id) }}">{{\Illuminate\Support\Str::words(strip_tags($blog->title), 5, '...')}}</a></h4>
                <p>{{\Illuminate\Support\Str::words(strip_tags($blog->content), 10, '...')}}</p>
              </div>
              @endforeach
              

            </div><!-- End sidebar recent posts-->

          </div>
        </div><!-- End News & Updates -->

      </div><!-- End Right side columns -->

    </div>
  </section>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

  <script>
    $(document).ready(function () {

        function fetchOrderDetails(filter = 'today') {
    $.ajax({
        url: '/admin-dashboard-data', // Your backend route
        method: 'GET',
        data: { filter: filter }, // Pass the filter to the backend
        success: function (response) {
            if (response.success) {
                // Update the HTML element with the order count
                $('#todaystotal').text(response.orders);

                // Update the percentage increase
                const percentageIncreaseElement = $('#orderPercentageIncrease');
                if (response.percentage_increase >= 0) {
                    percentageIncreaseElement.removeClass('text-danger').addClass('text-success').text(response.percentage_increase + '%');
                } else {
                    percentageIncreaseElement.removeClass('text-success').addClass('text-danger').text(response.percentage_increase + '%');
                }
            } else {
                console.error('Error fetching data');
            }
        },
        error: function (xhr, status, error) {
            console.error('AJAX request failed: ' + status + ', ' + error);
        }
    });
}

// Initially load the "Today" data when the page loads
fetchOrderDetails('today');

// Handle the dropdown filter click event
$('.dropdown-item').click(function (e) {
    e.preventDefault(); // Prevent default link behavior

    const filter = $(this).text().toLowerCase(); // Get the filter text and convert to lowercase
    console.log('Selected Filter:', filter); // Debugging: Log the filter value

    // Fetch data based on the selected filter
    fetchOrderDetails(filter);

    // Optionally, you can change the card title based on the filter selected:
    $('.card-title span').text(`| ${$(this).text()}`);
});

        function fetchCustomerDetails(filter = 'today') {
    $.ajax({
        url: '/admin-customer-data', // Your backend route for customer details
        method: 'GET',
        data: { filter: filter }, // Pass the filter to the backend
        success: function (response) {
            if (response.success) {
                // Update the HTML element with the customer count
                $('#customersCount').text(response.customers);

                // Update the percentage change
                const percentageChangeElement = $('#customersPercentageChange');
                if (response.percentage_change >= 0) {
                    percentageChangeElement.removeClass('text-danger').addClass('text-success').text(response.percentage_change + '%');
                } else {
                    percentageChangeElement.removeClass('text-success').addClass('text-danger').text(response.percentage_change + '%');
                }
            } else {
                console.error('Error fetching customer data');
            }
        },
        error: function (xhr, status, error) {
            console.error('AJAX request failed: ' + status + ', ' + error);
        }
    });
}

// Initially load the "Today" data when the page loads
fetchCustomerDetails('today');

// Handle the dropdown filter click event for customers
$('.dropdown-item').click(function (e) {
    e.preventDefault(); // Prevent default link behavior

    const filter = $(this).text().toLowerCase(); // Get the filter text and convert to lowercase
    console.log('Selected Filter:', filter); // Debugging: Log the filter value

    // Fetch data based on the selected filter
    fetchCustomerDetails(filter);

    // Optionally, you can change the card title based on the filter selected:
    $('.card-title span').text(`| ${$(this).text()}`);
});

function fetchRevenueDetails(filter = 'today') {
    $.ajax({
        url: '/admin-revenue-data', // Your backend route for revenue details
        method: 'GET',
        data: { filter: filter }, // Pass the filter to the backend
        success: function (response) {
            if (response.success) {
                // Update the HTML element with the revenue amount
                $('#revenueAmount').text(response.revenue.toLocaleString());

                // Update the percentage change
                const percentageChangeElement = $('#revenuePercentageChange');
                if (response.percentage_change >= 0) {
                    percentageChangeElement.removeClass('text-danger').addClass('text-success').text(response.percentage_change + '%');
                } else {
                    percentageChangeElement.removeClass('text-success').addClass('text-danger').text(response.percentage_change + '%');
                }
            } else {
                console.error('Error fetching revenue data');
            }
        },
        error: function (xhr, status, error) {
            console.error('AJAX request failed: ' + status + ', ' + error);
        }
    });
}

// Initially load the "Today" data when the page loads
fetchRevenueDetails('today');

// Handle the dropdown filter click event for revenue
$('.dropdown-item').click(function (e) {
    e.preventDefault(); // Prevent default link behavior

    const filter = $(this).text().toLowerCase(); // Get the filter text and convert to lowercase
    console.log('Selected Filter:', filter); // Debugging: Log the filter value

    // Fetch data based on the selected filter
    fetchRevenueDetails(filter);

    // Optionally, you can change the card title based on the filter selected:
    $('.card-title span').text(`| ${$(this).text()}`);
});

document.addEventListener("DOMContentLoaded", () => {
    let chart;

    // Initialize the chart
    function initializeChart(series, categories) {
        chart = new ApexCharts(document.querySelector("#reportsChart"), {
            series: series,
            chart: {
                height: 350,
                type: 'area',
                toolbar: {
                    show: false
                },
            },
            markers: {
                size: 4
            },
            colors: ['#4154f1', '#2eca6a', '#ff771d'],
            fill: {
                type: "gradient",
                gradient: {
                    shadeIntensity: 1,
                    opacityFrom: 0.3,
                    opacityTo: 0.4,
                    stops: [0, 90, 100]
                }
            },
            dataLabels: {
                enabled: false
            },
            stroke: {
                curve: 'smooth',
                width: 2
            },
            xaxis: {
                type: 'datetime',
                categories: categories
            },
            tooltip: {
                x: {
                    format: 'dd/MM/yy HH:mm'
                },
            }
        });

        chart.render();
    }

    // Fetch data from the backend
    function fetchGraphData(filter = 'today') {
        $.ajax({
            url: '/admin-graph-data', // Your backend route
            method: 'GET',
            data: { filter: filter },
            success: function (response) {
                if (response.success) {
                    // Update the chart with new data
                    if (chart) {
                        chart.updateOptions({
                            series: response.series,
                            xaxis: {
                                categories: response.categories
                            }
                        });
                    } else {
                        // Initialize the chart if it doesn't exist
                        initializeChart(response.series, response.categories);
                    }
                } else {
                    console.error('Error fetching graph data');
                }
            },
            error: function (xhr, status, error) {
                console.error('AJAX request failed: ' + status + ', ' + error);
            }
        });
    }

    // Initially load the "Today" data when the page loads
    fetchGraphData('today');

    // Handle the dropdown filter click event
    $('.dropdown-item').click(function (e) {
        e.preventDefault(); // Prevent default link behavior

        const filter = $(this).text().toLowerCase(); // Get the filter text and convert to lowercase
        console.log('Selected Filter:', filter); // Debugging: Log the filter value

        // Fetch data based on the selected filter
        fetchGraphData(filter);

        // Update the card title based on the filter selected
        $('.card-title span').text(`| ${$(this).text()}`);
    });
});

              

    });

    $(document).ready(function() {
    $.ajax({
        url: '/recent-product', // Your backend route
        method: 'GET',
        success: function(response) {
            if(response.success) {
                let products = response.products;
                let tbodyContent = '';

                // Check if products array is not empty
                if (products && products.length > 0) {
                    products.forEach(function(product) {
                        // Generate row with product details
                        let row = `
                            <tr>
                                <th scope="row"><a href="#">#${product.id}</a></th>
                                <td>${product.name}</td>
                                <td><a href="#" class="text-primary">${product.description}</a></td>
                                <td>$${product.price}</td>
                                <td><span class="badge ${getBadgeClass(product.status)}">${getStatusText(product.status)}</span></td>
                            </tr>
                        `;
                        tbodyContent += row;
                    });

                    // Insert the generated rows into the table body
                    $('#product-tbody').html(tbodyContent);
                } else {
                    // In case there are no products
                    $('#product-tbody').html('<tr><td colspan="5">No products available.</td></tr>');
                }
            } else {
                console.log('Error: API returned failure');
                $('#product-tbody').html('<tr><td colspan="5">Failed to load products.</td></tr>');
            }
        },
        error: function(xhr, status, error) {
            console.log('AJAX error: ' + status + ' ' + error);
            $('#product-tbody').html('<tr><td colspan="5">Failed to load products.</td></tr>');
        }
    });

    // Helper function to get the status badge class
    function getBadgeClass(status) {
        switch(status) {
            case 1: return 'bg-success'; // Approved
            case 2: return 'bg-warning'; // Pending
            case 0: return 'bg-danger';  // Rejected
            default: return '';
        }
    }

    // Helper function to get the status text
    function getStatusText(status) {
        switch(status) {
            case 1: return 'Approved';
            case 2: return 'Pending';
            case 0: return 'Rejected';
            default: return 'Unknown';
        }
    }
});

    </script>



@endsection
