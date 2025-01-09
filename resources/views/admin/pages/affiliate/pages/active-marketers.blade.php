
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
              <!-- Disabled Backdrop Modal -->


      <!-- Left side columns -->
      <div class="col-lg-12">
        <div class="row">
          <div class="col-12">
            <div class="card recent-sales overflow-auto">
                <button type="button" class="btn btn-success btn-sm d-flex align-items-center" data-bs-toggle="modal" data-bs-target="#disablebackdrop">
                    <i class="bi bi-plus-lg me-2"></i>
                    Add New Vendor
                  </button>

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

              <!-- Modal for approving or deactivating affiliate -->
<div class="modal fade" id="affiliateStatusModal" tabindex="-1" aria-labelledby="affiliateStatusModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="affiliateStatusModalLabel">Affiliate Details</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <!-- User details will be populated here -->
          <img id="userImage" src="" alt="User Image" class="img-fluid mb-3">
          <p><strong>Name:</strong> <span id="userName"></span></p>
          <p><strong>CNIC:</strong> <span id="userCnic"></span></p>
          <p><strong>Address:</strong> <span id="userAddress"></span></p>
          <p><strong>Phone Number:</strong> <span id="userPhone"></span></p>
          <p><strong>Email:</strong> <span id="userEmail"></span></p>

          <!-- Bank Details -->
          <p><strong>Bank Account Name:</strong> <span id="bankAccountName"></span></p>
          <p><strong>Bank Name:</strong> <span id="bankName"></span></p>
          <p><strong>Account Number:</strong> <span id="accountNumber"></span></p>

          <!-- Coupon Code Input for activation -->
          <div class="mb-3">
            <label for="couponCode" class="form-label">Coupon Code (if applicable)</label>
            <input type="text" class="form-control" id="couponCode" name="couponCode" required>
          </div>

          <button type="button" class="btn btn-success" onclick="toggleAffiliateStatus()">Confirm</button>
        </div>
      </div>
    </div>
  </div>

  <!-- Modal for sending funds -->
<div class="modal fade" id="sendFundsModal" tabindex="-1" aria-labelledby="sendFundsModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="sendFundsModalLabel">Send Funds to Affiliate</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <p><strong>Total Amount:</strong> <span id="totalAmount"></span></p>
          <p><strong>Withdrawable Amount:</strong> <span id="withdrawableAmount"></span></p>
          <div class="mb-3">
            <label for="sendAmount" class="form-label">Amount to Send</label>
            <input type="number" class="form-control" id="sendAmount" name="sendAmount" required>
          </div>
          <button type="button" class="btn btn-success" onclick="sendFunds()">Send Now</button>
          <div id="sendErrorMessage" class="text-danger mt-2" style="display: none;"></div>
        </div>
      </div>
    </div>
  </div>







              <div class="card-body">
                <h5 class="card-title">Recent Sales <span>| Today</span></h5>

                <table class="table table-borderless datatable">
                  <!-- resources/views/affiliate/dashboard.blade.php -->

<thead>
    <tr>
        <th scope="col">#</th>
        <th scope="col">Name</th>
        <th scope="col">Rank</th>
        <th scope="col">Earning</th>
        <th scope="col">Withdrawal</th>
        <th scope="col">Coupon</th>
        <th scope="col">Bank Details</th>
        <th scope="col">Status</th> <!-- New Column -->
        <th scope="col">Action</th>
    </tr>
</thead>
<tbody>
    @foreach ($affiliate as $item)

    <!-- Modal for Affiliate Details -->
<div class="modal fade" id="affiliateStatusModal-{{ $item->id }}" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog">
      <div class="modal-content">
          <div class="modal-header">
              <h5 class="modal-title">Affiliate Details</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
              <img src="{{ asset('uploads/' . $item->user->image) }}" alt="User Image" class="img-fluid mb-3">
              <p><strong>Name:</strong> <span>{{ $item->user->name }}</span></p>
              <p><strong>CNIC:</strong> <span>{{ $item->user->cnic }}</span></p>
              <p><strong>Address:</strong> <span>{{ $item->user->address }}</span></p>
              <p><strong>Phone Number:</strong> <span>{{ $item->user->phone }}</span></p>
              <p><strong>Email:</strong> <span>{{ $item->user->email }}</span></p>

              <!-- Show Coupon Code and Percentage based on status -->
              <div class="mb-3" id="couponPercentageFields-{{ $item->id }}" style="{{ $item->status == 1 ? 'display:none;' : '' }}">
                  <label for="couponCode-{{ $item->id }}" class="form-label">Coupon Code</label>
                  <input type="text" class="form-control" id="couponCode-{{ $item->id }}" name="couponCode" required>
                  <label for="percentage-{{ $item->id }}" class="form-label">Percentage</label>
                  <input type="number" class="form-control" id="percentage-{{ $item->id }}" name="percentage" required>
              </div>

              <button type="button" class="btn btn-success" onclick="approveAffiliate({{ $item->id }})">Confirm</button>
          </div>
      </div>
  </div>
</div>

        <tr>
            <th scope="row"><a href="#">#{{$item->id}}</a></th>
            <td>{{$item->user->name}}</td>
            <td>{{$item->membership_tier}}</td>
            <td>{{$item->amount}}</td>
            <td>{{$item->withdrawal}}</td>
            <td>{{$item->coupon}}</td>

            <td>
                <!-- Show Bank Details -->
                <small>
                    {{ isset($item->bank_details['account_name']) ? $item->bank_details['account_name'] : '' }}<br>
                    {{ isset($item->bank_details['bank_name']) ? $item->bank_details['bank_name'] : '' }}<br>
                    {{ isset($item->bank_details['account_number']) ? $item->bank_details['account_number'] : '' }}<br>
                    {{ isset($item->bank_details['ifsc_code']) ? $item->bank_details['ifsc_code'] : '' }}
                </small>
            </td>
            <td>
              <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#affiliateStatusModal-{{ $item->id }}">
                {{ $item->status == 0 ? 'Pending' : 'Active' }}
            </button>
            
                </td>
            <td>
                <button class="btn btn-sm btn-primary">Edit</button>
                <button class="btn btn-sm btn-danger">Delete</button>
                <button class="btn btn-warning btn-sm" onclick="openSendFundsModal({{ $item->id }}, {{ $item->amount }})">Send Funds</button>

            </td>
        </tr>
    @endforeach
</tbody>


                </table>

              </div>

            </div>
          </div><!-- End Recent Sales -->


        </div>
      </div><!-- End Left side columns -->


    </div>



  </section>
  

  <script>


function openSendFundsModal(affiliateId, totalAmount) {
  window.affiliateId = affiliateId;
  $('#totalAmount').text(totalAmount);
  $('#sendFundsModal').modal('show');
}

function sendFunds() {
  const sendAmount = $('#sendAmount').val();
  const totalAmount = $('#totalAmount').text();

  if (sendAmount > totalAmount) {
    $('#sendErrorMessage').text('Insufficient funds').show();
    return;
  }

  $.ajax({
    url: '/affiliate/send-funds',
    method: 'POST',
    data: {
      affiliate_id: window.affiliateId,
      send_amount: sendAmount,
      _token: '{{ csrf_token() }}'
    },
    success: function(response) {
      if (response.success) {
        alert('Funds sent successfully!');
        $('#sendFundsModal').modal('hide');
        location.reload();  // Refresh to update the balances
      } else {
        $('#sendErrorMessage').text('Error occurred. Please try again.').show();
      }
    }
  });
}


function approveAffiliate(affiliateId) {
    const couponCode = $(`#couponCode-${affiliateId}`).val();
    const percentage = $(`#percentage-${affiliateId}`).val();

    $.ajax({
        url: '/affiliate/approve',
        method: 'POST',
        data: {
            affiliate_id: affiliateId,
            coupon_code: couponCode,
            percentage: percentage,
            _token: '{{ csrf_token() }}' // Laravel CSRF token
        },
        success: function(response) {
            if (response.success) {
                alert('Affiliate approved successfully!');
                location.reload();  // Refresh the page to see updated status
            } else {
                alert('Error: ' + response.message);
            }
        },
        error: function(jqXHR, textStatus, errorThrown) {
            console.error('AJAX Error:', textStatus, errorThrown);
            alert('An error occurred while processing the request.');
        }
    });
}



  </script>

@endsection
