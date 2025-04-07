 <!-- ======= Sidebar ======= -->
 <aside id="sidebar" class="sidebar">

     <ul class="sidebar-nav" id="sidebar-nav">

         <li class="nav-item">
             <a class="nav-link " href="{{ route('admin') }}">
                 <i class="bi bi-grid"></i>
                 <span>Dashboard</span>
             </a>
         </li><!-- End Dashboard Nav -->

         <li class="nav-item">
             <a class="nav-link collapsed" data-bs-target="#components-nav" data-bs-toggle="collapse" href="#">
                 <i class="bi bi-menu-button-wide"></i><span>User Managment</span><i
                     class="bi bi-chevron-down ms-auto"></i>
             </a>
             <ul id="components-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                 <li>
                     <a href="{{ route('add-user.index') }}">
                         <i class="bi bi-circle"></i><span>Add New User</span>
                     </a>
                 </li>
                 <li>
                     <a href="components-accordion.html">
                         <i class="bi bi-circle"></i><span>buyers</span>
                     </a>
                 </li>
                 <li>
                     <a href="components-badges.html">
                         <i class="bi bi-circle"></i><span>Suplaiers</span>
                     </a>
                 </li>
             </ul>
         </li><!-- End User managemet Nav -->

         <li class="nav-item">
             <a class="nav-link collapsed" data-bs-target="#forms-nav" data-bs-toggle="collapse" href="#">
                 <i class="bi bi-journal-text"></i><span>Products</span><i class="bi bi-chevron-down ms-auto"></i>
             </a>
             <ul id="forms-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                 <li>
                     <a href="{{ route('product-cat.index') }}">
                         <i class="bi bi-circle"></i><span>Products Category</span>
                     </a>
                 </li>
                 <li>
                     <a href="{{ route('product-sub-cat.index') }}">
                         <i class="bi bi-circle"></i><span>Products Sub Category</span>
                     </a>
                 </li>
                 <li>
                     <a href="{{ route('product-brand.index') }}">
                         <i class="bi bi-circle"></i><span>Brends</span>
                     </a>
                 </li>
                 <li>
                     <a href="{{ route('product.index') }}">
                         <i class="bi bi-circle"></i><span>Products</span>
                     </a>
                 </li>
             </ul>
         </li><!-- End Forms Nav -->

         <!-- End Icons Nav -->

         <li class="nav-heading">Shipping Management</li>

         <li class="nav-item">
             <a class="nav-link collapsed" href="{{ route('shipping.index') }}">
                 <i class="ri-truck-line"></i>
                 <span>Shipping</span>
             </a>
         </li><!-- End Profile Page Nav -->
         <li class="nav-heading">Affiliate Marketing</li>

         <li class="nav-item">
             <a class="nav-link collapsed" href="{{ route('affiliate.index') }}">
                 <i class="ri-user-shared-fill"></i>
                 <span>Affiliate Marketers</span>
             </a>
         </li><!-- End Profile Page Nav -->
         <li class="nav-heading">Orders Management</li>

         <li class="nav-item">
             <a class="nav-link collapsed" href="{{ route('coustomer-orders.index') }}">
                 <i class="ri-shopping-cart-fill"></i>
                 <span>Orders</span>
             </a>
         </li><!-- End Profile Page Nav -->
         <li class="nav-heading">Blog Management</li>

         <li class="nav-item">
             <a class="nav-link collapsed" href="{{ route('admin.blog') }}">
                 <i class="ri-shopping-cart-fill"></i>
                 <span>Blogs</span>
             </a>
         </li><!-- End Profile Page Nav -->

         <li class="nav-heading">Pages</li>

         <li class="nav-item">
             <a class="nav-link collapsed" href="{{ route('admin.profile') }}">
                 <i class="bi bi-person"></i>
                 <span>Profile</span>
             </a>
         </li><!-- End Profile Page Nav -->

         <li class="nav-item">
             <a class="nav-link collapsed" href="pages-register.html">
                 <i class="bi bi-card-list"></i>
                 <span>Register</span>
             </a>
         </li><!-- End Register Page Nav -->

         <li class="nav-item">
             <a class="nav-link collapsed" href="pages-login.html">
                 <i class="bi bi-box-arrow-in-right"></i>
                 <span>Login</span>
             </a>
         </li><!-- End Login Page Nav -->
         <li class="nav-item">
             <a class="nav-link collapsed" href="{{ route('admin.setting') }}">
                 <i class="bi bi-box-arrow-in-right"></i>
                 <span>Settings</span>
             </a>
         </li><!-- End Login Page Nav -->
         <li class="nav-item">
             <a class="nav-link collapsed" href="{{ route('admin.settings.dashboard') }}">
                 <i class="bi bi-box-arrow-in-right"></i>
                 <span>Settings</span>
             </a>
         </li><!-- End Login Page Nav -->

     </ul>

 </aside><!-- End Sidebar-->
