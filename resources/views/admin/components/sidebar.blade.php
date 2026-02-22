<!-- ======= Sidebar ======= -->
<aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

        <li class="nav-item">
            <a class="nav-link" href="{{ route('admin') }}">
                <i class="bi bi-speedometer2"></i>
                <span>Dashboard</span>
            </a>
        </li><!-- End Dashboard Nav -->

        @can('user.managment')
        <li class="nav-heading">User Management</li>
            <li class="nav-item">
                <a class="nav-link collapsed" data-bs-target="#components-nav" data-bs-toggle="collapse" href="#">
                    <i class="bi bi-people"></i><span>User Management</span><i class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="components-nav" class="nav-content collapse" data-bs-parent="#sidebar-nav">
                    <li>
                        <a href="{{ route('add-user.index') }}">
                            <i class="bi bi-person-plus"></i><span>Add New User</span>
                        </a>
                    </li>
                    {{-- @can('superadmin') --}}
                        <li>
                            <a href="{{ route('admin.user.role') }}">
                                <i class="bi bi-person-badge"></i><span>role Management</span>
                            </a>
                        </li>
                    {{-- @endcan --}}

                    <li>
                        <a href="components-badges.html">
                            <i class="bi bi-truck"></i><span>Suppliers</span>
                        </a>
                    </li>
                </ul>
            </li><!-- End User Management Nav -->
        @endcan

<li class="nav-heading">Product Management</li>
        @can('product.view')
            {{-- <li class="nav-item">
                <a class="nav-link collapsed" data-bs-target="#forms-nav" data-bs-toggle="collapse" href="#">
                    <i class="bi bi-box-seam"></i><span>Products</span><i class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="forms-nav" class="nav-content collapse" data-bs-parent="#sidebar-nav">
                    <li>
                        <a href="{{ route('product-cat.index') }}">
                            <i class="bi bi-tags"></i><span>Product Category</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('product-sub-cat.index') }}">
                            <i class="bi bi-tag"></i><span>Product Sub Category</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('product-brand.index') }}">
                            <i class="bi bi-patch-check"></i><span>Brands</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('product.index') }}">
                            <i class="bi bi-box"></i><span>Products</span>
                        </a>
                    </li>
                </ul>
            </li><!-- End Products Nav --> --}}


            <li class="nav-item">
                <a class="nav-link collapsed" href="{{ route('admin.product_dashboard') }}">
                    <i class="bi bi-diagram-3"></i>
                    <span>Product Management</span>
                </a>
            </li><!-- End Product Management Nav -->
        @endcan

        @can('coupon.view')
            <li class="nav-heading">Affiliate Marketing</li>

            <li class="nav-item">
                <a class="nav-link collapsed" href="{{ route('affiliate.index') }}">
                    <i class="bi bi-person-lines-fill"></i>
                    <span>Affiliate Marketers</span>
                </a>
            </li><!-- End Affiliate Nav -->
        @endcan



        @can('order.view')
            <li class="nav-heading">Orders Management</li>
            <li class="nav-item">
                <a class="nav-link collapsed" href="{{ route('coustomer-orders.index') }}">
                    <i class="bi bi-bag-check"></i>
                    <span>Orders</span>
                </a>
            </li><!-- End Orders Nav -->
        @endcan

        @can('blog.managment')
                    <li class="nav-heading">Blog Management</li>

        <li class="nav-item">
            <a class="nav-link collapsed" href="{{ route('admin.blog') }}">
                <i class="bi bi-journal-text"></i>
                <span>Blogs</span>
            </a>
        </li><!-- End Blogs Nav -->
        @endcan


        @can('shipping.view')
            <li class="nav-heading">Shipping Management</li>

            <li class="nav-item">
                <a class="nav-link collapsed" href="{{ route('shipping.index') }}">
                    <i class="bi bi-truck"></i>
                    <span>Shipping</span>
                </a>
            </li><!-- End Shipping Nav -->
        @endcan

        <li class="nav-heading">Pages</li>
      
        <li class="nav-item">
            <a class="nav-link collapsed" href="{{ route('admin.profile') }}">
                <i class="bi bi-person-circle"></i>
                <span>Profile</span>
            </a>
        </li><!-- End Profile Nav -->
        @can('setting.view')
            <li class="nav-item">
                <a class="nav-link collapsed" href="{{ route('admin.setting') }}">
                    <i class="bi bi-gear"></i>
                    <span>Settings</span>
                </a>
            </li><!-- End Settings Nav -->



            <li class="nav-item">
                <a class="nav-link collapsed" href="{{ route('admin.settings.dashboard') }}">
                    <i class="bi bi-sliders"></i>
                    <span>Settings Dashboard</span>
                </a>
            </li><!-- End Settings Dashboard Nav -->
        @endcan

    </ul>

</aside><!-- End Sidebar -->
