 @extends('website.layout.content')
 @section('webcontent')
     <main class="main">

         <!-- Page Title -->
         <div class="page-title light-background">
             <div class="container">
                 <nav class="breadcrumbs">
                     <ol>
                         <li><a href="index.html">Home</a></li>
                         <li class="current">Account</li>
                     </ol>
                 </nav>
                 <h1>Account</h1>
             </div>
         </div><!-- End Page Title -->
         <!-- Account Section -->
         <section id="account" class="account section">

             <div class="container aos-init aos-animate" data-aos="fade-up" data-aos-delay="100">

                 <!-- Mobile Sidebar Toggle Button -->
                 <div class="sidebar-toggle d-lg-none mb-3">
                     <button class="btn btn-toggle" type="button" data-bs-toggle="collapse"
                         data-bs-target="#profileSidebar" aria-expanded="false" aria-controls="profileSidebar">
                         <i class="bi bi-list me-2"></i> password 
                     </button>
                 </div>

                 <div class="row">
                     <div class="col-lg-9 profile-content aos-init aos-animate" data-aos="fade-left" data-aos-delay="300">
                         <div class="tab-content" id="profileTabsContent">
                             <!-- Personal Info Tab -->
                             <div class="tab-pane active show fade" id="personal" role="tabpanel" aria-labelledby="personal-tab">
                                 <div class="tab-header">
                                     <h2>Update Password</h2>
                                 </div>
                                    @include('profile.partials.update-password-form')
                             </div>

                             <!-- Addresses Tab -->
                             <div class="tab-pane fade" id="addresses" role="tabpanel" aria-labelledby="addresses-tab">
                                 <div class="tab-header">
                                     <h2>My Addresses</h2>
                                     <button class="btn btn-add-address" type="button">
                                         <i class="bi bi-plus-lg"></i> Add new address
                                     </button>
                                 </div>
                                 <div class="addresses-list">
                                     <div class="row">
                                         <!-- Address Item 1 -->
                                         <div class="col-lg-6 mb-4 aos-init aos-animate" data-aos="fade-up"
                                             data-aos-delay="100">
                                             <div class="address-item">
                                                 <div class="address-header">
                                                     <h5>Home Address</h5>
                                                     <div class="address-actions">
                                                         <button class="btn-edit-address" type="button">
                                                             <i class="bi bi-pencil"></i>
                                                         </button>
                                                         <button class="btn-delete-address" type="button">
                                                             <i class="bi bi-trash"></i>
                                                         </button>
                                                     </div>
                                                 </div>
                                                 <div class="address-content">
                                                     <p>123 Main Street<br>Apt 4B<br>New York, NY 10001<br>United States</p>
                                                 </div>
                                                 <div class="default-badge">Default</div>
                                             </div>
                                         </div><!-- End Address Item -->

                                         <!-- Address Item 2 -->
                                         <div class="col-lg-6 mb-4 aos-init aos-animate" data-aos="fade-up"
                                             data-aos-delay="200">
                                             <div class="address-item">
                                                 <div class="address-header">
                                                     <h5>Work Address</h5>
                                                     <div class="address-actions">
                                                         <button class="btn-edit-address" type="button">
                                                             <i class="bi bi-pencil"></i>
                                                         </button>
                                                         <button class="btn-delete-address" type="button">
                                                             <i class="bi bi-trash"></i>
                                                         </button>
                                                     </div>
                                                 </div>
                                                 <div class="address-content">
                                                     <p>456 Business Ave<br>Suite 200<br>San Francisco, CA 94107<br>United
                                                         States</p>
                                                 </div>
                                                 <button class="btn btn-sm btn-make-default" type="button">Make
                                                     default</button>
                                             </div>
                                         </div><!-- End Address Item -->
                                     </div>
                                 </div>
                             </div>

                             <!-- Notifications Tab -->
                             <div class="tab-pane fade" id="notifications" role="tabpanel"
                                 aria-labelledby="notifications-tab">
                                 <div class="tab-header">
                                     <h2>Notification Settings</h2>
                                 </div>
                                 <div class="notifications-settings aos-init aos-animate" data-aos="fade-up"
                                     data-aos-delay="100">
                                     <div class="notification-group">
                                         <h5>Order Updates</h5>
                                         <div class="notification-item">
                                             <div class="notification-info">
                                                 <div class="notification-title">Order status changes</div>
                                                 <div class="notification-desc">Receive notifications when your order
                                                     status changes</div>
                                             </div>
                                             <div class="form-check form-switch">
                                                 <input class="form-check-input" type="checkbox" id="orderStatusNotif"
                                                     checked="">
                                                 <label class="form-check-label" for="orderStatusNotif"></label>
                                             </div>
                                         </div>
                                         <div class="notification-item">
                                             <div class="notification-info">
                                                 <div class="notification-title">Shipping updates</div>
                                                 <div class="notification-desc">Receive notifications about shipping and
                                                     delivery</div>
                                             </div>
                                             <div class="form-check form-switch">
                                                 <input class="form-check-input" type="checkbox" id="shippingNotif"
                                                     checked="">
                                                 <label class="form-check-label" for="shippingNotif"></label>
                                             </div>
                                         </div>
                                     </div>

                                     <div class="notification-group">
                                         <h5>Account Activity</h5>
                                         <div class="notification-item">
                                             <div class="notification-info">
                                                 <div class="notification-title">Security alerts</div>
                                                 <div class="notification-desc">Receive notifications about
                                                     security-related activity</div>
                                             </div>
                                             <div class="form-check form-switch">
                                                 <input class="form-check-input" type="checkbox" id="securityNotif"
                                                     checked="">
                                                 <label class="form-check-label" for="securityNotif"></label>
                                             </div>
                                         </div>
                                         <div class="notification-item">
                                             <div class="notification-info">
                                                 <div class="notification-title">Password changes</div>
                                                 <div class="notification-desc">Receive notifications when your password is
                                                     changed</div>
                                             </div>
                                             <div class="form-check form-switch">
                                                 <input class="form-check-input" type="checkbox" id="passwordNotif"
                                                     checked="">
                                                 <label class="form-check-label" for="passwordNotif"></label>
                                             </div>
                                         </div>
                                     </div>

                                     <div class="notification-group">
                                         <h5>Marketing</h5>
                                         <div class="notification-item">
                                             <div class="notification-info">
                                                 <div class="notification-title">Promotions and deals</div>
                                                 <div class="notification-desc">Receive notifications about special offers
                                                     and discounts</div>
                                             </div>
                                             <div class="form-check form-switch">
                                                 <input class="form-check-input" type="checkbox" id="promoNotif">
                                                 <label class="form-check-label" for="promoNotif"></label>
                                             </div>
                                         </div>
                                         <div class="notification-item">
                                             <div class="notification-info">
                                                 <div class="notification-title">New product arrivals</div>
                                                 <div class="notification-desc">Receive notifications when new products are
                                                     added</div>
                                             </div>
                                             <div class="form-check form-switch">
                                                 <input class="form-check-input" type="checkbox" id="newProductNotif">
                                                 <label class="form-check-label" for="newProductNotif"></label>
                                             </div>
                                         </div>
                                         <div class="notification-item">
                                             <div class="notification-info">
                                                 <div class="notification-title">Personalized recommendations</div>
                                                 <div class="notification-desc">Receive notifications with product
                                                     recommendations based on your interests</div>
                                             </div>
                                             <div class="form-check form-switch">
                                                 <input class="form-check-input" type="checkbox" id="recommendNotif"
                                                     checked="">
                                                 <label class="form-check-label" for="recommendNotif"></label>
                                             </div>
                                         </div>
                                     </div>

                                     <div class="notification-actions">
                                         <button type="button" class="btn btn-save">Save Preferences</button>
                                     </div>
                                 </div>
                             </div>
                         </div>
                     </div>
                 </div>

             </div>

         </section><!-- /Account Section -->

     </main>
 @endsection

 {{-- <x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Profile') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
        </div>
    </div>
</x-app-layout> --}}
