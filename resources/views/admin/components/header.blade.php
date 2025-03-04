  <!-- ======= Header ======= -->
  <header id="header" class="header fixed-top d-flex align-items-center">

      <div class="d-flex align-items-center justify-content-between">
          <a href="index.html" class="logo d-flex align-items-center">
              <img src="assets/img/logo.png" alt="">
              <span class="d-none d-lg-block">{{ Auth::user()->user_type }} | Dashboard</span>
          </a>
          <i class="bi bi-list toggle-sidebar-btn"></i>
      </div><!-- End Logo -->

      <div class="search-bar">
          <form class="search-form d-flex align-items-center" method="POST" action="#">
              <input type="text" name="query" placeholder="Search" title="Enter search keyword">
              <button type="submit" title="Search"><i class="bi bi-search"></i></button>
          </form>
      </div><!-- End Search Bar -->

      <nav class="header-nav ms-auto">
          <ul class="d-flex align-items-center">

              <li class="nav-item d-block d-lg-none">
                  <a class="nav-link nav-icon search-bar-toggle " href="#">
                      <i class="bi bi-search"></i>
                  </a>
              </li><!-- End Search Icon-->

              {{-- <li class="nav-item dropdown">

          <a class="nav-link nav-icon" href="#" data-bs-toggle="dropdown">
            <i class="bi bi-bell"></i>
            <span class="badge bg-primary badge-number">4</span>
          </a><!-- End Notification Icon -->

          <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow notifications">
            <li class="dropdown-header">
              You have 4 new notifications
              <a href="#"><span class="badge rounded-pill bg-primary p-2 ms-2">View all</span></a>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li class="notification-item">
              <i class="bi bi-exclamation-circle text-warning"></i>
              <div>
                <h4>Lorem Ipsum</h4>
                <p>Quae dolorem earum veritatis oditseno</p>
                <p>30 min. ago</p>
              </div>
            </li>

            <li>
              <hr class="dropdown-divider">
            </li>

            <li class="notification-item">
              <i class="bi bi-x-circle text-danger"></i>
              <div>
                <h4>Atque rerum nesciunt</h4>
                <p>Quae dolorem earum veritatis oditseno</p>
                <p>1 hr. ago</p>
              </div>
            </li>

            <li>
              <hr class="dropdown-divider">
            </li>

            <li class="notification-item">
              <i class="bi bi-check-circle text-success"></i>
              <div>
                <h4>Sit rerum fuga</h4>
                <p>Quae dolorem earum veritatis oditseno</p>
                <p>2 hrs. ago</p>
              </div>
            </li>

            <li>
              <hr class="dropdown-divider">
            </li>

            <li class="notification-item">
              <i class="bi bi-info-circle text-primary"></i>
              <div>
                <h4>Dicta reprehenderit</h4>
                <p>Quae dolorem earum veritatis oditseno</p>
                <p>4 hrs. ago</p>
              </div>
            </li>

            <li>
              <hr class="dropdown-divider">
            </li>
            <li class="dropdown-footer">
              <a href="#">Show all notifications</a>
            </li>

          </ul><!-- End Notification Dropdown Items -->

        </li> --}}


              <!-- Notification Nav -->
              <li class="nav-item dropdown">
                  <a class="nav-link nav-icon" href="#" data-bs-toggle="dropdown">
                      <i class="bi bi-bell"></i>
                      @if (auth()->user()->unreadNotifications->count() > 0)
                          <span
                              class="badge bg-primary badge-number">{{ auth()->user()->unreadNotifications->count() }}</span>
                      @endif
                  </a><!-- End Notification Icon -->

                  <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow notifications">
                      <li class="dropdown-header">
                          You have {{ auth()->user()->unreadNotifications->count() }} new notifications
                          <a href="#"><span class="badge rounded-pill bg-primary p-2 ms-2">View all</span></a>
                      </li>
                      <li>
                          <hr class="dropdown-divider">
                      </li>

                      @forelse(auth()->user()->unreadNotifications as $notification)
                          <li class="notification-item">
                              <i class="bi bi-exclamation-circle text-warning"></i>
                              <div>
                                  <h4>{{ $notification->data['message'] }}</h4>
                                  <p>Order ID: {{ $notification->data['order_id'] }}</p>
                                  <p>Amount: ${{ $notification->data['amount'] }}</p>
                                  <p>Status: {{ $notification->data['status'] }}</p>
                                  <p>{{ $notification->created_at->diffForHumans() }}</p>
                              </div>
                          </li>
                          <li>
                              <hr class="dropdown-divider">
                          </li>
                      @empty
                          <li class="notification-item">
                              <div>
                                  <p>No new notifications.</p>
                              </div>
                          </li>
                      @endforelse

                      <li class="dropdown-footer">
                          <a href="#">Show all notifications</a>
                      </li>
                  </ul><!-- End Notification Dropdown Items -->
              </li>
              <!-- End Notification Nav -->
              {{-- <li class="nav-item dropdown">
                <a class="nav-link nav-icon" href="#" data-bs-toggle="dropdown">
                    <i class="bi bi-bell"></i>
                    <span class="badge bg-primary badge-number" id="notification-count">0</span>
                </a>
            
                <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow notifications" id="notification-list">
                    <li class="dropdown-header">
                        You have <span id="notification-header-count">0</span> new notifications
                        <a href="#"><span class="badge rounded-pill bg-primary p-2 ms-2">View all</span></a>
                    </li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>
                    <!-- Notifications will be dynamically added here -->
                </ul>
            </li> --}}


              <li class="nav-item dropdown">

                  <a class="nav-link nav-icon" href="#" data-bs-toggle="dropdown">
                      <i class="bi bi-chat-left-text"></i>
                      <span class="badge bg-success badge-number">3</span>
                  </a><!-- End Messages Icon -->

                  <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow messages">
                      <li class="dropdown-header">
                          You have 3 new messages
                          <a href="#"><span class="badge rounded-pill bg-primary p-2 ms-2">View all</span></a>
                      </li>
                      <li>
                          <hr class="dropdown-divider">
                      </li>

                      <li class="message-item">
                          <a href="#">
                              <img src="assets/img/messages-1.jpg" alt="" class="rounded-circle">
                              <div>
                                  <h4>Maria Hudson</h4>
                                  <p>Velit asperiores et ducimus soluta repudiandae labore officia est ut...</p>
                                  <p>4 hrs. ago</p>
                              </div>
                          </a>
                      </li>
                      <li>
                          <hr class="dropdown-divider">
                      </li>

                      <li class="message-item">
                          <a href="#">
                              <img src="assets/img/messages-2.jpg" alt="" class="rounded-circle">
                              <div>
                                  <h4>Anna Nelson</h4>
                                  <p>Velit asperiores et ducimus soluta repudiandae labore officia est ut...</p>
                                  <p>6 hrs. ago</p>
                              </div>
                          </a>
                      </li>
                      <li>
                          <hr class="dropdown-divider">
                      </li>

                      <li class="message-item">
                          <a href="#">
                              <img src="{{ asset('admin/assets/img/messages-3.jpg') }}" alt=""
                                  class="rounded-circle">
                              <div>
                                  <h4>David Muldon</h4>
                                  <p>Velit asperiores et ducimus soluta repudiandae labore officia est ut...</p>
                                  <p>8 hrs. ago</p>
                              </div>
                          </a>
                      </li>
                      <li>
                          <hr class="dropdown-divider">
                      </li>

                      <li class="dropdown-footer">
                          <a href="#">Show all messages</a>
                      </li>

                  </ul><!-- End Messages Dropdown Items -->

              </li><!-- End Messages Nav -->

              <li class="nav-item dropdown pe-3">

                  <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#"
                      data-bs-toggle="dropdown">
                      <img src="{{ asset('uploads/' . Auth::user()->image) }}" alt="Profile" class="rounded-circle">
                      <span class="d-none d-md-block dropdown-toggle ps-2">{{ Auth::user()->name }}</span>
                  </a><!-- End Profile Iamge Icon -->

                  <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
                      <li class="dropdown-header">
                          <h6>{{ Auth::user()->name }}</h6>
                          <span>{{ Auth::user()->user_type }}</span>
                      </li>
                      <li>
                          <hr class="dropdown-divider">
                      </li>

                      <li>
                          <a class="dropdown-item d-flex align-items-center" href="users-profile.html">
                              <i class="bi bi-person"></i>
                              <span>My Profile</span>
                          </a>
                      </li>
                      <li>
                          <hr class="dropdown-divider">
                      </li>

                      <li>
                          <a class="dropdown-item d-flex align-items-center" href="users-profile.html">
                              <i class="bi bi-gear"></i>
                              <span>Account Settings</span>
                          </a>
                      </li>
                      <li>
                          <hr class="dropdown-divider">
                      </li>

                      <li>
                          <a class="dropdown-item d-flex align-items-center" href="pages-faq.html">
                              <i class="bi bi-question-circle"></i>
                              <span>Need Help?</span>
                          </a>
                      </li>
                      <li>
                          <hr class="dropdown-divider">
                      </li>
                      <form action="{{ route('logout') }}" method="POST">
                          @csrf
                          <li>
                              <a class="dropdown-item d-flex align-items-center" href="#">
                                  <i class="bi bi-box-arrow-right"></i>
                                  <button class="btn" type="submit">Sign Out</button>
                              </a>
                          </li>
                      </form>


                  </ul><!-- End Profile Dropdown Items -->
              </li><!-- End Profile Nav -->

          </ul>
      </nav><!-- End Icons Navigation -->

  </header><!-- End Header -->

  {{-- <script>
    document.addEventListener('DOMContentLoaded', function () {
    const notificationDropdown = document.querySelector('.nav-link.nav-icon[data-bs-toggle="dropdown"]');
    if (notificationDropdown) {
        notificationDropdown.addEventListener('click', function () {
            fetch("{{ route('notifications.markAsRead') }}", {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({})
            }).then(response => response.json())
              .then(data => {
                  console.log('Notifications marked as read');
              });
        });
    }
});
  </script> --}}

  {{-- <script>
    // Listen for the order.placed event
    document.addEventListener('DOMContentLoaded', function () {
    // Listen for the order.placed event on the private E_Market channel
    window.Echo.private('E_Market')
        .listen('.order.placed', (data) => {
            // Update the notification count
            const notificationCount = document.getElementById('notification-count');
            const currentCount = parseInt(notificationCount.textContent);
            notificationCount.textContent = currentCount + 1;

            // Update the notification header count
            const headerCount = document.getElementById('notification-header-count');
            headerCount.textContent = currentCount + 1;

            // Add the new notification to the list
            const notificationList = document.getElementById('notification-list');
            const newNotification = document.createElement('li');
            newNotification.classList.add('notification-item');
            newNotification.innerHTML = `
                <i class="bi bi-cart-check text-success"></i>
                <div>
                    <h4>New Order</h4>
                    <p>${data.name} placed an order for $${data.total}.</p>
                    <p>${data.time}</p>
                </div>
            `;

            // Insert the new notification at the top of the list
            notificationList.insertBefore(newNotification, notificationList.children[2]);
        });
});
  
  </script> --}}
